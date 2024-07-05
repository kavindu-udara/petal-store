@include('seller.header')

<section class="bg-slate-100 pb-5 pt-10">
    <div class="flex flex-row">
        <div class="basis-1/4"></div>
        <div class="basis-1/2 uppercase text-center text-gray-600 text-4xl mb-10">
            Orders
            <p>
                <i class="fa fa-window-minimize text-gray-400" aria-hidden="true"></i>
            </p>
        </div>
        <div class="basis-1/4"></div>
    </div>
    <div class="py-3 bg-white mx-5 mt-5 mb-5 ">

        <div id="sellers-result-box">

            <div class="text-xl font-medium text-center text-gray-500 ml-5">
                <ul class="flex flex-wrap -mb-px">
                    <li class="me-2">
                        <a class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300" href="{{route('seller.orders.new')}}">New Orders</a>
                    </li>
                    <li class="me-2">
                        <a href="{{route('seller.orders.awaiting')}}" class="inline-block p-4 text-emerald-600 border-b-2 border-emerald-600 rounded-t-lg active ">
                            Awaiting Orders
                        </a>
                    </li>
                </ul>
            </div>

            <div class="relative overflow-x-auto sm:rounded-lg mx-5 mt-3">
                <table class="w-full text-lg text-left rtl:text-right text-gray-500 " id="seller-pending-products-table">
                    <thead class="text-lg text-gray-700 uppercase bg-gray-50 ">
                        <tr>

                            <th scope="col" class="px-6 py-3">
                                Product Id
                            </th>
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
                                Ready
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($orders as $order)

                        <tr class="bg-white border-b hover:bg-gray-50 ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                @foreach ($products as $product)
                                @if ($product->id == $order->product_id)
                                {{$product->id}}
                                @endif
                                @endforeach
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                @foreach ($products as $product)
                                @if ($product->id == $order->product_id)
                                {{$product->title}}
                                @endif
                                @endforeach
                            </th>
                            <td class="px-6 py-4">
                                @foreach ($categories as $category)
                                @foreach ($products as $product)

                                @if ($product->id == $order->product_id)
                                @if ($category->id == $product->category_id)

                                {{$category->name}}

                                @endif
                                @endif
                                @endforeach
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                {{$order->qty}}
                            </td>
                            <td class="px-6 py-4">

                                <form action="{{route('seller.order.ship', $order->id)}}" method="POST">
                                    @csrf
                                    <button type="submit" class="p-3 bg-emerald-200   cursor-pointer hover:text-white hover:bg-emerald-300">
                                        Done
                                    </button>
                                </form>
                            </td>
                        </tr>

                        @endforeach


                    </tbody>
                </table>


            </div>

        </div>
    </div>
</section>

@include('seller.footer')