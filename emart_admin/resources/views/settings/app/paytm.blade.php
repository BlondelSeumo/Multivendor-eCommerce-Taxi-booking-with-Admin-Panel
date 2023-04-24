@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="card">
            <div class="payment-top-tab mt-3 mb-3">
                <ul class="nav nav-tabs card-header-tabs align-items-end">

                    <li class="nav-item">
                        <a class="nav-link  stripe_active_label" href="{!! url('settings/payment/stripe') !!}"><i
                                    class="fa fa-envelope-o mr-2"></i>{{trans('lang.app_setting_stripe')}}<span
                                    class="badge ml-2"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cod_active_label" href="{!! url('settings/payment/cod') !!}"><i
                                    class="fa fa-envelope-o mr-2"></i>{{trans('lang.app_setting_cod_short')}}<span
                                    class="badge ml-2"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link apple_pay_active_label" href="{!! url('settings/payment/applepay') !!}"><i
                                    class="fa fa-envelope-o mr-2"></i>{{trans('lang.app_setting_apple_pay')}}<span
                                    class="badge ml-2"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link razorpay_active_label" href="{!! url('settings/payment/razorpay') !!}"><i
                                    class="fa fa-envelope-o mr-2"></i>{{trans('lang.app_setting_razorpay')}}<span
                                    class="badge ml-2"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link paypal_active_label" href="{!! url('settings/payment/paypal') !!}"><i
                                    class="fa fa-envelope-o mr-2"></i>{{trans('lang.app_setting_paypal')}}<span
                                    class="badge ml-2"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active paytm_active_label" href="{!! url('settings/payment/paytm') !!}"><i
                                    class="fa fa-envelope-o mr-2"></i>{{trans('lang.app_setting_paytm')}}<span
                                    class="badge ml-2"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link wallet_active_label" href="{!! url('settings/payment/wallet') !!}"><i
                                    class="fa fa-envelope-o mr-2"></i>{{trans('lang.app_setting_wallet')}}<span
                                    class="badge ml-2"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link payfast_active_label" href="{!! url('settings/payment/payfast') !!}"><i
                                    class="fa fa-envelope-o mr-2"></i>{{trans('lang.payfast')}}<span
                                    class="badge ml-2"></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link paystack_active_label" href="{!! url('settings/payment/paystack') !!}"><i
                                    class="fa fa-envelope-o mr-2"></i>{{trans('lang.app_setting_paystack_lable')}}<span
                                    class="badge ml-2"></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link parcel_payfast_active_label"
                           href="{!! url('settings/payment/parcelPayStack') !!}"><i
                                    class="fa fa-envelope-o mr-2"></i>{{trans('lang.parcelPayStack')}}<span
                                    class="badge ml-2"></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link flutterWave_active_label"
                           href="{!! url('settings/payment/flutterwave') !!}"><i
                                    class="fa fa-envelope-o mr-2"></i>{{trans('lang.flutterWave')}}<span
                                    class="badge ml-2"></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link mercadopago_active_label" href="{!! url('settings/payment/mercadopago') !!}"><i
                                    class="fa fa-envelope-o mr-2"></i>{{trans('lang.mercadopago')}}<span
                                    class="badge ml-2"></span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link rental_payfast_active_label"
                           href="{!! url('settings/payment/rentalPayStack') !!}"><i
                                    class="fa fa-envelope-o mr-2"></i>{{trans('lang.rentalPayStack')}}<span
                                    class="badge ml-2"></span>
                        </a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div id="data-table_processing" class="dataTables_processing panel panel-default"
                     style="display: none;">{{trans('lang.processing')}}
                </div>
                <div class="row vendor_payout_create">
                    <div class="vendor_payout_create-inner">
                        <fieldset>
                            <legend>{{trans('lang.app_setting_paytm')}}</legend>
                            <div class="form-check width-100">
                                <input type="checkbox" class=" enable_paytm" id="enable_paytm">
                                <label class="col-3 control-label"
                                       for="enable_paytm">{{trans('lang.app_setting_enable_paytm')}}</label>
                            </div>
                            <div class="form-check width-100">
                                <input type="checkbox" class=" enable_paytm_sendbox" id="enable_paytm_sendbox">
                                <label class="col-3 control-label"
                                       for="enable_paytm_sendbox">{{trans('lang.app_setting_enable_sandbox_mode_paytm')}}</label>
                            </div>
                            <div class="form-group row width-100">
                                <label class="col-3 control-label">{{trans('lang.paytm_merchant_key')}}</label>
                                <div class="col-7">
                                    <input type="text" class="form-control paytm_merchant_key">
                                </div>
                            </div>

                            <div class="form-group row width-100">
                                <label class="col-3 control-label">{{trans('lang.paytm_id')}}</label>
                                <div class="col-7">
                                    <input type="text" class="form-control paytm_id">
                                </div>
                            </div>


                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="form-group col-12 text-center btm-btn">
                <button type="button" class="btn btn-primary save_paytm_btn"><i
                            class="fa fa-save"></i> {{trans('lang.save')}}</button>
                <a href="{{url('/dashboard')}}" class="btn btn-default"><i
                            class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>
        var database = firebase.firestore();
        var ref = database.collection('settings').doc('PaytmSettings');
        var codData = database.collection('settings').doc('CODSettings');
        var applePayData = database.collection('settings').doc('applePay');
        var razorpayData = database.collection('settings').doc('razorpaySettings');
        var stripeData = database.collection('settings').doc('stripeSettings');
        var paypalData = database.collection('settings').doc('paypalSettings');
        var walletData = database.collection('settings').doc('walletSettings');
        var payFastSettings = database.collection('settings').doc('payFastSettings');
        var payStackSettings = database.collection('settings').doc('payStack');
        var parcelPayStack = database.collection('settings').doc('parcelPayStack');
        var flutterWaveSettings = database.collection('settings').doc('flutterWave');
        var MercadopagoSettings = database.collection('settings').doc('MercadoPago');
        var rentalPayStack = database.collection('settings').doc('rentalPayStack');

        $(document).ready(function () {
            jQuery("#data-table_processing").show();
            ref.get().then(async function (snapshots) {
                var paytm = snapshots.data();

                if (paytm.isEnabled) {
                    $(".enable_paytm").prop('checked', true);
                    jQuery(".paytm_active_label span").addClass('badge-success');
                    jQuery(".paytm_active_label span").text('Active');
                }

                if (paytm.isSandboxEnabled) {
                    $('.enable_paytm_sendbox').prop('checked', true);
                }

                $('.paytm_merchant_key').val(paytm.PAYTM_MERCHANT_KEY);
                $('.paytm_id').val(paytm.PaytmMID);


                // $(".paypal_app_id").val(paypal.paypalAppId);
                // $(".paypal_secret").val(paypal.paypalSecret);
                // $(".paypal_username").val(paypal.paypalUserName);
                // $(".paypal_password").val(paypal.paypalpassword);

                codData.get().then(async function (codSnapshots) {
                    var cod = codSnapshots.data();
                    if (cod.isEnabled) {
                        jQuery(".cod_active_label span").addClass('badge-success');
                        jQuery(".cod_active_label span").text('Active');
                    }

                })

                applePayData.get().then(async function (applePaySnapshots) {
                    var applePay = applePaySnapshots.data();
                    if (applePay.isEnabled) {
                        jQuery(".apple_pay_active_label span").addClass('badge-success');
                        jQuery(".apple_pay_active_label span").text('Active');
                    }
                })

                razorpayData.get().then(async function (razorpaySnapshots) {
                    var razorPay = razorpaySnapshots.data();
                    if (razorPay.isEnabled) {
                        jQuery(".razorpay_active_label span").addClass('badge-success');
                        jQuery(".razorpay_active_label span").text('Active');
                    }
                })

                stripeData.get().then(async function (stripeSnapshots) {
                    var stripe = stripeSnapshots.data();
                    if (stripe.isEnabled) {
                        jQuery(".stripe_active_label span").addClass('badge-success');
                        jQuery(".stripe_active_label span").text('Active');
                    }
                })
                paypalData.get().then(async function (paypalSnapshots) {
                    var paypal = paypalSnapshots.data();
                    if (paypal.isEnabled) {
                        jQuery(".paypal_active_label span").addClass('badge-success');
                        jQuery(".paypal_active_label span").text('Active');
                    }
                })

                walletData.get().then(async function (walletSnapshots) {
                    var wallet = walletSnapshots.data();
                    if (wallet.isEnabled) {
                        jQuery(".wallet_active_label span").addClass('badge-success');
                        jQuery(".wallet_active_label span").text('Active');
                    }
                })

                payFastSettings.get().then(async function (payFastSnaShots) {
                    var payFast = payFastSnaShots.data();
                    if (payFast.isEnable) {
                        jQuery(".payfast_active_label span").addClass('badge-success');
                        jQuery(".payfast_active_label span").text('Active');
                    }
                })

                payStackSettings.get().then(async function (payStackSnapShots) {
                    var payStack = payStackSnapShots.data();
                    if (payStack.isEnable) {
                        jQuery(".paystack_active_label span").addClass('badge-success');
                        jQuery(".paystack_active_label span").text('Active');
                    }
                })

                parcelPayStack.get().then(async function (payStackSnapShots) {
                    var payStack = payStackSnapShots.data();
                    if (payStack.isEnable) {
                        jQuery(".parcel_payfast_active_label span").addClass('badge-success');
                        jQuery(".parcel_payfast_active_label span").text('Active');
                    }
                })

                flutterWaveSettings.get().then(async function (flutterWaveSnapShots) {
                    var flutterWave = flutterWaveSnapShots.data();
                    if (flutterWave.isEnable) {
                        jQuery(".flutterWave_active_label span").addClass('badge-success');
                        jQuery(".flutterWave_active_label span").text('Active');
                    }
                })
                MercadopagoSettings.get().then(async function (mercadopagoSnapshots) {
                    var mercadopago = mercadopagoSnapshots.data();
                    if (mercadopago.isEnabled) {
                        jQuery(".mercadopago_active_label span").addClass('badge-success');
                        jQuery(".mercadopago_active_label span").text('Active');
                    }
                })

                rentalPayStack.get().then(async function (payStackSnapShots) {
                    var payStack = payStackSnapShots.data();
                    if (payStack.isEnable) {
                        jQuery(".rental_payfast_active_label span").addClass('badge-success');
                        jQuery(".rental_payfast_active_label span").text('Active');
                    }
                })
                jQuery("#data-table_processing").hide();
                /* console.log($(".note-editable").html()); */
            })

            $(".save_paytm_btn").click(function () {
                var isenabled = $(".enable_paytm").is(":checked");
                var paytmId = "";
                var paytmMerchanty = "";
                var isSandboxEnabled = $('.enable_paytm_sendbox').is(':checked');
                var merchantID = $('.paytm_merchant_key').val();
                var paytmID = $('.paytm_id').val();

                database.collection('settings').doc("PaytmSettings").update({
                    'isEnabled': isenabled,
                    'PAYTM_MERCHANT_KEY': merchantID,
                    'isSandboxEnabled': isSandboxEnabled,
                    'PaytmMID': paytmID
                }).then(function (result) {
                    window.location.href = '{{ url("settings/payment/paytm")}}';
                });

            })
        })

    </script>

@endsection