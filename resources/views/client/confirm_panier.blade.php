@extends('client.base')

@section('content')
    <h1>Confirmer Panier</h1>

    <p>Are you sure you want to confirm your panier?</p>

    <form action="{{ route('panier.confirm') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Confirmer Panier</button>
    </form>
@endsection
