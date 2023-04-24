@extends('layouts.app')


<?php

error_reporting(E_ALL ^ E_NOTICE);
?>

@section('content')
<div class="page-wrapper">


    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">{{trans('lang.vendors_payout_plural')}} <span class="storeTitle"></span></h3>

        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.vendors_payout_plural')}}</li>
            </ol>
        </div>

        <div>

        </div>

    </div>


    <div class="container-fluid">

        <div class="row">

            <div class="col-12">
                <?php if ($id != '') { ?>
                    <div class="menu-tab">
                        <ul>
                            <li>
                                <a href="{{route('vendors.view',$id)}}">{{trans('lang.tab_basic')}}</a>
                            </li>
                            <li>
                                <a href="{{route('vendors.items',$id)}}">{{trans('lang.tab_items')}}</a>
                            </li>
                            <li>
                                <a href="{{route('vendors.orders',$id)}}">{{trans('lang.tab_orders')}}</a>
                            </li>
                            <li>
                                <a href="{{route('vendors.reviews',$id)}}">{{trans('lang.tab_reviews')}}</a>
                            </li>
                            <li>
                                <a href="{{route('vendors.coupons',$id)}}">{{trans('lang.tab_promos')}}</a>
                            <li class="active">
                                <a href="{{route('vendors.payout',$id)}}">{{trans('lang.tab_payouts')}}</a>
                            </li>
                            <li class="dine_in_future" style="display:none;">
                                <a href="{{route('vendors.booktable',$id)}}">{{trans('lang.dine_in_future')}}</a>
                            </li>
                        </ul>
                    </div>
                <?php } ?>
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                            <li class="nav-item">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i
                                            class="fa fa-list mr-2"></i>{{trans('lang.vendors_payout_table')}}</a>
                            </li>

                            <?php if ($id != '') { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="{!! route('vendorsPayouts.create') !!}/{{$id}}"><i
                                                class="fa fa-plus mr-2"></i>{{trans('lang.vendors_payout_create')}}</a>
                                </li>
                            <?php } else { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="{!! route('vendorsPayouts.create') !!}"><i
                                                class="fa fa-plus mr-2"></i>{{trans('lang.vendors_payout_create')}}</a>
                                </li>
                            <?php } ?>


                        </ul>
                    </div>
                    <div class="card-body">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                             style="display: none;">{{trans('lang.processing')}}
                        </div>

                        <div id="users-table_filter" class="pull-right"><label>{{trans('lang.search_by')}}
                                <select name="selected_search" id="selected_search" class="form-control input-sm">
                                    <option value="note">{{ trans('lang.vendors_payout_note')}}</option>
                                </select>
                                <div class="form-group">
                                    <input type="search" id="search" class="search form-control" placeholder="Search">
                            </label>&nbsp;<button onclick="searchtext();" class="btn btn-warning btn-flat">
                                {{trans('lang.search')}}
                            </button>&nbsp;<button onclick="searchclear();" class="btn btn-warning btn-flat">
                                {{trans('lang.clear')}}
                            </button>
                        </div>
                    </div>


                    <div class="table-responsive m-t-10">


                        <table id="example24"
                               class="display nowrap table table-hover table-striped table-bordered table table-striped"
                               cellspacing="0" width="100%">

                            <thead>

                            <tr>
                                <?php if ($id == '') { ?>
                                    <th>{{ trans('lang.vendor')}}</th>
                                <?php } ?>
                                <th>{{trans('lang.paid_amount')}}</th>
                                <th>{{trans('lang.date')}}</th>
                                <th>{{trans('lang.vendors_payout_note')}}</th>
                                <th>Admin {{trans('lang.vendors_payout_note')}}</th>
                            </tr>

                            </thead>

                            <tbody id="append_list1">


                            </tbody>

                        </table>
                        <div id="data-table_paginate">
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

    var intRegex = /^\d+$/;
    var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;

    <?php if($id != ''){ ?>
    var refData = database.collection('payouts').where('vendorID', '==', '<?php echo $id; ?>').where('paymentStatus', '==', 'Success');
    var ref = refData.orderBy('paidDate', 'desc');
    getStoreNameFunction('<?php echo $id; ?>');
    <?php }else{ ?>
    var refData = database.collection('payouts').where('paymentStatus', '==', 'Success');
    var ref = refData.orderBy('paidDate', 'desc');
    <?php } ?>

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

    // var ref = database.collection('vendors');

    var append_list = '';

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
            if (snapshots.docs.length < pagesize) {
                jQuery("#data-table_paginate").hide();
            }

            jQuery("#data-table_processing").hide();
        });

    });


    function getStoreNameFunction(vendorId) {
        var vendorName = '';
        database.collection('vendors').where('id', '==', vendorId).get().then(function (snapshots) {
            var vendorData = snapshots.docs[0].data();
            vendorName = vendorData.title;
            $(".storeTitle").text(' - ' + vendorName);
            if (vendorData.dine_in_active == true) {
                $(".dine_in_future").show();
            }
        });
        return vendorName;
    }

    function buildHTML(snapshots) {
        var html = '';
        var alldata = [];
        var number = [];

        snapshots.docs.forEach((listval) => {
            var datas = listval.data();
            datas.id = listval.id;
            alldata.push(datas);
        });

        var count = 0;
        alldata.forEach((listval) => {

            var val = listval;
            var price_val = '';
            var price = val.amount;

            if (intRegex.test(price) || floatRegex.test(price)) {

                price = parseFloat(price).toFixed(decimal_degits);
            } else {
                price = 0;
            }

            if (currencyAtRight) {
                price_val = parseFloat(price).toFixed(decimal_degits) + "" + currentCurrency;
            } else {
                price_val = currentCurrency + "" + parseFloat(price).toFixed(decimal_degits);
            }
            html = html + '<tr>';
            <?php if($id == ''){ ?>
            const vendor = payoutVendor(val.vendorID);
            html = html + '<td class="vendor_' + val.vendorID + ' redirecttopage" ></td>';
            <?php } ?>
            html = html + '<td>' + price_val + '</td>';
            var date = val.paidDate.toDate().toDateString();
            var time = val.paidDate.toDate().toLocaleTimeString('en-US');
            html = html + '<td>' + date + ' ' + time + '</td>';

            if (val.note != undefined && val.note != '') {
                html = html + '<td>' + val.note + '</td>';
            } else {
                html = html + '<td></td>';
            }
            if (val.adminNote != undefined && val.adminNote != '') {
                html = html + '<td>' + val.adminNote + '</td>';
            } else {
                html = html + '<td></td>';
            }

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


            if (jQuery("#selected_search").val() == 'note' && jQuery("#search").val().trim() != '') {
                listener = refData.orderBy('note').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAt(end).get();

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
            if (jQuery("#selected_search").val() == 'note' && jQuery("#search").val().trim() != '') {

                listener = refData.orderBy('note').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAfter(start).get();

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

        jQuery("#data-table_processing").show();

        append_list.innerHTML = '';

        if (jQuery("#selected_search").val() == 'note' && jQuery("#search").val().trim() != '') {

            wherequery = refData.orderBy('note').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();

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


    async function payoutVendor(vendor) {
        var payoutVendor = '';
        var route = '{{route("vendors.view",":id")}}';
        route = route.replace(':id', vendor);
        await database.collection('vendors').where("id", "==", vendor).get().then(async function (snapshotss) {

            if (snapshotss.docs[0]) {
                var vendor_data = snapshotss.docs[0].data();
                payoutVendor = vendor_data.title;
                // jQuery(".vendor_"+vendor).html('<a href="'+route+'">'+payoutVendor+'</a>');
                jQuery(".vendor_" + vendor).attr("data-url", route).html(payoutVendor);
            } else {
                jQuery(".vendor_" + vendor).attr("data-url", route).html('');
            }
        });
        return payoutVendor;
    }

</script>


@endsection
