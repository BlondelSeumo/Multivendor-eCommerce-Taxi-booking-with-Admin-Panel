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

            <h3 class="text-themecolor">{{trans('lang.book_table')}} <span class="storeTitle"></span></h3>

        </div>

        <div class="col-md-7 align-self-center">

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.book_table')}}</li>
            </ol>

        </div>

        <div>

        </div>

    </div>


    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <!-- <div class="resttab-sec"> -->
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
                        <li>
                            <a href="{{route('vendors.payout',$id)}}">{{trans('lang.tab_payouts')}}</a>
                        </li>

                        <li class="active">
                            <a href="{{route('vendors.booktable',$id)}}">{{trans('lang.dine_in_future')}}</a>
                        </li>
                    </ul>

                </div>
                <div class="card">

                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ url()->current() }}"><i class="fa fa-list mr-2"></i>{{trans('lang.book_table_table')}}</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                             style="display: none;">{{trans('lang.processing')}}
                        </div>
                    </div>

                    <div class="table-responsive m-t-10">


                        <table id="example24"
                               class="display nowrap table table-hover table-striped table-bordered table table-striped"
                               cellspacing="0" width="100%">

                            <thead>

                            <tr>
                                <th>{{trans('lang.date')}}</th>
                                <th>{{trans('lang.guestNumber')}}</th>
                                <th>{{trans('lang.guestName')}}</th>
                                <th>{{trans('lang.guestPhone')}}</th>
                                <th>{{trans('lang.status')}}</th>
                                <th>{{trans('lang.actions')}}</th>
                            </tr>

                            </thead>

                            <tbody id="append_list1">


                            </tbody>

                        </table>
                        <div id="data-table_paginate" style="display:none">
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
<script type="text/javascript">

    var database = firebase.firestore();
    var offest = 1;
    var pagesize = 10;
    var end = null;
    var endarray = [];
    var start = null;
    var user_number = [];
    var vendorUserId = "<?php echo $id; ?>";
    var vendorId;
    var ref;
    var append_list = '';
    var placeholderImage = '';

    <?php if($id!=''){ ?>
        getStoreNameFunction('<?php echo $id; ?>');
    <?php } ?>
    ref = database.collection('booked_table').orderBy('createdAt', 'desc').where('vendorID', "==", vendorUserId);
    $(document).ready(function () {

        $(document.body).on('click', '.redirecttopage', function () {
            var url = $(this).attr('data-url');
            window.location.href = url;
        });
        var inx = parseInt(offest) * parseInt(pagesize);
        jQuery("#data-table_processing").show();
        append_list = document.getElementById('append_list1');
        append_list.innerHTML = '';

        var placeholder = database.collection('settings').doc('placeHolderImage');
        placeholder.get().then(async function (snapshotsimage) {
            var placeholderImageData = snapshotsimage.data();
            placeholderImage = placeholderImageData.image;
        })

        ref.limit(pagesize).get().then(async function (snapshots) {
            html = '';
            html = buildHTML(snapshots);
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

            jQuery("#data-table_processing").hide();
        });
    });

    function getStoreNameFunction(vendorId){
        var vendorName = '';
            database.collection('vendors').where('id', '==', vendorId).get().then(function (snapshots) {
            var vendorData = snapshots.docs[0].data();
            vendorName = vendorData.title;
            $(".storeTitle").text(' - '+vendorName);
        });
        return vendorName;
    }

    function buildHTML(snapshots) {
        var html = '';
        var alldata = [];
        var number = [];
        snapshots.docs.forEach((listval) => {
            var datas = listval.data();
            datas.id=listval.id;
            alldata.push(datas);
        });

        var count = 0;
        alldata.forEach((listval) => {

            var val = listval;

            html = html + '<tr>';
            newdate = '';

            var id = val.id;
            var route1 = '{{route("booktable.edit",":id")}}?id=<?php echo $id; ?>';
            route1 = route1.replace(':id', id);

            html = html + '<td data-url="' + route1 + '" class="redirecttopage">' + val.date.toDate().toDateString() + '</td>';
            html = html + '<td data-url="' + route1 + '" class="redirecttopage">' + val.totalGuest + '</td>';
            html = html + '<td data-url="' + route1 + '" class="redirecttopage">' + val.guestFirstName + ' ' + val.guestLastName + '</td>';
            html = html + '<td data-url="' + route1 + '" class="redirecttopage">' + val.guestPhone + '</td>';
            var statustext = "";
            if (val.status == "Order Rejected") {
                statustext = "Request Rejected";
            } else if (val.status == "Order Placed") {
                statustext = "Requested";
            } else if (val.status == "Order Accepted") {
                statustext = "Request Accepted";
            }
            html = html + '<td data-url="' + route1 + '" class="redirecttopage">' + statustext + '</td>';


            html = html + '<td class="action-btn"><a id="' + val.id + '" name="book-table-check" data-name="' + val.vendor.title + '" data-auth="' + val.author.id + '" href="javascript:void(0)"><i class="fa fa-check" ></i></a><a id="' + val.id + '" name="book-table-dismiss" data-auth="' + val.author.id + '" data-name="' + val.vendor.title + '" href="javascript:void(0)"><i class="fa fa-close" ></i></a><a href="' + route1 + '"><i class="fa fa-edit"></i></a><a id="' + val.id + '" name="book-table-delete" class="do_not_delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>';


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
        console.log(endarray);

        if (end != undefined || end != null) {
            jQuery("#data-table_processing").show();
            if (jQuery("#selected_search").val() == 'name' && jQuery("#search").val().trim() != '') {

                listener = ref.orderBy('name').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAt(end).get();
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
                    console.log(start);
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
            // listener = ref.startAfter(start).limit(pagesize).get();

            if (jQuery("#selected_search").val() == 'name' && jQuery("#search").val().trim() != '') {

                listener = ref.orderBy('name').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAfter(start).get();
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

    function searchclear() {
        jQuery("#search").val('');
        searchtext();
    }

    function searchtext() {

        var offest = 1;
        /* var pagesize=5;
         var start = null;
         var end = null;
         var endarray=[];
         var inx= parseInt(offest) * parseInt(pagesize); */
        jQuery("#data-table_processing").show();

        append_list.innerHTML = '';

        if (jQuery("#selected_search").val() == 'name' && jQuery("#search").val().trim() != '') {

            wherequery = ref.orderBy('name').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();

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
                /*if(snapshots.docs.length<pagesize && jQuery("#selected_search").val().trim()!='' && jQuery("#search").val().trim()!=''){*/
                if (snapshots.docs.length < pagesize) {

                    jQuery("#data-table_paginate").hide();
                } else {

                    jQuery("#data-table_paginate").show();
                }
            }
        });

    }

    $(document).on("click", "a[name='book-table-delete']", function (e) {
        var id = this.id;

        database.collection('booked_table').doc(id).delete().then(function (result) {
            window.location.href = '{{ url()->current() }}';
        });


    });

    $(document).on("click", "a[name='book-table-check']", function (e) {
        var id = this.id;
        var fullname = $(this).attr('data-name');
        var auth = $(this).attr('data-auth');
        database.collection('booked_table').doc(id).update({'status': 'Order Accepted'}).then(function (result) {

            database.collection('users').where('id', '==', auth).get().then(function (snapshots) {

                if (snapshots.docs.length) {
                    snapshots.forEach((doc) => {
                        user = doc.data();
                        if (user.fcmToken) {
                            $.ajax({
                                method: 'POST',
                                url: '<?php echo route('sendnotification'); ?>',
                                data: {
                                    'fcm': user.fcmToken,
                                    'type': 'booktable_request_accepted',
                                    'authorName': fullname,
                                    '_token': '<?php echo csrf_token() ?>'
                                }
                            }).done(function (data) {
                                window.location.href = '{{ url()->current() }}';
                            }).fail(function (xhr, textStatus, errorThrown) {
                                window.location.href = '{{ url()->current() }}';
                            });
                        } else {
                            window.location.href = '{{ url()->current() }}';
                        }
                    });
                } else {
                    //window.location.href = '{{ url()->current() }}';
                }
            });

        });

    });

    $(document).on("click", "a[name='book-table-dismiss']", function (e) {
        var id = this.id;
        var fullname = $(this).attr('data-name');
        var auth = $(this).attr('data-auth');
        database.collection('booked_table').doc(id).update({'status': 'Order Rejected'}).then(function (result) {

            database.collection('users').where('id', '==', auth).get().then(function (snapshots) {
                if (snapshots.length) {
                    snapshots.forEach((doc) => {
                        if (doc.fcmToken) {
                            $.ajax({
                                method: 'POST',
                                url: '<?php echo route('sendnotification'); ?>',
                                data: {
                                    'fcm': doc.fcmToken,
                                    'type': 'booktable_request_reject',
                                    'authorName': fullname,
                                    '_token': '<?php echo csrf_token() ?>'
                                }
                            }).done(function (data) {
                                window.location.href = '{{ url()->current() }}';
                            }).fail(function (xhr, textStatus, errorThrown) {
                                window.location.href = '{{ url()->current() }}';
                            });
                        } else {
                            window.location.href = '{{ url()->current() }}';
                        }
                    });
                } else {
                    window.location.href = '{{ url()->current() }}';
                }
            });


        });

    });


</script>

@endsection
