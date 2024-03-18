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
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($commandes as $index => $commande)
                        <tr>
                            <td>{{ $commande['created_at'] }}</td>
                            <td>{{ $client->name }}</td>
                            @if($commande['methode_paiement'] == 1)
                                <td>Espèce</td>
                            @else
                                <td>PayPal</td>
                            @endif

                            @if($commande['mode_livraison'] == 1)
                            		<td>A domicile</td>
                            @elseif($commande['mode_livraison'] == 2)
                             		<td>Pickup</td>
							@else
							   		<td>Sur place</td>
                            @endif

                            <td>{{ $commande['prix_total'] }} €</td>

                            @if($commande['statut'] == "Nouveau")
                            <td><button type="button" class="btn btn-primary">Reçue</button></td>
                            @elseif($commande['statut'] == "En Cours")
                                <td><button type="button" class="btn btn-warning">En cours</button></td>
							@elseif($commande['statut'] == "Annulée")
                                <td><button type="button" class="btn btn-danger">Annulée</button></td>
							@elseif($commande['statut'] == "Livrée")
                                <td><button type="button" class="btn btn-success">Prêt</button></td>
                            @endif
                            <td>
								@php
									$sub = request()->getHost();
								@endphp

														 @if($commande->statut == "Nouveau")
                                                         <form action="/cancel-commande/{{ $commande->id }}" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="new_status" value="annuler">
    <button type="submit" class="btn btn-danger">Annuler</button>
</form>





							@endif
                            
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>Aucune commande.</p>
        @endif
    </div>
</div>
<!-- Cart Items End -->

@include('client.layouts.footer_client')
