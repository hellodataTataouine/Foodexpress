@include('client.layouts.top_menu_client')
<!-- Aside (Mobile Navigation) -->
@include('client.layouts.header_menu')

<!-- Cart Items Start -->
<div class="section">
    <div class="container">
        <div id="container_details">
            <h3>Your Cart</h3>
            @if (count($cartItems) > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Prix unitaire</th>
                           
                            
                            <th>Options</th>
                            <th>Quantity</th>
                            <th>Prix total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $index => $cartItem)
                            <tr data-product-id="{{ $cartItem['id'] }}">
                                <td><img src="{{ asset($cartItem['image']) }}" alt="product"></td>
                                <td>{{ $cartItem['name'] }}</td>
                                <td>{{ $cartItem['unityPrice'] }} £</td>
                               
                                <td>
                                    @if (isset($cartItem['options']))
                                    {!! htmlspecialchars(json_encode($cartItem['options'])) !!}
                                @endif
                                </td>
                                <td>
                                    {{ $cartItem['quantity'] }}
                                <!-- <button class="btn-quantity" data-product="{{ $cartItem['id'] }}" data-action="decrease">-</button>
                                    <input type="number" name="quantity[{{ $cartItem['id'] }}]" id="quantity_{{ $cartItem['id'] }}" value="{{ $cartItem['quantity'] }}" min="1" max="100">
                                    <button class="btn-quantity" data-product="{{ $cartItem['id'] }}" data-action="increase">+</button> -->
                                </td>
                                <td>{{ $cartItem['price'] }} £</td>
                                <td><button class="btn-remove" data-product-id="{{ $cartItem['id'] }}">Annuler</button></td>
                            </tr>
                        @endforeach
                        <tr class="total">
                  <td>
                    <h6 class="mb-0">Grand Total</h6>
                  </td>
                  <td></td>
                  <td> <div class="totalprice"> <span><strong>{{ $totalPrice }} £</strong></span></div></td>
                </tr>
                    </tbody> 
                </table>
                @if (auth('clientRestaurant')->check())


                    <!-- Show the regular checkout form for authenticated users -->
                    <form id="checkoutForm" method="POST" action="{{ url('/checkout') }}">
                        @csrf


                         <!-- Cart Details and Delivery Method -->
  <div id="cartDetailsAndDeliveryMethod" >
    <!-- Show the cart details and delivery method here -->
    @if (count($livraisons) > 0)
        <h3>Choisissez la méthode de livraison</h3>
        <select id="delivery_method" name="delivery_method" class="form-control">
            @foreach ($livraisons as $livraison)
            @if ($livraison)
                @php
                    $livraisonType = \App\Models\Livraison::find($livraison->id);
                @endphp
                <!-- Assuming the name field for delivery method is 'id' -->
                <option value="{{ $livraison->id }}"> {{ $livraisonType->type_methode }}</option>
            @endif
        @endforeach
        </select>
    @endif
    <br>
    </div>

<!-- Payment Method -->
<div id="paymentMethod" >
    @if (count($paiments) > 0)
        <h3>Choisissez le mode de paiement</h3>
        <select name="payment_method" class="form-control">
            @foreach ($paiments as $paiment)
                @php
                    $paimentType = \App\Models\PaimentMethod::find($paiment->id);
                @endphp
                <!-- Assuming the name field for payment method is 'id' -->
                <option value="{{ $paiment->id }}">{{ $paimentType->type_methode }}</option>
            @endforeach
        </select>
    @endif
    <br>
  
   
</div>
                        <!-- Other form fields for delivery method, payment method, etc. -->
                        <button type="submit" form="checkoutForm" class="btn-custom">Confirmer</button>
                        
                        </form>
                @else
              
                <div class="row">
                 <!-- Buyer Info -->
            <h4>Entrer vos détailles</h4>
              
            <div class="col-xl-7">
            <form id="checkoutForm" method="POST" action="{{ url('/checkout') }}">
            @csrf
            <div class="row">
              <div class="form-group col-xl-6">
                <label>Nom <span class="text-danger">*</span></label>
                <input type="text" placeholder="Nom" name="nom" class="form-control" value="" required="">
              </div>
              <div class="form-group col-xl-6">
                <label>Prénom <span class="text-danger">*</span></label>
                <input type="text" placeholder="Prénom" name="prenom" class="form-control" value="" required="">
              </div>
              </div>
             
              <div class="form-group col-xl-12">
                <label> Addresse<span class="text-danger">*</span></label>
                <input type="text" placeholder="Addresse" name="addresse" class="form-control" value="" required="">
              </div>
              <div class="row">
              <div class="form-group col-xl-6">
                <label>Code Postal<span class="text-danger">*</span></label>
                <input type="text" placeholder="Code Postal" name="codePostal" class="form-control" value="">
              </div>
              <div class="form-group col-xl-6">
                <label>Ville <span class="text-danger">*</span></label>
                <input type="text" placeholder="Ville" name="ville" class="form-control" value="" required="">
              </div>
              </div>
              <div class="row">
              <div class="form-group col-xl-6">
                <label>Numéro de téléphone 1<span class="text-danger">*</span></label>
                <input type="text" placeholder="Phone Number" name="num1" class="form-control" value="" required="">
              </div>
              <div class="form-group col-xl-6">
                <label>Numéro de téléphone 2</label>
                <input type="text" placeholder="Phone Number" name="num2" class="form-control" value="" >
              </div>
              </div>
              <div class="row">
              
              <div class="form-group col-xl-12 mb-0">
                <label>Order Notes</label>
                <textarea name="name" rows="5" class="form-control" placeholder="Order Notes (Optional)"></textarea>
              </div>
              <br>
              <div class="form-group">
                <input id="checkbox" name="creer_un_compte" type="checkbox" class="form-control-light">
                <label>Créer un compte</label>
            </div>
            <div id="accountFields" style="display: none;">
                <div class="form-group col-xl-12">
                    <label>Adresse Email  <span class="text-danger">*</span></label>
                    <input type="email" placeholder="Email Address" name="email" class="form-control" value="" >
                </div>
                <div class="form-group">
                    <label>Mot de passe <span class="text-danger">*</span></label>
                 
                    <input id="password" type="password" class="form-control form-control-light" name="password" placeholder="Mot de passe"  autocomplete="new-password">
                </div>
                <div class="form-group">
                    <label>Confirmer votre Mot de passe <span class="text-danger">*</span></label>
                 
                    <input id="password-confirm" type="password" class="form-control form-control-light" name="password_confirmation" placeholder="Confirmation Mot de passe"  autocomplete="new-password">
            </div>
            </div>
        
       
              <p>Vous avez déjà un compte? <a href="{{ route('client.login') }}">Connexion</a> </p>         
                                    
              </div>

  <!-- Cart Details and Delivery Method -->
  <div id="cartDetailsAndDeliveryMethod" >
            <!-- Show the cart details and delivery method here -->
            @if (count($livraisons) > 0)
                <h3>Choisissez la méthode de livraison</h3>
                <select id="delivery_method" name="delivery_method" class="form-control">
                    @foreach ($livraisons as $livraison)
                    @if ($livraison)
                        @php
                            $livraisonType = \App\Models\Livraison::find($livraison->id);
                        @endphp
                        <!-- Assuming the name field for delivery method is 'id' -->
                        <option value="{{ $livraison->id }}"> {{ $livraisonType->type_methode }}</option>
                    @endif
                @endforeach
                </select>
            @endif
            <br>
            </div>
       
        <!-- Payment Method -->
        <div id="paymentMethod" >
            @if (count($paiments) > 0)
                <h3>Choisissez le mode de paiement</h3>
                <select name="payment_method" class="form-control">
                    @foreach ($paiments as $paiment)
                        @php
                            $paimentType = \App\Models\PaimentMethod::find($paiment->id);
                        @endphp
                        <!-- Assuming the name field for payment method is 'id' -->
                        <option value="{{ $paiment->id }}">{{ $paimentType->type_methode }}</option>
                    @endforeach
                </select>
              
            @endif
           
            <br>
          
           
        </div>

              <div class="form-group col-xl-12 mb-0">
              <p class="small">Your personal data will be used to process your order <a class="btn-link" href="#">privacy policy.</a> </p>
            <button type="submit" form="checkoutForm" class="btn-custom">Confirmer</button>
            <br>
            <br />
            </div>
            </form>
              </div>
             
           
     
</form>  

                                                                        
                @endif
            @else
                <p>Aucun article dans le panier.</p>
            @endif
        </div>
        
        </div>  
        
  
</div>

<!-- Cart Details and Delivery Method -->


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // JavaScript to handle form visibility toggling
    const confirmOrderBtn = document.getElementById('confirmOrderBtn');
    const cartDetailsAndDeliveryMethod = document.getElementById('cartDetailsAndDeliveryMethod');
    const confirmDeliveryMethodBtn = document.getElementById('confirmDeliveryMethodBtn');
    const paymentMethod = document.getElementById('paymentMethod');
    const container_details = document.getElementById('container_details');
    const registerAndCheckoutBtn = document.getElementById('registerAndCheckoutBtn');
    const successMessage = document.getElementById('successMessage');




    $(document).ready(function () {
        $(".btn-remove").click(function () {
            var button = $(this); // Get the clicked button
            var row = button.closest("tr");
            var productId = row.attr("data-product-id");
            
            $.ajax({
                url: '{{ route("remove.CartItem", ["subdomain" => $subdomain]) }}',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            productId: productId,
        },
                success: function (response) {
                    // Update the UI and total price based on the response
                    row.remove();
                     // Update the cart item count in the header
     var cartItemCount = $('.cart-item-count');
    cartItemCount.text(response.cartItemCount);
                    var totalPriceElement = $('.totalprice span');
                     // Remove the row from the table
                     totalPriceElement.text(response.totalPrice + '$'); // Update total price
                },
                error: function (error) {
                    console.error('Error removing item:', error);
                    // Handle error gracefully
                }
            });
        });
    $(".btn-quantity").click(handleQuantityUpdate);

    function handleQuantityUpdate(event) {
        const productId = event.target.getAttribute('data-product');
        const action = event.target.getAttribute('data-action');
        const inputElement = document.getElementById('quantity_' + productId);

        let newQuantity = parseInt(inputElement.value);
        if (action === 'increase') {
            newQuantity++;
        } else if (action === 'decrease' && newQuantity > 1) {
            newQuantity--;
        }

        // Update the input element value immediately
        inputElement.value = newQuantity;

        // Send the updated quantity to the server
        updateQuantity(productId, newQuantity);
    }

    function updateQuantity(productId, quantity) {
    fetch('{{ route("update.quantity",["subdomain" => $subdomain]) }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ productId, quantity })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.message);
        // You can update the UI here to reflect the updated quantity in the cart
    })
    .catch(error => {
        console.error(error);
        // Handle any errors that may occur during the update
    });
}
});
$(document).ready(function() {
    // Select the checkbox and the container to show/hide
    var checkbox = $('#checkbox');
    var accountFields = $('#accountFields');

    // Toggle visibility when the checkbox state changes
    checkbox.change(function() {
        if (checkbox.is(':checked')) {
            accountFields.show(); // Show the fields
        } else {
            accountFields.hide(); // Hide the fields
        }
    });
});
   </script>
<!-- Cart Items End -->

@include('client.layouts.footer_client')
