@include('header')

<!-- carousel -->
<section>

    <div id="default-carousel" class="relative w-full z-0" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{asset('/img/carousel_img/1.jpg')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{asset('/img/carousel_img/2.jpg')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{asset('/img/carousel_img/3.jpg')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
        </div>
        <!-- Slider controls -->
        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white  group-focus:outline-none">
                <svg class="w-4 h-4 text-white  rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>

</section>

<section class="pt-10 bg-white pb-10">
    <div class="md:flex md:flex-row ">
        <div class="md:basis-1/5 mb-5">
            <div class="text-center">
                <i class="fa fa-gift text-5xl text-emerald-500" aria-hidden="true"></i>
                <div class="pt-3 text-emerald-700 text-xl">
                    <p class="">Free Delivery</p>
                    <p>Over $70</p>
                </div>
            </div>
        </div>
        <div class="md:basis-1/5 mb-5">
            <div class="text-center">
                <i class="fa fa-globe text-5xl text-emerald-500" aria-hidden="true"></i>
                <div class="pt-3 text-emerald-700 text-xl">
                    <p class="">International</p>
                    <p>Delivery</p>
                </div>
            </div>
        </div>
        <div class="md:basis-1/5 mb-5">
            <div class="text-center">
                <i class="fa fa-usd text-5xl text-emerald-500" aria-hidden="true"></i>
                <div class="pt-3 text-emerald-700 text-xl">
                    <p class="">Firance</p>
                    <p>Available</p>
                </div>
            </div>
        </div>
        <div class="md:basis-1/5 mb-5">
            <div class="text-center">
                <i class="fa fa-star-o text-5xl text-emerald-500" aria-hidden="true"></i>
                <div class="pt-3 text-emerald-700 text-xl">
                    <p class="">5 Stars</p>
                    <p>Cutomer Services</p>
                </div>
            </div>
        </div>
        <div class="md:basis-1/5 mb-5">
            <div class="text-center">
                <i class="fa fa-cog text-5xl text-emerald-500" aria-hidden="true"></i>
                <div class="pt-3 text-emerald-700 text-xl">
                    <p class="">Installation</p>
                    <p>Options</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-slate-100 pb-5 pt-10">
    <div class="md:flex md:flex-row">
        <div class="md:basis-1/4"></div>
        <div class="md:basis-1/2 uppercase text-center text-gray-600 text-4xl mb-10 ">
            shop by categories
            <p>
                <i class="fa fa-window-minimize text-gray-400" aria-hidden="true"></i>
            </p>
        </div>
        <div class="md:basis-1/4"></div>
    </div>

    <div class="md:grid md:grid-cols-5 md:gap-4 md:col-start-1 text-xl px-10">
        <div>
            <a href="{{route('home.products.hanging')}}">
                <img src="{{asset('/img/hanging-plant.jpg')}}" class="cursor-pointer" alt="">
            </a>
            <div class="text-center mt-3 mb-5 ">
                Hanging Planters
            </div>
        </div>
        <div>
            <a href="{{route('home.products.herb')}}">
                <img src="{{asset('/img/herbal-plant.jpg')}}" class="cursor-pointer" alt="">
            </a>
            <div class="text-center mt-3 mb-5 ">
                Herb Planters
            </div>
        </div>
        <div>
            <a href="{{route('home.products.windowsill')}}">
                <img src="{{asset('/img/windowsill-plant.jpg')}}" class="cursor-pointer" alt="">
            </a>
            <div class="text-center mt-3 mb-5  ">
                Windowsill Planters
            </div>
        </div>
        <div>
            <a href="{{route('home.products.stands')}}">
                <img src="{{asset('/img/plant-with-legs.jpg')}}" class="cursor-pointer" alt="">
            </a>
            <div class="text-center mt-3 mb-5 ">
                Planter with legs
            </div>
        </div>
        <div>
            <a href="{{route('home.products.terrariums')}}">
                <img src="{{asset('/img/terrarium.jpg')}}" class="cursor-pointer" alt="">
            </a>
            <div class="text-center mt-3 mb-5 ">
                Terrariums
            </div>
        </div>
    </div>
</section class="pb-5">

<!-- products -->
<section class="bg-white pb-5 pt-10 ">
    <div class="md:flex md:flex-row">
        <div class="md:basis-1/4"></div>
        <div class="md:basis-1/2 uppercase text-center text-gray-600 text-4xl mb-10 ">
            Trending Now
            <p>
                <i class="fa fa-window-minimize text-gray-400" aria-hidden="true"></i>
            </p>
        </div>
        <div class="md:basis-1/4"></div>
    </div>

    <div class="grid md:grid-cols-5 gap-4 md:col-start-1 text-base  grid-cols-2 px-10">


        @foreach ($products as $key => $product)

        @if ($key < 10) <div>


            <a href="{{route('home.single.product', $product->id)}}">

                @php
                $showImage=true;
                @endphp

                @foreach ($productImages as $productImage)
                @if ($productImage->product_id == $product -> id && $showImage )

                <img src="{{asset('products/'.$productImage->name)}}" class="cursor-pointer" alt="img">

                @php
                $showImage=false;
                @endphp

                @endif
                @endforeach

            </a>
            <div class="text-center text-yellow-300">
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <span class="text-black ">(1)</span>
            </div>
            <div class="text-center mt-1 ">
                {{$product->title}}
            </div>
            <div class="text-center font-bold mt-1  ">
                Rs.{{$product->price}}
            </div>
    </div>
    @endif

    @endforeach

    </div>
</section>

<section class="py-5 ">
    <div class="text-center">
        <a href="{{route('home.shop')}}" class="border-2 px-5 py-3 text-gray-700 border-gray-400 uppercase " >
            Shop More
            <i class="fa fa-arrow-right" aria-hidden="true"></i>
        </a>
    </div>
</section>

@include('footer')