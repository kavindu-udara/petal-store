@include('header')

<section class="bg-white mb-5 pt-10">
    <div class="flex flex-row">
        <div class="basis-1/4"></div>
        <div class="basis-1/2 uppercase text-center text-gray-600 text-4xl mb-10">
            hanging plants
            <p>
                <i class="fa fa-window-minimize text-gray-400" aria-hidden="true"></i>
            </p>
        </div>
        <div class="basis-1/4"></div>
    </div>

    <div class="md:flex md:flex-row">
        <div class="md:basis-1/6"></div>
        <div class="md:basis-4/6 rounded shadow-lg shadow-slate-400/50 px-5 py-3">

            <div class="md:flex md:flex-row m-5">
                <div class="md:basis-1/4 mr-2 hidden md:block">
                    <img src="{{asset('/img/hanging-plant-banner.jpg')}}" class="object-cover w-full h-full" alt="">
                </div>
                <div class="md:basis-3/4">
                    <div class="text-3xl text-emerald-600 font-bold ml-3">
                        Why Choose Our Hanging Plants?
                    </div>
                    <div class="md:grid md:grid-cols-3 md:gap-4 mt-5">
                        <div class="bg-slate-100 p-5">
                            <div class="text-center text-emerald-500 text-xl mb-3">Variety</div>
                            <div>We offer a diverse range of species, including the ever-popular Spider Plant, the elegant English Ivy, and the exotic String of Pearls.</div>
                        </div>
                        <div class="bg-slate-100 p-5">
                            <div class="text-center text-emerald-500 text-xl mb-3">Quality</div>
                            <div>Each plant is carefully selected and nurtured to ensure it arrives at your doorstep in perfect condition.</div>
                        </div>
                        <div class="bg-slate-100 p-5">
                            <div class="text-center text-emerald-500 text-xl mb-3">Low Maintenance</div>
                            <div>Perfect for busy lifestyles, our hanging plants require minimal care while still thriving and looking beautiful.</div>
                        </div>


                        <div class="bg-slate-100 p-5">
                            <div class="text-center text-emerald-500 text-xl mb-3">Air Purification</div>
                            <div>Many hanging plants are known for their ability to filter toxins from the air, creating a healthier living environment.</div>
                        </div>
                        <div class="bg-slate-100 p-5">
                            <div class="text-center text-emerald-500 text-xl mb-3">Space-Saving</div>
                            <div>Perfect for small spaces, hanging plants add greenery without taking up floor space.</div>
                        </div>
                        <div class="bg-slate-100 p-5">
                            <div class="text-center text-emerald-500 text-xl mb-3">Mood Enhancement</div>
                            <div>Studies have shown that being around plants can reduce stress and improve overall well-being.</div>
                        </div>

                    </div>
                    <div class="text-center text-2xl mt-5 text-emerald-600">Elevate Your Space with Our Beautiful Hanging Plants</div>
                </div>
            </div>

        </div>
        <div class="md:basis-1/6"></div>
    </div>
</section>


<section class="bg-white mb-5 pt-10">
    <div class="flex flex-row">
        <div class="basis-1/4"></div>
        <div class="basis-1/2 uppercase text-center text-gray-600 text-4xl mb-10">
            shop now
            <p>
                <i class="fa fa-window-minimize text-gray-400" aria-hidden="true"></i>
            </p>
        </div>
        <div class="basis-1/4"></div>
    </div>

    <div class="flex flex-row mb-5">
        <div class="basis-1/4"></div>
        <div class="basis-1/2 text-center">
            <div class="flex flex-row">
                <div class="basis-3/4">
                    <input type="text" placeholder="search" class='bg-slate-100 px-5 py-3 w-full' id="category-product-search">
                </div>
                <div class="basis-1/4 text-left my-auto ml-5">
                    <button class='bg-slate-100 py-3 px-3' id="shop-product-search-btn" onclick="catBasicSearch(1);">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>
            </div>


        </div>
        <div class="basis-1/4 text-right">
            <select name="" class='bg-slate-100 px-5 py-3 rounded mr-3' id="category-product-sort-select">
                <option value="0">best match</option>
                <option value="1">newest</option>
                <option value="2">price low to high</option>
                <option value="3">price high to low</option>
            </select>
        </div>
    </div>


    <div id="shop-product-list-basic-search-result-view">

        <div id="shop-product-list" class="mb-10">
            <div class="grid md:grid-cols-5 grid-cols-2 gap-4 md:col-start-1 text-base">

                @foreach ($products as $product)

                <div>
                    <a href="{{route('home.single.product', $product->id)}}">

                        @php
                        $showImage=true
                        @endphp

                        @foreach ($allProductImages as $allProductImage)

                        @if ($allProductImage->product_id == $product->id && $showImage)

                        <img src="{{asset('products/'.$allProductImage->name)}}" class="cursor-pointer" alt="tyu">
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


    </div>

</section>

<!-- pagination -->
<div>
    {{$products->links()}}
</div>

@include('footer')