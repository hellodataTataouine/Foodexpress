@include('client.layouts.top_menu_client')
@include('client.layouts.header_menu')
@include('client.layouts.cart_client')
<div class="container">
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
    <h1>Modifier Compte</h1>
    <form method="POST" action="{{ route('updateProfile', ['subdomain' => $subdomain]) }}">

        @csrf
        @method('PUT')

        <!-- Add input fields for user information here -->
        <!-- <div class="form-group">
            <label for="nom">Email</label>
            <input type="text" name="email" id="email" value="{{ $newuser->email }}" class="form-control" required="">
        </div>
        <div class="form-group">
            <label for="nom">password</label>
            <input type="text" name="password" id="password" value="{{ $newuser->password }}" class="form-control" required="">
        </div>-->
        
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="FirstName" id="FirstName" value="{{ $newuser->FirstName }}" class="form-control" required="" readonly>
        </div>
        <div class="form-group">
            <label for="nom">Prénom</label>
            <input type="text" name="LastName" id="LastName" value="{{ $newuser->LastName }}" class="form-control" required="" readonly>
        </div>
        <div class="form-group">
            <label for="nom">Email</label>
            <input type="text" name="email" id="email" value="{{ $newuser->email }}" class="form-control" required=""readonly>
        </div>
        <div class="form-group">
            <label for="nom">Ville</label>
            <input type="text" name="ville" id="ville" value="{{ $newuser->ville }}" class="form-control" required="">
        </div>
        <div class="form-group">
            <label for="nom">Adresse</label>
            <input type="text" name="Address" id="Address" value="{{ $newuser->Address }}" class="form-control" required="">
        </div>
        <div class="form-group">
            <label for="nom">CodePostal</label>
            <input type="text" name="codepostal" id="codepostal" value="{{ $newuser->codepostal }}" class="form-control" required="">
        </div>
        <div class="form-group">
            <label for="nom">Numéro Téléphone 1 </label>
            <input type="text" name="phoneNum1" id="phoneNum1" value="{{ $newuser->phoneNum1 }}" class="form-control" required="">
        </div>
        <div class="form-group">
            <label for="nom">Numéro Téléphone 2 </label>
            <input type="text" name="phoneNum2" id="phoneNum2" value="{{ $newuser->phoneNum2 }}" class="form-control" >
        </div>
        
       
        <!-- Repeat similar fields for other user information -->

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Valider</button>
        </div>
    </form>
</div>
@include('client.layouts.footer_client')
