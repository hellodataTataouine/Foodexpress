@extends('client.base')
@include('client.layouts.top_menu_client')
<!-- Aside (Mobile Navigation) -->
@include('client.layouts.header_menu')

@section('content')
    <div class="container">
        <h2>Update Profile</h2>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT') // Add this to specify the HTTP method for updating

            <!-- Include form fields for updating profile data -->
            <div class="form-group">
                <label for="ville">Ville</label>
                <input type="text" class="form-control" id="ville" name="ville" value="{{ old('ville', $user->ville) }}">
                <!-- Use old() to retain the previously entered value if there's an error -->
            </div>

            <!-- Include other form fields for updating data -->
            <div class="form-group">
                <label for="Address">Address</label>
                <input type="text" class="form-control" id="Address" name="Address" value="{{ old('Address', $user->Address) }}">
            </div>

            <div class="form-group">
                <label for="codepostal">Code Postal</label>
                <input type="text" class="form-control" id="codepostal" name="codepostal" value="{{ old('codepostal', $user->codepostal) }}">
            </div>

            <div class="form-group">
                <label for="phoneNum1">N° téléphone 1</label>
                <input type="text" class="form-control" id="phoneNum1" name="phoneNum1" value="{{ old('phoneNum1', $user->phoneNum1) }}">
            </div>

            <div class="form-group">
                <label for="phoneNum2">N° téléphone 2</label>
                <input type="text" class="form-control" id="phoneNum2" name="phoneNum2" value="{{ old('phoneNum2', $user->phoneNum2) }}">
            </div>

            <!-- Add more form fields as needed -->

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
@endsection
