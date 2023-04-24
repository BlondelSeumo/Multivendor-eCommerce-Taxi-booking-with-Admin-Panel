@include('layouts.app')

@include('layouts.header')

<div class="siddhi-home-page">
    <div class="bg-primary px-3 d-none mobile-filter pb-3">
        <div class="row align-items-center">
            <div class="input-group rounded shadow-sm overflow-hidden col-md-9 col-sm-9">
                <div class="input-group-prepend">
                    <button class="border-0 btn btn-outline-secondary text-dark bg-white btn-block"><i
                                class="feather-search"></i></button>
                </div>
                <input type="text" class="shadow-none border-0 form-control" placeholder="Search for vendors or dishes">
            </div>
            <div class="text-white col-md-3 col-sm-3">
                <div class="title d-flex align-items-center">
                    <a class="text-white font-weight-bold ml-auto" data-toggle="modal" data-target="#exampleModal"
                       href="#">{{trans('lang.filter')}}</a>
                </div>
            </div>


        </div>
    </div>

    <div class="parcel_payment mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="parcel_payment_left col-md-8">
                    <div class="card">
                        <div class="parcel_payment-detail">
                            <div class="sender-det">


                                <h3><strong>{{trans('lang.sender')}}</strong> <?php if (@$parcel_cart['senderName']) {
                                        echo $parcel_cart['senderName'];
                                    }?></h3>
                                <p><?php if (@$parcel_cart['senderPhone']) {
                                        echo $parcel_cart['senderPhone'];
                                    }?></p>
                                <p><?php if (@$parcel_cart['senderAddress']) {
                                        echo $parcel_cart['senderAddress'];
                                    }?></p>
                            </div>

                            <div class="receiver-det">
                                <h3>
                                    <strong>{{trans('lang.receiver')}}</strong> <?php if (@$parcel_cart['receiverName']) {
                                        echo $parcel_cart['receiverName'];
                                    }?></h3>
                                <p><?php if (@$parcel_cart['receiverPhone']) {
                                        echo $parcel_cart['receiverPhone'];
                                    }?></p>
                                <p><?php if (@$parcel_cart['receiverAddress']) {
                                        echo $parcel_cart['receiverAddress'];
                                    }?></p>
                            </div>
                        </div>
                        <div class="parcel_payment_total">
                            <div class="row">
                                <div class="col-md-5 parcel_payment-box">
                                    <span class="label">Distance</span>
                                    <span class="total"><?php if (@$parcel_cart['parcelDeliveryKM']) {
                                            echo round($parcel_cart['parcelDeliveryKM'], 2);
                                        }?> KM </span>
                                </div>
                                <div class="col-md-5 parcel_payment-box">
                                    <span class="label">Weight</span>
                                    <span class="total"><?php if (@$parcel_cart['senderParcelWeightName']) {
                                            echo $parcel_cart['senderParcelWeightName'];
                                        }?></span>
                                </div>
                                <div class="col-md-2 parcel_payment-box">
                                    <span class="label">Rate</span>
                                    <span class="total price"><span
                                                class="currency-symbol-left"></span><?php if (@$parcel_cart['parcelDeliveryCharge']) {

                                            $decimal_degits = 0;

                                            if (@$parcel_cart['decimal_degits']) {
                                                $decimal_degits = $parcel_cart['decimal_degits'];
                                            }

                                            echo number_format($parcel_cart['parcelDeliveryCharge'], $decimal_degits);

                                        }?><span class="currency-symbol-right"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="coupon_detail">

                        </div>
                    </div>
                </div>

                <div class="col-md-4 parcel_payment_right">
                    <div class="card">
                        <input type="hidden" id="senderName" value="<?php echo $parcel_cart['senderName']; ?>">
                        <input type="hidden" id="senderPhone" value="<?php echo $parcel_cart['senderPhone']; ?>">
                        <input type="hidden" id="senderAddress" value="<?php echo $parcel_cart['senderAddress']; ?>">
                        <input type="hidden" id="receiverName" value="<?php echo $parcel_cart['receiverName']; ?>">
                        <input type="hidden" id="receiverPhone" value="<?php echo $parcel_cart['receiverPhone']; ?>">
                        <input type="hidden" id="receiverAddress"
                               value="<?php echo $parcel_cart['receiverAddress']; ?>">
                        <input type="hidden" id="parcelDeliveryKM"
                               value="<?php echo round($parcel_cart['parcelDeliveryKM'], 2); ?>">
                        <input type="hidden" id="senderParcelWeight"
                               value="<?php echo $parcel_cart['senderParcelWeight']; ?>">
                        <input type="hidden" id="senderParcelWeightName"
                               value="<?php echo $parcel_cart['senderParcelWeightName']; ?>">

                        <input type="hidden" id="parcelDeliveryCharge"
                               value="<?php echo round($parcel_cart['parcelDeliveryCharge'], 2); ?>">

                        <input type="hidden" id="parcelCategoryId"
                               value="<?php echo $parcel_cart['parcelCategoryId']; ?>">
                        <input type="hidden" id="senderNote" value="<?php echo $parcel_cart['senderNote']; ?>">

                        <input type="hidden" id="sender_address_lat"
                               value="<?php echo $parcel_cart['sender_address_lat']; ?>">
                        <input type="hidden" id="sender_address_lng"
                               value="<?php echo $parcel_cart['sender_address_lng']; ?>">
                        <input type="hidden" id="receiver_address_lng"
                               value="<?php echo $parcel_cart['receiver_address_lng']; ?>">
                        <input type="hidden" id="receiver_address_lat"
                               value="<?php echo $parcel_cart['receiver_address_lat']; ?>">
                        <input type="hidden" id="total_pay" value="<?php echo round($parcel_cart['total_pay'], 2); ?>">
                        <input type="hidden" id="deliveryCharge"
                               value="<?php echo round($parcel_cart['deliveryCharge'], 2); ?>">
                        <input type="hidden" id="discount"
                               value="<?php echo round($parcel_cart['coupon']['discount_amount'], 2); ?>">
                        <input type="hidden" id="discountType"
                               value="<?php echo $parcel_cart['coupon']['discountType']; ?>">
                        <input type="hidden" id="discountLabel"
                               value="<?php echo $parcel_cart['coupon']['discount']; ?>">
                        <input type="hidden" id="coupon_id" value="<?php echo $parcel_cart['coupon']['coupon_id']; ?>">
                        <input type="hidden" id="tax_amount" value="<?php echo $parcel_cart['tax_amount']; ?>">
                        <input type="hidden" id="tax_label" value="<?php echo $parcel_cart['tax_label']; ?>">
                        <input type="hidden" id="tax_type" value="<?php echo $parcel_cart['tax_type']; ?>">
                        <input type="hidden" id="isSchedule" value="<?php echo $parcel_cart['isSchedule']; ?>">
                        <input type="hidden" id="senderPickupDateTime"
                               value="<?php echo $parcel_cart['senderPickupDateTime']; ?>">
                        <input type="hidden" id="receiverPickupDateTime"
                               value="<?php echo $parcel_cart['receiverPickupDateTime']; ?>">

                        <div class="search-box">
                            <div class="search-box-inner">
                                <input type="text" id="parcel_coupon_code" placeholder="Enter Coupon code">
                                <a href="#" id="apply-coupon-code">{{trans('lang.apply')}}</a>
                            </div>
                        </div>
                        <div class="parcel_payment-way">
                            <input type="hidden" id="adminCommission" value="0">
                            <input type="hidden" id="adminCommissionType" value="">

                            <div class="payment_by">
                                <h5>Payment By</h3>
                                    <div class="payment_by_option">
                                        <ul>
                                            <li>
                                                <input type="radio" id="payment_by" name="payment_by" checked=""
                                                       value="sender">
                                                <label>Sender</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="payment_by" name="payment_by" value="receiver">
                                                <label>Receiver</label>
                                            </li>
                                        </ul>
                                    </div>
                            </div>
                            <div class="select_payment" id="payment_option">
                                <h5>Select Payment</h3>
                                    <div class="select_payment-option">
                                        <select id="payment_method" name="payment_method">
                                            <option>Select Payment</option>


                                            <option value="cash on delivery" style="display: none;" id="cod_box">Cash on
                                                Delivery
                                            </option>
                                            <option value="razorpay" style="display: none;" id="razorpay_box">Razorpay
                                            </option>
                                            <option value="stripe" style="display: none;" id="stripe_box">Stripe
                                            </option>
                                            <option value="paypal" style="display: none;" id="paypal_box">Paypal
                                            </option>
                                            <option value="payfast" style="display: none;" id="payfast_box">Payfast
                                            </option>
                                            <option value="paystack" style="display: none;" id="paystack_box">PayStack
                                            </option>

                                            <option value="flutterwave" style="display: none;" id="flutterWave_box">
                                                flutterWave
                                            </option>

                                            <option value="mercadopago" style="display: none;" id="mercadopago_box">
                                                MercadoPago
                                            </option>

                                            <option value="wallet" style="display: none;" id="wallet_box">Wallet
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


                                    </div>
                            </div>
                        <!-- <ul>
                                <li id="cod_box" style="display:none;">
                                    <input type="radio" name="payment_method" checked value="cod">
                                    <label>{{trans('lang.cash_on_delivery')}}</label>
                                </li>
                                <li id="razorpay_box" style="display:none;">
                                    <input type="radio" name="payment_method" value="razorpay">
                                    <label>{{trans('lang.razorpay')}}</label>
                                    <input type="hidden" id="isEnabled">

                                    <input type="hidden" id="isSandboxEnabled">

                                    <input type="hidden" id="razorpayKey">

                                    <input type="hidden" id="razorpaySecret">
                                </li>
                                <li id="stripe_box" style="display:none;">
                                    <input type="radio" name="payment_method" value="stripe">
                                    <label>{{trans('lang.stripe')}}</label>
                                    <input type="hidden" id="isStripeSandboxEnabled">

                                    <input type="hidden" id="stripeKey">

                                    <input type="hidden" id="stripeSecret">
                                </li>
                                <li id="paypal_box" style="display:none;">
                                    <input type="radio" name="payment_method" value="paypal">
                                    <label>{{trans('lang.pay_pal')}}</label>
                                    <input type="hidden" id="ispaypalSandboxEnabled">

                                    <input type="hidden" id="paypalKey">

                                    <input type="hidden" id="paypalSecret">
                                </li>
                                <li id="payfast_box" style="display:none;">
                                    <input type="radio" name="payment_method" value="payfast">
                                    <label>{{trans('lang.pay_fast')}}</label>
                                    <input type="hidden" id="payfast_isEnabled">

                                    <input type="hidden" id="payfast_isSandbox">

                                    <input type="hidden" id="payfast_merchant_key">

                                    <input type="hidden" id="payfast_merchant_id">

                                    <input type="hidden" id="payfast_notify_url">

                                    <input type="hidden" id="payfast_return_url">

                                    <input type="hidden" id="payfast_cancel_url">
                                </li>
                                <li id="paystack_box" style="display:none;">
                                    <input type="radio" name="payment_method" value="paystack">
                                    <label>{{trans('lang.pay_stack')}}</label>
                                    <input type="hidden" id="paystack_isEnabled">

                                    <input type="hidden" id="paystack_isSandbox">

                                    <input type="hidden" id="paystack_public_key">

                                    <input type="hidden" id="paystack_secret_key">

                                </li>
                                <li id="flutterWave_box" style="display:none;">
                                    <input type="radio" name="payment_method" value="flutterwave">
                                    <label>{{trans('lang.flutter_wave')}}</label>
                                    <input type="hidden" id="flutterWave_isEnabled">

                                    <input type="hidden" id="flutterWave_isSandbox">

                                    <input type="hidden" id="flutterWave_encryption_key">

                                    <input type="hidden" id="flutterWave_public_key">

                                    <input type="hidden" id="flutterWave_secret_key">
                                </li>
                                <li id="mercadopago_box" style="display:none;">
                                    <input type="radio" name="payment_method" value="mercadopago">
                                    <label>MercadoPago</label>
                                    <input type="hidden" id="mercadopago_isEnabled">

                                    <input type="hidden" id="mercadopago_isSandbox">

                                    <input type="hidden" id="mercadopago_public_key">

                                    <input type="hidden" id="mercadopago_access_token">

                                    <input type="hidden" id="title">

                                    <input type="hidden" id="quantity">

                                    <input type="hidden" id="unit_price">
                                </li>


                                <li id="wallet_box" style="display:none;">
                                    <input type="radio" name="payment_method" value="wallet">
                                    <label>Wallet ( You have <span class="currency-symbol-left"></span><span
                                                id="wallet_amount"></span><span class="currency-symbol-right"></span> )</label>
                                    <input type="hidden" id="user_wallet_amount">
                                </li>
                            </ul> -->


                            <div class="payment-total d-flex">


                                <label>{{trans('lang.sub_total')}}</label>
                                <span class="price ml-auto"><span class="currency-symbol-left"></span>
                    <?php if (@$parcel_cart['parcelDeliveryCharge']) {

                                        $decimal_degits = 0;

                                        if (@$parcel_cart['decimal_degits']) {
                                            $decimal_degits = $parcel_cart['decimal_degits'];
                                        }

                                        echo number_format($parcel_cart['parcelDeliveryCharge'], $decimal_degits);


                                    }?><span class="currency-symbol-right"></span></span>


                            </div>

                            <div class="payment-total d-flex">
                                <?php
                                $couponHtml = "";
                                if (@$parcel_cart['coupon']['discountType'] && $parcel_cart['coupon']['discountType']) {
                                    if ($parcel_cart['coupon']['discountType'] == "Percentage") {
                                        $couponHtml = " (" . $parcel_cart['coupon']['discount'] . "%)";
                                    }
                                }

                                ?>
                                <label>{{trans('lang.discount')}} <?php echo $couponHtml;?></label>
                                <span class="price ml-auto"><span
                                            class="currency-symbol-left"></span><?php if (@$parcel_cart['coupon']['discount_amount'] && @$parcel_cart['coupon']['discountType']) {

                                        $decimal_degits = 0;

                                        if (@$parcel_cart['decimal_degits']) {
                                            $decimal_degits = $parcel_cart['decimal_degits'];
                                        }

                                        echo number_format($parcel_cart['coupon']['discount_amount'], $decimal_degits);

                                    } else {

                                        $decimal_degits = 0;

                                        if (@$parcel_cart['decimal_degits']) {
                                            $decimal_degits = $parcel_cart['decimal_degits'];
                                        }

                                        echo number_format(0, $decimal_degits);

                                        ?>

                <?php }?><span class="currency-symbol-right"></span></span>

                            </div>
                            <div class="payment-total d-flex">

                                <?php if(@$parcel_cart['tax_amount']){ ?>
                                <label><?php echo $parcel_cart['tax_label']; ?>
                                    <?php
                                    if ($parcel_cart['tax_type'] != "fix") {
                                        echo "(" . $parcel_cart['tax_amount'] . "%)";
                                    }  ?>
                                </label>
                                <span class="price ml-auto"><span class="currency-symbol-left"></span>
                        <?php
                                    $decimal_degits = 0;

                                    if (@$parcel_cart['decimal_degits']) {
                                        $decimal_degits = $parcel_cart['decimal_degits'];
                                    }

                                    echo number_format($parcel_cart['tax_total_amount'], $decimal_degits);


                                    ?>
                        <span class="currency-symbol-right"></span></span>
                                <?php }?>
                            </div>

                            <div class="payment-total d-flex">


                                <label>{{trans('lang.order_total')}}</label>
                                <span class="price ml-auto"><span
                                            class="currency-symbol-left"></span><?php if (@$parcel_cart['total_pay']) {

                                        $decimal_degits = 0;

                                        if (@$parcel_cart['decimal_degits']) {
                                            $decimal_degits = $parcel_cart['decimal_degits'];
                                        }

                                        echo number_format($parcel_cart['total_pay'], $decimal_degits);

                                    }?><span class="currency-symbol-right"></span></span>


                            </div>
                        </div>
                        <div class="pay-btn">
                            <a href="#" id="pay_parcel" onclick="payCheckoutParcel()">{{trans('lang.pay')}} <span
                                        class="currency-symbol-left"></span><span
                                        class="price ml-auto"><?php if (@$parcel_cart['total_pay']) {

                                        $decimal_degits = 0;

                                        if (@$parcel_cart['decimal_degits']) {
                                            $decimal_degits = $parcel_cart['decimal_degits'];
                                        }

                                        echo number_format($parcel_cart['total_pay'], $decimal_degits);

                                    }?><span class="currency-symbol-right"></span></span></a>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>


</div>

@include('layouts.footer')
<script src="https://unpkg.com/geofirestore/dist/geofirestore.js"></script>

<script src="https://cdn.firebase.com/libs/geofire/5.0.1/geofire.min.js"></script>
<script type="text/javascript" src="{{asset('vendor/slick/slick.min.js')}}"></script>
<script type="text/javascript">

    var currentCurrency = '';
    var currencyAtRight = false;
    var wallet_amount = 0;
    var decimal_degits = 0;

    var fcmToken = '';
    var id_order = "<?php echo uniqid();?>";

    var userId = "<?php echo $id; ?>";
    console.log(userId)

    var userDetailsRef = database.collection('users').where('id', "==", userId);

    var refCurrency = database.collection('currencies').where('isActive', '==', true);

    var razorpaySettings = database.collection('settings').doc('razorpaySettings');

    var codSettings = database.collection('settings').doc('CODSettings');

    var stripeSettings = database.collection('settings').doc('stripeSettings');

    var paypalSettings = database.collection('settings').doc('paypalSettings');

    var walletSettings = database.collection('settings').doc('walletSettings');

    var payFastSettings = database.collection('settings').doc('payFastSettings');

    var payStackSettings = database.collection('settings').doc('parcelPayStack');

    var flutterWaveSettings = database.collection('settings').doc('flutterWave');

    var MercadoPagoSettings = database.collection('settings').doc('MercadoPago');

    var geoFirestore = new GeoFirestore(firestore);

    let currencyData = "";

    refCurrency.get().then(async function (snapshots) {
        currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;

        if (currencyData.decimal_degits) {
            decimal_degits = currencyData.decimal_degits;
        }

        loadcurrency();
    });
    $('input[name="payment_by"]').on('change', function () {
        var payment_by = $('input[name="payment_by"]:checked').val();
        if (payment_by == 'receiver') {
            $('#payment_option').hide();
        } else {
            $('#payment_option').show();
        }
    })
    codSettings.get().then(async function (codSettingsSnapshots) {

        codSettings = codSettingsSnapshots.data();
        if (codSettings.isEnabled) {
            $("#cod_box").show();
        } else {
            $("#cod_box").remove();
        }

    });

    razorpaySettings.get().then(async function (razorpaySettingsSnapshots) {

        razorpaySetting = razorpaySettingsSnapshots.data();

        if (razorpaySetting.isEnabled) {

            var isEnabled = razorpaySetting.isEnabled;

            $("#isEnabled").val(isEnabled);

            var isSandboxEnabled = razorpaySetting.isSandboxEnabled;

            $("#isSandboxEnabled").val(isSandboxEnabled);

            var razorpayKey = razorpaySetting.razorpayKey;

            $("#razorpayKey").val(razorpayKey);

            var razorpaySecret = razorpaySetting.razorpaySecret;

            $("#razorpaySecret").val(razorpaySecret);

            // $("#razorpay_box").show();


        }

    });

    stripeSettings.get().then(async function (stripeSettingsSnapshots) {

        stripeSetting = stripeSettingsSnapshots.data();

        if (stripeSetting.isEnabled) {

            var isEnabled = stripeSetting.isEnabled;

            var isSandboxEnabled = stripeSetting.isSandboxEnabled;

            $("#isStripeSandboxEnabled").val(isSandboxEnabled);

            var stripeKey = stripeSetting.stripeKey;

            $("#stripeKey").val(stripeKey);

            var stripeSecret = stripeSetting.stripeSecret;

            $("#stripeSecret").val(stripeSecret);

            $("#stripe_box").show();


        }

    });

    paypalSettings.get().then(async function (paypalSettingsSnapshots) {

        paypalSetting = paypalSettingsSnapshots.data();

        if (paypalSetting.isEnabled) {

            var isEnabled = paypalSetting.isEnabled;

            var isLive = paypalSetting.isLive;

            if (isLive) {

                $("#ispaypalSandboxEnabled").val(false);

            } else {

                $("#ispaypalSandboxEnabled").val(true);

            }

            var paypalAppId = paypalSetting.paypalAppId;

            $("#paypalKey").val(paypalAppId);

            var paypalSecret = paypalSetting.paypalSecret;

            $("#paypalSecret").val(paypalSecret);

            $("#paypal_box").show();


        }

    });

    walletSettings.get().then(async function (walletSettingsSnapshots) {

        walletSetting = walletSettingsSnapshots.data();

        if (walletSetting.isEnabled) {

            var isEnabled = walletSetting.isEnabled;

            if (isEnabled) {
                $("#walletenabled").val(true);
            } else {
                $("#walletenabled").val(false);
            }
            $("#wallet_box").show();

        }

    });


    MercadoPagoSettings.get().then(async function (MercadoPagoSettingsSnapshots) {

        MercadoPagoSetting = MercadoPagoSettingsSnapshots.data();

        if (MercadoPagoSetting != undefined) {
            if (MercadoPagoSetting.isEnabled) {

                var isEnable = MercadoPagoSetting.isEnabled;

                $("#mercadopago_isEnabled").val(isEnable);

                var isSandboxEnabled = MercadoPagoSetting.isSandboxEnabled;

                $("#mercadopago_isSandbox").val(isSandboxEnabled);

                var PublicKey = MercadoPagoSetting.PublicKey;

                $("#mercadopago_public_key").val(PublicKey);

                var AccessToken = MercadoPagoSetting.AccessToken;

                $("#mercadopago_access_token").val(AccessToken);

                var AccessToken = MercadoPagoSetting.AccessToken;

                $("#mercadopago_box").show();

            }
        }


    });

    payFastSettings.get().then(async function (payfastSettingsSnapshots) {

        payFastSetting = payfastSettingsSnapshots.data();
        if (payFastSetting.isEnable) {

            var isEnable = payFastSetting.isEnable;

            $("#payfast_isEnabled").val(isEnable);

            var isSandboxEnabled = payFastSetting.isSandbox;

            $("#payfast_isSandbox").val(isSandboxEnabled);

            var merchant_id = payFastSetting.merchant_id;

            $("#payfast_merchant_id").val(merchant_id);

            var merchant_key = payFastSetting.merchant_key;

            $("#payfast_merchant_key").val(merchant_key);

            var return_url = payFastSetting.return_url;

            $("#payfast_return_url").val(return_url);

            var cancel_url = payFastSetting.cancel_url;

            $("#payfast_cancel_url").val(cancel_url);

            var notify_url = payFastSetting.notify_url;

            $("#payfast_notify_url").val(notify_url);

            $("#payfast_box").show();

        }

    });

    payStackSettings.get().then(async function (payStackSettingsSnapshots) {

        payStackSetting = payStackSettingsSnapshots.data();
        if (payStackSetting.isEnable) {

            var isEnable = payStackSetting.isEnable;

            $("#paystack_isEnabled").val(isEnable);

            var isSandboxEnabled = payStackSetting.isSandbox;

            $("#paystack_isSandbox").val(isSandboxEnabled);

            var publicKey = payStackSetting.publicKey;

            $("#paystack_public_key").val(publicKey);

            var secretKey = payStackSetting.secretKey;

            $("#paystack_secret_key").val(secretKey);

            $("#paystack_box").show();

        }

    });

    flutterWaveSettings.get().then(async function (flutterWaveSettingsSnapshots) {

        flutterWaveSetting = flutterWaveSettingsSnapshots.data();
        if (flutterWaveSetting.isEnable) {

            var isEnable = flutterWaveSetting.isEnable;

            $("#flutterWave_isEnabled").val(isEnable);

            var isSandboxEnabled = flutterWaveSetting.isSandbox;

            $("#flutterWave_isSandbox").val(isSandboxEnabled);

            var encryptionKey = flutterWaveSetting.encryptionKey;

            $("#flutterWave_encryption_key").val(encryptionKey);

            var secretKey = flutterWaveSetting.secretKey;

            $("#flutterWave_secret_key").val(secretKey);

            var publicKey = flutterWaveSetting.publicKey;

            $("#flutterWave_public_key").val(publicKey);

            $("#flutterWave_box").show();

        }

    });

    userDetailsRef.get().then(async function (userSnapshots) {

        var userDetails = userSnapshots.docs[0].data();

        if (userDetails.wallet_amount != undefined && userDetails.wallet_amount != '') {
            $("#user_wallet_amount").val(userDetails.wallet_amount);
            $("#wallet_amount").html(userDetails.wallet_amount.toFixed(2));
            wallet_amount = userDetails.wallet_amount;

        } else {
            $("#user_wallet_amount").val(0);
            $("#wallet_amount").html(0);

        }
        loadcurrency();
    });

    let parcelCategoryId = $('#parcelCategoryId').val();

    getCouponDetails();

    async function getCouponDetails() {
        var today = new Date();

        var couponRef = database.collection('parcel_coupons').where('expiresAt', '>=', today);
        var couponHtml = '';
        let menuHtmlx = couponRef.get().then(async function (couponRefSnapshots) {
            couponHtml += '<div class="coupon-code"><label>Select Available Coupons to apply</label><span></span></div>';
            couponHtml += '<div class="copupon-list">';

            couponHtml += '<ul>';

            couponRefSnapshots.docs.forEach((doc) => {
                coupon = doc.data();

                if (coupon.isEnabled == true) {
                    couponHtml += '<li value="' + coupon.code + '"><a href="#">' + coupon.code + '</a></li>';

                }

            });
            couponHtml += '</ul></div>';

            return couponHtml;
        })
        let menuHtml = await menuHtmlx.then(function (html) {
            if (html != undefined) {
                return html;
            }
        })
        $('.coupon_detail').html(menuHtml);
    }

    $(document).on("click", '#apply-coupon-code', function (event) {
        var coupon_code = $("#parcel_coupon_code").val();

        var endOfToday = new Date();
        var couponCodeRef = database.collection('parcel_coupons').where('code', "==", coupon_code).where('isEnabled', "==", true).where('expiresAt', ">=", endOfToday);
        couponCodeRef.get().then(async function (couponSnapshots) {
            if (couponSnapshots.docs && couponSnapshots.docs.length) {
                var coupondata = couponSnapshots.docs[0].data();
                // if (coupondata.parcelCategoryId != undefined && coupondata.parcelCategoryId != '') {
                //     if (coupondata.isEnabled != true) {
                //
                //     }
                //     if (coupondata.expiresAt) {
                //
                //     }
                //     if (coupondata.parcelCategoryId == parcelCategoryId) {
                //         discount = coupondata.discount;
                //         coupon_id = coupondata.id;
                //         discountType = coupondata.discountType;
                //
                //         $.ajax({
                //             type: 'POST',
                //             url: "<?php //echo route('apply_parcel_coupon'); ?>",
                //             data: {
                //                 _token: '<?php //echo csrf_token() ?>',
                //                 coupon_code: coupon_code,
                //                 discount: discount,
                //                 discountType: discountType,
                //                 coupon_id: coupondata.id
                //             },
                //             success: function (data) {
                //                 data = JSON.parse(data);
                //                 window.location.reload();
                //                 loadcurrency();
                //
                //             }
                //         });
                //     } else {
                //         alert("Coupon code is not valid.");
                //         $("#coupon").val('');
                //
                //     }
                // } else {
                discount = coupondata.discount;
                discountType = coupondata.discountType;

                $.ajax({
                    type: 'POST',
                    url: "<?php echo route('apply_parcel_coupon'); ?>",
                    data: {
                        _token: '<?php echo csrf_token() ?>',
                        coupon_code: coupon_code,
                        discount: discount,
                        discountType: discountType,
                        coupon_id: coupondata.id
                    },
                    success: function (data) {
                        data = JSON.parse(data);
                        window.location.reload();
                        loadcurrency();

                    }
                });
                //  }
            } else {
                alert("Coupon code is not valid.");
                $("#parcel_coupon_code").val('');

            }
        });
    });

    $(document).on('click', '.copupon-list li', function (e) {

        var navSelectedValue = $(this).attr('value');
        $('#parcel_coupon_code').val(navSelectedValue);
        $('.copupon-list li a').removeClass('active');
        $(this).find('a').addClass('active');
    })


    function loadcurrency() {
        if (currencyAtRight) {
            jQuery('.currency-symbol-left').hide();
            jQuery('.currency-symbol-right').show();
            jQuery('.currency-symbol-right').text(currentCurrency);
        } else {
            jQuery('.currency-symbol-left').show();
            jQuery('.currency-symbol-right').hide();
            jQuery('.currency-symbol-left').text(currentCurrency);
        }
    }

    var section_id = "<?php echo @$_COOKIE['section_id'] ?>";

    var sectionRef = database.collection('sections').doc(section_id);

    sectionRef.get().then(async function (sectionRefSnapshots) {

        section = sectionRefSnapshots.data();

        if (section.isEnableCommission) {
            $("#adminCommission").val(section.commissionAmount);
            $("#adminCommissionType").val(section.commissionType);

        }

    });


    function payCheckoutParcel() {

        userDetailsRef.get().then(async function (userSnapshots) {

            var userDetails = userSnapshots.docs[0].data();

            var author = userDetails;

            var authorName = userDetails.firstName;
            var authorID = userId;
            var status = 'Order Placed';
            var payment_by = $('input[name="payment_by"]:checked').val();

            if (payment_by == 'receiver') {
                var payment_method = $('#payment_method').val('');
                var paymentCollectByReceiver = true;
            } else {
                var payment_method = $('#payment_method').val();
                var paymentCollectByReceiver = false;
            }

            console.log(payment_method)
            // var payment_method = $('input[name="payment_method"]:checked').val();
            var adminCommission = $("#adminCommission").val();
            var adminCommissionType = $("#adminCommissionType").val();
            var senderName = $('#senderName').val();
            var senderPhone = $('#senderPhone').val();
            var senderAddress = $('#senderAddress').val();
            var receiverName = $('#receiverName').val();
            var receiverPhone = $('#receiverPhone').val();
            var receiverAddress = $('#receiverAddress').val();
            var parcelDeliveryKM = $('#parcelDeliveryKM').val();
            var senderParcelWeight = $('#senderParcelWeight').val();
            var senderParcelWeightName = $('#senderParcelWeightName').val();
            var parcelDeliveryCharge = $('#parcelDeliveryCharge').val();
            var parcelCategoryId = $('#parcelCategoryId').val();
            var senderNote = $('#senderNote').val();
            var sender_address_lat = $('#sender_address_lat').val();
            var sender_address_lng = $('#sender_address_lng').val();
            var receiver_address_lng = $('#receiver_address_lng').val();
            var receiver_address_lat = $('#receiver_address_lat').val();

            var total_pay = $("#total_pay").val();
            var deliveryCharge = $("#deliveryCharge").val();
            // var adminCommission = $('#adminCommission').val();
            //var adminCommissionType = $('#adminCommissionType').val();
            var discount = $('#discount').val();
            var discountType = $('#discountType').val();
            var discountLabel = $('#discountLabel').val();
            var coupon_id = $('#coupon_id').val();
            var tax_amount = $('#tax_amount').val();
            var tax_label = $('#tax_label').val();
            var tax_type = $('#tax_type').val();
            var isSchedule = $('#isSchedule').val();
            var senderPickupDateTime = $('#senderPickupDateTime').val();
            var receiverPickupDateTime = $('#receiverPickupDateTime').val();

            var createdAt = new Date();

            var parcelImages = '<?php  echo $parcel_cart['parcelImages'] ?>';

            parcelImages = JSON.parse(parcelImages);

            if (discount == null && coupon_id == null && discountType == null && discountLabel == null) {
                discount = "0";
                coupon_id = "";
                discountType = "";
                discountLabel = "";
            }

            if ((senderPickupDateTime == null || senderPickupDateTime == "") && (receiverPickupDateTime == null || receiverPickupDateTime == "")) {
                senderPickupDateTime = createdAt;
                receiverPickupDateTime = createdAt;

            }


            senderPickupDateTime = firebase.firestore.Timestamp.fromDate(new Date(senderPickupDateTime)).toDate();
            receiverPickupDateTime = firebase.firestore.Timestamp.fromDate(new Date(receiverPickupDateTime)).toDate();


            regex = /^\s*(true|1|on)\s*$/i;

            isSchedule = regex.test(isSchedule);


            var sendToDriver = true;

            if (isSchedule == true) {
                var d1 = new Date();
                var today = new Date(d1.getUTCMonth(), d1.getUTCDate(), d1.getUTCFullYear(), d1.getUTCHours(), d1.getUTCMinutes(), d1.getUTCSeconds());

                if (senderPickupDateTime > today) {
                    sendToDriver = false;
                }
            }


            if (payment_method == "razorpay") {

                var razorpayKey = $("#razorpayKey").val();

                var razorpaySecret = $("#razorpaySecret").val();


                var order_json = {
                    authorID: authorID,
                    isSchedule: isSchedule,
                    status: status,
                    adminCommissionType: adminCommissionType,
                    adminCommission: adminCommission,
                    //author: author,
                    payment_method: payment_method,
                    paymentCollectByReceiver: paymentCollectByReceiver,
                    senderName: senderName,
                    section_id: section_id,
                    parcelCategoryId: parcelCategoryId,
                    senderAddress: senderAddress,
                    senderPhone: senderPhone,
                    senderParcelWeight: senderParcelWeight,
                    senderParcelWeightName: senderParcelWeightName,
                    senderNote: senderNote,
                    receiverAddress: receiverAddress,
                    receiverName: receiverName,
                    receiverPhone: receiverPhone,
                    sender_address_lng: sender_address_lng,
                    sender_address_lat: sender_address_lat,
                    receiver_address_lng: receiver_address_lng,
                    receiver_address_lat: receiver_address_lat,
                    deliveryCharge: deliveryCharge,
                    discount: discount,
                    discountType: discountType,
                    discountLabel: discountLabel,
                    coupon_id: coupon_id,
                    distance: parcelDeliveryKM,
                    subTotal: parcelDeliveryCharge,
                    tax_amount: tax_amount,
                    tax_label: tax_label,
                    tax_type: tax_type,
                    senderPickupDateTime: senderPickupDateTime,
                    receiverPickupDateTime: receiverPickupDateTime,
                    parcelImages: parcelImages,
                    sendToDriver:sendToDriver,

                };

                console.log(order_json);
                $.ajax({

                    type: 'POST',

                    url: "<?php echo route('parcel_order_proccessing'); ?>",

                    data: {
                        _token: '<?php echo csrf_token() ?>',
                        order_json: order_json,
                        razorpaySecret: razorpaySecret,
                        razorpayKey: razorpayKey,
                        payment_method: payment_method,
                        authorName: authorName,
                        total_pay: total_pay
                    },

                    success: function (data) {

                        data = JSON.parse(data);
                        loadcurrency();
                        window.location.href = "<?php echo route('process_parcel_order_pay'); ?>";


                    }

                });


            } else if (payment_method == "mercadopago") {

                var mercadopago_public_key = $("#mercadopago_public_key").val();
                var mercadopago_access_token = $("#mercadopago_access_token").val();
                var mercadopago_isSandbox = $("#mercadopago_isSandbox").val();
                var mercadopago_isEnabled = $("#mercadopago_isEnabled").val();

                var order_json = {
                    authorID: authorID,
                    isSchedule: isSchedule,
                    status: status,
                    adminCommissionType: adminCommissionType,
                    adminCommission: adminCommission,
                    //author: author,
                    payment_method: payment_method,
                    paymentCollectByReceiver: paymentCollectByReceiver,
                    senderName: senderName,
                    section_id: section_id,
                    parcelCategoryId: parcelCategoryId,
                    senderAddress: senderAddress,
                    senderPhone: senderPhone,
                    senderParcelWeight: senderParcelWeight,
                    senderParcelWeightName: senderParcelWeightName,
                    senderNote: senderNote,
                    receiverAddress: receiverAddress,
                    receiverName: receiverName,
                    receiverPhone: receiverPhone,
                    sender_address_lng: sender_address_lng,
                    sender_address_lat: sender_address_lat,
                    receiver_address_lng: receiver_address_lng,
                    receiver_address_lat: receiver_address_lat,
                    deliveryCharge: deliveryCharge,
                    discount: discount,
                    discountType: discountType,
                    discountLabel: discountLabel,
                    coupon_id: coupon_id,
                    distance: parcelDeliveryKM,
                    subTotal: parcelDeliveryCharge,
                    tax_amount: tax_amount,
                    tax_label: tax_label,
                    tax_type: tax_type,
                    senderPickupDateTime: senderPickupDateTime,
                    receiverPickupDateTime: receiverPickupDateTime,
                    parcelImages: parcelImages,
                    sendToDriver:sendToDriver,


                };

                $.ajax({

                    type: 'POST',

                    url: "<?php echo route('parcel_order_proccessing'); ?>",

                    data: {
                        _token: '<?php echo csrf_token() ?>',
                        order_json: order_json,
                        mercadopago_public_key: mercadopago_public_key,
                        mercadopago_access_token: mercadopago_access_token,
                        payment_method: payment_method,
                        authorName: authorName,
                        id: id_order,
                        total_pay: total_pay,
                        mercadopago_isSandbox: mercadopago_isSandbox,
                        mercadopago_isEnabled: mercadopago_isEnabled,
                        address_line1: $("#address_line1").val(),
                        address_line2: $("#address_line2").val(),
                        address_zipcode: $("#address_zipcode").val(),
                        address_city: $("#address_city").val(),
                        address_country: $("#address_country").val()
                    },

                    success: function (data) {

                        data = JSON.parse(data);
                        loadcurrency();
                        window.location.href = "<?php echo route('process_parcel_order_pay'); ?>";


                    }

                });

            } else if (payment_method == "stripe") {

                var stripeKey = $("#stripeKey").val();

                var stripeSecret = $("#stripeSecret").val();

                var isStripeSandboxEnabled = $("#isStripeSandboxEnabled").val();

                var order_json = {
                    authorID: authorID,
                    id: id_order,
                    status: status,
                    isSchedule: isSchedule,
                    adminCommissionType: adminCommissionType,
                    adminCommission: adminCommission,
                    //author: author,
                    payment_method: payment_method,
                    paymentCollectByReceiver: paymentCollectByReceiver,
                    senderName: senderName,
                    section_id: section_id,
                    parcelCategoryId: parcelCategoryId,
                    senderAddress: senderAddress,
                    senderPhone: senderPhone,
                    senderParcelWeight: senderParcelWeight,
                    senderParcelWeightName: senderParcelWeightName,
                    senderNote: senderNote,
                    receiverAddress: receiverAddress,
                    receiverName: receiverName,
                    receiverPhone: receiverPhone,
                    sender_address_lng: sender_address_lng,
                    sender_address_lat: sender_address_lat,
                    receiver_address_lng: receiver_address_lng,
                    receiver_address_lat: receiver_address_lat,
                    deliveryCharge: deliveryCharge,
                    discount: discount,
                    discountType: discountType,
                    discountLabel: discountLabel,
                    coupon_id: coupon_id,
                    distance: parcelDeliveryKM,
                    subTotal: parcelDeliveryCharge,
                    tax_amount: tax_amount,
                    tax_label: tax_label,
                    tax_type: tax_type,
                    senderPickupDateTime: senderPickupDateTime,
                    receiverPickupDateTime: receiverPickupDateTime,
                    parcelImages: parcelImages,
                    sendToDriver:sendToDriver,


                };


                $.ajax({

                    type: 'POST',

                    url: "<?php echo route('parcel_order_proccessing'); ?>",

                    data: {
                        _token: '<?php echo csrf_token() ?>',
                        order_json: order_json,
                        stripeKey: stripeKey,
                        stripeSecret: stripeSecret,
                        payment_method: payment_method,
                        authorName: authorName,
                        total_pay: total_pay,
                        isStripeSandboxEnabled: isStripeSandboxEnabled,
                        senderAddress: senderAddress,
                    },

                    success: function (data) {

                        data = JSON.parse(data);

                        loadcurrency();
                        window.location.href = "<?php echo route('process_parcel_order_pay'); ?>";


                    }

                });


            } else if (payment_method == "paypal") {


                var paypalKey = $("#paypalKey").val();

                var paypalSecret = $("#paypalSecret").val();

                var ispaypalSandboxEnabled = $("#ispaypalSandboxEnabled").val();

                var order_json = {
                    authorID: authorID,
                    id: id_order,
                    status: status,
                    isSchedule: isSchedule,
                    adminCommissionType: adminCommissionType,
                    adminCommission: adminCommission,
                    //author: author,
                    payment_method: payment_method,
                    paymentCollectByReceiver: paymentCollectByReceiver,
                    senderName: senderName,
                    section_id: section_id,
                    parcelCategoryId: parcelCategoryId,
                    senderAddress: senderAddress,
                    senderPhone: senderPhone,
                    senderParcelWeight: senderParcelWeight,
                    senderParcelWeightName: senderParcelWeightName,
                    senderNote: senderNote,
                    receiverAddress: receiverAddress,
                    receiverName: receiverName,
                    receiverPhone: receiverPhone,
                    sender_address_lng: sender_address_lng,
                    sender_address_lat: sender_address_lat,
                    receiver_address_lng: receiver_address_lng,
                    receiver_address_lat: receiver_address_lat,
                    deliveryCharge: deliveryCharge,
                    discount: discount,
                    discountType: discountType,
                    discountLabel: discountLabel,
                    coupon_id: coupon_id,
                    distance: parcelDeliveryKM,
                    subTotal: parcelDeliveryCharge,
                    tax_amount: tax_amount,
                    tax_label: tax_label,
                    tax_type: tax_type,
                    senderPickupDateTime: senderPickupDateTime,
                    receiverPickupDateTime: receiverPickupDateTime,
                    parcelImages: parcelImages,
                    sendToDriver:sendToDriver,

                };


                $.ajax({

                    type: 'POST',

                    url: "<?php echo route('parcel_order_proccessing'); ?>",

                    data: {
                        _token: '<?php echo csrf_token() ?>',
                        order_json: order_json,
                        paypalKey: paypalKey,
                        paypalSecret: paypalSecret,
                        payment_method: payment_method,
                        authorName: authorName,
                        total_pay: total_pay,
                        ispaypalSandboxEnabled: ispaypalSandboxEnabled
                    },

                    success: function (data) {

                        data = JSON.parse(data);

                        loadcurrency();
                        window.location.href = "<?php echo route('process_parcel_order_pay'); ?>";
                    }

                });


            } else if (payment_method == "payfast") {

                var payfast_merchant_key = $("#payfast_merchant_key").val();
                var payfast_merchant_id = $("#payfast_merchant_id").val();
                var payfast_return_url = $("#payfast_return_url").val();
                var payfast_notify_url = $("#payfast_notify_url").val();
                var payfast_cancel_url = $("#payfast_cancel_url").val();
                var payfast_isSandbox = $("#payfast_isSandbox").val();

                var order_json = {
                    authorID: authorID,
                    id: id_order,
                    status: status,
                    isSchedule: isSchedule,
                    adminCommissionType: adminCommissionType,
                    adminCommission: adminCommission,
                    //author: author,
                    payment_method: payment_method,
                    paymentCollectByReceiver: paymentCollectByReceiver,
                    senderName: senderName,
                    section_id: section_id,
                    parcelCategoryId: parcelCategoryId,
                    senderAddress: senderAddress,
                    senderPhone: senderPhone,
                    senderParcelWeight: senderParcelWeight,
                    senderParcelWeightName: senderParcelWeightName,
                    senderNote: senderNote,
                    receiverAddress: receiverAddress,
                    receiverName: receiverName,
                    receiverPhone: receiverPhone,
                    sender_address_lng: sender_address_lng,
                    sender_address_lat: sender_address_lat,
                    receiver_address_lng: receiver_address_lng,
                    receiver_address_lat: receiver_address_lat,
                    deliveryCharge: deliveryCharge,
                    discount: discount,
                    discountType: discountType,
                    discountLabel: discountLabel,
                    coupon_id: coupon_id,
                    distance: parcelDeliveryKM,
                    subTotal: parcelDeliveryCharge,
                    tax_amount: tax_amount,
                    tax_label: tax_label,
                    tax_type: tax_type,
                    senderPickupDateTime: senderPickupDateTime,
                    receiverPickupDateTime: receiverPickupDateTime,
                    parcelImages: parcelImages,
                    sendToDriver:sendToDriver,


                };

                $.ajax({

                    type: 'POST',

                    url: "<?php echo route('parcel_order_proccessing'); ?>",

                    data: {
                        _token: '<?php echo csrf_token() ?>',
                        order_json: order_json,
                        payfast_merchant_key: payfast_merchant_key,
                        payfast_merchant_id: payfast_merchant_id,
                        payment_method: payment_method,
                        authorName: authorName,
                        total_pay: total_pay,
                        payfast_isSandbox: payfast_isSandbox,
                        payfast_return_url: payfast_return_url,
                        payfast_notify_url: payfast_notify_url,
                        payfast_cancel_url: payfast_cancel_url,
                    },

                    success: function (data) {

                        data = JSON.parse(data);

                        loadcurrency();
                        window.location.href = "<?php echo route('process_parcel_order_pay'); ?>";

                    }

                });

            } else if (payment_method == "paystack") {

                var paystack_public_key = $("#paystack_public_key").val();
                var paystack_secret_key = $("#paystack_secret_key").val();
                var paystack_isSandbox = $("#paystack_isSandbox").val();

                var order_json = {
                    authorID: authorID,
                    id: id_order,
                    status: status,
                    isSchedule: isSchedule,
                    adminCommissionType: adminCommissionType,
                    adminCommission: adminCommission,
                    //author: author,
                    payment_method: payment_method,
                    paymentCollectByReceiver: paymentCollectByReceiver,
                    senderName: senderName,
                    section_id: section_id,
                    parcelCategoryId: parcelCategoryId,
                    senderAddress: senderAddress,
                    senderPhone: senderPhone,
                    senderParcelWeight: senderParcelWeight,
                    senderParcelWeightName: senderParcelWeightName,
                    senderNote: senderNote,
                    receiverAddress: receiverAddress,
                    receiverName: receiverName,
                    receiverPhone: receiverPhone,
                    sender_address_lng: sender_address_lng,
                    sender_address_lat: sender_address_lat,
                    receiver_address_lng: receiver_address_lng,
                    receiver_address_lat: receiver_address_lat,
                    deliveryCharge: deliveryCharge,
                    discount: discount,
                    discountType: discountType,
                    discountLabel: discountLabel,
                    coupon_id: coupon_id,
                    distance: parcelDeliveryKM,
                    subTotal: parcelDeliveryCharge,
                    tax_amount: tax_amount,
                    tax_label: tax_label,
                    tax_type: tax_type,
                    senderPickupDateTime: senderPickupDateTime,
                    receiverPickupDateTime: receiverPickupDateTime,
                    parcelImages: parcelImages,
                    sendToDriver:sendToDriver,


                };

                $.ajax({

                    type: 'POST',

                    url: "<?php echo route('parcel_order_proccessing'); ?>",

                    data: {
                        _token: '<?php echo csrf_token() ?>',
                        order_json: order_json,
                        payment_method: payment_method,
                        authorName: authorName,
                        total_pay: total_pay,
                        paystack_isSandbox: paystack_isSandbox,
                        paystack_public_key: paystack_public_key,
                        paystack_secret_key: paystack_secret_key
                    },

                    success: function (data) {

                        data = JSON.parse(data);

                        loadcurrency();
                        window.location.href = "<?php echo route('process_parcel_order_pay'); ?>";


                    }

                });

            } else if (payment_method == "flutterwave") {

                var flutterwave_isenabled = $("#flutterWave_isEnabled").val();
                var flutterWave_encryption_key = $("#flutterWave_encryption_key").val();
                var flutterWave_public_key = $("#flutterWave_public_key").val();
                var flutterWave_secret_key = $("#flutterWave_secret_key").val();
                var flutterWave_isSandbox = $("#flutterWave_isSandbox").val();

                var order_json = {
                    authorID: authorID,
                    id: id_order,
                    status: status,
                    isSchedule: isSchedule,
                    adminCommissionType: adminCommissionType,
                    adminCommission: adminCommission,
                    //author: author,
                    payment_method: payment_method,
                    paymentCollectByReceiver: paymentCollectByReceiver,
                    senderName: senderName,
                    section_id: section_id,
                    parcelCategoryId: parcelCategoryId,
                    senderAddress: senderAddress,
                    senderPhone: senderPhone,
                    senderParcelWeight: senderParcelWeight,
                    senderParcelWeightName: senderParcelWeightName,
                    senderNote: senderNote,
                    receiverAddress: receiverAddress,
                    receiverName: receiverName,
                    receiverPhone: receiverPhone,
                    sender_address_lng: sender_address_lng,
                    sender_address_lat: sender_address_lat,
                    receiver_address_lng: receiver_address_lng,
                    receiver_address_lat: receiver_address_lat,
                    deliveryCharge: deliveryCharge,
                    discount: discount,
                    discountType: discountType,
                    discountLabel: discountLabel,
                    coupon_id: coupon_id,
                    distance: parcelDeliveryKM,
                    subTotal: parcelDeliveryCharge,
                    tax_amount: tax_amount,
                    tax_label: tax_label,
                    tax_type: tax_type,
                    senderPickupDateTime: senderPickupDateTime,
                    receiverPickupDateTime: receiverPickupDateTime,
                    parcelImages: parcelImages,
                    sendToDriver:sendToDriver,


                };

                $.ajax({

                    type: 'POST',

                    url: "<?php echo route('parcel_order_proccessing'); ?>",

                    data: {
                        _token: '<?php echo csrf_token() ?>',
                        order_json: order_json,
                        payment_method: payment_method,
                        authorName: authorName,
                        total_pay: total_pay,
                        flutterWave_isSandbox: flutterWave_isSandbox,
                        flutterWave_public_key: flutterWave_public_key,
                        flutterWave_secret_key: flutterWave_secret_key,
                        flutterwave_isenabled: flutterwave_isenabled,
                        flutterWave_encryption_key: flutterWave_encryption_key,
                        currencyData: currencyData
                    },

                    success: function (data) {

                        data = JSON.parse(data);

                        loadcurrency();
                        window.location.href = "<?php echo route('process_parcel_order_pay'); ?>";

                    }

                });

            } else {

                if (payment_method == "wallet") {
                    payment_method = "wallet";
                    if (wallet_amount < total_pay) {
                        alert("you don't have sufficient balance to place this order!");
                        return false;
                    }
                } else {
                    payment_method = "cod";
                }


                var receiverObject = {
                    'address': receiverAddress,
                    'name': receiverName,
                    'phone': receiverPhone,
                }


                var receiverLatLongObject = {
                    'latitude': parseFloat(receiver_address_lat),
                    'longitude': parseFloat(receiver_address_lng)
                }

                var senderObject = {
                    'address': senderAddress,
                    'name': senderName,
                    'phone': senderPhone,
                }

                var senderLatLongObject = {
                    'latitude': parseFloat(sender_address_lat),
                    'longitude': parseFloat(sender_address_lng)
                }

                database.collection('parcel_orders').doc(id_order).set({
                    'adminCommission': adminCommission,
                    'adminCommissionType': adminCommissionType,
                    'author': userDetails,
                    'authorID': authorID,
                    "createdAt": createdAt,
                    'discount': discount,
                    'discountType': discountType,
                    'discountLabel': discountLabel,
                    'couponId': coupon_id,
                    'distance': parcelDeliveryKM,
                    'id': id_order,
                    'isSchedule': isSchedule,
                    'note': senderNote,
                    'parcelWeight': senderParcelWeightName,
                    'parcelWeightCharge': deliveryCharge,
                    'paymentCollectByReceiver': paymentCollectByReceiver,
                    'payment_method': payment_method,
                    'receiver': receiverObject,
                    'receiverLatLong': receiverLatLongObject,
                    'receiverPickupDateTime': receiverPickupDateTime,
                    'sender': senderObject,
                    'senderLatLong': senderLatLongObject,
                    'senderPickupDateTime': senderPickupDateTime,
                    'status': status,
                    'subTotal': parcelDeliveryCharge,
                    'tax': tax_amount,
                    'taxType': tax_type,
                    'taxLabel': tax_label,
                    'section_id': section_id,
                    'parcelCategoryId': parcelCategoryId,
                    'parcelImages': parcelImages,
                    'sendToDriver': sendToDriver,

                }).then(function (result) {

                    $.ajax({

                        type: 'POST',

                        url: "<?php echo route('parcel_order_complete'); ?>",

                        data: {_token: '<?php echo csrf_token() ?>', 'fcm': fcmToken, 'authorName': authorName},

                        success: function (data) {

                            data = JSON.parse(data);
                            if (payment_method == "wallet") {
                                wallet_amount = wallet_amount - total_pay;
                                database.collection('users').doc(authorID).update({'wallet_amount': wallet_amount}).then(function (result) {


                                    window.location.href = "<?php echo url('parcel_success'); ?>";

                                });
                            } else {

                                window.location.href = "<?php echo url('parcel_success'); ?>";
                            }

                        }

                    });


                });


            }
        });


    }

</script>
@include('layouts.nav')
