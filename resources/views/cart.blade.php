@include('header')

@if ($carts->count() > 0)

<section>
    <div class="font-bold text-3xl mt-10 mb-5 ml-5">Shopping Cart</div>
    <div class="flex flex-row">
        <div class="basis-2/3">
            @php
            $fullQTY = 0;
            $subTotal = 0
            @endphp
            @foreach ($carts as $cart)
            <div class="grid grid-cols-5 my-5">
                <div>
                    <a href="./singleProduct.php?product=5">
                        @php
                        $showImage=true;
                        @endphp
                        @foreach ($allProductImages as $allProductImage)
                        @if ($allProductImage->product_id == $cart->product_id && $showImage)
                        <img src="{{asset('products/'.$allProductImage->name)}}" class="cursor-pointer mx-auto" width="150" alt="cx">
                        @php
                        $showImage=false;
                        @endphp
                        @endif
                        @endforeach
                    </a>
                </div>
                <div>
                    <div class="font-bold">
                        @foreach ($allProducts as $allProduct)
                        @if ($allProduct->id == $cart->product_id)
                        {{$allProduct->title}}



                        @endif

                        @endforeach
                    </div>
                    <div>
                        Rs
                        .@foreach ($allProducts as $allProduct)
                        @if ($allProduct->id == $cart->product_id)
                        {{$allProduct->price}}
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="content-center">
                    <input type="number" class="bg-gray-100 py-3 px-3 md:w-full border-none" value="{{$cart->qty}}" max="12" disabled>
                </div>


                @php
                $subTotal=$subTotal+($allProduct->price * $cart->qty);
                @endphp

                <div class="text-center content-center font-bold text-lg">
                    <div>Rs.{{$allProduct->price * $cart->qty}}</div>
                </div>
                <div class="text-center content-center">
                    <form action="{{route('remove.cart', $cart->product_id)}}" method="POST">
                        @csrf
                        <button type="submit"><i class="fa fa-times text-xl p-2 md:p-4 bg-slate-100 hover:bg-slate-200 hover:text-white" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
            @php
            $fullQTY=$fullQTY+($cart->qty);
            @endphp
            @endforeach
            <hr>
            <div class="flex flex-row-reverse mr-10">
                <div class="text-xl">
                    <div class="grid grid-cols-2 gap-5 my-5">
                        <div>
                            <div>Subtotal</div>
                            <div>Shipping</div>
                        </div>
                        <div class="text-left">
                            <div>{{$subTotal}}.00</div>
                            @if ($delivery)
                            <div>{{$delivery * $fullQTY}}.00</div>
                            @else
                            <a href="{{route('user.profile')}}">add address</a>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="grid grid-cols-2 gap-5 font-bold my-3">
                        <div>Total</div>
                        @if ($delivery)
                        <div class="text-end">{{$subTotal+($delivery * $fullQTY)}}.00</div>
                        @else
                        <div class="text-end">{{$subTotal}}.00</div>
                        @endif
                    </div>
                    <hr>
                    <hr>
                </div>
                <div></div>
                <div></div>
            </div>
        </div>

        <form action="{{route('user.stripe.pay', $subTotal+($delivery * $fullQTY))}}" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
        id="payment-form" class="basis-1/3" method="POST">

        @csrf

        <div class=" bg-slate-100 pt-5">
            <div class="font-bold text-3xl mt-10 mb-5 md:ml-5  md:text-left text-center">Card Details</div>
            <div class="mx-10 text-lg">
                <div class="mt-5">Name on Card</div>
                <input placeholder="Jhon Doe" type="text" class="w-full p-3 bg-white border-none">
                <br>
                <div class="mt-5">Card Number</div>
                <input size='20' name="card-number" placeholder="" type="text" class="w-full p-3  bg-white border-none">
                <div class="grid grid-cols-3 gap-5 mt-5">
                    <div>
                        <div>Month</div>
                        <input placeholder="MM" name="card-expiry-month" size='2' type="text" class="w-full p-3 bg-white border-none">
                    </div>
                    <div>
                        <div>Year</div>
                        <input placeholder="YYYY" name="card-expiry-year" size='4' type="text" class="w-full p-3 bg-white border-none">
                    </div>
                    <div>
                        <div>CVV</div>
                        <input size='4' placeholder="" name="card-cvc" type="text" class="w-full p-3 bg-white border-none">
                    </div>
                </div>
            </div>
            <div class="flex flex-row mt-5">
                <div class="basis-1/3"></div>
                <div class="basis-1/3">
                    <button type="submit" class="bg-emerald-800 uppercase text-slate-100 py-3 mt-5 px-10 font-bold w-full mb-5 hover:bg-emerald-700 text-base disabled:bg-emerald-200 disabled:cursor-not-allowed" @if (!$delivery) disabled @endif>checkout</button>
                </div>
                <div class="basis-1/3"></div>
            </div>
        </div>

        </form>

    </div>
</section>
@else

<section>
    <div class="text-center font-bold">No products available</div>
</section>

@endif





<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
@include('footer')