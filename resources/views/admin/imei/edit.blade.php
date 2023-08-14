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
            <div class="row ">
                <div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Modifier </h4>
                      @if (session('success'))
                          <div class="alert alert-success">
                              {{ session('success') }}
                          </div>
                      @endif
                      <form method="POST" action="{{ route('admin.imei.update',$imeirestaurant)}}" enctype="multipart/form-data">
                                        
                                            @method('PUT')
                                            @csrf
                                            <div class="form-group">
                                                <label for="restaurant_id"></label>
                                                <select id="restaurant_id"name="restaurant_id" required class="form-control">
                                                @foreach ($client as $clt)
                                                        <option value="{{ $clt->id }}" {{ $imeirestaurant->restaurant_id == $clt->id ? 'selected' : '' }}>
                                                            {{ $clt->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                   
                    
                                            <p> N° Imei:</p>
                                            
                                                    <div class="form-group">
                                                        <input type="text" name="numimei" id="numimei"
                                                               class="form-control" value="{{ $imeirestaurant->numimei }}" >
                                                       
                                                    </div>
                                           
                                           
                                                <p> N° Série:</p>
                                             
                                                    <div class="form-group">
                                                        <input type="text" name="N_Serie" id="N_Serie"
                                                               class="form-control" value="{{ $imeirestaurant->N_Serie }}" >
                                                       
                                                   
                                                </div>

                                               
                                                <div class="form-group">

                                                        <label for="Date_Service">Date de mise en service:</label>
                                                        <input type="datetime-local"  name="Date_Service"
                                                        class="form-control" value="{{ $imeirestaurant->Date_Service }}" >
                                                        </div>
                                           
                                           
                                                   
                    
                        <button type="submit" class="btn btn-primary">mettre à jour imei Restaurant</button>
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

     