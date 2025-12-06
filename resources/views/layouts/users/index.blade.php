@extends("app")
@section("title", "Gestion des utilisateurs")

@section("breadcrumbs")
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Utilisateurs</li>
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
<div class="d-flex justify-content-end align-items-center">
    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#create-user-modal"><i class="fa-regular fa-address-book"></i> Ajouter un utilisateur</button>
</div>
{{-- Create modal --}}
<div class="modal fade" id="create-user-modal" tabindex="-1" role="dialog" aria-labelledby="createUserModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="createUserModalTitle">Créer un nouvel utilisateur</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></span>
        </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Email</label>
                    <input name="email" type="email" class="form-control" value="{{old('email')}}" placeholder="Adresse email" id="user-email">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Nom</label>
                    <input name="last_name" type="text" class="form-control" value="{{old('last_name')}}" placeholder="Nom" id="user-last-name">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Prénom</label>
                    <input name="first_name" type="text" class="form-control" value="{{old('first_name')}}" placeholder="Prénom" id="user-first-name">
                </div>
                <div class="form-group">
                    <label class="col-form-label">Role</label>
                    <select name="role_id" class="form-control" id="role-select">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->label }}</option>
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
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rôle</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date de création</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
            <tr>
                <td>
                    <div class="d-flex px-2 py-1">
                    <div>
                        <img src="@if($user->getMedia("profil")->isNotEmpty()) {{ $user->getMedia("profil")->first()->getUrl() }} @else {{ asset('assets/img/user.jpg') }} @endif" class="avatar avatar-sm me-3">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-xs">{{ $user->first_name }}</h6>
                        <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
                    </div>
                    </div>
                </td>
                <td>
                    <span class="text-secondary text-xs font-weight-bold">{{ $user->last_name }}</span>
                </td>
                <td class="align-middle text-center text-sm">
                    <span class="text-secondary text-xs font-weight-bold">{{ $user->role->label }}</span>
                </td>
                <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                </td>
                <td class="align-middle text-center">
                    <a href="javascript:;" title="modifier" class="text-success font-weight-bold text-sm" data-toggle="tooltip" data-original-title="Edit user" data-bs-toggle="modal" data-bs-target="#update-user-modal{{ $user->id }}">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="javascript:;" title="supprimer" class="text-danger font-weight-bold text-sm" data-toggle="tooltip" data-original-title="Delete user" data-bs-toggle="modal" data-bs-target="#delete-modal-notification{{$user->id}}">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
                {{-- Update modal --}}
                <div class="modal fade" id="update-user-modal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="updateUserModalTitle{{ $user->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateUserModalTitle{{ $user->id }}">Modifier un utilisateur</h5>
                                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('users.update', ['user' => $user->id]) }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Email</label>
                                        <input name="email" type="email" class="form-control" value="{{ $user->email }}" placeholder="Adresse email" id="user-email">
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Nom</label>
                                        <input name="last_name" type="text" class="form-control" value="{{ $user->last_name }}" placeholder="Nom" id="user-last-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Prénom</label>
                                        <input name="first_name" type="text" class="form-control" value="{{ $user->first_name }}" placeholder="Prénom" id="user-first-name">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Role</label>
                                        <select name="role_id" class="form-control" id="role-select">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}" @if($user->role->id == $role->id) selected="selected" @endif>{{ $role->label }}</option>
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
                    <div class="modal fade" id="delete-modal-notification{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
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
                                <p>Voulez-vous vraiment supprimer <strong class="text-danger">{{ $user->first_name }} {{ $user->last_name }}</strong> ?</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
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
