@extends('base')

@section('title', 'Seo Modifier')

@section('content')

<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('restaurant.left-menu')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_navbar.html -->
    @include('restaurant.top-menu')
      <!-- partial -->
      <style>
        .flex-container {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: normal;
            align-items: normal;
            align-content: normal;
            
            
          }
          input#image {
              padding: inherit;
              margin: auto;
          }
      </style>
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="color: black;">SEO</h4>
                      @if (session('success'))
                          <div class="alert alert-success">
                              {{ session('success') }}
                          </div>
                      @endif
                    <div class="table-responsive">
                   <form method="POST" action="{{ route('restaurant.seo.update',$metadata->id) }}" enctype="multipart/form-data" style="width: 90%;">
                          @csrf
              
                         
                          <div class="mb-3">
                            <label for="title" class="form-label">Titre du site</label>
                            <input type="text" class="form-control" id="title" maxlength="70" placeholder="Le titre doit contenir moins de 70 caractères" value="{{ $metadata->title }}" required>
                        </div>
                        <div class="flex-container">
                          <div class="mb-3" style="width: 50%; margin-right: 5px;">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="3" maxlength="150" placeholder="La description doit contenir moins de 150 caractères"  required >{{ $metadata->description }}</textarea>
                        </div>
                        <div class="mb-3" style="width: 50%; margin-left: 5px;">
                            <label for="keywords" class="form-label">Mots-clés du site (séparés par des virgules)</label>
                            <textarea class="form-control" id="keywords" rows="3" placeholder="mot-clé 1 , mot-clé 2 , mot-clé 3 ..." required>{{ $metadata->keywords }}</textarea>
                        </div>
                        </div>
                        <div class="flex-container">
                          <div class="mb-3" style="width: 50%; margin-right: 5px;">
                            <label for="robots" class="form-label">Autoriser les robots à indexer votre site Web ?</label>
                            <select class="form-control" id="robots">
                                @if ($metadata->robots =="Yes")
                                    <option selected value="Yes">Yes</option>
                                    <option value="No">No</option>
                                @else
                                    <option value="Yes">Yes</option>
                                    <option selected value="No">No</option>
                                @endif
                                
                              </select>
                          </div>
                          <div class="mb-3" style="width: 50%; margin-left: 5px;">
                            <label for="followlinks" class="form-label">Autoriser les robots à suivre tous les liens ?</label>
                            <select class="form-control" id="followlinks">
                                @if ($metadata->follow_links=="Yes")
                                    <option value="Yes" selected>Yes</option>
                                    <option value="No">No</option>
                                @else
                                    <option value="Yes">Yes</option>
                                    <option value="No" selected>No</option>
                                @endif
                                
                              </select>
                          </div>
                        
                        </div>
                        <div class="flex-container">
                          <div class="mb-3" style="width: 50%; margin-right: 5px;">
                            <label for="content_type" class="form-label">Quel type de contenu votre site affichera-t-il ?</label>
                            <select name="content_type" class="form-control" id="content_type">
                              @if ($metadata->content_type == "text/html; charset=utf-8")
                                  <option value="text/html; charset=utf-8" selected>UTF-8</option>
                              @else
                                  <option value="text/html; charset=utf-8">UTF-8</option> 
                              @endif
                              @if ($metadata->content_type =="text/html; charset=utf-16")
                                  <option value="text/html; charset=utf-16" selected>UTF-16</option>
                              @else
                                  <option value="text/html; charset=utf-16">UTF-16</option>
                              @endif
                              @if ($metadata->content_type == "text/html; charset=iso-8859-1")
                                  <option value="text/html; charset=iso-8859-1" selected>ISO-8859-1</option>
                              @else
                                  <option value="text/html; charset=iso-8859-1">ISO-8859-1</option>
                              @endif
                              @if ($metadata->content_type == "text/html; charset=windows-1252")
                                  <option value="text/html; charset=windows-1252" selected>WINDOWS-1252</option>
                              @else
                                  <option value="text/html; charset=windows-1252">WINDOWS-1252</option>
                              @endif
                              
                            </select>
                        </div>
                          <div class="mb-3" style="width: 50%; margin-left: 5px;">
                            <label for="language" class="form-label">Quel type de contenu votre site affichera-t-il ?</label>
                            <select name="language" class="form-control" id="language">
                                @if ($metadata->language =="English")
                                  <option value="English" selected>English</option>
                                @else
                                  <option value="English">English</option>
                                @endif
                                @if ($metadata->language =="French")
                                  <option value="French" selected>French</option>
                                @else
                                  <option value="French">French</option>
                                @endif
                                @if ($metadata->language =="N/A")
                                  <option value="N/A" selected>No Language Tag</option>
                                @else
                                  <option value="N/A">No Language Tag</option>
                                @endif
                                
                                
                            </select>
                          </div>
                        </div>
                        <div class="flex-container">
                          <div style="width: 50%; margin-right: 5px;">
                            <label for="image" class="form-label">Image</label>
                            <input  name="image" class="form-control form-control-sm" type="file" id="image" accept="image/png, image/jpg, image/jpeg">
                          </div>
                          <div class="mb-3" style="width: 50%; margin-left: 5px;">
                                @if ($metadata->image==null)
                                    <img src="/uploads/seo/No_Image_Available.jpg" alt="">
                                @else
                                <img src="/uploads/seo/{{$metadata->image}}" alt="" width="70%" height="150px">
                                @endif
                          </div>
                        </div>
                        
                        
                        <br>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
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