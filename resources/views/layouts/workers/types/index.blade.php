@extends("app")
@section("title", "Gestion des types d'agent")

@section("breadcrumbs")
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Types d'agent</li>
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

<div class="d-flex justify-content-end align-items-center">
    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#create-worker-type-modal"><i class="fa-regular fa-address-book"></i> Ajouter un type d'agent</button>
</div>

{{-- Create modal --}}
<div class="modal fade" id="create-worker-type-modal" tabindex="-1" role="dialog" aria-labelledby="createWorkerTypeModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createWorkerTypeModalTitle">Créer un nouveau type d'agent</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></span>
                </button>
            </div>
            <form method="POST" action="{{ route('worker_types.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Libellé</label>
                        <input name="label" type="text" class="form-control" value="{{old('label')}}" placeholder="Libellé" id="worker_type-label">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Description</label>
                        <textarea name="description" class="form-control" placeholder="Description" id="worker_type-description">{{old('description')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="profil" class="col-form-label">Image de profil</label>
                        <input name="profil" type="file" class="form-control" id="worker_type-profil">
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
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Libellé</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date de création</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($workerTypes as $worker_type)
                <tr>
                    <td>
                        <div class="d-flex px-2 py-1">
                        <div>
                            <img src="@if($worker_type->getMedia("profil")->isNotEmpty()) {{ $worker_type->getMedia("profil")->first()->getUrl() }} @else {{ asset('assets/img/user.jpg') }} @endif" class="avatar avatar-sm me-3">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-xs">{{ $worker_type->id }}</h6>
                            {{-- <p class="text-xs text-secondary mb-0">{{ $worker_type->email }}</p> --}}
                        </div>
                        </div>
                    </td>
                    <td>
                        <span class="text-secondary text-xs font-weight-bold">{{ $worker_type->label }}</span>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">{{ $worker_type->description }}</span>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">{{ $worker_type->created_at }}</span>
                    </td>
                    <td class="align-middle text-center">
                        <a href="javascript:;" title="modifier" class="text-success font-weight-bold text-sm" data-toggle="tooltip" data-original-title="Edit worker type" data-bs-toggle="modal" data-bs-target="#update-worker-type-modal{{ $worker_type->id }}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="javascript:;" title="supprimer" class="text-danger font-weight-bold text-sm" data-toggle="tooltip" data-original-title="Delete worker type" data-bs-toggle="modal" data-bs-target="#delete-modal-notification{{$worker_type->id}}">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                    {{-- Update modal --}}
                    <div class="modal fade" id="update-worker-type-modal{{ $worker_type->id }}" tabindex="-1" role="dialog" aria-labelledby="updateWorkerTypeModalTitle{{ $worker_type->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateWorkerTypeModalTitle{{ $worker_type->id }}">Modifier un type de travailleur</h5>
                                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></span>
                                    </button>
                                </div>
                                <form method="POST" action="{{ route('worker_types.update', ['workerType' => $worker_type->id]) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Label</label>
                                            <input name="label" type="text" class="form-control" value="{{ $worker_type->label }}" placeholder="Label" id="worker-type-label">
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Description</label>
                                            <textarea name="description" class="form-control" placeholder="Description" id="worker-type-description">{{ $worker_type->description }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="profil" class="col-form-label">Image de profil</label>
                                            <input name="profil" type="file" class="form-control" id="worker-type-profil">
                                            @if($worker_type->getMedia("profil")->isNotEmpty())
                                                <div class="mt-2">
                                                    <p class="text-xs mb-1">Actuelle:</p>
                                                    <img src="{{ $worker_type->getMedia("profil")->first()->getUrl() }}" class="avatar avatar-lg rounded" alt="Current Image">
                                                </div>
                                            @endif
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
                        <div class="modal fade" id="delete-modal-notification{{$worker_type->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
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
                                    <p>Voulez-vous vraiment supprimer <strong class="text-danger">{{ $worker_type->label }}</strong> ?</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('worker_types.destroy', $worker_type->id) }}" method="POST">
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
                </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</div>
@endsection
