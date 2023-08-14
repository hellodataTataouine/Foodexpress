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
                                    <h4 class="card-title">Modifier Votre Mot De Passe</h4>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <div class="table-responsive">
                                        <form action="{{ route('admin.parametres.change-password.update') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="current-password">Current Password:</label>
                                                <input type="password" class="form-control" id="current-password" name="current-password" required><br>
                                            </div>
                                            <div class="form-group">
                                                <label for="new-password">New Password:</label>
                                                <input type="password" class="form-control" id="new-password" name="new-password" required><br>
                                            </div>
                                            <div class="form-group">
                                                <label for="confirm-password">Confirm Password:</label>
                                                <input type="password" class="form-control" id="confirm-password" name="confirm-password" required><br>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Change Password</button>
                                            </div>
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
