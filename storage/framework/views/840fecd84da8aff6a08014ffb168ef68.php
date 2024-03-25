<?php echo $__env->make('client.layouts.top_menu_client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <!-- Cart Sidebar Start -->
  <?php echo $__env->make('client.layouts.cart_client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <!-- Cart Sidebar End -->

  <?php echo $__env->make('client.layouts.header_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
     <!-- <img src="<?php echo e(asset('assetsClients/img/veg/11.png')); ?>" alt="veg" class="d-none d-lg-block"> -->
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
          <?php if($errors->any()): ?>
          <div class="alert alert-danger">
              <ul>
                  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li><?php echo e($error); ?></li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
          </div>
      <?php endif; ?>
          <h2>Se connecter</h2>
 
        
          <form method="post" action="<?php echo e(route('client.login.submit', ['subdomain' => $subdomain])); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-group">
              <input type="text" class="form-control form-control-light" placeholder="email"  id="email" name="email">
            </div>
            <div class="form-group">
              <input type="password" class="form-control form-control-light" placeholder="Password" id="password" name="password" >
            </div>
          <!--  <a href="#">Mot de passe oublié?</a> -->
            <button type="submit" class="btn-custom primary">Se connecter</button>
			  
			  
			  
			  <div class="form-group">
                  <a href="<?php echo e(route('register.google', ['subdomain' => $subdomain])); ?>" class="btn  btn-social">
            <i class="fab fa-google  fa-2x"></i> Se connecter avec Google
        </a>
    
    
</div>
			  
			  
             

            <p>Vous n'avez pas déjà un compte?? <a href="<?php echo e(url('client/register')); ?>">Créez-en un</a> </p>

          </form>
        </div>

      </div>
    </div>
  </div>
  <!-- Login Form End -->
<?php echo $__env->make('client.layouts.footer_client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HD FRONT\laravel\Foodexpress\resources\views/client/login.blade.php ENDPATH**/ ?>