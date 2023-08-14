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
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Ajouter Livraison Methode</h4>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <div class="table-responsive">
                                        <form action="{{ route('restaurant.restaurant.livraison.store') }}" method="POST">
                                            @csrf

                                            <div class="form-group">
                                                <label for="restaurant_id">Restaurant Name:</label>
                                                <select name="restaurant_id" id="restaurant_id" class="form-control">
                                                    @foreach ($users as $user)
                                                    <option value="{{ $user->user_id }}" {{ $user->user_id == request()->route('user_id') ? 'selected' : '' }}>
                                                        {{ $user->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="livraison_id">Livraison Method Name:</label>
                                                <select name="livraison_id" id="livraison_id" class="form-control">
                                                    @foreach ($livraisonMethods as $livraisonMethod)
                                                        <option value="{{ $livraisonMethod->id }}">{{ $livraisonMethod->type_methode }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Create livraison Restaurant</button>
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
