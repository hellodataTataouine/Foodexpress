@include('client.layouts.top_menu_client')
  <!-- Cart Sidebar Start -->
  @include('client.layouts.cart_client')
  <!-- Cart Sidebar End -->

  @include('client.layouts.header_menu')
  <!-- Header End -->

  <!-- Login Form Start -->
  <div class="section">

    <div class="imgs-wrapper">
      <img src="{{ asset('assetsClients/img/veg/11.png') }}" alt="veg" class="d-none d-lg-block">
      <img src="{{ asset('assetsClients/img/prods/3.png') }}" alt="veg" class="d-none d-lg-block">
    </div>

    <div class="container">
      <div class="auth-wrapper">

        <div class="auth-description bg-cover bg-center dark-overlay dark-overlay-2" style="background-image: url('assets/img/auth.jpg')">
          <div class="auth-description-inner">
            <i class="flaticon-chili"></i>
            <h2>Welcome Back!</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          </div>
        </div>
        <div class="auth-form">

          <h2>Log in</h2>
 
          <form method="post"  method="POST" action="{{ route('client.login.submit') }}" > 
            @csrf
            <div class="form-group">
              <input type="text" class="form-control form-control-light" placeholder="email"  id="email" name="email">
            </div>
            <div class="form-group">
              <input type="password" class="form-control form-control-light" placeholder="Password" id="password" name="password" >
            </div>
            <a href="#">Forgot Password?</a>
            <button type="submit" class="btn-custom primary">Login</button>

            <p>Don't have an account? <a href="{{ route('register') }}">Create One</a> </p>

          </form>
        </div>

      </div>
    </div>
  </div>
  <!-- Login Form End -->
@include('client.layouts.footer_client')