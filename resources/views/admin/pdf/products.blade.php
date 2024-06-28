<!DOCTYPE html>
<html>

<head>
    <title>Laravel PDF</title>
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
                <th scope="col">
                    Product name
                </th>
                <th scope="col">
                    Category
                </th>
                <th scope="col">
                    Qty
                </th>
                <th scope="col">
                    Seller
                </th>
                <th scope="col">
                    Unit Price
                </th>
            </tr>
        </thead>
        <tbody>


            @foreach ($products as $product)

            <tr>
                <th scope="row">
                    {{$product->title}}
                </th>
                <td>
                    @foreach ($categories as $category)

                    @if ($category->id == $product->category_id)
                    {{$category->name}}
                    @endif

                    @endforeach
                </td>
                <td>
                    {{$product->qty}}
                </td>
                <td>
                    @foreach ($sellers as $seller)

                    @if ($seller->id == $product->seller_id)
                    {{$seller->fname}}
                    @endif

                    @endforeach
                </td>
                <td>
                    Rs.{{$product->price}}.00
                </td>
            </tr>

            @endforeach

        </tbody>
    </table>
</body>

</html>