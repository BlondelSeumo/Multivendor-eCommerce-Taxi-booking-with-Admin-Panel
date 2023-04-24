@extends('layouts.app')

@section('content')

<div id="main-wrapper" class="page-wrapper" style="min-height: 207px;">

	<!-- ============================================================== -->

    <!-- Bread crumb and right sidebar toggle -->

    <!-- ============================================================== -->
    
    <div class="row cat-slider mb-4 mt-3" id="sections">
    	
    </div>	

    <!-- ============================================================== -->

    <!-- End Bread crumb and right sidebar toggle -->

    <!-- ============================================================== -->

    <!-- ============================================================== -->

    <!-- Container fluid  -->

    <!-- ============================================================== -->

    <div class="container-fluid">
    	
    	<div class="card mb-3 business-analytics">
			
			<div class="card-body">
				
				<div class="row flex-between align-items-center g-2 mb-3 order_stats_header">
					<div class="col-sm-6">
						<h4 class="d-flex align-items-center text-capitalize gap-10 mb-0">{{trans('lang.dashboard_business_analytics')}}</h4>
					</div>
				</div>
				
				<div class="row business-analytics_list">
					
					<div class="col-sm-6 col-lg-3 mb-3">
						<div class="card-box" onclick="location.href='{!! route('payments') !!}'">
							<h5>{{trans('lang.dashboard_total_earnings')}}</h5>
							<h2 id="earnings_count"></h2>
							<i class="mdi mdi-cash-usd"></i>
						</div>
					</div>
					
					<div class="col-sm-6 col-lg-3 mb-3">
						<div class="card-box" onclick="location.href='{!! route('vendors') !!}'">
							<h5>{{trans('lang.dashboard_total_stores')}}</h5>
							<h2 id="vendor_count"></h2>
							<i class="mdi mdi-shopping"></i>
						</div>
					</div>
					
					<div class="col-sm-6 col-lg-3 mb-3">
						<div class="card-box" onclick="location.href='{!! route('orders') !!}'">
							<h5>{{trans('lang.dashboard_total_orders')}}</h5>
							<h2 id="order_count"></h2>
							<i class="mdi mdi-cart"></i>
						</div>
					</div>
					
					<div class="col-sm-6 col-lg-3 mb-3">
						<div class="card-box" onclick="location.href='{!! route('items') !!}'">
							<h5>{{trans('lang.dashboard_total_products')}}</h5>
							<h2 id="product_count"></h2>
							<i class="mdi mdi-buffer"></i>
						</div>
					</div>
					
					<div class="col-sm-6 col-lg-3 mb-3">
						<div class="card-box" onclick="location.href='{!! route('payments') !!}'">
							<h5>{{trans('lang.admin_commission')}}</h5>
							<h2 id="admincommission_count"></h2>
							<i class="ti-wallet"></i>
						</div>
					</div>
					
					<div class="col-sm-6 col-lg-3 mb-3">
						<div class="card-box" onclick="location.href='{!! route('users') !!}'">
							<h5>{{trans('lang.dashboard_total_clients')}}</h5>
							<h2 id="users_count"></h2>
							<i class="mdi mdi-account"></i>
						</div>
					</div>
					
					
					<div class="col-sm-6 col-lg-3 mb-3">
						
					</div>
					
					<div class="col-sm-6 col-lg-3 mb-3">
						
					</div>
					
					
					<div class="col-sm-6 col-lg-3">
						<a class="order-status pending" href="{!! route('orders') !!}">
						<div class="data">
							<i class="mdi mdi-lan-pending"></i>
							<h6 class="status">{{trans('lang.dashboard_order_placed')}}</h6>
						</div> <span class="count" id="placed_count"></span> </a>
					</div>
		
					<div class="col-sm-6 col-lg-3">
						<a class="order-status confirmed" href="{!! route('orders') !!}">
						<div class="data">
							<i class="mdi mdi-check-circle"></i>
							<h6 class="status">{{trans('lang.dashboard_order_confirmed')}}</h6>
						</div> <span class="count" id="confirmed_count"></span> </a>
					</div>
		
					<div class="col-sm-6 col-lg-3">
						<a class="order-status packaging" href="{!! route('orders') !!}">
						<div class="data">
							<i class="mdi mdi-clipboard-outline"></i>
							<h6 class="status">{{trans('lang.dashboard_order_shipped')}}</h6>
						</div> <span class="count" id="shipped_count"></span> </a>
					</div>
		
					<div class="col-sm-6 col-lg-3">
						<a class="order-status delivered" href="{!! route('orders') !!}">	
							<div class="data">
								<i class="mdi mdi-check-circle-outline"></i>
								<h6 class="status">{{trans('lang.dashboard_order_completed')}}</h6>
							</div>
							<span class="count" id="completed_count"></span>
						</a>
					</div>
		
					<div class="col-sm-6 col-lg-3">
						<a class="order-status canceled" href="{!! route('orders') !!}">	
							<div class="data">
								<i class="mdi mdi-window-close"></i>
								<h6 class="status">{{trans('lang.dashboard_order_canceled')}}</h6>
							</div>
							<span class="count" id="canceled_count"></span>
						</a>
					</div>
		
					<div class="col-sm-6 col-lg-3">
						<a class="order-status failed" href="{!! route('orders') !!}">	
							<div class="data">
								<i class="mdi mdi-alert-circle-outline"></i>
								<h6 class="status">{{trans('lang.dashboard_order_failed')}}</h6>
							</div>
							<span class="count" id="failed_count"></span>
						</a>
					</div>
					
				</div>
				
			</div>
			
		</div>
		
		<div class="row pt-3">
			
			<div class="col-lg-4 col-md-4">
				<div class="card">
                    <div class="card-header no-border">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">{{trans('lang.total_sales')}}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="position-relative">
                            <canvas id="sales-chart" height="200"></canvas>
                        </div>

                        <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2"> <i class="fa fa-square" style="color:#2EC7D9"></i> {{trans('lang.dashboard_this_year')}} </span>
                        </div>
                    </div>
                </div>
            </div>
            		
    		<div class="col-lg-4 col-md-4">
                <div class="card">
                	<div class="card-header no-border">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">{{trans('lang.service_overview')}}</h3>
                        </div>
                    </div>
					<div class="card-body">
	                    <div class="flex-row">
							<canvas id="visitors" height="222"></canvas>
	                        
	                    </div>
                    </div>

                </div>

            </div>
    		
            <div class="col-lg-4 col-md-4">
                <div class="card">
                	<div class="card-header no-border">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">{{trans('lang.sales_overview')}}</h3>
                        </div>
                    </div>
					<div class="card-body">
            	        <div class="flex-row">
							<canvas id="commissions" height="222"></canvas>
	                    </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <div class="row daes-sec-sec mb-3">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header no-border d-flex justify-content-between">
                        <h3 class="card-title">{{trans('lang.vendor_plural')}}</h3>
                        <div class="card-tools">
                            <a href="{{route('vendors')}}" class="btn btn-tool btn-sm"><i class="fa fa-bars"></i> </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                            <tr>
                                <th style="text-align:center">{{trans('lang.vendor_image')}}</th>
                                <th>{{trans('lang.vendor')}}</th>
                                <th>{{trans('lang.vendor_review_review')}}</th>
                                <th>{{trans('lang.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody id="append_list">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header no-border d-flex justify-content-between">
                        <h3 class="card-title">{{trans('lang.recent_orders')}}</h3>
                        <div class="card-tools">
                            <a href="{{route('orders')}}" class="btn btn-tool btn-sm"><i class="fa fa-bars"></i> </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                            <tr>
                                <th style="text-align:center">{{trans('lang.order_id')}}</th>
                                <th>{{trans('lang.vendor')}}</th>
                                <th>{{trans('lang.total_amount')}}</th>
                                <th>{{trans('lang.quantity')}}</th>
                            </tr>
                            </thead>
                            <tbody id="append_list_recent_order">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- ============================================================== -->

        <!-- End Right sidebar -->

        <!-- ============================================================== -->

    </div>

    <!-- ============================================================== -->

    <!-- End Container fluid  -->

    <!-- ============================================================== -->

    <!-- ============================================================== -->

    <!-- footer -->

    <!-- ============================================================== -->


    <!-- ============================================================== -->

    <!-- End footer -->

    <!-- ============================================================== -->

</div>

@endsection

@section('scripts')

<script src="{{asset('js/chart.js')}}"></script>
<script src="{{asset('js/highcharts.js')}}"></script>

<script>

	var active_id = "<?php echo @$_REQUEST['id'] ?>";
	setCookie('section_id',active_id, 30);
	var active_type = "<?php echo @$_REQUEST['type'] ?>";
	var db = firebase.firestore();
    var currency = db.collection('settings');

    var currentCurrency = '';
    var currencyAtRight = false;
    var decimal_degits = 0;
    var refCurrency = database.collection('currencies').where('isActive', '==', true);
    refCurrency.get().then(async function (snapshots) {
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;

        if(currencyData.decimal_degits){
            decimal_degits = currencyData.decimal_degits;
        }
    });

    $(document).ready(function () {
    	
    	getSections();
    	
    	db.collection('vendor_orders').where('status', 'in', ["Order Placed", "Order Accepted", "Order Shipped", "Order Completed", "Order Rejected", "Driver Rejected"]).where('vendor.section_id','==',active_id).get().then(
        (snapshot) => {
            jQuery("#order_count").empty();
            jQuery("#order_count").text(snapshot.docs.length);
        });
        
        db.collection('vendor_products').where('section_id','==',active_id).get().then(
        (snapshot) => {
            jQuery("#product_count").empty();
            jQuery("#product_count").text(snapshot.docs.length);
        });
        
    	db.collection('users').where("role", "==", "customer").get().then((snapshot) => {
            jQuery("#users_count").empty();
            jQuery("#users_count").append(snapshot.docs.length);
        });

        db.collection('vendors').where('section_id','==',active_id).get().then((snapshot) => {
            jQuery("#vendor_count").empty();
            jQuery("#vendor_count").text(snapshot.docs.length)
            setVisitors();
        });
        
        getTotalEarnings();
        
        db.collection('vendor_orders').where('status', 'in', ["Order Placed"]).where('vendor.section_id','==',active_id).get().then(
        (snapshot) => {
            jQuery("#placed_count").empty();
            jQuery("#placed_count").text(snapshot.docs.length);
        });
           
        db.collection('vendor_orders').where('status', 'in', ["Order Accepted"]).where('vendor.section_id','==',active_id).get().then(
        (snapshot) => {
            jQuery("#confirmed_count").empty();
            jQuery("#confirmed_count").text(snapshot.docs.length);
        });    
        
        db.collection('vendor_orders').where('status', 'in', ["Order Shipped"]).where('vendor.section_id','==',active_id).get().then(
        (snapshot) => {
            jQuery("#shipped_count").empty();
            jQuery("#shipped_count").text(snapshot.docs.length);
        });    
                
        db.collection('vendor_orders').where('status', 'in', ["Order Completed"]).where('vendor.section_id','==',active_id).get().then(
        (snapshot) => {
            jQuery("#completed_count").empty();
            jQuery("#completed_count").text(snapshot.docs.length);
        }); 
        
        db.collection('vendor_orders').where('status', 'in', ["Order Rejected"]).where('vendor.section_id','==',active_id).get().then(
        (snapshot) => {
            jQuery("#canceled_count").empty();
            jQuery("#canceled_count").text(snapshot.docs.length);
        }); 
        
        db.collection('vendor_orders').where('status', 'in', ["Driver Rejected"]).where('vendor.section_id','==',active_id).get().then(
        (snapshot) => {
            jQuery("#failed_count").empty();
            jQuery("#failed_count").text(snapshot.docs.length);
        });   

        var placeholder = db.collection('settings').doc('placeHolderImage');
        placeholder.get().then(async function (snapshotsimage) {
            var placeholderImageData = snapshotsimage.data();
            placeholderImage = placeholderImageData.image;

        })


        var offest = 1;
        var pagesize = 5;
        var start = null;
        var end = null;
        var endarray = [];
        var inx = parseInt(offest) * parseInt(pagesize);
        var append_listvendors = document.getElementById('append_list');
        append_listvendors.innerHTML = '';

        let ref = db.collection('vendors').where('section_id','==',active_id);
        ref.orderBy('reviewsCount', 'desc').limit(inx).get().then((snapshots) => {
            html = '';
            html = buildHTML(snapshots);
            if (html != '') {
                append_listvendors.innerHTML = html;
                start = snapshots.docs[snapshots.docs.length - 1];
                endarray.push(snapshots.docs[0]);
            }
        });


        var offest = 1;
        var pagesize = 10;
        var start = null;
        var end = null;
        var endarray = [];
        var inx = parseInt(offest) * parseInt(pagesize);
        var append_listrecent_order = document.getElementById('append_list_recent_order');
        append_list.innerHTML = '';

        ref = db.collection('vendor_orders').where('vendor.section_id','==',active_id);
        ref.orderBy('createdAt', 'desc').where('status', 'in', ["Order Placed", "Order Accepted", "Driver Pending", "Driver Accepted", "Order Shipped", "In Transit"]).limit(inx).get().then((snapshots) => {
            html = '';
            html = buildOrderHTML(snapshots);
            if (html != '') {
                append_listrecent_order.innerHTML = html;
                start = snapshots.docs[snapshots.docs.length - 1];
                endarray.push(snapshots.docs[0]);
            }
        });

    })

    async function getTotalEarnings() {
        var intRegex = /^\d+$/;
        var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
        var v01 = 0;
        var v02 = 0;
        var v03 = 0;
        var v04 = 0;
        var v05 = 0;
        var v06 = 0;
        var v07 = 0;
        var v08 = 0;
        var v09 = 0;
        var v10 = 0;
        var v11 = 0;
        var v12 = 0;
        var currentYear = new Date().getFullYear();
        await db.collection('vendor_orders').where('status', 'in', ["Order Completed"]).where('vendor.section_id','==',active_id).get().then(async function (orderSnapshots) {
            var paymentData = orderSnapshots.docs;
            var totalEarning = 0;
            var adminCommission = 0;
            paymentData.forEach((order) => {
                var orderData = order.data();
                var price = 0;
                var minprice = 0;
                orderData.products.forEach((product) => {

                    if (product.price && product.quantity != 0) {
                        var extras_price = 0;
                        if (product.extras_price != undefined && product.extras_price != null) {
                            extras_price = parseFloat(product.extras_price) * parseInt(product.quantity);
                        }
                        if (!isNaN(extras_price)) {
                            var productTotal = (parseFloat(product.price) * parseInt(product.quantity)) + extras_price;
                        } else {
                            var productTotal = (parseFloat(product.price) * parseInt(product.quantity));
                        }
                        if (!isNaN(productTotal)) {
                            price = price + productTotal;
                            minprice = minprice + productTotal;
                        }

                    }
                })

                discount = orderData.discount;
                if ((intRegex.test(discount) || floatRegex.test(discount)) && !isNaN(discount)) {
                    discount = parseFloat(discount).toFixed(decimal_degits);
                    price = price - parseFloat(discount);
                    minprice = minprice - parseFloat(discount);
                }

                tax = 0;
                if (orderData.hasOwnProperty('taxSetting')) {
                    if (orderData.taxSetting.type && orderData.taxSetting.tax) {
                        if (orderData.taxSetting.type == "percent") {
                            tax = (parseFloat(orderData.taxSetting.tax) * minprice) / 100;
                        } else {
                            tax = parseFloat(orderData.taxSetting.tax);
                        }
                    }
                }

                if (!isNaN(tax)) {
                    price = price + tax;
                }
                
                if(orderData.deliveryCharge != undefined && orderData.deliveryCharge != "" && orderData.deliveryCharge > 0){
                	price = price + parseFloat(orderData.deliveryCharge);
                }
                
                if (orderData.adminCommission != undefined && orderData.adminCommissionType != undefined && orderData.adminCommission > 0 && price > 0) {
                    var commission = 0;
                    if (orderData.adminCommissionType == "Percent") {
                        commission = (price * parseFloat(orderData.adminCommission)) / 100;

                    } else {
                        commission = parseFloat(orderData.adminCommission);
                    }

                    adminCommission = commission + adminCommission;
                } else if (orderData.adminCommission != undefined && orderData.adminCommission > 0 && price > 0) {
                    var commission = parseFloat(orderData.adminCommission);
                    adminCommission = commission + adminCommission;
                }
                
                totalEarning = parseFloat(totalEarning) + parseFloat(price);

                try {

                    if (orderData.createdAt) {
                        var orderMonth = orderData.createdAt.toDate().getMonth() + 1;
                        var orderYear = orderData.createdAt.toDate().getFullYear();
                        if (currentYear == orderYear) {
                            switch (parseInt(orderMonth)) {
                                case 1:
                                    v01 = parseInt(v01) + price;
                                    break;
                                case 2:
                                    v02 = parseInt(v02) + price;
                                    break;
                                case 3:
                                    v03 = parseInt(v03) + price;
                                    break;
                                case 4:
                                    v04 = parseInt(v04) + price;
                                    break;
                                case 5:
                                    v05 = parseInt(v05) + price;
                                    break;
                                case 6:
                                    v06 = parseInt(v06) + price;
                                    break;
                                case 7:
                                    v07 = parseInt(v07) + price;
                                    break;
                                case 8:
                                    v08 = parseInt(v08) + price;
                                    break;
                                case 9:
                                    v09 = parseInt(v09) + price;
                                    break;
                                case 10:
                                    v10 = parseInt(v10) + price;
                                    break;
                                case 11:
                                    v11 = parseInt(v11) + price;
                                    break;
                                default :
                                    v12 = parseInt(v12) + price;
                                    break;
                            }
                        }
                    }

                } catch (err) {


                    var datas = new Date(orderData.createdAt._seconds * 1000);

                    var dates = firebase.firestore.Timestamp.fromDate(datas);

                    db.collection('vendor_orders').doc(orderData.id).update({'createdAt': dates}).then(() => {

                        console.log('Provided document has been updated in Firestore');

                    }, (error) => {

                        console.log('Error: ' + error);

                    });

                }


            })

            if (currencyAtRight) {
                totalEarning = parseFloat(totalEarning).toFixed(decimal_degits) + "" + currentCurrency;
                adminCommission = parseFloat(adminCommission).toFixed(decimal_degits) + "" + currentCurrency;
            } else {
                totalEarning = currentCurrency + "" + parseFloat(totalEarning).toFixed(decimal_degits);
                adminCommission = currentCurrency + "" + parseFloat(adminCommission).toFixed(decimal_degits);
            }

            $("#earnings_count").append(totalEarning);
            $("#earnings_count_graph").append(totalEarning);
            $("#admincommission_count_graph").append(adminCommission);
            $("#admincommission_count").append(adminCommission);
            $("#total_earnings_header").text(totalEarning);
            $(".earnings_over_time").append(totalEarning);
            // $("#total_order_dashboard").append(totalEarning);
            var data = [v01, v02, v03, v04, v05, v06, v07, v08, v09, v10, v11, v12];
            var labels = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
            var $salesChart = $('#sales-chart');
            var salesChart = renderChart($salesChart, data, labels);
            setCommision();
        })
        jQuery("#data-table_processing").hide();

    }

    function buildHTML(snapshots) {
        var html = '';
        var count = 1;
        var rating = 0;
        snapshots.docs.forEach((listval) => {
            val = listval.data();
            val.id = listval.id;
            var route = '<?php echo route("vendors.edit", ":id");?>';
            route = route.replace(':id', val.id);

            var routeview = '<?php echo route("vendors.view", ":id");?>';
            routeview = routeview.replace(':id', val.id);

            html = html + '<tr>';
            if (val.photo == '') {

                html = html + '<td class="text-center"><img class="img-circle img-size-32 mr-2" style="width:60px;height:60px;" src="' + placeholderImage + '" alt="image"></td>';
            } else {
                html = html + '<td class="text-center"><img class="img-circle img-size-32 mr-2" style="width:60px;height:60px;" src="' + val.photo + '" alt="image"></td>';
            }

            html = html + '<td data-url="' + routeview + '" class="redirecttopage">' + val.title + '</td>';

            if (val.hasOwnProperty('reviewsCount') && val.reviewsCount != 0) {
                rating = Math.round(parseFloat(val.reviewsSum) / parseInt(val.reviewsCount));
                // rating =Math.round(rating);
            } else {
                rating = 0;
            }

            html = html + '<td><ul class="rating" data-rating="' + rating + '">';
            html = html + '<li class="rating__item"></li>';
            html = html + '<li class="rating__item"></li>';
            html = html + '<li class="rating__item"></li>';
            html = html + '<li class="rating__item"></li>';
            html = html + '<li class="rating__item"></li>';
            html = html + '</ul></td>';
            html = html + '<td><a href="' + route + '" > <span class="fa fa-edit"></span></a></td>';
            html = html + '</tr>';

            rating = 0;
            count++;
        });
        return html;
    }


    function buildDriverHTML(snapshots) {
        var html = '';
        var count = 1;
        snapshots.docs.forEach((listval) => {
            val = listval.data();
            val.id = listval.id;
            var driverroute = '<?php echo route("drivers.edit", ":id");?>';
            driverroute = driverroute.replace(':id', val.id);

            html = html + '<tr>';
            if (val.profilePictureURL == '') {

                html = html + '<td class="text-center"><img class="img-circle img-size-32 mr-2" style="width:60px;height:60px;" src="' + placeholderImage + '" alt="image"></td>';
            } else {
                html = html + '<td class="text-center"><img class="img-circle img-size-32 mr-2" style="width:60px;height:60px;" src="' + val.profilePictureURL + '" alt="image"></td>';
            }
            // html=html+'<td>'+val.firstName+' '+val.lastName+'</td>';
            html = html + '<td data-url="' + driverroute + '" class="redirecttopage">' + val.firstName + ' ' + val.lastName + '</td>';
            html = html + '<td data-url="' + driverroute + '" class="redirecttopage">' + val.orderCompleted + '</td>';
            html = html + '<td data-url="' + driverroute + '" class="redirecttopage"><span class="fa fa-edit"></span></td>';
            html = html + '</tr>';
            count++;
        });
        return html;
    }

    function buildOrderHTML(snapshots) {
        var html = '';
        var count = 1;
        snapshots.docs.forEach((listval) => {
            val = listval.data();
            val.id = listval.id;
            var route = '<?php echo route("orders.edit", ":id"); ?>';
            route = route.replace(':id', val.id);

            var vendorroute = '<?php echo route("vendors.view", ":id");?>';
            vendorroute = vendorroute.replace(':id', val.vendorID);

            html = html + '<tr>';

            html = html + '<td data-url="' + route + '" class="redirecttopage">' + val.id + '</td>';

            var price = 0;
            if (val.deliveryCharge != undefined) {
                price = parseInt(val.deliveryCharge) + price;
            }
            if (val.tip_amount != undefined) {
                price = parseInt(val.tip_amount) + price;
            }

            // val.products.forEach((product)=> {

            //     if(product.price && product.quantity != 0){
            //         var productTotal = parseInt(product.price)*parseInt(product.quantity);

            //         price = price + productTotal;
            //         console.log('price'+ price);
            //         if(currencyAtRight){
            //             price = price+""+currentCurrency;
            //         }else{
            //             price = currentCurrency+""+price;
            //         }

            //     }
            // })

            html = html + '<td data-url="' + vendorroute + '" class="redirecttopage">' + val.vendor.title + '</td>';

            var price = buildHTMLProductstotal(val);

            html = html + '<td data-url="' + route + '" class="redirecttopage">' + price + '</td>';
            html = html + '<td data-url="' + route + '" class="redirecttopage"><i class="fa fa-shopping-cart"></i> ' + val.products.length + '</td>';
            html = html + '</a></tr>';
            count++;
        });
        return html;
    }


    function renderChart(chartNode, data, labels) {
        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        };

        var mode = 'index';
        var intersect = true;
        return new Chart(chartNode, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        backgroundColor: '#2EC7D9',
                        borderColor: '#2EC7D9',
                        data: data
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        // display: false,
                        gridLines: {
                            display: true,
                            lineWidth: '4px',
                            color: 'rgba(0, 0, 0, .2)',
                            zeroLineColor: 'transparent'
                        },
                        ticks: $.extend({
                            beginAtZero: true,
                            callback: function (value, index, values) {
                                return currentCurrency + value.toFixed(decimal_degits);
                            }


                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: false
                        },
                        ticks: ticksStyle
                    }]
                }
            }
        })
    }

    $(document).ready(function () {
        $(document.body).on('click', '.redirecttopage', function () {
            var url = $(this).attr('data-url');
            window.location.href = url;
        });
    });


    function buildHTMLProductstotal(snapshotsProducts) {

        var adminCommission = snapshotsProducts.adminCommission;
        var discount = snapshotsProducts.discount;
        var couponCode = snapshotsProducts.couponCode;
        var extras = snapshotsProducts.extras;
        var extras_price = snapshotsProducts.extras_price;
        var rejectedByDrivers = snapshotsProducts.rejectedByDrivers;
        var takeAway = snapshotsProducts.takeAway;
        var tip_amount = snapshotsProducts.tip_amount;
        var status = snapshotsProducts.status;
        var products = snapshotsProducts.products;
        var deliveryCharge = snapshotsProducts.deliveryCharge;
        var totalProductPrice = 0;
        var total_price = 0;

        var intRegex = /^\d+$/;
        var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;

        if (products) {

            products.forEach((product) => {

                var val = product;

                price_item = parseFloat(val.price).toFixed(decimal_degits);
                extras_price_item = (parseFloat(val.extras_price) * parseInt(val.quantity)).toFixed(decimal_degits);

                totalProductPrice = parseFloat(price_item) * parseInt(val.quantity);
                var extras_price = 0;
                if (parseFloat(extras_price_item) != NaN && val.extras_price != undefined) {
                    extras_price = extras_price_item;
                }
                totalProductPrice = parseFloat(extras_price) + parseFloat(totalProductPrice);
                totalProductPrice = parseFloat(totalProductPrice).toFixed(decimal_degits);

                total_price += parseFloat(totalProductPrice);

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

        }

        if (intRegex.test(deliveryCharge) || floatRegex.test(deliveryCharge)) {

            deliveryCharge = parseFloat(deliveryCharge).toFixed(decimal_degits);
            total_price += parseFloat(deliveryCharge);

            if (currencyAtRight) {
                deliveryCharge_val = deliveryCharge + "" + currentCurrency;
            } else {
                deliveryCharge_val = currentCurrency + "" + deliveryCharge;
            }
        }


        if (intRegex.test(tip_amount) || floatRegex.test(tip_amount)) {

            tip_amount = parseFloat(tip_amount).toFixed(decimal_degits);
            total_price += parseFloat(tip_amount);
            total_price = parseFloat(total_price).toFixed(decimal_degits);

            if (currencyAtRight) {
                tip_amount_val = tip_amount + "" + currentCurrency;
            } else {
                tip_amount_val = currentCurrency + "" + tip_amount;
            }
        }

        if (currencyAtRight) {
            var total_price_val = total_price + "" + currentCurrency;
        } else {
            var total_price_val = currentCurrency + "" + total_price;
        }


        return total_price_val;
    }
    
    async function getSections(){
		database.collection('sections').where('isActive','==',true).get().then(async function (sectionsSnapshot) {
			sections = document.getElementById('sections');
			sections.innerHTML = '';
			sectionshtml = buildHTMLSections(sectionsSnapshot);
			sections.innerHTML = sectionshtml;
		})
	}
	
    function buildHTMLSections(sectionsSnapshot) {
        var html = '';
        var alldata = [];
        sectionsSnapshot.docs.forEach((listval) => {
            var datas = listval.data();
            datas.id=listval.id;
            alldata.push(datas);
        });
		
		var all_route = "{{ route('dashboard')}}";
        var img_url = "{{asset('images/shopping_cart.png')}}";
         var active_section = ''
        if(active_id == ''){
        	active_section = 'section-selected';
        }
        html = html + '<div class="cat-item px-2 py-1 select_section '+active_section+'"><a href="'+all_route+'" class="bg-white d-block p-2 text-center shadow-sm cat-link"><img alt="#" src="'+img_url+'" class="img-fluid mb-2"><p class="m-0 small">All</p></a></div>';
        
        alldata.forEach((listval) => {
            var val = listval;
            var section_id = val.id;

            if (val.sectionImage) {
                photo = val.sectionImage;
            } else {
                photo = placeholderImageSrc;
            }
            
            var active_section = '';
            if(active_id != undefined && active_id == section_id){
            	active_section = 'section-selected';
            }
            
            var section_route = "{{ route('dashboard')}}?id="+val.id+"&type="+val.serviceTypeFlag;
            
            html = html + '<div class="cat-item px-2 py-1 select_section '+active_section+'"><a href="'+section_route+'" class="bg-white d-block p-2 text-center shadow-sm cat-link"><img alt="#" src="' + photo + '" class="img-fluid mb-2"><p class="m-0 small">' + val.name + '</p></a></div>';
        });
        return html;
    }
	
	function setVisitors(){
    	
    	const data = {
		  labels: [
		    "{{trans('lang.dashboard_total_stores')}}",
		    "{{trans('lang.dashboard_total_orders')}}",
		    "{{trans('lang.dashboard_total_products')}}",
		    "{{trans('lang.dashboard_total_clients')}}",
		  ],
		  datasets: [{
		    data: [jQuery("#vendor_count").text(), jQuery("#order_count").text(), jQuery("#product_count").text(), jQuery("#users_count").text()],
		    backgroundColor: [
		      '#218be1',
		      '#B1DB6F',
		      '#7360ed',
		      '#FFAB2E',
		    ],
		    hoverOffset: 4
		  }]
		};

        return new Chart('visitors',{
            type: 'doughnut',
            data: data,
            options: {
            	maintainAspectRatio: false,
            }
        })
    }
    
    function setCommision(){
    	
    	const data = {
		  labels: [
		    "{{trans('lang.dashboard_total_earnings')}}",
		    "{{trans('lang.admin_commission')}}"
		  ],
		  datasets: [{
		    data: [jQuery("#earnings_count").text().replace(currentCurrency,""), jQuery("#admincommission_count").text().replace(currentCurrency,"")],
		    backgroundColor: [
		      '#feb84d',
		      '#9b77f8',
		      '#fe95d3'
		    ],
		    hoverOffset: 4
		  }]
		};
        return new Chart('commissions',{
            type: 'doughnut',
            data: data,
            options: {
            	maintainAspectRatio: false,
        		tooltips: {
		            callbacks: {
		                label: function(tooltipItems, data) {
		                	return data.labels[tooltipItems.index] +': '+ currentCurrency + data.datasets[0].data[tooltipItems.index];
		                }
		           }
			   }
			}
        })
    }
    
</script>
@endsection

