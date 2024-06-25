<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- tailwind css -->
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Order Confirmed!</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;" id="invoice-body">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td style="padding: 20px 0; text-align: center;">
                <table width="600" border="0" cellspacing="0" cellpadding="0" style="background-color: #ffffff; border: 1px solid #dddddd; border-radius: 5px; margin: 0 auto;">
                    <tr>
                        <td style="padding: 20px; text-align: center; background-color: #4CAF50; border-top-left-radius: 5px; border-top-right-radius: 5px; font-size:30px;">
                            <h1 style="color: #ffffff; margin: 0;">Petal_Hut</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px;">
                            <h2 style="color: #333333;">Order Confirmed!</h2>
                            <p style="color: #666666;">Thank you for your purchase. Your order has been successfully placed.</p>
                            <p style="color: #666666;">Order Number: <strong>
                                    {{$orderId}}
                                </strong></p>
                            <p style="color: #666666;">Order Date: <strong>
                                    {{$histories[0]->created_at}}
                                </strong></p>
                            <h3 style="color: #333333;">Purchased Products:</h3>
                            <table width="100%" border="0" cellspacing="0" cellpadding="10" style="border-collapse: collapse; margin-top: 10px;">
                                <thead>
                                    <tr style="background-color: #f4f4f4;">
                                        <th style="text-align: left; border-bottom: 1px solid #dddddd;">Product</th>
                                        <th style="text-align: center; border-bottom: 1px solid #dddddd;">Quantity</th>
                                        <th style="text-align: right; border-bottom: 1px solid #dddddd;">Price</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @php
                                $allQty=0;
                                $allTotal=0
                                @endphp

                                    @foreach ($histories as $history)

                                    <tr>
                                        <td style="border-bottom: 1px solid #dddddd;">
                                            @foreach ($allProducts as $allProduct)

                                            @if ($allProduct->id==$history->product_id)
                                            {{$allProduct->title}}
                                            @endif

                                            @endforeach
                                        </td>
                                        <td style="text-align: center; border-bottom: 1px solid #dddddd;">
                                            {{$history->qty}}
                                        </td>
                                        <td style="text-align: right; border-bottom: 1px solid #dddddd;">
                                            @foreach ($allProducts as $allProduct)

                                            @if ($allProduct->id==$history->product_id)
                                            Rs.{{$allProduct->price * $history->qty}}.00

                                            @php
                                            $allTotal=$allTotal+($allProduct->price * $history->qty);
                                            @endphp

                                            @endif

                                            @endforeach
                                        </td>
                                    </tr>

                                    @php
                                    $allQty=$allQty+$history->qty;
                                    
                                    @endphp

                                    @endforeach

                                    <tr>
                                        <td colspan="2" style="text-align: right; padding-top: 10px;">Shipping:</td>
                                        <td style="text-align: right; padding-top: 10px;">
                                            Rs.{{$allQty*$delivery}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align: right; padding-top: 10px;">Total:</td>
                                        <td style="text-align: right; padding-top: 10px;">
                                            Rs. {{$allTotal+($delivery*$allQty)}}.00</td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <p style="color: #666666;">If you have any questions or need further assistance, please feel free to contact our support team.</p>
                            <p style="color: #666666;">Thanks again for shopping with us!<br>The Petal_Hut Team</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; text-align: center; background-color: #f4f4f4; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
                            <p style="color: #aaaaaa; font-size: 12px;">&copy; 2024 Petal_Hut. All rights reserved.</p>
                            <p style="color: #aaaaaa; font-size: 12px;">123 Flower St, Blossom City, FL 12345</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

<div class="text-center">

    <button id="print-btn" class="bg-emerald-500 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded" onclick="window.print()">print</button>
</div>

</html>