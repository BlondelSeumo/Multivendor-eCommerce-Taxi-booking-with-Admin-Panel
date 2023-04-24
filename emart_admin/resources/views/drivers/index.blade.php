@extends('layouts.app')
<?php

error_reporting(E_ALL ^ E_NOTICE);
?>

@section('content')
<div class="page-wrapper">

    <!-- ============================================================== -->

    <!-- Bread crumb and right sidebar toggle -->

    <!-- ============================================================== -->

    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">{{trans('lang.driver_plural')}}</h3>

        </div>

        <div class="col-md-7 align-self-center">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                <li class="breadcrumb-item active">{{trans('lang.driver_table')}}</li>

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
                                <a class="nav-link active" href="{!! route('drivers') !!}"><i
                                            class="fa fa-list mr-2"></i>{{trans('lang.driver_table')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('drivers.create') !!}"><i
                                            class="fa fa-plus mr-2"></i>{{trans('lang.drivers_create')}}</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                             style="display: none;">{{trans('lang.processing')}}
                        </div>
                        <!-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> -->
                        <div id="users-table_filter" class="pull-right">
                        <div class="row">

                        <div class="col-sm-9">
                            <label>{{ trans('lang.search_by')}}
                                <select name="selected_search" id="selected_search" class="form-control input-sm">
                                    <option value="first_name">{{ trans('lang.first_name')}}</option>
                                    <option value="last_name">{{ trans('lang.last_name')}}</option>
                                    <option value="email">{{ trans('lang.email')}}</option>
                                    <option value="service_type">{{ trans('lang.service_type')}}</option>
                                </select>
                                <div class="form-group">
                                    <input type="search" id="search" class="search form-control"
                                           placeholder="Search" aria-controls="users-table">
                            </label>&nbsp;<button onclick="searchtext();" class="btn btn-warning btn-flat">Search
                            </button>&nbsp;<button onclick="searchclear();" class="btn btn-warning btn-flat">Clear
                            </button>
                            </div>
                            </div>
                            <div class="col-sm-3">
                            <select id="pageSize" class="form-control pageSize"  onchange="clickpage(this.value)">
                                    <option value="0">{{trans('lang.select_limit')}}</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                            </select>
                        </div>
                        </div>

                    </div>

                    <div class="table-responsive m-t-10">

                        <table id="driverTable"
                               class="display nowrap table table-hover table-striped table-bordered table table-striped"
                               cellspacing="0" width="100%">

                            <thead>

                            <tr>

                                <th class="delete-all"><input type="checkbox" id="is_active"><label
                                            class="col-3 control-label" for="is_active"
                                    ><a id="deleteAll" class="do_not_delete"
                                        href="javascript:void(0)"><i
                                                    class="fa fa-trash"></i> {{trans('lang.all')}}</a></label></th>

                                <th>{{trans('lang.actions')}}</th>

                                <th>{{trans('lang.extra_image')}}</th>

                                <th>{{trans('lang.user_name')}}</th>

                                <th>{{trans('lang.driver_available')}}</th>
                                <th>{{trans('lang.service_type')}}</th>
                                <th>{{trans('lang.type')}}</th>

                                <th>{{trans('lang.order_transactions')}}</th>
                                <th>{{trans('lang.total_orders')}}</th>
                                <th>{{trans('lang.wallet_history')}}</th>


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
<!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.1.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.1.0/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.1.0/firebase-database.js"></script>
<script type="text/javascript">@include('vendor.notifications.init_firebase')</script>
-->
<script type="text/javascript">

    var database = firebase.firestore();

    var offest = 1;
    var pagesize = 10;
    var pagesizes = 0;
    var end = null;
    var endarray = [];
    var start = null;
    var user_number = [];
    var ref = database.collection('users').where("role", "==", "driver");
    var alldriver = database.collection('users').where("role", "==", "driver");
    var placeholderImage = '';
    var append_list = '';

    $(document).ready(function () {
        pagesizes = getCookie('pagesizes');

        if(pagesizes !=0){

        $('.pageSize option[value='+pagesizes+']').attr('selected','selected');
        var inx = parseInt(offest) * parseInt(pagesizes);
        jQuery("#data-table_processing").show();

        var placeholder = database.collection('settings').doc('placeHolderImage');
        placeholder.get().then(async function (snapshotsimage) {
            var placeholderImageData = snapshotsimage.data();
            placeholderImage = placeholderImageData.image;
        })


        append_list = document.getElementById('append_list1');
        append_list.innerHTML = '';
        ref.limit(pagesizes).get().then(async function (snapshots) {
            html = '';

            html = buildHTML(snapshots);
            jQuery("#data-table_processing").hide();
            if (html != '') {
                append_list.innerHTML = html;
                start = snapshots.docs[snapshots.docs.length - 1];
                endarray.push(snapshots.docs[0]);
                if (snapshots.docs.length < pagesizes) {
                    jQuery("#data-table_paginate").hide();
                }
                //disableClick();
            }
        });


        alldriver.get().then(async function (snapshotsdriver) {

            snapshotsdriver.docs.forEach((listval) => {
                database.collection('vendor_orders').where('driverID', '==', listval.id).where("status", "in", ["Order Completed"]).get().then(async function (orderSnapshots) {
                    var count_order_complete = orderSnapshots.docs.length;
                    database.collection('users').doc(listval.id).update({'orderCompleted': count_order_complete}).then(function (result) {

                    });

                });

            });
        });
    }else{
        var inx = parseInt(offest) * parseInt(pagesize);
        jQuery("#data-table_processing").show();

        var placeholder = database.collection('settings').doc('placeHolderImage');
        placeholder.get().then(async function (snapshotsimage) {
            var placeholderImageData = snapshotsimage.data();
            placeholderImage = placeholderImageData.image;
        })


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
                if (snapshots.docs.length < pagesize) {
                    jQuery("#data-table_paginate").hide();
                }
                //disableClick();
            }
        });


        alldriver.get().then(async function (snapshotsdriver) {

            snapshotsdriver.docs.forEach((listval) => {
                database.collection('vendor_orders').where('driverID', '==', listval.id).where("status", "in", ["Order Completed"]).get().then(async function (orderSnapshots) {
                    var count_order_complete = orderSnapshots.docs.length;
                    database.collection('users').doc(listval.id).update({'orderCompleted': count_order_complete}).then(function (result) {

                    });

                });

            });
        });
    }
    });


    function buildHTML(snapshots) {
        var html = '';
        var alldata = [];
        var number = [];
        snapshots.docs.forEach((listval) => {
            var datas = listval.data();

            datas.id = listval.id;
            alldata.push(datas);
        });


        /* alldata.sort(function(a, b) {

           var keyA = a.createdAt.seconds,
             keyB = b.createdAt.seconds;

           if (keyA < keyB) return -1;
           if (keyA > keyB) return 1;
           return 0;
     }); */

        var count = 0;
        alldata.forEach((listval) => {

            var val = listval;

            html = html + '<tr>';
            newdate = '';
            var id = val.id;
            var route1 = '{{route("drivers.edit",":id")}}';
            route1 = route1.replace(':id', id);

            var driverView = '{{route("drivers.view",":id")}}';
            driverView = driverView.replace(':id', id);


            html = html + '<td class="delete-all"><input type="checkbox" id="is_open_' + id + '" class="is_open" dataId="' + id + '"><label class="col-3 control-label"\n' +
                'for="is_open_' + id + '" ></label></td>';

            html = html + '<td class="action-btn"><a href="' + driverView + '"><i class="fa fa-eye"></i></a><a href="' + route1 + '"><i class="fa fa-edit"></i></a><a id="' + val.id + '" name="driver-delete" class="do_not_delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>';

            /* html=html+'<td>'+val.id+'</td>'; */
            if (val.profilePictureURL == '') {
                html = html + '<td><img class="rounded" style="width:50px" src="' + placeholderImage + '" alt="image"></td>';
            } else {
                html = html + '<td><img class="rounded" style="width:50px" src="' + val.profilePictureURL + '" alt="image"></td>';
            }

            html = html + '<td data-url="' + route1 + '" class="redirecttopage">' + val.firstName + ' ' + val.lastName + '</td>';

            if (val.isActive) {
              html = html + '<td><label class="switch"><input type="checkbox" checked id="' + val.id + '" name="isActive"><span class="slider round"></span></label></td>';
            } else {
              html = html + '<td><label class="switch"><input type="checkbox" id="' + val.id + '" name="isActive"><span class="slider round"></span></label></td>';
            }
            if (val.serviceType) {
                const service = serviceTypes(val.serviceType);
                html = html + '<td class="service_client' + val.serviceType + '"></td>';


            } else {
                html = html + '<td></td>';

            }


            if (val.hasOwnProperty('isCompany')) {
                if (val.isCompany) {

                    html = html + '<td class="order_placed"><span>Company</span></td>';

                } else {
                    html = html + '<td class="driver_rejected"><span>Individual</span></td>';
                }
            } else {
                html = html + '<td></td>';
            }


            var trroute1 = '{{route("order_transactions.index",":id")}}';
            trroute1 = trroute1.replace(':id', 'driverId=' + id);

            html = html + '<td data-url="' + trroute1 + '" class="redirecttopage">{{trans("lang.order_transactions")}}</td>';
            var trroute2 = '{{route("orders",":id")}}';
            trroute2 = trroute2.replace(':id', 'driverId=' + id);
            if (val.id) {
                const driver = orderDetails(val.id);
                html = html + '<td data-url="' + trroute2 + '"  class="redirecttopage ride_client' + val.id + '"></td>';
            }
            var payoutRequests = '{{route("payoutRequests.drivers.view",":id")}}';
            payoutRequests = payoutRequests.replace(':id', id);

            html = html + '<td data-url="' + payoutRequests + '" class="redirecttopage">{{trans("lang.wallet_history")}}</td>';


            // html=html+'<td class="action-btn"><a href="'+route1+'"><i class="fa fa-edit"></i></a><a id="'+val.id+'" name="driver-delete" class="do_not_delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>';

            html = html + '</tr>';
            count = count + 1;
        });
        return html;
    }
    /* toggal publish action code start*/
        $(document).on("click","input[name='isActive']",function(e){
            var ischeck=$(this).is(':checked');
            var id=this.id;
            if(ischeck){
              database.collection('users').doc(id).update({'isActive': true}).then(function (result) {
              });
            }else{
              database.collection('users').doc(id).update({'isActive': false}).then(function (result) {
              });
            }

        });

    /*toggal publish action code end*/

    $("#is_active").click(function () {
        $("#driverTable .is_open").prop('checked', $(this).prop('checked'));

    });

    $("#deleteAll").click(function () {
        if ($('#driverTable .is_open:checked').length) {
            if (confirm('Are You Sure want to Delete Selected Data ?')) {
                jQuery("#data-table_processing").show();
                $('#driverTable .is_open:checked').each(function () {
                    var dataId = $(this).attr('dataId');

                    database.collection('users').doc(dataId).delete().then(function () {

                        const getStoreName = deleteDriverData(dataId);

                        window.location.reload();

                    });

                });

            }
        } else {
            alert('Please Select Any One Record .');
        }
    });

    async function serviceTypes(service) {
        var serviceTypes = '';
        await database.collection('services').where("flag", "==", service).get().then(async function (snapshotservice) {
            // var rideroute = '{{route("rides.edit",":id")}}';
            // rideroute = rideroute.replace(':id', service);

            if (snapshotservice.docs[0]) {
                var ride_data = snapshotservice.docs[0].data();
                client_name = ride_data.name;

                jQuery(".service_client" + service).html(client_name);
            } else {
                jQuery(".service_client" + service).html('');
            }
        });
        return serviceTypes;
    }

    async function orderDetails(driver) {
        var orderDetails = '';
        alldriver.get().then(async function (snapshotsdriver) {

            snapshotsdriver.docs.forEach((listval) => {
                database.collection('vendor_orders').where('driverID', '==', driver).get().then(async function (orderSnapshots) {
                    var count_order_complete = orderSnapshots.docs.length;
                    jQuery(".ride_client" + driver).html(count_order_complete);
                });

            });

        });
        return orderDetails;
    }

    async function deleteDriverData(driverId) {

        /*await database.collection('vendor_orders').where('vendorID', '==', storeId).get().then(async function (snapshotsItem) {
            if (snapshotsItem.docs.length > 0) {
                snapshotsItem.docs.forEach((temData) => {
                    var item_data = temData.data();

                    database.collection('vendor_orders').doc(item_data.id).delete().then(function () {

                    });
                });
            }

        });*/
        await database.collection('order_transactions').where('driverId', '==', driverId).get().then(async function (snapshotsOrderTransacation) {
            if (snapshotsOrderTransacation.docs.length > 0) {
                snapshotsOrderTransacation.docs.forEach((temData) => {
                    var item_data = temData.data();

                    database.collection('order_transactions').doc(item_data.id).delete().then(function () {

                    });
                });
            }

        });

        await database.collection('driver_payouts').where('driverID', '==', driverId).get().then(async function (snapshotsItem) {

            if (snapshotsItem.docs.length > 0) {
                snapshotsItem.docs.forEach((temData) => {
                    var item_data = temData.data();

                    database.collection('driver_payouts').doc(item_data.id).delete().then(function () {

                    });
                });
            }

        });


    }

    $(document.body).on('click', '.redirecttopage', function () {
        var url = $(this).attr('data-url');
        window.location.href = url;
    });

    function prev() {
        if (endarray.length == 1) {
            return false;
        }
        end = endarray[endarray.length - 2];
        if (end != undefined || end != null) {
            jQuery("#data-table_processing").show();

            if (jQuery("#selected_search").val() == 'first_name' && jQuery("#search").val().trim() != '') {

                wherequery = ref.orderBy('firstName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAt(end).get();

                wherequery.then((snapshots) => {
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
            } else if (jQuery("#selected_search").val() == 'last_name' && jQuery("#search").val().trim() != '') {

                wherequery = ref.orderBy('lastName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAt(end).get();

                wherequery.then((snapshots) => {
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
            } else if (jQuery("#selected_search").val() == 'email' && jQuery("#search").val().trim() != '') {

                wherequery = ref.orderBy('email').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAt(end).get();

                wherequery.then((snapshots) => {
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
            } else if (jQuery("#selected_search").val() == 'service_type' && jQuery("#search").val().trim() != '') {

                var services = database.collection('services').orderBy('name').startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();

                services.then(async function (snapshots) {

                    if (snapshots.docs.length > 0) {
                        var data = snapshots.docs[0].data();

                        wherequery = ref.orderBy('serviceType').limit(pagesize).startAt(data.flag).endAt(data.flag + '\uf8ff').startAt(end).get();
                        wherequery.then((snapshots) => {
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
                    } else {
                        jQuery("#data-table_processing").hide();
                    }

                });


            } else {
                wherequery = ref.startAt(end).limit(pagesize).get();

                wherequery.then((snapshots) => {
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
    }

    function next() {
        if (start != undefined || start != null) {

            jQuery("#data-table_processing").hide();

            if (jQuery("#selected_search").val() == 'first_name' && jQuery("#search").val().trim() != '') {

                wherequery = ref.orderBy('firstName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAfter(start).get();

                wherequery.then((snapshots) => {

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

            } else if (jQuery("#selected_search").val() == 'last_name' && jQuery("#search").val().trim() != '') {

                wherequery = ref.orderBy('lastName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAfter(start).get();

                wherequery.then((snapshots) => {

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

            } else if (jQuery("#selected_search").val() == 'email' && jQuery("#search").val().trim() != '') {

                wherequery = ref.orderBy('email').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAfter(start).get();

                wherequery.then((snapshots) => {

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
            } else if (jQuery("#selected_search").val() == 'service_type' && jQuery("#search").val().trim() != '') {

                var services = database.collection('services').orderBy('name').startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();

                services.then(async function (snapshotss) {

                    if (snapshotss.docs.length > 0) {
                        var data = snapshotss.docs[0].data();

                        wherequery = ref.orderBy('serviceType').limit(pagesize).startAt(data.flag).endAt(data.flag + '\uf8ff').startAfter(start).get();
                        wherequery.then((snapshots) => {

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
                    } else {
                        jQuery("#data-table_processing").hide();
                    }

                });

            } else {
                wherequery = ref.startAfter(start).limit(pagesize).get();

                wherequery.then((snapshots) => {

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
    }
    function clickpage(value) {
        setCookie('pagesizes', value, 30);
        location.reload();
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

        if (jQuery("#selected_search").val() == 'first_name' && jQuery("#search").val().trim() != '') {

            wherequery = ref.orderBy('firstName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();
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

        } else if (jQuery("#selected_search").val() == 'last_name' && jQuery("#search").val().trim() != '') {

            wherequery = ref.orderBy('lastName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();
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
        } else if (jQuery("#selected_search").val() == 'email' && jQuery("#search").val().trim() != '') {

            wherequery = ref.orderBy('email').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();

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
        } else if (jQuery("#selected_search").val() == 'service_type' && jQuery("#search").val().trim() != '') {

            var services = database.collection('services').orderBy('name').startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();

            services.then(async function (snapshots) {

                if (snapshots.docs.length > 0) {
                    var data = snapshots.docs[0].data();

                    wherequery = ref.orderBy('serviceType').limit(pagesize).startAt(data.flag).endAt(data.flag + '\uf8ff').get();
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


    /*$(document).on("click","a[name='vendor-active']", function (e) {
            var id = this.id;
            console.log(id);
        database.collection('vendors').doc(id).update({'isActive':true}).then(function(result) {

                    window.location.reload();

        });
    }); */
    $(document).on("click", "a[name='driver-delete']", function (e) {
        var id = this.id;

        jQuery("#data-table_processing").show();
        database.collection('users').doc(id).delete().then(function () {
            const getStoreName = deleteDriverData(id);

            window.location.reload();
        });


    });

    function searchclear() {
        jQuery("#search").val('');
        searchtext();
    }


</script>

@endsection
