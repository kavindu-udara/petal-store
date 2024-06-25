@include('admin.header')


<section>
    <div class="py-3 rounded-lg bg-emerald-50 mx-5 mt-5">

        <div class="ml-5 mt-10 text-3xl mb-5 font-bold">Orders</div>


        <div id="sellers-result-box">
            <div class="text-xl font-medium text-center text-gray-500 ml-5">
                <ul class="flex flex-wrap -mb-px">
                    <li class="me-2">
                        <a href="{{route('admin.order')}}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                            Placed
                        </a>
                    </li>
                    <li class="me-2">
                        <a href="{{route('admin.order.awaiting')}}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                            Awaiting Shipment
                        </a>
                    </li>
                    <li class="me-2">
                        <a href="{{route('admin.order.shipped')}}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                            Shipped
                        </a>
                    </li>
                    <li class="me-2">
                        <a href="{{route('admin.order.delivered')}}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                            Delivered
                        </a>
                    </li>
                    <li class="me-2">
                        <a href="{{route('admin.order.cancelled')}}" class="inline-block p-4 text-emerald-600 border-b-2 border-emerald-600 rounded-t-lg active">
                            Cancelled
                        </a>
                    </li>
                    <li class="me-2">
                        <a href="{{route('admin.order.return')}}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                            Return Requested
                        </a>
                    </li>
                </ul>

                <div class="flex justify-end gap-5 mr-10">
                    <div>
                        <input type="text" class="rounded-lg bg-white py-2 border-2 px-3 w-full">
                    </div>
                </div>


            </div>


            <div class="relative overflow-x-auto sm:rounded-lg mx-5 mt-3">

                <table class="w-full text-lg text-left rtl:text-right text-gray-500" id="placed-orders-table">
                    <thead class="text-lg text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Order Id
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Product Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Qty
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Address
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Options
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($orders as $order)

                        <tr class="bg-white border-b hover:bg-gray-50 ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                {{$order->order_id}}
                            </th>
                            <td class="px-6 py-4">
                                @foreach ($allProducts as $allProduct)
                                @if ($allProduct->id==$order->product_id)
                                {{$allProduct->title}}
                                @endif
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                @foreach ($allProducts as $allProduct)
                                @if ($allProduct->id==$order->product_id)
                                Rs.{{$allProduct->price}}.00
                                @endif
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                {{$order->qty}}
                            </td>
                            <td class="px-6 py-4">
                                {{$userAddress[0]->line}}
                            </td>
                            <td class="px-6 py-4">
                                {{$order->created_at}}
                            </td>


                            <td class="px-6 py-4">

                                @if ($order->status=='6')

                                <div class=" text-emerald-600">Added to Stock</div>

                                @else

                                <button onclick="showandHidePopup('order-add-to-stock-pop-up-{{$order->id}}');" class="p-3 bg-emerald-200 rounded-xl cursor-pointer hover:bg-emerald-300 ">
                                    Add to stock
                                </button>

                                <button onclick="showandHidePopup('order-placed-pop-up-{{$order->id}}');" class="p-3 bg-red-200 rounded-xl  cursor-pointer  hover:bg-red-300">
                                    Placed
                                </button>

                                @endif



                            </td>

                        </tr>


                        <!-- order placed popup -->
                        <section id="order-placed-pop-up-{{$order->id}}" class="fixed top-0 left-0 w-full h-full opacity-100  backdrop-blur-sm justify-center items-center rounded hidden">
                            <div class="h-screen flex items-center justify-center">
                                <div class="bg-white p-10 rounded-lg shadow-sm ">
                                    <div class="text-center text-xl mb-5">Are You Sure ?</div>
                                    <form action="{{route('admin.order.update.placed', $order->id )}}" method="POST">
                                        @csrf

                                        <div class="grid grid-cols-2 gap-4">
                                            <button class="py-3 px-10 bg-red-300 rounded-lg text-lg text-center cursor-pointer hover:bg-red-400">Yes</button>
                                            <div onclick="showandHidePopup('order-placed-pop-up-{{$order->id}}');" class="py-3 px-10 bg-emerald-300 rounded-lg text-lg text-center cursor-pointer hover:bg-emerald-400">No</div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>

                        <!-- order add to stock popup -->
                        <section id="order-add-to-stock-pop-up-{{$order->id}}" class="fixed top-0 left-0 w-full h-full opacity-100  backdrop-blur-sm justify-center items-center rounded hidden">
                            <div class="h-screen flex items-center justify-center">
                                <div class="bg-white p-10 rounded-lg shadow-sm ">
                                    <div class="text-center text-xl mb-5">Are You Sure ?</div>
                                    <form action="{{route('admin.order.update.add.to.stock', $order->id)}}" method="POST">
                                        @csrf

                                        <div class="grid grid-cols-2 gap-4">
                                            <button class="py-3 px-10 bg-red-300 rounded-lg text-lg text-center cursor-pointer hover:bg-red-400">Yes</button>
                                            <div onclick="showandHidePopup('order-add-to-stock-pop-up-{{$order->id}}');" class="py-3 px-10 bg-emerald-300 rounded-lg text-lg text-center cursor-pointer hover:bg-emerald-400">No</div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>

                        @endforeach


                    </tbody>
                </table>

                <div class="flex justify-end">
                    <button onclick="orderPrint('placed-orders-table');" class="mr-10 py-2 px-3 bg-slate-100 rounded-lg mt-5 text-lg font-bold border-2 border-emerald-600">Print</button>
                </div>
            </div>
        </div>
    </div>
</section>

@include('admin.footer')