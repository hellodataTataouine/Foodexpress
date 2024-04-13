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
                      <h4 class="card-title">Seo config</h4>
                      @if (session('success'))
                          <div class="alert alert-success">
                              {{ session('success') }}
                          </div>
                      @endif
                          
                      {{-- <div class="mb-3">
                        <input type="text"  class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
                    </div> --}}
                      <div class="table-responsive">
                        @if ( isset($metadata) )
                        <table class="table" id="myTable">
                            
                            <tbody>
                                    <tr>
                                   
                                       
                                   
                                        <td>Titre du site</td>
                                        <td>{{ $metadata->title}}</td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td>{{ $metadata->description }}</td>
                                    </tr>
                                    <tr>
                                        <td>Mots-clés du site</td>
                                        <td>{{ $metadata->keywords }}</td>
                                    </tr>
                                    <tr>
                                        <td>Autoriser les robots à indexer votre site Web ?</td>
                                        <td>{{ $metadata->robots }}</td>
                                    </tr>
                                    <tr>
                                        <td>Autoriser les robots à suivre tous les liens ?</td>
                                        <td>{{ $metadata->follow_links }}</td>
                                    </tr>
                                    <tr>
                                        <td>Type de contenu</td>
                                        <td>{{ $metadata->content_type }}</td>
                                    </tr>
                                    <tr>
                                        <td>Language du site</td>
                                        <td>{{ $metadata->language }}</td>
                                    </tr>
                                

                                <tr><td colspan="4"></td></tr>
                                
                            </tbody>
                        </table>
                        <br>
                        <div class="text-end">
                            <a href="{{ route('restaurant.seo.edit', $metadata) }}" class="btn btn-warning mb-3">Modifier</a>
                          </div>
                          
                        
                        
                        @endif
                        
                        
                         
                        </div>
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