@include('header')


<section class="bg-slate-100 mb-5 pt-10 pb-10 ">

    <div class="md:flex md:flex-row ">
        <div class="md:basis-1/6"></div>
        <div class="md:basis-4/6">

            <form action="{{ route('home.search.advanced') }}" method="get">
                @csrf

                <div class="md:flex md:flex-row gap-4">
                    <div class="md:basis-3/4">
                        <input name="text" @if (isset($_GET['text'])) value="{{ $_GET['text'] }}" @endif type="text" class="bg-white w-full py-3 px-3" id="advanced-search-text" placeholder="Enter Text To Search">
                    </div>
                    <div class="md:basis-1/4">
                        <button type="submit" class="hover:bg-emerald-700 bg-emerald-800 uppercase py-3 px-3 w-full font-bold text-white" onclick="advancedSearch();">search</button>
                    </div>
                </div>

                <div class="md:flex md:flex-row gap-4 mt-5">
                    <div class="md:basis-1/3">
                        <div class="uppercase">category</div>
                        <select name="category" id="advanced-search-category" class="bg-white w-full py-3 px-3">
                            <option value="0">select category</option>
                            @foreach ($categories as $category)
                            <option @php if(isset($_GET['category']) && $_GET['category']==$category->id){
                                echo 'selected';
                                }
                                @endphp
                                value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md:basis-1/3">
                        <div class="uppercase">Date From</div>
                        <input type="date" value="
                        @if (isset($_GET['dateFrom']))
                            {{$_GET['dateFrom']}}
                        @endif
                        " name="dateFrom" class="bg-white w-full py-3 px-3" id="advanced-search-date-from">
                    </div>
                    <div class="md:basis-1/3">
                        <div class="uppercase">Date To</div>
                        <input value="
                        @if (isset($_GET['dateTo']))
                            {{$_GET['dateTo']}}
                        @endif
                        " type="date" name="dateTo" class="bg-white w-full py-3 px-3" id="advanced-search-date-to">
                    </div>
                </div>

                <div class="md:flex md:flex-row gap-4 mt-5">
                    <div class="md:basis-1/3">
                        <div class="uppercase">Price From</div>
                        <input 
                        @if (isset($_GET['priceFrom']))
                        value="{{$_GET['priceFrom']}}" 
                        @endif
                        name="priceFrom" type="text" class="bg-white w-full py-3 px-3" id="advanced-search-price-from">
                    </div>
                    <div class="md:basis-1/3">
                        <div class="uppercase">Price To</div>
                        <input name="priceTo" 
                        @if (isset($_GET['priceTo']))
                        value="{{$_GET['priceTo']}}" 
                        @endif type="text" class="bg-white w-full py-3 px-3" id="advanced-search-price-to">
                    </div>
                    <div class="md:basis-1/3">
                        <div class="uppercase">sort by</div>
                        <select name="sort" class='bg-white w-full py-3 px-3' id="category-product-sort-select">
                            <option value="0">best match</option>
                            <option value="1">newest</option>
                            <option value="2">price low to high</option>
                            <option value="3">price high to low</option>
                        </select>
                    </div>
                </div>

            </form>
        </div>
        <div class="md:basis-1/6"></div>
    </div>
</section>

@if (count($_GET))
@if ($products->count() > 0)

<section>
    <div class="grid md:grid-cols-5 gap-4 md:col-start-1 text-base grid-cols-2 px-10 mb-5">

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
</section>

@else

<section class="bg-white mb-5 pt-10 h-[60vh] content-center justify-center">
    <div id="shop-product-list-basic-search-result-view">
        <div class="flex flex-row mb-10 mt-10">
            <div class="basis-1/3"></div>
            <div class="basis-1/3 text-center text-gray-400 text-3xl">
                No Products Found...
            </div>
            <div class="basis-1/3"></div>
        </div>
    </div>
</section>

@endif
@endif

@if(!count($_GET))
<section class="bg-white mb-5 pt-10 h-[60vh] content-center justify-center">
    <div id="shop-product-list-basic-search-result-view">
        <div class="flex flex-row mb-10 mt-10">
            <div class="basis-1/3"></div>
            <div class="basis-1/3 text-center text-gray-400 text-3xl">
                No Products Searched Yet...
            </div>
            <div class="basis-1/3"></div>
        </div>
    </div>
</section>
@endif

@include('footer')