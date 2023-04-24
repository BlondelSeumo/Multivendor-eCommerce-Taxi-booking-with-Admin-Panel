@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">

            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.order_plural')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
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

                                <div class="form-group row widt-100 gendetail-col">
                                    <label class="col-12 control-label"><strong>{{trans('lang.date_created')}}
                                            : </strong><span id="createdAt"></span></label>
                                    <!-- <div class="col-7">
                                       <span id="createdAt"></span>
                                    </div> -->
                                </div>

                                <!--  <div class="form-group row widt-100 gendetail-col"> -->
                                <div class="form-group row widt-100 gendetail-col payment_method">
                                    <label class="col-12 control-label"><strong>{{trans('lang.payment_methods')}}
                                            : </strong><span id="payment_method"></span></label>
                                    <!-- <div class="col-7">
                                       <span id="payment_method"></span>
                                    </div> -->
                                </div>

                                <div class="form-group row widt-100 gendetail-col">
                                    <label class="col-12 control-label"><strong>{{trans('lang.order_type')}}:</strong>
                                        <span id="order_type"></span></label>
                                </div>


                                <div class="form-group row widt-100 gendetail-col" id="ccname_div" style="display:none">
                                    <label class="col-12 control-label"><strong>{{trans('lang.courier_company_name')}}:</strong>
                                        <span id="ccname"></span></label>
                                </div>

                                <div class="form-group row widt-100 gendetail-col" id="ccid_div" style="display:none">
                                    <label class="col-12 control-label"><strong>{{trans('lang.courier_tracking_id')}}:</strong>
                                        <span id="ccid"></span></label>
                                </div>


                                <div class="form-group row width-100 ">
                                    <label class="col-3 control-label">{{trans('lang.status')}}:</label>
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
                                        <button type="button" class="btn btn-primary save_order_btn show_popup"><i
                                                class="fa fa-save"></i> {{trans('lang.update')}}
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="order_edit-genrl col-md-4">
                            <h3>{{ trans('lang.billing_details')}}</h3>

                            <div class="address order_detail-top-box">
                                <div class="form-group row widt-100 gendetail-col">
                                    <label class="col-12 control-label"><strong>{{trans('lang.name')}}:</strong>
                                        <span id="billing_name"></span></label>
                                </div>
                                <div class="form-group row widt-100 gendetail-col">
                                    <label class="col-12 control-label"><strong>{{trans('lang.address')}}:</strong>
                                        <span id="billing_line1"></span>
                                        <span id="billing_line2"></span>
                                        <span id="billing_country"></span></label>
                                </div>
                                {{-- <p>
                                    <span id="billing_name"></span><br>
                                    <span id="billing_line1"></span><br>
                                    <span id="billing_line2"></span><br>
                                    <span id="billing_country"></span>
                                </p>--}}
                                <p><strong>{{trans('lang.email_address')}}:</strong>
                                    <span id="billing_email"></span>
                                </p>
                                <p><strong>{{trans('lang.phone')}}:</strong>
                                    <span id="billing_phone"></span>
                                </p>
                            </div>
                        </div>

                        <div class="order_addre-edit col-md-4 driver_details_hide">
                            <h3>{{ trans('lang.driver_detail')}}</h3>

                            <div class="address order_detail-top-box">
                                <p>
                                    <span id="driver_firstName"></span> <span id="driver_lastName"></span><br>
                                </p>
                                <p><strong>{{trans('lang.email_address')}}:</strong>
                                    <span id="driver_email"></span>
                                </p>
                                <p><strong>{{trans('lang.phone')}}:</strong>
                                    <span id="driver_phone"></span>
                                </p>
                                <p><strong>{{trans('lang.car_name')}}:</strong>
                                    <span id="driver_carName"></span>
                                </p>
                                <p><strong>{{trans('lang.car_number')}}:</strong>
                                    <span id="driver_carNumber"></span>
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
                                                <th>{{trans('lang.item')}}</th>
                                                <th>{{trans('lang.price')}}</th>
                                                <th>{{trans('lang.qty')}}</th>
                                                <th>{{trans('lang.extra')}}</th>
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

                        <div class="col-md-4 order-deta-btm-right">
                            <div class="resturant-detail">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-header-title">{{trans('lang.vendor')}}</h4>
                                    </div>

                                    <div class="card-body">
                                        <a href="#" class="row redirecttopage" id="resturant-view">
                                            <div class="col-4">
                                                <img src="" class="resturant-img rounded-circle" alt="vendor"
                                                     width="70px" height="70px">
                                            </div>
                                            <div class="col-8">
                                                <h4 class="vendor-title"></h4>
                                            </div>
                                        </a>

                                        <h5 class="contact-info">{{trans('lang.contact_info')}}:</h5>

                                        <p><strong>{{trans('lang.phone')}}:</strong>
                                            <span id="vendor_phone"></span>
                                        </p>
                                        <p><strong>{{trans('lang.address')}}:</strong>
                                            <span id="vendor_address"></span>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>

                <div class="order_detail-review mt-4">
                    <div class="row">
                        <div class="rental-review col-md-12">

                            <div class="review-inner">
                                <h3>{{trans("lang.customer_reviews")}}</h3>
                                <div id="customers_rating_and_review">

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>


        <!--  </div> -->


        <div class="form-group col-12 text-center btm-btn">
            <button type="button" class="btn btn-primary save_order_btn"><i
                    class="fa fa-save"></i> {{trans('lang.save')}}
            </button>
            {{-- <?php if (!empty($_GET['pid'])) { ?>
                <a href="{!! route('placedOrders') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}
                </a>
            <?php } else if (!empty($_GET['rid'])) { ?>
                <a href="{!! route('rejectedOrders') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}
                </a>
            <?php } else if (!empty($_GET['aid'])) { ?>
                <a href="{!! route('acceptedOrders') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}
                </a>
            <?php } else { ?>
                <a href="{!! route('orders') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}
                </a>
            <?php } ?>--}}
            <a href="javascript:window.history.go(-1);" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}
            </a>
        </div>

        <div class="modal fade" id="orderTrakingModal" tabindex="-1" role="dialog" aria-labelledby="orderTrakingModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderTrakingModalLabel">{{trans('lang.please_provide_details')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="courierCompanyName"
                                   class="col-form-label">{{trans('lang.courier_company_name')}}</label>
                            <input type="text" class="form-control" id="courierCompanyName">
                        </div>
                        <div class="form-group">
                            <label for="courierTrackingId"
                                   class="col-form-label">{{trans('lang.courier_tracking_id')}}</label>
                            <input type="text" class="form-control" id="courierTrackingId">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="save_btn">{{trans('lang.save')}}</button>
                    </div>
                </div>
            </div>
        </div>

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
        var pid = "<?php echo $pid; ?>";
        var aid = "<?php echo $aid; ?>";
        var rid = "<?php echo $rid; ?>";
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
        if (pid != '') {
            var ref = database.collection('vendor_orders').where("id", "==", pid);

        } else if (rid != '') {
            var ref = database.collection('vendor_orders').where("id", "==", rid);

        } else if (aid != '') {
            var ref = database.collection('vendor_orders').where("id", "==", aid);

        } else {
            var ref = database.collection('vendor_orders').where("id", "==", id);

        }
        var reviewAttributes = {};
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
        var service_type = '';

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

        });


        $(document).ready(function () {

            var alovelaceDocumentRef = database.collection('vendor_orders').doc();
            if (alovelaceDocumentRef.id) {
                id_rendom = alovelaceDocumentRef.id;
            }

            $(document.body).on('click', '.redirecttopage', function () {
                var url = $(this).attr('data-url');
                window.location.href = url;
            });

            $(document.body).on('click', '#save_btn', function () {
                var courierCompanyName = $("#courierCompanyName").val();
                var courierTrackingId = $("#courierTrackingId").val();
                if (courierCompanyName == '') {
                    alert('{{trans("lang.courier_company_name_error")}}');
                    return false;
                }
                if (courierTrackingId == '') {
                    alert('{{trans("lang.courier_tracking_id_error")}}');
                    return false;
                }
                $(".save_order_btn").removeClass('show_popup').click();
            });

            jQuery("#data-table_processing").show();

            ref.get().then(async function (snapshots) {
                var order = snapshots.docs[0].data();
                getUserReview(order);

                if (order.vendor.section_id != undefined && order.vendor.section_id != '') {
                    await database.collection('sections').doc(order.vendor.section_id).get().then(async function (snapshot) {
                        service_type = snapshot.data().serviceTypeFlag;
                    });
                }

                append_procucts_list = document.getElementById('order_products');
                append_procucts_list.innerHTML = '';

                append_procucts_total = document.getElementById('order_products_total');
                append_procucts_total.innerHTML = '';


                $("#billing_name").text(order.address.name);
                var billingAddressstring = '';

                $("#trackng_number").text(id);
                if (order.address.hasOwnProperty('line1')) {
                    $("#billing_line1").text(order.address.line1);
                }
                if (order.address.hasOwnProperty('line2')) {
                    billingAddressstring = billingAddressstring + order.address.line2;
                }
                if (order.address.hasOwnProperty('city')) {
                    billingAddressstring = billingAddressstring + ", " + order.address.city;
                }

                if (order.address.hasOwnProperty('postalCode')) {
                    billingAddressstring = billingAddressstring + ", " + order.address.postalCode;
                }

                if (order.author.hasOwnProperty('phoneNumber')) {
                    $("#billing_phone").text(order.author.phoneNumber);
                }

                $("#billing_line2").text(billingAddressstring);

                if (order.address.hasOwnProperty('country')) {

                    $("#billing_country").text(order.address.country);

                }

                if (order.address.hasOwnProperty('email')) {
                    $("#billing_email").html('<a href="mailto:' + order.address.email + '">' + order.address.email + '</a>');
                }

                if (order.createdAt) {
                    var date1 = order.createdAt.toDate().toDateString();
                    var date = new Date(date1);
                    var dd = String(date.getDate()).padStart(2, '0');
                    var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = date.getFullYear();
                    var createdAt_val = yyyy + '-' + mm + '-' + dd;
                    var time = order.createdAt.toDate().toLocaleTimeString('en-US');
                    //console.log('time'+time);
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
                console.log();
                console.log("order.takeAway ==" + order.takeAway);

                /*if (order.hasOwnProperty('takeAway') && order.takeAway) {
                    $('#driver_pending').hide();
                    $('#driver_rejected').hide();
                    $('#order_shipped').hide();
                    $('#in_transit').hide();
                    $('#order_completed').show();
                    $('#order_type').text('{{trans("lang.order_takeaway")}}');
                $('.payment_method').hide();
                orderTakeAwayOption = true;
            } else {
                $('#order_type').text('{{trans("lang.order_delivery")}}');
                $('.payment_method').show();
                $('#order_completed').hide();
            }*/

                if (order.hasOwnProperty('takeAway') && order.takeAway) {
                    $('#order_completed').show();
                    $('#order_type').text('{{trans("lang.order_takeaway")}}');
                    $('.payment_method').hide();
                    orderTakeAwayOption = true;
                } else {
                    $('#order_type').text('{{trans("lang.order_delivery")}}');
                    $('.payment_method').show();
                    $('#order_completed').hide();
                }

                if (service_type != undefined && service_type != '' && service_type == "ecommerce-service") {
                    $('#order_placed').hide();
                    $('#order_accepted').hide();
                    $('#order_rejected').hide();
                    $('#driver_pending').hide();
                    $('#driver_rejected').hide();
                    $('#order_shipped').hide();
                    $('#order_completed').show();
                    $('#ccname_div').show();
                    $('#ccid_div').show();
                } else {
                    $('#order_placed').hide();
                    $('#driver_pending').hide();
                    $('#driver_rejected').hide();
                    $('#order_shipped').hide();
                    $('#in_transit').hide();
                    $('#ccname_div').hide();
                    $('#ccid_div').hide();
                }

                if (order.courierCompanyName != '' && order.courierCompanyName != undefined) {
                    $("#courierCompanyName").val(order.courierCompanyName);
                    $("#ccname").text(order.courierCompanyName);
                }
                if (order.courierTrackingId != '' && order.courierTrackingId != undefined) {
                    $("#courierTrackingId").val(order.courierTrackingId);
                    $("#ccid").text(order.courierTrackingId);
                }


                if ((order.driver != '' && order.driver != undefined) && order.takeAway == false) {

                    $('#driver_carName').text(order.driver.carName);
                    $('#driver_carNumber').text(order.driver.carNumber);
                    $('#driver_email').html('<a href="mailto:' + order.driver.email + '">' + order.driver.email + '</a>');
                    $('#driver_firstName').text(order.driver.firstName);
                    $('#driver_lastName').text(order.driver.lastName);
                    $('#driver_phone').text(order.driver.phoneNumber);

                } else {
                    $('.order_edit-genrl').removeClass('col-md-4').addClass('col-md-6');
                    $('.order_addre-edit').removeClass('col-md-4').addClass('col-md-6');
                    $('.driver_details_hide').empty();
                }

                if (order.driverID != '' && order.driverID != undefined) {
                    driverId = order.driverID;
                }

                if (order.vendor && order.vendor.author != '' && order.vendor.author != undefined) {
                    vendorAuthor = order.vendor.author;
                }


                fcmToken = order.author.fcmToken;
                vendorname = order.vendor.title;

                fcmTokenVendor = order.vendor.fcmToken;
                customername = order.author.firstName;

                vendorId = order.vendor.id;
                old_order_status = order.status;
                if (order.payment_shared != undefined) {
                    payment_shared = order.payment_shared;
                }
                var productsListHTML = buildHTMLProductsList(order.products);
                var productstotalHTML = buildHTMLProductstotal(order);

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

                if (order.vendorID) {
                    var vendor = database.collection('vendors').where("id", "==", order.vendorID);

                    vendor.get().then(async function (snapshotsnew) {
                        var vendordata = snapshotsnew.docs[0].data();

                        if (vendordata.id) {
                            <?php /* var route_view =  '{{route("vendors.view",":id")}}';
                route_view = route_view.replace(':id', vendordata.id);

              $('#resturant-view').attr('data-url',route_view);  */ ?>
                        }
                        if (vendordata.photo) {
                            $('.resturant-img').attr('src', vendordata.photo);
                        } else {
                            $('.resturant-img').attr('src', place_image);
                        }
                        if (vendordata.title) {
                            $('.vendor-title').html(vendordata.title);
                        }

                        if (vendordata.phonenumber) {
                            $('#vendor_phone').text(vendordata.phonenumber);
                        }
                        if (vendordata.location) {
                            $('#vendor_address').text(vendordata.location);
                        }

                    });
                }
                jQuery("#data-table_processing").hide();
            })

            $(".save_order_btn").click(async function () {

                var courierCompanyName = $("#courierCompanyName").val();
                var courierTrackingId = $("#courierTrackingId").val();

                var clientName = $(".client_name").val();
                var orderStatus = $("#order_status").val();
                var selectedOrderStatus = $("#order_status option:selected").val();

                if (old_order_status != orderStatus) {

                    if (selectedOrderStatus == "In Transit") {
                        if ($(this).hasClass('show_popup')) {
                            $("#orderTrakingModal").modal('show');
                            return false;
                        }
                    }

                    if (orderStatus == "Order Completed") {
                        manfcmTokenVendor = fcmTokenVendor;
                        manname = customername;
                    } else {
                        manfcmTokenVendor = fcmToken;
                        manname = vendorname;
                    }

                    database.collection('vendor_orders').doc(id).update({
                        'status': orderStatus,
                        'courierCompanyName': courierCompanyName,
                        'courierTrackingId': courierTrackingId
                    }).then(async function (result) {

                        if (orderStatus != orderPreviousStatus && payment_shared == false) {

                            if (orderStatus == 'Order Completed') {

                                vendorAmount = parseFloat(total_price) - (parseFloat(adminCommission));
                                driverAmount = parseFloat(deliveryChargeVal) + parseFloat(tip_amount);
                                if (service_type != undefined && service_type != '' && service_type == "ecommerce-service") {
                                    vendorAmount = vendorAmount + driverAmount;
                                }

                                var vendor = database.collection('users').where("vendorID", "==", vendorId);
                                var vendorWallet = 0;

                                await database.collection('order_transactions').doc(id_rendom).set({
                                    'date': new Date(),
                                    'driverAmount': driverAmount,
                                    'driverId': vendorId,
                                    'id': id_rendom,
                                    'order_id': id,
                                    'vendorAmount': vendorAmount,
                                    'vendorId': vendorAuthor
                                }).then(async function (result) {

                                    await vendor.get().then(async function (snapshotsnew) {

                                        var vendordata = snapshotsnew.docs[0].data();
                                        if (vendordata) {
                                            if (isNaN(vendordata.wallet_amount) || vendordata.wallet_amount == undefined) {
                                                vendorWallet = 0;
                                            } else {
                                                vendorWallet = parseFloat(vendordata.wallet_amount);
                                            }

                                            if (service_type != undefined && service_type != '' && service_type == "ecommerce-service") {
                                                if (orderPaymentMethod == 'cod') {
                                                    vendorWallet = vendorWallet - parseFloat(adminCommission);
                                                } else {
                                                    vendorWallet = vendorWallet + parseFloat(vendorAmount);
                                                }
                                            } else {
                                                if (orderPaymentMethod == 'cod' && orderTakeAwayOption == true) {
                                                    vendorWallet = vendorWallet - parseFloat(adminCommission);
                                                } else {
                                                    vendorWallet = vendorWallet + parseFloat(vendorAmount);
                                                }
                                            }

                                            if (!isNaN(vendorWallet)) {
                                                database.collection('users').doc(vendordata.id).update({'wallet_amount': vendorWallet}).then(function (result) {
                                                    console.log("updated" + vendordata.id);
                                                });
                                            }
                                        }
                                    });

                                    /*if (driverId && driverAmount) {

                                        var driver = database.collection('users').where("id", "==", driverId);
                                        await driver.get().then(async function (snapshotsdriver) {
                                            var driverdata = snapshotsdriver.docs[0].data();
                                            if (driverdata) {
                                                if (isNaN(driverdata.wallet_amount) || driverdata.wallet_amount == undefined) {
                                                    driverWallet = 0;
                                                } else {
                                                    driverWallet = driverdata.wallet_amount;
                                                }
                                                if (orderPaymentMethod == 'cod' && orderTakeAwayOption == true) {
                                                    driverWallet = driverWallet - parseFloat(total_price) - parseFloat(driverAmount);
                                                } else {
                                                    driverWallet = driverWallet + driverAmount;
                                                }
                                                if (!isNaN(driverWallet)) {
                                                    await database.collection('users').doc(driverdata.id).update({'wallet_amount': driverWallet}).then(async function (result) {
                                                        //console.log("updated"+driverdata.id);
                                                    });
                                                }

                                            }
                                        })
                                    }*/

                                });

                                await database.collection('vendor_orders').doc(id).update({'payment_shared': true}).then(async function (result) {
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
                                            var walletId = "<?php echo uniqid();?>";
                                            var canceldateNew = new Date();
                                            var orderCancelDate = new Date(canceldateNew.setHours(23, 59, 59, 999));
                                            database.collection('wallet').doc(walletId).set({
                                                'amount': parseFloat(orderPaytableAmount),
                                                'date': new Date(),
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
                                                'date': new Date(),
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

        function getUserReview(vendorOrder, reviewAttr) {
            var refUserReview = database.collection('items_review').where('orderid', "==", vendorOrder.id);
            refUserReview.get().then(async function (userreviewsnapshot) {
                var reviewHTML = '';
                reviewHTML = buildRatingsAndReviewsHTML(vendorOrder, userreviewsnapshot);
                console.log(reviewHTML);
                if (userreviewsnapshot.docs.length >0) {
                    jQuery("#customers_rating_and_review").append(reviewHTML);
                }
                else{
                    jQuery("#customers_rating_and_review").html('<h4>No Reviews Found</h4>');
                }
            });
        }

        function buildRatingsAndReviewsHTML(vendorOrder, userreviewsnapshot) {
            var allreviewdata = [];
            var reviewhtml = '';
            console.log(vendorOrder);
            userreviewsnapshot.docs.forEach((listval) => {
                var reviewDatas = listval.data();
                reviewDatas.id = listval.id;
                allreviewdata.push(reviewDatas);
            });
            //reviewhtml += '<h3>{{trans("lang.customer_reviews")}}</h3>'
            reviewhtml += '<div class="user-ratings">';
            allreviewdata.forEach((listval) => {
                var val = listval;
                vendorOrder.products.forEach((productval) => {
                    if (productval.id == val.productId) {
                        rating = val.rating;
                        reviewhtml = reviewhtml + '<div class="reviews-members py-3 border mb-3"><div class="media">';
                        reviewhtml = reviewhtml + '<a href="javascript:void(0);"><img alt="#" src="' + productval.photo + '" class=" img-circle img-size-32 mr-2" style="width:60px;height:60px"></a>';
                        reviewhtml = reviewhtml + '<div class="media-body d-flex"><div class="reviews-members-header"><h6 class="mb-0"><a class="text-dark" href="javascript:void(0);">' + productval.name + '</a></h6><div class="star-rating"><div class="d-inline-block" style="font-size: 14px;">';
                        reviewhtml = reviewhtml + ' <ul class="rating" data-rating="' + rating + '">';
                        reviewhtml = reviewhtml + '<li class="rating__item"></li>';
                        reviewhtml = reviewhtml + '<li class="rating__item"></li>';
                        reviewhtml = reviewhtml + '<li class="rating__item"></li>';
                        reviewhtml = reviewhtml + '<li class="rating__item"></li>';
                        reviewhtml = reviewhtml + '<li class="rating__item"></li>';
                        reviewhtml = reviewhtml + '</ul>';
                        reviewhtml = reviewhtml + '</div></div>';
                        reviewhtml = reviewhtml + '</div>';
                        reviewhtml = reviewhtml + '<div class="review-date ml-auto">';
                        if (val.createdAt != null && val.createdAt != "") {
                            var review_date = val.createdAt.toDate().toLocaleDateString('en', {
                                year: "numeric",
                                month: "short",
                                day: "numeric"
                            });
                            reviewhtml = reviewhtml + '<span>' + review_date + '</span>';
                        }
                        reviewhtml = reviewhtml + '</div>';
                        var photos = '';
                        if (val.photos.length > 0) {
                            photos += '<div class="photos"><ul>';
                            $.each(val.photos, function (key, img) {
                                photos += '<li><img src="' + img + '" width="100"></li>';
                            });
                            photos += '</ul></div>';
                        }
                        reviewhtml = reviewhtml + '</div></div><div class="reviews-members-body w-100"><p class="mb-2">' + val.comment + '</p>' + photos + '</div>';
                        if (val.hasOwnProperty('reviewAttributes') && val.reviewAttributes != null) {
                            reviewhtml += '<div class="attribute-ratings feature-rating mb-2">';
                            var label_feature = "{{trans('lang.byfeature')}}";
                            reviewhtml += '<h3 class="mb-2">' + label_feature + '</h3>';
                            reviewhtml += '<div class="media-body">';
                            $.each(val.reviewAttributes, function (aid, data) {
                                var at_id = aid;
                                var at_title = reviewAttributes[aid];
                                var at_value = data;
                                reviewhtml += '<div class="feature-reviews-members-header d-flex mb-3">';
                                reviewhtml += '<h6 class="mb-0">' + at_title + '</h6>';
                                reviewhtml = reviewhtml + '<div class="rating-info ml-auto d-flex">';
                                reviewhtml = reviewhtml + '<div class="star-rating">';
                                reviewhtml = reviewhtml + ' <ul class="rating" data-rating="' + at_value + '">';
                                reviewhtml = reviewhtml + '<li class="rating__item"></li>';
                                reviewhtml = reviewhtml + '<li class="rating__item"></li>';
                                reviewhtml = reviewhtml + '<li class="rating__item"></li>';
                                reviewhtml = reviewhtml + '<li class="rating__item"></li>';
                                reviewhtml = reviewhtml + '<li class="rating__item"></li>';
                                reviewhtml = reviewhtml + '</ul>';
                                reviewhtml += '</div>';

                                reviewhtml += '<div class="count-rating ml-2">';
                                reviewhtml += '<span class="count">' + at_value + '</span>';
                                reviewhtml += '</div>';


                                reviewhtml += '</div></div>';
                            });
                            reviewhtml += '</div></div>';
                        }
                        reviewhtml += '</div>';
                    }
                    reviewhtml += '</div>';
                });


            });

            reviewhtml += '</div>';

            return reviewhtml;
        }

        function buildHTMLProductsList(snapshotsProducts) {
            var html = '';
            var alldata = [];
            var number = [];
            var totalProductPrice = 0;

            snapshotsProducts.forEach((product) => {

                var val = product;

                html = html + '<tr>';

                var extra_html = '';
                if (product.extras != undefined && product.extras != '' && product.extras.length > 0) {
                    extra_html = extra_html + '<span>';
                    var extra_count = 1;
                    try {
                        product.extras.forEach((extra) => {

                            if (extra_count > 1) {
                                extra_html = extra_html + ',' + extra;
                            } else {
                                extra_html = extra_html + extra;
                            }
                            extra_count++;
                        })
                    } catch (error) {

                    }

                    extra_html = extra_html + '</span>';
                }

                html = html + '<td class="order-product"><div class="order-product-box">';
                if (val.photo != '') {
                    html = html + '<img class="img-circle img-size-32 mr-2" style="width:60px;height:60px;" src="' + val.photo + '" alt="image">';
                } else {
                    html = html + '<img class="img-circle img-size-32 mr-2" style="width:60px;height:60px;" src="' + place_image + '" alt="image">';
                }

                html = html + '</div><div class="orders-tracking"><h6>' + val.name + '</h6><div class="orders-tracking-item-details">';

                if (val.variant_info) {
                    html = html + '<div class="variant-info">';
                    html = html + '<ul>';
                    $.each(val.variant_info.variant_options, function (label, value) {
                        html = html + '<li class="variant"><span class="label">' + label + '</span><span class="value">' + value + '</span></li>';
                    });
                    html = html + '</ul>';
                    html = html + '</div>';
                }

                if (extra_count > 1 || product.size) {
                    html = html + '<strong>{{trans("lang.extras")}} :</strong>';
                }
                if (extra_count > 1) {
                    html = html + '<div class="extra"><span>{{trans("lang.extras")}} :</span><span class="ext-item">' + extra_html + '</span></div>';
                }
                if (product.size) {
                    html = html + '<div class="type"><span>{{trans("lang.type")}} :</span><span class="ext-size">' + product.size + '</span></div>';
                }

                price_item = parseFloat(val.price).toFixed(decimal_degits);

                totalProductPrice = parseFloat(price_item) * parseInt(val.quantity);
                var extras_price = 0;
                if (product.extras != undefined && product.extras != '' && product.extras.length > 0) {
                    extras_price_item = (parseFloat(val.extras_price) * parseInt(val.quantity)).toFixed(decimal_degits);
                    if (parseFloat(extras_price_item) != NaN && val.extras_price != undefined) {
                        extras_price = extras_price_item;
                    }
                    totalProductPrice = parseFloat(extras_price) + parseFloat(totalProductPrice);
                }
                totalProductPrice = parseFloat(totalProductPrice).toFixed(decimal_degits);

                if (currencyAtRight) {
                    price_val = parseFloat(price_item).toFixed(decimal_degits) + "" + currentCurrency;
                    extras_price_val = parseFloat(extras_price).toFixed(decimal_degits) + "" + currentCurrency;
                    totalProductPrice_val = parseFloat(totalProductPrice).toFixed(decimal_degits) + "" + currentCurrency;
                } else {
                    price_val = currentCurrency + "" + parseFloat(price_item).toFixed(decimal_degits);
                    extras_price_val = currentCurrency + "" + parseFloat(extras_price).toFixed(decimal_degits);
                    totalProductPrice_val = currentCurrency + "" + parseFloat(totalProductPrice).toFixed(decimal_degits);
                }

                html = html + '</div></div></td>';
                html = html + '<td>' + price_val + '</td><td> × ' + val.quantity + '</td><td> + ' + extras_price_val + '</td><td>  ' + totalProductPrice_val + '</td>';

                html = html + '</tr>';
                total_price += parseFloat(totalProductPrice);

            });
            totalProductPrice = 0;

            return html;
        }

        var refReviewAttributes = database.collection('review_attributes');
        refReviewAttributes.get().then(async function (snapshots) {
            if (snapshots != undefined) {
                snapshots.forEach((doc) => {
                    var data = doc.data();
                    reviewAttributes[data.id] = data.title;
                });
            }
        });

        function buildHTMLProductstotal(snapshotsProducts) {
            var html = '';
            var alldata = [];
            var number = [];

            var adminCommission = snapshotsProducts.adminCommission;
            var adminCommissionType = snapshotsProducts.adminCommissionType;
            var discount = snapshotsProducts.discount;

            var couponCode = snapshotsProducts.couponCode;
            var extras = snapshotsProducts.extras;
            var extras_price = snapshotsProducts.extras_price;
            var rejectedByDrivers = snapshotsProducts.rejectedByDrivers;
            var takeAway = snapshotsProducts.takeAway;
            var tip_amount = snapshotsProducts.tip_amount;

            var notes = snapshotsProducts.notes;
            var tax_amount = snapshotsProducts.vendor.tax_amount;
            var status = snapshotsProducts.status;
            var products = snapshotsProducts.products;
            var deliveryCharge = snapshotsProducts.deliveryCharge;

            var intRegex = /^\d+$/;
            var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;

            if (products) {

                products.forEach((product) => {

                    var val = product;

                });
            }


            if (intRegex.test(discount) || floatRegex.test(discount)) {

                discount = parseFloat(discount).toFixed(decimal_degits);
                total_price -= parseFloat(discount);


                if (currencyAtRight) {
                    discount_val = discount + "" + currentCurrency;
                } else {
                    discount_val = currentCurrency + "" + discount;
                }

                couponCode_html = '';
                if (couponCode) {
                    couponCode_html = '</br><small>{{trans("lang.coupon_codes")}} :' + couponCode + '</small>';
                }
                html = html + '<tr><td class="label">{{trans("lang.discount")}}' + couponCode_html + '</td><td class="discount">-' + discount_val + '</td></tr>';
            }
            /* aarti's code */
            var special_dicount = 0;
            label = '';
            labeltype = '';
            try {
                if (snapshotsProducts.hasOwnProperty('specialDiscount')) {

                    if (snapshotsProducts.specialDiscount.specialType && snapshotsProducts.specialDiscount.special_discount) {
                        if (snapshotsProducts.specialDiscount.specialType == "percentage") {
                            special_dicount = snapshotsProducts.specialDiscount.special_discount;
                            // special_dicount = (snapshotsProducts.specialDiscount.special_discount * total_price) / 100;
                            labeltype = "%";
                        } else {
                            special_dicount = snapshotsProducts.specialDiscount.special_discount;
                            labeltype = "fix";
                        }
                        label = snapshotsProducts.specialDiscount.special_discount_label;
                    }
                }
            } catch (error) {

            }

            if (special_dicount) {
                html = html + '<tr><td class="label">{{trans("lang.special_discount")}}</td><td class="tax_special_discount">-' + currentCurrency + special_dicount.toFixed(decimal_degits) + '(' + snapshotsProducts.specialDiscount.special_discount_label + ' ' + labeltype + ')</td></tr>';
                total_price = total_price - special_dicount;
            }

            /* end code */

            var tax = 0;
            taxlabel = '';
            taxlabeltype = '';
            try {
                if (snapshotsProducts.hasOwnProperty('taxSetting')) {
                    if (snapshotsProducts.taxSetting.type && snapshotsProducts.taxSetting.tax) {
                        if (snapshotsProducts.taxSetting.type == "percent") {
                            tax = (snapshotsProducts.taxSetting.tax * total_price) / 100;
                            taxlabeltype = "%";
                        } else {
                            tax = snapshotsProducts.taxSetting.tax;
                            taxlabeltype = "fix";
                        }
                        taxlabel = snapshotsProducts.taxSetting.label;
                    }
                }
            } catch (error) {

            }

            if (!isNaN(tax) && tax != 0) {
                if (currencyAtRight) {
                    html = html + '<tr><td class="label">{{trans("lang.tax")}}</td><td class="tax_amount">+' + tax.toFixed(decimal_degits) + '' + currentCurrency + '(' + taxlabel + ' ' + snapshotsProducts.taxSetting.tax + ' ' + taxlabeltype + ')</td></tr>';
                } else {
                    html = html + '<tr><td class="label">{{trans("lang.tax")}}</td><td class="tax_amount">+' + currentCurrency + tax.toFixed(decimal_degits) + '(' + taxlabel + ' ' + snapshotsProducts.taxSetting.tax + ' ' + taxlabeltype + ')</td></tr>';
                }

                total_price = total_price + tax;
            }

            if (intRegex.test(deliveryCharge) || floatRegex.test(deliveryCharge)) {

                deliveryCharge = parseFloat(deliveryCharge).toFixed(decimal_degits);
                total_price += parseFloat(deliveryCharge);

                if (currencyAtRight) {
                    deliveryCharge_val = deliveryCharge + "" + currentCurrency;
                } else {
                    deliveryCharge_val = currentCurrency + "" + deliveryCharge;
                }
                if (takeAway == '' || takeAway == false) {
                    deliveryChargeVal = deliveryCharge;
                    html = html + '<tr><td class="label">{{trans("lang.deliveryCharge")}}</td><td class="deliveryCharge">+' + deliveryCharge_val + '</td></tr>';
                }
            }


            var total_item_price = total_price;
            if (intRegex.test(tip_amount) || floatRegex.test(tip_amount)) {

                tip_amount = parseFloat(tip_amount).toFixed(decimal_degits);
                total_price += parseFloat(tip_amount);
                total_price = parseFloat(total_price).toFixed(decimal_degits);

                if (currencyAtRight) {
                    tip_amount_val = tip_amount + "" + currentCurrency;
                } else {
                    tip_amount_val = currentCurrency + "" + tip_amount;
                }
                if (takeAway == '' || takeAway == false) {
                    //tip_amount_val = tip_amount;
                    html = html + '<tr><td class="label">{{trans("lang.tip_amount")}}</td><td class="tip_amount_val">+' + tip_amount_val + '</td></tr>';
                }
            }

            orderPaytableAmount = total_price;

            if (currencyAtRight) {
                total_price_val = parseFloat(total_price).toFixed(decimal_degits) + "" + currentCurrency;
            } else {
                total_price_val = currentCurrency + "" + parseFloat(total_price).toFixed(decimal_degits);
            }
            //total_price_val = total_price;
            html = html + '<tr><td class="label">{{trans("lang.total_amount")}}</td><td class="total_price_val">' + total_price_val + '</td></tr>';

            if (adminCommission != undefined && adminCommissionType != undefined) {
                var commission = 0;
                if (adminCommissionType == "Percent") {
                    commission = (total_item_price * parseFloat(adminCommission)) / 100;
                } else {
                    commission = parseFloat(adminCommission);
                }
                adminCommission = commission;
            } else if (adminCommission != undefined) {
                var commission = parseFloat(adminCommission);
                adminCommission = commission;
            }

            if (adminCommission) {

                adminCommission = parseFloat(adminCommission).toFixed(decimal_degits);
                if (currencyAtRight) {
                    adminCommission_val = adminCommission + "" + currentCurrency;
                } else {
                    adminCommission_val = currentCurrency + "" + adminCommission;
                }
                //adminCommission_val = adminCommission;
                html = html + '<tr><td class="label"><small>( {{trans("lang.admin_commission")}} </small></td><td class="adminCommission_val"><small>' + adminCommission_val + ')</small></td></tr>';
            }

            if (notes) {
                html = html + '<tr><td class="label">{{trans("lang.notes")}}</td><td class="adminCommission_val">' + notes + '</td></tr>';
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
    </script>

@endsection
