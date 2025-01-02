@extends('pages.mainprofile')

@section('content_profile')
<div class="container m-2">

  @include('admin.alert')
  @foreach ($orders as $orderID => $orderDetails)
  <div class="product-card" style="width: 800px; height: auto; margin-bottom: 15px; border: 1px solid #ddd; padding: 20px; border-radius: 10px; background-color: #f9f9f9;">
    <div class="product-header d-flex justify-content-between align-items-center mb-3">
      <div>
        @foreach ($orderDetails as $detail)
        <form action="{{ route('wishlist.store', $detail->product->id) }}" method="POST" style="display: inline;">
          @csrf
          <button class="btn btn-warning" type="submit" style="cursor: pointer;">
            <i class="fa fa-heart" style="color:#fff"></i>Wishlist
          </button>
        </form>
        @endforeach
        <span class="ms-3">
          <strong>Order ID:</strong> {{ $orderID }}
        </span>
      </div>
      <div>
        <p class="mb-0">
          <span><strong>Order Date:</strong></span>
          <span class="float-end">{{ $orderDetails->first()->order->created_at }}</span>
        </p>
        <p class="mb-0">
          <strong>Shipping Status:</strong>
          <span class="badge bg-warning text-dark custom-badge">
            {{ $orderDetails->first()->order->shipping_status }}
          </span>
        </p>
      </div>
    </div>

    @foreach ($orderDetails as $detail)
    <div class="product-details d-flex mb-3">
      <img alt="{{ $detail->product->name }}" height="100" src="/storage/uploads/{{ $detail->product->thumb }}" width="100" />
      <div class="product-info ms-3">
        <h5>
          <a href="{{ route('details', $detail->product->id) }}" class="text-dark">{{ $detail->product->name }}</a>
        </h5>
        <p>Category: {{ $detail->product->category }}</p>
        <p>x{{ $detail->quantity }}</p>
      </div>
      <div class="text-end ms-auto">
        <p class="text-muted">
          <del>{{ number_format($detail->product->price, 0, ',', '.') }}₫</del>
          <span class="text-danger">{{ number_format($detail->product->price_sale, 0, ',', '.') }}₫</span>
        </p>
      </div>
    </div>
    @endforeach

    <div class="product-footer d-flex justify-content-between align-items-center">
      <div>
        <button class="btn btn-danger btn-sm">
          Rate
        </button>
        <button class="btn btn-outline-secondary btn-sm">
          Contact Seller
        </button>
        <button class="btn btn-outline-secondary btn-sm">
          Buy Again
        </button>
      </div>
      <div class="text-danger mb-0">
        <div>
          <strong>Subtotal:</strong> <span>{{ number_format($orderDetails->first()->order->subtotal, 0, ',', '.') }}₫</span>
        </div>
        <div>
          <strong>Discount:</strong> <span>
            @if($orderDetails->first()->order->type == 'percentage')
            {{ $orderDetails->first()->order->discount }} %
            @else
            {{ formatCurrency($orderDetails->first()->order->discount) }}
            @endif
          </span>
        </div>
        <div>
          <strong>Total Amount:</strong> <span>{{ number_format($orderDetails->first()->order->total_price, 0, ',', '.') }}₫</span>
        </div>
      </div>
    </div>
  </div>
  @endforeach
  <!-- Hiển thị phân trang -->
  <div class="d-flex justify-content-end m-3">
    {{ $orders->links() }}
  </div>
</div>

@endsection

@section('header')
<style>
  /* Improve title style */
  h2 {
    font-size: 2rem;
    font-weight: bold;
    color: #333;
  }

  p.text-center {
    font-size: 1.1rem;
    color: #666;
  }

  /* Improve product-card style */
  .product-card {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }

  /* Style for product-header */
  .product-header .btn-danger {
    padding: 5px 10px;
    font-size: 0.9rem;
  }

  /* Style for product-info */
  .product-info h5 {
    font-size: 1.1rem;
    font-weight: 500;
  }

  .product-info p {
    font-size: 0.9rem;
    color: #555;
  }

  /* Style for product-footer */
  .product-footer .text-danger {
    font-size: 1rem;
    font-weight: 600;
  }
</style>
@endsection