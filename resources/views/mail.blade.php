<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Thank you for your order!</h1>
    <p>Dear {{$orderDetails->first()->order->recipient_name}},</p>

    <p>We have received your order with the following details:</p>

    <h3>Order Information:</h3>
    <p><strong>Order Date:</strong> {{ $orderDetails->first()->order->created_at->format('H:i, l, d F Y') }}</p>
    <p><strong>Phone Number:</strong> {{ $orderDetails->first()->order->phone_number }}</p>
    <p><strong>Shipping Address:</strong> {{ $orderDetails->first()->order->shipping_address }}</p>

    <h3>Order Details:</h3>
    <ul>
        @foreach ($orderDetails as $detail)
            <li>
                Product: {{ $detail->product->name }}<br>
                Quantity: {{ $detail->quantity }}<br>
                Price: {{ formatCurrency($detail->price) }}
            </li>
        @endforeach
    </ul>
    
    <p>SubTotal Price: <strong>{{ formatCurrency($orderDetails->first()->order->subtotal) }}</strong></p>
    <p>Discount: 
        <strong>
            {{ formatCurrency($orderDetails->first()->order->discount) }}
            @if($orderDetails->first()->order->type == 'percentage')
                %
            @else
                VND
            @endif
        </strong></p>
    <p>Total Price: <strong>{{ formatCurrency($orderDetails->first()->order->total_price) }}</strong></p>
    <p>Thank you for shopping with us!</p>
</body>
</html>
