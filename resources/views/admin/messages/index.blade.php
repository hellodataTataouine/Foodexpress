@extends('base')
@section('title','Messages')
    
@endsection
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
                  <div class="table-responsive"  style="width:100%">
                    <table class="table" id="myTable">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th> Nom </th>
                          <th> N° Télp </th>
                          <th> Adresse E-mail </th>
                          <th> Sujet</th>
                          <th> Message</th>
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
                              <td>{{ $message->message }}</td>
                            </tr>
                        @endforeach
                      </tbody>
                </div>
          </div>
        </div>

    </div>
</div>

    
@endsection