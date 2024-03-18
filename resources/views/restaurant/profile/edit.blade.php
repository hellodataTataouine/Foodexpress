
@extends('base')

@section('title', 'Welcome')

@section('content')
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('restaurant.left-menu')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
      @include('restaurant.top-menu')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">

             

              <div class="row ">
                <div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                       @if (session('success'))
                          <div class="alert alert-success">
                              {{ session('success') }}
                          </div>
                      @endif
              
                      <h2 class="text-center">Modifier votre profile, {{ Auth::user()->name }} </h2>


                    <form method="POST" action="{{ route('restaurant.profile.update', Auth::user()->id) }}">
    @csrf
    @method('PUT')

    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>
        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adresse E-Mail') }}</label>
        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe actuel') }}</label>
        <div class="col-md-6">
            <div class="input-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="current-password" >
                <button class="btn btn-outline-secondary" type="button" id="password-toggle" onclick="togglePasswordVisibility('password')">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('Nouveau mot de passe') }}</label>
        <div class="col-md-6">
            <div class="input-group">
                <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required autocomplete="new-password">
                <button class="btn btn-outline-secondary" type="button" id="new-password-toggle" onclick="togglePasswordVisibility('new_password')">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
            @error('new_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirmer le nouveau mot de passe') }}</label>
        <div class="col-md-6">
            <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required autocomplete="new-password">
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Modifier') }}
            </button>
            <a href="{{ route('indexrestaurant') }}" class="btn btn-secondary">
                {{ __('Annuler') }}
            </a>
        </div>
    </div>
</form>





                    </div>
                </div>
              </div>
            </div>
        </div>
        @include('footer')
      </div>
        </div>
     </div>
   @endsection

   <script>
    function togglePasswordVisibility(inputId) {
        const passwordInput = document.getElementById(inputId);
        const passwordToggle = document.getElementById('password-toggle');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordToggle.classList.remove('text-primary'); // Remove the default 'text-primary' class
            passwordToggle.classList.add('text-danger'); // Add your custom CSS class for the desired color
            passwordToggle.innerHTML = '<i class="bi bi-eye-slash"></i>';
        } else {
            passwordInput.type = 'password';
            passwordToggle.classList.remove('text-danger'); // Remove the custom CSS class
            passwordToggle.classList.add('text-primary'); // Add the default 'text-primary' class
            passwordToggle.innerHTML = '<i class="bi bi-eye"></i>';
        }
    }
</script>

