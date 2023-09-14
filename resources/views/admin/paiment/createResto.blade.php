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
                                    <h4 class="card-title">Ajouter Paiement Methode</h4>
                                    @if (Session::has('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                
                                @if (Session::has('error'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('error') }}
                                    </div>
                                @endif
                                    <div class="table-responsive">
                                        <form action="{{ route('admin.paiment.storeresto') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="paiment_id">Paiement Method:</label>
                                              
                                                    
                                                    <input name="paiment_id" id="paiment_id" value = {{ $paimentMethod->type_methode }} @readonly(true) />
                                                  
                                            </div>

                                            <div class="form-group">
                                                <label for="restaurant_id">Restaurant :</label>
                                                <select name="restaurant_id" id="restaurant_id" class="form-control">
                                                    @foreach ($restauants as $client)
                                                    <option value="{{ $client->id }}" {{ $client->id== request()->route('id') ? 'selected' : '' }}>
                                                        {{ $client->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                           
                                            <button type="submit" class="btn btn-primary">Ajouter Paiement Restaurant</button>
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
