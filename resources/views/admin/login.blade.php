<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Login | Seller</title>
    <!-- tailwind css -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- tailwind css -->
    @vite('resources/css/app.css')

    <!-- font awesome icons -->
    <link rel="stylesheet" href="{{asset('/font-awesome-4.7.0/css/font-awesome.min.css')}}">
</head>

<body>

    <section class=" top-0 left-0 w-full h-full opacity-100  backdrop-blur-sm justify-center items-center rounded ">

        <div class="h-screen flex items-center justify-center">

            <div class="bg-white p-10 rounded w-full ">

                <section id="signinBox">
                    <div class="flex min-h-full flex-col justify-center px-6 lg:px-8">
                        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                            <div class="text-center text-3xl font-bold text-emerald-800 mb-3">
                                <div class="cursor-pointer">Petal Hut</div>
                            </div>
                        </div>
                        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                            <h2 class="mt-5 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900 ">Sign in to your account</h2>
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

                        <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">

                            <form action="{{route('admin.login')}}" method="POST" class="space-y-6">
                                @csrf
                                <div>
                                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900 ">Email address</label>
                                    <div class="mt-2">
                                        <input id="signin-email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-3">
                                    </div>
                                </div>

                                <div>
                                    <div class="flex items-center justify-between">
                                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                                        <div class="text-sm">
                                            <a href="./forgotPassword.php" class="font-semibold text-emerald-600 hover:text-emerald-500">Forgot password?</a>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <input id="signin-password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-3">
                                    </div>
                                </div>

                                <div>

                                    <div class="flex items-center justify-between">

                                        <div class="text-sm">
                                            <input type="checkbox" id="signin-rememberme" name="rememberMe">
                                            <label for="signin-rememberme" class="font-semibold text-emerald-600 hover:text-emerald-500">Remember Me</label>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <button class="flex w-full justify-center rounded-md bg-emerald-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600" type="submit">Sign in</button>
                                </div>
                            </form>

                            <p class="mt-10 text-center text-sm text-gray-500">
                                Not a member?
                                <a href="{{route('seller.register.form')}}" id="signinBtn" class="font-semibold leading-6 text-emerald-600 hover:text-emerald-500">Register</a>
                            </p>
                        </div>
                    </div>
                </section>
            </div>
        </div>

    </section>

</body>

</html>