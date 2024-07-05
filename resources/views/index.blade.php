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

    <!-- font awesome icons -->
    <link rel="stylesheet" href="{{asset('/font-awesome-4.7.0/css/font-awesome.min.css')}}">

    
    <link rel="icon" href="{{asset('petal-hut-icon.png')}}" type="image/x-icon"> 

</head>

<body class="bg-emerald-700 bg-no-repeat bg-blend-multiply bg-cover bg-center" style="background-image: url('./assets/img/carousel_img/2.jpg');">

    <section class="content-center">
        <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-6xl lg:text-6xl">Welcome to Petal Hut</h1>
            <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">your one-stop shop for all your plant-related ecommerce needs. Browse through our vast collection of plants, choose the perfect blooms for your home or office, and let us take care of the rest. We guarantee satisfaction and a thriving plant life.</p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                <a href="{{route('home')}}" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-emerald-600 rounded-lg bg-white hover:bg-emerald-700 hover:text-white focus:ring-4 focus:ring-blue-300 border border-white">
                    Go to Shop
                </a>
                <a href="{{route('seller.dashboard')}}" class="inline-flex justify-center hover:text-emerald-600 items-center py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg border border-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
                    Become a Seller
                </a>
            </div>
        </div>
    </section>

    <section>
        <div class="md:flex md:flex-row grid grid-cols-1 text-5xl text-white font-bold">
            <div class="md:basis-1/3 text-end">
                <div class="md:block hidden">
                    100+ Sellers
                </div>
            </div>
            <div class="md:basis-1/3 text-center">
                <div  class="md:block hidden">
                    50+ Users
                </div>
            </div>
            <div class="md:basis-1/3">
                <div  class="md:block hidden">
                    100+ Products
                </div>
            </div>
        </div>
    </section>

</body>

</html>