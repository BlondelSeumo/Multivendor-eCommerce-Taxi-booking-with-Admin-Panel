@include('layouts.app')

@include('layouts.header')

<div class="siddhi-checkout siddhi-checkout-payment">


    <div class="container position-relative">
        <div class="py-5 row">
            <div class="pb-2 align-items-starrt sec-title col">
                <h2 class="m-0">{{trans('lang.pay_with')}} {{trans('lang.pay_fast')}}</h2>
                <p class="sub-title">{{trans('lang.lorem_ipsum_message')}}</p>
            </div>
            <div class="col-md-12 mb-3">
                <div>

                    <div class="siddhi-cart-item mb-3 rounded shadow-sm bg-white overflow-hidden">
                        <div class="siddhi-cart-item-profile bg-white p-3">

                            <div class="card card-default payment-wrap">
                                <table class="payment-table">
                                    <thead>
                                    <tr>
                                        <th>
                                            {{trans('lang.pay_with')}}
                                        </th>
                                        <th class="text-right">
                                            {{trans('lang.total')}}
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr>
                                        <td>
                                            {{trans('lang.payfast_payment')}}
                                        </td>
                                        <td class="text-right payment-button">
                                            <?php
                                            if ($payfast_isSandbox) {
                                                $form_url = "https://sandbox.payfast.co.za/eng/process";
                                            } else {
                                                $form_url = "https://payfast.co.za/eng/process";
                                            }

                                            ?>
                                            <form action="<?php echo $form_url; ?>" method="post">
                                                <input type="hidden" name="merchant_id"
                                                       value="<?php echo $payfast_merchant_id; ?>">
                                                <input type="hidden" name="merchant_key"
                                                       value="<?php echo $payfast_merchant_key; ?>">
                                                <input type="hidden" name="amount" value="<?php echo $amount; ?>">
                                                <input type="hidden" name="item_name"
                                                       value="<?php echo env('APP_NAME'); ?>">
                                                <input type="hidden" name="payment_method" value="cc">
                                                <input type="hidden" name="return_url"
                                                       value="<?php echo $payfast_return_url; ?>">
                                                <input type="hidden" name="cancel_url"
                                                       value="<?php echo $payfast_cancel_url; ?>">
                                                <input type="hidden" name="notify_url"
                                                       value="<?php echo $payfast_notify_url; ?>">
                                                <input type="submit">
                                            </form>
                                        </td>
                                    </tr>
                                    </tbody>

                                </table>

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

