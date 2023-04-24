@extends('layouts.app')

<?php

error_reporting(E_ALL ^ E_NOTICE);
?>


@section('content')
<div id="main-wrapper" class="page-wrapper" style="min-height: 207px;">


    <!-- ============================================================== -->

    <!-- Bread crumb and right sidebar toggle -->

    <!-- ============================================================== -->

    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">{{trans('lang.earning')}} : <span id="total_earnings_header"></span></h3>

        </div>

        <div class="col-md-7 align-self-center">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="javascript:void(0)">{{trans('lang.dashboard')}}</a></li>

                <li class="breadcrumb-item active">{{trans('lang.dashboard')}}</li>

            </ol>

        </div>

        <div>


        </div>

    </div>

    <!-- ============================================================== -->

    <!-- End Bread crumb and right sidebar toggle -->

    <!-- ============================================================== -->

    <!-- ============================================================== -->

    <!-- Container fluid  -->

    <!-- ============================================================== -->

    <div class="container-fluid">

        <div class="row daes-top-sec">

            <div class="col-lg-4 col-md-6">

                <div class="card">

                    <div class="flex-row">

                        <div class="p-10 bg-info col-md-12 text-center">

                            <h3 class="text-white box m-b-0"><i class="mdi mdi-cart"></i></h3>
                        </div>

                        <div class="align-self-center pt-3 col-md-12 text-center">

                            <h3 class="m-b-0 text-info" id="order_count">0</h3>

                            <h5 class="text-muted m-b-0">{{trans('lang.dashboard_total_orders')}}</h5>
                            <a href="{!! route('orders') !!}" class="small-box-footer">{{trans('lang.dashboard_more_info')}}
                                <i class="fa fa-arrow-circle-right"></i></a>
                        </div>

                    </div>

                </div>

            </div>

            <!-- Column -->

            <div class="col-lg-4 col-md-6">

                <div class="card">

                    <div class="flex-row">

                        <div class="p-10 bg-info col-md-12 text-center">

                            <h3 class="text-white box m-b-0"><i class="mdi mdi-bank"></i></h3></div>

                        <div class="align-self-center pt-3 col-md-12 text-center">

                            <h3 class="m-b-0 text-info" id="earnings_count">0</h3>

                            <h5 class="text-muted m-b-0">{{trans('lang.dashboard_total_earnings')}} <span
                                        style="font-size: 11px">({{trans('lang.dashboard_after taxes')}})</span></h5>
                            <a href="{!! route('payments') !!}" class="small-box-footer">{{trans('lang.dashboard_more_info')}}
                                <i class="fa fa-arrow-circle-right"></i></a>
                        </div>

                    </div>

                </div>

            </div>


            <!-- Column -->

            <div class="col-lg-4 col-md-6">

                <div class="card">

                    <div class="flex-row">

                        <div class="p-10 bg-info col-md-12 text-center">

                            <h3 class="text-white box m-b-0"><i class="ti-wallet"></i></h3></div>

                        <div class="align-self-center pt-3 col-md-12 text-center">

                            <h3 class="m-b-0 text-info" id="admincommission_count">0</h3>

                            <h5 class="text-muted m-b-0">{{trans('lang.admin_commission')}}</h5>
                            <a href="{{route('payments')}}" class="small-box-footer">{{trans('lang.dashboard_more_info')}}
                                <i class="fa fa-arrow-circle-right"></i></a>
                        </div>

                    </div>

                </div>

            </div>


            <!-- Column -->


            <!-- Column -->

        </div>

        <div class="row daes-top-sec">

            <!-- Column -->


        </div>


        <div class="row daes-sec-sec">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header no-border">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="card-title">{{trans('lang.earning_plural')}}</h3>
                                <span class="bellow-text">
                                <ul>
                                    <li>
                                         <label>{{trans('lang.total_sell')}}:</label><span
                                                id="earnings_count_graph"></span>
                                    </li>
                                    <li>
                                         <label>{{trans('lang.admin_commission')}}:</label><span
                                                id="admincommission_count_graph"></span>
                                    </li>
                                </ul>
                            </span>
                            </div>

                            <a href="{{route('payments')}}">{{trans('lang.dashboard_view_all_payments')}}</a>
                        </div>
                    </div>
                    <div class="card-body">


                        <div class="position-relative mb-4">
                            <canvas id="sales-chart" height="200"></canvas>
                        </div>

                        <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2"> <i class="fa fa-square text-primary"></i> {{trans('lang.dashboard_this_year')}} </span>
                        </div>
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
                                <th>{{trans('lang.order_order_status_id')}}</th>
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

        <div class="row daes-sec-sec pt-3">


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
<script>


    var db = firebase.firestore();
    var currency = db.collection('settings');

    var currentCurrency = '';
    var currencyAtRight = false;
    var decimal_degits = 0;

    var refCurrency = db.collection('currencies').where('isActive', '==', true);
    refCurrency.get().then(async function (snapshots) {
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;

        if (currencyData.decimal_degits) {
            decimal_degits = currencyData.decimal_degits;
        }
    });
   
    var vendorUserId = "<?php echo $id; ?>";
    var vendorId = '';
    getVendorId(vendorUserId).then(data => {
        vendorId = data;

        $(document).ready(function () {
           
            jQuery("#data-table_processing").show();
            getTotalEarnings();
            db.collection('vendor_orders').where('vendorID', "==", vendorId).get().then(
                (snapshot) => {
                    jQuery("#order_count").empty();
                    jQuery("#order_count").text(snapshot.docs.length);
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

            var offest = 1;
            var pagesize = 10;
            var start = null;
            var end = null;
            var endarray = [];
            var inx = parseInt(offest) * parseInt(pagesize);
            var append_listrecent_order = document.getElementById('append_list_recent_order');
            // append_list.innerHTML='';

            ref = db.collection('vendor_orders');
            ref.orderBy('createdAt', 'desc').where('status', 'in', ["Order Placed", "Order Accepted", "Driver Pending", "Driver Accepted", "Order Shipped", "In Transit"]).where('vendorID', "==", vendorId).limit(inx).get().then((snapshots) => {
                html = '';
                html = buildOrderHTML(snapshots);
                if (html != '') {
                    append_listrecent_order.innerHTML = html;
                    start = snapshots.docs[snapshots.docs.length - 1];
                    endarray.push(snapshots.docs[0]);
                }
            });

            var offest = 1;
            var pagesize = 5;
            var start = null;
            var end = null;
            var endarray = [];
            var inx = parseInt(offest) * parseInt(pagesize);
        })

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
        await db.collection('vendor_orders').where('status', 'in', ["Order Completed"]).where('vendorID', "==", vendorId).get().then(async function (orderSnapshots) {
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


                if (orderData.adminCommission != undefined && orderData.adminCommissionType != undefined && orderData.adminCommission > 0 && minprice > 0) {
                    var commission = 0;
                    if (orderData.adminCommissionType == "Percent") {
                        commission = (minprice * parseFloat(orderData.adminCommission)) / 100;

                    } else {
                        commission = parseFloat(orderData.adminCommission);
                    }

                    adminCommission = commission + adminCommission;
                } else if (orderData.adminCommission != undefined && orderData.adminCommission > 0 && minprice > 0) {
                    var commission = parseFloat(orderData.adminCommission);
                    adminCommission = commission + adminCommission;
                }

                tax = 0;
                if (orderData.hasOwnProperty('taxSetting')) {
                    if (orderData.taxSetting.type && orderData.taxSetting.tax) {
                        if (orderData.taxSetting.type == "percent") {
                            tax = (orderData.taxSetting.tax * minprice) / 100;
                        } else {
                            tax = orderData.taxSetting.tax;
                        }
                    }
                }

                if (!isNaN(tax)) {
                    price = price + tax;
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

                }


            })

            if (currencyAtRight) {
                totalEarning = parseFloat(totalEarning).toFixed(decimal_degits) + "" + currentCurrency;
                adminCommission = parseFloat(adminCommission).toFixed(decimal_degits) + "" + currentCurrency;
            } else {
                totalEarning = currentCurrency + "" + parseFloat(totalEarning).toFixed(decimal_degits);
                adminCommission = currentCurrency + "" + parseFloat(adminCommission).toFixed(decimal_degits);
            }

            $("#earnings_count").text(totalEarning);
            $("#earnings_count_graph").text(totalEarning);
            $("#admincommission_count_graph").text(adminCommission);
            $("#admincommission_count").text(adminCommission);
            $("#total_earnings_header").text(totalEarning);
            $(".earnings_over_time").text(totalEarning);
            // $("#total_order_dashboard").append(totalEarning);
            var data = [v01, v02, v03, v04, v05, v06, v07, v08, v09, v10, v11, v12];
            var labels = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
            var $salesChart = $('#sales-chart');
            var salesChart = renderChart($salesChart, data, labels);
        })
        jQuery("#data-table_processing").hide();

    }

    function buildOrderHTML(snapshots) {
        var html = '';
        var count = 1;
        snapshots.docs.forEach((listval) => {
            val = listval.data();
            val.id = listval.id;
            var route = '<?php echo route("orders.edit", ":id"); ?>';
            route = route.replace(':id', val.id);


            html = html + '<tr>';

            html = html + '<td data-url="' + route + '" class="redirecttopage">' + val.id + '</td>';
            html = html + '<td data-url="' + route + '" class="redirecttopage">' + val.status + '</td>';

            var price = 0;
            if (val.deliveryCharge != undefined) {
                price = parseInt(val.deliveryCharge) + price;
            }
            if (val.tip_amount != undefined) {
                price = parseInt(val.tip_amount) + price;
            }
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
                        backgroundColor: '#007bff',
                        borderColor: '#007bff',
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
                                return '$' + value;
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

        tax = 0;
        if (snapshotsProducts.hasOwnProperty('taxSetting')) {
            if (snapshotsProducts.taxSetting.type && snapshotsProducts.taxSetting.tax) {
                if (snapshotsProducts.taxSetting.type == "percent") {
                    tax = (snapshotsProducts.taxSetting.tax * total_price) / 100;
                } else {
                    tax = snapshotsProducts.taxSetting.tax;
                }
            }
        }

        if (!isNaN(tax)) {
            total_price = total_price + tax;
        }


        if ((intRegex.test(deliveryCharge) || floatRegex.test(deliveryCharge)) && !isNaN(deliveryCharge)) {

            deliveryCharge = parseFloat(deliveryCharge).toFixed(decimal_degits);
            total_price += parseFloat(deliveryCharge);

            if (currencyAtRight) {
                deliveryCharge_val = deliveryCharge + "" + currentCurrency;
            } else {
                deliveryCharge_val = currentCurrency + "" + deliveryCharge;
            }
        }


        if (intRegex.test(tip_amount) || floatRegex.test(tip_amount) && !isNaN(tip_amount)) {

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
            var total_price_val = parseFloat(total_price).toFixed(decimal_degits) + "" + currentCurrency;
        } else {
            var total_price_val = currentCurrency + "" + parseFloat(total_price).toFixed(decimal_degits);
        }


        return total_price_val;
    }


    async function getVendorId(vendorUser) {
        var vendorId = '';
        try {
            var ref;
            await db.collection('vendors').where('author', "==", vendorUser).get().then(async function (vendorSnapshots) {
                var vendorData = vendorSnapshots.docs[0].data();
                vendorId = vendorData.id;
            });
        } catch (error) {

        }

        return vendorId;
    }

</script>
@endsection

