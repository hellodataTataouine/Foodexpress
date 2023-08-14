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
                                    
                                    <h2 class="text-center">Ajouter Famille Option</h2>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <div class="table-responsive">
                                        <form action="{{ route('restaurant.famille-options.store') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="type">Type de famille par Option </label>
                                                <select name="type" id="type" class="form-control" required>
                                                    <option value="simple">Simple</option>
                                                    <option value="multiple">Multiple</option>
                                                    <option value="qte">Qte</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nom_famille_option">Nom Famille d'Option</label>
                                                <input type="text" name="nom_famille_option" id="nom_famille_option" class="form-control" required>
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

