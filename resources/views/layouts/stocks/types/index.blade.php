@extends("app")
@section("title", "Gestion des catégories de stock")

@section("breadcrumbs")
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Catégories de stock</li>
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
        <a href="{{ route('stock_types.index') }}" class="btn btn-sm {{ !$isTrash ? 'btn-info' : 'btn-outline-info' }}">Actifs</a>
        <a href="{{ route('stock_types.index', ['view' => 'trash']) }}" class="btn btn-sm {{ $isTrash ? 'btn-info' : 'btn-outline-info' }}">Corbeille</a>
    </div>
    @if(!$isTrash)
    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#create-stock-type-modal"><i class="fa-solid fa-tags"></i> Nouvelle catégorie</button>
    @endif
</div>

{{-- Create modal --}}
<div class="modal fade" id="create-stock-type-modal" tabindex="-1" role="dialog" aria-labelledby="createStockTypeModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createStockTypeModalTitle">Nouvelle catégorie</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></span>
                </button>
            </div>
            <form method="POST" action="{{ route('stock_types.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="col-form-label">Nom</label>
                        <input name="name" type="text" class="form-control" value="{{old('name')}}" placeholder="Nom de la catégorie" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="description" class="col-form-label">Description</label>
                        <textarea name="description" class="form-control" placeholder="Description">{{old('description')}}</textarea>
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
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Libellé</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Slug</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date de création</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($stockTypes as $type)
                <tr>
                    <td>
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $type->label }}</h6>
                            </div>
                        </div>
                    </td>
                     <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $type->slug }}</p>
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0 text-truncate" style="max-width: 250px;">{{ $type->description ?? 'Non renseignée' }}</p>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $type->created_at->format('d/m/Y') }}</span>
                    </td>
                    <td class="align-middle text-center">
                        @if(!$isTrash)
                            <a href="javascript:;" title="modifier" class="text-success font-weight-bold text-sm" data-toggle="tooltip" data-original-title="Edit category" data-bs-toggle="modal" data-bs-target="#update-stock-type-modal{{ $type->id }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="javascript:;" title="supprimer" class="text-danger font-weight-bold text-sm" data-toggle="tooltip" data-original-title="Delete category" data-bs-toggle="modal" data-bs-target="#delete-modal-notification{{$type->id}}">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        @else
                             <form action="{{ route('stock_types.restore', $type->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success" title="Restaurer">
                                    <i class="fa-solid fa-trash-arrow-up"></i> Restaurer
                                </button>
                            </form>
                        @endif
                    </td>

                    @if(!$isTrash)
                    {{-- Update modal --}}
                    <div class="modal fade" id="update-stock-type-modal{{ $type->id }}" tabindex="-1" role="dialog" aria-labelledby="updateStockTypeModalTitle{{ $type->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateStockTypeModalTitle{{ $type->id }}">Modifier la catégorie</h5>
                                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></span>
                                    </button>
                                </div>
                                <form method="POST" action="{{ route('stock_types.update', $type->id) }}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="name" class="col-form-label">Nom</label>
                                            <input name="name" type="text" class="form-control" value="{{ $type->label }}" placeholder="Nom" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="description" class="col-form-label">Description</label>
                                            <textarea name="description" class="form-control" placeholder="Description">{{ $type->description }}</textarea>
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
                        <div class="modal fade" id="delete-modal-notification{{$type->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
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
                                    <p>Voulez-vous vraiment supprimer la catégorie <strong class="text-danger">{{ $type->label }}</strong> ?</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('stock_types.destroy', $type->id) }}" method="POST">
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
                    <td colspan="5" class="text-center text-sm py-4">Aucune catégorie trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
  </div>
</div>
@endsection
