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
                                    <h2 class="text-center">Modifier Famille Option</h2>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <div class="table-responsive">
                                        <form action="{{ route('restaurant.famille-options.update', $familleOption->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                
                                            <div class="mb-3">
                                                <label for="nom_famille_option" class="form-label">Nom Famille Option</label>
                                                <input type="text" class="form-control" id="nom_famille_option" name="nom_famille_option" value="{{ $familleOption->nom_famille_option }}" required>
                                            </div>
                
                                            <div class="mb-3">
                                                <label for="type" class="form-label">Type de famille d'<option value=""></option></label>
                                                <input type="text" class="form-control" id="type" name="type" value="{{ $familleOption->type }}" required>
                                            </div>
                
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Mise à jour</button>
                                                <a href="{{ route('restaurant.famille-options.index') }}" class="btn btn-secondary">Annuler</a>
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

