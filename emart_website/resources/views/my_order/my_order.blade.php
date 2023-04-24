@include('layouts.app')


@include('layouts.header')


<div class="d-none">

    <div class="bg-primary border-bottom p-3 d-flex align-items-center">

        <a class="toggle togglew toggle-2" href="#"><span></span></a>

        <h4 class="font-weight-bold m-0 text-white">{{trans('lang.my_orders')}}</h4>

    </div>

</div>

<section class="py-4 siddhi-main-body">
    <input type="hidden" name="deliveryChargeMain" id="deliveryChargeMain">
    <input type="hidden" name="specialDiscountMain" id="specialDiscountMain">
    <input type="hidden" name="tax_active" id="tax_active">
    <input type="hidden" name="tax_label" id="tax_label">
    <input type="hidden" name="tax_amount" id="tax_amount">
    <input type="hidden" name="tax_type" id="tax_type">

    <div class="container">

        <div class="row">

            <div class="col-md-12 top-nav mb-3">

                <ul class="nav nav-tabsa custom-tabsa border-0 bg-white rounded overflow-hidden shadow-sm p-2 c-t-order"
                    id="myTab" role="tablist">

                    <li class="nav-item" role="presentation">

                        <a class="nav-link border-0 text-dark py-3 active" id="completed-tab" data-toggle="tab"
                           href="#completed" role="tab" aria-controls="completed" aria-selected="true">

                            <i class="feather-check mr-2 text-success mb-0"></i> {{trans('lang.completed')}}</a>

                    </li>

                    <li class="nav-item border-top" role="presentation">

                        <a class="nav-link border-0 text-dark py-3" id="progress-tab" data-toggle="tab" href="#progress"
                           role="tab" aria-controls="progress" aria-selected="false">

                            <i class="feather-clock mr-2 text-warning mb-0"></i> {{trans('lang.on_progress')}}</a>

                    </li>

                    <li class="nav-item border-top" role="presentation">

                        <a class="nav-link border-0 text-dark py-3" id="canceled-tab" data-toggle="tab" href="#canceled"
                           role="tab" aria-controls="canceled" aria-selected="false">

                            <i class="feather-x-circle mr-2 text-danger mb-0"></i> {{trans('lang.canceled')}}</a>

                    </li>

                </ul>

            </div>
            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}...</div>

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

    //console.log(user_uuid);


        <?php if(isset($_COOKIE['section_id'])){  ?>
    var section_id = "<?php echo $_COOKIE['section_id'] ?>";
    <?php } ?>

    if (section_id != "") {
        var reftaxSetting = database.collection('sections').doc(section_id);

        reftaxSetting.get().then(async function (snapshots) {

            var taxArray = snapshots.data();

            /* try {
                var taxArray = snapshots.data();
                taxSetting = {
                    'active': taxArray.tax_active,
                    'tax': taxArray.tax_amount,
                    'label': taxArray.tax_lable,
                    'type': taxArray.tax_type
                };
                if (taxSetting.active == false) {
                    taxSetting = '';
                }

            } catch (error) {

            }*/
            $('#tax_active').val(taxArray.tax_active);
            $('#tax_amount').val(taxArray.tax_amount);
            $('#tax_label').val(taxArray.tax_lable);
            $('#tax_type').val(taxArray.tax_type);
        });
    }

    var append_categories = '';

    var completedorsersref = database.collection('vendor_orders').where("author.id", "==", user_uuid).where('section_id','==',section_id).orderBy('createdAt', 'desc');
    var deliveryCharge = 0;
    var taxSetting = [];

    var currentCurrency = '';
    var currencyAtRight = false;
    var decimal_degits = 0;
    var products_info = {};

    var refCurrency = database.collection('currencies').where('isActive', '==', true);
    refCurrency.get().then(async function (snapshots) {
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;

        if (currencyData.decimal_degits) {
            decimal_degits = currencyData.decimal_degits;
        }
    });

    var special_discount = 0;
    var deliveryChargeRef = database.collection('settings').doc('DeliveryCharge');

    deliveryChargeRef.get().then(async function (deliveryChargeSnapshots) {

        var deliveryChargeData = deliveryChargeSnapshots.data();
        deliveryCharge = deliveryChargeData.amount;
        $("#deliveryChargeMain").val(deliveryCharge);
    });
    var taxSetting = [];

    var place_holder_image = '';
    var ref_placeholder_image = database.collection('settings').doc("placeHolderImage");
    ref_placeholder_image.get().then(async function (snapshots) {
        var placeHolderImage = snapshots.data();
        place_holder_image = placeHolderImage.image;
    });
	
	async function productInfo(id){
		var doc = await database.collection('vendor_products').doc(id).get();
		products_info[id] = doc.data();
    }
	
    $(document).ready(function () {
        $("#data-table_processing").show();
        getOrders();
      
        $(document).on("click", '.reorder-add-to-cart', function (event) {

            var order_id = $(this).attr('data-id');
            var item = [];

            jQuery(".order_" + order_id).each(function () {

                var id = jQuery(this).find('.product_id').val();
                var name = jQuery(this).find('.name').val();
                var price = jQuery(this).find('.price').val();
                var image = jQuery(this).find('.image').val();
                var quantity = jQuery(this).find('.quantity').val();
                var extra_price = jQuery(this).find('.extra_price').val();
                var extra = jQuery(this).find('.extra').val();
                var size = jQuery(this).find('.size').val();
                var item_price = jQuery(this).find('.item_price').val();
                
                var stock_quantity = undefined;
                if(products_info[id] != undefined){
                	var stock_quantity = products_info[id].quantity;
                }
                
                /*by thm*/
                var variant_info = null;
                if (jQuery(this).find('.variant_info').val()) {
                    variant_info = jQuery(this).find('.variant_info').val()
                    variant_info = JSON.parse(atob(variant_info));
                    if(products_info[id].item_attribute != null){
                    	$.each(products_info[id].item_attribute.variants, function (key, value) {
                            if (value.variant_sku == variant_info.variant_sku) {
                                variant_info.variant_qty = value.variant_quantity; 
                                 return false;
                            } 
                        });
                    }
                    id = id + 'PV' + variant_info.variant_id;
                }
                var category_id = jQuery(this).find('.category_id').val();

                var item_arr = {
                    'id': id,
                    'name': name,
                    'image': image,
                    'price': price,
                    'quantity': quantity,
                    'stock_quantity': stock_quantity,
                    'extra_price': extra_price,
                    'extra': extra,
                    'size': size,
                    'item_price': item_price,
                    'variant_info': variant_info,
                    'category_id': category_id
                }
                item.push(item_arr);

            });

            var vendor_id = jQuery(".restid_" + order_id).val();
            var vendor_name = jQuery(".resttitle_" + order_id).val();
            var vendor_location = jQuery(".restlocation_" + order_id).val();
            var vendor_image = jQuery(".restphoto_" + order_id).val();
            var delivery_option = '<?php if (Session::get('takeawayOption') == "true") {
                echo $delivery_option = "takeaway";
            } else {
                echo $delivery_option = "delivery";
            } ?>';

            var deliveryCharge = $("#deliveryChargeMain").val();
            specialOfferForHour = JSON.parse(getCookie('specialOfferForHourMain'));
            taxSetting = {
                'active': $("#tax_active").val(),
                'tax': $("#tax_amount").val(),
                'label': $("#tax_label").val(),
                'type': $("#tax_type").val()
            }
            if (taxSetting.active == false) {
                taxSetting = '';
            }

            $.ajax({
                type: 'POST',
                url: "<?php echo route('reorder-add-to-cart'); ?>",
                data: {
                    _token: '<?php echo csrf_token(); ?>',
                    vendor_id: vendor_id,
                    vendor_location: vendor_location,
                    vendor_name: vendor_name,
                    vendor_image: vendor_image,
                    item: item,
                    deliveryCharge: deliveryCharge,
                    delivery_option: delivery_option,
                    taxValue: taxSetting,
                    specialOfferForHour: specialOfferForHour,
                    decimal_degits: decimal_degits,
                },
                success: function (data) {
                    window.location.href = '{{ route("checkout")}}';
                }

            });
        });


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

                if (val.vendor.hasOwnProperty('photo') && val.vendor.photo != '') {
                    orderRestaurantImage = val.vendor.photo;
                } else {

                    orderRestaurantImage = place_holder_image;
                }
                html = html + '<div class="pb-3"><div class="p-3 rounded shadow-sm bg-white"><div class="d-flex border-bottom pb-3 m-d-flex"><div class="text-muted mr-3"><a href="' + view_vendor_details + '" class="text-dark"><img alt="#" src="' + orderRestaurantImage + '" class="img-fluid order_img rounded"></a></div><div><p class="mb-0 font-weight-bold"><a href="' + view_vendor_details + '" class="text-dark">' + val.vendor.title + '</a></p><p class="mb-0"><span class="fa fa-map-marker"></span> ' + val.vendor.location + '</p><p>ORDER ' + val.id + '</p><p class="mb-0 small view-det"><a href="' + view_details + '">View Details</a></p></div><div class="ml-auto ord-com-btn"><p class="bg-success text-white py-1 px-2 rounded small mb-1">' + val.status + '</p><p class="small font-weight-bold text-center"><i class="feather-clock"></i> ' + val.createdAt.toDate().toDateString() + '</p></div></div><div class="d-flex pt-3 m-d-flex"><div class="small">';

                var price = 0;

                var order_subtotal = order_shipping = order_total = tip_amount = 0;

                for (let i = 0; i < val.products.length; i++) {
                
                	productInfo(val.products[i]['id']);


                    /*if(val.products[i].hasOwnProperty('discountPrice') && val.products[i]['discountPrice'] != ''){
                        order_subtotal = order_subtotal + parseFloat(val.products[i]['discountPrice']) * parseFloat(val.products[i]['quantity']);
                    }else{*/
                    order_subtotal = order_subtotal + parseFloat(val.products[i]['price']) * parseFloat(val.products[i]['quantity']);
                    /*}*/

                    /*if(val.products[i].hasOwnProperty('discountPrice') && val.products[i]['discountPrice'] != ''){
                        var productPriceTotal = parseFloat(val.products[i]['discountPrice']) * parseFloat(val.products[i]['quantity']);
                    }else{*/
                    var productPriceTotal = parseFloat(val.products[i]['price']) * parseFloat(val.products[i]['quantity']);
                    /*}*/

                    var productExtras = 0;
                    if (val.products[i].hasOwnProperty('extras_price') && val.products[i].hasOwnProperty('extras')) {
                        if (val.products[i].extras_price) {
                            productPriceTotal += parseFloat(val.products[i].extras_price);
                            order_subtotal += parseFloat(val.products[i].extras_price);
                            productExtras = val.products[i].extras_price;
                        }
                    }
                    var extras = '';
                    if (val.products[i].hasOwnProperty('extras') && val.products[i].extras != '') {
                        extras = val.products[i].extras;
                    }
                    var size = '';
                    if (val.products[i].hasOwnProperty('size') && val.products[i].size != '') {
                        size = val.products[i].size;
                    }

                    html = html + '<p class="text- font-weight-bold mb-0">' + val.products[i]['name'] + ' x ' + val.products[i]['quantity'] + '</p>';

                    if (val.products[i]['variant_info']) {
                        html = html + '<div class="variant-info">';
                        html = html + '<ul>';
                        $.each(val.products[i]['variant_info']['variant_options'], function (label, value) {
                            html = html + '<li class="variant"><span class="label">' + label + '</span><span class="value">' + value + '</span></li>';
                        });
                        html = html + '</ul>';
                        html = html + '</div>';
                    }

                    /*if(val.products[i].hasOwnProperty('discountPrice') && val.products[i]['discountPrice'] != ''){
                        price = price + val.products[i]['discountPrice'] * val.products[i]['quantity'];
                    }else{*/
                    price = price + val.products[i]['price'] * val.products[i]['quantity'];
                    /*}*/


                    html = html + '<div class="order_' + String(order_id) + '">';
                    html = html + '<input type="hidden" class="product_id" value="' + String(val.products[i]['id']) + '">';
                    html = html + '<input type="hidden" class="name" value="' + String(val.products[i]['name']) + '">';
                    html = html + '<input type="hidden" class="image" value="' + String(val.products[i]['photo']) + '">';

                    /*if(val.products[i].hasOwnProperty('discountPrice') && val.products[i]['discountPrice'] != ''){
                        html=html+'<input type="hidden" class="price" value="'+parseFloat(val.products[i]['discountPrice'])+'">';
                    }else{*/
                    html = html + '<input type="hidden" class="price" value="' + parseFloat(val.products[i]['price']) + '">';
                    /*}*/
                    html = html + '<input type="hidden" class="quantity" value="' + parseFloat(val.products[i]['quantity']) + '">';

                    html = html + '<input type="hidden" class="extra_price" value="' + parseFloat(productExtras) + '">';

                    /*if(val.products[i].hasOwnProperty('discountPrice') && val.products[i]['discountPrice'] != ''){
                        html=html+'<input type="hidden" class="item_price" value="'+parseFloat(val.products[i]['discountPrice'])+'">';
                    }else{*/
                    html = html + '<input type="hidden" class="item_price" value="' + parseFloat(val.products[i]['price']) + '">';
                    /*}*/
                    html = html + '<input type="hidden" class="extra" value="' + extras + '">';
                    html = html + '<input type="hidden" class="size" value="' + size + '">';

                    if (val.products[i]['variant_info']) {
                        html = html + '<input type="hidden" class="variant_info" value="' + btoa(JSON.stringify(val.products[i]['variant_info'])) + '">';
                    }
                    html = html + '<input type="hidden" class="category_id" value="' + val.products[i]['category_id'] + '">';


                    html = html + '</div>';

                }


                if (val.hasOwnProperty('deliveryCharge') && val.deliveryCharge && val.deliveryCharge != null) {
                    if (val.deliveryCharge) {
                        order_shipping = val.deliveryCharge;
                    } else {
                        order_shipping = 0;
                    }
                } else {
                    order_shipping = 0;
                }

                if (val.hasOwnProperty('discount') && val.discount) {
                    if (val.discount) {
                        order_discount = val.discount;
                    } else {
                        order_discount = 0;
                    }
                } else {
                    order_discount = 0;
                }
                var special_discount = 0;

                if (val.hasOwnProperty('specialDiscount')) {

                    if (val.specialDiscount != null) {
                        if (val.specialDiscount.specialType != "" && val.specialDiscount.specialType != null) {

                            special_discount = val.specialDiscount.special_discount;
                        }
                    }
                }

                if (val.hasOwnProperty('tip_amount') && val.tip_amount) {
                    if (val.tip_amount) {
                        tip_amount = val.tip_amount;
                    } else {
                        tip_amount = 0;
                    }
                } else {
                    tip_amount = 0;
                }

                order_subtotal = (parseFloat(order_subtotal) - parseFloat(order_discount) - parseFloat(special_discount));
                tax = 0;
                if (val.hasOwnProperty('taxSetting')) {
                    if (val.taxSetting.type && val.taxSetting.tax) {
                        if (val.taxSetting.type == "percent") {
                            tax = (val.taxSetting.tax * order_subtotal) / 100;
                        } else {
                            tax = val.taxSetting.tax;
                        }
                    }
                }


                order_total = order_subtotal + parseFloat(order_shipping) + parseFloat(tip_amount) + parseFloat(tax);

                var order_total_val = '';
                if (currencyAtRight) {
                    order_total_val = parseFloat(order_total).toFixed(decimal_degits) + '' + currentCurrency;
                } else {
                    order_total_val = currentCurrency + '' + parseFloat(order_total).toFixed(decimal_degits);
                }

                html = html + '<input type="hidden" class="restid_' + String(order_id) + '" value="' + val.vendor.id + '">';
                html = html + '<input type="hidden" class="resttitle_' + String(order_id) + '" value="' + val.vendor.title + '">';
                html = html + '<input type="hidden" class="restlocation_' + String(order_id) + '" value="' + val.vendor.location + '">';
                html = html + '<input type="hidden" class="restphoto_' + String(order_id) + '" value="' + val.vendor.photo + '">';
                html = html + '<input type="hidden" class="deliveryCharge_' + String(order_id) + '" value="' + deliveryCharge + '">';
                html = html + '<input type="hidden" class="specialDiscount_' + String(order_id) + '" value="' + special_discount + '">';

                html = html + '</div><div class="text-muted m-0 ml-auto mr-3 small">Total Payment<br><span class="text-dark font-weight-bold">' + order_total_val + '</span></div> <div class="text-right"><a href="javascript:void(0);" class="btn btn-primary px-3 reorder-add-to-cart" data-id="' + String(order_id) + '">Reorder</a><a href="' + view_contact + '" class="btn btn-outline-primary px-3">Help</a> </div></div></div></div></div></div>';

            }

        });

		if(html == ''){
			html = html + "<h5>{{trans('lang.no_results')}}</h5>";
		}
        jQuery("#data-table_processing").hide();
        return html;

    }


    function buildHTMLPendingOrders(completedorderSnapshots) {

        var html = '';

        var alldata = [];

        var number = [];
        //completedorderSnapshots.docs.length;
        completedorderSnapshots.docs.forEach((listval) => {

            var datas = listval.data();
            datas.id = listval.id;
            alldata.push(datas);

        });


        alldata.forEach((listval) => {


            var val = listval;

            var order_id = val.id;

            var view_details = "{{ route('pending_order',':id')}}";

            view_details = view_details.replace(':id', 'id=' + order_id);

            var view_checkout = "{{ route('checkout')}}";

            var view_contact = "{{ route('contact_us')}}";

            var view_vendor_details = "{{ route('vendor',':id')}}";

            view_vendor_details = view_vendor_details.replace(':id', 'id=' + val.vendorID);


            if (val.status == "Order Placed" || val.status == "Order Accepted" || val.status == "Driver Pending" || val.status == "Order Shipped" || val.status == "In Transit") {

                var orderRestaurantImage = '';
                if (val.vendor.hasOwnProperty('photo') && val.vendor.photo != '') {
                    orderRestaurantImage = val.vendor.photo;
                } else {
                    orderRestaurantImage = place_holder_image;
                }

                html = html + '<div class="pb-3"><div class="p-3 rounded shadow-sm bg-white"><div class="d-flex border-bottom pb-3 m-d-flex"><div class="text-muted mr-3"><a href="' + view_vendor_details + '" class="text-dark"><img alt="#" src="' + orderRestaurantImage + '" class="img-fluid order_img rounded"></a></div><div><p class="mb-0 font-weight-bold"><a href="' + view_vendor_details + '" class="text-dark">' + val.vendor.title + '</a></p><p class="mb-0"><span class="fa fa-map-marker"></span> ' + val.vendor.location + '</p><p>ORDER ' + val.id + '</p><p class="mb-0 small view-det"><a href="' + view_details + '">View Details</a></p></div><div class="ml-auto ord-com-btn"><p class="bg-pending text-white py-1 px-2 rounded small mb-1">' + val.status + '</p><p class="small font-weight-bold text-center"><i class="feather-clock"></i> ' + val.createdAt.toDate().toDateString() + '</p></div></div><div class="d-flex pt-3 m-d-flex"><div class="small">';

                var price = 0;

                var order_subtotal = order_shipping = order_total = tip_amount = 0;

                for (let i = 0; i < val.products.length; i++) {
					
					productInfo(val.products[i]['id']);

                    /*if(val.products[i].hasOwnProperty('discountPrice') && val.products[i]['discountPrice'] != ''){
                        order_subtotal = order_subtotal + parseFloat(val.products[i]['discountPrice']) * parseFloat(val.products[i]['quantity']);
                    }else{*/
                    order_subtotal = order_subtotal + parseFloat(val.products[i]['price']) * parseFloat(val.products[i]['quantity']);
                    /*}*/

                    /*if(val.products[i].hasOwnProperty('discountPrice') && val.products[i]['discountPrice'] != ''){
                        var productPriceTotal = parseFloat(val.products[i]['discountPrice']) * parseFloat(val.products[i]['quantity']);
                    }else{*/
                    var productPriceTotal = parseFloat(val.products[i]['price']) * parseFloat(val.products[i]['quantity']);
                    /*}*/

                    var productExtras = 0;
                    if (val.products[i].hasOwnProperty('extras_price') && val.products[i].hasOwnProperty('extras')) {
                        if (val.products[i].extras_price) {
                            productPriceTotal += (parseFloat(val.products[i].extras_price) * parseInt(val.products[i]['quantity']));
                            order_subtotal += (parseFloat(val.products[i].extras_price) * parseInt(val.products[i]['quantity']));
                            productExtras = (parseFloat(val.products[i].extras_price) * parseInt(val.products[i]['quantity']));
                        }
                    }
                    var extras = '';
                    if (val.products[i].hasOwnProperty('extras') && val.products[i].extras != '') {
                        extras = val.products[i].extras;
                    }
                    var size = '';
                    if (val.products[i].hasOwnProperty('size') && val.products[i].size != '') {
                        size = val.products[i].size;
                    }

                    html = html + '<p class="text- font-weight-bold mb-0">' + val.products[i]['name'] + ' x ' + val.products[i]['quantity'] + '</p>';

                    if (val.products[i]['variant_info']) {
                        html = html + '<div class="variant-info">';
                        html = html + '<ul>';
                        $.each(val.products[i]['variant_info']['variant_options'], function (label, value) {
                            html = html + '<li class="variant"><span class="label">' + label + '</span><span class="value">' + value + '</span></li>';
                        });
                        html = html + '</ul>';
                        html = html + '</div>';
                    }

                    /*if(val.products[i].hasOwnProperty('discountPrice') && val.products[i]['discountPrice'] != ''){
                        price = price + val.products[i]['discountPrice'] * val.products[i]['quantity'];
                    }else{*/
                    price = price + val.products[i]['price'] * val.products[i]['quantity'];
                    /*}*/

                    html = html + '<div class="order_' + String(order_id) + '">';
                    html = html + '<input type="hidden" class="product_id" value="' + String(val.products[i]['id']) + '">';
                    html = html + '<input type="hidden" class="name" value="' + String(val.products[i]['name']) + '">';
                    html = html + '<input type="hidden" class="image" value="' + String(val.products[i]['photo']) + '">';
                    /*if(val.products[i].hasOwnProperty('discountPrice') && val.products[i]['discountPrice'] != ''){
                        html=html+'<input type="hidden" class="price" value="'+parseFloat(val.products[i]['discountPrice'])+'">';
                    }else{*/
                    html = html + '<input type="hidden" class="price" value="' + parseFloat(val.products[i]['price']) + '">';
                    /*}*/


                    html = html + '<input type="hidden" class="quantity" value="' + parseFloat(val.products[i]['quantity']) + '">';

                    html = html + '<input type="hidden" class="extra_price" value="' + parseFloat(productExtras) + '">';


                    /*if(val.products[i].hasOwnProperty('discountPrice') && val.products[i]['discountPrice'] != ''){
                        html=html+'<input type="hidden" class="item_price" value="'+parseFloat(val.products[i]['discountPrice'])+'">';
                    }else{*/
                    html = html + '<input type="hidden" class="item_price" value="' + parseFloat(val.products[i]['price']) + '">';
                    /*}*/

                    html = html + '<input type="hidden" class="extra" value="' + extras + '">';
                    html = html + '<input type="hidden" class="size" value="' + size + '">';

                    if (val.products[i]['variant_info']) {
                        html = html + '<input type="hidden" class="variant_info" value="' + btoa(JSON.stringify(val.products[i]['variant_info'])) + '">';
                    }
                    html = html + '<input type="hidden" class="category_id" value="' + val.products[i]['category_id'] + '">';

                    html = html + '</div>';

                }

                if (val.hasOwnProperty('deliveryCharge') && val.deliveryCharge && val.deliveryCharge != null) {
                    if (val.deliveryCharge) {
                        order_shipping = val.deliveryCharge;
                    } else {
                        order_shipping = 0;
                    }
                } else {
                    order_shipping = 0;
                }

                if (val.hasOwnProperty('discount') && val.discount) {
                    if (val.discount) {
                        order_discount = val.discount;
                    } else {
                        order_discount = 0;
                    }
                } else {
                    order_discount = 0;
                }
                var special_discount = 0;

                if (val.hasOwnProperty('specialDiscount')) {

                    if (val.specialDiscount != null) {
                        if (val.specialDiscount.specialType != "" && val.specialDiscount.specialType != null) {

                            special_discount = val.specialDiscount.special_discount;
                        }
                    }
                }
                if (val.hasOwnProperty('tip_amount') && val.tip_amount) {
                    if (val.tip_amount) {
                        tip_amount = val.tip_amount;
                    } else {
                        tip_amount = 0;
                    }
                } else {
                    tip_amount = 0;
                }


                order_subtotal = (parseFloat(order_subtotal) - parseFloat(order_discount) - parseFloat(special_discount));
                tax = 0;
                if (val.hasOwnProperty('taxSetting')) {
                    if (val.taxSetting.type && val.taxSetting.tax) {
                        if (val.taxSetting.type == "percent") {
                            tax = (val.taxSetting.tax * order_subtotal) / 100;
                        } else {
                            tax = val.taxSetting.tax;
                        }
                    }
                }


                order_total = order_subtotal + parseFloat(order_shipping) + parseFloat(tip_amount) + parseFloat(tax);

                var order_total_val = '';
                if (currencyAtRight) {
                    order_total_val = order_total.toFixed(decimal_degits) + '' + currentCurrency;
                } else {
                    order_total_val = currentCurrency + '' + order_total.toFixed(decimal_degits);
                }


                html = html + '<input type="hidden" class="restid_' + String(order_id) + '" value="' + val.vendor.id + '">';
                html = html + '<input type="hidden" class="resttitle_' + String(order_id) + '" value="' + val.vendor.title + '">';
                html = html + '<input type="hidden" class="restlocation_' + String(order_id) + '" value="' + val.vendor.location + '">';
                html = html + '<input type="hidden" class="restphoto_' + String(order_id) + '" value="' + val.vendor.photo + '">';
                html = html + '<input type="hidden" class="deliveryCharge_' + String(order_id) + '" value="' + deliveryCharge + '">';
                html = html + '<input type="hidden" class="specialDiscount_' + String(order_id) + '" value="' + special_discount + '">';

                html = html + '</div><div class="text-muted m-0 ml-auto mr-3 small">Total Payment<br><span class="text-dark font-weight-bold">' + order_total_val + '</span></div> <div class="text-right"><a href="javascript:void(0);" class="btn btn-primary px-3 reorder-add-to-cart" data-id="' + String(order_id) + '">Reorder</a><a href="' + view_contact + '" class="btn btn-outline-primary px-3">Help</a></div></div></div></div></div></div>';

            }

        });

		if(html == ''){
			html = html + "<h5>{{trans('lang.no_results')}}</h5>";
		}
        jQuery("#data-table_processing").hide();
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

            var view_details = "{{ route('cancelled_order',':id')}}";

            view_details = view_details.replace(':id', 'id=' + order_id);

            var view_contact = "{{ route('contact_us')}}";

            var view_checkout = "{{ route('checkout')}}";

            var view_vendor_details = "{{ route('vendor',':id')}}";

            view_vendor_details = view_vendor_details.replace(':id', 'id=' + val.vendorID);

            if (val.status == "Driver Rejected" || val.status == "Order Rejected") {
                var orderRestaurantImage = '';
                if (val.vendor.hasOwnProperty('photo') && val.vendor.photo != '') {
                    orderRestaurantImage = val.vendor.photo;
                } else {
                    orderRestaurantImage = place_holder_image;
                }

                html = html + '<div class="pb-3"><div class="p-3 rounded shadow-sm bg-white"><div class="d-flex border-bottom pb-3 m-d-flex"><div class="text-muted mr-3"><a href="' + view_vendor_details + '" class="text-dark"><img alt="#" src="' + orderRestaurantImage + '" class="img-fluid order_img rounded"></a></div><div><p class="mb-0 font-weight-bold"><a href="' + view_vendor_details + '" class="text-dark">' + val.vendor.title + '</a></p><p class="mb-0"><span class="fa fa-map-marker"></span> ' + val.vendor.location + '</p><p>ORDER ' + val.id + '</p><p class="mb-0 small view-det"><a href="' + view_details + '">View Details</a></p></div><div class="ml-auto ord-com-btn"><p class="bg-rejected text-white py-1 px-2 rounded small mb-1">' + val.status + '</p><p class="small font-weight-bold text-center"><i class="feather-clock"></i> ' + val.createdAt.toDate().toDateString() + '</p></div></div><div class="d-flex pt-3 m-d-flex"><div class="small">';

                var price = 0;

                var order_subtotal = order_shipping = order_total = tip_amount = 0;

                for (let i = 0; i < val.products.length; i++) {
					
					productInfo(val.products[i]['id']);	

                    /*if(val.products[i].hasOwnProperty('discountPrice') && val.products[i]['discountPrice'] != ''){
                        order_subtotal = order_subtotal + parseFloat(val.products[i]['discountPrice']) * parseFloat(val.products[i]['quantity']);
                    }else{*/
                    order_subtotal = order_subtotal + parseFloat(val.products[i]['price']) * parseFloat(val.products[i]['quantity']);
                    /*}*/

                    /*if(val.products[i].hasOwnProperty('discountPrice') && val.products[i]['discountPrice'] != ''){
                        var productPriceTotal = parseFloat(val.products[i]['discountPrice']) * parseFloat(val.products[i]['quantity']);
                    }else{*/
                    var productPriceTotal = parseFloat(val.products[i]['price']) * parseFloat(val.products[i]['quantity']);
                    /*}*/

                    var productExtras = 0;
                    if (val.products[i].hasOwnProperty('extras_price') && val.products[i].hasOwnProperty('extras')) {
                        if (val.products[i].extras_price) {
                            productPriceTotal += parseFloat(val.products[i].extras_price);
                            order_subtotal += parseFloat(val.products[i].extras_price);
                            productExtras = val.products[i].extras_price;
                        }
                    }
                    var extras = '';
                    if (val.products[i].hasOwnProperty('extras') && val.products[i].extras != '') {
                        extras = val.products[i].extras;
                    }
                    var size = '';
                    if (val.products[i].hasOwnProperty('size') && val.products[i].size != '') {
                        size = val.products[i].size;
                    }

                    html = html + '<p class="text- font-weight-bold mb-0">' + val.products[i]['name'] + ' x ' + val.products[i]['quantity'] + '</p>';

                    if (val.products[i]['variant_info']) {
                        html = html + '<div class="variant-info">';
                        html = html + '<ul>';
                        $.each(val.products[i]['variant_info']['variant_options'], function (label, value) {
                            html = html + '<li class="variant"><span class="label">' + label + '</span><span class="value">' + value + '</span></li>';
                        });
                        html = html + '</ul>';
                        html = html + '</div>';
                    }

                    /*if(val.products[i].hasOwnProperty('discountPrice') && val.products[i]['discountPrice'] != ''){
                        price = price + val.products[i]['discountPrice'] * val.products[i]['quantity'];
                    }else{*/
                    price = price + val.products[i]['price'] * val.products[i]['quantity'];
                    /*}*/

                    html = html + '<div class="order_' + String(order_id) + '">';
                    html = html + '<input type="hidden" class="product_id" value="' + String(val.products[i]['id']) + '">';
                    html = html + '<input type="hidden" class="name" value="' + String(val.products[i]['name']) + '">';
                    html = html + '<input type="hidden" class="image" value="' + String(val.products[i]['photo']) + '">';

                    /*if(val.products[i].hasOwnProperty('discountPrice') && val.products[i]['discountPrice'] != ''){
                        html=html+'<input type="hidden" class="price" value="'+parseFloat(val.products[i]['discountPrice'])+'">';
                    }else{*/
                    html = html + '<input type="hidden" class="price" value="' + parseFloat(val.products[i]['price']) + '">';
                    /*}*/
                    html = html + '<input type="hidden" class="quantity" value="' + parseFloat(val.products[i]['quantity']) + '">';

                    html = html + '<input type="hidden" class="extra_price" value="' + parseFloat(productExtras) + '">';

                    /*if(val.products[i].hasOwnProperty('discountPrice') && val.products[i]['discountPrice'] != ''){
                        html=html+'<input type="hidden" class="item_price" value="'+parseFloat(val.products[i]['discountPrice'])+'">';
                    }else{*/
                    html = html + '<input type="hidden" class="item_price" value="' + parseFloat(val.products[i]['price']) + '">';
                    /*}*/
                    html = html + '<input type="hidden" class="extra" value="' + extras + '">';
                    html = html + '<input type="hidden" class="size" value="' + size + '">';

                    if (val.products[i]['variant_info']) {
                        html = html + '<input type="hidden" class="variant_info" value="' + btoa(JSON.stringify(val.products[i]['variant_info'])) + '">';
                    }
                    html = html + '<input type="hidden" class="category_id" value="' + val.products[i]['category_id'] + '">';

                    html = html + '</div>';

                }

                if (val.hasOwnProperty('deliveryCharge') && val.deliveryCharge && val.deliveryCharge != null) {
                    if (val.deliveryCharge) {
                        order_shipping = val.deliveryCharge;
                    } else {
                        order_shipping = 0;
                    }
                } else {
                    order_shipping = 0;
                }

                if (val.hasOwnProperty('discount') && val.discount) {
                    if (val.discount) {
                        order_discount = val.discount;
                    } else {
                        order_discount = 0;
                    }
                } else {
                    order_discount = 0;
                }
                var special_discount = 0;

                if (val.hasOwnProperty('specialDiscount')) {

                    if (val.specialDiscount != null) {
                        if (val.specialDiscount.specialType != "" && val.specialDiscount.specialType != null) {

                            special_discount = val.specialDiscount.special_discount;
                        }
                    }
                }
                if (val.hasOwnProperty('tip_amount') && val.tip_amount) {
                    if (val.tip_amount) {
                        tip_amount = val.tip_amount;
                    } else {
                        tip_amount = 0;
                    }
                } else {
                    tip_amount = 0;
                }

                order_subtotal = (parseFloat(order_subtotal) - parseFloat(order_discount) - parseFloat(special_discount));
                tax = 0;
                if (val.hasOwnProperty('taxSetting')) {
                    if (val.taxSetting.type && val.taxSetting.tax) {
                        if (val.taxSetting.type == "percent") {
                            tax = (val.taxSetting.tax * order_subtotal) / 100;
                        } else {
                            tax = val.taxSetting.tax;
                        }
                    }
                }


                order_total = order_subtotal + parseFloat(order_shipping) + parseFloat(tip_amount) + parseFloat(tax);

                var order_total_val = '';
                if (currencyAtRight) {
                    order_total_val = order_total.toFixed(decimal_degits) + '' + currentCurrency;
                } else {
                    order_total_val = currentCurrency + '' + order_total.toFixed(decimal_degits);
                }

                html = html + '<input type="hidden" class="restid_' + String(order_id) + '" value="' + val.vendor.id + '">';
                html = html + '<input type="hidden" class="resttitle_' + String(order_id) + '" value="' + val.vendor.title + '">';
                html = html + '<input type="hidden" class="restlocation_' + String(order_id) + '" value="' + val.vendor.location + '">';
                html = html + '<input type="hidden" class="restphoto_' + String(order_id) + '" value="' + val.vendor.photo + '">';
                html = html + '<input type="hidden" class="deliveryCharge_' + String(order_id) + '" value="' + deliveryCharge + '">';
                html = html + '<input type="hidden" class="specialDiscount_' + String(order_id) + '" value="' + special_discount + '">';

                html = html + '</div><div class="text-muted m-0 ml-auto mr-3 small">Total Payment<br><span class="text-dark font-weight-bold">' + order_total_val + '</span></div> <div class="text-right"><a href="javascript:void(0);" class="btn btn-primary px-3 reorder-add-to-cart" data-id="' + String(order_id) + '">Reorder</a><a href="' + view_contact + '" class="btn btn-outline-primary px-3">Help</a></div></div></div></div></div></div>';

            }

        });

		if(html == ''){
			html = html + "<h5>{{trans('lang.no_results')}}</h5>";
		}
        jQuery("#data-table_processing").hide();
        return html;

    }


</script>
