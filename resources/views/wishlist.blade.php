@include('header')


<section class="bg-white mb-5 pt-10 pb-10 h-screen">
    <div class="flex flex-row">
        <div class="basis-1/4"></div>
        <div class="basis-1/2 uppercase text-center text-gray-600 text-4xl mb-10">
            wishlist
            <p>
                <i class="fa fa-window-minimize text-gray-400" aria-hidden="true"></i>
            </p>
        </div>
        <div class="basis-1/4"></div>
    </div>

    <hr class="py-2">

    @foreach ($wishlist as $list)

    <div class="md:flex md:flex-row gap-4 mb-3">
        <div class="md:basis-1/5 md:ml-3">

            <div class="md:flex md:flex-row">
                <div class="md:basis-1/3 items-center justify-center">

                    <a href="./singleProduct.php?product=o">

                        @php
                        $showImage=true
                        @endphp

                        @foreach ($allProductImages as $allProductImage)

                        @if ($allProductImage->product_id == $list->product_id && $showImage)

                        <img src="{{asset('products/'.$allProductImage->name)}}" alt="product-image" class="text-center">

                        @php
                        $showImage=false
                        @endphp

                        @endif

                        @endforeach



                    </a>
                </div>
                <div class="md:basis-1/3"></div>
                <div class="md:basis-1/3"></div>
            </div>

        </div>

        <div class="md:basis-1/5">
            <div class="font-bold text-xl mt-3 md:text-left text-center">

                <a href="#">
                    @foreach ($allProducts as $allProduct)

                    @if ($allProduct->id==$list->product_id)
                    {{$allProduct->title}}
                    @endif

                    @endforeach
                </a>
            </div>
            <div class="text-gray-500 text-lg mt-3 md:text-left text-center">
                Rs.@foreach ($allProducts as $allProduct)

                @if ($allProduct->id==$list->product_id)
                {{$allProduct->price}}.00
                @endif

                @endforeach
            </div>
        </div>



        <!-- something wrong -->

        @php
        $startLoop = true
        @endphp


        @foreach ($carts as $cart)

        @if ($startLoop)
        @if ($cart->product_id == $list->product_id )


        <div class="md:basis-1/5 content-center text-center hidden md:block">

            <input id="single-product-qty-6" type="number" min="1" max="100" @foreach ($carts as $cart) @if ($list->product_id==$cart->product_id)
            value="{{$cart->qty}}"
            @else
            value="1"
            @endif
            @endforeach
            class="bg-slate-200 py-3 w-100 px-3 border-none">
        </div>
        <div class="md:basis-1/5 text-center content-center hidden md:block">

            <form action="{{route('remove.cart', $list->product_id)}}" method="POST">

                @csrf

                <i class="fa fa-check p-3 cursor-pointer " aria-hidden="true"></i>

                <button type="submit">
                    <i class="fa fa-shopping-basket p-3 bg-slate-200 cursor-pointer hover:text-slate-50 hover:bg-slate-300" aria-hidden="true"></i>
                </button>

            </form>

        </div>

        @else

        <form action="{{route('add.cart', $list->product_id)}}" method="POST" class="basis-2/5 gap-4 flex flex-row">
            @csrf

            <div class="md:basis-1/2 content-center text-center hidden md:block">
                <input name="qty" id="single-product-qty-6" type="number" min="1" @foreach ($allProducts as $allProduct) @if ($allProduct->id==$list->product_id)
                max='{{$allProduct->qty}}'
                @endif
                @endforeach

                @foreach ($carts as $cart) @if ($list->product_id==$cart->product_id)
                value="{{$cart->qty}}"
                @else
                value="1"
                @endif
                @endforeach

                class="bg-slate-200 py-3 w-100 px-3 border-none">

            </div>
            <div class="md:basis-1/2 text-center content-center hidden md:block">

                <i class="fa fa-plus p-3 cursor-pointer" aria-hidden="true"></i>

                <button type="submit">
                    <i class="fa fa-shopping-basket p-3 bg-slate-200 cursor-pointer hover:text-slate-50 hover:bg-slate-300" aria-hidden="true"></i>
                </button>

            </div>

        </form>

        @endif



        @endif

        @php
        $startLoop = false
        @endphp




        @endforeach






        <div class="md:basis-1/5 text-center content-center hidden md:block">

            <form action="{{route('remove.wishlist', $list->product_id)}}" method="GET">
                @csrf
                <button type="submit">
                    <i class="fa fa-times p-3 bg-slate-200 cursor-pointer hover:text-slate-50 hover:bg-slate-300" aria-hidden="true"></i>
                </button>
            </form>


        </div>

    </div>

    <hr class="py-2 ">

    @endforeach



</section>

@include('footer')