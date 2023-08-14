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
                    @include('restaurant.stat')
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Ajouter Paiment Methode</h4>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <div class="table-responsive">
                                        <form action="{{ route('restaurant.restaurant.paiment.store') }}" method="POST">
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
                                                <label for="paiment_id">Payment Method Name:</label>
                                                <select name="paiment_id" id="paiment_id" class="form-control">
                                                    @foreach ($paimentMethods as $paimentMethod)
                                                        <option value="{{ $paimentMethod->id }}">{{ $paimentMethod->type_methode }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Create Paiment Restaurant</button>
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
