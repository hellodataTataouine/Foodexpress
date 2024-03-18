@include('client.layouts.top_menu_client')

  @include('client.layouts.header_menu')
  <!-- Header End -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
.btn-social {
    text-align: center; 
    margin-right: 10px; 
}

.btn-social i {
    font-size: 24px; 
    margin-right: 10px; 
}
	
	
	
.fa-google {
  background: conic-gradient(from -45deg, #ea4335 110deg, #4285f4 90deg 180deg, #34a853 180deg 270deg, #fbbc05 270deg) 73% 55%/150% 150% no-repeat;
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
  -webkit-text-fill-color: transparent;

}
	
	
</style>
<br >
<br >
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
            <h2>Inscription!</h2>
            <p></p>
          </div>
        </div>
        <div class="auth-form">

          <h2>S'inscrire1</h2>

          <form method="post" action="{{ route('register.submit', ['subdomain' => $subdomain]) }}">
              @csrf
              <div class="row">
                <div class="form-group col-xl-6">
                 
                  <input type="text" placeholder="Nom" name="nom" class="form-control" value="" required="">
     
                </div>
                <div class="form-group col-xl-6">
                 
                  <input type="text" placeholder="Prénom" name="prenom" class="form-control" value="" required="">
                </div>
                </div>
               
                <div class="form-group col-xl-12">
                 
                  <input type="text" placeholder="Adresse" name="addresse" class="form-control" value="" required="">
                </div>
                <div class="row">
                <div class="form-group col-xl-6">
                 
                  <input type="text" placeholder="Code Postal" name="codePostal" class="form-control" value="">
                </div>
                <div class="form-group col-xl-6">
                  
                  <input type="text" placeholder="Ville" name="ville" class="form-control" value="" required="">
                </div>
                </div>
                <div class="row">
                <div class="form-group col-xl-6">
                 
                  <input type="text" placeholder="N° téléphone 1" name="num1" class="form-control" value="" required="">
                </div>
                <div class="form-group col-xl-6">
                 
                  <input type="text" placeholder="N° téléphone 2(optionnel)" name="num2" class="form-control" value="" >
                </div>
                </div>
               
               
<div class="form-group col-xl-12">
    <input type="email" placeholder="Adresse Email" name="email" class="form-control" value="{{ old('email') }}" required>
    @error('email')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
			   <div class="form-group">
    <input id="password" type="password" class="form-control form-control-light" name="password" placeholder="Mot de passe"  autocomplete="new-password" required minlength="8">
</div>
                  

                  <button type="submit" class="btn-custom primary"> {{ __('S\'inscrire') }}</button>
                    <a href="{{ route('register.google', ['subdomain' => $subdomain]) }}" class="btn  btn-social">
            <i class="fab fa-google  fa-2x"></i> Se connecter avec Google
        </a>
    

            <p>Vous avez déjà un compte? <a href="{{ route('client.login', ['subdomain' => $subdomain]) }}">Se connecter</a> </p>

          </form>
        </div>

      </div>
    </div>
  </div>
  <!-- Register Form End -->

  <!-- Footer Start -->
  @include('client.layouts.footer_client')