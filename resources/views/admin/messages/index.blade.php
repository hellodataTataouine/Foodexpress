@extends('base')

@section('title','Messages')

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
                    <h4 class="card-title">Messages</h4>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                  </div>
                  <div class="table-responsive">
                    <table class="table" id="myTable" >
                      <thead>
                        <tr>
                          <th scope="col"> # </th>
                          <th scope="col"> Nom </th>
                          <th scope="col"> N° Télp </th>
                          <th scope="col"> Adresse E-mail </th>
                          <th scope="col"> Sujet</th>
                          <th scope="col"> Message</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($messages as $message)
                            <tr>
                              <td>{{ $message->id }}</td>
                              <td>{{ $message->name }}</td>
                              <td>{{ $message->phone_number }}</td>
                              <td>{{ $message->email }}</td>
                              <td>{{ $message->subject }}</td>
                              <td><p>{{ $message->message }}</p></td>
                              <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Ouvrir</button>
                                  <!-- Modal -->
                                          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="false">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                  ...
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                  <button type="button" class="btn btn-primary">Understood</button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                  <button type="button" class="btn btn-warning">Répondre</button>
                                  <button type="button" class="btn btn-danger">Supprimer</button>
                                  
                                </div>
                              </td>
                            </tr>
                        @endforeach
                      </tbody>
                </div>
          </div>
        </div>

    </div>
</div>


@endsection