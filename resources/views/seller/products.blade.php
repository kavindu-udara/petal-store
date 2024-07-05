@include('seller.header')

<section class="bg-slate-100 pb-5 pt-10">
    <div class="flex flex-row">
        <div class="basis-1/4"></div>
        <div class="basis-1/2 uppercase text-center text-gray-600 text-4xl mb-10">
            My products list
            <p>
                <i class="fa fa-window-minimize text-gray-400" aria-hidden="true"></i>
            </p>
        </div>
        <div class="basis-1/4"></div>
    </div>

    <section>
        <div class="py-3 bg-white mx-5 mt-5 mb-5 ">

            <div id="sellers-result-box">

                <div class="text-xl font-medium text-center text-gray-500 ml-5">
                    <ul class="flex flex-wrap -mb-px">
                        <li class="me-2">
                            <a href="{{route('seller.products.pending.list')}}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                                Pending Products
                            </a>
                        </li>
                        <li class="me-2">
                            <a href="{{route('seller.products.all.list')}}" class="inline-block p-4 text-emerald-600 border-b-2 border-emerald-600 rounded-t-lg active ">All Products</a>
                        </li>
                        <li class="me-2">
                            <a href="{{route('seller.products.hidden.list')}}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">Hidden Products</a>
                        </li>
                        <li class="me-2">
                            <a href="{{route('seller.products.disaprove.list')}}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">Disapproved Products</a>
                        </li>
                    </ul>

                </div>


                <div class="relative overflow-x-auto sm:rounded-lg mx-5 mt-3">

                    <table class="w-full text-lg text-left rtl:text-right text-gray-500 " id="seller-pending-products-table">
                        <thead class="text-lg text-gray-700 uppercase bg-gray-50 ">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Product name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Category
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Qty
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Unit Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    options
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($products as $product)
                            <tr class="bg-white border-b hover:bg-gray-50 ">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    {{$product->title}}
                                </th>
                                <td class="px-6 py-4">
                                    @foreach ($categories as $category)
                                    @if ($category->id == $product->category_id)
                                    {{$category->name}}
                                    @endif
                                    @endforeach
                                </td>
                                <td class="px-6 py-4">
                                    {{$product->qty}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$product->price}}
                                </td>
                                <td class="px-6 py-4">

                                    <a href="{{route('seller.product.edit', $product->id)}}" class="p-3 bg-emerald-200   cursor-pointer hover:text-white hover:bg-emerald-300">Edit</a>

                                    <button onclick="showandHidePopup('product-hide-pop-up-{{$product->id}}');" class="p-3 bg-yellow-200   cursor-pointer hover:text-white hover:bg-yellow-300">
                                        Hide
                                    </button>

                                    <button onclick="showandHidePopup('product-delete-pop-up-{{$product->id}}');" class="p-3 bg-red-200   cursor-pointer hover:text-white hover:bg-red-300">
                                        Delete
                                    </button>

                                </td>
                            </tr>

                            <section id="product-delete-pop-up-{{$product->id}}" class="fixed top-0 left-0 w-full h-full opacity-100  backdrop-blur-sm justify-center items-center rounded hidden">
                                <div class="h-screen flex items-center justify-center">
                                    <div class="bg-white p-10 rounded-lg shadow-sm ">
                                        <div class="text-center text-xl mb-5">Are You Sure ?</div>
                                        <div class="grid grid-cols-2 gap-4">

                                            <div>
                                                <form action="{{route('seller.product.delete', $product->id)}}" method="POST">
                                                    @csrf

                                                    <button type="submit" class="py-3 px-10 bg-red-300 rounded-lg text-lg text-center cursor-pointer hover:bg-red-400">Yes</button>

                                                </form>
                                            </div>

                                            <div class="py-3 px-10 bg-emerald-300 rounded-lg text-lg text-center cursor-pointer hover:bg-emerald-400" onclick="showandHidePopup('product-delete-pop-up-{{$product->id}}');">No</div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- hide popup -->
                            <section id="product-hide-pop-up-{{$product->id}}" class="fixed top-0 left-0 w-full h-full opacity-100  backdrop-blur-sm justify-center items-center rounded hidden">
                                <div class="h-screen flex items-center justify-center">
                                    <div class="bg-white p-10 rounded-lg shadow-sm ">
                                        <div class="text-center text-xl mb-5">Are You Sure ?</div>
                                        <div class="grid grid-cols-2 gap-4">

                                            <div>
                                                <form action="{{route('seller.product.hide', $product->id)}}" method="POST">
                                                    @csrf

                                                    <button type="submit" class="py-3 px-10 bg-red-300 rounded-lg text-lg text-center cursor-pointer hover:bg-red-400">Yes</button>

                                                </form>
                                            </div>

                                            <div class="py-3 px-10 bg-emerald-300 rounded-lg text-lg text-center cursor-pointer hover:bg-emerald-400" onclick="showandHidePopup('product-hide-pop-up-{{$product->id}}');">No</div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            @endforeach

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </section>


</section>

@include('seller.footer')