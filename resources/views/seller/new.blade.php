@include('seller.header')

<section class="bg-slate-100 pb-5 pt-10">
    <div class="flex flex-row">
        <div class="basis-1/4"></div>
        <div class="basis-1/2 uppercase text-center text-gray-600 text-4xl mb-10">
            add new product
            <p>
                <i class="fa fa-window-minimize text-gray-400" aria-hidden="true"></i>
            </p>
        </div>
        <div class="basis-1/4"></div>
    </div>

    <div class="md:flex md:flex-row">
        <div class="md:basis-1/6 text-xl">
        </div>
        <div class="md:basis-2/3">
            <div class="p-5 w-full mx-auto bg-white md:mt-10 shadow-lg shadow-slate-400/50 rounded sm:w-3/4">

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

                <form action="{{route('seller.new.product')}}" method="POST"  enctype="multipart/form-data">

                    @csrf

                    <label for="product-title">Title</label>
                    <input type="text" id="product-title" name="product_title" class="w-full bg-slate-100 py-3 px-5 mt-3 mb-5 " required>

                    <label for="product-description">Description</label>
                    <br>
                    <textarea rows="10" id="product-description" name="product_description" cols="10" class="w-full bg-slate-100 py-3 px-5 mt-3 mb-5" required></textarea>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label for="product-category">Category</label>
                            <br>
                            <select class="w-full bg-slate-100 py-3 px-5  mt-3 mb-5 " name="category" id="product-category" required>
                                @foreach ($categories as $category)

                                <option value="{{$category->id}}">{{$category->name}}</option>

                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="product-price">Price</label>
                            <input type="number" id="product-price" name="product_price" class="w-full bg-slate-100 py-3 px-5  mt-3 mb-5 " min="10" required>
                        </div>
                        <div>
                            <label for="product-qty">qty</label>
                            <input type="number" name="product_qty" class="w-full bg-slate-100 py-3 px-5  mt-3 mb-5 " value="1" min="1" id="product-qty" required>
                        </div>
                    </div>

                    <span>Add Product Images</span>
                    <div class="grid grid-cols-3 text-center gap-4" id="image-preview">

                        <div>
                            <label for="img-1" onclick="selectImage('img-1');">
                                <i class="fa fa-plus bg-slate-100 p-3 mb-5 cursor-pointer mt-3" aria-hidden="true"></i>
                            </label>
                            <input type="file" accept="image/*" id="img-1" name="product_image_1" class="hidden" required>
                            <img src="" id="img-1-preview" alt="">
                        </div>

                        <div>
                            <label for="img-2" onclick="selectImage('img-2');">
                                <i class="fa fa-plus bg-slate-100 p-3 mb-5 cursor-pointer mt-3" aria-hidden="true"></i>
                            </label>
                            <input type="file" accept="image/*" id="img-2" name="product_image_2" class="hidden" required>
                            <img src="" id="img-2-preview" alt="">
                        </div>

                        <div>
                            <label for="img-3" onclick="selectImage('img-3');">
                                <i class="fa fa-plus bg-slate-100 p-3 mb-5 cursor-pointer mt-3" aria-hidden="true"></i>
                            </label>
                            <input type="file" accept="image/*" id="img-3" name="product_image_3" class="hidden" required>
                            <img src="" id="img-3-preview" alt="">
                        </div>
                    </div>

                    <div class="text-center mt-5">
                        <button class="bg-emerald-600 uppercase text-slate-100 py-4 px-10 font-bold w-full mb-5 hover:bg-emerald-700" type="submit">
                            add product
                        </button>
                    </div>
                </form>


            </div>
        </div>
        <div class="md:basis-1/6 text-xl text-end mr-5">
        </div>
    </div>
</section>

<script src="{{asset('/seller/script.js')}}"></script>