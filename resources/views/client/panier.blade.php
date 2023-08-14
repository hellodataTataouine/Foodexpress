@extends('client.base')

@section('title', 'Welcome')

@section('content')
    <section id="menu" class="menu">
        <div class="container" data-aos="fade-up">

            <div class="container">
                <div class="table-responsive cartTable">
                    <table class="table" id="myTable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Prix</th>
                                <th>Quantité</th>
                                <th>Options</th>
                                <th>Categorie</th>
                                <th colspan="3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                                <tr>
                                    <td>
                                        <a href="{{ asset($item['product']['url_image']) }}" data-toggle="modal" data-target="#imageModal">
                                            <img src="{{ asset($item['product']['url_image']) }}" alt="Product Image" class="zoomable-image" style="width:60px;height:60px;  border-radius: 50%;">
                                        </a>
                                    </td>
                                    <td>{{ $item['product']['nom_produit'] }}</td>
                                    <td>{{ $item['product']['description'] }}</td>
                                    <td>{{ $item['product']['prix'] }}</td>
                                    <td>{{ $item['qte'] }}</td>
                                    <td>
                                        @if(isset($item['product']['options']) && count($item['product']['options']) > 0)
                                        <ul>
                                          @foreach ($item['product']['options'] as $option)
                                            @php
                                              $familleOption = App\Models\FamilleOption::find($option['famille_option_id']);
                                              $familleName = $familleOption ? $familleOption->nom_famille_option : 'N/A';
                                            @endphp
                                            <li>{{ $familleName }}: {{ $option['nom_option'] }}</li>
                                          @endforeach
                                        </ul>
                                      @else
                                        -
                                      @endif

                                    </td>
                                    <td>{{ $item['product']['categorie_id'] }}</td>
                                    <td style="display: flex; justify-content: space-between;">
                                        <form action="{{ route('panier.remove', ['subdomain' => $subdomain, 'productId' => $item['product']['id']]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger delBtn">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    @if (count($cartItems) > 0)
                        <form action="{{ route('panier.confirm', ['subdomain' => $subdomain]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Confirm Panier</button>
                        </form>
                    @else
                        <p>No items in the cart.</p>
                    @endif
                </div>
            </div>

        </div>
    </section><!-- End Menu Section -->
@endsection
