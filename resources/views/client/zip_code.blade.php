@include('client.layouts.top_menu_client')
  <!-- Aside (Mobile Navigation) -->
  @include('client.layouts.header_menu')
  <!-- Banner Start -->
    <h1>Restaurant</h1>

    <form action="{{ route('restaurant.check-zipcode', ['clientId' => $clientId]) }}" method="POST">
        @csrf
        <label for="zipcode">Enter your zip code:</label>
        <input type="text" id="zipcode" name="zipcode" required>
        <button type="submit">Access the Shop</button>
    </form>

    <script src="{{ asset('js/app.js') }}"></script>
@include('client.layouts.footer_client')
