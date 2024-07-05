@include('seller.header')

<!-- make edit product page -->
<section class="bg-slate-100 mb-5 pt-10 pb-10">
    <div class="md:flex md:flex-row">
        <div class="md:basis-1/4"></div>
        <div class="md:basis-1/2 uppercase text-center text-gray-600 md:text-4xl text-xl mb-10">
            {{$product->title}}
            <p>
                <i class="fa fa-window-minimize text-gray-400" aria-hidden="true"></i>
            </p>
        </div>
        <div class="md:basis-1/4"></div>
    </div>

    <!-- alerts -->
    @if (Session::has('error'))
    <div class="sm:mx-auto sm:w-full sm:max-w-sm mt-10">
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:text-red-400" role="alert">
            <span class="font-medium">{{session::get('error')}}</span>
        </div>
    </div>
    @endif

    <!-- alerts -->
    @if (Session::has('success'))
    <div class="sm:mx-auto sm:w-full sm:max-w-sm mt-10">
        <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:text-blue-400" role="alert">
            <span class="font-medium">{{session::get('success')}}</span>
        </div>
    </div>
    @endif

    <div class="md:flex md:flex-row">
        <div class="md:basis-1/6 text-xl">
        </div>
        <div class="md:basis-2/3">
            <div class="p-5 w-full mx-auto bg-white md:mt-10 shadow-lg shadow-slate-400/50 rounded sm:w-3/4">

                <form action="{{route('seller.product.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="text-lg ">
                        <label for="product-title">Title</label>
                        <input type="text" id="product-title" class="w-full bg-slate-100 py-3 px-5 mt-3 mb-5 " name="title" value="{{$product->title}}">

                        <label for="product-description">Description</label>
                        <br>
                        <textarea rows="10" name="description" id="product-description" cols="10" class="w-full bg-slate-100 py-3 px-5  mt-3 mb-5 ">{{$product->description}}</textarea>

                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label for="product-category">Category</label>
                                <br>
                                <select name="category" class="w-full bg-slate-100 py-3 px-5  mt-3 mb-5 " name="category" id="product-category">

                                    @foreach ($categories as $category)

                                    <option value="{{$category->id}}" @if($product->category_id == $category->id) selected @endif>{{$category->name}}</option>

                                    @endforeach

                                </select>
                            </div>
                            <div>
                                <label for="product-price">Price</label>
                                <input type="number" name="price" id="product-price" class="w-full bg-slate-100 py-3 px-5  mt-3 mb-5" min="10" value="{{$product->price}}">
                            </div>
                            <div>
                                <label for="product-qty">qty</label>
                                <input type="number" name="qty" class="w-full bg-slate-100 py-3 px-5  mt-3 mb-5 " min="1" id="product-qty" value="{{$product->qty}}">
                            </div>
                        </div>


                        <span>Product Images</span>

                        <div class="grid grid-cols-3 text-center gap-4" id="image-preview">

                        @php
                        $x=1
                        @endphp

                            @foreach ($productImages as $productImage)

                            <div>
                                <label for='img-{{$productImage->id}}' onclick="selectImage('img-{{$productImage->id}}')">
                                    <i class="fa fa-plus bg-slate-100 p-3 mb-5 cursor-pointer mt-3 " aria-hidden="true"></i>
                                </label>
                                <input type="file" name="image_{{$x}}" accept="image/*" id='img-{{$productImage->id}}' class="hidden">

                                <img src="{{url('products/'.$productImage->name)}}" id='img-{{$productImage->id}}-preview' alt="{{$productImage->name}}">
                            </div>

                            @php
                            $x++
                            @endphp

                            @endforeach

                        </div>
                    </div>

                    <div class="text-center mt-5">
                        <button type="submit" class="bg-emerald-600 uppercase text-slate-100 py-4 px-10 font-bold w-full mb-5 hover:bg-emerald-700">
                            save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="md:basis-1/6 text-xl text-end mr-5">
        </div>
    </div>
</section>

@include('seller.footer')
