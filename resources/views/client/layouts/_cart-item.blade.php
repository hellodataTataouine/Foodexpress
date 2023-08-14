<!-- _cart-item.blade.php -->
<div class="cart-sidebar-item">
    <div class="media">
        <a href="menu-item-v1.html"><img src="{{ asset($cartItem['image']) }}" alt="product"></a>
        <div class="media-body">
            <h5> <a href="menu-item-v1.html" title="{{ $cartItem['name'] }}">{{ $cartItem['name'] }}</a> </h5>
            <span>{{ $cartItem['quantity'] }}x {{ $cartItem['price'] }}$</span>
        </div>
    </div>
    <div class="cart-sidebar-item-meta">
        <!-- Display any additional details for the cart item -->
    </div>
    <div class="-price">
        {{ $cartItem['totalPrice'] }}$
    </div>
    <div class="close-btn">
        <span></span>
        <span></span>
    </div>
</div>
