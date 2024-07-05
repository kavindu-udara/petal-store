<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petal Hut</title>

    <!-- tailwind css -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- tailwind css -->
    @vite('resources/css/app.css')

    <link rel="icon" href="{{asset('petal-hut-icon.png')}}" type="image/x-icon"> 


    <!-- font awesome icons -->
    <link rel="stylesheet" href="{{asset('/font-awesome-4.7.0/css/font-awesome.min.css')}}">

</head>

<body>

    <nav class="bg-white w-full z-20 top-0 start-0 border-b border-gray-200">

        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a class="flex items-center space-x-3 rtl:space-x-reverse">
                <div class="text-center text-3xl font-bold text-emerald-800">
                    <div onclick="gotoHome();" class="cursor-pointer">Petal Hut</div>
                </div>
            </a>

            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">

                @if (Auth::user())

                <button type="button" onclick="goToWhishlist();" class="relative inline-flex items-center px-5 py-2.5 text-xl text-center text-black hover:text-emerald-500  font-bold">

                    <a href="{{route('wishlist')}}">
                        <i class="fa fa-heart-o cursor-pointer " aria-hidden="true"></i>
                    </a>

                    @if ($wishlistCount!==null && $wishlistCount !== 0)

                    <div class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-emerald-500 border-2 border-white rounded-full -top-2 -end-2 ">
                        {{$wishlistCount}}
                    </div>

                    @endif

                </button>

                <button type="button" class="relative inline-flex items-center px-5 py-2.5 text-xl text-center text-black font-bold">

                    <a href="{{route('cart')}}"><i class="fa fa-shopping-basket hover:text-emerald-500  cursor-pointer" aria-hidden="true" id="cartHeaderBtn"></i></a>

                    @if ($cartCount!==null && $cartCount !== 0)

                    <div class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-emerald-500 border-2 border-white rounded-full -top-2 -end-2 ">
                        {{$cartCount}}
                    </div>

                    @endif
                </button>

                <button id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation" class=" font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center " type="button">
                    <i class="fa fa-user-circle-o text-2xl hover:text-emerald-500 cursor-pointer mr-3 " aria-hidden="true"></i>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdownInformation" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 ">
                    <div class="px-4 py-3 text-base text-gray-900 ">
                        @if (Auth::user())
                        <div>{{Auth::user()->fname}} {{Auth::user()->lname}}</div>
                        @endif
                    </div>
                    <ul class="py-2 text-base text-gray-700" aria-labelledby="dropdownInformationButton">
                        <li>
                            <a href="./user/history.php" class="block px-4 py-2 hover:bg-gray-100 ">History</a>
                        </li>
                        <li>
                            <a href="{{route('user.profile')}}" class="block px-4 py-2 hover:bg-gray-100 ">Settings</a>
                        </li>
                    </ul>
                    <div class="py-2">
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                        <button class="block px-4 py-2 text-base text-gray-700 hover:bg-gray-100 w-full text-left">Sign out</button>
                        </form>
                    </div>
                </div>

                @else

                <a href="{{route('login')}}" data-dropdown-toggle="dropdownInformation" class=" font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center ">
                    <i class="fa fa-user-circle-o text-2xl hover:text-emerald-500 cursor-pointer mr-3 " aria-hidden="true"></i>
                </a>

                @endif

                <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 " aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>

            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white  ">
                    <li>
                        <a href="{{route('home')}}" class="block py-2 px-3 text-gray-900 bg-emerald-700 rounded md:bg-transparent md:hover:text-emerald-700 md:p-0 " aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="{{route('home.shop')}}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-700 md:p-0 ">Shop</a>
                    </li>
                    <li>
                        <a href="{{route('home.contact')}}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-700 md:p-0 ">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>