@section('content')
    <div class="container">
        <h1>Panier</h1>

        @if($cartItems && $cartItems->count() > 0)
            <table class="table">
                <!-- Table content goes here -->
            </table>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
@endsection
