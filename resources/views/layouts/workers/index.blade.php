@extends("app")
@section("title", "Gestion des agents")

@section("breadcrumbs")
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Effectif</li>
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

@if(session('delete'))
    <div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
        <span class="alert-icon"><i class="fa-solid fa-trash"></i></span>
        <span class="alert-text"><strong>Effectué!</strong> {{ session('delete') }}</span>
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
        <a href="{{ route('workers.index') }}" class="btn btn-sm {{ !$isTrash ? 'btn-info' : 'btn-outline-info' }}">Actifs</a>
        <a href="{{ route('workers.index', ['view' => 'trash']) }}" class="btn btn-sm {{ $isTrash ? 'btn-info' : 'btn-outline-info' }}">Corbeille</a>
    </div>
    @if(!$isTrash)
    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#create-worker-modal"><i class="fa-regular fa-address-card"></i> Ajouter un agent</button>
    @endif
</div>

{{-- Create modal --}}
<div class="modal fade" id="create-worker-modal" tabindex="-1" role="dialog" aria-labelledby="createWorkerModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createWorkerModalTitle">Ajouter un agent</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></span>
                </button>
            </div>
            <form method="POST" action="{{ route('workers.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name" class="col-form-label">Prénom</label>
                                <input name="first_name" type="text" class="form-control" value="{{old('first_name')}}" placeholder="Prénom" id="worker-first_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name" class="col-form-label">Nom</label>
                                <input name="last_name" type="text" class="form-control" value="{{old('last_name')}}" placeholder="Nom" id="worker-last_name" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email</label>
                        <input name="email" type="email" class="form-control" value="{{old('email')}}" placeholder="Email" id="worker-email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone" class="col-form-label">Téléphone</label>
                        <input name="phone" type="text" class="form-control" value="{{old('phone')}}" placeholder="Téléphone" id="worker-phone">
                    </div>

                    <div class="form-group">
                        <label for="worker_type_id" class="col-form-label">Type d'agent</label>
                        <select name="worker_type_id" class="form-select" id="worker-type" required>
                            <option value="">Sélectionner un type</option>
                            @foreach($workerTypes as $type)
                                <option value="{{ $type->id }}" {{ old('worker_type_id') == $type->id ? 'selected' : '' }}>{{ $type->label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="site_id" class="col-form-label">Site (Affectation)</label>
                        <select name="site_id" class="form-select" id="worker-site" required>
                            <option value="">Sélectionner un site</option>
                            @foreach($sites as $site)
                                <option value="{{ $site->id }}" {{ old('site_id') == $site->id ? 'selected' : '' }}>{{ $site->name }}</option>
                            @endforeach
                        </select>
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
{{-- endmodal --}}


<div class="card">
  <div class="table-responsive">
    <table class="table align-items-center mb-0">
        <thead>
            <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom complet</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Contact</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type / Site</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date d'ajout</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($workers as $worker)
                <tr>
                    <td>
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $worker->first_name }} {{ $worker->last_name }}</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $worker->email }}</p>
                        <p class="text-xs text-secondary mb-0">{{ $worker->phone }}</p>
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">Type: {{ $worker->type ? $worker->type->label : 'N/A' }}</p>
                        <p class="text-xs text-secondary mb-0">Site: {{ $worker->site ? $worker->site->name : 'N/A' }}</p>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $worker->created_at->format('d/m/Y') }}</span>
                    </td>
                    <td class="align-middle text-center">
                        @if(!$isTrash)
                            <a href="javascript:;" title="modifier" class="text-success font-weight-bold text-sm" data-toggle="tooltip" data-original-title="Edit user" data-bs-toggle="modal" data-bs-target="#update-worker-modal{{ $worker->id }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="javascript:;" title="supprimer" class="text-danger font-weight-bold text-sm" data-toggle="tooltip" data-original-title="Delete user" data-bs-toggle="modal" data-bs-target="#delete-modal-notification{{$worker->id}}">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        @else
                             <form action="{{ route('workers.restore', $worker->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success" title="Restaurer">
                                    <i class="fa-solid fa-trash-arrow-up"></i> Restaurer
                                </button>
                            </form>
                        @endif
                    </td>

                    @if(!$isTrash)
                    {{-- Update modal --}}
                    <div class="modal fade" id="update-worker-modal{{ $worker->id }}" tabindex="-1" role="dialog" aria-labelledby="updateWorkerModalTitle{{ $worker->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateWorkerModalTitle{{ $worker->id }}">Modifier l'agent</h5>
                                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></span>
                                    </button>
                                </div>
                                <form method="POST" action="{{ route('workers.update', $worker->id) }}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="first_name" class="col-form-label">Prénom</label>
                                                    <input name="first_name" type="text" class="form-control" value="{{ $worker->first_name }}" placeholder="Prénom" id="worker-first_name{{ $worker->id }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="last_name" class="col-form-label">Nom</label>
                                                    <input name="last_name" type="text" class="form-control" value="{{ $worker->last_name }}" placeholder="Nom" id="worker-last_name{{ $worker->id }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="email" class="col-form-label">Email</label>
                                            <input name="email" type="email" class="form-control" value="{{ $worker->email }}" placeholder="Email" id="worker-email{{ $worker->id }}" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="phone" class="col-form-label">Téléphone</label>
                                            <input name="phone" type="text" class="form-control" value="{{ $worker->phone }}" placeholder="Téléphone" id="worker-phone{{ $worker->id }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="worker_type_id" class="col-form-label">Type d'agent</label>
                                            <select name="worker_type_id" class="form-select" id="worker-type{{ $worker->id }}" required>
                                                <option value="">Sélectionner un type</option>
                                                @foreach($workerTypes as $type)
                                                    <option value="{{ $type->id }}" {{ $worker->worker_type_id == $type->id ? 'selected' : '' }}>{{ $type->label }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="site_id" class="col-form-label">Site (Affectation)</label>
                                            <select name="site_id" class="form-select" id="worker-site{{ $worker->id }}" required>
                                                <option value="">Sélectionner un site</option>
                                                @foreach($sites as $site)
                                                    <option value="{{ $site->id }}" {{ $worker->site_id == $site->id ? 'selected' : '' }}>{{ $site->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn bg-gradient-success">Mettre à jour</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- endupdatemodal --}}

                    {{-- Delete modal --}}
                    <div class="col-md-4">
                        <div class="modal fade" id="delete-modal-notification{{$worker->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
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
                                    <p>Voulez-vous vraiment supprimer <strong class="text-danger">{{ $worker->first_name }} {{ $worker->last_name }}</strong> ?</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('workers.destroy', $worker->id) }}" method="POST">
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
                    {{-- end deletemodal --}}
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-sm py-4">Aucun agent trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
  </div>
</div>
@endsection
