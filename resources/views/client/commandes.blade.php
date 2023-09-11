@include('client.layouts.top_menu_client')
<!-- Aside (Mobile Navigation) -->
@include('client.layouts.header_menu')

<!-- Cart Items Start -->
<div class="section">
    <div class="container">
        <h3>Vos Commandes</h3>
        @if (count($commandes) > 0)
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Restaurant</th>
                        <th>Methode de Paiement</th>
                        <th>Methode de Livraison</th>
                        <th>Prix</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($commandes as $index => $commande)
                        <tr>
                            <td>{{ $commande['created_at'] }}</td>
                            <td>{{ $client->name }}</td>
                            @if($commande['methode_paiement'] == 1)
                                <td>Espece</td>
                            @else
                                <td>Carte Bancaire</td>
                            @endif

                            @if($commande['mode_livraison'] == 1)
                            <td>Sur place</td>
                            @else
                                <td>A domicile</td>
                            @endif

                            <td>{{ $commande['prix_total'] }} DT</td>

                            @if($commande['statut_paiement'] == "Pending")
                            <td><button type="button" class="btn btn-warning">Pending</button></td>
                            @elseif($commande['statut_paiement'] == "Declined")
                                <td><button type="button" class="btn btn-danger">Declined</button></td>
                            @else
                                <td><button type="button" class="btn btn-success">Success</button></td>
                            @endif
                            <td>
                                @php
                                    $sub = request()->getHost();
                                @endphp

                                @if($commande->statut_paiement == "Pending")
                                    <form action="{{ route('client.commande.cancel', ['subdomain' => $sub, 'id' => $commande->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT') <!-- Add this line to override the method and send a PUT request -->
                                        <button type="submit" class="btn btn-danger">Annuler</button>
                                    </form>
                                @endif


                            
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No commandes.</p>
        @endif
    </div>
</div>
<!-- Cart Items End -->

@include('client.layouts.footer_client')
