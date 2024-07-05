@include('seller.header')
<section>

    <div class="grid md:grid-cols-5 grid-cols-1 gap-5 mt-10 mx-10  text-gray-600 ">

        <div class="max-w-sm p-6 bg-emerald-100 border border-gray-200 rounded-lg shadow hover:bg-emerald-300 content-center font-bold cursor-pointer">
            <div class="text-5xl mx-5">
                <i class="fa fa-history" aria-hidden="true"></i>
                <span class="Single-1">21</span>
            </div>
            <div class="text-xl font-bold mt-5">Pending Products</div>
        </div>

        <div class="max-w-sm p-6 bg-emerald-100 border border-gray-200 rounded-lg shadow hover:bg-emerald-300 content-center font-bold cursor-pointer">
            <div class="text-5xl mx-5">
            <span class="Single-2">15</span>
            </div>
            <div class="text-xl font-bold mt-5">Disapproved Products</div>
        </div>

        <div class="max-w-sm p-6 bg-emerald-100 border border-gray-200 rounded-lg shadow hover:bg-emerald-300 content-center font-bold  cursor-pointer">
            <div class="text-5xl mx-5">
            <span class="Single-3">20</span>
            </div>
            <div class="text-xl font-bold mt-5">Hidden Products</div>
        </div>


        <div class="max-w-sm p-6 bg-emerald-100 border border-gray-200 rounded-lg shadow hover:bg-emerald-300 content-center font-bold  cursor-pointer">
            <div class="text-5xl mx-5">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <span class="Single-4">10</span>
            </div>
            <div class="text-xl font-bold mt-5">New Orders</div>
        </div>

        <div class="max-w-sm p-6 bg-emerald-100 border border-gray-200 rounded-lg shadow hover:bg-emerald-300 content-center font-bold  cursor-pointer">
            <div class="text-5xl mx-5">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <span class="Single">150</span>
            </div>
            <div class="text-xl font-bold mt-5">Delivered Orders</div>
        </div>
    </div>


    <div class="flex flex-row mt-10 gap-9 mx-10">
        <div class="basis-1/2 text-center align-center content-center">
            <div class="text-center align-center content-center">
                {!! $chart->renderHtml() !!}
                {!! $chart->renderChartJsLibrary() !!}
                {!! $chart->renderJs() !!}
            </div>
        </div>
        <div class="basis-1/2 border border-emarald-100 p-5">
            {!! $chart3->renderHtml() !!}
            {!! $chart3->renderChartJsLibrary() !!}
            {!! $chart3->renderJs() !!}
        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
    $({
        Counter: 0
    }).animate({
        Counter: $('.Single').text()
    }, {
        duration: 1000,
        easing: 'swing',
        step: function() {
            $('.Single').text(Math.ceil(this.Counter));
        }
    });
    $({
        Counter: 0
    }).animate({
        Counter: $('.Single-1').text()
    }, {
        duration: 1000,
        easing: 'swing',
        step: function() {
            $('.Single-1').text(Math.ceil(this.Counter));
        }
    });
    $({
        Counter: 0
    }).animate({
        Counter: $('.Single-2').text()
    }, {
        duration: 1000,
        easing: 'swing',
        step: function() {
            $('.Single-2').text(Math.ceil(this.Counter));
        }
    });
    $({
        Counter: 0
    }).animate({
        Counter: $('.Single-3').text()
    }, {
        duration: 1000,
        easing: 'swing',
        step: function() {
            $('.Single-3').text(Math.ceil(this.Counter));
        }
    });
    $({
        Counter: 0
    }).animate({
        Counter: $('.Single-4').text()
    }, {
        duration: 1000,
        easing: 'swing',
        step: function() {
            $('.Single-4').text(Math.ceil(this.Counter));
        }
    });
</script>

</body>

</html>