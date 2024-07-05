<!DOCTYPE html>
<html>

<head>
    <title>placed orders</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border: 1px solid #dddddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>{{ $title }}</h1>
    <p>Date: {{ $date }}</p>
    <p>Time: {{ $time }}</p>
    <table>
        <thead>
            <tr>
                <th>Order Id</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Address</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($orders as $order)

            <tr>
                <td scope="row">
                    {{$order->order_id}}
                </td>
                <td class="px-6 py-4">
                    @foreach ($allProducts as $allProduct)
                    @if ($allProduct->id==$order->product_id)
                    {{$allProduct->title}}
                    @endif
                    @endforeach
                </td>
                <td class="px-6 py-4">
                    @foreach ($allProducts as $allProduct)
                    @if ($allProduct->id==$order->product_id)
                    Rs.{{$allProduct->price}}.00
                    @endif
                    @endforeach
                </td>
                <td class="px-6 py-4">
                    {{$order->qty}}
                </td>
                <td class="px-6 py-4">
                    {{$userAddress[0]->line}}
                </td>
                <td class="px-6 py-4">
                    {{$order->created_at}}
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</body>

</html>