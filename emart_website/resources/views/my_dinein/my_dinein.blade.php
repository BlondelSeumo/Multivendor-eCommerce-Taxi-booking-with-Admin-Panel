@include('layouts.app')


@include('layouts.header')


<div class="d-none">

    <div class="bg-primary border-bottom p-3 d-flex align-items-center">

        <a class="toggle togglew toggle-2" href="#"><span></span></a>

        <h4 class="font-weight-bold m-0 text-white">{{trans('lang.my_request')}}</h4>

    </div>

</div>

<section class="py-4 siddhi-main-body">
    <input type="hidden" name="deliveryChargeMain" id="deliveryChargeMain">
    <div class="container">

        <div class="row">

            <div class="col-md-12 top-nav mb-3">

                <ul class="nav nav-tabsa custom-tabsa border-0 bg-white rounded overflow-hidden shadow-sm p-2 c-t-order"
                    id="myTab" role="tablist">

                    <li class="nav-item" role="presentation">

                        <a class="nav-link border-0 text-dark py-3 active" id="completed-tab" data-toggle="tab"
                           href="#completed" role="tab" aria-controls="completed" aria-selected="true">

                            <i class="feather-check mr-2 text-success mb-0"></i> {{trans('lang.upcoming')}}</a>

                    </li>

                    <li class="nav-item border-top" role="presentation">

                        <a class="nav-link border-0 text-dark py-3" id="progress-tab" data-toggle="tab" href="#progress"
                           role="tab" aria-controls="progress" aria-selected="false">

                            <i class="feather-clock mr-2 text-warning mb-0"></i> {{trans('lang.history')}}</a>

                    </li>

                    <!-- <li class="nav-item border-top" role="presentation">

                    <a class="nav-link border-0 text-dark py-3" id="canceled-tab" data-toggle="tab" href="#canceled" role="tab" aria-controls="canceled" aria-selected="false">

                    <i class="feather-x-circle mr-2 text-danger mb-0"></i> Canceled</a>

                    </li> -->

                </ul>

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

</section>


@include('layouts.footer')


@include('layouts.nav')


<script type="text/javascript">


    var append_categories = '';

    var createdAtman = firebase.firestore.Timestamp.fromDate(new Date());
    var createdAt = {_nanoseconds: createdAtman.nanoseconds, _seconds: createdAtman.seconds};
    console.log(createdAtman);
    console.log("createdAtman");
    var completedorsersref = database.collection('booked_table').where("author.id", "==", user_uuid).where("date", ">", createdAtman).orderBy('date', 'desc');

    var history_request = database.collection('booked_table').where("author.id", "==", user_uuid).where("date", "<", createdAtman).orderBy('date', 'desc');

    var deliveryCharge = 0;
    var currentCurrency = '';
    var currencyAtRight = false;
    var refCurrency = database.collection('currencies').where('isActive', '==', true);
    refCurrency.get().then(async function (snapshots) {
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;
    });


    var deliveryChargeRef = database.collection('settings').doc('DeliveryCharge');

    deliveryChargeRef.get().then(async function (deliveryChargeSnapshots) {

        var deliveryChargeData = deliveryChargeSnapshots.data();
        deliveryCharge = deliveryChargeData.amount;
        $("#deliveryChargeMain").val(deliveryCharge);
    });
    var place_holder_image = '';
    var ref_placeholder_image = database.collection('settings').doc("placeHolderImage");
    ref_placeholder_image.get().then(async function (snapshots) {
        var placeHolderImage = snapshots.data();
        place_holder_image = placeHolderImage.image;
    });


    $(document).ready(function () {
        getOrders();
        getHistoryRequest();
    });


    async function getOrders() {


        completedorsersref.get().then(async function (completedorderSnapshots) {


            completed_orders = document.getElementById('completed_orders');

            completed_orders.innerHTML = '';

            pending_orders.innerHTML = '';

            rejected_orders.innerHTML = '';


            completedOrderHtml = buildHTMLCompletedOrders(completedorderSnapshots);


            completed_orders.innerHTML = completedOrderHtml;


        })

    }


    async function getHistoryRequest() {


        history_request.get().then(async function (completedorderSnapshots) {

            pending_orders = document.getElementById('pending_orders');

            pending_orders.innerHTML = '';


            pendingOrderHtml = buildHTMLPendingOrders(completedorderSnapshots);

            pending_orders.innerHTML = pendingOrderHtml;

        })

    }

    function buildHTMLCompletedOrders(completedorderSnapshots) {

        var html = '';

        var alldata = [];

        var number = [];

        completedorderSnapshots.docs.forEach((listval) => {

            var datas = listval.data();
            datas.id=listval.id;
            alldata.push(datas);

        });


        alldata.forEach((listval) => {


            var val = listval;


            var order_id = val.id;

            var view_contact = "{{ route('contact_us')}}";


            var view_vendor_details = "{{ route('dyiningvendor',':id')}}";

            view_vendor_details = view_vendor_details.replace(':id', 'id=' + val.vendorID);
            var orderRestaurantImage = '';

            if (val.vendor.hasOwnProperty('photo') && val.vendor.photo != '') {
                orderRestaurantImage = val.vendor.photo;
            } else {

                orderRestaurantImage = place_holder_image;
            }

            var detailHTML = '<div class="request-data">';

            detailHTML = detailHTML + '<div class="sub-details"><span><strong>Name</strong></span>';
            detailHTML = detailHTML + '<span>' + val.guestFirstName + ' ' + val.guestLastName + '</span></div>';

            detailHTML = detailHTML + '<div class="sub-details"><span><strong>Email</strong></span>';
            detailHTML = detailHTML + '<span>' + val.guestEmail + '</span></div>';

            detailHTML = detailHTML + '<div class="sub-details"><span><strong>Phone</strong></span>';
            detailHTML = detailHTML + '<span>' + val.guestPhone + '</span></div>';

            detailHTML = detailHTML + '<div class="sub-details"><span><strong>Occasion</strong></span>';
            detailHTML = detailHTML + '<span>' + val.occasion + '</span></div>';

            detailHTML = detailHTML + '<div class="sub-details"><span><strong>Total Guest</strong></span>';
            detailHTML = detailHTML + '<span>' + val.totalGuest + '</span></div>';

            detailHTML = detailHTML + '<div class="sub-details"><span><strong>First Visit</strong></span>';
            detailHTML = detailHTML + '<span>' + val.firstVisit + '</span></div>';

            detailHTML = detailHTML + '<div class="sub-details"><span><strong>Special Request</strong></span>';
            detailHTML = detailHTML + '<span>' + val.specialRequest + '</span></div>';

            detailHTML = detailHTML + '</div>';

            var statustext = "";
            var statustext_class = "";
            if (val.status == "Order Rejected") {
                statustext = "Request Rejected";
                statustext_class = "bg-rejected";
            } else if (val.status == "Order Placed") {
                statustext = "Requested";
                statustext_class = "bg-pending";
            } else if (val.status == "Order Accepted") {
                statustext = "Request Accepted";
                statustext_class = "bg-success";
            }

            html = html + '<div class="pb-3"><div class="p-3 rounded shadow-sm bg-white"><div class="d-flex border-bottom pb-3 m-d-flex"><div class="text-muted mr-3"><img alt="#" src="' + orderRestaurantImage + '" class="img-fluid order_img rounded"></div><div><p class="mb-0 font-weight-bold"><a href="' + view_vendor_details + '" class="text-dark">' + val.vendor.title + '</a></p><p class="mb-0"><span class="fa fa-map-marker"></span> ' + val.vendor.location + '</p><p>ORDER ' + val.id + '</p></div><div class="ml-auto ord-com-btn"><p class=" ' + statustext_class + ' text-white py-1 px-2 rounded small mb-1">' + statustext + '</p><p class="small font-weight-bold text-center"><i class="feather-clock"></i> ' + val.date.toDate().toDateString() + '<br/>' + val.date.toDate().toTimeString() + '</p></div></div>' + detailHTML + '<div class="d-flex pt-3 m-d-flex"><div class="small">';


            html = html + '</div><div class="text-right"><a href="' + view_contact + '" class="btn btn-outline-primary px-3">Help</a> </div></div></div></div></div></div>';


        });


        return html;

    }


    function buildHTMLPendingOrders(completedorderSnapshots) {

        var html = '';

        var alldata = [];

        var number = [];

        completedorderSnapshots.docs.forEach((listval) => {

            var datas = listval.data();
            datas.id=listval.id;
            alldata.push(datas);

        });


        alldata.forEach((listval) => {


            var val = listval;

            var order_id = val.id;


            var view_contact = "{{ route('contact_us')}}";

            var view_vendor_details = "{{ route('dyiningvendor',':id')}}";

            view_vendor_details = view_vendor_details.replace(':id', 'id=' + val.vendorID);


            var orderRestaurantImage = '';
            if (val.vendor.hasOwnProperty('photo') && val.vendor.photo != '') {
                orderRestaurantImage = val.vendor.photo;
            } else {
                orderRestaurantImage = place_holder_image;
            }

            var detailHTML = '<div class="request-data">';

            detailHTML = detailHTML + '<div class="sub-details"><span><strong>Name</strong></span>';
            detailHTML = detailHTML + '<span>' + val.guestFirstName + ' ' + val.guestLastName + '</span></div>';

            detailHTML = detailHTML + '<div class="sub-details"><span><strong>Email</strong></span>';
            detailHTML = detailHTML + '<span>' + val.guestEmail + '</span></div>';

            detailHTML = detailHTML + '<div class="sub-details"><span><strong>Phone</strong></span>';
            detailHTML = detailHTML + '<span>' + val.guestPhone + '</span></div>';

            detailHTML = detailHTML + '<div class="sub-details"><span><strong>Occasion</strong></span>';
            detailHTML = detailHTML + '<span>' + val.occasion + '</span></div>';

            detailHTML = detailHTML + '<div class="sub-details"><span><strong>Total Guest</strong></span>';
            detailHTML = detailHTML + '<span>' + val.totalGuest + '</span></div>';

            detailHTML = detailHTML + '<div class="sub-details"><span><strong>First Visit</strong></span>';
            detailHTML = detailHTML + '<span>' + val.firstVisit + '</span></div>';

            detailHTML = detailHTML + '<div class="sub-details"><span><strong>Special Request</strong></span>';
            detailHTML = detailHTML + '<span>' + val.specialRequest + '</span></div>';

            detailHTML = detailHTML + '</div>';

            var statustext = "";
            var statustext_class = "";
            if (val.status == "Order Rejected") {
                statustext = "Request Rejected";
                statustext_class = "bg-rejected";
            } else if (val.status == "Order Placed") {
                statustext = "Requested";
                statustext_class = "bg-pending";
            } else if (val.status == "Order Accepted") {
                statustext = "Request Accepted";
                statustext_class = "bg-success";
            }

            html = html + '<div class="pb-3"><div class="p-3 rounded shadow-sm bg-white"><div class="d-flex border-bottom pb-3 m-d-flex"><div class="text-muted mr-3"><img alt="#" src="' + orderRestaurantImage + '" class="img-fluid order_img rounded"></div><div><p class="mb-0 font-weight-bold"><a href="' + view_vendor_details + '" class="text-dark">' + val.vendor.title + '</a></p><p class="mb-0"><span class="fa fa-map-marker"></span> ' + val.vendor.location + '</p><p>ORDER ' + val.id + '</p></div><div class="ml-auto ord-com-btn"><p class=" ' + statustext_class + ' text-white py-1 px-2 rounded small mb-1">' + statustext + '</p><p class="small font-weight-bold text-center"><i class="feather-clock"></i> ' + val.date.toDate().toDateString() + '<br/>' + val.date.toDate().toTimeString() + '</p></div></div>' + detailHTML + '<div class="d-flex pt-3 m-d-flex"><div class="small">';


            html = html + '</div><div class="text-right"><a href="' + view_contact + '" class="btn btn-outline-primary px-3">Help</a></div></div></div></div></div></div>';


        });


        return html;

    }


    function buildHTMLRejectedOrders(completedorderSnapshots) {

        var html = '';

        var alldata = [];

        var number = [];

        completedorderSnapshots.docs.forEach((listval) => {

            var datas = listval.data();
            datas.id=listval.id;
            alldata.push(datas);

        });


        alldata.forEach((listval) => {

            var val = listval;

            var order_id = val.id;

            var view_contact = "{{ route('contact_us')}}";

            var view_vendor_details = "{{ route('dyiningvendor',':id')}}";

            view_vendor_details = view_vendor_details.replace(':id', 'id=' + val.vendorID);

            if (val.status == "Order Rejected") {
                var orderRestaurantImage = '';
                if (val.vendor.hasOwnProperty('photo') && val.vendor.photo != '') {
                    orderRestaurantImage = val.vendor.photo;
                } else {
                    orderRestaurantImage = place_holder_image;
                }


                var detailHTML = '<div class="request-data">';

                detailHTML = detailHTML + '<div class="sub-details"><span><strong>Name</strong></span>';
                detailHTML = detailHTML + '<span>' + val.guestFirstName + ' ' + val.guestLastName + '</span></div>';

                detailHTML = detailHTML + '<div class="sub-details"><span><strong>Email</strong></span>';
                detailHTML = detailHTML + '<span>' + val.guestEmail + '</span></div>';

                detailHTML = detailHTML + '<div class="sub-details"><span><strong>Phone</strong></span>';
                detailHTML = detailHTML + '<span>' + val.guestPhone + '</span></div>';

                detailHTML = detailHTML + '<div class="sub-details"><span><strong>Occasion</strong></span>';
                detailHTML = detailHTML + '<span>' + val.occasion + '</span></div>';

                detailHTML = detailHTML + '<div class="sub-details"><span><strong>Total Guest</strong></span>';
                detailHTML = detailHTML + '<span>' + val.totalGuest + '</span></div>';

                detailHTML = detailHTML + '<div class="sub-details"><span><strong>First Visit</strong></span>';
                detailHTML = detailHTML + '<span>' + val.firstVisit + '</span></div>';

                detailHTML = detailHTML + '<div class="sub-details"><span><strong>Special Request</strong></span>';
                detailHTML = detailHTML + '<span>' + val.specialRequest + '</span></div>';

                detailHTML = detailHTML + '</div>';


                html = html + '<div class="pb-3"><div class="p-3 rounded shadow-sm bg-white"><div class="d-flex border-bottom pb-3 m-d-flex"><div class="text-muted mr-3"><img alt="#" src="' + orderRestaurantImage + '" class="img-fluid order_img rounded"></div><div><p class="mb-0 font-weight-bold"><a href="' + view_vendor_details + '" class="text-dark">' + val.vendor.title + '</a></p><p class="mb-0"><span class="fa fa-map-marker"></span> ' + val.vendor.location + '</p><p>ORDER ' + val.id + '</p></div><div class="ml-auto ord-com-btn"><p class="bg-rejected text-white py-1 px-2 rounded small mb-1">Rejected</p><p class="small font-weight-bold text-center"><i class="feather-clock"></i> ' + val.date.toDate().toDateString() + '<br/>' + val.date.toDate().toTimeString() + '</p></div></div>' + detailHTML + '<div class="d-flex pt-3 m-d-flex"><div class="small">';


                html = html + '</div><div class="text-right"><a href="' + view_contact + '" class="btn btn-outline-primary px-3">Help</a></div></div></div></div></div></div>';

            }

        });


        return html;

    }

</script>