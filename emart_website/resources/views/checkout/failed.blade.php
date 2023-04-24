@include('layouts.app')

@include('layouts.header')

<div class="siddhi-checkout">


<div class="container position-relative">
<div class="py-5 row">
<div class="col-md-12 mb-3">
<div>

<div class="siddhi-cart-item mb-3 rounded shadow-sm bg-white overflow-hidden">
<div class="siddhi-cart-item-profile bg-white p-3">
<div class="card card-default">
    
    @if($message = Session::get('error'))

        <div class="py-5 linus-coming-soon d-flex justify-content-center align-items-center">
            <div class="col-md-6">
            <div class="text-center pb-3">
            <h1 class="font-weight-bold">Linus, {{trans('lang.your_order_has_been_fail')}}.</h1>
                <p><strong>{{trans('lang.error')}}!</strong> {{ $message }}</p>
            </div>
            </div>
        </div>
    @endif
</div>
</div>
</div>


</div>
</div>
</div>

</div>
</div>


@include('layouts.footer')

@include('layouts.nav')

