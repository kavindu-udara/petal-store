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
                    Buyer name
                </th>
                <th scope="col">
                    Email
                </th>
                <th scope="col">
                    mobile
                </th>
                <th scope="col">
                    subscribed
                </th>
            </tr>
        </thead>
        <tbody>


            @foreach ($users as $user)

            <tr class="bg-white border-b hover:bg-gray-50 ">
                <th scope="row">
                    {{$user->fname}}
                </th>
                <td>
                    {{$user->email}}
                </td>
                <td>
                    {{$user->mobile}}
                </td>
                <td class="px-6 py-4">
                    @if ($user->emailMe == 'false')
                    <span class="text-red-300">Not Subscribed</span>
                    @else
                    <span class="text-emerald-300">Subscribed</span>
                    @endif
                </td>
            </tr>



            @endforeach

        </tbody>
    </table>
</body>

</html>