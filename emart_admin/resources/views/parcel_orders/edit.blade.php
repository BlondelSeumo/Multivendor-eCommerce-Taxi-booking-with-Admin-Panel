@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.parcel_plural')}} {{trans('lang.order_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href="{{url('/parcel_orders')}}">{{trans('lang.parcel_plural')}}
                        {{trans('lang.order_plural')}}</a></li>
                <li class="breadcrumb-item">{{trans('lang.order_edit')}}</li>
            </ol>
        </div>
    </div>

    <div class="card-body">
        <div id="data-table_processing" class="dataTables_processing panel panel-default"
             style="display: none;">{{trans('lang.processing')}}
        </div>
        <div class="text-right print-btn">
            <button type="button" class="fa fa-print" onclick="PrintElem('order_detail')"></button>
        </div>

        <div class="order_detail" id="order_detail">
            <div class="order_detail-top">
                <div class="row">
                    <div class="order_edit-genrl col-md-4">

                        <h3>{{trans('lang.general_details')}}</h3>
                        <div class="order_detail-top-box">

                            <div class="form-group row widt-100 gendetail-col " id="div_parcel_category">
                                <label class="col-12 control-label"><strong>{{trans('lang.parcel_category')}}:
                                    </strong><span id="parcel_type"></span></label>
                            </div>

                            <div class="form-group row widt-100 gendetail-col">
                                <label class="col-12 control-label"><strong>{{trans('lang.date_created')}}
                                        : </strong><span id="createdAt"></span></label>

                            </div>

                            <div class="form-group row widt-100 gendetail-col payment_method">
                                <label class="col-12 control-label"><strong>{{trans('lang.payment_methods')}}  : </strong>
                                      <span id="payment_method"></span></label>

                            </div>

                            <div class="form-group row width-100 ">
                                <label class="col-3 control-label"><strong></strong>{{trans('lang.status')}}:</strong></label>
                                <div class="col-7">
                                    <select id="order_status" class="form-control">
                                        <option value="Order Placed"
                                                id="order_placed">{{ trans('lang.order_placed')}}
                                        </option>
                                        <option value="Order Accepted"
                                                id="order_accepted">{{ trans('lang.order_accepted')}}
                                        </option>
                                        <option value="Order Rejected"
                                                id="order_rejected">{{ trans('lang.order_rejected')}}
                                        </option>
                                        <option value="Driver Pending"
                                                id="driver_pending">{{ trans('lang.driver_pending')}}
                                        </option>
                                        <option value="Driver Rejected"
                                                id="driver_rejected">{{ trans('lang.driver_rejected')}}
                                        </option>
                                        <option value="Order Shipped"
                                                id="order_shipped">{{ trans('lang.order_shipped')}}
                                        </option>
                                        <option value="In Transit"
                                                id="in_transit">{{ trans('lang.in_transit')}}
                                        </option>
                                        <option value="Order Completed"
                                                id="order_completed">{{ trans('lang.order_completed')}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row width-100">
                                <label class="col-3 control-label"></label>
                                <div class="col-7 text-right">
                                    <button type="button" class="btn btn-primary save_order_btn"><i
                                                class="fa fa-save"></i> {{trans('lang.update')}}
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="order_edit-genrl col-md-4">
                        <h3>{{ trans('lang.sender_details')}}</h3>

                        <div class="address order_detail-top-box">

                              <div class="form-group row widt-100 gendetail-col ">
                                  <label class="col-12 control-label"><strong>{{trans('lang.sender_name')}}:</strong>
                                        <span id="sender_name"></span></label>

                              </div>
                              <div class="form-group row widt-100 gendetail-col ">
                                  <label class="col-12 control-label"><strong>{{trans('lang.sender_address')}}:</strong>
                                        <span id="sender_address"></span></label>

                              </div>
                              <div class="form-group row widt-100 gendetail-col ">
                                  <label class="col-12 control-label"><strong>{{trans('lang.date')}}:</strong>
                                        <span id="sender_datetime"></span></label>

                              </div>

                            <p><strong>{{trans('lang.phone')}}:</strong>
                                <span id="sender_phone"></span>
                            </p>

                        </div>
                    </div>

                    <div class="order_edit-genrl col-md-4 ">
                        <h3>{{ trans('lang.receiver_details')}}</h3>

                        <div class="address order_detail-top-box">
                          <div class="form-group row widt-100 gendetail-col ">
                              <label class="col-12 control-label"><strong>{{trans('lang.receiver_name')}}:</strong>
                                    <span id="receiver_name"></span></label>

                          </div>
                          <div class="form-group row widt-100 gendetail-col ">
                              <label class="col-12 control-label"><strong>{{trans('lang.receiver_address')}}:</strong>
                                    <span id="receiver_address"></span></label>

                          </div>
                          <div class="form-group row widt-100 gendetail-col ">
                              <label class="col-12 control-label"><strong>{{trans('lang.date')}}:</strong>
                                    <span id="receiver_datetime"></span></label>

                          </div>


                            <p><strong>{{trans('lang.phone')}}:</strong>
                                <span id="receiver_phone"></span>
                            </p>
                        </div>
                    </div>


                </div>

            </div>


            <div class="order-deta-btm mt-4">
                <div class="row">
                    <div class="col-md-8 order-deta-btm-left">
                        <div class="order-items-list ">
                            <div class="row">
                                <div class="col-md-12">
                                    <table cellpadding="0" cellspacing="0"
                                           class="table table-striped table-valign-middle">

                                        <thead>
                                        <tr>

                                            <th>{{trans('lang.parcel_weight')}}</th>
                                            <th>{{trans('lang.item_review_rate')}}</th>
                                            <th>{{trans('lang.parcel_distance')}}</th>
                                            <th>{{trans('lang.total')}}</th>
                                        </tr>

                                        </thead>

                                        <tbody id="order_products">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="order-data-row order-totals-items">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="order-totals">

                                        <tbody id="order_products_total">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-4 order-deta-btm-right driver_details_hide">


                        <h3>{{ trans('lang.driver_detail')}}</h3>


                        <div class="address order_detail-top-box">
                            <p><strong>{{trans('lang.driver_name')}}:</strong>
                                <span id="driver_firstName"></span> <span id="driver_lastName"></span><br>
                            </p>
                            <p><strong>{{trans('lang.email_address')}}:</strong>
                                <span id="driver_email"></span>
                            </p>
                            <p><strong>{{trans('lang.phone')}}:</strong>
                                <span id="driver_phone"></span>
                            </p>
                            <p id="para_carName"><strong>{{trans('lang.car_name')}}:</strong>
                                <span id="driver_carName"></span>
                            </p>
                            <p><strong>{{trans('lang.car_number')}}:</strong>
                                <span id="driver_carNumber"></span>
                            </p>
                        </div>


                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

<!--  </div> -->


<!-- <div class="form-group col-12 text-center btm-btn">
    <button type="button" class="btn btn-primary save_order_btn"><i
                class="fa fa-save"></i> {{trans('lang.save')}}</button>
    <a href="{!! route('orders') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}
    </a>
</div> -->

</div>


</div>
</div>

@endsection

@section('style')
<style type="text/css">

</style>
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.js"></script>
<script>
    var id_rendom = "<?php echo uniqid();?>";
    var adminCommission = 0;
    var id = "<?php echo $id;?>";
    var fcmToken = '';
    var old_order_status = '';
    var payment_shared = false;
    var vendorname = '';
    var vendorId = '';
    var driverId = '';
    var deliveryChargeVal = 0;
    var tip_amount_val = 0;
    var tip_amount = 0;
    var total_price_val = 0;
    var adminCommission_val = 0;
    var database = firebase.firestore();
    var ref = database.collection('parcel_orders').where("id", "==", id);
    var append_procucts_list = '';
    var append_procucts_total = '';
    var total_price = 0;
    var currentCurrency = '';
    var currencyAtRight = false;
    var refCurrency = database.collection('currencies').where('isActive', '==', true);
    var orderPreviousStatus = '';
    var orderPaymentMethod = '';
    var orderCustomerId = '';
    var orderPaytableAmount = 0;
    var orderTakeAwayOption = false;
    var manfcmTokenVendor = '';
    var manname = '';
    var decimal_degits = 0;
    var vendorAuthor ='';
    refCurrency.get().then(async function (snapshots) {
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;

        if (currencyData.decimal_degits) {
            decimal_degits = currencyData.decimal_degits;
        }
    });


    var geoFirestore = new GeoFirestore(database);
    var place_image = '';
    var ref_place = database.collection('settings').doc("placeHolderImage");
    ref_place.get().then(async function (snapshots) {

        var placeHolderImage = snapshots.data();
        place_image = placeHolderImage.image;
        //  console.log('place_image'+place_image);

    });


    $(document).ready(function () {

        var alovelaceDocumentRef = database.collection('parcel_orders').doc();
        if (alovelaceDocumentRef.id) {
            id_rendom = alovelaceDocumentRef.id;
        }

        $(document.body).on('click', '.redirecttopage', function () {
            var url = $(this).attr('data-url');
            window.location.href = url;
        });

        jQuery("#data-table_processing").show();

        ref.get().then(async function (snapshots) {
            var order = snapshots.docs[0].data();

            append_procucts_list = document.getElementById('order_products');
            append_procucts_list.innerHTML = '';


            append_procucts_total = document.getElementById('order_products_total');
            append_procucts_total.innerHTML = '';

            $("#sender_name").text(order.sender.name);
            $("#sender_address").text(order.sender.address);
            var date = "";
            var time = "";
            if (order.senderPickupDateTime) {
                date = order.senderPickupDateTime.toDate().toDateString();
                time = order.senderPickupDateTime.toDate().toLocaleTimeString();
            }
            $("#sender_datetime").text(date + " " + time);
            $("#sender_phone").text(order.sender.phone);

            $("#receiver_name").text(order.receiver.name);

            $("#receiver_address").text(order.receiver.address);
            var date = "";
            var time = "";

            if (order.receiverPickupDateTime) {
                date = order.receiverPickupDateTime.toDate().toDateString();
                time = order.receiverPickupDateTime.toDate().toLocaleTimeString();

            }
            $("#receiver_datetime").text(date + " " + time);
            $("#receiver_phone").text(order.receiver.phone);

            if (order.createdAt) {
                var date1 = order.createdAt.toDate().toDateString();
                var date = new Date(date1);
                var dd = String(date.getDate()).padStart(2, '0');
                var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = date.getFullYear();
                var createdAt_val = yyyy + '-' + mm + '-' + dd;
                var time = order.createdAt.toDate().toLocaleTimeString('en-US');

                $('#createdAt').text(createdAt_val + ' ' + time);
            }

            if (order.payment_method) {

                if (order.payment_method == 'cod') {
                    $('#payment_method').text('{{trans("lang.cash_on_delivery")}}');
                } else if (order.payment_method == 'paypal') {
                    $('#payment_method').text('{{trans("lang.paypal")}}');
                } else {
                    $('#payment_method').text(order.payment_method);
                }

            }
            // console.log("order.takeAway =="+order.takeAway);
            // if (order.hasOwnProperty('takeAway') && order.takeAway) {
            //     $('#driver_pending').hide();
            //     $('#driver_rejected').hide();
            //     $('#order_shipped').hide();
            //     $('#in_transit').hide();
            //     $('#order_completed').show();
            //     $('#order_type').text('{{trans("lang.order_takeaway")}}');
            //     $('.payment_method').hide();
            //     orderTakeAwayOption = true;

            // } else {
            //     $('#order_type').text('{{trans("lang.order_delivery")}}');
            //     $('.payment_method').show();
            //     $('#order_completed').hide();

            // }


            if (order.driver != '' && order.driver != undefined) {
                if(order.driver.carName!=''){
                    $('#driver_carName').text(order.driver.carName);
                }else{
                  $('#para_carName').hide();
                }

                $('#driver_carNumber').text(order.driver.carNumber);
                $('#driver_email').html('<a href="mailto:' + order.driver.email + '">' + order.driver.email + '</a>');
                $('#driver_firstName').text(order.driver.firstName);
                $('#driver_lastName').text(order.driver.lastName);
                $('#driver_phone').text(order.driver.phoneNumber);

            } else {

                $('.driver_details_hide').empty();
            }

            if (order.driverID != '' && order.driverID != undefined) {
                driverId = order.driverID;
            }

            fcmToken = order.author.fcmToken;
            //fcmTokenVendor = order.vendor.fcmToken;
            customername = order.author.firstName;

            old_order_status = order.status;
            if (order.payment_shared != undefined) {
                payment_shared = order.payment_shared;
            }
            var productsListHTML = buildHTMLParcelList(order);
            var productstotalHTML = buildParcelTotal(order);

            if (productsListHTML != '') {
                append_procucts_list.innerHTML = productsListHTML;
            }

            if (productstotalHTML != '') {
                append_procucts_total.innerHTML = productstotalHTML;
            }


            orderPreviousStatus = order.status;
            if (order.hasOwnProperty('payment_method')) {
                orderPaymentMethod = order.payment_method;
            }

            $("#order_status option[value='" + order.status + "']").attr("selected", "selected");
            if (order.status == "Order Rejected" || order.status == "Driver Rejected") {
                $("#order_status").prop("disabled", true);
            }
            var price = 0;


            jQuery("#data-table_processing").hide();
        })

        $(".save_order_btn").click(async function () {


            var clientName = $(".client_name").val();
            var orderStatus = $("#order_status").val();
            if (old_order_status != orderStatus) {

                if (orderStatus == "Order Completed") {
                    manfcmTokenVendor = fcmToken;
                    manname = customername;
                } else {
                    manfcmTokenVendor = fcmToken;
                    manname = vendorname;
                }

                database.collection('parcel_orders').doc(id).update({'status': orderStatus}).then(async function (result) {
                    if (orderStatus != orderPreviousStatus && payment_shared == false) {
                        if (orderStatus == 'Order Completed') {
                            //vendorAmount = parseFloat(total_price) - (parseFloat(adminCommission));
                            // driverAmount = parseFloat(deliveryChargeVal) + parseFloat(tip_amount);
                            // var vendor = database.collection('users').where("vendorID", "==", vendorId);
                            // var vendorWallet = 0;
                            // await database.collection('order_transactions').doc(id_rendom).set({
                            //     'date': vendorWallet,
                            //     'driverAmount': driverAmount,
                            //     'driverId': vendorId,
                            //     'id': id_rendom,
                            //     'order_id': id,
                            //     'vendorAmount': vendorAmount,
                            //     'vendorId': vendorAuthor
                            // }).then(async function (result) {
                            //     await vendor.get().then(async function (snapshotsnew) {
                            //         var vendordata = snapshotsnew.docs[0].data();
                                    // if (vendordata) {
                                    //     if (isNaN(vendordata.wallet_amount) || vendordata.wallet_amount == undefined) {
                                    //         vendorWallet = 0;
                                    //     } else {
                                    //         vendorWallet = parseFloat(vendordata.wallet_amount);
                                    //     }

                                    //     if (orderPaymentMethod == 'cod' && orderTakeAwayOption == true) {
                                    //         vendorWallet = vendorWallet - parseFloat(adminCommission);
                                    //     } else {
                                    //         vendorWallet = vendorWallet + parseFloat(vendorAmount);
                                    //     }
                                    //     if (!isNaN(vendorWallet)) {
                                    //         database.collection('users').doc(vendordata.id).update({'wallet_amount': vendorWallet}).then(function (result) {
                                    //             console.log("updated" + vendordata.id);
                                    //         });
                                    //     }

                                    // }
                                // });
                                // if (driverId && driverAmount) {
                                //     var driver = database.collection('users').where("id", "==", driverId);
                                //     await driver.get().then(async function (snapshotsdriver) {
                                //         var driverdata = snapshotsdriver.docs[0].data();
                                //         if (driverdata) {
                                //             if (isNaN(driverdata.wallet_amount) || driverdata.wallet_amount == undefined) {
                                //                 driverWallet = 0;
                                //             } else {
                                //                 driverWallet = driverdata.wallet_amount;
                                //             }
                                //             if (orderPaymentMethod == 'cod' && orderTakeAwayOption == true) {
                                //                 driverWallet = driverWallet - parseFloat(total_price) - parseFloat(driverAmount);
                                //             } else {
                                //                 driverWallet = driverWallet + driverAmount;
                                //             }
                                //             if (!isNaN(driverWallet)) {
                                //                 await database.collection('users').doc(driverdata.id).update({'wallet_amount': driverWallet}).then(async function (result) {
                                //                     /*console.log("updated"+driverdata.id);*/
                                //                 });
                                //             }

                                //         }
                                    // })
                                 //}
                           // });

                            await database.collection('parcel_orders').doc(id).update({'payment_shared': true}).then(async function (result) {
                            });
                        }


                        await $.ajax({
                            type: 'POST',
                            url: "<?php echo route('order-status-notification'); ?>",
                            data: {
                                _token: '<?php echo csrf_token() ?>',
                                'fcm': manfcmTokenVendor,
                                'vendorname': manname,
                                'orderStatus': orderStatus
                            },
                            success: function (data) {

                                if (orderPreviousStatus != 'Order Rejected' && orderPreviousStatus != 'Driver Rejected' && orderPaymentMethod != 'cod' && orderTakeAwayOption == false) {
                                    if (orderStatus == 'Order Rejected' || orderStatus == 'Driver Rejected') {
                                        // var walletId = "<?php echo uniqid();?>";
                                        // var canceldateNew = new Date();
                                        // var orderCancelDate = new Date(canceldateNew.setHours(23, 59, 59, 999));
                                        // database.collection('wallet').doc(walletId).set({
                                        //     'amount': parseFloat(orderPaytableAmount),
                                        //     'date': orderStatus,
                                        //     'id': walletId,
                                        //     'payment_status': 'success',
                                        //     'user_id': orderCustomerId,
                                        //     'payment_method': 'Cancelled Order Payment'
                                        // }).then(function (result) {
                                        //     window.location.href = '{{ route("orders")}}';
                                        // })
                                    } else {

                                        window.location.href = '{{ route("orders")}}';
                                    }
                                } else {
                                    window.location.href = '{{ route("orders")}}';
                                }

                            }
                        });

                    } else {

                        $.ajax({
                            type: 'POST',
                            url: "<?php echo route('order-status-notification'); ?>",
                            data: {
                                _token: '<?php echo csrf_token() ?>',
                                'fcm': manfcmTokenVendor,
                                'vendorname': manname,
                                'orderStatus': orderStatus
                            },
                            success: function (data) {

                                if (orderPreviousStatus != 'Order Rejected' && orderPreviousStatus != 'Driver Rejected' && orderPaymentMethod != 'cod' && orderTakeAwayOption == false) {
                                    if (orderStatus == 'Order Rejected' || orderStatus == 'Driver Rejected') {
                                        var walletId = "<?php echo uniqid();?>";
                                        var canceldateNew = new Date();
                                        var orderCancelDate = new Date(canceldateNew.setHours(23, 59, 59, 999));
                                        database.collection('wallet').doc(walletId).set({
                                            'amount': parseFloat(orderPaytableAmount),
                                            'date': orderStatus,
                                            'id': walletId,
                                            'payment_status': 'success',
                                            'user_id': orderCustomerId,
                                            'payment_method': 'Cancelled Order Payment'
                                        }).then(function (result) {
                                            window.location.href = '{{ route("orders")}}';
                                        })
                                    } else {

                                        window.location.href = '{{ route("orders")}}';
                                    }
                                } else {

                                    window.location.href = '{{ route("orders")}}';
                                }

                            }
                        });

                    }


                });
            }
        })

    })


    function buildHTMLParcelList(snapshotsParcel) {
        var html = '';
        var alldata = [];
        var number = [];
        var totalProductPrice = 0;


        html = html + '<tr>';

        var extra_html = '';

        html = html + '<td class="order-product"><div class="order-product-box">';

        html = html + '</div><div class="orders-tracking"><h6>' + snapshotsParcel.parcelWeight + '</h6><div class="orders-tracking-item-details">';

        html = html + '</div></div></td>';
        var parcelWeightCharge = "";
        var subTotal = "";
        if (currencyAtRight) {
            parcelWeightCharge = parseFloat(snapshotsParcel.parcelWeightCharge).toFixed(decimal_degits) + "" + currentCurrency;
            subTotal = parseFloat(snapshotsParcel.subTotal).toFixed(decimal_degits) + "" + currentCurrency;

        } else {
            parcelWeightCharge = currentCurrency + "" + parseFloat(snapshotsParcel.parcelWeightCharge).toFixed(decimal_degits);
            subTotal = currentCurrency + "" + parseFloat(snapshotsParcel.subTotal).toFixed(decimal_degits);

        }
        if (snapshotsParcel.parcelCategoryId != '' && snapshotsParcel.parcelCategoryId != undefined) {

            var category_type = getCategoryType(snapshotsParcel.parcelCategoryId);


        } else {
            $('#div_parcel_category').hide();
        }

        html = html + '<td>' + parcelWeightCharge + '</td><td> ' + parseFloat(snapshotsParcel.distance).toFixed(decimal_degits) + ' Km' + '</td><td>  ' + subTotal + '</td>';

        html = html + '</tr>';

        return html;
    }


    function buildParcelTotal(snapshotsProducts) {

        var intRegex = /^\d+$/;
        var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;

        var adminCommission = snapshotsProducts.adminCommission;
        var adminCommissionType = snapshotsProducts.adminCommissionType;
        var discount = snapshotsProducts.discount;
        var discountType = snapshotsProducts.discountType;
        var discountLabel = "";
        var subTotal = snapshotsProducts.subTotal;
        var tax = snapshotsProducts.tax;
        var taxType = snapshotsProducts.taxType;
        var taxLabel = snapshotsProducts.taxLabel;
        var notes = snapshotsProducts.note;


        var total_price = subTotal;

        var html = "";
        var intRegex = /^\d+$/;
        var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;


        if (intRegex.test(discount) || floatRegex.test(discount)) {

            discount = parseFloat(discount).toFixed(decimal_degits);
            total_price -= parseFloat(discount);

            if (discountType == "Percentage") {
                discountLabel = "(" + snapshotsProducts.discountLabel + "%)";

            }

            if (currencyAtRight) {

                discount = discount + "" + currentCurrency;
            } else {
                discount = currentCurrency + "" + discount;
            }

            html = html + '<tr><td class="label"> {{trans("lang.discount")}} ' + discountLabel + ' </td><td> - ' + discount + '</td></tr>';

        }
        if (taxType == "percent") {
            taxLabel = taxLabel + "(" + tax + "%)";
            tax = parseFloat(parseFloat(tax * total_price) / 100).toFixed(decimal_degits);

        } else {
            tax = parseFloat(tax).toFixed(decimal_degits);
        }


        if (!isNaN(tax)) {

            total_price = parseFloat(total_price) + parseFloat(tax);

            if (currencyAtRight) {

                tax = tax + "" + currentCurrency;
            } else {
                tax = currentCurrency + "" + tax;
            }

            html = html + '<tr><td class="label">' + taxLabel + '</td><td> + ' + tax + '</td></tr>';

        }

        if (currencyAtRight) {

            var total_price_val = total_price.toFixed(decimal_degits) + "" + currentCurrency;
        } else {
            var total_price_val = currentCurrency + "" + total_price.toFixed(decimal_degits);
        }

        html = html + '<tr><td class="label">{{trans("lang.total_amount")}}</td><td>  ' + total_price_val + '</td></tr>';


        if (intRegex.test(adminCommission) || floatRegex.test(adminCommission)) {
            var adminCommHtml = "";
            if (adminCommissionType == "Percent") {
                adminCommHtml = "(" + adminCommission + "%)";
                var adminCommission_val = parseFloat(parseFloat(total_price * adminCommission) / 100).toFixed(decimal_degits);
            } else {
                var adminCommission_val = parseFloat(adminCommission).toFixed(decimal_degits);
            }


            if (currencyAtRight) {

                adminCommission = adminCommission_val + "" + currentCurrency;
            } else {
                adminCommission = currentCurrency + "" + adminCommission_val;
            }

            html = html + '<tr><td class="label"><small>({{trans("lang.admin_commission")}} ' + adminCommHtml + '</small> </td><td><small> ' + adminCommission + ' </small>)</td></tr>';

        }

        if (notes != "") {
            html = html + '<tr><td class="label">{{trans("lang.notes")}}</td><td> ' + notes + ' </td></tr>';

        }
        return html;
    }

    function PrintElem(elem) {

        jQuery('#' + elem).printThis({
            debug: false,
            importStyle: true,
            loadCSS: [
                '<?php echo asset('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>',
                '<?php echo asset('css/style.css'); ?>',
                '<?php echo asset('css/colors/blue.css'); ?>',
                '<?php echo asset('css/icons/font-awesome/css/font-awesome.css'); ?>',
                '<?php echo asset('assets/plugins/toast-master/css/jquery.toast.css'); ?>',
            ],

        });


    }

    async function getCategoryType(categoryID) {

        var category_type = '';
        await database.collection('parcel_categories').where('id', '==', categoryID).get().then(async function (snapshots) {
            var parcle_category = snapshots.docs[0].data();
            category_type = parcle_category.title;
            console.log('category'+category_type);

            $('#parcel_type').text(category_type);



        });
        return category_type;
    }

</script>

@endsection
