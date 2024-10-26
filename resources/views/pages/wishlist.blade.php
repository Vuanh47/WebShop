@extends('main')

@section('content')
            <!--Wishlist Area Strat-->
    <div class="wishlist-area pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="#">
                        <div class="table-content table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="li-product-remove">remove</th>
                                        <th class="li-product-thumbnail">images</th>
                                        <th class="cart-product-name">Product</th>
                                        <th class="li-product-price">Unit Price</th>
                                        <th class="li-product-stock-status">Stock Status</th>
                                        <th class="li-product-add-cart">add to cart</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($wishlist as $item)
                                    <tr>
                                        <td class="li-product-remove">
                                            <a href="{{ route('wishlist.remove', $item->id) }}"><i class="fa fa-times"></i></a>
                                        </td>
                                        <td class="li-product-thumbnail">
                                            <a href="#"><img src="{{ asset('storage/uploads/' . $item->thumb) }}" alt="{{ $item->name }}" style="width: 80px; height: auto;"></a>
                                        </td>

                                        <td class="li-product-name"><a href="#">{{ $item->name }}</a></td>
                                        <td class="li-product-price"><a href="#">{{ $item->price }}</a></td>

                                        <td class="li-product-stock-status">
                                            <span class="{{ $item->active ? 'in-stock' : 'out-stock' }}">{{ $item->active ? 'In Stock' : 'Out of Stock' }}</span>
                                        </td>
                                        <td class="li-product-add-cart">
                                            <a href="{{ route('cart.add', $item->id) }}">Add to cart</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </form>
                    <div class="pagination-wrapper mt-40 d-flex justify-content-end">
                        {{ $wishlist->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Wishlist Area End-->
@endsection