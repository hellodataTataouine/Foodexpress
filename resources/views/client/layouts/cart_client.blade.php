<div class="cart-sidebar-wrapper" id="cartSidebarWrapper">
  <aside class="cart-sidebar">
    <div class="cart-sidebar-header">
      <h3>Votre Panier</h3>
      <div class="close-btn cart-trigger close-dark" > <!-- Add ID to the close button -->
   <span></span>
        <span></span>
      </div>
    </div>
    <div class="cart-sidebar-body">
      <div class="cart-sidebar-scroll">
      @php
          $totalPrice = 0; // Initialize total price
        @endphp
        @if(session()->has('cart'))
          @foreach(session('cart') as $index => $cartItem)
            <div class="cart-sidebar-item">
              <div class="media">
                <a href="menu-item-v1.html"><img src="{{ asset($cartItem['image']) }}" alt="product"></a>
                <div class="media-body">
                  <h5> <a href="menu-item-v1.html" title="{{ $cartItem['name'] }}">{{ $cartItem['name'] }}</a> </h5>
                  <span>{{ $cartItem['quantity'] }}x {{ $cartItem['unityPrice'] }}$</span>
                </div>
              </div>
              <div class="cart-sidebar-item-meta">
             
              <span>@if(is_string($cartItem['options']))
            {{ htmlspecialchars($cartItem['options']) }}
            @endif</span>
              </div>
              <div class="cart-sidebar-price">
                {{ $cartItem['price'] }}$
              </div>
              <div class="close-btn " >
                <span></span>
                <span></span>
              </div>
            </div>
            @php
              $totalPrice += $cartItem['price']; // Update total price for each item
            @endphp
          @endforeach
        @else
          <p>No items in the cart.</p>
        @endif
      </div>
    </div>
    <div class="cart-sidebar-footer">
    <h4>Total: <span>{{ $totalPrice }}$</span> </h4>
      <a href="{{ url('/checkout') }}" class="btn-custom">Vérifier</a>
    </div>
  </aside>
  <div class="cart-sidebar-overlay cart-trigger">
  </div>
</div>
<script>
$(document).ready(function() {
  // Function to close the cart sidebar modal
  function closeCartSidebar() {
    $('#cartSidebarWrapper').removeClass('active');
  }

  // Close the cart sidebar when the close button is clicked
  $('#closeCartSidebar').on('click', function() {
    closeCartSidebar();
  });

  // Close the cart sidebar when the cart sidebar overlay is clicked
  $('.cart-sidebar-overlay').on('click', function() {
    closeCartSidebar();
  });
});
</script>