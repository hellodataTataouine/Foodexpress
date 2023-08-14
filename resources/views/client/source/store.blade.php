@extends('base')

@section('title', 'Welcome')

@section('content')
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('left-menu')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('top-menu')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @include('stat')
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <h1>Store</h1>
<!-- Display products -->
@foreach ($products as $product)
<div>
    <h3>{{ $product->name }}</h3>
    <p>{{ $product->description }}</p>
    <p>Price: ${{ $product->price }}</p>
    <form action="{{ route('store.cart.add') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <button type="submit">Add to Cart</button>
    </form>
</div>
@endforeach

<!-- Display cart -->
<h2>Cart</h2>
<ul>
@foreach ($cartItems as $cartItem)
    <li>{{ $cartItem->product->name }} - Quantity: {{ $cartItem->quantity }}</li>
@endforeach
</ul>

<!-- Cart operations -->
<form action="{{ route('store.cart.remove') }}" method="POST">
@csrf
<input type="hidden" name="product_id" value="{{ $product->id }}">
<button type="submit">Remove from Cart</button>
</form>

<form action="{{ route('store.cart.checkout') }}" method="POST">
@csrf
<button type="submit">Checkout</button>
</form>

                           
                        </div>
                    </div>
                </div>
                @include('footer')
            </div>
        </div>
    </div>

    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="" alt="Product Image" class="modal-image">
                </div>
            </div>
        </div>
    </div>
@endsection


