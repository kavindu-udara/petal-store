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
                <th scope="col" class="px-6 py-3">
                    Seller name
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    mobile
                </th>
                <th scope="col" class="px-6 py-3">
                    nickname
                </th>
            </tr>
        </thead>
        <tbody>


            @foreach ($sellers as $seller)

            <tr class="bg-white border-b hover:bg-gray-50 ">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                    {{$seller->fname}} {{$seller->lname}}
                </th>
                <td class="px-6 py-4">
                    {{$seller->email}}
                </td>
                <td class="px-6 py-4">
                    {{$seller->mobile}}
                </td>
                <td class="px-6 py-4">
                    {{$seller->shop_name}}
                </td>
            </tr>

            @endforeach

        </tbody>
    </table>
</body>

</html>