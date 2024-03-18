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
                    <div class="row">
                        <div class="col-lg-8 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Product Details</h4>
                                    <div>
                                        <p>ID: {{ $produit->id }}</p>
                                        <p>Name: {{ $produit->nom_produit }}</p>
                                        <p>Description: {{ $produit->description }}</p>
                                        <p>Price: {{ $produit->prix }}</p>
                                        <p>Category: {{ $produit->categories->name }}</p>
                                        <p>Status: {{ $produit->status }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ asset($produit->url_image) }}" width="100%" alt="Product Image">
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
