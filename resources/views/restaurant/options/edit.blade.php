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


                                    <div class="card-body">
                                        <h4 class="card-title">Modifier l' option</h4>
                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
    
                                        <div class="table-responsive">
    
                                            <form action="{{ route('restaurant.options.update', $option) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                            
                                                <div class="form-group" style="margin-top:10px;">
                                                    <label for="famille_option_id">Famille d'Option:</label>
                                                    <select name="famille_option_id" id="famille_option_id" class="form-control" required>
                                                        <option value="">Select a family</option>
                                                        @foreach ($familleOptions as $familleOption)
                                                            <option value="{{ $familleOption->id }}" {{ $familleOption->id == $option->famille_option_id ? 'selected' : '' }}>
                                                                {{ $familleOption->nom_famille_option }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            
                                                <div class="form-group">
                                                    <label for="nom_option">Nom d'Option:</label>
                                                    <input type="text" name="nom_option" id="nom_option" class="form-control" value="{{ $option->nom_option }}" required>
                                                </div>
                                            
                                                <div class="form-group">
                                                    <label for="prix">Prix:</label>
                                                    <input type="number" name="prix" id="prix" class="form-control" value="{{ $option->prix }}" required>
                                                </div>
                                            
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Modifier</button>
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
    </div>
    @endsection