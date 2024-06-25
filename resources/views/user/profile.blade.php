@include('../header')


<section class="bg-slate-100 pt-10 pb-10 h-screen ">

    <div class="md:flex md:flex-row">
        <div class="md:basis-1/4"></div>
        <div class="md:basis-1/2 uppercase text-center text-gray-600 text-4xl">

            {{$profile->fname}} {{$profile->lname}}

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

                <form action="{{route('user.profile.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="md:flex md:flex-row gap-4">
                        <div class="md:basis-1/4">
                            <div class="mt-10 h-64 overflow-hidden">

                            @if ($profileImage)

                            <img src="{{url('user/images/'.$profileImage[0]->name)}}" alt="profile-image" class="rounded object-cover" id="profile-image-prev">

                            @else
                            
                            <img src="{{url('seller/images/deafault-profile.jpg')}}" alt="profile-image" class="rounded object-cover" id="profile-image-prev">

                            @endif

                            </div>
                            <div class="text-center text-lg text-gray-400 font-bold cursor-pointer mb-10 md:mb-5">
                                <label for="profile-img-selector" onclick="changeProfilePic();" class="hover:text-slate-700 cursor-pointer">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                    Edit
                                </label>
                                <input type="file" name="profile_img" class="hidden" id="profile-img-selector" accept="image/*">
                            </div>
                        </div>
                        <div class="md:basis-3/4">
                            <div class="text-gray-400 text-3xl text-center md:text-left">My Profile</div>
                            <div class="mt-5 md:grid md:grid-cols-2 gap-4">
                                <div>
                                    <div class="uppercase">first name</div>
                                    <input id="profile-first-name" name="first_name" type="text" class="w-full bg-slate-200 py-2 px-3" value="{{$profile->fname}}">
                                </div>
                                <div>
                                    <div class="uppercase">last name</div>
                                    <input id="profile-last-name" name="last_name" type="text" class="w-full bg-slate-200 py-2 px-3" value="{{$profile->lname}}">
                                </div>
                            </div>
                            <div class="mt-5 md:grid md:grid-cols-2 gap-4">
                                <div>
                                    <div class="uppercase text-gray-500 ">joined date-time</div>
                                    <input type="text" class="w-full bg-slate-200 text-gray-600 py-2 px-3" disabled value="{{$profile->created_at}}">
                                </div>
                                <div>
                                    <div class="uppercase">mobile</div>
                                    <input id="profile-mobile" name="mobile" type="text" class="w-full bg-slate-200 py-2 px-3" value="{{$profile->mobile}}">
                                </div>
                            </div>
                            <div class="mt-5">
                                <div>
                                    <div class="uppercase">email</div>
                                    <input id="profile-email" type="email" name="email" class="w-full bg-slate-200 py-2 px-3" value="{{$profile->email}}">
                                </div>
                            </div>

                            <!-- address -->
                            <div class="text-gray-400 text-3xl mt-5 text-center md:text-left">Address</div>

                            <div class="mt-5">
                                <div class="md:flex md:flex-row gap-4">
                                    <div class="md:basis-3/4">
                                        <div class="uppercase">street</div>
                                        <input id="profile-address-line" name="street" type="text" name="address" class="bg-slate-200 py-2 px-3 w-full" value="{{$userAddress->line}}">
                                    </div>
                                    <div class="md:basis-1/4">
                                        <div class="uppercase">city</div>
                                        <select id="profile-address-city" name="city" class="w-full bg-slate-200 py-2 px-3" name="city">
                                            <option value="0">select</option>

                                            @foreach ($cities as $city)
                                            <option value="{{$city->id}}"
                                            @if ($userAddress)
                                            @if ($userAddress->city_id == $city->id)
                                            selected
                                            @endif
                                            @endif
                                            >{{$city->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <div class="md:grid md:grid-cols-3 gap-4">
                                    <div>
                                        <div class="uppercase">district</div>
                                        <select name="district" id="profile-address-district" class="w-full bg-slate-200 py-2 px-3" name="district">
                                            <option value="0">select</option>
                                            @foreach ($districts as $district)
                                            <option value="{{$district->id}}">{{$district->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <div class="uppercase">province</div>
                                        <select name="province" id="profile-address-province" class="w-full bg-slate-200 py-2 px-3">
                                            <option value="0">select</option>
                                            @foreach ($provinces as $province)
                                            <option value="{{$province->id}}">{{$province->name}}</option>
                                            @endforeach

                                        </select>
                                        <div class="mt-10">
                                            <button class="w-full py-2 uppercase hover:bg-slate-500 bg-slate-400 font-bold text-white md:block hidden">cancel</button>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="uppercase">zipcode</div>
                                        <input name="zip" id="profile-address-zip" type="text" name="zip-code" class=" bg-slate-200 py-2 px-3 w-full" value="{{$userAddress->postal_code}}">
                                        <div class="mt-10">

                                            <button class="w-full py-2 uppercase hover:bg-slate-500 bg-slate-400 font-bold text-white md:hidden block mb-5">Go Back</button>

                                            <button type="submit" class="w-full py-2 uppercase hover:bg-emerald-700 bg-emerald-800 font-bold text-white">save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
        <div class="md:basis-1/6 text-xl text-end mr-5">
        </div>
    </div>
</section>

@include('user.footer')