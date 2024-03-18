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
                      <h4 class="card-title">Produits</h4>
                      @if (session('success'))
                          <div class="alert alert-success">
                              {{ session('success') }}
                          </div>
                      @endif
                      <div class="table-responsive">
                        <form method="POST" action="{{ route('restaurant.produits.store') }}" enctype="multipart/form-data">
                          @csrf
                          <input type="text" name="nom_produit" placeholder="Produit Name" required>
                          <input type="text" name="description" placeholder="Description" required>
                          
                          <input type="file" name="image" accept="image/*" required>
                          
                          <input type="number" name="prix" placeholder="Prix" required>
                          
                          <select name="categorie_id" required>
                            @foreach($categories as $categorie)
                              <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                            @endforeach
                          </select>
                          
                          <input type="submit" value="Ajouter Produit">
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