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
                                    <h4 class="card-title">Ajouter Produits</h4>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <div class="table-responsive">
                                        <form action="{{ route('admin.imei.store') }}" method="POST"    enctype="multipart/form-data">
                                           
                                            @csrf

                                            @if (session('success'))
                                                <div class="alert alert-success">
                                                    {{ session('success') }}
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="restaurant_id"></label>
                                                <select name="restaurant_id" class="form-control" required>
                                                    @foreach ($client as $clt)
                                                        <option value="{{ $clt->id }}"
                                                            {{ request()->input('restaurant_id') == $clt->id ? 'selected' : '' }}>
                                                            {{ $clt->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <p> N° Imei:</p>

                                            <div class="form-group">
                                                <label for="numimei"></label>
                                                <input type="text" name="numimei" class="form-control"  placeholder="Numero imei" required>
                                                <span 
                                                style="color: red; display: none;">Veuillez entrer un numéro de imei valide</span>
                                            </div>
                                          
                                                <p> N° Série:</p>
                                            <div class="form-group">
                                                <label for="N_Serie"></label>
                                                <input type="text" name="N_Serie" class="form-control" placeholder="Numero Série" required>
                                                <span  style="color: red; display: none;">Veuillez entrer un numéro de Série valide </span>

                                            </div>

            

                                      
                                                    <p> Date de mise en service:</p>
                                            <div class="form-group">
                                               
                                                <input type="datetime-local" name="Date_Service" class="form-control" required>
                                            </div>


                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Ajouter</button>
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
