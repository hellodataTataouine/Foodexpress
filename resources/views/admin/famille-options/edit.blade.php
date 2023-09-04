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
                                    <h4 class="card-title">Modifier Famille Option</h4>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <div class="table-responsive">
                                        <form action="{{ route('admin.famille-options.update', $familleOption->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                
                                            <div class="mb-3">
                                                <label for="nom_famille_option" class="form-label">Nom Famille Option</label>
                                                <input type="text" class="form-control" id="nom_famille_option" name="nom_famille_option" value="{{ $familleOption->nom_famille_option }}" required>
                                            </div>
                
                                            <div class="mb-3">
                                                <label for="type">Type</label>
                                                <select name="type" id="type" class="form-control" required>
                                                    <option value="simple">Simple</option>
                                                    <option value="multiple">Multiple</option>
                                                    <option value="qte">Qte</option>
                                                </select>
                                               
                                            </div>
                
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                                <a href="{{ route('admin.famille-options.index') }}" class="btn btn-secondary">Annuler</a>
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

