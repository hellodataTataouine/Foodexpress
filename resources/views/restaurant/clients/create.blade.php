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
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                   
<style>
    .required {
        color: red;
    }
</style>

<h1>Ajouter un client</h1>
<form action="{{ route('clients.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="FirstName">Prénom <span class="required">*</span></label>
        <input type="text" name="FirstName" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="LastName">Nom de famille <span class="required">*</span></label>
        <input type="text" name="LastName" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="ville">Ville <span class="required">*</span></label>
        <input type="text" name="ville" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="Address">Adresse <span class="required">*</span></label>
        <input type="text" name="Address" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="codepostal">Code postal <span class="required">*</span></label>
        <input type="text" name="codepostal" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="phoneNum1">Numéro de téléphone 1 <span class="required">*</span></label>
        <input type="text" name="phoneNum1" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="phoneNum2">Numéro de téléphone 2</label>
        <input type="text" name="phoneNum2" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">Email <span class="required">*</span></label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="Password">Mot de passe <span class="required">*</span></label>
        <input type="password" name="password" class="form-control" required>
    </div>
		<p>Les champs marqués par <span class="required">*</span> sont obligatoires.</p>
    <button type="submit" class="btn btn-primary">Ajouter</button>
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