<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>foodexpress.site</title>

  <!-- Vendor Stylesheets -->
  <link rel="stylesheet" href="{{ asset('assetsClients/css/plugins/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assetsClients/css/plugins/animate.min.css') }}">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
  <link rel="stylesheet" href="{{ asset('assetsClients/css/plugins/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('assetsClients/css/plugins/slick-theme.css') }}">
  <!-- Icon Fonts -->
  <link rel="stylesheet" href="{{ asset('assetsClients/fonts/flaticon/flaticon.css') }}">
  <link rel="stylesheet" href="{{ asset('assetsClients/fonts/font-awesome/css/all.min.css') }}">

  <!-- Slices Style sheet -->
  <link rel="stylesheet" href="{{ asset('assetsClients/css/style.css') }}">
  <!-- Favicon -->
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assetsClients/css/plugins/bootstrap.min.css') }}favicon.ico">

</head>

<body> 
	@php
    $livraisonExists = false; // Flag to check if Livraison method exists
@endphp

@foreach ($livraisons as $livraison)
    @if ($livraison)
        @php
            $livraisonType = \App\Models\Livraison::find($livraison->livraison_id);
            if ($livraisonType->methode == "Livraison") {
                $livraisonExists = true; // Set flag if Livraison method exists
            }
        @endphp
    @endif
@endforeach

@if ($livraisonExists)
    @include('client.layouts.popup_client')
@endif      

  <!-- Preloader Start -->
  <div class="ct-preloader">
    <div class="ct-preloader-inner">
      <div class="lds-ripple"><div></div><div></div></div>
    </div>
  </div>
  <!-- Preloader End -->