@include('client.layouts.top_menu_client')
  <!-- Cart Sidebar Start -->
  @include('client.layouts.cart_client')
  <!-- Aside (Mobile Navigation) -->
  @include('client.layouts.header_menu')
  <!-- Banner Start -->
  <style>
    .product-image-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 150px; /* Set the desired height for the image container */
    }
    
    /* Adjust the image size if necessary */
    .product-image-container img {
      max-width: 100%;
      max-height: 100%;
    }
      </style>
  <!-- Banner End -->
 <!-- Customize Modal Start -->
 <div class="modal fade" id="customizeModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header modal-bg">
              <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
            <span></span>
            <span></span>
          </button>
          </div>
          <div class="modal-body">
            <div class="customize-meta">
              <h4 class="customize-title"><span class="custom-primary">Prix total:</span> </h4>
              <p ></p>
            </div>
            <div class="customize-variations">
              <div class="customize-size-wrapper">
                <!-- Size variations -->
              </div>
              <div class="row">
              </div>
              <!-- Other customization options -->
            </div>
            <div class="customize-controls">
              <div class="qty">
                <span class="qty-subtract"><i class="fas fa-minus"></i></span>
              <input type="number"   name="totalquantity"  id="totalquantity" value="1" min="1">
              <span class="qty-add"><i class="fas fa-plus"></i></span>
              </div>
              <div class="customize-total" >
                <h5 >Prix total: <span class="final-price custom-primary"> <span>$</span> </span> </h5>
              </div>
             
            </div>
           </div>
        </div>
      </div>
    </div>
  <!-- Customize Modal End -->
<!-- Menu Categories Start -->
<div class="ct-menu-categories menu-filter">
    <div class="container">
      <div class="menu-category-slider">
        <a href="#" data-filter="*" class="ct-menu-category-item active">
          <div class="menu-category-thumb">
            <img src="{{ asset('uploads/default.png') }}" alt="category">
          </div>
          <div class="menu-category-desc">
            <h6>All</h6>
          </div>
        </a>
        @foreach($categories as $category)
          @if(isset($firstProducts[$category->id]))
              @php
                  $firstProduct = $firstProducts[$category->id];
              @endphp

        <a href="#" data-filter=".{{ $category->id }}" class="ct-menu-category-item">
          <div class="menu-category-thumb">
            <img src="{{ $firstProduct->url_image }}" alt="category">
          </div>
          <div class="menu-category-desc">
            <h6>{{ $category->name }}</h6>
          </div>
        </a>
        @endif
@endforeach
       
      </div>
    </div>
  </div>
  <!-- Menu Categories End -->

  <!-- Menu Wrapper Start -->
  <div class="section section-padding">
    <div class="container">

      <div class="menu-container row">
 <!-- Product Start -->
 @foreach ($paginator as $product)
       
        <!-- Product Start -->
        <div class="col-lg-4 col-md-6 {{ $product->categorie_rest_id}}">
          <div class="product">
            <div class="product-image-container">
              <img src="{{ asset($product->url_image) }}" alt="menu item" class="center"   />
            </div> <div class="product-body">
              <div class="product-desc">
                <h4> <a href="menu-item-v1.html">{{ $product->nom_produit }}</a> </h4>
                <p>{{ $product->description }}</p>
                <p class="product-price">{{ $product->prix }} €</p>
                <div class="favorite">
                  <i class="far fa-heart"></i>
                </div>
              </div>
              <div class="product-controls">
                <a href="#" class="order-item btn-custom btn-sm shadow-none" data-product-id="{{ $product->id }}" data-product-name="{{ $product->nom_produit }}" data-product-image="{{ asset($product->url_image) }}" data-product-price="{{ $product->prix }}">Commander <i class="fas fa-shopping-cart"></i> </a>
                <a class="btn-custom secondary btn-sm shadow-none customizeBtn" data-bs-toggle="modal" data-bs-target="#customizeModal" data-product-id="{{ $product->id }}" data-product-name="{{ $product->nom_produit }}" data-product-image="{{ asset($product->url_image) }}" data-product-price="{{ $product->prix }}">Personnaliser <i class="fas fa-plus"></i></a>
               </div>
            </div>
          </div>
        </div>
        @endforeach
        <!-- Product End -->

      </div>
    </div>
  </div>
  <!-- Menu Wrapper End -->
  <!-- Newsletter start -->

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
$(document).ready(function() {
  $('.order-item').click(function(event) {
    console.log("Button clicked!");
    event.preventDefault();
    // Retrieve the product data from the clicked button
    
    var productId = $(this).data('product-id');
    var productName = $(this).data('product-name');
    var productImage = $(this).data('product-image');
    var productPrice = $(this).data('product-price');
    var productUnityPrice = $(this).data('product-price');
    var productQuantity = 1 ;
    // Construct the cart item data to send to the server
    var cartItem = {
      id: productId,
      name: productName,
      image: productImage,
      price: productPrice,
      unityPrice: productUnityPrice,
      quantity: productQuantity,
     options: {}
    };
    // Retrieve the selected customization options, if any
   // var customizationOptions = getSelectedOptions(); // Implement the logic to retrieve the selected options
   // cartItem.customizationOptions = customizationOptions;

    // Send a POST request to the server using AJAX
    addToCart(cartItem);
  });

  // Function to update the cart sidebar
  function addToCart(cartItem) {
    $.ajax({
      url: '{{ route("cart.add", ["subdomain" => $subdomain]) }}',
      method: 'POST',
      data: {
        cartItem: cartItem,
        _token: '{{ csrf_token() }}'
      },
      success: function(response) {
        // Update the cart sidebar with the updated cart data
        updateCartSidebar();
        // Show a success message or update the cart icon, etc.
     
        //alert('Product added to cart successfully'); // You can use your preferred success message here
      $('#customizeModal').modal('hide'); // Close the customize modal

      },
      error: function(error) {
        // Handle the error response from the server
        console.error('Error adding product to cart:', error);
        // Show an error message or handle the error gracefully
      }
    });
  }
  function updateCartSidebar() {
    var timestamp = new Date().getTime();
  
// Make an AJAX request to fetch the updated cart data
$.ajax({
  url: '{{ route("cart.fetch", ["subdomain" => $subdomain]) }}?timestamp=' + timestamp,
  method: 'GET',
  success: function(response) {
    console.log(response);
    
  // Update the cart sidebar with the updated cart items
var cartSidebarScroll = $('.cart-sidebar-scroll');
cartSidebarScroll.empty(); // Clear existing content

// Loop through the cart items and add them to the sidebar
$.each(response.cartItems, function(index, cartItem) {
    var itemHTML = '<div class="cart-sidebar-item">';
    itemHTML += '<div class="media">';
    itemHTML += '<a href="menu-item-v1.html"><img src="' + cartItem.image + '" alt="product"></a>';
    itemHTML += '<div class="media-body">';
    itemHTML += '<h5><a href="menu-item-v1.html" title="' + cartItem.name + '">' + cartItem.name + '</a></h5>';
    itemHTML += '<span>' + cartItem.quantity + 'x ' + cartItem.unityPrice + '€</span>';
    itemHTML += '</div></div>';
    itemHTML += '<div class="cart-sidebar-item-meta">';
    itemHTML += '<span>' + (cartItem.options || '') + '</span>';
    itemHTML += '</div>';
    itemHTML += '<div class="cart-sidebar-price">';
    itemHTML += cartItem.price + '€';
    itemHTML += '</div>';
    itemHTML += '<div class="remove-btn" data-item-id="' + cartItem.id + '">';
    itemHTML +=  '<i class="fas fa-times"></i>';
    itemHTML += '<span></span><span></span>';
    itemHTML += '</div></div>';

    cartSidebarScroll.append(itemHTML);
});
 // Update the cart item count in the header
 var cartItemCount = $('.cart-item-count');
cartItemCount.text(response.cartItemCount);

var totalPriceElement = $('.cart-sidebar-footer span');
totalPriceElement.text(response.totalPrice + '€');
    // Show the cart sidebar
    $('#cartSidebarWrapper&').addClass('active');
   // location.reload();
  },
  error: function(error) {
    // Handle the error response from the server
    console.error('Error fetching cart data:', error);
    // Show an error message or handle the error gracefully
  }
});
} 
});

</script>
  <script>
    var response; // Global variable to store the response object
  
    $(document).ready(function() {
      $('.customizeBtn').click(function() {
        var productId = $(this).data('product-id');
   
        $.ajax({
          url: '/panier/getProductRestaurantDetails/' + productId,
          method: 'GET',
          success: function(res) {
            response = res; // Store the response in the global variable
            var selectedOptions = {};
            $('.customize-title').empty();
            $('.customize-meta p').empty();
            $('.modal-header').empty();
            $('.customize-variations').empty();
            $('.custom-primary').empty();
            $('.final-price.custom-primary').empty();
            // Update the modal content with the returned data
            $('.customize-title').html(response.product.nom_produit + ' <span class="custom-primary">'  + response.product.prix + '€</span>');
            $('.customize-meta p').text(response.product.description);
  
            // Update the background image
            $('.modal-header').css('background-image', 'url("' + response.product.url_image + '")');
  
           
           $('.customize-variations').empty();
            for (var i = 0; i < response.familleOptions.length; i++) {
              var familleOption = response.familleOptions[i];
              var options = familleOption.options;
  
              if (i % 3 === 0) {
                // Create a new row
                var row = $('<div class="row"></div>');
                row.appendTo('.customize-variations');
              }
  
              var variationElement = $('<div class="col-lg-4 col-12"></div>');
              var variationWrapper = $('<div class="customize-variation-wrapper"></div>');
              var variationTitle = $('<h5>' + familleOption.famille_option.nom_famille_option + '</h5>');
  
              variationTitle.appendTo(variationWrapper);
              variationWrapper.appendTo(variationElement);



              

              for (var j = 0; j < options.length; j++) {
                let option = options[j]; // Use let instead of var to correctly scope the variable
 
                var variationItem = $('<div class="customize-variation-item" data-price="' + option.prix + '"></div>');
                var variationIcon = $('<i class="flaticon-bread-roll"></i>');
            
                var customControl = $('<div class="custom-control custom-' + (familleOption.famille_option.type === 'simple' ? 'radio' : 'checkbox') + '"></div>');
                var inputType = familleOption.famille_option.type === 'simple' ? 'radio' : 'checkbox';

   // Store the type of the option (checkbox or qte) in the selectedOptions object
   selectedOptions[option.id] = {
    name: option.nom_option,
    price: option.prix,
    type: familleOption.famille_option.type,
  };
                if (familleOption.famille_option.type === 'qte') {
  inputType = 'number';
  var input = $('<input type="' + inputType + '" id="' + option.id + '" name="quantity" class="custom-control-input">');
  // For "qte" type options, attach an event handler to update the quantity
  input.on('input', function() {
      var quantity = parseInt($(this).val(), 10) || 1; // Ensure a valid integer (default to 1 if invalid)
      var input = $('<input type="' + inputType + '" id="' + option.id + '" name="quantity" class="custom-control-input">');
 
      input.attr('data-option-id', option.id); // Set a data-* attribute to store option.id on the input element

  // For "qte" type options, attach an event handler to update the quantity
  input.on('input', function() {
    var optionId = $(this).data('option-id'); // Retrieve option.id from the data-* attribute
    var quantity = parseInt($(this).val(), 10) || 1; // Ensure a valid integer (default to 1 if invalid)

    // Update the quantity in the selectedOptions object using optionId
    selectedOptions[optionId].quantity = quantity;
  });
    });
} else {
  var input = $('<input type="' + inputType + '" id="' + option.id + '" name="' + familleOption.id + '" class="custom-control-input">');
 
  }
 if (inputType === 'radio') {
    input.prop('checked', false); // Set radio buttons to unchecked initially
    input.on('click', function() {
      if ($(this).prop('checked')) {
        $('input[name="' + familleOption.id + '"]').prop('checked', false);
        $(this).prop('checked', true);
      }  });
  }



  var label = $('<label class="custom-control-label" for="' + option.id + '"> ' + option.nom_option + ' </label>');
                var price = $('<span> +' + option.prix + '€ </span>');
  
                input.appendTo(customControl);
                label.appendTo(customControl);
                customControl.appendTo(variationItem);
                price.appendTo(variationItem);
                variationIcon.appendTo(variationWrapper);
                variationItem.appendTo(variationWrapper);


              }
  
              variationElement.appendTo(row);
            }
            var customizeControls = $('.customize-controls');
       
           var quantityLabel = $('.qty');
//var quantityLabel = $('<div class="qty"></div>');
var subtractButton = $('.qty-subtract');
//var quantityInput = $('<input type="number" name="totalquantity"  id="totalquantity" value="1">');
var addButton  = $('.qty-add');





var priceLabel = $('.customize-total');
    $('.final-price.custom-primary').text( response.product.prix + '€' );
          

addButton.off('click');
subtractButton.off('click');

//action
addButton.on('click', function() {
  var totalquantityInput = $(this).siblings('input[name="totalquantity"]');
  var currentQuantity = parseInt(totalquantityInput.val());
  if (!isNaN(currentQuantity)) {
    totalquantityInput.val(currentQuantity + 1);
    updateTotalPrice(); 
  }
});
subtractButton.on('click', function() {
  var totalquantityInput = $(this).siblings('input[name="totalquantity"]');
  var currentQuantity = parseInt(totalquantityInput.val());
  if (!isNaN(currentQuantity) && (currentQuantity > 1)) {
    totalquantityInput.val(currentQuantity - 1);
    updateTotalPrice(); 
  }
});
$('.modal-body .order-item.btn-custom.btn-sm.shadow-none.customizeBtn').remove();
var addToCartBtn = $('<a class="order-item btn-custom btn-sm shadow-none customizeBtn" data-product-id="' + productId + '" data-product-name="' + response.product.nom_produit + '" data-product-image="' + response.product.url_image + '" data-product-price="' + response.product.prix + '">Add to Panier <i class="fas fa-shopping-cart"></i></a>');
addToCartBtn.appendTo('.modal-body');
        // Calculate and update the total price
            updateTotalPrice();
           
            // Show the modal
            $('#customizeModal').on('shown.bs.modal', function() {
    initializeTotalQuantity();
  });
            $('#customizeModal').modal('show');
          },
          error: function(err) {
            console.log(err);
          }
        });
      });
      selectedOptions = [];
         $(document).on('change', '.customize-variation-wrapper input[type="checkbox"], .customize-variation-wrapper input[type="radio"], .customize-variation-wrapper input[type="number"], .customize-variations #totalquantity', function() {
  // Clear the selectedOptions array to start fresh
  selectedOptions = [];
// Loop through the selected options to store their details
$('.customize-variation-wrapper input[type="checkbox"]:checked, .customize-variation-wrapper input[type="radio"]:checked').each(function() {
        var optionId = $(this).attr('id');
        var optionName = $(this).siblings('label').text();
        var optionPrice = parseFloat($(this).closest('.customize-variation-item').data('price'));
        var optionType = $(this).attr('type');
        var optionQuantity = 1;

        selectedOptions.push({
            id: optionId,
            name: optionName,
            price: optionPrice,
            type: optionType,
			Quantity: optionQuantity,
        });
      
    });
    
    $('.customize-variation-wrapper input[name="quantity"]').each(function() {

     
      var quantityInput = $(this);
  var optionItem = quantityInput.closest('.customize-variation-item');
  var optionPrice = parseFloat(optionItem.data('price'));

  var quantity = parseInt(quantityInput.val());

  if(quantity >= 1){
      var optionId = $(this).attr('id');
        var optionName = $(this).siblings('label').text();
        var optionPrice = parseFloat(optionItem.data('price'));
        var optionType = $(this).attr('type');
        var optionQuantity = quantity;

  // Push the selected option's details into the selectedOptions array
        
  selectedOptions.push({
            id: optionId,
            name: optionName,
            price: optionPrice,
            type: optionType,
			      Quantity: optionQuantity,
        });
  }
    });
   
   
 // Handle quantity input if present
 var totalQuantity = parseInt($('#totalquantity').val());
    if (isNaN(totalQuantity) || totalQuantity < 1) {
        totalQuantity = 1;
    }
          // Calculate and update the total price
  updateTotalPrice();
 
      });
  
    


      // Function to calculate and update the total price
      function updateTotalPrice() {
        var totalPrice = parseFloat(response.product.prix);
        console.log('Total Price:', totalPrice);

        // Loop through the selected options
        $('.customize-variation-wrapper input[type="checkbox"]:checked, .customize-variation-wrapper input[type="radio"]:checked').each(function() {
          var optionPrice = parseFloat($(this).closest('.customize-variation-item').data('price'));
          totalPrice += optionPrice;
        });
  
     // Handle quantity for options
var optionQuantity = 0;
var optionQuantityPrice = 0;

$('.customize-variation-wrapper input[name="quantity"]').each(function() {
  var quantityInput = $(this);
  var optionItem = quantityInput.closest('.customize-variation-item');
  var optionPrice = parseFloat(optionItem.data('price'));

  var quantity = parseInt(quantityInput.val());
  if (isNaN(quantity) || quantity < 1) {
    quantity = 0;
  }


  //optionQuantity += quantity;
  optionQuantityPrice += optionPrice * quantity;
  console.log('Option Quantity:', quantity);
});
totalPrice += optionQuantityPrice;


console.log('Option Quantity Price:', optionQuantityPrice);

  // Handle quantity for total price
  var totalPriceQuantity = 1;
  var totalPriceQuantityInput = $('#totalquantity');
  if (totalPriceQuantityInput.length > 0) {
    totalPriceQuantity = parseInt(totalPriceQuantityInput.val());
    if (isNaN(totalPriceQuantity) || totalPriceQuantity < 1) {
      totalPriceQuantity = 1;
    }
  }


 

  // Update the total price based on the quantities
  totalPrice *= totalPriceQuantity;

  //var addToCartBtn = $('.order-item');
   // addToCartBtn.attr('data-product-price', totalPrice);
        // Update the total price display
        $('.total-price').html(totalPrice + '€');
       
        var priceTotal = $('.final-price.custom-primary');
        priceTotal.text(totalPrice.toFixed(2) + '€');
      
      }


      
      $('.close-btn').on('click', function() {
    $('#customizeModal').modal('hide');

  });
  
  function initializeTotalQuantity() {
    var totalquantityInput = $('#totalquantity');
    totalquantityInput.val('1');
  }
});


$(document).ready(function() {
 
  // Existing code...
  $(document).on('click', '.order-item.btn-custom.btn-sm.shadow-none.customizeBtn', function() {
  console.log("Button clicked!"); // Add this line to check if the button is triggering the click event
  
  // Retrieve the selected customization options, product ID, name, and price
  var priceTotal = $('.final-price.custom-primary');
  var productId = response.product.id; 
  var productName = response.product.nom_produit;
  var productImage = response.product.url_image;
  var productPrice =  parseFloat(priceTotal.text().replace('€', ''));
  var productUnityPrice = response.product.prix;
  var productQuantity = $('#totalquantity').val();
  var customizationOptions = getSelectedOptions(); // Implement the logic to retrieve the selected options

  // Construct the cart item data to send to the server
  var cartItem = {
    id: productId,
    name: productName,
    image: productImage,
    price: productPrice,
    unityPrice: productUnityPrice,
    quantity: productQuantity,
    options: customizationOptions
  };

    // Send a POST request to add the item to the cart
    addToCart(cartItem);
    selectedOptions = [];
      // After adding the item, update the cart sidebar and cart item count in the header
     // updateCartSidebar();
  });


  function addToCart(cartItem) {
    $.ajax({
      url: '{{ route("cart.add", ["subdomain" => $subdomain]) }}',
      method: 'POST',
      data: {
        cartItem: cartItem,
        _token: '{{ csrf_token() }}'
      },
      success: function(response) {
        // Update the cart sidebar with the updated cart data
        updateCartSidebar();
        // Show a success message or update the cart icon, etc.
     
        //alert('Product added to cart successfully'); // You can use your preferred success message here
      $('#customizeModal').modal('hide'); // Close the customize modal

      },
      error: function(error) {
        // Handle the error response from the server
        console.error('Error adding product to cart:', error);
        // Show an error message or handle the error gracefully
      }
    });
  }

  
  function getSelectedOptions() {
     
     
  var designation = '';
  selectedOptions.forEach(function(option) {
    var optionId = option.id;
    var optionName = option.name;
    var optionPrice = option.price;
    var optionType = option.type;
    var optionQuantity = option.Quantity;
    if (optionType === 'number') {
        designation += optionQuantity  + '×' + optionName   + '(' + optionPrice + '€), ';
    } else {
        designation += optionName + '('+ optionPrice + '€), ' 
    }
});

      // Remove the trailing comma and space from the designation string
      designation = designation.slice(0, -2);
    
      return designation;
  
  }
});
function updateCartSidebar() {

  $('body').addClass('disable-interaction');
    // Make an AJAX request to fetch the updated cart data
    $.ajax({
      url: '{{ route("cart.fetch", ["subdomain" => $subdomain]) }}',
      method: 'GET',
      success: function(response) {
        $('body').removeClass('disable-interaction');
        console.log(response);
        



      // Update the cart sidebar with the updated cart items
    var cartSidebarScroll = $('.cart-sidebar-scroll');
    cartSidebarScroll.empty(); // Clear existing content

    // Loop through the cart items and add them to the sidebar
    $.each(response.cartItems, function(index, cartItem) {
    var itemHTML = '<div class="cart-sidebar-item">';
    itemHTML += '<div class="media">';
    itemHTML += '<a href="menu-item-v1.html"><img src="' + cartItem.image + '" alt="product"></a>';
    itemHTML += '<div class="media-body">';
    itemHTML += '<h5><a href="menu-item-v1.html" title="' + cartItem.name + '">' + cartItem.name + '</a></h5>';
    itemHTML += '<span>' + cartItem.quantity + 'x ' + cartItem.unityPrice + '€</span>';
    itemHTML += '</div></div>';
    itemHTML += '<div class="cart-sidebar-item-meta">';
    
    // Check if cartItem.options is a non-empty string
    if (typeof cartItem.options === 'string' && cartItem.options.trim() !== '') {
        itemHTML += '<span>' + cartItem.options + '</span>';
    }
    
    itemHTML += '</div>';
    itemHTML += '<div class="cart-sidebar-price">';
    itemHTML += cartItem.price + '€';
    itemHTML += '</div>';
    itemHTML += '<div class="remove-btn" data-item-id="' + cartItem.id + '">';
    itemHTML +=  '<i class="fas fa-times"></i>';
    itemHTML += '<span></span><span></span>';
    itemHTML += '</div></div>';

    cartSidebarScroll.append(itemHTML);
});
     // Update the cart item count in the header
     var cartItemCount = $('.cart-item-count');
    cartItemCount.text(response.cartItemCount);

    var totalPriceElement = $('.cart-sidebar-footer span');
totalPriceElement.text(response.totalPrice + '€');
        // Show the cart sidebar
        $('#cartSidebarWrapper&').addClass('active');
      },
      error: function(error) {
        // Handle the error response from the server
        console.error('Error fetching cart data:', error);
        $('body').removeClass('disable-interaction');
        // Show an error message or handle the error gracefully
      }
    });
  } 
  </script>
  <!-- Newsletter End -->
  @include('client.layouts.footer_client')