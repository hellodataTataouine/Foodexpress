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
        <a href="{{ url('/store') }}">Menu</a>
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
				             @if ($client)
<li> <a class="p-0" href="tel:{{ $client->phoneNum1 }}" style="font-size: 16px;"><i class="fas fa-phone mr-2"></i> {{ $client->phoneNum1 }}</a> </li>
@else
    <!-- Handle the case where $client is null or not properly initialized -->
@endif


            </ul>
			  
          </div>
          <ul class="top-header-nav header-cta">
            @auth('clientRestaurant')
                
            <span class="btn-book-a-table" style="margin-right:15px; color: white; font-size: medium">
    <strong>Bonjour, {{ auth('clientRestaurant')->user()->FirstName }} {{ auth('clientRestaurant')->user()->LastName }}
</strong></span>
           <a class="btn-book-a-table" href="{{ url('/edit-profile') }}" style="margin-right:15px;color: white;font-size: medium">Modifier Compte </a>



                <a class="btn-book-a-table" id="logout-link" style="margin-right:15px;color: white;font-size: medium" href="#">Déconnecter</a>
               <form action="{{ route('client.logout', ['subdomain' => $subdomain]) }}" method="POST" id="logout-forum">
               
				
                    @csrf
                </form>
			



                @else
                  <a class="btn-book-a-table" href="{{ url('client/login') }}" style="margin-right:15px;color: white;font-size: medium">Connexion |</a>
                <a class="btn-book-a-table" href="{{ url('client/register') }}" style="margin-right:15px;color: white;font-size: medium">Inscription</a>
           
                @endauth
          </ul>
        </div>
      </div>
    </div>

    <div class="container">
      <nav class="navbar">
        <!-- Logo -->
               @if ($client)
    <a class="navbar-brand" href="{{ url('/store') }}"> <img src="{{ asset($client->logo) }}" style="max-width:135px;max-height:73px;" alt="logo"> </a>
@else
    <!-- Handle the case where $client is null or not properly initialized -->
@endif

        <!-- Menu -->
        <ul class="navbar-nav">
          <li class="menu-item">
            <a href="{{ url('/store') }}"style="color: black; font-size: 20px;">Menu</a>
          </li>
          
         
         
  
        </ul>
@if(Request::is('store'))
        <div class="header-controls">
          <ul class="header-controls-inner">
            <li class="cart-dropdown-wrapper cart-trigger">
              <span class="cart-item-count">{{ $cart ? count($cart) : 0 }}</span>
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
@endif
      </nav>
    </div>
</header>
<!-- Subheader Start -->
@if(Request::is('store'))
  <div class="subheader  dark-overlay-2" style="background-image: url('{{ asset($client->Slide_photo) }}')">
    <div class="container">
      <div class="subheader-inner">
      
        <nav aria-label="breadcrumb">
         
        </nav>
      </div>

    </div>
  </div>
@endif