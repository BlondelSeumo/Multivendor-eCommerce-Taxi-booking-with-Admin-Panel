@include('layouts.app')


@include('layouts.header')


<?php
session_start();

?>

<!-- /**********************************rental-car-Booking***************************/ -->

<div class="carrental-book-page pt-5 mb-5" style="background: #F2F6F9;">

    <div class="container position-relative">

        <div class="row">

            @include('rental.cart_rental')

        </div>


    </div>
</div>

<!-- /**********************************rental-car-Booking***************************/ -->

@include('layouts.footer')


@include('layouts.nav')

<!-- GeoFirestore -->

<script src="https://unpkg.com/geofirestore/dist/geofirestore.js"></script>

<script src="https://cdn.firebase.com/libs/geofire/5.0.1/geofire.min.js"></script>

<script type="text/javascript" src="{{asset('vendor/slick/slick.min.js')}}"></script>


<script type="text/javascript">


    var rental_user_id = "<?php echo $id; ?>";
    var user_id = "<?php echo $user_id; ?>";
    var id_order = "<?php echo uniqid();?>";
    var fcmToken = '';
    var currentCurrency = '';
    var currencyAtRight = false;
    var wallet_amount = 0;
    var database = firebase.firestore();
    var refCurrency = database.collection('currencies').where('isActive', '==', true);
    var currencyData = "";
    var decimal_degits = 0;
    refCurrency.get().then(async function (snapshots) {
        currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;

        if (currencyData.decimal_degits) {
            decimal_degits = currencyData.decimal_degits;
        }

        loadcurrency();
    });

    var rentalVehicleTypeUserRef = database.collection('users').where('id', "==", rental_user_id);

    var UserRef = database.collection('users').where('id', "==", user_id);

    var placeholderImageRef = database.collection('settings').doc('placeHolderImage');

    var placeholderImage = '';

    placeholderImageRef.get().then(async function (placeholderImageSnapshots) {

        var placeHolderImageData = placeholderImageSnapshots.data();

        placeholderImage = placeHolderImageData.image;

    });

    var razorpaySettings = database.collection('settings').doc('razorpaySettings');

    var codSettings = database.collection('settings').doc('CODSettings');

    var stripeSettings = database.collection('settings').doc('stripeSettings');

    var paypalSettings = database.collection('settings').doc('paypalSettings');

    var walletSettings = database.collection('settings').doc('walletSettings');

    var reftaxSetting = database.collection('settings').doc("taxSetting");

    var payFastSettings = database.collection('settings').doc('payFastSettings');

    var payStackSettings = database.collection('settings').doc('rentalPayStack');

    var flutterWaveSettings = database.collection('settings').doc('flutterWave');

    var MercadoPagoSettings = database.collection('settings').doc('MercadoPago');

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

            $("#razorpay_box").show();


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

    MercadoPagoSettings.get().then(async function (MercadoPagoSettingsSnapshots) {

        MercadoPagoSetting = MercadoPagoSettingsSnapshots.data();
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

    });

    getCouponDetails();

    async function getCouponDetails() {
        var date = new Date();
        var couponRef = database.collection('rental_coupons').where('expiresAt', '>=', date);
        var couponHtml = '';
        let menuHtmlx = couponRef.get().then(async function (couponRefSnapshots) {
            couponHtml += '<div class="coupon-code"><label>Select Available Coupons to apply</label><span></span></div>';
            couponHtml += '<div class="copupon-list">';

            couponHtml += '<ul>';

            couponRefSnapshots.docs.forEach((doc) => {
                coupon = doc.data();

                if (coupon.isEnabled == true) {
                    couponHtml += '<li value="' + coupon.code + '"><a style="cursor:pointer;">' + coupon.code + '</a></li>';

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
        var coupon_code = $("#coupon_code").val();
        console.log(coupon_code);
        var endOfToday = new Date();
        var couponCodeRef = database.collection('rental_coupons').where('code', "==", coupon_code).where('isEnabled', "==", true).where('expiresAt', ">=", endOfToday);
        couponCodeRef.get().then(async function (couponSnapshots) {
            if (couponSnapshots.docs && couponSnapshots.docs.length) {
                var coupondata = couponSnapshots.docs[0].data();

                discount = coupondata.discount;
                discountType = coupondata.discountType;

                $.ajax({
                    type: 'POST',
                    url: "<?php echo route('apply_rental_coupon'); ?>",
                    data: {
                        _token: '<?php echo csrf_token() ?>',
                        coupon_code: coupon_code,
                        discount: discount,
                        discountType: discountType,
                        coupon_id: coupondata.id,
                        rental_user_id: rental_user_id,
                    },
                    success: function (data) {
                        data = JSON.parse(data);
                        window.location.reload();
                        loadcurrency();

                    }
                });
            } else {
                alert("Coupon code is not valid.");
                $("#coupon_code").val('');
            }
        });
    });

    $(document).on('click', '.copupon-list li', function (e) {

        var navSelectedValue = $(this).attr('value');
        $('#coupon_code').val(navSelectedValue);
    });

    async function loadcurrency() {

        var wallet_amount = 0;

        await UserRef.get().then(async function (userSnapshots) {

            var userDetails = userSnapshots.docs[0].data();

            if (userDetails.wallet_amount && userDetails.wallet_amount != null && userDetails.wallet_amount != '') {
                wallet_amount = userDetails.wallet_amount;
            }

        });

        wallet_amount = wallet_amount.toFixed(decimal_degits);
        if (currencyAtRight) {
            jQuery('.currency-symbol-left').hide();
            jQuery('.currency-symbol-right').show();
            jQuery('.currency-symbol-right').text(currentCurrency);
            $('#wallet_box').text('Wallet ( You have ' + currentCurrency + wallet_amount + ' )');
        } else {
            jQuery('.currency-symbol-left').show();
            jQuery('.currency-symbol-right').hide();
            jQuery('.currency-symbol-left').text(currentCurrency);
            $('#wallet_box').text('Wallet ( You have ' + wallet_amount + currentCurrency + ' )');
        }


    }

    var isDriver = false;
    var rentalCarRate = 0;
    var rentalDriverRate = 0;

    async function finalCheckout() {

        UserRef.get().then(async function (userSnapshots) {

            var userDetails = userSnapshots.docs[0].data();

            rentalVehicleTypeUserRef.get().then(async function (snapshots) {
               var wallet_amount = userDetails.wallet_amount;
                var author = userDetails;

                var authorID = user_id;

                var authorName = userDetails.firstName;

                var bookWithDriver = $('#bookWithDriver').val();

                var driver = snapshots.docs[0].data();
                //console.log(companyID);
                // if(driver.companyId == ""){
                //     fcmToken = driver.fcmToken;
                // }
                var driverID = driver.id;
                let company = {};
                var companyID = "";

                let companyData = "";

                if (driver.companyId) {

                    var companyDetailsRef = database.collection('users').where('id', "==", driver.companyId);

                    companyData = companyDetailsRef.get().then(async function (companySnapshots) {
                        var company = companySnapshots.docs[0].data();
                        if(driver.companyId != "")
                        {
                            fcmToken = company.fcmToken;
                        console.log(fcmToken)

                        }
                        else{
                            fcmToken = driver.fcmToken;
                        }
                        if (companySnapshots.docs.length == 0) {

                            return;

                        }

                        return companySnapshots.docs[0].data();

                    });

                    company = await companyData.then(function (response) {

                        return response;
                    });

                    companyID = driver.companyId;
                }
                console.log(fcmToken);
                var createdAt = firebase.firestore.FieldValue.serverTimestamp();

                var discount = $('#discount').val();
                var discountLabel = $('#discountLabel').val();
                var discountType = $('#discountType').val();

                var isDropSameLocation = $('#isDropSameLocation').val();

                var dropAddress = $('#dropoffAddress').val();
                var dropDateTime = $('#dropDateTime').val();
                dropDateTime = new Date(dropDateTime);

                var dropLatLong = {
                    'latitude': parseFloat($('#drop_address_lat').val()),
                    'longitude': parseFloat($('#drop_address_lng').val()),
                };

                var pickUpAddress = $('#pickupAddress').val();
                var pickUpDateTime = $('#pickupDateTime').val();

                pickUpDateTime = new Date(pickUpDateTime);

                var pickUpLatLong = {
                    'latitude': parseFloat($('#address_lat').val()),
                    'longitude': parseFloat($('#address_lng').val()),
                };

                var payment_method = $('#payment').val();

                if (payment_method == "") {
                    alert("Please Select Payment Method!!");
                    return false;
                }

                var status = 'Order Placed';
                var subTotal = $('#carRateAmount').val();
                var driverRateAmount = $('#driverRateAmount').val();

                var tax = $('#tax').val();
                var taxLabel = $('#taxLabel').val();
                var taxType = $('#taxType').val();

                var adminCommission = $('#adminCommission').val();
                var adminCommissionType = $('#adminCommissionType').val();

                var total_pay = $("#total_pay").val();

                if (payment_method == "razorpay") {

                    var razorpayKey = $("#razorpayKey").val();

                    var razorpaySecret = $("#razorpaySecret").val();

                    var order_json = {
                        'authorID': authorID,
                        'driverID': driverID,
                        'bookWithDriver': Boolean(bookWithDriver),
                        'companyID': companyID,
                        'discount': discount,
                        'discountLabel': discountLabel,
                        'discountType': discountType,
                        'dropAddress': dropAddress,
                        'dropDateTime': dropDateTime,
                        'dropLatLong': dropLatLong,
                        'pickUpAddress': pickUpAddress,
                        'pickUpDateTime': pickUpDateTime,
                        'pickUpLatLong': pickUpLatLong,
                        'payment_method': payment_method,
                        'status': status,
                        'subTotal': subTotal,
                        'tax': tax,
                        'taxLabel': taxLabel,
                        'taxType': taxType,
                        'adminCommission': adminCommission,
                        'adminCommissionType': adminCommissionType,
                        'driverRate': driverRateAmount,
                    };

                    $.ajax({

                        type: 'POST',

                        url: "<?php echo route('rental_order_proccessing'); ?>",

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
                            window.location.href = "<?php echo route('process_rental_order_pay'); ?>";

                        }

                    });


                } else if (payment_method == "mercadopago") {

                    var mercadopago_public_key = $("#mercadopago_public_key").val();
                    var mercadopago_access_token = $("#mercadopago_access_token").val();
                    var mercadopago_isSandbox = $("#mercadopago_isSandbox").val();
                    var mercadopago_isEnabled = $("#mercadopago_isEnabled").val();

                    var order_json = {
                        'authorID': authorID,
                        'driverID': driverID,
                        'bookWithDriver': Boolean(bookWithDriver),
                        'companyID': companyID,
                        'discount': discount,
                        'discountLabel': discountLabel,
                        'discountType': discountType,
                        'dropAddress': dropAddress,
                        'dropDateTime': dropDateTime,
                        'dropLatLong': dropLatLong,
                        'pickUpAddress': pickUpAddress,
                        'pickUpDateTime': pickUpDateTime,
                        'pickUpLatLong': pickUpLatLong,
                        'payment_method': payment_method,
                        'status': status,
                        'subTotal': subTotal,
                        'tax': tax,
                        'taxLabel': taxLabel,
                        'taxType': taxType,
                        'adminCommission': adminCommission,
                        'adminCommissionType': adminCommissionType,
                        'driverRate': driverRateAmount,
                    };

                    $.ajax({

                        type: 'POST',

                        url: "<?php echo route('rental_order_proccessing'); ?>",

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
                            address_country: $("#address_country").val(),
                            currencyData: currencyData,
                        },

                        success: function (data) {

                            data = JSON.parse(data);
                            loadcurrency();
                            window.location.href = "<?php echo route('process_rental_order_pay'); ?>";

                        }

                    });
                } else if (payment_method == "stripe") {

                    var stripeKey = $("#stripeKey").val();

                    var stripeSecret = $("#stripeSecret").val();

                    var isStripeSandboxEnabled = $("#isStripeSandboxEnabled").val();

                    var order_json = {
                        'authorID': authorID,
                        'driverID': driverID,
                        'bookWithDriver': Boolean(bookWithDriver),
                        'companyID': companyID,
                        'discount': discount,
                        'discountLabel': discountLabel,
                        'discountType': discountType,
                        'dropAddress': dropAddress,
                        'dropDateTime': dropDateTime,
                        'dropLatLong': dropLatLong,
                        'pickUpAddress': pickUpAddress,
                        'pickUpDateTime': pickUpDateTime,
                        'pickUpLatLong': pickUpLatLong,
                        'payment_method': payment_method,
                        'status': status,
                        'subTotal': subTotal,
                        'tax': tax,
                        'taxLabel': taxLabel,
                        'taxType': taxType,
                        'adminCommission': adminCommission,
                        'adminCommissionType': adminCommissionType,
                        'driverRate': driverRateAmount,
                    };

                    $.ajax({

                        type: 'POST',

                        url: "<?php echo route('rental_order_proccessing'); ?>",

                        data: {
                            _token: '<?php echo csrf_token() ?>',
                            order_json: order_json,
                            stripeKey: stripeKey,
                            stripeSecret: stripeSecret,
                            payment_method: payment_method,
                            authorName: authorName,
                            total_pay: total_pay,
                            isStripeSandboxEnabled: isStripeSandboxEnabled,
                            address_line1: $("#address_line1").val(),
                            address_line2: $("#address_line2").val(),
                            address_zipcode: $("#address_zipcode").val(),
                            address_city: $("#address_city").val(),
                            address_country: $("#address_country").val()
                        },

                        success: function (data) {

                            data = JSON.parse(data);
                            loadcurrency();
                            window.location.href = "<?php echo route('process_rental_order_pay'); ?>";


                        }

                    });


                } else if (payment_method == "paypal") {


                    var paypalKey = $("#paypalKey").val();

                    var paypalSecret = $("#paypalSecret").val();

                    var ispaypalSandboxEnabled = $("#ispaypalSandboxEnabled").val();

                    var order_json = {
                        'authorID': authorID,
                        'driverID': driverID,
                        'bookWithDriver': Boolean(bookWithDriver),
                        'companyID': companyID,
                        'discount': discount,
                        'discountLabel': discountLabel,
                        'discountType': discountType,
                        'dropAddress': dropAddress,
                        'dropDateTime': dropDateTime,
                        'dropLatLong': dropLatLong,
                        'pickUpAddress': pickUpAddress,
                        'pickUpDateTime': pickUpDateTime,
                        'pickUpLatLong': pickUpLatLong,
                        'payment_method': payment_method,
                        'status': status,
                        'subTotal': subTotal,
                        'tax': tax,
                        'taxLabel': taxLabel,
                        'taxType': taxType,
                        'adminCommission': adminCommission,
                        'adminCommissionType': adminCommissionType,
                        'driverRate': driverRateAmount,
                    };

                    $.ajax({

                        type: 'POST',

                        url: "<?php echo route('rental_order_proccessing'); ?>",

                        data: {
                            _token: '<?php echo csrf_token() ?>',
                            order_json: order_json,
                            paypalKey: paypalKey,
                            paypalSecret: paypalSecret,
                            payment_method: payment_method,
                            authorName: authorName,
                            total_pay: total_pay,
                            ispaypalSandboxEnabled: ispaypalSandboxEnabled,
                            address_line1: $("#address_line1").val(),
                            address_line2: $("#address_line2").val(),
                            address_zipcode: $("#address_zipcode").val(),
                            address_city: $("#address_city").val(),
                            address_country: $("#address_country").val()
                        },

                        success: function (data) {

                            data = JSON.parse(data);
                            loadcurrency();
                            window.location.href = "<?php echo route('process_rental_order_pay'); ?>";


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
                        'authorID': authorID,
                        'driverID': driverID,
                        'bookWithDriver': Boolean(bookWithDriver),
                        'companyID': companyID,
                        'discount': discount,
                        'discountLabel': discountLabel,
                        'discountType': discountType,
                        'dropAddress': dropAddress,
                        'dropDateTime': dropDateTime,
                        'dropLatLong': dropLatLong,
                        'pickUpAddress': pickUpAddress,
                        'pickUpDateTime': pickUpDateTime,
                        'pickUpLatLong': pickUpLatLong,
                        'payment_method': payment_method,
                        'status': status,
                        'subTotal': subTotal,
                        'tax': tax,
                        'taxLabel': taxLabel,
                        'taxType': taxType,
                        'adminCommission': adminCommission,
                        'adminCommissionType': adminCommissionType,
                        'driverRate': driverRateAmount,
                    };

                    $.ajax({

                        type: 'POST',

                        url: "<?php echo route('rental_order_proccessing'); ?>",

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
                            address_line1: $("#address_line1").val(),
                            address_line2: $("#address_line2").val(),
                            address_zipcode: $("#address_zipcode").val(),
                            address_city: $("#address_city").val(),
                            address_country: $("#address_country").val()
                        },

                        success: function (data) {

                            data = JSON.parse(data);
                            loadcurrency();
                            window.location.href = "<?php echo route('process_rental_order_pay'); ?>";


                        }

                    });

                } else if (payment_method == "paystack") {

                    var paystack_public_key = $("#paystack_public_key").val();
                    var paystack_secret_key = $("#paystack_secret_key").val();
                    var paystack_isSandbox = $("#paystack_isSandbox").val();

                    var order_json = {
                        'authorID': authorID,
                        'driverID': driverID,
                        'bookWithDriver': Boolean(bookWithDriver),
                        'companyID': companyID,
                        'discount': discount,
                        'discountLabel': discountLabel,
                        'discountType': discountType,
                        'dropAddress': dropAddress,
                        'dropDateTime': dropDateTime,
                        'dropLatLong': dropLatLong,
                        'pickUpAddress': pickUpAddress,
                        'pickUpDateTime': pickUpDateTime,
                        'pickUpLatLong': pickUpLatLong,
                        'payment_method': payment_method,
                        'status': status,
                        'subTotal': subTotal,
                        'tax': tax,
                        'taxLabel': taxLabel,
                        'taxType': taxType,
                        'adminCommission': adminCommission,
                        'adminCommissionType': adminCommissionType,
                        'driverRate': driverRateAmount,
                    };

                    $.ajax({

                        type: 'POST',

                        url: "<?php echo route('rental_order_proccessing'); ?>",

                        data: {
                            _token: '<?php echo csrf_token() ?>',
                            order_json: order_json,
                            payment_method: payment_method,
                            authorName: authorName,
                            total_pay: total_pay,
                            paystack_isSandbox: paystack_isSandbox,
                            paystack_public_key: paystack_public_key,
                            paystack_secret_key: paystack_secret_key,
                            address_line1: $("#address_line1").val(),
                            address_line2: $("#address_line2").val(),
                            address_zipcode: $("#address_zipcode").val(),
                            address_city: $("#address_city").val(),
                            address_country: $("#address_country").val()
                        },

                        success: function (data) {

                            data = JSON.parse(data);
                            loadcurrency();
                            window.location.href = "<?php echo route('process_rental_order_pay'); ?>";


                        }

                    });

                } else if (payment_method == "flutterwave") {

                    var flutterwave_isenabled = $("#flutterWave_isEnabled").val();
                    var flutterWave_encryption_key = $("#flutterWave_encryption_key").val();
                    var flutterWave_public_key = $("#flutterWave_public_key").val();
                    var flutterWave_secret_key = $("#flutterWave_secret_key").val();
                    var flutterWave_isSandbox = $("#flutterWave_isSandbox").val();

                    var order_json = {
                        'authorID': authorID,
                        'driverID': driverID,
                        'bookWithDriver': Boolean(bookWithDriver),
                        'companyID': companyID,
                        'discount': discount,
                        'discountLabel': discountLabel,
                        'discountType': discountType,
                        'dropAddress': dropAddress,
                        'dropDateTime': dropDateTime,
                        'dropLatLong': dropLatLong,
                        'pickUpAddress': pickUpAddress,
                        'pickUpDateTime': pickUpDateTime,
                        'pickUpLatLong': pickUpLatLong,
                        'payment_method': payment_method,
                        'status': status,
                        'subTotal': subTotal,
                        'tax': tax,
                        'taxLabel': taxLabel,
                        'taxType': taxType,
                        'adminCommission': adminCommission,
                        'adminCommissionType': adminCommissionType,
                        'driverRate': driverRateAmount,
                    };

                    $.ajax({

                        type: 'POST',

                        url: "<?php echo route('rental_order_proccessing'); ?>",

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
                            address_line1: $("#address_line1").val(),
                            address_line2: $("#address_line2").val(),
                            address_zipcode: $("#address_zipcode").val(),
                            address_city: $("#address_city").val(),
                            address_country: $("#address_country").val(),
                            currencyData: currencyData
                        },

                        success: function (data) {

                            data = JSON.parse(data);
                            loadcurrency();
                            window.location.href = "<?php echo route('process_rental_order_pay'); ?>";

                        }

                    });

                } else {

                    if (payment_method == "wallet") {
                        payment_method = "wallet";
                        console.log($('#user_wallet_amount').text());
                        if (wallet_amount < total_pay) {
                            alert("you don't have sufficient balance to book this car!!");
                            return false;
                        }
                    } else {
                        payment_method = "cod";
                    }

                    database.collection('rental_orders').doc(id_order).set({
                        'id': id_order,
                        'author': author,
                        'authorID': authorID,
                        'driver': driver,
                        'driverID': driverID,
                        'bookWithDriver': Boolean(bookWithDriver),
                        'company': company,
                        'companyID': companyID,
                        'createdAt': createdAt,
                        'discount': discount,
                        'discountLabel': discountLabel,
                        'discountType': discountType,
                        'dropAddress': dropAddress,
                        'dropDateTime': dropDateTime,
                        'dropLatLong': dropLatLong,
                        'pickupAddress': pickUpAddress,
                        'pickupDateTime': pickUpDateTime,
                        'pickupLatLong': pickUpLatLong,
                        'payment_method': payment_method,
                        'status': status,
                        'subTotal': subTotal,
                        'tax': tax,
                        'taxLabel': taxLabel,
                        'taxType': taxType,
                        'adminCommission': adminCommission,
                        'adminCommissionType': adminCommissionType,
                        'driverRate': driverRateAmount,
                        'rejectedByDrivers':null,
                    }).then(function (result) {

                        $.ajax({

                            type: 'POST',

                            url: "<?php echo route('rental_order_complete'); ?>",

                            data: {_token: '<?php echo csrf_token() ?>', 'fcm': fcmToken, 'authorName': authorName},

                            success: function (data) {

                                data = JSON.parse(data);
                                if (payment_method == "wallet") {
                                    wallet_amount = wallet_amount - total_pay;
                                    database.collection('users').doc(user_id).update({'wallet_amount': wallet_amount}).then(function (result) {

                                        window.location.href = "<?php echo url('rental_success'); ?>";

                                    });
                                } else {

                                    window.location.href = "<?php echo url('rental_success'); ?>";
                                }


                            }

                        });


                    });


                }

            });

        });

    }

</script>



