@extends('base')

@section('title', 'Welcome')

@section('content')
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('restaurant.left-menu')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
      @include('restaurant.top-menu')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">

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
              
                      <a href="{{ route('restaurant.categories.create') }}" class="btn btn-primary mb-3">Ajouter Categorie</a>
                      <div class="table-responsive">
                        <form method="POST" action="{{ route('restaurant.produits.destroy', $produit->id) }}">
                            @csrf
                            @method('DELETE')
                            <p>Are you sure you want to delete this produit?</p>
                            <button type="submit">Delete</button>
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