<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>-->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
      <a class="sidebar-brand brand-logo" href="#"><p   style="font-size: 25px; color: white;" alt="logo"><strong>HelloData</strong></p></a>
      <a class="sidebar-brand brand-logo-mini" href="#"><img src="images/logo-mini.svg" alt="logo" /></a>
    </div>
    <ul class="nav">
      <li class="nav-item profile">
        <div class="profile-desc">
          <div class="profile-pic">
            <div class="count-indicator">
              <img class="img-xs rounded-circle " src="{{ asset('images/faces/face15.jpg') }}" alt="">
              <span class="count bg-success"></span>
            </div>
            <div class="profile-name">
              <h5 class="mb-0 font-weight-normal">{{ Auth::user()->name }}</h5>
              <span>Restaurant</span>
            </div>
          </div>
          <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
         <!-- <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
            <a href="#" class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-settings text-primary"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-onepassword  text-info"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-calendar-today text-success"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
              </div>
            </a>
          </div> -->
        </div>
      </li>
      <li class="nav-item nav-category">
        <span class="nav-link">Navigation</span>
      </li>
      <li class="fnav-item menu-items">
        <a class="nav-link" hre="{{ url('admin/') }}">
          <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
          </span>
          <span class="menu-title">Tableau de bord</span>
        </a>
      </li>
     

      <li class="nav-item menu-items home clients" id="u-Restaurants">
        <a class="nav-link" data-toggle="collapse" href="#ui-Restaurants" aria-expanded="false" aria-controls="ui-Restaurants">
          <span class="menu-icon">
            <i class="mdi mdi-laptop"></i>
          </span>
          <span class="menu-title">Commandes</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-Restaurants">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url('restaurant/') }}">Liste Commandes</a></li>
          </ul>
        </div>
      </li>
      @php
    $reservation = Auth::user()->restaurant->reservation_table;
@endphp

@if($reservation == 1)

      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#ui-Utilisateurs" aria-expanded="false" aria-controls="ui-Utilisateurs">
          <span class="menu-icon">
            <i class="mdi mdi-laptop"></i>
          </span>
          <span class="menu-title">Reservation tables</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-Utilisateurs">
          <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('restaurant.tables.index') }}">Liste tables </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('restaurant.tables.create') }}">Ajouter table</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('restaurant.resevation.index') }}">Liste Reservation </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('restaurant.resevation.create') }}">Ajouter Reservation</a></li>

          </ul>
        </div>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#ui-Utilisateurs" aria-expanded="false" aria-controls="ui-Utilisateurs">
          <span class="menu-icon">
            <i class="mdi mdi-laptop"></i>
          </span>
          <span class="menu-title">Clients</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-Utilisateurs">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('restaurant.clients.index') }}">Liste Clients</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('restaurant.clients.create') }}">Ajouter Clients</a></li>

          </ul>
        </div>
      </li>
      @endif
      <li class="nav-item menu-items categories">
        <a class="nav-link" data-toggle="collapse" href="#ui-Categories" aria-expanded="false" aria-controls="ui-Categories">
          <span class="menu-icon">
            <i class="mdi mdi-folder"></i>
          </span>
          <span class="menu-title">Categories</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-Categories">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('restaurant.categories.index') }}">Liste Categories</a></li>
           <li class="nav-item"> <a class="nav-link" href="{{ route('restaurant.categories.create') }}">Ajouter Categorie</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item menu-items produits">
        <a class="nav-link" data-toggle="collapse" href="#ui-Produits" aria-expanded="false" aria-controls="ui-Produits">
          <span class="menu-icon">
            <i class="mdi mdi-cart"></i>
          </span>
          <span class="menu-title">Produits</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-Produits">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('restaurant.produits.index') }}">Produits</a></li>
             <li class="nav-item"> <a class="nav-link" href="{{ route('restaurant.produits.create') }}">Ajouter Produit</a></li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('restaurant.famille-options.index') }}">Liste Familles d'Options</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('restaurant.famille-options.create') }}">Ajouter Famille d'Option</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('restaurant.options.index') }}">Liste Options</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('restaurant.options.create') }}">Ajouter Option</a>
          </li>
            
          </ul>
        </div>
      </li>
		<li class="nav-item menu-items client">
        <a class="nav-link" data-toggle="collapse" href="#ui-clients" aria-expanded="false" aria-controls="ui-clients">
          <span class="menu-icon">
            <i class="mdi mdi-folder"></i>
          </span>
          <span class="menu-title">Clients</span>
          <i class="menu-arrow"></i>
        </a>

        <div class="collapse" id="ui-clients">
        <ul class="nav flex-column sub-menu">
         
          <li class="nav-item"><a class="nav-link" href="{{ route('restaurant.clients.index') }}">Liste  de Clients</a></li>
          </ul>
        </div>
    </li>
      <li class="nav-item menu-items paiment">
        <a class="nav-link" data-toggle="collapse" href="#ui-paiment" aria-expanded="false" aria-controls="ui-paiment">
          <span class="menu-icon">
            <i class="mdi mdi-currency-usd"></i>
          </span>
          <span class="menu-title">Méthodes de Paiments</span>
          <i class="menu-arrow"></i>
        </a>

        <div class="collapse" id="ui-paiment">
        <ul class="nav flex-column sub-menu">
         
          <li class="nav-item"><a class="nav-link" href="{{ route('restaurant.paiment.index') }}">Liste de  Méthodes Paiements</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('restaurant.paiment.create') }}">Ajouter  Méthode Paiement</a></li>
        </ul>
        </div>
    </li>
    <li class="nav-item menu-items livraison">
        <a class="nav-link" data-toggle="collapse" href="#ui-livraison" aria-expanded="false" aria-controls="ui-livraison">
          <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
          </span>
          <span class="menu-title">Méthodes de Livraisons</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-livraison">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('restaurant.livraison.index') }}">Liste de Méthode Livraisons</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('restaurant.livraison.create') }}">Ajouter Méthode Livraison</a></li>
          </ul>
        </div>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link"  href="{{ route ('restaurant.metadata.create')}}">
        <span class="menu-icon">
          <i class="mdi mdi-xml"></i>
        </span>
        <span class="menu-title">META-DATA</span>
        
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link"  data-toggle="collapse" href="#zoneserv" aria-expanded="false" aria-controls="zoneserv">
        <span class="menu-icon">
          <i class="mdi mdi-map-marker"></i>
        </span>
        <span class="menu-title">Zone de service</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="zoneserv">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route ('restaurant.servicezone.index')}}">Liste Zones de service</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route ('restaurant.servicezone.create')}}">Ajouter une Zone de service</a></li>

        </ul>
      </div>
    </li>
      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <span class="menu-icon">
            <i class="mdi mdi-security"></i>
          </span>
          <span class="menu-title">Paramètres</span>
          <i class="menu-arrow"></i>
        </a>
		   <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('restaurant.restaurant.edit') }}">Modifer Restaurant</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('restaurant.profile.edit') }}">Modifer Profile</a></li>

          </ul>
        </div>
    <!--    <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
          </ul>
		  </div>   -->
      </li>
    </ul>
  </nav>
  