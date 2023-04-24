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

    <div class="parcel_order mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 top-nav mb-3">

                    <ul class="nav nav-tabsa custom-tabsa border-0 bg-white rounded overflow-hidden shadow-sm p-2 c-t-order"
                        id="myTab" role="tablist">

                        <li class="nav-item" role="presentation">

                            <a class="nav-link border-0 text-dark py-3 active" id="completed-tab" data-toggle="tab"
                               href="#completed" role="tab" aria-controls="completed" aria-selected="true">

                                <i class="feather-check mr-2 text-success mb-0"></i> Completed</a>

                        </li>

                        <li class="nav-item border-top" role="presentation">

                            <a class="nav-link border-0 text-dark py-3" id="progress-tab" data-toggle="tab"
                               href="#progress" role="tab" aria-controls="progress" aria-selected="false">

                                <i class="feather-clock mr-2 text-warning mb-0"></i> On Progress</a>

                        </li>

                        <li class="nav-item border-top" role="presentation">

                            <a class="nav-link border-0 text-dark py-3" id="canceled-tab" data-toggle="tab"
                               href="#canceled" role="tab" aria-controls="canceled" aria-selected="false">

                                <i class="feather-x-circle mr-2 text-danger mb-0"></i> Canceled</a>

                        </li>

                    </ul>

                </div>
            </div>
            <div class="tab-content col-md-12" id="myTabContent">

                <div class="tab-pane fade show active" id="completed" role="tabpanel" aria-labelledby="completed-tab">

                    <div class="order-body">

                        <div id="completed_orders"></div>


                    </div>

                </div>

                <div class="tab-pane fade" id="progress" role="tabpanel" aria-labelledby="progress-tab">

                    <div class="order-body">

                        <div id="pending_orders"></div>


                    </div>

                </div>

                <div class="tab-pane fade" id="canceled" role="tabpanel" aria-labelledby="canceled-tab">

                    <div class="order-body">

                        <div id="rejected_orders"></div>


                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
</div>
</div>
</div>

</div>
</div>
<!-- Add Review -->
<span style="display: none;">
<button type="button" class="btn btn-primary" id="" data-toggle="modal"
        data-target="#">Large modal</button>
</span>
<div class="modal fade" id="review-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <div class="modal-header" style="display:block">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">Review Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="modal-body-inner">

                    <div class="review-box">
                        <div class="form-group row" id="default_review">
                            <div class="col-sm-12">
                                <div class="rating-wrap d-flex align-items-center mt-4 mb-3" id="#">
                                    <label><h4>Rate</h4></label>
                                    <fieldset class="rating rate_this">
                                        <input type="radio" name="rating" id="star5" value="5"/><label for="star5"
                                                                                                       class="full"></label>
                                        <input type="radio" name="rating" id="star4.5" value="4.5"/><label
                                                for="star4.5" class="half"></label>
                                        <input type="radio" name="rating" id="star4" value="4"/><label for="star4"
                                                                                                       class="full"></label>
                                        <input type="radio" name="rating" id="star3.5" value="3.5"/><label
                                                for="star3.5" class="half"></label>
                                        <input type="radio" name="rating" id="star3" value="3"/><label for="star3"
                                                                                                       class="full"></label>
                                        <input type="radio" name="rating" id="star2.5" value="2.5"/><label
                                                for="star2.5" class="half"></label>
                                        <input type="radio" name="rating" id="star2" value="2"/><label for="star2"
                                                                                                       class="full"></label>
                                        <input type="radio" name="rating" id="star1.5" value="1.5"/><label
                                                for="star1.5" class="half"></label>
                                        <input type="radio" name="rating" id="star1" value="1"/><label for="star1"
                                                                                                       class="full"></label>
                                        <input type="radio" name="rating" id="star0.5" value="0.5"/><label
                                                for="star0.5" class="half"></label>
                                        <input type="hidden" value="0" id="rating-value"/>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row text-center">
                            <div class="col-sm-12">
                                <textarea class="form-control review_comment" id="review_comment" name="review_comment"
                                          placeholder="Type Comment..." value=""></textarea>
                            </div>
                        </div>
                        <!-- </div>
                        <div class="modal-footer"> -->
                        <div class="review-sub-btn">
                            <button type="button" class="btn btn-primary add_review_btn text-center"
                                    data-parent="modal-body">{{trans('lang.add_review')}}</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- End Add review -->
@include('layouts.footer')
@include('layouts.nav')

<script type="text/javascript">


    var append_categories = '';
    var parcel_orders = database.collection('parcel_orders');
    var completedorsersref = database.collection('parcel_orders').where("authorID", "==", user_uuid).orderBy('createdAt', 'desc');
    var deliveryCharge = 0;
    var taxSetting = [];

    var currentCurrency = '';
    var currencyAtRight = false;
    var decimal_degits = 0;

    var refCurrency = database.collection('currencies').where('isActive', '==', true);
    refCurrency.get().then(async function (snapshots) {
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;

        if (currencyData.decimal_degits) {
            decimal_degits = currencyData.decimal_degits;
        }
    });

    $(document).ready(function () {
        getOrders();

    });


    async function getOrders() {


        completedorsersref.get().then(async function (completedorderSnapshots) {

            completed_orders = document.getElementById('completed_orders');

            pending_orders = document.getElementById('pending_orders');

            rejected_orders = document.getElementById('rejected_orders');


            completed_orders.innerHTML = '';

            pending_orders.innerHTML = '';

            rejected_orders.innerHTML = '';


            completedOrderHtml = buildHTMLCompletedOrders(completedorderSnapshots);

            pendingOrderHtml = buildHTMLPendingOrders(completedorderSnapshots);

            rejectedOrdersHtml = buildHTMLRejectedOrders(completedorderSnapshots);


            completed_orders.innerHTML = completedOrderHtml;

            pending_orders.innerHTML = pendingOrderHtml;

            rejected_orders.innerHTML = rejectedOrdersHtml;

        })

    }


    function buildHTMLCompletedOrders(completedorderSnapshots) {

        var html = '';

        var alldata = [];

        var number = [];

        completedorderSnapshots.docs.forEach((listval) => {

            var datas = listval.data();
            datas.id = listval.id;
            alldata.push(datas);

        });


        alldata.forEach((listval) => {


            var val = listval;


            if (val.status == "Order Completed") {
                //console.log(val.status);

                var order_id = val.id;

                var view_details = "{{ route('completed_order',':id')}}";

                view_details = view_details.replace(':id', 'id=' + order_id);

                var orderDetails = "{{ route('orderDetails',':id')}}";

                orderDetails = orderDetails.replace(':id', 'id=' + order_id);

                var view_contact = "{{ route('contact_us')}}";

                var view_checkout = "{{ route('checkout')}}";

                var view_vendor_details = "{{ route('vendor',':id')}}";

                view_vendor_details = view_vendor_details.replace(':id', 'id=' + val.vendorID);
                var orderRestaurantImage = '';

                html = html + '<div class="parcel_order-listing-row mb-4"><div class="parcel_order-listing"><div class="parcel_payment_left"><div class="card"><div class="row mb-0">';
                html = html + '<div class="col-md-7 order-top-left"><div class="parcel_payment-detail" style><div class="sender-det"><h3><strong>' + val.sender.name + '</strong></h3> <p>' + val.sender.phone + '</p><p>' + val.sender.address + '</p></div>';
                html = html + '<div class="receiver-det"><h3><strong>' + val.receiver.name + '</strong> </h3><p>' + val.receiver.phone + '</p><p>' + val.receiver.address + '</p></div></div></div>';
                html = html + '<div class="col-md-5 order-top-right"><div class="order-summery"><div class="payment-total d-flex"><label>Subtotal</label><span class="price ml-auto"><span class="currency-symbol-left">';
                var order_discount = 0;

                if (val.hasOwnProperty('discount') && val.discount) {
                    if (val.discount) {
                        order_discount = parseFloat(val.discount);
                    }
                }

                order_subtotal = parseFloat(val.subTotal);

                order_total = parseFloat((parseFloat(order_subtotal) - parseFloat(order_discount)));
                var tax = 0;
                if (val.hasOwnProperty('tax') && val.hasOwnProperty('taxType')) {
                    if (val.tax && val.taxType) {

                        if (val.taxType == "percent") {
                            tax = parseFloat(parseFloat(val.tax * order_total) / 100).toFixed(decimal_degits);
                        } else {
                            tax = parseFloat(val.tax);
                        }


                    }
                }
                tax = parseFloat(tax);

                order_total = order_total + parseFloat(tax);

                var order_total_val = '';
                var subtotal = '';
                var taxValue = '';
                var discount = '';
                if (currencyAtRight) {
                    //order_total_val = order_total_value.toLocaleString('hi-IN') + '' + currentCurrency;
                    order_total_val = order_total_value.toFixed(decimal_degits) + '' + currentCurrency;

                    subtotal = order_subtotal.toFixed(decimal_degits) + '' + currentCurrency;
                    taxValue = tax.toFixed(decimal_degits) + '' + currentCurrency
                    discount = order_discount.toFixed(decimal_degits) + '' + currentCurrency
                    parcelWeightCharge = parseFloat(val.parcelWeightCharge).toFixed(decimal_degits) + '' + currentCurrency;
                } else {
                    order_total_val = currentCurrency + '' + order_total.toFixed(decimal_degits);
                    subtotal = currentCurrency + '' + order_subtotal.toFixed(decimal_degits);
                    taxValue = currentCurrency + '' + tax.toFixed(decimal_degits);
                    discount = currentCurrency + '' + order_discount.toFixed(decimal_degits);
                    parcelWeightCharge = currentCurrency + '' + parseFloat(val.parcelWeightCharge).toFixed(decimal_degits);
                }

                html = html + '</span>' + subtotal + '<span class="currency-symbol-right"></span></span></div>';
                html = html + '<div class="payment-total d-flex"><label>{{trans("lang.discount")}} </label><span class="price ml-auto"><span class="currency-symbol-left"></span>' + discount + '<span class="currency-symbol-right" style="display: none;"></span></span></div>';
                html = html + '<div class="payment-total d-flex"><label>{{trans("lang.tax")}}</label><span class="price ml-auto"><span class="currency-symbol-left"></span>' + taxValue + '<span class="currency-symbol-right" style="display: none;"></span></span></div>';
                html = html + '<div class="payment-total d-flex total-price"><label><strong>{{trans("lang.total")}}</strong></label><span class="price ml-auto"><span class="currency-symbol-left"></span>' + order_total_val + '<span class="currency-symbol-right" style="display: none;"></span></span></div></div><br /><a href="javascript:0" style="float:right" class="btn btn-primary add-review mr-3" data-uname="' + val.author.firstName + '" data-rid="' + val.id + '" data-cid="' + val.authorID + '" data-did="' + val.driverID + '" data-img="' + val.author.profilePictureURL + '">Add Review</a></div></div>';
                //html=html+'<div class="col-md-9"><span></span></div><div class="col-md-3 order-top-right"></div>'
                html = html + '<div class="parcel_payment_total-row"><div class="parcel_payment_total col-md-12" style="padding-bottom:15px"><div class="row"><div class="col-md-4 parcel_payment-box"><span class="label" style="line-height:15px">Pickup Date</span><span class="total" style="line-height:15px">' + val.senderPickupDateTime.toDate().toDateString() + '  </span></div><div class="col-md-4 parcel_payment-box"><span class="label" style="line-height:15px">Drop Date</span><span class="total" style="line-height:15px">' + val.receiverPickupDateTime.toDate().toDateString() + '  </span></div></div></div></div>';
                html = html + '<div class="parcel_payment_total-row"><div class="parcel_payment_total col-md-12" style="padding-bottom:15px"><div class="row"><div class="col-md-2 parcel_payment-box"><span class="label" style="line-height:15px">Distance</span><span class="total" style="line-height:15px">' + val.distance + ' KM </span></div>';
                if (val.hasOwnProperty('parcelWeight')) {
                    parcelweight = val.parcelWeight;
                } else {
                    parcelweight = '';
                }
                html = html + '<div class="col-md-2 parcel_payment-box"><span class="label" style="line-height:15px">{{trans("lang.weight")}}</span><span class="total" style="line-height:15px">' + parcelweight + '</span></div>';

                html = html + '<div class="col-md-4 parcel_payment-box date"><span class="label" style="line-height:15px">{{trans("lang.date")}}</span><span class="total" style="line-height:15px">' + val.createdAt.toDate().toDateString() + '</span></div>';
                if (val.paymentCollectByReceiver == true) {
                    payment = 'Pending';
                } else {
                    payment = 'Done';
                }
                html = html + '<div class="col-md-2 parcel_payment-box pay-status"><span class="label" style="line-height:15px">{{trans("lang.payment")}}</span><span class="total">' + payment + '</span></div><div class="col-md-2 parcel_payment-box"><span class="label" style="line-height:15px">{{trans("lang.weight_charge")}}</span><span class="total price" style="line-height:15px"><span class="currency-symbol-left"></span>' + parcelWeightCharge + '<span class="currency-symbol-right"></span></span></div>';
                html = html + '</div></div></div></div></div></div></div>';

            }


        });


        return html;

    }


    function buildHTMLPendingOrders(completedorderSnapshots) {

        var html = '';

        var alldata = [];

        var number = [];

        completedorderSnapshots.docs.forEach((listval) => {

            var datas = listval.data();

            datas.id = listval.id;
            alldata.push(datas);
            //console.log(alldata);

        });


        alldata.forEach((listval) => {

            var val = listval;


            if (val.status == "Order Placed" || val.status == "Order Accepted" || val.status == "Driver Pending" || val.status == "Order Shipped" || val.status == "In Transit") {

                var order_id = val.id;


                html = html + '<div class="parcel_order-listing-row mb-4"><div class="parcel_order-listing"><div class="parcel_payment_left"><div class="card"><div class="row mb-4">';
                html = html + '<div class="col-md-7 order-top-left"><div class="parcel_payment-detail"><div class="sender-det"><h3><strong>' + val.sender.name + '</strong></h3> <p>' + val.sender.phone + '</p><p>' + val.sender.address + '</p></div>';
                html = html + '<div class="receiver-det"><h3><strong>' + val.receiver.name + '</strong> </h3><p>' + val.receiver.phone + '</p><p>' + val.receiver.address + '</p></div></div></div>';
                html = html + '<div class="col-md-5 order-top-right"><div class="order-summery"><div class="payment-total d-flex"><label>Subtotal</label><span class="price ml-auto"><span class="currency-symbol-left">';

                var order_discount = 0;

                if (val.hasOwnProperty('discount') && val.discount) {
                    if (val.discount) {
                        order_discount = parseFloat(val.discount);
                    }
                }


                order_subtotal = parseFloat(val.subTotal);

                order_total = parseFloat((parseFloat(order_subtotal) - parseFloat(order_discount)));
                var tax = 0;
                if (val.hasOwnProperty('tax') && val.hasOwnProperty('taxType')) {
                    if (val.tax && val.taxType) {

                        if (val.taxType == "percent") {
                            tax = parseFloat(parseFloat(val.tax * order_total) / 100).toFixed(decimal_degits);
                        } else {
                            tax = parseFloat(val.tax);
                        }


                    }
                }

                tax = parseFloat(tax);
                //console.log(tax);
                order_total = order_total + parseFloat(tax);

                var order_total_val = '';
                var subtotal = '';
                var taxValue = '';
                var discount = '';
                if (currencyAtRight) {
                    order_total_val = order_total.toFixed(2).toLocaleString('hi-IN') + '' + currentCurrency;
                    subtotal = order_subtotal.toFixed(2).toLocaleString('hi-IN') + '' + currentCurrency;
                    taxValue = tax.toFixed(2).toLocaleString('hi-IN') + '' + currentCurrency
                    discount = order_discount.toFixed(2).toLocaleString('hi-IN') + '' + currentCurrency
                } else {
                    order_total_val = currentCurrency + '' + order_total.toFixed(2).toLocaleString('hi-IN');
                    subtotal = currentCurrency + '' + order_subtotal.toFixed(2).toLocaleString('hi-IN');
                    taxValue = currentCurrency + '' + tax.toFixed(2).toLocaleString('hi-IN');
                    discount = currentCurrency + '' + order_discount.toFixed(2).toLocaleString('hi-IN');

                }

                html = html + '</span>' + subtotal + '<span class="currency-symbol-right"></span></span></div>';
                html = html + '<div class="payment-total d-flex"><label>Discount </label><span class="price ml-auto"><span class="currency-symbol-left"></span>' + discount + '<span class="currency-symbol-right" style="display: none;"></span></span></div>';
                html = html + '<div class="payment-total d-flex"><label>Tax</label><span class="price ml-auto"><span class="currency-symbol-left"></span>' + taxValue + '<span class="currency-symbol-right" style="display: none;"></span></span></div>';
                html = html + '<div class="payment-total d-flex total-price"><label><strong>Total</strong></label><span class="price ml-auto"><span class="currency-symbol-left"></span>' + order_total_val + '<span class="currency-symbol-right" style="display: none;"></span></span></div></div></div></div>';

                html = html + '<div class="parcel_payment_total-row"><div class="parcel_payment_total col-md-12"><div class="row"><div class="col-md-2 parcel_payment-box"><span class="label">Distance</span><span class="total">' + val.distance + ' KM </span></div>';
                if (val.hasOwnProperty('parcelWeight')) {
                    parcelweight = val.parcelWeight;
                } else {
                    parcelweight = '';
                }
                html = html + '<div class="col-md-2 parcel_payment-box"><span class="label">Weight</span><span class="total">' + parcelweight + '</span></div>';

                html = html + '<div class="col-md-4 parcel_payment-box date"><span class="label">Order Date</span><span class="total">' + val.createdAt.toDate().toDateString() + '</span></div>';
                if (val.paymentCollectByReceiver == true) {
                    payment = 'Pending';
                } else {
                    payment = 'Done';
                }

                html = html + '<div class="col-md-2 parcel_payment-box pay-status"><span class="label">Payment</span><span class="total">' + payment + '</span></div><div class="col-md-2 parcel_payment-box"><span class="label">Weight Charge</span><span class="total price"><span class="currency-symbol-left"></span>$' + parseFloat(val.parcelWeightCharge).toFixed(decimal_degits) + '<span class="currency-symbol-right"></span></span></div>';
                html = html + '</div></div></div></div></div></div></div>';

            }


        });


        return html;

    }


    function buildHTMLRejectedOrders(completedorderSnapshots) {

        var html = '';

        var alldata = [];

        var number = [];

        completedorderSnapshots.docs.forEach((listval) => {

            var datas = listval.data();
            datas.id = listval.id;
            alldata.push(datas);

        });


        alldata.forEach((listval) => {

            var val = listval;

            var order_id = val.id;


            if (val.status == "Driver Rejected" || val.status == "Order Rejected") {
                var order_id = val.id;


                html = html + '<div class="parcel_order-listing-row mb-4"><div class="parcel_order-listing"><div class="parcel_payment_left"><div class="card"><div class="row mb-4">';
                html = html + '<div class="col-md-7 order-top-left"><div class="parcel_payment-detail"><div class="sender-det"><h3><strong>' + val.sender.name + '</strong></h3> <p>' + val.sender.phone + '</p><p>' + val.sender.address + '</p></div>';
                html = html + '<div class="receiver-det"><h3><strong>' + val.receiver.name + '</strong> </h3><p>' + val.receiver.phone + '</p><p>' + val.receiver.address + '</p></div></div></div>';
                html = html + '<div class="col-md-5 order-top-right"><div class="order-summery"><div class="payment-total d-flex"><label>Subtotal</label><span class="price ml-auto"><span class="currency-symbol-left">';
                var order_discount = 0;

                if (val.hasOwnProperty('discount') && val.discount) {
                    if (val.discount) {
                        order_discount = parseFloat(val.discount);
                    }
                }

                order_subtotal = parseFloat(val.subTotal);

                order_total = parseFloat((parseFloat(order_subtotal) - parseFloat(order_discount)));
                var tax = 0;
                if (val.hasOwnProperty('tax') && val.hasOwnProperty('taxType')) {
                    if (val.tax && val.taxType) {

                        if (val.taxType == "percent") {
                            tax = parseFloat(parseFloat(val.tax * order_total) / 100).toFixed(decimal_degits);
                        } else {
                            tax = parseFloat(val.tax);
                        }


                    }
                }
                tax = parseFloat(tax);

                order_total = order_total + parseFloat(tax);

                var order_total_val = '';
                var subtotal = '';
                var taxValue = '';
                var discount = '';
                if (currencyAtRight) {
                    order_total_val = order_total.toFixed(2).toLocaleString('hi-IN') + '' + currentCurrency;
                    subtotal = order_subtotal.toFixed(2).toLocaleString('hi-IN') + '' + currentCurrency;
                    taxValue = tax.toFixed(2).toLocaleString('hi-IN') + '' + currentCurrency
                    discount = order_discount.toFixed(2).toLocaleString('hi-IN') + '' + currentCurrency
                } else {
                    order_total_val = currentCurrency + '' + order_total.toFixed(2).toLocaleString('hi-IN');
                    subtotal = currentCurrency + '' + order_subtotal.toFixed(2).toLocaleString('hi-IN');
                    taxValue = currentCurrency + '' + tax.toFixed(2).toLocaleString('hi-IN');
                    discount = currentCurrency + '' + order_discount.toFixed(2).toLocaleString('hi-IN');

                }

                html = html + '</span>' + subtotal + '<span class="currency-symbol-right"></span></span></div>';
                html = html + '<div class="payment-total d-flex"><label>Discount </label><span class="price ml-auto"><span class="currency-symbol-left"></span>' + discount + '<span class="currency-symbol-right" style="display: none;"></span></span></div>';
                html = html + '<div class="payment-total d-flex"><label>Tax</label><span class="price ml-auto"><span class="currency-symbol-left"></span>' + taxValue + '<span class="currency-symbol-right" style="display: none;"></span></span></div>';
                html = html + '<div class="payment-total d-flex total-price"><label><strong>Total</strong></label><span class="price ml-auto"><span class="currency-symbol-left"></span>' + order_total_val + '<span class="currency-symbol-right" style="display: none;"></span></span></div></div></div></div>';
                html = html + '<div class="parcel_payment_total-row"><div class="parcel_payment_total col-md-12"><div class="row"><div class="col-md-2 parcel_payment-box"><span class="label">Distance</span><span class="total">' + val.distance + ' KM </span></div>';
                if (val.hasOwnProperty('parcelWeight')) {
                    parcelweight = val.parcelWeight;


                } else {
                    parcelweight = '';
                }

                html = html + '<div class="col-md-2 parcel_payment-box"><span class="label">Weight</span><span class="total">' + parcelweight + '</span></div>';

                html = html + '<div class="col-md-4 parcel_payment-box date"><span class="label">Date</span><span class="total">' + val.createdAt.toDate().toDateString() + '</span></div>';
                if (val.paymentCollectByReceiver == true) {
                    payment = 'Pending';
                } else {
                    payment = 'Done';
                }
                if (currencyAtRight) {
                    weightCharge= val.parcelWeightCharge.toFixed(2).toLocaleString('hi-IN') + '' + currentCurrency;
                }else{
                    weightCharge= currentCurrency + '' +parseFloat(val.parcelWeightCharge).toFixed(2).toLocaleString('hi-IN') ;
                }
                html = html + '<div class="col-md-2 parcel_payment-box pay-status"><span class="label">Payment</span><span class="total">' + payment + '</span></div><div class="col-md-2 parcel_payment-box"><span class="label">Weight Charge</span><span class="total price"><span class="currency-symbol-left"></span>' + weightCharge + '<span class="currency-symbol-right"></span></span></div>';
                html = html + '</div></div></div></div></div></div></div>';

            }


        });


        return html;

    }

    //Add Review & Rating Code start
    $(document).on('click', '.add-review', function () {
        $("#review-modal").attr('data-rid', $(this).data('rid')).attr('data-cid', $(this).data('cid')).attr('data-did', $(this).data('did')).attr('data-img', $(this).data('img')).attr('data-uname', $(this).data('uname')).modal("show");
        $('.add_review_btn').attr('data-rid', $(this).data('rid')).attr('data-cid', $(this).data('cid')).attr('data-did', $(this).data('did')).attr('data-img', $(this).data('img')).attr('data-uname', $(this).data('uname'));
    });

    $(document).on('shown.bs.modal', '#review-modal', function () {
        var rid = $(this).attr('data-rid');
        var cid = $(this).attr('data-cid');
        var did = $(this).attr('data-did');
        var image = $(this).data('data-img');
        var uname = $(this).data('data-uname');
        if (rid && did) {
            database.collection('items_review').where('orderid', '==', rid).where('driverId', '==', did).get().then((docSnapshot) => {

                var itemReviewDoc = '';
                if (docSnapshot.size) {
                    $("#review-modal").find('.add_review_btn').text('Update Review');

                    itemReviewDoc = docSnapshot.docs[0].data();
                    $("#default_review").find('.rating').attr('data-rating', itemReviewDoc.rating);
                    $("#review-modal").find('#review_comment').val(itemReviewDoc.comment);

                } else {
                    $("#review-modal").find('.add_review_btn').text('Add Review');
                }

            });
        }
    });

    $(document).on('hide.bs.modal', '#review-modal', function () {
        $(this).removeAttr('data-rid').removeAttr('data-did').removeAttr('data-did');
        $(this).find("#attribute_review").empty();
        $(this).find('.rating').attr('data-rating', '');
        $(this).find('#review_comment').val('');
    });
    var star = document.querySelectorAll('input');
    for (var i = 0; i < star.length; i++) {
        star[i].addEventListener('click', function () {
            var rating = this.value;
            $('#rating-value').val(rating);
            $("#default_review").find('.rating').attr('data-rating', rating);
        })
    }

    $(".add_review_btn").click(function () {
        pageloadded = 0;
        //$(this).css({'opacity': 0.5,'cursor':'default'});
        var pclass = $(this).data('parent');
        var default_review = $('.' + pclass).find('#default_review');
        var attribute_review = $('.' + pclass).find('#attribute_review');
        //var rating = default_review.find('.rating').attr('data-rating');
        var rating = $('#rating-value').val();
        var rating = parseFloat(rating);

        var reviewAttributes = {};
        var reviewAttributes2 = {};
        // if(attribute_review.children().length > 0){
        //   attribute_review.find('.rating-block > li').each(function(li){
        //     var id = $(this).attr('data-id');
        //     var value = parseInt($(this).attr('data-rating'));
        //     reviewAttributes[id] = value;
        //     reviewAttributes2[id] = {'reviewsCount':1,'reviewsSum':value};
        //   });
        // }
        var userProfile = '';
        var rid = $(this).attr('data-rid');

        var cid = $(this).attr('data-cid');
        var did = $(this).attr('data-did');
        var image = $(this).attr('data-image');
        var uname = $(this).attr('data-uname');
        var comment = $(".review_comment").val();
        var CustomerId = user_uuid;
        var reviewId = database.collection("tmp").doc().id;
        if (typeof image !== 'undefined' && image !== false) {
            userProfile = image;
        }


        database.collection('items_review').where('orderid', '==', rid).where('driverId', '==', did).get().then((docSnapshot) => {

            if (docSnapshot.size) {

                //update existing review

                var itemReviewDoc = docSnapshot.docs[0].data();

                var timeStamp = firebase.firestore.FieldValue.serverTimestamp();
                database.collection('items_review').doc(itemReviewDoc.Id).update({
                    'comment': comment,
                    'rating': rating,
                    'reviewAttributes': reviewAttributes,
                    'uname': uname,
                    'createdAt': timeStamp
                });

                vendor_data = parcel_orders.where('id', "==", rid);
                vendor_data.get().then(async function (snapshots) {
                    if (snapshots.docs[0]) {
                        vendor = snapshots.docs[0].data();
                        var reviewsCount = 0;
                        var reviewsSum = 0;
                        if (vendor.reviewsCount != undefined && vendor.reviewsCount != '') {
                            reviewsCount = vendor.reviewsCount;
                            reviewsCount = reviewsCount - 1;
                        }
                        if (vendor.reviewsSum != undefined && vendor.reviewsSum != '') {
                            reviewsSum = vendor.reviewsSum;
                            reviewsSum = reviewsSum - itemReviewDoc.rating;
                        }

                        reviewsCount = reviewsCount + 1;
                        reviewsSum = reviewsSum + rating;
                       // console.log(vendor)

                        database.collection('parcel_orders').doc(rid).update({
                            'reviewsCount': reviewsCount,
                            'reviewsSum': reviewsSum
                        });
                    }
                });

                database.collection('users').where('id', '==', did).get().then(async function (usersnapshots) {
                    if (usersnapshots.docs.length > 0) {
                        userreviewsSum = 0;
                        userreviewCount = 0;
                        var val = usersnapshots.docs[0].data();
                        if (val.reviewsSum != undefined && val.reviewsSum != '') {
                            userreviewsSum = val.reviewsSum;
                            userreviewsSum = userreviewsSum - itemReviewDoc.rating;
                        }
                        if (val.reviewsCount != undefined && val.reviewsCount != '') {
                            userreviewCount = val.reviewsCount;
                            userreviewCount = userreviewCount - 1;
                        }
                        userreviewCount = userreviewCount + 1;
                        userreviewsSum = userreviewsSum + rating;
                        database.collection('users').doc(did).update({
                            'reviewsCount': userreviewCount,
                            'reviewsSum': userreviewsSum
                        });
                    }
                });


            } else {

                //create new review
                var timeStamp = firebase.firestore.FieldValue.serverTimestamp();
                database.collection('items_review').doc(reviewId).set({
                    'CustomerId': CustomerId,
                    'driverId': did,
                    'Id': reviewId,
                    'comment': comment,
                    'orderid': rid,
                    'rating': rating,
                    'profile': userProfile,
                    'reviewAttributes': reviewAttributes,
                    'uname': uname,
                    'createdAt': timeStamp
                }).then(function (result) {
                    vendor_data = parcel_orders.where('id', "==", rid);
                    vendor_data.get().then(async function (snapshots) {
                        if (snapshots.docs[0]) {
                            vendor = snapshots.docs[0].data();
                            var reviewsCount = 0;
                            var reviewsSum = 0;
                            if (vendor.reviewsCount != undefined && vendor.reviewsCount != '') {
                                reviewsCount = vendor.reviewsCount;
                                reviewsCount = reviewsCount - 1;
                            }
                            if (vendor.reviewsSum != undefined && vendor.reviewsSum != '') {
                                reviewsSum = vendor.reviewsSum;
                                reviewsSum = reviewsSum - itemReviewDoc.rating;
                            }

                            reviewsCount = reviewsCount + 1;
                            reviewsSum = reviewsSum + rating;
                           // console.log(vendor)

                            database.collection('parcel_orders').doc(rid).update({
                                'reviewsCount': reviewsCount,
                                'reviewsSum': reviewsSum
                            });
                        }
                    });

                    database.collection('users').where('id', '==', did).get().then(async function (usersnapshots) {
                        if (usersnapshots.docs.length > 0) {
                            userreviewsSum = 0;
                            userreviewCount = 0;
                            var val = usersnapshots.docs[0].data();
                            if (val.reviewsSum != undefined && val.reviewsSum != '') {
                                userreviewsSum = val.reviewsSum;
                                userreviewsSum = userreviewsSum - itemReviewDoc.rating;
                            }
                            if (val.reviewsCount != undefined && val.reviewsCount != '') {
                                userreviewCount = val.reviewsCount;
                                userreviewCount = userreviewCount - 1;
                            }
                            userreviewCount = userreviewCount + 1;
                            userreviewsSum = userreviewsSum + rating;
                            database.collection('users').doc(did).update({
                                'reviewsCount': userreviewCount,
                                'reviewsSum': userreviewsSum
                            });
                        }
                    });

                });
            }
        });

    })
    //Add Review & Rating code End

</script>
