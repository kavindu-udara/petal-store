@include('admin.header')



<section>
    <div class="py-3 rounded-lg bg-emerald-50 mx-5 mt-5">

        <div class="ml-5 mt-10 text-3xl mb-5 font-bold">Buyers</div>


        <div id="sellers-result-box">
            <div class="text-xl font-medium text-center text-gray-500 ml-5">

                <ul class="flex flex-wrap -mb-px">
                    <li class="me-2">
                        <a href="{{route('admin.users')}}" class="inline-block p-4 text-emerald-600 border-b-2 border-emerald-600 rounded-t-lg active ">
                            All Buyers
                        </a>
                    </li>
                    <li class="me-2">
                        <a href="{{route('admin.users.suspended')}}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                            Suspended Buyers
                        </a>
                    </li>
                    <li class="me-2">
                        <a href="{{route('admin.users.banned')}}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                            Banned Buyers
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

                <table class="w-full text-lg text-left rtl:text-right text-gray-500" id="buyer-all-table">
                    <thead class="text-lg text-gray-700 uppercase bg-gray-50 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Buyer name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                mobile
                            </th>
                            <th scope="col" class="px-6 py-3">
                                subscribed
                            </th>
                            <th scope="col" class="px-6 py-3">
                                options
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                    @foreach ($users as $user)

                    <tr class="bg-white border-b hover:bg-gray-50 ">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                {{$user->fname}}
                            </th>
                            <td class="px-6 py-4">
                                {{$user->email}}
                            </td>
                            <td class="px-6 py-4">
                                {{$user->mobile}}
                            </td>
                            <td class="px-6 py-4">
                                @if ($user->emailMe == 'false')
                                <span class="text-red-300">Not Subscribed</span>
                                @else
                                <span class="text-emerald-300">Subscribed</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">

                                <button class="p-3 bg-emerald-200 rounded-xl cursor-pointer hover:bg-emerald-200 hover:text-white">
                                    Edit
                                </button>

                                <button onclick="showandHidePopup('user-suspend-pop-up-{{$user->id}}');" class="p-3 bg-red-200 rounded-xl  cursor-pointer hover:text-white hover:bg-red-300">
                                    Suspend
                                </button>

                                <button onclick="showandHidePopup('user-ban-pop-up-{{$user->id}}');" class="p-3 bg-red-200 rounded-xl  cursor-pointer hover:text-white hover:bg-red-300">
                                Ban
                                </button>

                                <button onclick="showandHidePopup('user-delete-pop-up-{{$user->id}}');" class="p-3 bg-red-200 rounded-xl  cursor-pointer hover:text-white hover:bg-red-300">
                                    Delete
                                </button>

                            </td>
                        </tr>

                        
                        <!-- user suspend popup -->
                        <section id="user-suspend-pop-up-{{$user->id}}" class="fixed top-0 left-0 w-full h-full opacity-100  backdrop-blur-sm justify-center items-center rounded hidden">
                            <div class="h-screen flex items-center justify-center">
                                <div class="bg-white p-10 rounded-lg shadow-sm ">
                                    <div class="text-center text-xl mb-5">Are You Sure ?</div>

                                    <form action="{{route('admin.user.suspend', $user->id )}}" method="POST">
                                        @csrf

                                        <div class="grid grid-cols-2 gap-4">
                                            <button class="py-3 px-10 bg-red-300 rounded-lg text-lg text-center cursor-pointer hover:bg-red-400">Yes</button>
                                            <div onclick="showandHidePopup('user-suspend-pop-up-{{$user->id}}');" class="py-3 px-10 bg-emerald-300 rounded-lg text-lg text-center cursor-pointer hover:bg-emerald-400">No</div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>

                        <!-- user ban popup -->
                        <section id="user-ban-pop-up-{{$user->id}}" class="fixed top-0 left-0 w-full h-full opacity-100  backdrop-blur-sm justify-center items-center rounded hidden">
                            <div class="h-screen flex items-center justify-center">
                                <div class="bg-white p-10 rounded-lg shadow-sm ">
                                    <div class="text-center text-xl mb-5">Are You Sure ?</div>

                                    <form action="{{route('admin.user.ban', $user->id )}}" method="POST">
                                        @csrf

                                        <div class="grid grid-cols-2 gap-4">
                                            <button class="py-3 px-10 bg-red-300 rounded-lg text-lg text-center cursor-pointer hover:bg-red-400">Yes</button>
                                            <div onclick="showandHidePopup('user-ban-pop-up-{{$user->id}}');" class="py-3 px-10 bg-emerald-300 rounded-lg text-lg text-center cursor-pointer hover:bg-emerald-400">No</div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>

                        <!-- user delete popup -->
                        <section id="user-delete-pop-up-{{$user->id}}" class="fixed top-0 left-0 w-full h-full opacity-100  backdrop-blur-sm justify-center items-center rounded hidden">
                            <div class="h-screen flex items-center justify-center">
                                <div class="bg-white p-10 rounded-lg shadow-sm ">
                                    <div class="text-center text-xl mb-5">Are You Sure ?</div>

                                    <form action="{{route('admin.user.delete', $user->id )}}" method="POST">
                                        @csrf

                                        <div class="grid grid-cols-2 gap-4">
                                            <button class="py-3 px-10 bg-red-300 rounded-lg text-lg text-center cursor-pointer hover:bg-red-400">Yes</button>
                                            <div onclick="showandHidePopup('user-delete-pop-up-{{$user->id}}');" class="py-3 px-10 bg-emerald-300 rounded-lg text-lg text-center cursor-pointer hover:bg-emerald-400">No</div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    
                    @endforeach

                        
                    </tbody>
                </table>

                <div class="flex justify-end">
                    <button onclick="buyerPrint('buyer-all-table');" class="mr-10 py-2 px-3 bg-slate-100 rounded-lg mt-5 text-lg font-bold border-2 border-emerald-600">Print</button>
                </div>

            </div>
        </div>
    </div>
</section>


@include('admin.footer')