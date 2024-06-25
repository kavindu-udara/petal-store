@include('header')


<section class="mt-10">
    <div class="md:grid md:grid-cols-2 gap-1 ">
        <div>
            <div class="flex flex-row">
                <div class="basis-1/4 text-center text-3xl bold content-center text-slate-300">
                    <i onclick="singleImgBackward();" class="fa fa-chevron-left cursor-pointer hover:text-slate-500" aria-hidden="true"></i>
                </div>
                <div class="basis-1/2">
                    @foreach ($productImages as $key => $productImage)
                    @if($key == 0)
                    <img id="single-product-prev-{{$key}}" src="{{asset('products/'.$productImage->name)}}" alt="{{$productImage->name}}">
                    @else
                    <img id="single-product-prev-{{$key}}" class="hidden" src="{{asset('products/'.$productImage->name)}}" alt="{{$productImage->name}}">
                    @endif
                    @endforeach
                </div>
                <div class="basis-1/4 text-center text-3xl bold content-center text-slate-300 ">
                    <i id="single-img-forward-btn" onclick="singleImgforward();" class="fa fa-chevron-right cursor-pointer hover:text-slate-500" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div>
            <div class="text-3xl mt-5 md:text-left text-center">
                {{$product->title}}
            </div>
            <div class="text-2xl font-bold mt-3 text-emerald-700  md:text-left text-center">
                Rs.{{$product->price}}
            </div>
            <p class="text-gray-400 mt-3 mr-5  md:text-left text-center">
                {{$product->description}}
            </p>
            <div class="text-yellow-400 text-xl mt-3 mb-3  md:text-left text-center">
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <i class="fa fa-star-o" aria-hidden="true"></i>
                <span class="text-black">(1)</span>
            </div>

            <div class="md:grid md:grid-cols-3">
                <div>

                    @if ($cart)

                    <form action="{{route('remove.cart', $product->id)}}" method="POST">
                        @csrf
                        <input type="number" name="qty" min="1" max="{{$product->qty}}" value="{{$cart->qty}}" class="bg-slate-100 px-5 py-3 text-xl w-full mb-5 border-none">
                        <button type="submit" class="bg-emerald-800 uppercase text-slate-100 py-4 px-10 font-bold w-full mb-5 hover:bg-emerald-700">
                            remove from cart
                        </button>
                    </form>

                    @else

                    <form action="{{route('add.cart', $product->id)}}" method="POST">
                        @csrf
                        <input type="number" name="qty" min="1" max="{{$product->qty}}" value="1" class="bg-slate-100 px-5 py-3 text-xl w-full mb-5">
                        <button type="submit" class="bg-emerald-800 uppercase text-slate-100 py-4 px-10 font-bold w-full mb-5 hover:bg-emerald-700">
                            add to cart
                        </button>
                    </form>

                    @endif

                    <div class="grid grid-cols-2 gap-4">
                        <div>


                            @if ($wishlist)

                            <form action="{{route('remove.wishlist', $product->id)}}" method="GET">
                                @csrf
                                <button type="submit" class="border-2 px-5 py-3 border-gray-600 uppercase hover:text-gray-600 w-full bg-gray-600 hover:bg-white  text-slate-50">
                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    remove
                                </button>
                            </form>

                            @else

                            <form action="{{route('add.wishlist', $product->id)}}" method="GET">
                                @csrf
                                <button type="submit" class="border-2 px-5 py-3 border-gray-600 uppercase hover:text-gray-600 w-full bg-gray-600 hover:bg-white  text-slate-50">
                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    collect
                                </button>
                            </form>
                            @endif
                        </div>
                        <div>
                            <button class="border-2 px-5 py-3 border-gray-600 uppercase text-gray-600 w-full hover:bg-gray-600  hover:text-slate-50">
                                <i class="fa fa-share-alt" aria-hidden="true"></i>
                                Share
                            </button>
                        </div>
                    </div>
                </div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
</section>


<!-- recommented section -->
<section class="bg-white mb-5 pt-10">
    <div class="flex flex-row">
        <div class="basis-1/4"></div>
        <div class="basis-1/2 uppercase text-center text-gray-600 text-4xl mb-10">
            you may also like
            <p>
                <i class="fa fa-window-minimize text-gray-400" aria-hidden="true"></i>
            </p>
        </div>
        <div class="basis-1/4"></div>
    </div>

    <div class="grid md:grid-cols-5 gap-4 grid-cols-2 md:col-start-1 text-base px-10">

        @foreach ($randomProducts as $randomProduct)

        <div>

            <a href="{{route('home.single.product', $randomProduct->id)}}">

                @php $showImage = false; @endphp

                @foreach ($allProductImages as $productImage)

                @if ($productImage->product_id == $randomProduct -> id && !$showImage)

                <img src="{{asset('products/'.$productImage->name)}}" class="cursor-pointer" alt="img">

                @php $showImage = true; @endphp

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
                {{$randomProduct->title}}
            </div>
            <div class="text-center font-bold mt-1  ">
                Rs.{{$randomProduct->price}}
            </div>
        </div>

        @endforeach

    </div>
</section>

@include('footer')