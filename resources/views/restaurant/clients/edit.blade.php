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

                                <h1>Edit Client</h1>

                                <div class="table-responsive">
    <form action="{{ route('clients.update', $client->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="FirstName">First Name</label>
            <input type="text" name="FirstName" class="form-control" value="{{ $client->FirstName }}" required>
        </div>
        <div class="form-group">
            <label for="LastName">Last Name</label>
            <input type="text" name="LastName" class="form-control" value="{{ $client->LastName }}" required>
        </div>
        <div class="form-group">
            <label for="ville">Ville</label>
            <input type="text" name="ville" class="form-control" value="{{ $client->ville }}" required>
        </div>
        <div class="form-group">
            <label for="Address">Address</label>
            <input type="text" name="Address" class="form-control" value="{{ $client->Address }}" required>
        </div>
        <div class="form-group">
            <label for="postalcode">Postal Code</label>
            <input type="text" name="postalcode" class="form-control" value="{{ $client->codepostal }}" required>
        </div>
        <div class="form-group">
            <label for="phoneNum1">Phone Number 1</label>
            <input type="text" name="phoneNum1" class="form-control" value="{{ $client->phoneNum1 }}" required>
        </div>
        <div class="form-group">
            <label for="phoneNum2">Phone Number 2</label>
            <input type="text" name="phoneNum2" class="form-control" value="{{ $client->phoneNum2 }}" >
        </div>
        <div class="form-group">
            <label for="Email">Email</label>
            <input type="email" name="Email" class="form-control" value="{{ $client->Email }}" required>
        </div>
        <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-control" required>
</div>
        <button type="submit" class="btn btn-primary">Update</button>
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