<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <!-- Sidebar content -->
  <!-- ... -->
  <ul class="nav">
      <!-- ... -->
      <li class="nav-item menu-items {{ Request::is('admin/restaurants*') ? 'active' : '' }}">
          <a class="nav-link" data-toggle="collapse" href="#ui-Restaurants" aria-expanded="false" aria-controls="ui-Restaurants">
              <span class="menu-icon">
                  <i class="mdi mdi-laptop"></i>
              </span>
              <span class="menu-title">Restaurants</span>
              <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-Restaurants">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                      <a class="nav-link" href="{{ url('admin/restaurants') }}">Liste Restaurants</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ url('admin/clients/create') }}">Ajouter Restaurant</a>
                  </li>
              </ul>
          </div>
      </li>
      <li class="nav-item menu-items {{ Request::is('admin/clients*') ? 'active' : '' }}">
          <a class="nav-link" data-toggle="collapse" href="#ui-Utilisateurs" aria-expanded="false" aria-controls="ui-Utilisateurs">
              <span class="menu-icon">
                  <i class="mdi mdi-laptop"></i>
              </span>
              <span class="menu-title">Utilisateurs</span>
              <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-Utilisateurs">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('admin.clients.store') }}">Liste Utilisateurs</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="">Ajouter Utilisateur</a>
                  </li>
              </ul>
          </div>
      </li>
      <li class="nav-item menu-items {{ Request::is('admin/categories*') ? 'active' : '' }}">
          <a class="nav-link" data-toggle="collapse" href="#ui-Categories" aria-expanded="false" aria-controls="ui-Categories">
              <span class="menu-icon">
                  <i class="mdi mdi-folder"></i>
              </span>
              <span class="menu-title">Categories</span>
              <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-Categories">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('categories.index') }}">Liste Categories</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('categories.create') }}">Ajouter Categorie</a>
                  </li>
              </ul>
          </div>
      </li>
      <li class="nav-item menu-items {{ Request::is('admin/produits*') ? 'active' : '' }}">
          <a class="nav-link" data-toggle="collapse" href="#ui-Produits" aria-expanded="false" aria-controls="ui-Produits">
              <span class="menu-icon">
                  <i class="mdi mdi-cart"></i>
              </span>
              <span class="menu-title">Produits</span>
              <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-Produits">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('produits.index') }}">Liste Produits</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('produits.create') }}">Ajouter Produit</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('famille-options.index') }}">Liste Familles d'Options</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('famille-options.create') }}">Ajouter Famille d'Option</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('options.index') }}">Liste Options</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('options.create') }}">Ajouter Option</a>
              </li>
          </ul>
          
          </div>
      </li>
      <li class="nav-item menu-items {{ Request::is('admin/mode-de-paiement*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('admin/mode-de-paiement') }}">
              <span class="menu-icon">
                  <i class="mdi mdi-currency-usd"></i>
              </span>
              <span class="menu-title">Mode De Paiment</span>
          </a>
      </li>
      <li class="nav-item menu-items {{ Request::is('admin/mode-livraison*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('admin/mode-livraison') }}">
              <span class="menu-icon">
                  <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Mode Livraison</span>
          </a>
      </li>
      <li class="nav-item menu-items {{ Request::is('admin/parametres*') ? 'active' : '' }}">
          <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <span class="menu-icon">
                  <i class="mdi mdi-security"></i>
              </span>
              <span class="menu-title">Parametres</span>
              <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                      <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="pages/samples/error-404.html"> 404 </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="pages/samples/error-500.html"> 500 </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="pages/samples/login.html"> Login </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="pages/samples/register.html"> Register </a>
                  </li>
              </ul>
          </div>
      </li>
  </ul>
</nav>
