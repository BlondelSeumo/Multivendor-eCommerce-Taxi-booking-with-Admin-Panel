@include('layouts.app')


@include('layouts.header')

<div class="d-none">
    <div class="bg-primary p-3 d-flex align-items-center">
        <a class="toggle togglew toggle-2" href="#"><span></span></a>
        <h4 class="font-weight-bold m-0 text-white">{{trans('lang.my_orders')}}</h4>
    </div>
</div>
<section class="py-4 siddhi-main-body">
    <div class="container">
        <div class="row">
            <div class="col-md-12 top-nav mb-3">
                <ul class="nav nav-tabsa custom-tabsa border-0 bg-white rounded overflow-hidden shadow-sm p-2 c-t-order"
                    id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link border-0 text-dark py-3 active" href="{{url('my_order')}}"> <i
                                    class="feather-check mr-2 text-success mb-0"></i>
                            {{trans('lang.completed')}}</a>
                    </li>
                    <li class="nav-item border-top" role="presentation">
                        <a class="nav-link border-0 text-dark py-3" href="{{url('my_order')}}"> <i
                                    class="feather-clock mr-2 text-warning mb-0"></i>
                            {{trans('lang.on_progress')}}</a>
                    </li>
                    <li class="nav-item border-top" role="presentation">
                        <a class="nav-link border-0 text-dark py-3" href="{{url('my_order')}}"> <i
                                    class="feather-x-circle mr-2 text-danger mb-0"></i>
                            {{trans('lang.canceled')}}</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-12">
                <section class="bg-white siddhi-main-body rounded shadow-sm overflow-hidden">
                    <div class="container p-0">
                        <div class="p-3 border-bottom gendetail-row">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card p-3">
                                        <h3>{{trans('lang.general_details')}}</h3>
                                        <div class="form-group widt-100 gendetail-col">
                                            <label class="control-label"><strong>{{trans('lang.date_created')}}
                                                    : </strong><span id="order-date"></span></label>
                                        </div>
                                        <div class="form-group widt-100 gendetail-col">
                                            <label class="control-label"><strong>{{trans('lang.order_number')}}
                                                    : </strong><span id="order-number"></span></label>
                                        </div>
                                        <div class="form-group widt-100 gendetail-col">
                                            <label class="control-label"><strong>{{trans('lang.status')}}
                                                    : </strong><span id="order-status"></span></label>
                                        </div>
                                        <div class="form-group widt-100 gendetail-col">
                                            <label class="control-label"><strong>{{trans('lang.order_type')}}: </strong><span
                                                        id="order-type"></span></label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="card p-3">
                                        <h3>{{trans('lang.billing_details')}}</h3>
                                        <div class="form-group widt-100 gendetail-col">
                                            <!-- </strong><span id="order-addreess"></span></label> -->
                                            <div class="bill-address">
                                                <span id="billing_name"></span><br>
                                                <span id="billing_line1"></span><br>
                                                <span id="billing_line2"></span><br>
                                                <span id="billing_country"></span>
                                            </div>
                                        </div>
                                        <div class="clear-both ml-auto addreview-btn">
                                            <!-- <a href="#" class="text-primary ml-auto text-decoration-none">Review</a> -->
                                            <!-- 	<a href="javascript:void(0);" class="btn btn-outline-secondary btn-sm text-primary ml-auto text-decoration-none" data-toggle="modal" data-target="#review_order" style="pointer-events: none">Review</a>  -->

                                        <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reviewModel" id="review_btn">
												{{trans('lang.add_review')}}
                                                </button>-->
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="p-3 border-bottom order-secdetail">
                            <div class="row">
                                <div class="col-6">
                                <!-- <div class="vendor-details-box">
																<h6 class="font-weight-bold">{{trans('lang.vendor')}}</h6>
															<div id="vendor-details"></div>
									</div> -->
                                    <div class=" order-deta-btm-right">
                                        <div class="resturant-detail">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-header-title">{{trans('lang.vendor')}}</h4>
                                                </div>
                                                <div class="card-body">
                                                    <a href="#" class="row redirecttopage" id="resturant-view">
                                                        <div class="col-4">
                                                            <img src="" class="resturant-img rounded-circle"
                                                                 alt="vendor" width="70px" height="70px">
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
                                <div class="col-6">
                                    <!-- <div class="vendor-details-box order_driver_details" id="order_driver_details" >
                                            <h6 class="font-weight-bold">Driver</h6>
                                                    <div id="driver_details"></div>
                                    </div> -->
                                    <div class=" order-deta-btm-right">
                                        <div class="resturant-detail">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-header-title">{{trans('lang.driver')}}</h4>
                                                </div>
                                                <div class="card-body">
                                                    <a href="#" class="row redirecttopage" id="resturant-view">
                                                        <div class="col-4">
                                                            <img src="" class="driver-img rounded-circle" alt="driver"
                                                                 width="70px" height="70px">
                                                        </div>
                                                        <div class="col-8">
                                                            <h4 class="driver-name-title"></h4>
                                                        </div>
                                                    </a>
                                                    <h5 class="contact-info">{{trans('lang.contact_info')}}:</h5>
                                                    <p><strong>{{trans('lang.phone')}}:</strong>
                                                        <span id="driver_phone"></span>
                                                    </p>
                                                    <p><strong>{{trans('lang.car_number')}}:</strong>
                                                        <span id="driver_car_number"></span>
                                                    </p>
                                                    <!--  <p><strong>Car Name:</strong>
                                                        <span id="driver_car_name"></span>
                                                    </p> -->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row" id="order-note-box" style="display: none;">
                            <div class="col-lg-12">

                                <div class="p-3 border-bottom">

                                    <h6 class="font-weight-bold">{{trans('lang.order_notes')}}</h6>

                                    <div id="order-note" class="order-note"></div>

                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">


                                <div class="p-3 border-bottom">

                                    <h6 class="font-weight-bold">{{trans('lang.order_items')}}</h6>

                                    <div id="order-items"></div>

                                </div>
                                <div class="p-3 border-bottom">

                                    <div class="d-flex align-items-center mb-2">

                                        <h6 class="font-weight-bold mb-1">{{trans('lang.order_subtotal')}}</h6>

                                        <h6 class="font-weight-bold ml-auto mb-1" id="order-subtotal"></h6>

                                    </div>

                                </div>

                                <div class="p-3 border-bottom">

                                    <div class="d-flex align-items-center mb-2">

                                        <h6 class="font-weight-bold mb-1">{{trans('lang.order_discount')}}t</h6>

                                        <h6 class="font-weight-bold ml-auto mb-1" id="order-discount"></h6>

                                    </div>

                                </div>
                                <div class="p-3 border-bottom">

                                    <div class="d-flex align-items-center mb-2">

                                        <h6 class="font-weight-bold mb-1">{{trans('lang.special')}} {{trans('lang.offer')}} {{trans('lang.discount')}}</h6>

                                        <h6 class="font-weight-bold ml-auto mb-1" id="special_discount"></h6>

                                    </div>

                                </div>

                                <div class="p-3 border-bottom order_tax_div" style="display:none;">
                                    <div class="d-flex align-items-center mb-2">
                                        <h6 class="font-weight-bold mb-1">{{trans('lang.order_tax')}}</h6>
                                        <h6 class="font-weight-bold ml-auto mb-1" id="order-tax"></h6>
                                    </div>
                                </div>

                                <div class="p-3 border-bottom order_shopping_div">

                                    <div class="d-flex align-items-center mb-2">

                                        <h6 class="font-weight-bold mb-1">{{trans('lang.order_shipping')}}</h6>

                                        <h6 class="font-weight-bold ml-auto mb-1" id="order-shipping"></h6>

                                    </div>

                                </div>


                                <div class="p-3 border-bottom used_coupon_code_div" style="display:none">

                                    <div class="d-flex align-items-center mb-2">

                                        <h6 class="font-weight-bold mb-1">{{trans('lang.used_coupon')}}</h6>

                                        <h6 class="font-weight-bold ml-auto mb-1" id="used_coupon_code"></h6>

                                    </div>

                                </div>

                                <div class="p-3 border-bottom order_tip_div">
                                    <div class="d-flex align-items-center mb-2">
                                        <h6 class="font-weight-bold mb-1">{{trans('lang.tip_amount')}}</h6>
                                        <h6 class="font-weight-bold ml-auto mb-1" id="order-tip-amount"></h6>
                                    </div>
                                </div>

                                <div class="p-3 bg-white">
                                    <div class="d-flex align-items-center mb-2">
                                        <h6 class="font-weight-bold mb-1">{{trans('lang.order_total')}}</h6>
                                        <h6 class="font-weight-bold ml-auto mb-1" id="order-total"></h6>
                                    </div>
                                    <p class="m-0 small text-muted">
                                        <br>
                                        {{trans('lang.thank_you_for_order')}}.
                                    </p>
                                </div>

                                <div class="p-3 border-bottom">
                                    <p class="font-weight-bold small mb-1">
                                        {{trans('lang.courier')}}
                                    </p>
                                    <img alt="#" src="img/logo_web.png" class="img-fluid sc-siddhi-logo mr-2"><span
                                            class="small text-primary font-weight-bold">{{trans('lang.grocery_courier')}} </span>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="reviewModel" tabindex="-1" role="dialog"
                             aria-labelledby="reviewModelLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"
                                            id="exampleModalLabel">{{trans('lang.review_order')}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group row" id="default_review">
                                            <label class="col-sm-2 col-form-label">{{trans('lang.rate')}}</label>
                                            <div class="col-sm-10">
                                                <div class="rating-wrap d-flex align-items-center mt-4 mb-3" id="#">

                                                    <fieldset class="rating rate_this">
                                                        <input type="radio" class="main_rating" name="rating" id="star5"
                                                               value="5"/><label
                                                                for="star5"
                                                                class="full"></label>
                                                        <input type="radio" class="main_rating" name="rating"
                                                               id="star4.5"
                                                               value="4.5"/><label
                                                                for="star4.5" class="half"></label>
                                                        <input type="radio" class="main_rating" name="rating" id="star4"
                                                               value="4"/><label
                                                                for="star4"
                                                                class="full"></label>
                                                        <input type="radio" class="main_rating" name="rating"
                                                               id="star3.5"
                                                               value="3.5"/><label
                                                                for="star3.5" class="half"></label>
                                                        <input type="radio" class="main_rating" name="rating" id="star3"
                                                               value="3"/><label
                                                                for="star3"
                                                                class="full"></label>
                                                        <input type="radio" class="main_rating" name="rating"
                                                               id="star2.5"
                                                               value="2.5"/><label
                                                                for="star2.5" class="half"></label>
                                                        <input type="radio" class="main_rating" name="rating" id="star2"
                                                               value="2"/><label
                                                                for="star2"
                                                                class="full"></label>
                                                        <input type="radio" class="main_rating" name="rating"
                                                               id="star1.5"
                                                               value="1.5"/><label
                                                                for="star1.5" class="half"></label>
                                                        <input type="radio" class="main_rating" name="rating" id="star1"
                                                               value="1"/><label
                                                                for="star1"
                                                                class="full"></label>
                                                        <input type="radio" class="main_rating" name="rating"
                                                               id="star0.5"
                                                               value="0.5"/><label
                                                                for="star0.5" class="half"></label>
                                                        <input type="hidden" value="0" id="rating-value"/>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="attribute_review"></div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">{{trans('lang.comment')}}</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control review_comment"
                                                       id="review_comment" name="review_comment"
                                                       placeholder="Review Comment" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">{{trans('lang.image')}}</label>
                                            <div class="col-sm-10">
                                                <input type="file" onChange="handleFileSelect(event)">
                                                <div id="uploding_image"></div>
                                                <div id="uploded_image">
                                                    <ul></ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('lang.close')}}</button> -->
                                    <button type="button" class="btn btn-primary add_review_btn"
                                            data-parent="modal-body">{{trans('lang.add_review')}}</button>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>

                    </div>
            </div>
</section>
</div>
</div>
</div>
</section>


@include('layouts.footer')


@include('layouts.nav')


<script type="text/javascript">


    var orderId = "<?php echo $_GET['id']; ?>";
    var append_categories = '';
    var completedorsersref = database.collection('vendor_orders').where('id', "==", orderId);
    var vendor = database.collection('vendors');
    var vendor_products = database.collection('vendor_products');
    var reviewOrderImage = [];
    var orderVendorId = '';
    var reviewUserName = '';
    var reviewUserProfile = '';
    $(document).ready(function () {
        getOrderDetails();

        $(document).on('shown.bs.modal', '#reviewModel', function () {
            var pid = $(this).attr('data-pid');
            var cid = $(this).attr('data-cid');
            if (pid && cid) {

                database.collection('vendor_categories').doc(cid).get().then(async function (snapshots) {
                    var catData = snapshots.data();

                    database.collection('items_review').where('orderid', '==', orderId).where('productId', '==', pid).get().then((docSnapshot) => {

                        var itemReviewDoc = '';
                        if (docSnapshot.size) {
                            $("#reviewModel").find('.add_review_btn').text('Update Review');

                            itemReviewDoc = docSnapshot.docs[0].data();
                            $("#default_review").find('.rating').attr('data-rating', itemReviewDoc.rating);
                            $("#reviewModel").find('#review_comment').val(itemReviewDoc.comment);

                            if (itemReviewDoc.photos.length > 0) {
                                $.each(itemReviewDoc.photos, function (key, url) {
                                    $("#uploded_image ul").append('<li><img src="' + url + '" width="100"><span class="mdi mdi-delete" onerror="this.onerror=null; this.remove();" data-url="' + url + '">X</span></li>');
                                    reviewOrderImage.push(url);
                                });
                            }
                        } else {
                            $("#reviewModel").find('.add_review_btn').text('Add Review');
                        }


                        if (catData.review_attributes) {
                            database.collection('review_attributes').where('id', "in", catData.review_attributes).get().then(async function (docsSnap) {
                                var html = '';
                                var count = 0;

                                html += '<div class="review-ratings">';
                                html += '<ul class="rating-block">';
                                docsSnap.forEach((doc) => {
                                    var at_id = doc.data().id;
                                    var at_title = doc.data().title;

                                    if (itemReviewDoc) {
                                        var at_value = itemReviewDoc.reviewAttributes[at_id];
                                    } else {
                                        var at_value = 0;
                                    }

                                    html += '<li data-id="' + at_id + '" data-rating="' + at_value + '" class="li_attr_rating" id="li_attr_rating_' + count + '">';
                                    html += '<label>' + at_title + '</label>';
                                    html += '<div class="rating-wrap d-flex align-items-center mt-4 mb-3" id="#">';
                                    html += '<fieldset class="attribute" id="attribute_' + count + '" data-rating="' + at_value + '">';

                                    var css_0_5 = css_1 = css_1_5 = css_2 = css_2_5 = css_3 = css_3_5 = css_4 = css_4_5 = css_5 = '';
                                    if (at_value == "0.5") {
                                        css_0_5 = 'color: #eca700;';
                                    } else if (at_value == "1") {
                                        css_0_5 = 'color: #eca700;';
                                        css_1 = 'color: #eca700;';
                                    } else if (at_value == "1.5") {
                                        css_0_5 = 'color: #eca700;';
                                        css_1 = 'color: #eca700;';
                                        css_1_5 = 'color: #eca700;';
                                    } else if (at_value == "2") {
                                        css_0_5 = 'color: #eca700;';
                                        css_1 = 'color: #eca700;';
                                        css_1_5 = 'color: #eca700;';
                                        css_2 = 'color: #eca700;';
                                    } else if (at_value == "2.5") {
                                        css_0_5 = 'color: #eca700;';
                                        css_1 = 'color: #eca700;';
                                        css_1_5 = 'color: #eca700;';
                                        css_2 = 'color: #eca700;';
                                        css_2_5 = 'color: #eca700;';
                                    } else if (at_value == "3") {
                                        css_0_5 = 'color: #eca700;';
                                        css_1 = 'color: #eca700;';
                                        css_1_5 = 'color: #eca700;';
                                        css_2 = 'color: #eca700;';
                                        css_2_5 = 'color: #eca700;';
                                        css_3 = 'color: #eca700;';
                                    } else if (at_value == "3.5") {
                                        css_0_5 = 'color: #eca700;';
                                        css_1 = 'color: #eca700;';
                                        css_1_5 = 'color: #eca700;';
                                        css_2 = 'color: #eca700;';
                                        css_2_5 = 'color: #eca700;';
                                        css_3 = 'color: #eca700;';
                                        css_3_5 = 'color: #eca700;';
                                    } else if (at_value == "4") {
                                        css_0_5 = 'color: #eca700;';
                                        css_1 = 'color: #eca700;';
                                        css_1_5 = 'color: #eca700;';
                                        css_2 = 'color: #eca700;';
                                        css_2_5 = 'color: #eca700;';
                                        css_3 = 'color: #eca700;';
                                        css_3_5 = 'color: #eca700;';
                                        css_4 = 'color: #eca700;';
                                    } else if (at_value == "4.5") {
                                        css_0_5 = 'color: #eca700;';
                                        css_1 = 'color: #eca700;';
                                        css_1_5 = 'color: #eca700;';
                                        css_2 = 'color: #eca700;';
                                        css_2_5 = 'color: #eca700;';
                                        css_3 = 'color: #eca700;';
                                        css_3_5 = 'color: #eca700;';
                                        css_4 = 'color: #eca700;';
                                        css_4_5 = 'color: #eca700;';
                                    } else if (at_value == "5") {
                                        css_0_5 = 'color: #eca700;';
                                        css_1 = 'color: #eca700;';
                                        css_1_5 = 'color: #eca700;';
                                        css_2 = 'color: #eca700;';
                                        css_2_5 = 'color: #eca700;';
                                        css_3 = 'color: #eca700;';
                                        css_3_5 = 'color: #eca700;';
                                        css_4 = 'color: #eca700;';
                                        css_4_5 = 'color: #eca700;';
                                        css_5 = 'color: #eca700;';
                                    }


                                    html += '<input type="radio" class="rating_attribute" id="star5_' + count + '" value="5"/><label\n' +
                                        '                                    for="star5_' + count + '"\n' +
                                        '                                        class="full hover_class" style="' + css_5 + '" ></label>\n' +
                                        '                                        <input type="radio" class="rating_attribute" id="star4.5_' + count + '"\n' +
                                        '                                    value="4.5"/><label\n' +
                                        '                                    for="star4.5_' + count + '" class="half hover_class" style="' + css_4_5 + '"></label>\n' +
                                        '                                        <input type="radio" class="rating_attribute" id="star4_' + count + '" value="4"/><label\n' +
                                        '                                    for="star4_' + count + '"\n' +
                                        '                                        class="full hover_class" style="' + css_4 + '"></label>\n' +
                                        '                                        <input type="radio" class="rating_attribute" id="star3.5_' + count + '"\n' +
                                        '                                    value="3.5"/><label\n' +
                                        '                                    for="star3.5_' + count + '" class="half hover_class" style="' + css_3_5 + '"></label>\n' +
                                        '                                        <input type="radio" class="rating_attribute" id="star3_' + count + '" value="3"/><label\n' +
                                        '                                    for="star3_' + count + '"\n' +
                                        '                                        class="full hover_class" style="' + css_3 + '"></label>\n' +
                                        '                                        <input type="radio" class="rating_attribute" id="star2.5_' + count + '"\n' +
                                        '                                    value="2.5"/><label\n' +
                                        '                                    for="star2.5_' + count + '" class="half hover_class" style="' + css_2_5 + '"></label>\n' +
                                        '                                        <input type="radio" class="rating_attribute" id="star2_' + count + '" value="2"/><label\n' +
                                        '                                    for="star2_' + count + '"\n' +
                                        '                                        class="full hover_class" style="' + css_2 + '"></label>\n' +
                                        '                                        <input type="radio" class="rating_attribute" id="star1.5_' + count + '"\n' +
                                        '                                    value="1.5"/><label\n' +
                                        '                                    for="star1.5_' + count + '" class="half hover_class" style="' + css_1_5 + '"></label>\n' +
                                        '                                        <input type="radio" class="rating_attribute" id="star1_' + count + '" value="1"/><label\n' +
                                        '                                    for="star1_' + count + '"\n' +
                                        '                                        class="full hover_class" style="' + css_1 + '"></label>\n' +
                                        '                                        <input type="radio" class="rating_attribute" id="star0.5_' + count + '"\n' +
                                        '                                    value="0.5"><label\n' +
                                        '                                    for="star0.5_' + count + '" class="half hover_class" style="' + css_0_5 + '"></label>\n' +
                                        '                                        <input type="hidden" value="' + at_value + '" id="rating-attribute-value"/>';
                                    html += '</fieldset>';
                                    html += '</div>';
                                    html += '</li>';


                                    count++;
                                });

                                html += '</ul>';
                                html += '</div>';
                                $("#attribute_review").html(html);

                            });


                        }
                    });
                });

            }

        });

        $(document).on('click', '.item_review_btn', function () {
            $("#reviewModel").attr('data-pid', $(this).data('pid')).attr('data-cid', $(this).data('cid')).modal("show");
        });

        $(document).on('hide.bs.modal', '#reviewModel', function () {
            $(this).removeAttr('data-pid').removeAttr('data-cid');
            $(this).find("#attribute_review").empty();
            $(this).find('#review_comment').val('');
            $(this).find('#uploded_image ul').empty();
        });

        jQuery(document).on("click", ".mdi-delete", function () {
            var url = jQuery(this).data('url');
            if (url) {
                firebase.storage().refFromURL(url).delete();
                jQuery(this).parent().remove();
                reviewOrderImage = $.grep(reviewOrderImage, function (value) {
                    return value != url;
                });
            }
        });
    });

    var star = document.querySelectorAll('input[name="rating"]');

    for (var i = 0; i < star.length; i++) {
        star[i].addEventListener('click', function () {

            var rating = this.value;
            $('#rating-value').val(rating);
            $("#default_review").find('.rating').attr('data-rating', rating);


        })
    }

    $(document).on('click', '.rating_attribute', function () {

        var rating = this.value;

        var id = '#' + $(this).closest('fieldset').prop('id');
        $(id).attr('data-rating', rating);

        $(id).find('#rating-attribute-value').val(rating);

        $(id).find('input ~ label.half[for="star0.5_' + spli_id + '"]').attr('style', 'color: #ccc');
        $(id).find('input ~ label.full[for="star1_' + spli_id + '"]').attr('style', 'color: #ccc');
        $(id).find('input ~ label.half[for="star1.5_' + spli_id + '"]').attr('style', 'color: #ccc');
        $(id).find('input ~ label.full[for="star2_' + spli_id + '"]').attr('style', 'color: #ccc');
        $(id).find('input ~ label.half[for="star2.5_' + spli_id + '"]').attr('style', 'color: #ccc');
        $(id).find('input ~ label.full[for="star3_' + spli_id + '"]').attr('style', 'color: #ccc');
        $(id).find('input ~ label.half[for="star3.5_' + spli_id + '"]').attr('style', 'color: #ccc');
        $(id).find('input ~ label.full[for="star4_' + spli_id + '"]').attr('style', 'color: #ccc');
        $(id).find('input ~ label.half[for="star4.5_' + spli_id + '"]').attr('style', 'color: #ccc');
        $(id).find('input ~ label.full[for="star5_' + spli_id + '"]').attr('style', 'color: #ccc');

        var spli_id = id.split('_')[1];
        $('#li_attr_rating_' + spli_id).attr('data-rating', rating);

        var css_0_5 = css_1 = css_1_5 = css_2 = css_2_5 = css_3 = css_3_5 = css_4 = css_4_5 = css_5 = '';

        if (rating == "0.5") {
            css_0_5 = 'color: #eca700';

        } else if (rating == "1") {
            css_0_5 = 'color: #eca700';
            css_1 = 'color: #eca700';

        } else if (rating == "1.5") {
            css_0_5 = 'color: #eca700';
            css_1 = 'color: #eca700';
            css_1_5 = 'color: #eca700';

        } else if (rating == "2") {
            css_0_5 = 'color: #eca700';
            css_1 = 'color: #eca700';
            css_1_5 = 'color: #eca700';
            css_2 = 'color: #eca700';
        } else if (rating == "2.5") {
            css_0_5 = 'color: #eca700';
            css_1 = 'color: #eca700';
            css_1_5 = 'color: #eca700';
            css_2 = 'color: #eca700';
            css_2_5 = 'color: #eca700';
        } else if (rating == "3") {
            css_0_5 = 'color: #eca700';
            css_1 = 'color: #eca700';
            css_1_5 = 'color: #eca700';
            css_2 = 'color: #eca700';
            css_2_5 = 'color: #eca700';
            css_3 = 'color: #eca700';
        } else if (rating == "3.5") {
            css_0_5 = 'color: #eca700';
            css_1 = 'color: #eca700';
            css_1_5 = 'color: #eca700';
            css_2 = 'color: #eca700';
            css_2_5 = 'color: #eca700';
            css_3 = 'color: #eca700';
            css_3_5 = 'color: #eca700';
        } else if (rating == "4") {
            css_0_5 = 'color: #eca700';
            css_1 = 'color: #eca700';
            css_1_5 = 'color: #eca700';
            css_2 = 'color: #eca700';
            css_2_5 = 'color: #eca700';
            css_3 = 'color: #eca700';
            css_3_5 = 'color: #eca700';
            css_4 = 'color: #eca700';
        } else if (rating == "4.5") {
            css_0_5 = 'color: #eca700';
            css_1 = 'color: #eca700';
            css_1_5 = 'color: #eca700';
            css_2 = 'color: #eca700';
            css_2_5 = 'color: #eca700';
            css_3 = 'color: #eca700';
            css_3_5 = 'color: #eca700';
            css_4 = 'color: #eca700';
            css_4_5 = 'color: #eca700';
        } else if (rating == "5") {
            css_0_5 = 'color: #eca700';
            css_1 = 'color: #eca700';
            css_1_5 = 'color: #eca700';
            css_2 = 'color: #eca700';
            css_2_5 = 'color: #eca700';
            css_3 = 'color: #eca700';
            css_3_5 = 'color: #eca700';
            css_4 = 'color: #eca700';
            css_4_5 = 'color: #eca700';
            css_5 = 'color: #eca700';
        }


        $(id).find('input ~ label.half[for="star0.5_' + spli_id + '"]').attr('style', css_0_5);
        $(id).find('input ~ label.full[for="star1_' + spli_id + '"]').attr('style', css_1);
        $(id).find('input ~ label.half[for="star1.5_' + spli_id + '"]').attr('style', css_1_5);
        $(id).find('input ~ label.full[for="star2_' + spli_id + '"]').attr('style', css_2);
        $(id).find('input ~ label.half[for="star2.5_' + spli_id + '"]').attr('style', css_2_5);
        $(id).find('input ~ label.full[for="star3_' + spli_id + '"]').attr('style', css_3);
        $(id).find('input ~ label.half[for="star3.5_' + spli_id + '"]').attr('style', css_3_5);
        $(id).find('input ~ label.full[for="star4_' + spli_id + '"]').attr('style', css_4);
        $(id).find('input ~ label.half[for="star4.5_' + spli_id + '"]').attr('style', css_4_5);
        $(id).find('input ~ label.full[for="star5_' + spli_id + '"]').attr('style', css_5);

    });

    $(".add_review_btn").click(function () {

        $(this).css({'opacity': 0.5, 'cursor': 'default'});
        var pclass = $(this).data('parent');
        var default_review = $('.' + pclass).find('#default_review');
        var attribute_review = $('.' + pclass).find('#attribute_review');
        var rating = default_review.find('.rating').attr('data-rating');
        rating = parseFloat(rating);

        var reviewAttributes = {};
        var reviewAttributes2 = {};
        if (attribute_review.children().length > 0) {
            attribute_review.find('.rating-block > li').each(function (li) {
                var id = $(this).attr('data-id');
                var value = $(this).attr('data-rating');
                reviewAttributes[id] = parseFloat(value);
                reviewAttributes2[id] = {'reviewsCount': 1, 'reviewsSum': value};
            });
        }

        var comment = $(".review_comment").val();
        var photos = reviewOrderImage;
        var orderid = "<?php echo $_GET['id']; ?>";
        var CustomerId = user_uuid;
        var VendorId = orderVendorId;
        var uname = reviewUserName;
        var reviewId = database.collection("tmp").doc().id;
        var userProfile = reviewUserProfile;
        var productId = $("#reviewModel").attr('data-pid');

        database.collection('items_review').where('orderid', '==', orderid).where('productId', '==', productId).get().then((docSnapshot) => {

            if (docSnapshot.size) {

                //update existing review

                var itemReviewDoc = docSnapshot.docs[0].data();

                var timeStamp = firebase.firestore.FieldValue.serverTimestamp();
                database.collection('items_review').doc(itemReviewDoc.Id).update({
                    'comment': comment,
                    'photos': photos,
                    'rating': rating,
                    'reviewAttributes': reviewAttributes,
                    'createdAt': timeStamp
                });

                vendor_data = vendor.where('id', "==", VendorId);
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
                        database.collection('vendors').doc(VendorId).update({
                            'reviewsCount': reviewsCount,
                            'reviewsSum': reviewsSum
                        });
                    }
                });

                product_data = vendor_products.where('id', "==", productId);
                product_data.get().then(async function (snapshots) {
                    if (snapshots.docs[0]) {
                        product = snapshots.docs[0].data();
                        var reviewsCount = 0;
                        var reviewsSum = 0;
                        if (product.reviewsCount != undefined && product.reviewsCount != '') {
                            reviewsCount = product.reviewsCount;
                            reviewsCount = reviewsCount - 1;
                        }
                        if (product.reviewsSum != undefined && product.reviewsSum != '') {
                            reviewsSum = product.reviewsSum;
                            reviewsSum = reviewsSum - itemReviewDoc.rating;
                        }
                        reviewsCount = reviewsCount + 1;
                        reviewsSum = reviewsSum + rating;

                        if (product.reviewAttributes != undefined && product.reviewAttributes != '') {
                            var resetReviewAtrributes = {};
                            productreviewAttributes = product.reviewAttributes;
                            $.each(productreviewAttributes, function (key, data) {
                                var reviewsCount = data.reviewsCount - 1;
                                var reviewsSum = data.reviewsSum - itemReviewDoc.reviewAttributes[key];
                                reviewsCount = reviewsCount + 1
                                reviewsSum = reviewsSum + reviewAttributes[key];
                                resetReviewAtrributes[key] = {'reviewsCount': reviewsCount, 'reviewsSum': reviewsSum};
                            });
                            reviewAttributes = resetReviewAtrributes;
                        } else {
                            reviewAttributes = reviewAttributes2;
                        }

                        if ($.isEmptyObject(reviewAttributes)) {
                            reviewAttributes = null;
                        }

                        database.collection('vendor_products').doc(productId).update({
                            'reviewsCount': reviewsCount,
                            'reviewsSum': reviewsSum,
                            'reviewAttributes': reviewAttributes
                        }).then(function (result) {
                            location.reload();
                        });
                    }
                });

            } else {

                //create new review
                var timeStamp = firebase.firestore.FieldValue.serverTimestamp();
                database.collection('items_review').doc(reviewId).set({
                    'CustomerId': CustomerId,
                    'Id': reviewId,
                    'VendorId': VendorId,
                    'comment': comment,
                    'orderid': orderid,
                    'photos': photos,
                    'productId': productId,
                    'rating': rating,
                    "uname": uname,
                    'profile': userProfile,
                    'reviewAttributes': reviewAttributes,
                    'createdAt': timeStamp
                }).then(function (result) {
                    vendor_data = vendor.where('id', "==", VendorId);
                    vendor_data.get().then(async function (snapshots) {
                        if (snapshots.docs[0]) {
                            vendor = snapshots.docs[0].data();
                            var reviewsCount = 0;
                            var reviewsSum = 0;
                            if (vendor.reviewsCount != undefined && vendor.reviewsCount != '') {
                                reviewsCount = vendor.reviewsCount;
                            }
                            if (vendor.reviewsSum != undefined && vendor.reviewsSum != '') {
                                reviewsSum = vendor.reviewsSum;
                            }
                            reviewsCount = reviewsCount + 1;
                            reviewsSum = reviewsSum + rating;
                            database.collection('vendors').doc(VendorId).update({
                                'reviewsCount': reviewsCount,
                                'reviewsSum': reviewsSum
                            });
                        }
                    });

                    product_data = vendor_products.where('id', "==", productId);
                    product_data.get().then(async function (snapshots) {
                        if (snapshots.docs[0]) {
                            product = snapshots.docs[0].data();
                            var reviewsCount = 0;
                            var reviewsSum = 0;
                            if (product.reviewsCount != undefined && product.reviewsCount != '') {
                                reviewsCount = product.reviewsCount;
                            }
                            if (product.reviewsSum != undefined && product.reviewsSum != '') {
                                reviewsSum = product.reviewsSum;
                            }
                            reviewsCount = reviewsCount + 1;
                            reviewsSum = reviewsSum + rating;

                            if (product.reviewAttributes != undefined && product.reviewAttributes != '') {
                                var resetReviewAtrributes = {};
                                productreviewAttributes = product.reviewAttributes;
                                $.each(productreviewAttributes, function (key, data) {
                                    var reviewsCount = data.reviewsCount + 1
                                    var reviewsSum = data.reviewsSum + reviewAttributes[key];
                                    resetReviewAtrributes[key] = {
                                        'reviewsCount': reviewsCount,
                                        'reviewsSum': reviewsSum
                                    };
                                });
                                reviewAttributes = resetReviewAtrributes;
                            } else {
                                reviewAttributes = reviewAttributes2;
                            }

                            if ($.isEmptyObject(reviewAttributes)) {
                                reviewAttributes = null;
                            }

                            database.collection('vendor_products').doc(productId).update({
                                'reviewsCount': reviewsCount,
                                'reviewsSum': reviewsSum,
                                'reviewAttributes': reviewAttributes
                            }).then(function (result) {
                                location.reload();
                            });
                        }
                    });
                });
            }
        });

    })


    var place_image = '';
    var ref_place = database.collection('settings').doc("placeHolderImage");
    ref_place.get().then(async function (snapshots) {
        var placeHolderImage = snapshots.data();
        place_image = placeHolderImage.image;

    });

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


    async function getOrderDetails() {


        completedorsersref.get().then(async function (completedorderSnapshots) {


            var orderDetails = completedorderSnapshots.docs[0].data();

            if (orderDetails.author.id != user_uuid) {
                window.location.href = '{{ route("login")}}';
            } else {


                var orderDate = orderDetails.createdAt.toDate().toDateString();

                var time = orderDetails.createdAt.toDate().toLocaleTimeString('en-US');

                $("#order-date").html(orderDate + ' ' + time);


                //var order_address = orderDetails.address.line1+' '+orderDetails.address.line2 +', '+orderDetails.address.city +', '+orderDetails.address.country;

                var billingAddressstring = '';

                if (orderDetails.address.hasOwnProperty('line1')) {
                    $("#billing_line1").text(orderDetails.address.line1);
                }
                if (orderDetails.address.hasOwnProperty('line2')) {
                    billingAddressstring = billingAddressstring + orderDetails.address.line2;
                }
                if (orderDetails.address.hasOwnProperty('city')) {
                    billingAddressstring = billingAddressstring + ", " + orderDetails.address.city;
                }

                if (orderDetails.address.hasOwnProperty('postalCode')) {
                    billingAddressstring = billingAddressstring + ", " + orderDetails.address.postalCode;
                }

                $("#billing_line2").text(billingAddressstring);

                if (orderDetails.address.hasOwnProperty('country')) {
                    $("#billing_country").text(orderDetails.address.country);
                }


                $("#order-addreess").html(billingAddressstring);

                var order_items = order_status = '';

                var order_subtotal = order_shipping = order_total = 0;


                order_items += '<tr>';

                order_items += '<th></th>';

                order_items += '<th class="prod-name">Item Name</th>';

                order_items += '<th class="qunt">Review</th>';

                order_items += '<th class="qunt">Quantity</th>';

                order_items += '<th class="qunt">Extras</th>';

                order_items += '<th class="price">Price</th>';

                order_items += '<th class="price text-right">Total</th>';

                order_items += '</tr>';


                for (let i = 0; i < orderDetails.products.length; i++) {

                    var extra_html = '';

                    order_subtotal = order_subtotal + parseFloat(orderDetails.products[i]['price']) * parseFloat(orderDetails.products[i]['quantity']);
                    var productPriceTotal = parseFloat(orderDetails.products[i]['price']) * parseFloat(orderDetails.products[i]['quantity']);
                    var productExtras = 0;
                    if (orderDetails.products[i].hasOwnProperty('extras_price') && orderDetails.products[i].hasOwnProperty('extras')) {
                        productPriceTotal += parseFloat(orderDetails.products[i].extras_price) * parseInt(orderDetails.products[i]['quantity']);
                        order_subtotal += parseFloat(orderDetails.products[i].extras_price) * parseInt(orderDetails.products[i]['quantity']);
                        productExtras = parseFloat(orderDetails.products[i].extras_price) * parseInt(orderDetails.products[i]['quantity']);
                    }

                    products_price = "";
                    productPriceTotal_val = "";
                    productExtras_val = "";
                    if (currencyAtRight) {
                        products_price = parseFloat(orderDetails.products[i]['price']).toFixed(decimal_degits) + "" + currentCurrency;
                        productPriceTotal_val = parseFloat(productPriceTotal).toFixed(decimal_degits) + "" + currentCurrency;
                        productExtras_val = parseFloat(productExtras).toFixed(decimal_degits) + "" + currentCurrency;
                    } else {
                        products_price = currentCurrency + "" + parseFloat(orderDetails.products[i]['price']).toFixed(decimal_degits);
                        productPriceTotal_val = currentCurrency + "" + parseFloat(productPriceTotal).toFixed(decimal_degits);
                        productExtras_val = currentCurrency + "" + parseFloat(productExtras).toFixed(decimal_degits);
                    }


                    var extra_html = '';
                    if (orderDetails.products[i].extras != undefined && orderDetails.products[i].extras != '' && orderDetails.products[i].extras.length > 0) {
                        extra_html = extra_html + '<span>';
                        var extra_count = 1;
                        try {
                            orderDetails.products[i].extras.forEach((extra) => {

                                if (extra_count > 1) {
                                    extra_html = extra_html + ',' + extra;
                                } else {
                                    extra_html = extra_html + extra;
                                }
                                extra_count++;
                            });
                        } catch (error) {

                        }

                        extra_html = extra_html + '</span>';
                    }


                    order_items += '<tr>';
                    if (orderDetails.products[i]['photo'] != '') {
                        order_items += '<td class="ord-photo"><img alt="#" src="' + orderDetails.products[i]['photo'] + '" class="img-fluid order_img rounded"></td>';
                    } else {
                        order_items += '<td class="ord-photo"><img alt="#" src="' + place_image + '" class="img-fluid order_img rounded"></td>';
                    }

                    var variant_info = '';
                    if (orderDetails.products[i]['variant_info']) {
                        variant_info += '<div class="variant-info">';
                        variant_info += '<ul>';
                        $.each(orderDetails.products[i]['variant_info']['variant_options'], function (label, value) {
                            variant_info += '<li class="variant"><span class="label">' + label + '</span><span class="value">' + value + '</span></li>';
                        });
                        variant_info += '</ul>';
                        variant_info += '</div>';
                    }

                    order_items += '<td class="prod-name">' + orderDetails.products[i]['name'] + '<div class="extra"><span>{{trans("lang.extras")}} :</span><span class="ext-item">' + extra_html + variant_info + '</span></div></td>';

                    order_items += '<td class="qunt">';
                    checkItemReview(orderId, orderDetails.products[i]['id']);


                    order_items += '<button type="button" class="btn btn-primary item_review_btn" data-pid="' + orderDetails.products[i]['id'] + '" data-cid="' + orderDetails.products[i]['category_id'] + '" id="review_btn">Add Review</button>';
                    order_items += '</td>';

                    order_items += '<td class="qunt">x ' + orderDetails.products[i]['quantity'] + '</td>';

                    order_items += '<td class="extras_price">+ ' + productExtras_val + '</td>';

                    order_items += '<td class="product_price">' + products_price + '</td>';

                    order_items += '<td class="total_product_price text-right">' + productPriceTotal_val + '</td>';

                    order_items += '</tr>';


                }

                order_number = orderDetails['id'];
                if (orderDetails.hasOwnProperty('deliveryCharge') && orderDetails.deliveryCharge) {
                    order_shipping = orderDetails.deliveryCharge;
                }


                order_status = orderDetails['status'];
                if (orderDetails.hasOwnProperty('discount') && orderDetails.discount) {
                    order_discount = orderDetails.discount;
                } else {
                    order_discount = 0;
                }
                var special_discount = 0;
                var special_discount_html = "";
                if (orderDetails.hasOwnProperty('specialDiscount')) {

                    if (orderDetails.specialDiscount != null) {
                        if (orderDetails.specialDiscount.specialType != "" && orderDetails.specialDiscount.specialType != null) {
                            if (orderDetails.specialDiscount.specialType == "percentage") {
                                special_discount_html = "(" + orderDetails.specialDiscount.special_discount_label + "%)";
                            }
                            special_discount = orderDetails.specialDiscount.special_discount;


                        }
                    }
                }

                if (orderDetails.hasOwnProperty('tip_amount') && orderDetails.tip_amount) {
                    order_tip_amount = orderDetails.tip_amount;
                } else {
                    order_tip_amount = 0;
                }
                var order_subtotal_main = order_subtotal;
                order_subtotal = order_subtotal - parseFloat(order_discount) - parseFloat(special_discount);

                tax = 0;
                taxlabel = '';
                taxlabeltype = '';
                if (orderDetails.hasOwnProperty('taxSetting')) {
                    if (orderDetails.taxSetting.type && orderDetails.taxSetting.tax) {
                        if (orderDetails.taxSetting.type == "percent") {
                            tax = (orderDetails.taxSetting.tax * order_subtotal) / 100;
                            taxlabeltype = "%";
                        } else {
                            tax = orderDetails.taxSetting.tax;
                            taxlabeltype = "fix";
                        }
                        var taxlabel = '';
                        if (orderDetails.taxSetting.label) {
                            taxlabel = orderDetails.taxSetting.label;
                        }

                        $(".order_tax_div").show();

                        if (currencyAtRight) {
                            $("#order-tax").html(parseFloat(tax).toFixed(decimal_degits) + "" + currentCurrency + " (" + taxlabel + " " + orderDetails.taxSetting.tax + " " + taxlabeltype + ")");
                        } else {
                            $("#order-tax").html(currentCurrency + "" + parseFloat(tax).toFixed(decimal_degits) + " (" + taxlabel + " " + orderDetails.taxSetting.tax + " " + taxlabeltype + ")");
                        }
                    }

                }

                // order_subtotal = parseFloat(order_subtotal)
                order_total = order_subtotal + parseFloat(order_shipping) + parseFloat(order_tip_amount) + parseFloat(tax);

                order_total_val = "";
                order_subtotal_val = "";
                order_discount_val = "";
                order_shipping_val = "";
                order_tip_amount_val = "";
                if (currencyAtRight) {
                    order_total_val = order_total.toFixed(decimal_degits) + "" + currentCurrency;
                    order_subtotal_main = order_subtotal_main.toFixed(decimal_degits) + "" + currentCurrency;
                    order_subtotal_val = order_subtotal.toFixed(decimal_degits) + "" + currentCurrency;
                    order_shipping_val = parseFloat(order_shipping).toFixed(decimal_degits) + "" + currentCurrency;
                    order_discount_val = parseFloat(order_discount).toFixed(decimal_degits) + "" + currentCurrency;
                    order_tip_amount_val = parseFloat(order_tip_amount).toFixed(decimal_degits) + "" + currentCurrency;
                } else {
                    order_total_val = currentCurrency + "" + order_total.toFixed(decimal_degits);
                    order_subtotal_val = currentCurrency + "" + order_subtotal.toFixed(decimal_degits);
                    order_subtotal_main = currentCurrency + "" + order_subtotal_main.toFixed(decimal_degits);
                    order_shipping_val = currentCurrency + "" + parseFloat(order_shipping).toFixed(decimal_degits);
                    order_discount_val = currentCurrency + "" + parseFloat(order_discount).toFixed(decimal_degits);
                    order_tip_amount_val = currentCurrency + "" + parseFloat(order_tip_amount).toFixed(decimal_degits);
                }

                $("#order-number").html(order_number);

                $("#order-status").html(order_status);

                $("#order-items").html('<table class="order-list">' + order_items + '</table>');


                $("#order-subtotal").html(order_subtotal_main);

                $("#order-shipping").html(order_shipping_val);
                if (orderDetails.hasOwnProperty('couponCode') && orderDetails.couponCode != '') {
                    $('.used_coupon_code_div').show();
                    $("#used_coupon_code").html(orderDetails.couponCode);
                }

                $("#order-discount").html(order_discount_val);
                if (currencyAtRight) {
                    special_discount = special_discount.toFixed(decimal_degits) + "" + currentCurrency;
                } else {
                    special_discount = currentCurrency + "" + special_discount.toFixed(decimal_degits);
                }

                $('#special_discount').html(special_discount + special_discount_html);

                $("#order-tip-amount").html(order_tip_amount_val);

                $("#order-total").append(order_total_val);
                if (orderDetails.hasOwnProperty('takeAway') && orderDetails.takeAway == true) {
                    $("#order-type").html("Take Away");
                } else {
                    $("#order-type").html("Delivery");
                }


                var order_vendor = '<tr>';
                var vendorImage = orderDetails.vendor.photo;
                var view_vendor_details = "{{ route('vendor',':id')}}";
                view_vendor_details = view_vendor_details.replace(':id', 'id=' + orderDetails.vendorID);
                orderVendorId = orderDetails.vendorID;
                reviewUserName = orderDetails.author.firstName + ' ' + orderDetails.author.lastName;
                reviewUserProfile = orderDetails.author.profilePictureURL;
                if (vendorImage == '') {
                    vendorImage = place_image;
                }
                // order_vendor += '<td class="ord-photo"><a href="'+view_vendor_details+'" class="row redirecttopage" id="resturant-view"><img alt="#" src="'+vendorImage+'" class="img-fluid order_img rounded"></a></td>';
                // order_vendor += '<td class="prod-name"><a href="'+view_vendor_details+'" class="row redirecttopage" id="resturant-view">'+orderDetails.vendor.title+'</a></td>';
                // order_vendor += '</tr>';

                // $("#vendor-details").html('<table class="order-list">'+order_vendor+'</table>');

                $('.resturant-img').attr('src', vendorImage);

                if (orderDetails.vendor.title) {
                    $('.vendor-title').html('<a href="' + view_vendor_details + '" class="row redirecttopage" id="resturant-view">' + orderDetails.vendor.title + '</a>');
                }

                if (orderDetails.vendor.phonenumber) {
                    $('#vendor_phone').text(orderDetails.vendor.phonenumber);
                }

                if (orderDetails.vendor.location) {
                    $('#vendor_address').text(orderDetails.vendor.location);
                }


                if (orderDetails.hasOwnProperty('takeAway') && orderDetails.takeAway == true) {
                    $(".order_driver_details").hide();
                    $(".order_shopping_div").hide();
                    $(".order_tip_div").hide();
                } else if (orderDetails.hasOwnProperty('driver')) {
                    var driverImage = orderDetails.driver.profilePictureURL;
                    if (driverImage == '') {
                        driverImage = place_image;
                    }
                    var name = orderDetails.driver.firstName + " " + orderDetails.driver.lastName;
                    // var order_driver = '<tr>';
                    // order_driver += '<td class="ord-photo"><img alt="#" src="'+driverImage+'" class="img-fluid order_img rounded"></td>';
                    // order_driver += '<td class="prod-name">'+name+'</td>';
                    // order_driver += '</tr>';
                    // $("#driver_details").html('<table class="order-list">'+order_driver+'</table>');

                    $('.driver-img').attr('src', driverImage);

                    if (name) {
                        $('.driver-name-title').html(name);
                    }

                    if (orderDetails.driver.phoneNumber) {
                        $('#driver_phone').text(orderDetails.driver.phoneNumber);
                    }

                    if (orderDetails.driver.carNumber) {
                        $('#driver_car_number').text(orderDetails.driver.carNumber);
                    }

                    // if(orderDetails.driver.carName){

                    // 	$('#driver_car_name').text(orderDetails.driver.carName);
                    // }
                }

                if (!orderDetails.driver) {
                    $("#order_driver_details").hide();
                }

                if (orderDetails.notes) {
                    $("#order-note-box").show();
                    $("#order-note").html(orderDetails.notes);
                }


            }

        })

    }

    function checkItemReview(orderid, productId) {
        database.collection('items_review').where('orderid', '==', orderid).where('productId', '==', productId).get().then((docSnapshot) => {
            if (docSnapshot.size) {
                $("#order-items").find('[data-pid="' + productId + '"]').text('Update Review');
                $("#reviewModel").find('.add_review_btn').text('Update Review');
            }
        });
    }

    var storageRef = firebase.storage().ref('images');

    function handleFileSelect(evt) {
        var f = evt.target.files[0];
        var reader = new FileReader();

        var fileExtension = ['jpeg', 'jpg', 'png'];
        var extension = f.name.replace(/^.*\./, '');
        if ($.inArray(extension, fileExtension) == -1) {
            alert("Only formats are allowed : " + fileExtension.join(', '));
            return false;
        }
        if (f.size > 2000000) {
            alert("File size not allowed more than 2 MB");
            return false;
        }

        reader.onload = (function (theFile) {
            return function (e) {

                var filePayload = e.target.result;
                var hash = CryptoJS.SHA256(Math.random() + CryptoJS.SHA256(filePayload));
                var val = f.name;
                var ext = val.split('.').pop();
                var docName = val.split('fakepath')[1];
                var filename = (f.name).replace(/C:\\fakepath\\/i, '')
                var timestamp = Number(new Date());
                var filename = timestamp + '.' + ext;

                var uploadTask = storageRef.child(filename).put(theFile);

                uploadTask.on('state_changed', function (snapshot) {
                    var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                    console.log('Upload is ' + progress + '% done');
                    jQuery("#uploding_image").text("Image is uploading...");
                }, function (error) {
                }, function () {
                    uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {
                        jQuery("#uploding_image").text("Upload is completed");

                        if (jQuery("#uploded_image ul").length > 0 && reviewOrderImage.length == 0) {
                            jQuery("#uploded_image ul li").each(function () {
                                reviewOrderImage.push($(this).find('img').attr('src'));
                            });
                        }
                        reviewOrderImage.push(downloadURL);

                        jQuery("#uploded_image ul").append('<li><img src="' + downloadURL + '" width="100"><span class="mdi mdi-delete" data-url="' + downloadURL + '">X</span></li>');
                        setTimeout(function () {
                            jQuery("#uploding_image").empty();
                        }, 1000);
                    });
                });

            };
        })(f);
        reader.readAsDataURL(f);
    }

</script>