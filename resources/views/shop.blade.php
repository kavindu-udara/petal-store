@include('header')

<section class="bg-white mb-5 pt-10">
    <div class="md:flex md:flex-row">
        <div class="md:basis-1/4"></div>
        <div class="md:basis-1/2 uppercase text-center text-gray-600 text-4xl mb-10">
            today's best deals
            <p>
                <i class="fa fa-window-minimize text-gray-400" aria-hidden="true"></i>
            </p>
        </div>
        <div class="md:basis-1/4"></div>
    </div>

    <div class="md:flex md:flex-row">
        <div class="md:basis-1/6"></div>
        <div class="md:basis-4/6 rounded shadow-lg shadow-slate-400/50">
            <div class="md:flex md:flex-row m-5">
                <div class="md:basis-1/4 mr-2  hidden md:block">
                    <img src="{{asset('img/Plant Care (Planting Project P2) _ Lucy Cuneo Photography.jpeg')}}" class="object-cover w-full h-full " alt="">
                </div>
                <div class="md:basis-3/4">
                    <div class="grid md:grid-cols-3 grid-cols-2 gap-4">

                        @foreach ($dealsProducts as $dealsProduct)

                        <div>
                            <a href="{{route('home.single.product', $dealsProduct->id)}}">

                                @php
                                $showImage=true
                                @endphp

                                @foreach ($allProductImages as $allProductImage)

                                @if ($allProductImage->product_id == $dealsProduct->id && $showImage)

                                <img src="{{asset('products/'.$allProductImage->name)}}" alt="hyu">
                                @php
                                $showImage=false
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
                                <span class="text-black">(1)</span>
                            </div>
                            <div class="text-center mt-1">
                                {{$dealsProduct->title}}
                            </div>
                            <div class="text-center font-bold mt-1">
                                Rs.{{$dealsProduct->price}}
                            </div>
                        </div>

                        @endforeach



                    </div>
                </div>
            </div>
        </div>
        <div class="md:basis-1/6"></div>
    </div>
</section>

<section class="pt-10 pb-10">
    <div class="md:grid md:grid-cols-2 text-center">
        <div class="text-center ">
            <div class="md:flex md:flex-row mr-3">
                <div class="md:basis-1/4"></div>
                <div class="md:basis-3/4 hidden md:block">
                    <img src="{{asset('img/shop-banner2.jpg')}}" class="" alt="banner-1">
                </div>
            </div>
        </div>
        <div class="">
            <div class="md:flex md:flex-row ml-3">
                <div class="md:basis-3/4 hidden md:block">
                    <img src="{{asset('img/shop-banner1.jpg')}}" class="" alt="banner-1">
                </div>
                <div class="md:basis-1/4"></div>
            </div>
        </div>
    </div>
</section>

<section class="bg-white mb-5 pt-10">
    <div class="flex flex-row">
        <div class="basis-1/4">

        </div>
        <div class="basis-1/2 uppercase text-center text-gray-600 text-4xl mb-10">
            find your favo
            <p>
                <i class="fa fa-window-minimize text-gray-400" aria-hidden="true"></i>
            </p>
        </div>
        <div class="basis-1/4"></div>
    </div>

    <div class="md:flex md:flex-row mb-5 px-10">


        <div class="md:basis-1/4">
            <div class="md:grid grid-cols-3 md:gap-4">
                <div>
                    <a href="{{route('home.search.advanced')}}">
                        <div class="bg-slate-100 px-5 py-3 w-50 rounded mr-3 ml-3 text-center cursor-pointer hover:bg-slate-200">
                            <i class="fa fa-filter" aria-hidden="true"></i> Filter
                        </div>
                    </a>
                </div>
                <div></div>
                <div></div>
            </div>
        </div>



        <div class="md:basis-1/2 text-center">
            <div class="flex flex-row">
                <div class="basis-3/4">
                    <input type="text" placeholder="search" class='bg-slate-100 px-5 py-3 w-full' id="shop-product-search">
                </div>
                <div class="basis-1/4 text-left my-auto ml-5">
                    <button class='bg-slate-100 py-3 px-3' id="shop-product-search-btn" onclick="basicSearch();">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="md:basis-1/4 text-right ">
            <select name="" class='bg-slate-100 px-5 py-3 rounded mr-3' id="shop-product-sort-select">
                <option value="0">best match</option>
                <option value="1">newest</option>
                <option value="2">price low to high</option>
                <option value="3">price high to low</option>
            </select>
        </div>

    </div>


    <div id="shop-product-list-basic-search-result-view">


        <div id="shop-product-list" class="mb-10">
            <div class="grid md:grid-cols-5 gap-4 md:col-start-1 text-base grid-cols-2 px-10">

                @foreach ($products as $product)

                <div>

                    <a href="{{route('home.single.product', $product->id)}}">

                    @php
                    $showImage=true
                    @endphp

                    @foreach ($allProductImages as $allProductImage)
                    
                    @if ($allProductImage->product_id == $product->id && $showImage)
                    
                    <img src="{{asset('products/'.$allProductImage->name)}}" class="cursor-pointer" alt="yt">

                    @php
                    $showImage=false
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
                        <span class="text-black">(1)</span>
                    </div>
                    <div class="text-center mt-1">
                        {{$product->title}}
                    </div>
                    <div class="text-center font-bold mt-1">
                        Rs.{{$product->price}}
                    </div>
                </div>

                @endforeach


            </div>
        </div>

        <!-- pagination -->
         <div>
            {{$products->links()}}
         </div>

    </div>


</section>

@include('footer')