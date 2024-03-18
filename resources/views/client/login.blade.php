@include('client.layouts.top_menu_client')
  <!-- Cart Sidebar Start -->
  @include('client.layouts.cart_client')
  <!-- Cart Sidebar End -->

  @include('client.layouts.header_menu')
  <!-- Header End -->
<style>
.fa-google {
  background: conic-gradient(from -45deg, #ea4335 110deg, #4285f4 90deg 180deg, #34a853 180deg 270deg, #fbbc05 270deg) 73% 55%/150% 150% no-repeat;
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
  -webkit-text-fill-color: transparent;

}
	</style>
  <!-- Login Form Start -->
  <div class="section">

    <div class="imgs-wrapper">
     <!-- <img src="{{ asset('assetsClients/img/veg/11.png') }}" alt="veg" class="d-none d-lg-block"> -->
    </div>

    <div class="container">
      <div class="auth-wrapper">

        <div class="auth-description bg-cover bg-center dark-overlay dark-overlay-2" style="background-image: url('assets/img/auth.jpg')">
          <div class="auth-description-inner">
            <i class="flaticon-chili"></i>
            <h2>Bienvenue!</h2>
            
          </div>
        </div>
        <div class="auth-form">
          @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
          <h2>Se connecter</h2>
 
        
          <form method="post" action="{{ route('client.login.submit', ['subdomain' => $subdomain]) }}">
            @csrf
            <div class="form-group">
              <input type="text" class="form-control form-control-light" placeholder="email"  id="email" name="email">
            </div>
            <div class="form-group">
              <input type="password" class="form-control form-control-light" placeholder="Password" id="password" name="password" >
            </div>
          <!--  <a href="#">Mot de passe oublié?</a> -->
            <button type="submit" class="btn-custom primary">Se connecter</button>
			  
			  
			  
			  <div class="form-group">
                  <a href="{{ route('register.google', ['subdomain' => $subdomain]) }}" class="btn  btn-social">
            <i class="fab fa-google  fa-2x"></i> Se connecter avec Google
        </a>
    
    
</div>
			  
			  
             

            <p>Vous n'avez pas déjà un compte?? <a href="{{ url('client/register') }}">Créez-en un</a> </p>

          </form>
        </div>

      </div>
    </div>
  </div>
  <!-- Login Form End -->
@include('client.layouts.footer_client')