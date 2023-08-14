@extends('client.base')

@section('title', 'Welcome')

@section('content')
    <!-- ======= Menu Section ======= -->
    <section id="menu" class="menu">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <p>Check Our <span>Menu</span></p>
            </div>

            <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
                @foreach($categories as $category)
                <li class="nav-item">
                    <a class="nav-link{{ $loop->first ? ' active' : '' }}" data-bs-toggle="tab"
                        data-bs-target="#menu-{{ $category->id }}">
                        <h4>{{ $category->name }}</h4>
                    </a>
                </li>
                @endforeach
            </ul>

            <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
                @foreach($categories as $category)
                <div class="tab-pane fade{{ $loop->first ? ' active show' : '' }}" id="menu-{{ $category->id }}">
                    <div class="tab-header text-center">
                        <p>Menu</p>
                        <h3>{{ $category->name }}</h3>
                    </div>
                    <div class="row gy-5">
                        @foreach($category->produits()->paginate(6) as $product)
                        <div class="col-lg-4 menu-item">
                            <a href="{{ asset($product->url_image) }}" class="glightbox">
                                <img src="{{ asset($product->url_image) }}" class="menu-img img-fluid"
                                    alt="" style="border-radius:30%;height:300px;width:500px;">
                            </a>
                            <h4>{{ $product->nom_produit }}</h4>
                            <p class="ingredients">
                                {{ $product->description }}
                            </p>
                            <p class="price">
                                {{ $product->prix }} DT
                            </p>
                            <a href="#" class="btn-book-a-table addToCartBtn"
                                data-toggle="modal" data-target="#productModal"
                                data-product-id="{{ $product->id }}">Add to Panier</a>
                        </div><!-- Menu Item -->
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center" style="margin-top:40px;max-height:30px;">
                        {{ $category->produits()->paginate(6)->links() }}
                    </div>
                </div><!-- End Category Menu Content -->
                @endforeach
            </div>
        </div>

        <!-- Product Details Modal -->
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="productModalLabel">Product Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="productInfo"></div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Menu Section -->
@endsection

@push('scripts')
<script>
    $(function() {
        $('.addToCartBtn').click(function(e) {
            e.preventDefault();
            var productId = $(this).data('product-id');
            var url = '{{ route('panier.getProductDetails', ['subdomain' => $subdomain, 'productId' => ':productId']) }}';
            url = url.replace(':productId', productId);
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    $('#productInfo').html(response);
                }
            });
        });
    });
</script>
@endpush
