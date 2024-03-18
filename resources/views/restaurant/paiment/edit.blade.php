
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

            <div class="row ">
                <div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Modifier Méthode de Paiement </h4>
                      @if (session('success'))
                          <div class="alert alert-success">
                              {{ session('success') }}
                          </div>
                      @endif
                      <form action="{{ route('restaurant.paiment.update', ['id' => $paimentMethod->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        
                        <!-- Add the necessary form fields to edit the category -->
                        <div class="form-group">
                            <label for="type_methode">Modifier Paramètres de paiement:</label>
                            @php
                            $paimentType = \App\Models\PaimentMethod::find($paimentMethod->paiment_id);
                        @endphp
                              
                        </div>
                    
                       
                        <!-- Additional fields for PayPal -->
                        <div class="form-group">
                            <label for="paypal_client_id">ClientId:</label>
                            <input type="text" name="paypal_client_id" id="paypal_client_id" class="form-control" value="{{ $paimentMethod->client_id }}">
                        </div>
                        <div class="form-group">
                            <label for="paypal_client_secret">ClientSecret:</label>
                            <input type="text" name="paypal_client_secret" id="paypal_client_secret" class="form-control" value="{{ $paimentMethod->client_secret }}">
                        </div>
                     
                        
                        <button type="submit" class="btn btn-primary">Modifier</button>
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