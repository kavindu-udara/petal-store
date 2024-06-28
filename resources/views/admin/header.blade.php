<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <!-- tailwind css -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- tailwind css -->
    @vite('resources/css/app.css')
    <!-- font awesome icons -->
    <link rel="stylesheet" href="{{asset('/font-awesome-4.7.0/css/font-awesome.min.css')}}">
</head>

<body>

    <nav class="bg-white  w-full z-20 top-0 start-0 border-b border-gray-200">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="./seller.php" class="flex items-center space-x-3 rtl:space-x-reverse">
                <div class="text-center text-3xl font-bold text-emerald-800">
                    <div class="cursor-pointer">Petal Hut</div>
                </div>
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <a href="{{route('admin.logout')}}">Logout</a>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 ">
                    <li>
                        <a href="{{route('admin.dashboard')}}" class="block py-2 px-3 text-gray-900 bg-emerald-700 rounded md:bg-transparent md:hover:text-emerald-700 md:p-0 " aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="{{route('admin.order')}}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-700 md:p-0 ">Orders</a>
                    </li>
                    <li>
                        <a href="{{route('admin.products')}}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-700 md:p-0 ">Products</a>
                    </li>
                    <li>
                        <a href="{{route('admin.users')}}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-700 md:p-0 ">Buyers</a>
                    </li>
                    <li>
                        <a href="{{route('admin.sellers.pending')}}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-700 md:p-0 ">Sellers</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>