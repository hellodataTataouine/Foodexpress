<tr>
    <td>
        <a href="{{ asset($produit->url_image) }}" data-toggle="modal" data-target="#imageModal">
            <img src="{{ asset($produit->url_image) }}" alt="Product Image" class="zoomable-image">
        </a>
    </td>
    <td>{{ $produit->nom_produit }}</td>
    <td>{{ $produit->description }}</td>
    <td>{{ $produit->prix }}</td>
    <td>{{ $produit->categories->name }}</td>
    <td>
        <button class="select-btn btn {{ $produit->is_selected ? 'btn-success' : 'btn-danger' }}"
            data-product="{{ $produit->id }}">{{ $produit->is_selected ? 'Selected' : 'Not Selected' }}</button>
    </td>

</tr>
