<?php
session_start();

$decimal_degits = 0;

if (@$rentalCarsData['decimal_degits']) {
    $decimal_degits = $rentalCarsData['decimal_degits'];
}

?>

<div class="col-md-8 pt-3 carbook-detail-left">


    <div class="card">
        <div class="carbook-summary">

            <div class="carbook-summary-box mb-4">
                <h3>{{trans('lang.pick_up')}}</h3>

                <?php


                $pick_up_date = "";
                $pick_up_address = "";

                if (@$rentalCarsData && @$rentalCarsData['startDate'] && @$rentalCarsData['startTime']) {

                    $startDate = $rentalCarsData['startDate'];
                    $date = str_replace('/', '-', $startDate);

                    $startDate = date('D, d M', strtotime($date));
                    $time = date("h:i:sa", strtotime($rentalCarsData['startTime']));
                    $pick_up_date = $startDate . ', ' . $time;

                }

                ?>
                <p><img src="../img/time-icon.png"><?php echo $pick_up_date; ?></p>
                <p><img src="../img/bk-location-icon.png"><?php echo @$rentalCarsData['pickLocation']; ?>
                </p>
            </div>

            <input type="hidden" id="pickupAddress" value="<?php echo @$rentalCarsData['pickLocation'];?>">
            <input type="hidden" id="pickupDateTime"
                   value="<?php echo date("Y-m-d H:i:s", strtotime($pick_up_date));?>">
            <input type="hidden" id="address_lat" value="<?php echo @$rentalCarsData['address_lat'];?>">
            <input type="hidden" id="address_lng" value="<?php echo @$rentalCarsData['address_lng'];?>">

            <div class="carbook-summary-box mb-4">
                <h3>{{trans('lang.drop_off')}}</h3>
                <?php
                $drop_off_date = "";

                if (@$rentalCarsData['endDate'] && @$rentalCarsData['endTime']) {
                    $endDate = $rentalCarsData['endDate'];
                    $date = str_replace('/', '-', $endDate);

                    $endDate = date('D, d M', strtotime($date));

                    $time = date("h:i:sa", strtotime($rentalCarsData['endTime']));
                    $drop_off_date = $endDate . ', ' . $time;
                }

                ?>
                <p><img src="../img/time-icon.png"><?php echo $drop_off_date;?></p>

                <?php

                if(@$rentalCarsData && @$rentalCarsData['pickLocation'] && @$rentalCarsData['isDropSameLocation'] == "true"){

                ?>
                <p><img src="../img/bk-location-icon.png"><?php echo $rentalCarsData['pickLocation']; ?></p>

                <?php }else{?>
                <p><img src="../img/bk-location-icon.png"><?php echo $rentalCarsData['dropLocation']; ?></p>


                <?php }?>

            </div>
            <input type="hidden" id="dropoffAddress" value="<?php echo @$rentalCarsData['dropLocation'];?>">
            <input type="hidden" id="drop_address_lat" value="<?php echo @$rentalCarsData['drop_address_lat'];?>">
            <input type="hidden" id="drop_address_lng" value="<?php echo @$rentalCarsData['drop_address_lng'];?>">
            <input type="hidden" id="dropDateTime"
                   value="<?php echo date("Y-m-d H:i:s", strtotime($drop_off_date));?>">


        </div>
    </div>
    <div class="card mt-3">
        <div class="coupon_detail">

        </div>
    </div>


</div>

<div class="col-md-4 pt-3 carbook-detail-right">
    <div class="siddhi-cart-item overflow-hidden bg-white sticky_sidebar"
         id="cart_list">
        <div class="search-box">
            <div class="search-box-inner input-group-sm mb-2 input-group">

                <input placeholder="{{trans('lang.promo_help')}}" value="" id="coupon_code" type="text"
                       class="form-control">

                <button type="button" class="btn btn-primary" id="apply-coupon-code">

                    {{trans('lang.apply')}}

                </button>

            </div>
        </div>


        <div class="bg-white p-3 clearfix carbook-rg-summary-box">

            <div class="carbook-payment-option">
                <h3>Select Payment</h3>
                <div class="payselect-option">
                    <select name="Payment" id="payment">
                        <option value="">Select Payment</option>
                        <option value="cash on delivery" style="display: none;" id="cod_box">Cash on Delivery</option>
                        <option value="razorpay" style="display: none;" id="razorpay_box">Razorpay</option>
                        <option value="stripe" style="display: none;" id="stripe_box">Stripe</option>
                        <option value="paypal" style="display: none;" id="paypal_box">Paypal</option>
                        <option value="payfast" style="display: none;" id="payfast_box">Payfast</option>
                        <option value="paystack" style="display: none;" id="paystack_box">PayStack</option>

                        <option value="flutterwave" style="display: none;" id="flutterWave_box">flutterWave</option>

                        <option value="mercadopago" style="display: none;" id="mercadopago_box">MercadoPago</option>

                        <option value="wallet" style="display: none;" id="wallet_box">
                        </option>

                    </select>


                    <input type="hidden" id="isEnabled">

                    <input type="hidden" id="isSandboxEnabled">

                    <input type="hidden" id="razorpayKey">

                    <input type="hidden" id="razorpaySecret">

                    <input type="hidden" id="isStripeSandboxEnabled">

                    <input type="hidden" id="stripeKey">

                    <input type="hidden" id="stripeSecret">

                    <input type="hidden" id="ispaypalSandboxEnabled">

                    <input type="hidden" id="paypalKey">

                    <input type="hidden" id="paypalSecret">

                    <input type="hidden" id="payfast_isEnabled">

                    <input type="hidden" id="payfast_isSandbox">

                    <input type="hidden" id="payfast_merchant_key">

                    <input type="hidden" id="payfast_merchant_id">

                    <input type="hidden" id="payfast_notify_url">

                    <input type="hidden" id="payfast_return_url">

                    <input type="hidden" id="payfast_cancel_url">

                    <input type="hidden" id="paystack_isEnabled">

                    <input type="hidden" id="paystack_isSandbox">

                    <input type="hidden" id="paystack_public_key">

                    <input type="hidden" id="paystack_secret_key">

                    <input type="hidden" id="flutterWave_isEnabled">

                    <input type="hidden" id="flutterWave_isSandbox">

                    <input type="hidden" id="flutterWave_encryption_key">

                    <input type="hidden" id="flutterWave_public_key">

                    <input type="hidden" id="flutterWave_secret_key">

                    <input type="hidden" id="mercadopago_isEnabled">

                    <input type="hidden" id="mercadopago_isSandbox">

                    <input type="hidden" id="mercadopago_public_key">

                    <input type="hidden" id="mercadopago_access_token">

                    <input type="hidden" id="title">

                    <input type="hidden" id="quantity">

                    <input type="hidden" id="unit_price">

                    <input type="hidden" id="user_wallet_amount">

                    <input type="hidden" id="bookWithDriver" value="<?php echo $rentalCarsData['isDriver']?>">


                </div>
            </div>

            <p class="btm-total mt-4">

            <?php

            $total_price = $total_amount = 0;
            //            $startDate = strtotime($rentalCarsData['startDate']);
            //            $endDate = strtotime($rentalCarsData['endDate']);


            $startDate = date("Y-m-d", strtotime($pick_up_date));

            $endDate = date("Y-m-d", strtotime($drop_off_date));

            $dayDifferent = abs(strtotime($startDate) - strtotime($endDate));

            $countDays = $dayDifferent / 86400;  // 86400 seconds in one day

            // and you might want to convert to integer
            $countDays = round($countDays) + 1;

            $carRateAmount = floatval($rentalCarsData['car_rate']) * $countDays;

            $driverRateAmount = 0;
            if ($rentalCarsData['isDriver'] == "true") {
                $driverRateAmount = $countDays * floatval($rentalCarsData['driver_rate']);
            }

            $total_price=floatval($carRateAmount);
            //$total_price = floatval($carRateAmount) + floatval($driverRateAmount);

            ?>
            <p class="mb-2">

                {{trans('lang.sub_total')}} <span class="float-right text-dark"><span
                            class="currency-symbol-left"></span><?php echo number_format($carRateAmount, $decimal_degits); ?><span
                            class="currency-symbol-right"></span></span>

            </p>
            <hr />
            <p class="mb-2">
                <?php
                $couponHtml = "";
                $discount = 0;
                $discountLabel = "";
                $discountType = "";

                if (@$rentalCarsData['coupon']['discountType'] && $rentalCarsData['coupon']['discountType']) {
                    if ($rentalCarsData['coupon']['discountType'] == "Percentage") {
                        $couponHtml = " (" . $rentalCarsData['coupon']['discount'] . "%)";
                        $discount = ($total_price * $rentalCarsData['coupon']['discount']) / 100;
                    }else{
                      $discount = $rentalCarsData['coupon']['discount'];
                    }


                    $discountType = $rentalCarsData['coupon']['discountType'];
                    $discountLabel = $rentalCarsData['coupon']['discount'];
                }

                $total_price = $total_price - $discount;

                ?>
                <label>{{trans('lang.discount')}} <?php echo $couponHtml;?></label>
                <span class="float-right text-dark"><?php echo "- ";?><span
                            class="currency-symbol-left"></span><?php if (@$rentalCarsData['coupon']['discount_amount'] && @$rentalCarsData['coupon']['discountType']) {

                        echo  number_format($discount, $decimal_degits);
                    } else {
                        echo  number_format(0, $decimal_degits);

                    }?><span class="currency-symbol-right"></span></span>

            </p>
            <input type="hidden" id="discount" value="<?php echo $discount; ?>">
            <input type="hidden" id="discountLabel" value="<?php echo $discountLabel; ?>">
            <input type="hidden" id="discountType" value="<?php echo $discountType; ?>">
            <hr>
            <p class="mb-2">
                <?php $total_price=$total_price+$driverRateAmount;?>
                {{trans('lang.driver_amount')}} <span class="float-right text-dark"><span
                            class="currency-symbol-left"></span><?php echo number_format($driverRateAmount, $decimal_degits); ?><span
                            class="currency-symbol-right"></span></span>

            </p>

            <input type="hidden" id="carRateAmount" value="<?php echo $carRateAmount; ?>">
            <input type="hidden" id="driverRateAmount" value="<?php echo $driverRateAmount; ?>">
            <input type="hidden" id="countDays" value="<?php echo $countDays; ?>">
            <input type="hidden" id="dayDifferent" value="<?php echo $dayDifferent; ?>">

            <hr>

            <?php

            $tax = $taxLabel = $taxType = $taxHtml = "";
            $taxAmount = 0;
            if (@$rentalCarsData['tax']) {

            $tax = $rentalCarsData['tax'];
            $taxLabel = $rentalCarsData['taxLabel'];
            $taxType = $rentalCarsData['taxType'];

            if ($taxType == "percent") {
                $taxAmount = ($total_price * $tax) / 100;

                $taxHtml = " (" . $tax . "%)";
            } else {
                $taxAmount = $tax;
            }

            $taxAmount = round($taxAmount, 2);

            $total_amount = $total_price + $taxAmount;

            ?>

            <p class="mb-2">

                <?php echo $taxLabel . $taxHtml; ?> <span class="float-right text-dark"><?php echo "+ ";?><span
                            class="currency-symbol-left"></span><?php echo number_format($taxAmount, $decimal_degits); ?><span
                            class="currency-symbol-right"></span></span>

            </p>

            <hr>
            <?php  }
            ?>
            <input type="hidden" id="taxLabel" value="<?php echo $taxLabel; ?>">

            <input type="hidden" id="tax" value="<?php echo $tax; ?>">

            <input type="hidden" id="taxType" value="<?php echo $taxType; ?>">

            <input type="hidden" id="adminCommission" value="<?php echo @$rentalCarsData['adminCommission']?>">

            <input type="hidden" id="adminCommissionType" value="<?php echo @$rentalCarsData['adminCommissionType']?>">

            <input type="hidden" id="total_pay" value="<?php echo $total_amount; ?>">

            <h6 class="font-weight-bold mb-0">{{trans('lang.total')}} <p class="float-right text-total-price"><span
                            class="currency-symbol-left"></span><span><?php echo number_format($total_amount, $decimal_degits); ?></span><span
                            class="currency-symbol-right"></span></p></h6>

        </div>


        <div class="car-book-pay-btn pt-4">

            <?php if($total_amount > 0){ ?>

            <a class="btn btn-primary btn-block btn-lg" href="javascript:void(0)"
               onclick="finalCheckout()">{{trans('lang.pay')}} <span
                        class="currency-symbol-left"></span><?php echo number_format($total_amount, $decimal_degits); ?>
                <span class="currency-symbol-right"></span><i class="feather-arrow-right"></i></a>


            <?php }else{ ?>

            <a class="btn btn-primary btn-block btn-lg">{{trans('lang.pay')}} <span
                        class="currency-symbol-left"></span><?php echo number_format($total_amount, $decimal_degits); ?>
                <span
                        class="currency-symbol-right"></span><i
                        class="feather-arrow-right"></i></a>

            <?php } ?>

        </div>
    </div>
</div>
