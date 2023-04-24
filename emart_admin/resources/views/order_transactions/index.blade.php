@extends('layouts.app')


<?php

error_reporting(E_ALL ^ E_NOTICE);
?>

@section('content')
<div class="page-wrapper">


    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">{{trans('lang.order_transaction_table')}}</h3>

        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.order_transaction_table')}}</li>
            </ol>
        </div>

        <div>

        </div>

    </div>


    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                            <li class="nav-item">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i
                                            class="fa fa-list mr-2"></i>{{trans('lang.order_transaction_table')}}
                                </a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                             style="display: none;">{{trans('lang.processing')}}
                        </div>

                        <div id="users-table_filter" class="pull-right"><label>{{trans('lang.search_by')}}
                                <select name="selected_search" id="selected_search" class="form-control input-sm">
                                    <option value="">{{ trans('lang.select')}}</option>
                                    <?php if (str_contains($id, 'vendorId') != 1) { ?>
                                        <option value="vendor">{{ trans('lang.vendor')}}</option>
                                    <?php }
                                    if (str_contains($id, 'driverId') != 1) { ?>?>
                                        <option value="driver">{{ trans('lang.driver')}}</option>
                                    <?php } ?>


                                </select>
                                <div class="form-group">
                                    <input type="search" id="search" class="search form-control"
                                           placeholder="Search" aria-controls="users-table">
                            </label>&nbsp;<button onclick="searchtext();"
                                                  class="btn btn-warning btn-flat">{{trans('lang.search')}}
                            </button>&nbsp;<button
                                    onclick="searchclear();"
                                    class="btn btn-warning btn-flat">{{trans('lang.clear')}}
                            </button>
                        </div>
                    </div>


                    <div class="table-responsive m-t-10">


                        <table id="example24"
                               class="display nowrap table table-hover table-striped table-bordered table table-striped"
                               cellspacing="0" width="100%">

                            <thead>

                            <tr>
                                <th>{{ trans('lang.order_id')}}</th>
                                <th>{{ trans('lang.driver')}}</th>
                                <th>{{trans('lang.amount')}}</th>
                                <th>{{ trans('lang.vendor')}}</th>
                                <th>{{trans('lang.amount')}}</th>
                                <th>{{trans('lang.date')}}</th>
                                <th>{{trans('lang.order_order_status_id')}}</th>
                            </tr>

                            </thead>

                            <tbody id="append_list1">


                            </tbody>

                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item ">
                                    <a class="page-link" href="javascript:void(0);" id="users_table_previous_btn"
                                       onclick="prev()" data-dt-idx="0" tabindex="0">{{trans('lang.previous')}}</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="javascript:void(0);" id="users_table_next_btn"
                                       onclick="next()" data-dt-idx="2" tabindex="0">{{trans('lang.next')}}</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</div>

</div>
</div>


@endsection


@section('scripts')
<script>

    var database = firebase.firestore();
    var offest = 1;
    var pagesize = 10;
    var end = null;
    var endarray = [];
    var start = null;
    var user_number = [];
    //var ref = database.collection('users').where('role','==','user');
    //var ref = database.collection('wallet').orderBy('date', 'desc');
    var refData = database.collection('order_transactions');
    var search = jQuery("#search").val();

    $(document.body).on('keyup', '#search', function () {
        search = jQuery(this).val();
        // console.log('search '+search);
    });

    <?php if($id != ''){ ?>

    var actionId = '<?php echo $id; ?>';
    actionId = actionId.split('=')[1];

    if (window.location.href.indexOf("vendorId") > -1) {
        if (search != '') {

            ref = refData.where('vendorId', '==', actionId);
        } else {

            ref = refData.orderBy('date', 'desc').where('vendorId', '==', actionId);
        }

    } else if (window.location.href.indexOf("driverId") > -1) {

        if (search != '') {

            ref = refData.where('driverId', '==', actionId);
        } else {

            ref = refData.orderBy('date', 'desc').where('driverId', '==', actionId);
        }
    }


    <?php }
    else{ ?>

    if (search != '') {
        // console.log('ref 3 '+vendor_id);
        ref = refData;
    } else {
        // console.log('ref 4 '+vendor_id);
        ref = refData.orderBy('date', 'desc');
    }

    //refData = database.collection('vendor_orders');
    // ref = refData.orderBy('createdAt', 'desc');

    <?php } ?>

    var append_list = '';

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

        $(document.body).on('click', '.redirecttopage', function () {
            var url = $(this).attr('data-url');
            window.location.href = url;
        });

        var inx = parseInt(offest) * parseInt(pagesize);
        jQuery("#data-table_processing").show();

        append_list = document.getElementById('append_list1');
        append_list.innerHTML = '';

        ref.limit(pagesize).get().then(async function (snapshots) {
            html = '';

            html = buildHTML(snapshots);

            if (html != '') {
                append_list.innerHTML = html;
                start = snapshots.docs[snapshots.docs.length - 1];
                endarray.push(snapshots.docs[0]);
                if (snapshots.docs.length < pagesize) {
                    jQuery("#data-table_paginate").hide();
                }
            }
            jQuery("#data-table_processing").hide();
        });

    });


    function buildHTML(snapshots) {
        var html = '';
        var alldata = [];
        var number = [];
        snapshots.docs.forEach((listval) => {
            var datas = listval.data();
            console.log(datas);
            datas.id = listval.id;
            alldata.push(datas);
        });


        alldata.forEach((listval) => {

            var val = listval;

            var route1 = '{{route("users.edit",":id")}}';
            route1 = route1.replace(':id', val.id);
            html = html + '<tr>';

            var order_detail = '{{route("orders.edit",":id")}}';
            order_detail = order_detail.replace(':id', val.order_id);


            html = html + '<td data-url="' + order_detail + '" class="redirecttopage" >' + val.order_id + '</td>';
            if (val.driverId != undefined) {
                const driverName = driverFunction(val.driverId);
                html = html + '<td class="driver_' + val.driverId + ' redirecttopage" ></td>';

            } else {
                html = html + '<td></td>';

            }

            var driverAmount = 0;
            if (val.driverAmount) {
                driverAmount = val.driverAmount;
            }
            if (currencyAtRight) {
                html = html + '<td>' + parseFloat(driverAmount).toFixed(decimal_degits) + '' + currentCurrency + '</td>';
            } else {
                html = html + '<td>' + currentCurrency + '' + parseFloat(driverAmount).toFixed(decimal_degits) + '</td>';
            }

            const vendorName = vendorFunction(val.vendorId);
            html = html + '<td class="vendor_' + val.vendorId + ' redirecttopage" ></td>';

            var vendorAmount = 0;

            if (val.vendorAmount) {
                vendorAmount = val.vendorAmount;
            }
            if (currencyAtRight) {
                html = html + '<td>' + parseFloat(vendorAmount).toFixed(decimal_degits) + '' + currentCurrency + '</td>';
            } else {
                html = html + '<td>' + currentCurrency + '' + parseFloat(vendorAmount).toFixed(decimal_degits) + '</td>';
            }


            var date = "";
            var time = "";
            try {
                if (val.hasOwnProperty("date")) {
                    date = val.date.toDate().toDateString();
                    time = val.date.toDate().toLocaleTimeString('en-US');
                }
            } catch (err) {

            }

            html = html + '<td>' + date + ' ' + time + '</td>';

            const orderStatus = orderFunction(val.order_id);
            html = html + '<td class="order_' + val.order_id + '"></td>';


            html = html + '</tr>';

        });
        return html;
    }

    function prev() {
        if (endarray.length == 1) {
            return false;
        }
        end = endarray[endarray.length - 2];

        if (end != undefined || end != null) {
            jQuery("#data-table_processing").show();


            if (jQuery("#selected_search").val() == 'vendor' && jQuery("#search").val().trim() != '') {
                listener = refData.orderBy('val.vendorId').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAt(end).get();
            } else if (jQuery("#selected_search").val() == 'driver' && jQuery("#search").val().trim() != '') {
                listener = refData.orderBy('val.driverId').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAt(end).get();

            } else {
                listener = ref.startAt(end).limit(pagesize).get();
            }

            listener.then((snapshots) => {
                html = '';
                html = buildHTML(snapshots);
                jQuery("#data-table_processing").hide();
                if (html != '') {
                    append_list.innerHTML = html;
                    start = snapshots.docs[snapshots.docs.length - 1];
                    endarray.splice(endarray.indexOf(endarray[endarray.length - 1]), 1);

                    if (snapshots.docs.length < pagesize) {

                        jQuery("#users_table_previous_btn").hide();
                    }

                }
            });
        }
    }

    function next() {
        if (start != undefined || start != null) {

            jQuery("#data-table_processing").hide();

            if (jQuery("#selected_search").val() == 'vendor' && jQuery("#search").val().trim() != '') {

                listener = refData.orderBy('val.vendorId').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAfter(start).get();
            } else if (jQuery("#selected_search").val() == 'driver' && jQuery("#search").val().trim() != '') {

                listener = ref.orderBy('val.driverId').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();


            } else {
                listener = ref.startAfter(start).limit(pagesize).get();
            }
            listener.then((snapshots) => {

                html = '';
                html = buildHTML(snapshots);
                console.log(snapshots);
                jQuery("#data-table_processing").hide();
                if (html != '') {
                    append_list.innerHTML = html;
                    start = snapshots.docs[snapshots.docs.length - 1];


                    if (endarray.indexOf(snapshots.docs[0]) != -1) {
                        endarray.splice(endarray.indexOf(snapshots.docs[0]), 1);
                    }
                    endarray.push(snapshots.docs[0]);
                }
            });
        }
    }

    function searchclear() {
        jQuery("#search").val('');
        searchtext();
    }


    function searchtext() {

        /* var offest=1;
                  var pagesize=10;
                  var start = null;
                  var end = null;
                  var endarray=[];
                  var inx= parseInt(offest) * parseInt(pagesize); */
        jQuery("#data-table_processing").show();

        append_list.innerHTML = '';

        if (jQuery("#selected_search").val() == 'vendor' && jQuery("#search").val().trim() != '') {

            var vendors = database.collection('vendors').orderBy('title').startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();

            vendors.then((snapshots) => {

                if (snapshots.docs.length > 0) {
                    snapshots.docs.forEach((listval) => {

                        var datas = listval.data();

                        vendorId = datas.id;

                        if (window.location.href.indexOf("driverId") > -1) {
                            wherequery = refData.where('driverId', '==', actionId).orderBy('vendorId').limit(pagesize).startAt(vendorId).endAt(vendorId + '\uf8ff').get();

                        } else {
                            wherequery = refData.orderBy('vendorId').limit(pagesize).startAt(vendorId).endAt(vendorId + '\uf8ff').get();
                        }
                        wherequery.then((snapshots) => {
                            html = '';
                            html = buildHTML(snapshots);
                            jQuery("#data-table_processing").hide();
                            if (html != '') {
                                append_list.innerHTML = html;
                                start = snapshots.docs[snapshots.docs.length - 1];
                                endarray.push(snapshots.docs[0]);
                                /*if(snapshots.docs.length<pagesize && jQuery("#selected_search").val().trim()!='' && jQuery("#search").val().trim()!=''){*/
                                if (snapshots.docs.length < pagesize) {

                                    jQuery("#data-table_paginate").hide();
                                } else {

                                    jQuery("#data-table_paginate").show();
                                }
                            }
                        });


                    });
                } else {
                    jQuery("#data-table_processing").hide();
                }
            });

        } else if (jQuery("#selected_search").val() == 'driver' && jQuery("#search").val().trim() != '') {

            var vendors = database.collection('users').orderBy('firstName').startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();

            vendors.then((snapshots) => {

                if (snapshots.docs.length > 0) {
                    snapshots.docs.forEach((listval) => {

                        var datas = listval.data();

                        driverId = datas.id;

                        if (window.location.href.indexOf("vendorId") > -1) {
                            wherequery = refData.where('vendorId', '==', actionId).orderBy('driverId').limit(pagesize).startAt(driverId).endAt(driverId + '\uf8ff').get();

                        } else {
                            wherequery = refData.orderBy('driverId').limit(pagesize).startAt(driverId).endAt(driverId + '\uf8ff').get();
                        }
                        wherequery.then((snapshots) => {
                            html = '';
                            html = buildHTML(snapshots);
                            jQuery("#data-table_processing").hide();
                            if (html != '') {
                                append_list.innerHTML = html;
                                start = snapshots.docs[snapshots.docs.length - 1];
                                endarray.push(snapshots.docs[0]);
                                /*if(snapshots.docs.length<pagesize && jQuery("#selected_search").val().trim()!='' && jQuery("#search").val().trim()!=''){*/
                                if (snapshots.docs.length < pagesize) {

                                    jQuery("#data-table_paginate").hide();
                                } else {

                                    jQuery("#data-table_paginate").show();
                                }
                            }
                        });


                    });
                } else {
                    jQuery("#data-table_processing").hide();
                }
            });

        } else {

            wherequery = ref.limit(pagesize).get();
            wherequery.then((snapshots) => {
                html = '';
                html = buildHTML(snapshots);
                jQuery("#data-table_processing").hide();
                if (html != '') {
                    append_list.innerHTML = html;
                    start = snapshots.docs[snapshots.docs.length - 1];
                    endarray.push(snapshots.docs[0]);
                    /*if(snapshots.docs.length<pagesize && jQuery("#selected_search").val().trim()!='' && jQuery("#search").val().trim()!=''){*/
                    if (snapshots.docs.length < pagesize) {

                        jQuery("#data-table_paginate").hide();
                    } else {

                        jQuery("#data-table_paginate").show();
                    }
                }
            });

        }


    }


    async function driverFunction(driverId) {

        var driverName = '';
        var routeuser = '{{route("drivers.edit",":id")}}';
        routeuser = routeuser.replace(':id', driverId);
        await database.collection('users').where("id", "==", driverId).get().then(async function (snapshotss) {

            if (snapshotss.docs[0]) {
                var user_data = snapshotss.docs[0].data();
                payoutuser = user_data.firstName + " " + user_data.lastName;
                jQuery(".driver_" + driverId).attr("data-url", routeuser).html(payoutuser);
            } else {
                jQuery(".driver_" + driverId).attr("data-url", routeuser).html('');
            }
        });
        return driverName;
    }

    async function vendorFunction(vendorId) {

        var driverName = '';
        var routeuser = '{{route("vendors.edit",":id")}}';
        routeuser = routeuser.replace(':id', vendorId);
        await database.collection('vendors').where("id", "==", vendorId).get().then(async function (snapshotss) {

            if (snapshotss.docs[0]) {
                var user_data = snapshotss.docs[0].data();
                payoutuser = user_data.title;
                jQuery(".vendor_" + vendorId).attr("data-url", routeuser).html(payoutuser);
            } else {
                jQuery(".vendor_" + vendorId).attr("data-url", routeuser).html('');
            }
        });
        return driverName;
    }

    async function orderFunction(orderId) {


        await database.collection('vendor_orders').where("id", "==", orderId).get().then(async function (snapshotss) {

            if (snapshotss.docs[0]) {
                var user_data = snapshotss.docs[0].data();
                payoutuser = user_data.status;
                jQuery(".order_" + orderId).html(payoutuser);
            } else {
                jQuery(".order_" + orderId).html('');
            }
        });

    }


</script>


@endsection
