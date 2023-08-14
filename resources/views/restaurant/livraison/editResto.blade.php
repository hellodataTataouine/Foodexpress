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
                      <h4 class="card-title">Edit Paiment Methode</h4>
                      @if (session('success'))
                          <div class="alert alert-success">
                              {{ session('success') }}
                          </div>
                      @endif
                      <form action="{{ route('restaurant.paiment.update', $paimentRestaurant->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                    
                        <div class="form-group">
                            <label for="restaurant_id">Restaurant ID:</label>
                            <input type="text" name="restaurant_id" id="restaurant_id" class="form-control" value="{{ $paimentRestaurant->restaurant_id }}">
                        </div>
                    
                        <div class="form-group">
                            <label for="paiment_id">Paiment ID:</label>
                            <input type="text" name="paiment_id" id="paiment_id" class="form-control" value="{{ $paimentRestaurant->paiment_id }}">
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Update Paiment Restaurant</button>
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