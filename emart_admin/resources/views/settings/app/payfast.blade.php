@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="card">
        <div class="payment-top-tab mt-3 mb-3">
            <ul class="nav nav-tabs card-header-tabs align-items-end">
                <li class="nav-item">
                    <a class="nav-link stripe_active_label" href="{!! url('settings/payment/stripe') !!}"><i
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
                    <a class="nav-link paytm_active_label" href="{!! url('settings/payment/paytm') !!}"><i
                                class="fa fa-envelope-o mr-2"></i>{{trans('lang.app_setting_paytm')}}<span
                                class="badge ml-2"></span>
                    </a>
                </li>
                </li>

                <li class="nav-item">
                    <a class="nav-link wallet_active_label" href="{!! url('settings/payment/wallet') !!}"><i
                                class="fa fa-envelope-o mr-2"></i>{{trans('lang.app_setting_wallet')}}<span
                                class="badge ml-2"></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active payfast_active_label"
                       href="{!! url('settings/payment/payfast') !!}"><i
                                class="fa fa-envelope-o mr-2"></i>{{trans('lang.payfast')}}<span
                                class="badge ml-2"></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link paystack_active_label" href="{!! url('settings/payment/paystack') !!}"><i
                                class="fa fa-envelope-o mr-2"></i>{{trans('lang.app_setting_paystack_lable')}}<span
                                class="badge ml-2"></span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link parcel_payfast_active_label"
                       href="{!! url('settings/payment/parcelPayStack') !!}"><i
                                class="fa fa-envelope-o mr-2"></i>{{trans('lang.parcelPayStack')}}<span
                                class="badge ml-2"></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link flutterWave_active_label" href="{!! url('settings/payment/flutterwave') !!}"><i
                                class="fa fa-envelope-o mr-2"></i>{{trans('lang.flutterWave')}}<span
                                class="badge ml-2"></span></a>
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
                        <legend>{{trans('lang.app_setting_payfast')}}</legend>
                        <div class="form-check width-100">
                            <input type="checkbox" class=" enable_payfast" id="enable_payfast">
                            <label class="col-3 control-label"
                                   for="enable_payfast">{{trans('lang.app_setting_enable_payfast')}}</label>
                        </div>

                        <div class="form-check width-100">
                            <input type="checkbox" class="sand_box_mode" id="sand_box_mode">
                            <label class="col-3 control-label"
                                   for="sand_box_mode">{{trans('lang.app_setting_enable_sandbox_mode_payfast')}}</label>
                        </div>

                        <div class="form-group row width-100">
                            <label class="col-3 control-label">{{trans('lang.app_setting_merchant_key')}}</label>
                            <div class="col-7">
                                <input type="text" class="form-control merchant_key">
                                <div class="form-text text-muted">
                                    {!! trans('lang.app_setting_merchant_key_help') !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row width-100">
                            <label class="col-3 control-label">{{trans('lang.app_setting_merchant_id')}}</label>
                            <div class="col-7">
                                <input type="text" class=" form-control merchant_id">
                                <div class="form-text text-muted">
                                    {!! trans('lang.app_setting_merchant_id_help') !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row width-100">
                            <label class="col-3 control-label">{{trans('lang.app_setting_payfast_cancel_url')}}</label>
                            <div class="col-7">
                                <input type="text" class=" form-control cancel_url">
                            </div>
                        </div>

                        <div class="form-group row width-100">
                            <label class="col-3 control-label">{{trans('lang.app_setting_payfast_notify_url')}}</label>
                            <div class="col-7">
                                <input type="text" class=" form-control notify_url">
                            </div>
                        </div>

                        <div class="form-group row width-100">
                            <label class="col-3 control-label">{{trans('lang.app_setting_payfast_return_url')}}</label>
                            <div class="col-7">
                                <input type="text" class=" form-control return_url">
                            </div>
                        </div>

                    </fieldset>
                </div>
            </div>
        </div>

        <div class="form-group col-12 text-center btm-btn">
            <button type="button" class="btn btn-primary save_payfast_btn"><i
                        class="fa fa-save"></i> {{trans('lang.save')}}
            </button>
            <a href="{{url('/dashboard')}}" class="btn btn-default"><i
                        class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>

    var database = firebase.firestore();
    var ref = database.collection('settings').doc('payFastSettings');
    var stripeData = database.collection('settings').doc('stripeSettings');
    var codData = database.collection('settings').doc('CODSettings');
    var applePayData = database.collection('settings').doc('applePay');
    var paypalData = database.collection('settings').doc('paypalSettings');
    var paytmData = database.collection('settings').doc('PaytmSettings');
    var walletData = database.collection('settings').doc('walletSettings');
    var razorpayData = database.collection('settings').doc('razorpaySettings');
    var payStackSettings = database.collection('settings').doc('payStack');
    var parcelPayStack = database.collection('settings').doc('parcelPayStack');
    var flutterWaveSettings = database.collection('settings').doc('flutterWave');
    var MercadopagoSettings = database.collection('settings').doc('MercadoPago');
    var rentalPayStack = database.collection('settings').doc('rentalPayStack');


    $(document).ready(function () {
        jQuery("#data-table_processing").show();
        ref.get().then(async function (snapshots) {
            var payfast = snapshots.data();

            if (payfast == undefined) {
                database.collection('settings').doc('payFastSettings').set({});
            }

            try {
                if (payfast.isEnable) {
                    $(".enable_payfast").prop('checked', true);
                    jQuery(".payfast_active_label span").addClass('badge-success');
                    jQuery(".payfast_active_label span").text('Active');
                }

                if (payfast.isSandbox) {
                    $(".sand_box_mode").prop('checked', true);
                }

                $(".merchant_key").val(payfast.merchant_key);
                $(".merchant_id").val(payfast.merchant_id);

                $(".cancel_url").val(payfast.cancel_url);
                $(".notify_url").val(payfast.notify_url);
                $(".return_url").val(payfast.return_url);


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

                paytmData.get().then(async function (codSnapshots) {
                    var paytm = codSnapshots.data();
                    if (paytm.isEnabled) {
                        jQuery(".paytm_active_label span").addClass('badge-success');
                        jQuery(".paytm_active_label span").text('Active');
                    }
                })

                razorpayData.get().then(async function (razorpaySnapshots) {
                    var razorpay = razorpaySnapshots.data();
                    if (razorpay.isEnabled) {
                        jQuery(".razorpay_active_label span").addClass('badge-success');
                        jQuery(".razorpay_active_label span").text('Active');
                    }
                })

                walletData.get().then(async function (walletSnapshots) {
                    var wallet = walletSnapshots.data();
                    if (wallet.isEnabled) {
                        jQuery(".wallet_active_label span").addClass('badge-success');
                        jQuery(".wallet_active_label span").text('Active');
                    }
                })

                payStackSettings.get().then(async function (payStackSnapshots) {
                    var payStack = payStackSnapshots.data();
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

                flutterWaveSettings.get().then(async function (flutterWaveSnapshots) {
                    var flutterWave = flutterWaveSnapshots.data();
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

            } catch (error) {

            }

            jQuery("#data-table_processing").hide();

        })

        $(".save_payfast_btn").click(function () {

            var merchant_key = $(".merchant_key").val();
            var merchant_id = $(".merchant_id").val();
            var ispayfastenabled = $(".enable_payfast").is(":checked");
            var sendboxmode = $(".sand_box_mode").is(":checked");
            var cancel_url = $(".cancel_url").val();
            var notify_url = $(".notify_url").val();
            var return_url = $(".return_url").val();

            database.collection('settings').doc("payFastSettings").update({
                'isEnable': ispayfastenabled,
                'merchant_id': merchant_id,
                'merchant_key': merchant_key,
                'isSandbox': sendboxmode,
                'cancel_url': cancel_url,
                'notify_url': notify_url,
                'return_url': return_url
            }).then(function (result) {

                window.location.href = '{{ url("settings/payment/payfast")}}';

            });

        })


    })
</script>

@endsection
