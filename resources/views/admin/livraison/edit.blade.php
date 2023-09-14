
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
                      <h4 class="card-title">Edit Livraison</h4>
                      @if (session('success'))
                          <div class="alert alert-success">
                              {{ session('success') }}
                          </div>
                      @endif
                      <form action="{{ route('admin.livraison.update', $livraison) }}" method="POST">
                          @csrf
                          @method('PUT')
              
                          <!-- Add the necessary form fields to edit the category -->
                          <div class="form-group">
                              <label for="type_methode">Nom Livraison:</label>
                              <input type="text" name="type_methode" id="type_methode" class="form-control" value="{{ $livraison->methode }}">
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