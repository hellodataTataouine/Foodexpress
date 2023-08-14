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
                    <div class="row">
                        <div class="col-lg-8 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Product Details</h4>
                                    <div>
                                        <p>ID: {{ $produit->id }}</p>
                                        <p>Nom: {{ $produit->nom_produit }}</p>
                                        <p>Description: {{ $produit->description }}</p>
                                        <p>Prix: {{ $produit->prix }}</p>
                                        <p>Categorie: {{ $produit->categories->name }}</p>
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
