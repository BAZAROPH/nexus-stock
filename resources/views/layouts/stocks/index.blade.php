@extends("app")
@section("title", "Gestion de stock")

@section("breadcrumbs")
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Gestion de stock</li>
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
        <a href="{{ route('stocks.index') }}" class="btn btn-sm {{ !$isTrash ? 'btn-info' : 'btn-outline-info' }}">Actifs</a>
        <a href="{{ route('stocks.index', ['view' => 'trash']) }}" class="btn btn-sm {{ $isTrash ? 'btn-info' : 'btn-outline-info' }}">Corbeille</a>
        <a href="{{ route('stock_types.index') }}" class="btn btn-sm btn-outline-secondary ms-2"><i class="fa-solid fa-tags"></i> Gérer les catégories</a>
    </div>
    @if(!$isTrash)
    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#create-stock-modal"><i class="fa-solid fa-box"></i> Nouveau matériel</button>
    @endif
</div>

{{-- Create modal --}}
<div class="modal fade" id="create-stock-modal" tabindex="-1" role="dialog" aria-labelledby="createStockModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createStockModalTitle">Nouveau matériel</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></span>
                </button>
            </div>
            <form method="POST" action="{{ route('stocks.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="col-form-label">Nom du matériel</label>
                                <input name="name" type="text" class="form-control" value="{{old('name')}}" placeholder="Ex: MacBook Pro M3" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="stock_type_id" class="col-form-label">Catégorie</label>
                                <select name="stock_type_id" class="form-control" required>
                                    <option value="">Sélectionner une catégorie</option>
                                    @foreach($stockTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->label }}</option>
                                    @endforeach
                                </select>
                            </div>

                             <div class="form-group">
                                <label for="site_id" class="col-form-label">Site (Emplacement)</label>
                                <select name="site_id" class="form-control" required>
                                    <option value="">Sélectionner un site</option>
                                    @foreach($sites as $site)
                                        <option value="{{ $site->id }}">{{ $site->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="quantity" class="col-form-label">Quantité initiale</label>
                                <input name="quantity" type="number" class="form-control" min="0" value="0" required>
                            </div>

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
                                <textarea name="observation" class="form-control" placeholder="État du matériel, remarques particulières..."></textarea>
                            </div>

                            <div class="form-group">
                                <label for="description" class="col-form-label">Description / Notes</label>
                                <textarea name="description" class="form-control" placeholder="Description" rows="2">{{old('description')}}</textarea>
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
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Catégorie</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Site</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantité</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($stocks as $stock)
                <tr>
                    <td>
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $stock->name }}</h6>
                                <div class="d-flex flex-column">
                                    @if(is_array($stock->characteristics) || is_object($stock->characteristics))
                                        @foreach($stock->characteristics as $key => $value)
                                            <span class="text-xs text-secondary mb-0"><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</span>
                                        @endforeach
                                    @elseif(json_decode($stock->characteristics, true))
                                         @foreach(json_decode($stock->characteristics, true) as $key => $value)
                                            <span class="text-xs text-secondary mb-0"><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                     <td>
                        <span class="badge badge-sm bg-gradient-secondary">{{ $stock->type->label ?? 'Aucune' }}</span>
                    </td>
                     <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $stock->site->name ?? 'Aucun' }}</p>
                    </td>
                    <td class="align-middle text-center">
                         <span class="text-secondary text-xs font-weight-bold">{{ $stock->quantity }}</span>
                    </td>
                    <td class="align-middle text-center">
                        @if(!$isTrash)
                            <a href="javascript:;" title="modifier" class="text-success font-weight-bold text-sm" data-toggle="tooltip" data-original-title="Edit stock" data-bs-toggle="modal" data-bs-target="#update-stock-modal{{ $stock->id }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="javascript:;" title="supprimer" class="text-danger font-weight-bold text-sm" data-toggle="tooltip" data-original-title="Delete stock" data-bs-toggle="modal" data-bs-target="#delete-modal-notification{{$stock->id}}">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        @else
                             <form action="{{ route('stocks.restore', $stock->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success" title="Restaurer">
                                    <i class="fa-solid fa-trash-arrow-up"></i> Restaurer
                                </button>
                            </form>
                        @endif
                    </td>

                    @if(!$isTrash)
                    {{-- Update modal --}}
                    <div class="modal fade" id="update-stock-modal{{ $stock->id }}" tabindex="-1" role="dialog" aria-labelledby="updateStockModalTitle{{ $stock->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateStockModalTitle{{ $stock->id }}">Modifier le matériel</h5>
                                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></span>
                                    </button>
                                </div>
                                <form method="POST" action="{{ route('stocks.update', $stock->id) }}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-form-label">Nom du matériel</label>
                                                    <input name="name" type="text" class="form-control" value="{{ $stock->name }}" placeholder="Nom" required>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="stock_type_id" class="col-form-label">Catégorie</label>
                                                    <select name="stock_type_id" class="form-control" required>
                                                        <option value="">Sélectionner une catégorie</option>
                                                        @foreach($stockTypes as $type)
                                                            <option value="{{ $type->id }}" {{ $stock->stock_type_id == $type->id ? 'selected' : '' }}>{{ $type->label }}</option>
                                                        @endforeach
                                                    </select>
            
                                                </div>

                                                 <div class="form-group">
                                                    <label for="site_id" class="col-form-label">Site (Emplacement)</label>
                                                    <select name="site_id" class="form-control" required>
                                                        <option value="">Sélectionner un site</option>
                                                        @foreach($sites as $site)
                                                            <option value="{{ $site->id }}" {{ $stock->site_id == $site->id ? 'selected' : '' }}>{{ $site->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="quantity" class="col-form-label">Quantité</label>
                                                    <input name="quantity" type="number" class="form-control" min="0" value="{{ $stock->quantity }}" required>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="size" class="col-form-label">Taille</label>
                                                            <input name="size" type="text" class="form-control" placeholder="Ex: L, XL, 42" value="{{ json_decode($stock->characteristics, true)['size'] ?? '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="color" class="col-form-label">Couleur</label>
                                                            <input name="color" type="text" class="form-control" placeholder="Ex: Rouge, Bleu" value="{{ json_decode($stock->characteristics, true)['color'] ?? '' }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="dimension" class="col-form-label">Dimension</label>
                                                    <input name="dimension" type="text" class="form-control" placeholder="Ex: 15 pouces, 120x60cm" value="{{ json_decode($stock->characteristics, true)['dimension'] ?? '' }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="observation" class="col-form-label">Observation</label>
                                                    <textarea name="observation" class="form-control" placeholder="État du matériel, remarques particulières...">{{ json_decode($stock->characteristics, true)['observation'] ?? '' }}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="description" class="col-form-label">Description / Notes</label>
                                                    <textarea name="description" class="form-control" placeholder="Description" rows="2">{{ $stock->description }}</textarea>
                                                </div>
                                            </div>
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

                    {{-- Delete modal --}}
                    <div class="col-md-4">
                        <div class="modal fade" id="delete-modal-notification{{$stock->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
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
                                    <p>Voulez-vous vraiment supprimer <strong class="text-danger">{{ $stock->name }}</strong> ?</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST">
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
                    <td colspan="5" class="text-center text-sm py-4">Aucun matériel trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
  </div>
</div>
@endsection
