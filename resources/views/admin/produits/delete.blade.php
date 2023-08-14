@extends('base')

@section('title', 'Welcome')

@section('content')
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.left-menu')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
      @include('admin.top-menu')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">

              @include('admin.stat')
            <div class="row ">
                <div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Categories</h4>
                      @if (session('success'))
                          <div class="alert alert-success">
                              {{ session('success') }}
                          </div>
                      @endif
              
                      <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Ajouter Categorie</a>
                      <div class="table-responsive">
                        <form method="POST" action="{{ route('admin.produits.destroy', $produit->id) }}">
                            @csrf
                            @method('DELETE')
                            <p>Voulez-vous vraiment supprimer ce produit ?</p>
                            <button type="submit">Supprimer</button>
                        </form>
                      
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          @include('footer')
        </div>
          </div>
       </div>
     @endsection