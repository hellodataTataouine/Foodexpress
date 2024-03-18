@extends('client.layouts.top_menu_client')

 @include('client.layouts.header_menu') 



<style>
    .contact-container {
        font-family: 'Arial', sans-serif;
        max-width: 600px;
        margin: 0 auto;
    }

    .contact-container h1 {
        color: #333;
    }

    .contact-info {
        background-color: #f5f5f5;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .contact-info h2 {
        color: #333;
    }

    .contact-form {
        background-color: #f5f5f5;
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .contact-form h2 {
        color: #333;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        color: #333;
        font-weight: bold;
        display: block;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        transition: border-color 0.2s;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #007bff;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

@section('content')
<div class="container contact-container">
  
    <br>
    <br>
	<br>
	<br>
	<br>
    <h1 class="mb-4">Contactez-Nous</h1>
    <p>N'hésitez pas à nous contacter en utilisant les informations de contact ci-dessous :</p>

    <div class="contact-info">
        <h2>Coordonnées de Contact</h2>
        <p>Adresse : <b>{{ $client->localisation }} </b></p>
        <p>Téléphone : <b>{{ $client->phoneNum1 }} </b></p>
        <p>Email : <b>{{ $user->email }}</b></p>
    </div>

    <div class="contact-form">
        <h2>Formulaire de Contact</h2>
<form action="{{ route('contact.submit', ['subdomain' => $subdomain]) }}" method="post">
            @csrf

            <div class="form-group">
                <label for="name">Nom :</label>
                <input type="text" id="name" name="name" class="form-control" required>
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" class="form-control" required>
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Téléphone :</label>
                <input type="tel" id="phone" name="phone" class="form-control" required>
                @error('phone')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
	
			  <div class="form-group">
				<label for="message">Message :</label>
				<textarea id="message" name="message" class="form-control" rows="4" style="height: 150;" required></textarea>
				@error('message')
				<span class="text-danger">{{ $message }}</span>
				@enderror
			</div>
	
	
            <br>

            <button type="submit" class="btn btn-primary">Envoyer</button>
            <br>
            <br>
            <br>
        </form>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@include('client.layouts.footer_client')