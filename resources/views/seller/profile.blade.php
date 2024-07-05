@include('seller.header')

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


<section class="bg-slate-100 pt-10 pb-10 h-screen ">
    <div class="md:flex md:flex-row">
        <div class="md:basis-1/6 text-xl">
        </div>
        <div class="md:basis-2/3">
            <div class="p-5 w-full mx-auto bg-white md:mt-10 shadow-lg shadow-slate-400/50 rounded sm:w-3/4 ">

                <div>
                    <form action="{{route('seller.profile.update')}}" method="POST" enctype="multipart/form-data" class="md:flex md:flex-row gap-4">

                        @csrf

                        <div class="md:basis-1/4">
                            <div class="mt-10 h-64 overflow-hidden">

                                <!-- profile image -->

                                <!-- <img src="{{url('seller/images/deafault-profile.jpg')}}" alt="profile-image" class="rounded object-cover" id="profile-image-prev"> -->

                                @foreach ($profileImage as $name)
                                @if ($name->name)
                                <img src="{{url('seller/images/'.$name->name)}}" alt="profile-image" class="rounded object-cover" id="profile-image-prev">
                                @else
                                <img src="{{url('seller/images/deafault-profile.jpg')}}" alt="profile-image" class="rounded object-cover" id="profile-image-prev">
                                @endif
                                @endforeach


                            </div>
                            <div class="text-center text-lg text-gray-400 font-bold cursor-pointer">
                                <label for="profile-img-selector" class="hover:text-slate-700 cursor-pointer" onclick="changeProfilePic();">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                    Edit
                                </label>

                                <input type="file" name="profile_image" class="hidden" id="profile-img-selector" accept="image/*">

                            </div>
                        </div>
                        <div class="md:basis-3/4 ">
                            <div class="text-gray-400 text-3xl">My Profile</div>
                            <div class="mt-5 grid grid-cols-2 gap-4">
                                <div>
                                    <div class="uppercase">first name</div>
                                    <input id="seller-profile-first-name" type="text" class="w-full bg-slate-200 py-2 px-3 " value="{{Auth::guard('seller')->user()->fname}}" name="first_name" required>
                                </div>
                                <div>
                                    <div class="uppercase">last name</div>
                                    <input id="seller-profile-last-name" type="text" class="w-full bg-slate-200 py-2 px-3 " value="{{Auth::guard('seller')->user()->lname}}" name="last_name" required>
                                </div>
                                <div>
                                    <div class="uppercase">shop name</div>
                                    <input id="seller-profile-nick-name" type="text" class="w-full bg-slate-200 py-2 px-3 " value="{{Auth::guard('seller')->user()['shop-name']}}" name="shop_name" required>
                                </div>
                                <div>
                                    <div class="uppercase">nic</div>
                                    <input id="seller-profile-nic-number" type="text" class="w-full bg-slate-200 py-2 px-3 " value="{{Auth::guard('seller')->user()->nic}}" name="nic_no" required>
                                </div>
                            </div>
                            <div class="mt-5 grid grid-cols-2 gap-4">
                                <div>
                                    <div class="uppercase text-gray-500 ">joined date-time</div>
                                    <input type="text" class="w-full bg-slate-200 text-gray-600 py-2 px-3 " disabled value="{{Auth::guard('seller')->user()->created_at}}" value="2024-12-05">
                                </div>
                                <div>
                                    <div class="uppercase">mobile</div>
                                    <input id="seller-profile-mobile" type="text" class="w-full bg-slate-200 py-2 px-3 " value="{{Auth::guard('seller')->user()->mobile}}" name="mobile" required>
                                </div>
                            </div>
                            <div class="mt-5">
                                <div>
                                    <div class="uppercase">email</div>
                                    <input id="seller-profile-email" type="email" class="w-full bg-slate-200 py-2 px-3" value="{{Auth::guard('seller')->user()->email}}" name="email" required>
                                </div>
                            </div>
                            <div class="mt-5">
                                <div class="grid grid-cols-3 gap-4">
                                    <div></div>
                                    <div>
                                        <div class="mt-5">
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <button class="w-full py-2 uppercase hover:bg-emerald-700 bg-emerald-800 font-bold text-white" type="submit">save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="md:basis-1/6 text-xl text-end mr-5">
    </div>
</section>

@include('seller.footer')