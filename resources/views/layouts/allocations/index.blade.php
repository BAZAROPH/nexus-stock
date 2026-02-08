@extends("app")
@section("title", "Gestion des dotations")

@section("breadcrumbs")
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dotations</li>
@endsection

@section("content")

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show text-white" role="alert">
        <span class="alert-icon"><i class="fa-solid fa-check-double"></i></span>
        <span class="alert-text"><strong>Effectué!</strong> {{ session('success') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
        </button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
        <span class="alert-icon"><i class="fa-solid fa-triangle-exclamation"></i></span>
        <span class="alert-text"><strong>Erreur!</strong> Veuillez vérifier les formulaires.
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
        </button>
    </div>
@endif

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <a href="{{ route('allocations.index') }}" class="btn btn-sm {{ !$isTrash ? 'btn-info' : 'btn-outline-info' }}">Actifs</a>
        <a href="{{ route('allocations.index', ['view' => 'trash']) }}" class="btn btn-sm {{ $isTrash ? 'btn-info' : 'btn-outline-info' }}">Corbeille</a>
    </div>
    @if(!$isTrash)
    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#create-allocation-modal"><i class="fa-solid fa-plus"></i> Nouvelle dotation</button>
    @endif
</div>

{{-- Create modal --}}
<div class="modal fade" id="create-allocation-modal" tabindex="-1" role="dialog" aria-labelledby="createAllocationModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createAllocationModalTitle">Nouvelle dotation</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></span>
                </button>
            </div>
            <form method="POST" action="{{ route('allocations.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stock_id" class="col-form-label">Matériel (Stock)</label>
                                <select name="stock_id" class="form-control" required>
                                    <option value="">Sélectionner un matériel</option>
                                    @foreach($stocks as $stock)
                                        <option value="{{ $stock->id }}" data-characteristics='{{ json_encode($stock->characteristics) }}'>{{ $stock->name }} ({{ $stock->quantity }} disp.)</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="worker_id" class="col-form-label">Bénéficiaire (Agent)</label>
                                <select name="worker_id" class="form-control" required>
                                    <option value="">Sélectionner un agent</option>
                                    @foreach($workers as $worker)
                                        <option value="{{ $worker->id }}">{{ $worker->first_name }} {{ $worker->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="user_id" class="col-form-label">Responsable (Utilisateur)</label>
                                <select name="user_id" class="form-control" required>
                                    <option value="{{ Auth::id() }}">Moi-même</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="quantity" class="col-form-label">Quantité</label>
                                <input name="quantity" type="number" class="form-control" min="1" value="1" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="size" class="col-form-label">Taille</label>
                                        <input name="size" type="text" class="form-control" placeholder="Ex: L, XL, 42">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="color" class="col-form-label">Couleur</label>
                                        <input name="color" type="text" class="form-control" placeholder="Ex: Rouge, Bleu">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="dimension" class="col-form-label">Dimension</label>
                                <input name="dimension" type="text" class="form-control" placeholder="Ex: 15 pouces, 120x60cm">
                            </div>

                            <div class="form-group">
                                <label for="observation" class="col-form-label">Observation</label>
                                <textarea name="observation" class="form-control" rows="4" placeholder="État du matériel, remarques particulières..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn bg-gradient-info">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="card">
  <div class="table-responsive">
    <table class="table align-items-center mb-0">
        <thead>
            <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Matériel</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bénéficiaire</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Responsable</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Site</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Quantité</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Détails</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($allocations as $allocation)
                <tr>
                    <td>
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $allocation->stock->name ?? 'Matériel inconnu' }}</h6>
                            </div>
                        </div>
                    </td>
                     <td>
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $allocation->worker->first_name ?? '' }} {{ $allocation->worker->last_name ?? 'Inconnu' }}</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $allocation->user->first_name ?? '' }} {{ $allocation->user->last_name ?? 'Inconnu' }}</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $allocation->stock->site->name ?? 'Aucun' }}</p>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $allocation->quantity }}</span>
                    </td>
                    <td class="align-middle text-center">
                         <div class="d-flex flex-column justify-content-center">
                            @if(is_array($allocation->details) || is_object($allocation->details))
                                @foreach($allocation->details as $key => $value)
                                    <span class="text-xs text-secondary mb-0"><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</span>
                                @endforeach
                            @elseif(json_decode($allocation->details, true))
                                 @foreach(json_decode($allocation->details, true) as $key => $value)
                                    <span class="text-xs text-secondary mb-0"><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</span>
                                @endforeach
                            @else
                                <span class="text-xs text-secondary mb-0">{{ Str::limit($allocation->details, 20) }}</span>
                            @endif
                        </div>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $allocation->created_at->format('d/m/Y') }}</span>
                    </td>
                    <td class="align-middle text-center">
                        @if(!$isTrash)
                            <a href="javascript:;" title="supprimer" class="text-danger font-weight-bold text-sm" data-toggle="tooltip" data-original-title="Delete allocation" data-bs-toggle="modal" data-bs-target="#delete-modal-notification{{$allocation->id}}">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        @else
                             <form action="{{ route('allocations.restore', $allocation->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success" title="Restaurer">
                                    <i class="fa-solid fa-trash-arrow-up"></i> Restaurer
                                </button>
                            </form>
                        @endif
                    </td>

                    @if(!$isTrash)
                    {{-- Delete modal --}}
                    <div class="col-md-4">
                        <div class="modal fade" id="delete-modal-notification{{$allocation->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="modal-title-notification">Votre attention est requise</h6>
                                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="py-3 text-center">
                                    <i class="fa-solid fa-triangle-exclamation ni-3x"></i>
                                    <h4 class="text-gradient text-danger mt-4">Vous devriez lire ceci !</h4>
                                    <p>Voulez-vous vraiment supprimer cette allocation ?</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('allocations.destroy', $allocation->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Confirmer</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                </form>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-sm py-4">Aucune dotation trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
  </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const stockSelect = document.querySelector('select[name="stock_id"]');
        const sizeInput = document.querySelector('input[name="size"]');
        const colorInput = document.querySelector('input[name="color"]');
        const dimensionInput = document.querySelector('input[name="dimension"]');
        const observationTextArea = document.querySelector('textarea[name="observation"]');

        stockSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const dataAttributes = selectedOption.getAttribute('data-characteristics');
            if(!dataAttributes) return;
            
            const characteristics = JSON.parse(dataAttributes);

            if (characteristics) {
                if (characteristics.size) {
                    sizeInput.value = characteristics.size;
                    sizeInput.setAttribute('readonly', true);
                } else {
                    sizeInput.value = '';
                    sizeInput.removeAttribute('readonly');
                }

                if (characteristics.color) {
                    colorInput.value = characteristics.color;
                    colorInput.setAttribute('readonly', true);
                } else {
                    colorInput.value = '';
                    colorInput.removeAttribute('readonly');
                }

                if (characteristics.dimension) {
                    dimensionInput.value = characteristics.dimension;
                    dimensionInput.setAttribute('readonly', true);
                } else {
                    dimensionInput.value = '';
                    dimensionInput.removeAttribute('readonly');
                }
                
                // For observation, we generally keep it editable unless specific requirement
                // observationTextArea.value = characteristics.observation || '';
            }
        });
    });
</script>
@endsection
