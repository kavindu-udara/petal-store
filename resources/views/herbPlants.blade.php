@include('header')

<section class="bg-white mb-5 pt-10">
    <div class="flex flex-row">
        <div class="basis-1/4"></div>
        <div class="basis-1/2 uppercase text-center text-gray-600 text-4xl mb-10">
            Herbal Plants Collection
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
                    <img src="{{asset('/img/herbal-plant-banner.jpg')}}" class="object-cover w-full h-full" alt="">
                </div>
                <div class="md:basis-3/4">
                    <div class="text-3xl text-emerald-600 font-bold ml-3">
                        Why Choose Our Herbal Plants?
                    </div>
                    <div class="md:grid md:grid-cols-3 md:gap-4 mt-5">
                        <div class="bg-slate-100 p-5">
                            <div class="text-center text-emerald-500 text-xl mb-3">Variety</div>
                            <div>We offer a diverse selection of herbs, including culinary favorites like basil and mint, as well as medicinal herbs like lavender and chamomile.</div>
                        </div>
                        <div class="bg-slate-100 p-5">
                            <div class="text-center text-emerald-500 text-xl mb-3">Quality</div>
                            <div>Each plant is carefully grown and selected to ensure it thrives in your home environment.</div>
                        </div>
                        <div class="bg-slate-100 p-5">
                            <div class="text-center text-emerald-500 text-xl mb-3">Low Maintenance</div>
                            <div>Herbal plants offer a range of benefits, from enhancing the flavor of your dishes to providing natural remedies and promoting overall well-being.</div>
                        </div>


                        <div class="bg-slate-100 p-5">
                            <div class="text-center text-emerald-500 text-xl mb-3">Culinary Uses</div>
                            <div> Enhance your cooking with fresh, flavorful herbs right from your garden or windowsill.</div>
                        </div>
                        <div class="bg-slate-100 p-5">
                            <div class="text-center text-emerald-500 text-xl mb-3">Health and Wellness</div>
                            <div>Many herbal plants have medicinal properties, offering natural remedies for common ailments and promoting overall health.</div>
                        </div>
                        <div class="bg-slate-100 p-5">
                            <div class="text-center text-emerald-500 text-xl mb-3">Aromatic Beauty</div>
                            <div>Herbal plants add a delightful fragrance to your home, creating a pleasant and inviting atmosphere.
                                Eco-Friendly: Growing your own herbs reduces th</div>
                        </div>

                    </div>
                    <div class="text-center text-2xl mt-5 text-emerald-600">Transform your home with the beauty and utility of our herbal plants. </div>
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