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
            <div class="row ">
                <div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Ajouter Paiment Methode</h4>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    
                        <form method="POST" action="{{ route('restaurant.paiment.store') }}">
                            @csrf
              
                            <div class="form-group">
                                <label for="type_methode">Méthode de paiement </label>
                                <select name="type_methode" class="form-control" rquired>
@foreach ( $Paiements as $paiment )
<option value="{{$paiment->id}}">{{$paiment->type_methode}}</option>
    
@endforeach


                                </select>
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
          @include('footer')
        </div>
          </div>
       </div>
     @endsection
