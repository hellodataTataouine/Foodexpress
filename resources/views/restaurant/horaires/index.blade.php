
@extends('base')

@section('title', 'Gestion Horaires')

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
                                    <h4 class="card-title">Produits</h4>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <div class="table-responsive">
                                        <div class="container">
                                            <h1>Gestion des horaires pour le client : {{ $client->name }}</h1>
                                    
                                            <form action="{{ route('restaurant.horaires.store', $client->id) }}" method="POST">
                                                @csrf
                                            
                                                <div class="form-group">
                                                    <label for="date_debut">Date de début :</label>
                                                    <input type="date" name="date_debut" class="form-control" required>
                                                </div>
                                            
                                                <div class="form-group">
                                                    <label for="date_fin">Date de fin :</label>
                                                    <input type="date" name="date_fin" class="form-control" required>
                                                </div>
                                            
                                                <div class="form-group">
                                                    <label for="heure_ouverture">Heure d'ouverture :</label>
                                                    <input type="time" name="heure_ouverture" class="form-control" required>
                                                </div>
                                            
                                                <div class="form-group">
                                                    <label for="heure_fermeture">Heure de fermeture :</label>
                                                    <input type="time" name="heure_fermeture" class="form-control" required>
                                                </div>
                                            
                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                            </form>
                                            
                                    
                                    
                                        </div>
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
