@include('header')

<section class="my-5">
    <div class="text-center text-5xl uppercase text-gray-500">contact us</div>
    <div class="text-center text-2xl mt-5 text-gray-600">
        We are a team of passionate plants.
    </div>
</section>

<section class="mt-10 mb-10">
    <div class="md:flex md:flex-rows">
        <div class="md:basis-1/6"></div>
        <div class="md:basis-4/6 bg-white shadow-lg ">

            <div class="md:flex md:flex-row">
                <div class="md:basis-2/3">
                    <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q=Eiffel+Tower+Paris+France" width="600" height="300" frameborder="0" style="border:0; width: 100%; height:100%" allowfullscreen></iframe>
                </div>
                <div class="md:basis-1/3 m-5">
                    <form action="https://formspree.io/f/xjvnqqpl"
                        method="POST">
                    <span>Name</span>
                    <input type="text" class="border border-gray-600 bg-white py-2 px-3 w-full mb-5" required>
                    <span class="mt-5">Email</span>
                    <input  type="email" name="email" class="border border-gray-600 bg-white py-2 px-3 w-full mb-5" required>
                    <span class="mt-5">Phone</span>
                    <input type="text" class="border border-gray-600 bg-white py-2 px-3 w-full mb-5" required>
                    <span class="mt-5">Message</span>
                    <textarea name="message" class="border border-gray-600 bg-white py-2 px-3 w-full mb-5" required></textarea>
                    <div class="flex flex-row">
                        <div class="basis-1/3"></div>
                        <div class="basis-1/3">
                            <button type="submit" class="bg-emerald-500 uppercase text-center text-xl p-5 text-white mb-5">send</button>
                            <div></div>
                        </div>
                        <div class="basis-1/3"></div>
                    </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="md:basis-1/6"></div>
    </div>
</section>

@include('footer')