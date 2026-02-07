<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include("includes.assets.css")

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <title>{{env('APP_NAME')}} - Mot de passe oublié</title>
</head>
<body>

    <main class="main-content  mt-0">
    <section class="min-vh-100 mb-4">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('{{asset("assets/img/curved-images/curved9.jpg")}}');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">Mot de passe oublié?</h1>
                        <p class="text-lead text-white">Entrez votre email pour réinitialiser votre mot de passe.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show text-white" role="alert">
                            <span class="alert-icon"><i class="fa-solid fa-check-double"></i></span>
                            <span class="alert-text"><strong>Effectué!</strong> {{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                            </button>
                        </div>
                    @endif
                    <div class="card z-index-0 pb-4">
                        <div class="card-header text-center pt-4">
                            <h5>Réinitialisation</h5>
                        </div>
                        @error("email")
                            <div class="alert alert-danger mx-4 py-1 text-white" role="alert">
                                <strong>Erreur!</strong> {{$message}}
                            </div>
                        @enderror
                        <div class="card-body">
                            <form role="form text-left" method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon" value="{{old('email')}}" required>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-info w-100 my-4 mb-2">Envoyer le lien</button>
                                </div>
                            </form>
                        </div>
                         <div class="card-footer text-center pt-0 px-lg-2 px-1">
                            <p class="mb-4 text-sm mx-auto">
                                Vous vous en souvenez ?
                                <a href="{{ route('login') }}" class="text-info text-gradient font-weight-bold">Se connecter</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <footer class="footer py-1">
      <div class="container">
        <div class="row">
          <div class="col-8 mx-auto text-center mt-1">
            <p class="mb-0 text-secondary">
              Copyright © <script>
                document.write(new Date().getFullYear())
              </script> Soft by Bazaroph.
            </p>
          </div>
        </div>
      </div>
    </footer>
    <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  </main>

@include('includes.assets.js')
</body>
</html>
