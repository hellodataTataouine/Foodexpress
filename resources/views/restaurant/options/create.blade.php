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
                                    <h2 class="text-center">Ajouter une Option</h2>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <div class="table-responsive">
                                        <form action="{{ route('restaurant.options.store') }}" method="post">
                                            @csrf
                                            
                                            <div class="form-group" style="margin-top:10px;">
                                                <label for="famille_option_id">Famille d'Option:</label>
                                                <select name="famille_option_id" id="famille_option_id" class="form-control" required>
                                                    <option value="">Sélectionnez une famille</option>
                                                    @foreach ($familleOptions as $familleOption)
                                                        <option value="{{ $familleOption->id }}" {{ $familleOption->id == $selectedFamilleOption ? 'selected' : '' }}>{{ $familleOption->nom_famille_option }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="nom_option">Nom de l'Option:</label>
                                                <input type="text" name="nom_option" id="nom_option" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="prix">Prix:</label>
                                                <input type="number" name="prix" id="prix" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Créer</button>
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
