<style>
	.top-header-nav {
    list-style: none;
    display: flex;
    align-items: center;
}

.btn-book-a-table {
    margin-right: 15px;
    color: white;
    font-size: medium;
}

/* Media query for mobile devices */
@media (max-width: 768px) {
    .top-header-nav {
        flex-direction: column; /* Stack items vertically on small screens */
        text-align: center; /* Center-align items */
    }

    .btn-book-a-table {
        margin: 5px 0; /* Adjust spacing */
    }
}
	
	
	
	
	
</style>
  <!-- Search Form Start-->
  <div class="search-form-wrapper">
    <div class="search-trigger close-btn">
      <span></span>
      <span></span>
    </div>
    <form class="search-form" method="post">
      <input type="text" placeholder="Rechercher..." value="">
      <button type="submit" class="search-btn">
        <i class="flaticon-magnifying-glass"></i>
      </button>
    </form>
  </div>
  <!-- Search Form End-->

  <!-- Aside (Mobile Navigation) -->
  <aside class="main-aside">
    <div class="aside-scroll">
      <ul>
        <li class="menu-item">
        </li>
        <li class="menu-item">
        </li>
        <li class="menu-item">
        <a href="<?php echo e(url('/store')); ?>">Menu</a>
        </li>
        <li class="menu-item">
        </li>
        <li class="menu-item">
        </li>
      </ul>

    </div>

  </aside>




  <div class="aside-overlay aside-trigger"></div>

  <!-- Header Start -->
  <header class="main-header header-1 header-absolute header-light">

    <div class="top-header">
      <div class="container">
        <div class="top-header-inner">

          <div class="top-header-contacts">
            <ul class="top-header-nav">
				             <?php if($client): ?>
<li> <a class="p-0" href="tel:<?php echo e($client->phoneNum1); ?>" style="font-size: 16px;"><i class="fas fa-phone mr-2"></i> <?php echo e($client->phoneNum1); ?></a> </li>
<?php else: ?>
    <!-- Handle the case where $client is null or not properly initialized -->
<?php endif; ?>


            </ul>
			  
          </div>
          <ul class="top-header-nav header-cta">
            <?php if(auth()->guard('clientRestaurant')->check()): ?>
                
            <span class="btn-book-a-table" style="margin-right:15px; color: white; font-size: medium">
    <strong>Bonjour, <?php echo e(auth('clientRestaurant')->user()->FirstName); ?> <?php echo e(auth('clientRestaurant')->user()->LastName); ?>

</strong></span>
           <a class="btn-book-a-table" href="<?php echo e(url('/edit-profile')); ?>" style="margin-right:15px;color: white;font-size: medium">Modifier Compte </a>



                <a class="btn-book-a-table" id="logout-link" style="margin-right:15px;color: white;font-size: medium" href="#">Déconnecter</a>
               <form action="<?php echo e(route('client.logout', ['subdomain' => $subdomain])); ?>" method="POST" id="logout-forum">
               
				
                    <?php echo csrf_field(); ?>
                </form>
			



                <?php else: ?>
                  <a class="btn-book-a-table" href="<?php echo e(url('client/login')); ?>" style="margin-right:15px;color: white;font-size: medium">Connexion |</a>
                <a class="btn-book-a-table" href="<?php echo e(url('client/register')); ?>" style="margin-right:15px;color: white;font-size: medium">Inscription</a>
           
                <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>

    <div class="container">
      <nav class="navbar">
        <!-- Logo -->
               <?php if($client): ?>
    <a class="navbar-brand" href="<?php echo e(url('/store')); ?>"> <img src="<?php echo e(asset($client->logo)); ?>" style="max-width:135px;max-height:73px;" alt="logo"> </a>
<?php else: ?>
    <!-- Handle the case where $client is null or not properly initialized -->
<?php endif; ?>

        <!-- Menu -->
        <ul class="navbar-nav">
          <li class="menu-item">
            <a href="<?php echo e(url('/store')); ?>"style="color: black; font-size: 20px;">Menu</a>
          </li>
          
         
         
  
        </ul>
<?php if(Request::is('store')): ?>
        <div class="header-controls">
          <ul class="header-controls-inner">
            <li class="cart-dropdown-wrapper cart-trigger">
              <span class="cart-item-count"><?php echo e($cart ? count($cart) : 0); ?></span>
              <i class="flaticon-shopping-bag" style="color: white;"></i>
            </li>
            <!--<li class="search-dropdown-wrapper search-trigger">
              <i class="flaticon-search"></i>
            </li>-->
          </ul>
          <!-- Toggler -->
          <div class="aside-toggler aside-trigger">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
<?php endif; ?>
      </nav>
    </div>
</header>
<!-- Subheader Start -->
<?php if(Request::is('store')): ?>
  <div class="subheader  dark-overlay-2" style="background-image: url('<?php echo e(asset($client->Slide_photo)); ?>')">
    <div class="container">
      <div class="subheader-inner">
      
        <nav aria-label="breadcrumb">
         
        </nav>
      </div>

    </div>
  </div>
<?php endif; ?><?php /**PATH C:\Users\HD FRONT\laravel\Foodexpress\resources\views/client/layouts/header_menu.blade.php ENDPATH**/ ?>