@include('client.layouts.top_menu_client')

  @include('client.layouts.header_menu')
  <!-- Header End -->

  <!-- Register Form Start -->
  <div class="section">

    <div class="imgs-wrapper">
      <img src="assets/img/veg/11.png" alt="veg" class="d-none d-lg-block">
      <img src="assets/img/prods/3.png" alt="veg" class="d-none d-lg-block">
    </div>

    <div class="container">
      <div class="auth-wrapper">

        <div class="auth-description bg-cover bg-center dark-overlay dark-overlay-2" style="background-image: url('assets/img/auth.jpg')">
          <div class="auth-description-inner">
            <i class="flaticon-chili"></i>
            <h2>Hello World!</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          </div>
        </div>
        <div class="auth-form">

          <h2>Sign Up</h2>

          <form method="post" action="{{ route('register.submit') }}">
            @csrf
            <div class="form-group">
              <input id="name" type="text" class="form-control form-control-light @error('name') is-invalid @enderror" name="name" placeholder="Votre nom" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            </div>

            <div class="form-group">
              <input id="email" type="email" class="form-control form-control-light @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">

              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
      </div>
      <div class="form-group">
        <input id="phone" type="text" class="form-control form-control-light @error('phone') is-invalid @enderror" name="phone" placeholder="Numero Telephone" value="{{ old('phone') }}" required autocomplete="phone">
        @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
</div>
<div class="form-group">
        <input id="password" type="password" class="form-control form-control-light @error('password') is-invalid @enderror" name="password" placeholder="Mot de passe" required autocomplete="new-password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
</div>

<div class="form-group">
        <input id="password-confirm" type="password" class="form-control form-control-light" name="password_confirmation" placeholder="Confirmation Mot de passe" required autocomplete="new-password">
</div>

  
<button type="submit" class="btn-custom primary"> {{ __('Register') }}</button>

            <p>Already have an account? <a href="{{ route('client.login') }}">Login</a> </p>

          </form>
        </div>

      </div>
    </div>
  </div>
  <!-- Register Form End -->

  <!-- Footer Start -->
  @include('client.layouts.footer_client')