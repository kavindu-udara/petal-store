@include('admin.header')


<section>
    <div class="py-3 rounded-lg bg-emerald-50 mx-5 mt-5">
        <div class="ml-5 mt-10 text-3xl mb-5 font-bold">Sellers</div>
        <div id="sellers-result-box">
            <div class="text-xl font-medium text-center text-gray-500 ml-5">
                <ul class="md:flex md:flex-wrap -mb-px ">
                    <li class="me-2">
                        <a href="{{route('admin.sellers.pending')}}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                            Pending Sellers
                        </a>
                    </li>
                    <li class="me-2">
                        <a href="{{route('admin.sellers.all')}}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                            All Sellers
                        </a>
                    </li>
                    <li class="me-2">
                        <a href="{{route('admin.sellers.suspended')}}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                            Suspended Sellers
                        </a>
                    </li>
                    <li class="me-2">
                        <a href="{{route('admin.sellers.banned')}}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                            Baned Sellers
                        </a>
                    </li>
                    </li>
                    <li class="me-2">
                        <a href="{{route('admin.sellers.disapproved')}}" class="inline-block p-4 text-emerald-600 border-b-2 border-emerald-600 rounded-t-lg active" >
                            Disapproved Sellers
                        </a>
                    </li>
                </ul>

                @if ($sellers->count() != 0)
                <div class="flex justify-end gap-5 mr-10">
                    <div class="mb-3">
                        <a href="{{route('admin.seller.pdf.disapproved')}}" class="py-3 px-10 bg-emerald-300 rounded-lg text-lg text-center cursor-pointer hover:bg-emerald-400 font-bold">Print</a>
                    </div>
                </div>
                @endif


            </div>


            <div class="relative overflow-x-auto sm:rounded-lg mx-5 mt-3">

            @if ($sellers->count() != 0)
            
            <table class="w-full text-lg text-left rtl:text-right text-gray-500" id="seller-pending-table">
                    <thead class="text-lg text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Seller name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                mobile
                            </th>
                            <th scope="col" class="px-6 py-3">
                                nickname
                            </th>
                            <th scope="col" class="px-6 py-3">
                                approve
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($sellers as $seller)

                        <tr class="bg-white border-b hover:bg-gray-50 ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                {{$seller->fname}} {{$seller->lname}}
                            </th>
                            <td class="px-6 py-4">
                                {{$seller->email}}
                            </td>
                            <td class="px-6 py-4">
                                {{$seller->mobile}}
                            </td>
                            <td class="px-6 py-4">
                                {{$seller->shop_name}}
                            </td>
                            </td>
                            <td class="px-6 py-4">

                                <button onclick="showandHidePopup('seller-approve-pop-up-{{$seller->id}}');" class="p-3 bg-emerald-200 rounded-xl cursor-pointer hover:bg-emerald-200 hover:text-white">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </button>

                            </td>
                        </tr>

                        <section id="seller-approve-pop-up-{{$seller->id}}" class="fixed top-0 left-0 w-full h-full opacity-100  backdrop-blur-sm justify-center items-center rounded hidden">
                            <div class="h-screen flex items-center justify-center">
                                <div class="bg-white p-10 rounded-lg shadow-sm ">
                                    <div class="text-center text-xl mb-5">Are You Sure ?</div>

                                    <form action="{{route('admin.seller.approve', $seller->id)}}" method="POST">
                                        @csrf

                                        <div class="grid grid-cols-2 gap-4">
                                            <button class="py-3 px-10 bg-red-300 rounded-lg text-lg text-center cursor-pointer hover:bg-red-400">Yes</button>
                                            <div onclick="showandHidePopup('seller-approve-pop-up-{{$seller->id}}');" class="py-3 px-10 bg-emerald-300 rounded-lg text-lg text-center cursor-pointer hover:bg-emerald-400">No</div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>


                        @endforeach


                    </tbody>
                </table>

                @else

                <div class="text-xl font-medium text-center text-gray-500 ml-5">No sellers Found</div>

            @endif



            </div>
        </div>
    </div>
</section>

@include('admin.footer')