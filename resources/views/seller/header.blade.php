<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller</title>

    <!-- tailwind css -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- tailwind css -->
    @vite('resources/css/app.css')

    <link rel="icon" href="{{asset('petal-hut-icon.png')}}" type="image/x-icon"> 
    <!-- font awesome icons -->
    <link rel="stylesheet" href="{{asset('/font-awesome-4.7.0/css/font-awesome.min.css')}}">

</head>

<body>

    <nav class="bg-white  w-full z-20 top-0 start-0 border-b border-gray-200">

        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="./seller.php" class="flex items-center space-x-3 rtl:space-x-reverse">
                <div class="text-center text-3xl font-bold text-emerald-800">
                <div class="cursor-pointer flex">Petal Hut&nbsp;<div class="text-slate-400">&nbsp;Seller</div></div>
                </div>
            </a>

            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">

                <button id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation" class=" font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center " type="button">
                    <i class="fa fa-user-circle-o text-2xl hover:text-emerald-500 cursor-pointer mr-3" aria-hidden="true"></i>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdownInformation" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 ">
                    <div class="px-4 py-3 text-base text-gray-900 ">
                        <div>name</div>
                    </div>
                    <ul class="py-2 text-base text-gray-700 " aria-labelledby="dropdownInformationButton ">
                        <li>
                            <a href="{{route('seller.profile')}}" class="block px-4 py-2 hover:bg-gray-200 ">Settings</a>
                        </li>
                    </ul>
                    <div class="py-2">
                        <a href="{{route('seller.logout')}}" class="block px-4 py-2 text-base text-gray-700 hover:bg-gray-200 ">Sign out</a>
                    </div>
                </div>

                <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 " aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>

            </div>

            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 ">
                    <li>
                        <a href="{{route('seller.dashboard')}}" class="block py-2 px-3 text-gray-900 bg-emerald-700 rounded md:bg-transparent md:hover:text-emerald-700 md:p-0 " aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="{{route('seller.orders.new')}}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-700 md:p-0 ">Orders</a>
                    </li>
                    <li>
                        <a href="{{route('seller.products.pending.list')}}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-700 md:p-0 ">products</a>
                    </li>
                    <li>
                        <a href="{{route('seller.new.form')}}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-700 md:p-0 ">new</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>