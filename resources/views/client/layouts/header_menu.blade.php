
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
    <a class="navbar-brand" href="{{ url('/store') }}"> <img src="{{ asset($client->logo) }}" style="max-width:135px;max-height:73px;" alt="logo"> </a>

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
  <header class="main-header header-1">

    <div class="top-header">
      <div class="container">
        <div class="top-header-inner">

          <div class="top-header-contacts">
            <ul class="top-header-nav">
              <li> <a class="p-0" href="tel:{{ $client->phoneNum1 }}"><i class="fas fa-phone mr-2"></i> {{ $client->phoneNum1 }}</a> </li>
            </ul>
          </div>
          <ul class="top-header-nav header-cta">
            @auth('clientRestaurant')
                <a class="btn-book-a-table" href="{{ url('/store') }}" style="margin-right:15px;color: white;font-size: medium">Store |</a>
                <a class="btn-book-a-table" href="{{ url('/commandes') }}" style="margin-right:15px;color: white;font-size: medium">Commandes |</a>
                <a class="btn-book-a-table" id="logout-link" style="margin-right:15px;color: white;font-size: medium" href="#">Logout</a>
                <form action="{{ route('client.logout') }}" method="POST" id="logout-forum">
                    @csrf
                </form>

                @else
                <a class="btn-book-a-table" href="{{ url('client/login') }}" style="margin-right:15px;color: white;font-size: medium">Connexion |</a>
                <a class="btn-book-a-table" href="{{ url('client/register') }}" style="margin-right:15px;color: white;font-size: medium">Inscription</a>
              <!-- <a class="btn-book-a-table" href="{{ url('client/login') }}" style="margin-right:15px;color: white;font-size: medium">reservation Table |</a>--<
             
                @endauth
          </ul>
        </div>
      </div>
    </div>

    <div class="container">
      <nav class="navbar">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ url('/store') }}"> <img src="{{ asset($client->logo) }}" style="max-width:135px;max-height:73px;" alt="logo"> </a>
        <!-- Menu -->
        <ul class="navbar-nav">
          <li class="menu-item">
            <a href="{{ url('/store') }}">Menu</a>
          </li>
          
         
         
  
        </ul>

        <div class="header-controls">
          <ul class="header-controls-inner">
            <li class="cart-dropdown-wrapper cart-trigger">
              <span class="cart-item-count">{{ $cart ? count($cart) : 0 }}</span>
              <i class="flaticon-shopping-bag" ></i>
            </li>
            <li class="search-dropdown-wrapper search-trigger">
              <i class="flaticon-search"></i>
            </li>
          </ul>
          <!-- Toggler -->
          <div class="aside-toggler aside-trigger">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>

      </nav>
    </div>
</header>
