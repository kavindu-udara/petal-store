<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Register | Seller</title>
</head>

<body>

    <section class=" top-0 left-0 w-full h-full opacity-100  backdrop-blur-sm justify-center items-center rounded ">

        <div class="h-screen flex items-center justify-center">

            <div class="bg-white p-10 rounded w-full ">

                <section id="signupbox">
                    <div class="flex min-h-full flex-col justify-center px-6 lg:px-8">
                        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                            <div class="text-center text-3xl font-bold text-emerald-800 mb-3">
                                <div class="cursor-pointer">Petal Hut</div>
                            </div>
                        </div>
                        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                            <h2 class=" text-center text-2xl font-bold leading-9 tracking-tight text-gray-900 ">Create an account</h2>
                        </div>

                        <!-- alerts -->
                        @if (Session::has('error'))
                        <div class="sm:mx-auto sm:w-full sm:max-w-sm mt-10">
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:text-red-400" role="alert">
                                <span class="font-medium">{{session::get('error')}}</span>
                            </div>
                        </div>
                        @endif

                        <div class="mt-3 sm:mx-auto sm:w-full sm:max-w-sm">

                            <form action="{{route('seller.register')}}" method="POST" class="space-y-6">

                                @csrf

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="fname" class="block text-sm font-medium leading-6 text-gray-900 ">First name</label>
                                        <div class="mt-2">
                                            <input id="fname" name="fname" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-3">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="lname" class="block text-sm font-medium leading-6 text-gray-900 ">Last name</label>
                                        <div class="mt-2">
                                            <input id="lname" name="lname" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-3">
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="mobile" class="block text-sm font-medium leading-6 text-gray-900 ">Mobile</label>
                                        <div class="mt-2">
                                            <input id="mobile" name="phone" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-3">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="gender" class="block text-sm font-medium leading-6 text-gray-900 ">Gender</label>
                                        <div class="mt-2">

                                            <select id="gender" name="gender" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-3 ">

                                                @foreach ($data as $data)

                                                <option value="{{$data->id}}">{{$data->name}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="nickname" class="block text-sm font-medium leading-6 text-gray-900 ">Shop Name</label>
                                        <div class="mt-2">
                                            <input id="nickname" name="shopName" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6 px-3">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="nic" class="block text-sm font-medium leading-6 text-gray-900">NIC</label>
                                        <div class="mt-2">
                                            <input id="nic" required name="nic" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-3">
                                        </div>
                                    </div>
                                </div>


                                <div>
                                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900 ">Email address</label>
                                    <div class="mt-2">
                                        <input id="email" name="email" type="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-3">
                                    </div>
                                </div>

                                <div>
                                    <div class="flex items-center justify-between">
                                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900 ">Password</label>
                                    </div>
                                    <div class="mt-2">
                                        <input id="password" name="password" type="password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-3">
                                    </div>
                                </div>

                                <div>
                                    <div class="flex items-center justify-between">
                                        <label for="confirmPass" class="block text-sm font-medium leading-6 text-gray-900 ">Confirm Password</label>
                                    </div>
                                    <div class="mt-2">
                                        <input id="confirmPass" name="password_confirmation" type="password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-3">
                                    </div>
                                </div>

                                <div>
                                    <button class="flex w-full justify-center rounded-md bg-emerald-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600" type="submit">Register</button>
                                </div>
                            </form>


                            <p class="mt-10 text-center text-sm text-gray-500">
                                Not a member?
                                <a href="{{route('seller.login.form')}}" id="signinBtn" class="font-semibold leading-6 text-emerald-600 hover:text-emerald-500">Signin</a>
                            </p>
                        </div>
                    </div>
                </section>

            </div>
        </div>

    </section>

</body>

</html>