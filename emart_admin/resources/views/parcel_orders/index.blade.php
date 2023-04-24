@extends('layouts.app')

<?php

error_reporting(E_ALL ^ E_NOTICE);
?>

@section('content')
<div class="page-wrapper">


    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">{{trans('lang.parcel_plural')}} {{trans('lang.order_plural')}}</h3>

        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.parcel_plural')}} {{trans('lang.order_plural')}}</li>
            </ol>
        </div>

        <div>

        </div>

    </div>


    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="card">

                    <div class="card-body">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                             style="display: none;">{{ trans('lang.processing')}}
                        </div>
                        <!-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> -->
                        <div id="users-table_filter" class="pull-right">
                            <label>{{trans('lang.search_by')}}
                                <select name="selected_search" id="selected_search" class="form-control input-sm">
                                    <option value="status">{{trans('lang.order_order_status_id')}}</option>
                                    <option value="id">{{trans('lang.order_id')}}</option>

                                </select>
                            </label>&nbsp;
                            <div class="form-group">
                                <!-- <div id="selected_change"> -->

                                <select id="order_status" class="form-control">
                                    <option value="All">{{ trans('lang.all')}}</option>
                                    <option value="Order Placed">{{ trans('lang.order_placed')}}</option>
                                    <option value="Order Accepted">{{ trans('lang.order_accepted')}}</option>
                                    <option value="Order Rejected">{{ trans('lang.order_rejected')}}</option>
                                    <option value="Driver Pending">{{ trans('lang.driver_pending')}}</option>
                                    <option value="Driver Rejected">{{ trans('lang.driver_rejected')}}</option>
                                    <option value="Order Shipped">{{ trans('lang.order_shipped')}}</option>
                                    <option value="In Transit">{{ trans('lang.in_transit')}}</option>
                                    <option value="Order Completed">{{ trans('lang.order_completed')}}</option>
                                </select>
                                <input type="search" id="search" class="search form-control" placeholder="Search"
                                       aria-controls="users-table" style="display:none">

                                <button onclick="searchtext();"
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

                                <th class="delete-all">
                                    <input type="checkbox" id="is_active">
                                    <label class="col-3 control-label" for="is_active">
                                        <a id="deleteAll" class="do_not_delete" href="javascript:void(0)"><i class="fa fa-trash"></i> {{trans('lang.all')}}</a>
                                    </label>
                                </th>

                                    <th>{{trans('lang.order_id')}}</th>

                                    <th>{{trans('lang.item_review_user_id')}}</th>
                                      <th>{{trans('lang.driver')}}</th>

                                    <th>{{trans('lang.amount')}}</th>

                                    <th>{{trans('lang.date')}}</th>
                                    <th>{{trans('lang.order_order_status_id')}}</th>
                                    <th>{{trans('lang.actions')}}</th>

                                </tr>

                                </thead>

                                <tbody id="append_list1">


                                </tbody>

                            </table>
                            <div id="data-table_paginate" style="display:none">
                                <nav aria-label="Page navigation example" class="pagination_div">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item ">
                                            <a class="page-link" href="javascript:void(0);"
                                               id="users_table_previous_btn" onclick="prev()" data-dt-idx="0"
                                               tabindex="0">{{trans('lang.previous')}}</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);"
                                               id="users_table_next_btn" onclick="next()" data-dt-idx="2"
                                               tabindex="0">{{trans('lang.next')}}</a>
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
</div>


@endsection


@section('scripts')
<script type="text/javascript">

    var database = firebase.firestore();
    var offest = 1;
    var pagesize = 10;
    var end = null;
    var endarray = [];
    var start = null;

    var append_list = '';
    var user_number = [];
    var refData = database.collection('parcel_orders');
    var ref = database.collection('parcel_orders').orderBy('createdAt', 'desc');

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
        var order_status = jQuery('#order_status').val();
        var search = jQuery("#search").val();


        $(document.body).on('click', '.redirecttopage', function () {
            var url = $(this).attr('data-url');
            window.location.href = url;
        });
        jQuery('#search').hide();

        $(document.body).on('change', '#selected_search', function () {

            if (jQuery(this).val() == 'status') {
                jQuery('#order_status').show();
                jQuery('#search').hide();
            } else {

                jQuery('#order_status').hide();
                jQuery('#search').show();

            }
        });


        jQuery("#data-table_processing").show();
        append_list = document.getElementById('append_list1');
        append_list.innerHTML = '';
        ref.limit(pagesize).get().then(async function (snapshots) {
            html = '';

            html = buildHTML(snapshots);
            jQuery("#data-table_processing").hide();
            if (html != '') {
                append_list.innerHTML = html;
                start = snapshots.docs[snapshots.docs.length - 1];
                endarray.push(snapshots.docs[0]);
                //disableClick();

            }
            if (snapshots.docs.length < pagesize) {

                jQuery("#data-table_paginate").hide();
            } else {

                jQuery("#data-table_paginate").show();
            }

        });

    });

    function buildHTML(snapshots) {
        var html = '';
        var alldata = [];
        var number = [];
        snapshots.docs.forEach((listval) => {
            var datas = listval.data();
            datas.id = listval.id;
            let result = user_number.filter(obj => {
                return obj.id == datas.author;
            })
            if (result.length > 0) {
                datas.phoneNumber = result[0].phoneNumber;
                datas.isActive = result[0].isActive;

            } else {
                datas.phoneNumber = '';
                datas.isActive = false;
            }


            alldata.push(datas);
        });

        var count = 0;
        alldata.forEach((listval) => {

            var val = listval;

            html = html + '<tr>';
            newdate = '';
            var id = val.id;

            var user_id = val.authorID;
            console.log(val.authorID);

            html = html + '<td class="delete-all"><input type="checkbox" id="is_open_' + id + '" class="is_open" dataId="' + id + '"><label class="col-3 control-label"\n' +
                'for="is_open_' + id + '" ></label></td>';

            var route1 = '{{route("parcel_orders.edit",":id")}}';
            route1 = route1.replace(':id', id);

            var route2 = '{{route("users.edit",":id")}}';
            route2 = route2.replace(':id', user_id);

              var driver_id=val.driverID;
            var route3 = '{{route("drivers.edit",":id")}}';
            route3 = route3.replace(':id', driver_id);

            html = html + '<td data-url="' + route1 + '" class="redirecttopage">' + val.id + '</td>';
            html = html + '<td data-url="' + route2 + '" class="redirecttopage">' + val.author.firstName + ' ' + val.author.lastName + '</td>';

            if(val.driver!=undefined){
              var firstName=val.driver.firstName;
              var lastName=val.driver.lastName;
              html = html + '<td data-url="' + route3 + '" class="redirecttopage">' + firstName +' '+lastName + '</td>';

            }else{
              var firstName='';
              var lastName='';
              html = html + '<td></td>';

            }
            var price = 0;

            price = buildParcelTotal(val);

            html = html + '<td>' + price + '</td>';

            var createdAt_val = '';
            if (val.createdAt) {
                var date1 = val.createdAt.toDate().toDateString();
                var date = new Date(date1);
                var dd = String(date.getDate()).padStart(2, '0');
                var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = date.getFullYear();
                createdAt_val = yyyy + '-' + mm + '-' + dd;
                var time = val.createdAt.toDate().toLocaleTimeString('en-US');
                createdAt_val = createdAt_val + ' ' + time;
            }

            html = html + '<td>' + createdAt_val + '</td>';

            if (val.status == 'Order Placed') {
                html = html + '<td class="order_placed"><span>' + val.status + '</span></td>';

            } else if (val.status == 'Order Accepted') {
                html = html + '<td class="order_accepted"><span>' + val.status + '</span></td>';

            } else if (val.status == 'Order Rejected') {
                html = html + '<td class="order_rejected"><span>' + val.status + '</span></td>';

            } else if (val.status == 'Driver Pending') {
                html = html + '<td class="driver_pending"><span>' + val.status + '</span></td>';

            } else if (val.status == 'Driver Rejected') {
                html = html + '<td class="driver_rejected"><span>' + val.status + '</span></td>';

            } else if (val.status == 'Order Shipped') {
                html = html + '<td class="order_shipped"><span>' + val.status + '</span></td>';

            } else if (val.status == 'In Transit') {
                html = html + '<td class="in_transit"><span>' + val.status + '</span></td>';

            } else if (val.status == 'Order Completed') {
                html = html + '<td class="order_completed"><span>' + val.status + '</span></td>';

            }

            html = html + '<td class="action-btn"><a href="' + route1 + '"><i class="fa fa-edit"></i></a><a id="' + val.id + '" class="do_not_delete" name="order-delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>';

            html = html + '</tr>';
            count = count + 1;
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
            if (jQuery("#selected_search").val() == 'status' && jQuery("#order_status").val() != 'All' && jQuery("#order_status").val().trim() != '') {

                listener = refData.orderBy('status').limit(pagesize).startAt(jQuery("#order_status").val()).endAt(jQuery("#order_status").val() + '\uf8ff').startAt(end).get();
            } else if (jQuery("#selected_search").val() == 'id' && jQuery("#search").val().trim() != '') {

                listener = refData.orderBy('id').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAt(end).get();
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

            jQuery("#data-table_processing").show();

            if (jQuery("#selected_search").val() == 'status' && jQuery("#order_status").val() != 'All' && jQuery("#order_status").val().trim() != '') {

                listener = refData.orderBy('status').limit(pagesize).startAt(jQuery("#order_status").val()).endAt(jQuery("#order_status").val() + '\uf8ff').startAfter(start).get();
            } else if (jQuery("#selected_search").val() == 'id' && jQuery("#search").val().trim() != '') {

                listener = refData.orderBy('id').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAt(end).get();
            } else {
                listener = ref.startAfter(start).limit(pagesize).get();
            }
            listener.then((snapshots) => {

                html = '';
                html = buildHTML(snapshots);

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

    $(document).on("click", "a[name='order-delete']", function (e) {
        var id = this.id;
        database.collection('vendor_orders').doc(id).delete().then(function (result) {
            window.location.href = '{{ url()->current() }}';
        });


    });

    function searchclear() {
        jQuery("#search").val('');
        jQuery("#order_status").val('All');
        //searchtext();
        location.reload();
    }

    function searchtext() {
        var offest = 1;
        jQuery("#data-table_processing").show();

        append_list.innerHTML = '';

        if (jQuery("#selected_search").val() == 'status' && jQuery("#order_status").val() != 'All' && jQuery("#order_status").val().trim() != '') {
            wherequery = refData.orderBy('status').limit(pagesize).startAt(jQuery("#order_status").val()).endAt(jQuery("#order_status").val() + '\uf8ff').get();

        } else if (jQuery("#selected_search").val() == 'id' && jQuery("#search").val().trim() != '') {

            wherequery = refData.orderBy('id').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();

        } else {

            wherequery = ref.limit(pagesize).get();
        }

        wherequery.then((snapshots) => {
            html = '';
            html = buildHTML(snapshots);
            jQuery("#data-table_processing").hide();
            if (html != '') {
                append_list.innerHTML = html;
                start = snapshots.docs[snapshots.docs.length - 1];

                endarray.push(snapshots.docs[0]);
                if (snapshots.docs.length < pagesize) {

                    jQuery("#data-table_paginate").hide();
                } else {

                    jQuery("#data-table_paginate").show();
                }
            }
        });

    }

    function buildParcelTotal(snapshotsProducts) {

        var adminCommission = snapshotsProducts.adminCommission;
        var adminCommissionType = snapshotsProducts.adminCommissionType;
        var discount = snapshotsProducts.discount;
        var subTotal = snapshotsProducts.subTotal;
        var tax = snapshotsProducts.tax;
        var taxType = snapshotsProducts.taxType;

        var total_price = subTotal;

        var intRegex = /^\d+$/;
        var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;

        if (intRegex.test(discount) || floatRegex.test(discount)) {

            discount = parseFloat(discount).toFixed(2);
            total_price -= parseFloat(discount);

        }
        if (taxType == "percent") {
            tax = (tax * total_price) / 100;
        } else {
            tax = tax;
        }


        if (!isNaN(tax)) {

            total_price = parseFloat(total_price) + parseFloat(tax);

        }

        if (currencyAtRight) {

            var total_price_val = total_price.toFixed(decimal_degits) + "" + currentCurrency;
        } else {
            var total_price_val = currentCurrency + "" + total_price.toFixed(decimal_degits);
        }

        return total_price_val;
    }

    $("#is_active").click(function () {
        $("#example24 .is_open").prop('checked', $(this).prop('checked'));

    });
    $("#deleteAll").click(function () {
        if ($('#example24 .is_open:checked').length) {
            if (confirm('Are You Sure want to Delete Selected Data ?')) {
                jQuery("#data-table_processing").show();
                $('#example24 .is_open:checked').each(function () {
                    var dataId = $(this).attr('dataId');
                    console.log(dataId);
                    database.collection('vendor_categories').doc(dataId).delete().then(function () {

                        const getStoreName = deleteDriverData(dataId);

                        window.location.reload();

                    });

                });

            }
        } else {
            alert('Please Select Any One Record .');
        }
    });

</script>


@endsection
