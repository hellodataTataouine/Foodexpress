@include('client.layouts.top_menu_client')
<!-- Aside (Mobile Navigation) -->
@include('client.layouts.header_menu')

<!-- Cart Items Start -->
<div class="section">
    <div class="container">
        @if (Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif
		<br>
		<br>
		<br>
		<br>
       
            <p>Votre Commande est confirmée, merci pour votre confiance.</p>
    </div>
</div>
<!-- Cart Items End -->

@include('client.layouts.footer_client')
