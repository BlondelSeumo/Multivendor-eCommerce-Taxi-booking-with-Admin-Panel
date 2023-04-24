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

            <h3 class="text-themecolor">{{trans('lang.coupon_plural')}} <span class="storeTitle"></span></h3>

        </div>

        <div class="col-md-7 align-self-center">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                <li class="breadcrumb-item active">{{trans('lang.coupon_table')}}</li>

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
                            <li class="active">
                                <a href="{{route('vendors.coupons',$id)}}">{{trans('lang.tab_promos')}}</a>
                            <li>
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
                                            class="fa fa-list mr-2"></i>{{trans('lang.coupon_table')}}</a>
                            </li>
                            <?php if ($id != '') { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="{!! route('coupons.create') !!}/{{$id}}"><i
                                                class="fa fa-plus mr-2"></i>{{trans('lang.coupon_create')}}</a>
                                </li>
                            <?php } else { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="{!! route('coupons.create') !!}"><i
                                                class="fa fa-plus mr-2"></i>{{trans('lang.coupon_create')}}</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                             style="display: none;">Processing...
                        </div>

                        <!-- <h4 class="card-title"><?php //echo $customers_list ?></h4> -->

                        <!-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> -->
                        <div id="users-table_filter" class="pull-right">
                            <div class="row">

                                <div class="col-sm-9">
                                    <label>{{ trans('lang.search_by')}}

                                        <select name="selected_search" id="selected_search"
                                                class="form-control input-sm">
                                            <option value="code">{{trans('lang.coupon_code')}}</option>
                                            <option value="description">{{trans('lang.coupon_description')}}</option>
                                        </select>

                                        <div class="form-group">
                                            <input type="search" id="search" class="search form-control"
                                                   placeholder="Search" aria-controls="users-table">
                                    </label>&nbsp;<button onclick="searchtext();" class="btn btn-warning btn-flat">{{
                                        trans('lang.search')}}
                                    </button>&nbsp;<button onclick="searchclear();" class="btn btn-warning btn-flat">{{
                                        trans('lang.clear')}}
                                    </button>
                                </div>
                            </div>
                            <div class="col-sm-3 sectionDiv">
                                <select id="section_id" class="form-control allModules" style="width:100%"
                                        onchange="clickLink(this.value)">
                                    <option value="">{{trans('lang.select')}} {{trans('lang.section_plural')}}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive m-t-10">

                        <table id="couponTable"
                               class="display nowrap table table-hover table-striped table-bordered table table-striped"
                               cellspacing="0" width="100%">

                            <thead>

                            <tr>
                                <th class="delete-all"><input type="checkbox" id="is_active"><label
                                            class="col-3 control-label" for="is_active"
                                    ><a id="deleteAll" class="do_not_delete"
                                        href="javascript:void(0)"><i
                                                    class="fa fa-trash"></i> {{trans('lang.all')}}</a></label></th>

                                <th>{{trans('lang.coupon_code')}}</th>

                                <th>{{trans('lang.coupon_discount')}}</th>
                                <th>{{trans('lang.vendor')}}</th>

                                <th>{{trans('lang.section')}}</th>

                                <th>{{trans('lang.coupon_expires_at')}}</th>

                                <th>{{trans('lang.coupon_enabled')}}</th>

                                <th>{{trans('lang.actions')}}</th>

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
  <script type="text/javascript">@include('vendor.notifications.init_firebase')</script> -->

<script type="text/javascript">

    var database = firebase.firestore();
    var offest = 1;
    var pagesize = 10;
    var end = null;
    var endarray = [];
    var start = null;
    var user_number = [];
    //var ref = database.collection('coupons');
    $('.sectionDiv').hide();

    <?php if($id != ''){ ?>
    getStoreNameFunction('<?php echo $id; ?>');
    var ref = database.collection('coupons').where('vendorID', '==', '<?php echo $id; ?>');
    <?php }else{ ?>
    $('.sectionDiv').show();
    var section_id = getCookie('section_id');
    if (section_id != '') {

        var ref = database.collection('coupons').where('section_id', '==', section_id);

    } else {
        var ref = database.collection('coupons');

    }
    <?php } ?>

    var ref_sections = database.collection('sections');

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


        ref_sections.get().then(async function (snapshots) {

            snapshots.docs.forEach((listval) => {
                var data = listval.data();
                $('#section_id').append($("<option value=''>{{trans('lang.select')}} {{trans('lang.section_plural')}}</option>")
                    .attr("value", data.id)
                    .text(data.name));
            })

            $('#section_id').val(section_id);
        })

    });

    function clickLink(value) {
        setCookie('section_id', value, 30);
        location.reload();
    }

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


        //     alldata.sort(function(a, b) {

        //       var keyA = a.createdAt.seconds,
        //         keyB = b.createdAt.seconds;

        //       if (keyA < keyB) return -1;
        //       if (keyA > keyB) return 1;
        //       return 0;
        // });
        var count = 0;
        alldata.forEach((listval) => {

            var val = listval;

            html = html + '<tr>';
            newdate = '';
            if (currencyAtRight) {
                if (val.discountType == 'Percent' || val.discountType == 'Percentage') {
                    discount_price = val.discount + "%";
                } else {
                    discount_price = parseFloat(val.discount).toFixed(decimal_degits) + "" + currentCurrency;
                }
            } else {
                if (val.discountType == 'Percent' || val.discountType == 'Percentage') {
                    discount_price = val.discount + "%";
                } else {
                    discount_price = currentCurrency + "" + parseFloat(val.discount).toFixed(decimal_degits);
                }
            }
            var id = val.id;
            var route1 = '{{route("coupons.edit",":id")}}';
            route1 = route1.replace(':id', id);
            <?php if($id != ''){ ?>
            route1 = route1 + '?eid={{$id}}';
            <?php }?>
            // console.log('val'+JSON.stringify(val));

            html = html + '<td class="delete-all"><input type="checkbox" id="is_open_' + id + '" class="is_open" dataId="' + id + '"><label class="col-3 control-label"\n' +
                'for="is_open_' + id + '" ></label></td>';

            html = html + '<td  data-url="' + route1 + '" class="redirecttopage">' + val.code + '</td>';
            html = html + '<td>' + discount_price + '</td>';

            const store = getStoreName(val.vendorID);
            html = html + '<td class="storeName_' + val.vendorID + '"></td>';

            const sectionID = getSectionName(val.section_id)
            html = html + '<td class="section'+val.section_id+'"></td>';
            var date = '';
            var time = '';
            if (val.hasOwnProperty("expiresAt")) {

                try {
                    date = val.expiresAt.toDate().toDateString();
                    time = val.expiresAt.toDate().toLocaleTimeString('en-US');
                } catch (err) {

                }
                html = html + '<td>' + date + '</td>';
            } else {
                html = html + '<td></td>';
            }
            if (val.isEnabled) {
              html = html + '<td><label class="switch"><input type="checkbox" checked id="' + val.id + '" name="isEnabled"><span class="slider round"></span></label></td>';
            } else {
              html = html + '<td><label class="switch"><input type="checkbox" id="' + val.id + '" name="isEnabled"><span class="slider round"></span></label></td>';
            }

            // if(val.hasOwnProperty("updatedAt")){
            //   var date =  val.updatedAt.toDate().toDateString();
            //   var time = val.updatedAt.toDate().toLocaleTimeString('en-US');
            //   html = html+'<td>'+time+' '+date+'</td>';
            // }else{
            //   html = html + '<td></td>';
            // }

            html = html + '<td class="action-btn"><a href="' + route1 + '"><i class="fa fa-edit"></i></a><a id="' + val.id + '" name="coupon_delete_btn" class="do_not_delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>';


            html = html + '</tr>';
            count = count + 1;
        });
        return html;
    }
    async function getSectionName(sectionId) {

var refData = await database.collection('sections').where("id", "==", sectionId).get().then(async function (snapshots) {

    var data = snapshots.docs[0].data();

    $('.section' + sectionId).html(data.name);


});

}

    /* toggal publish action code start*/
        $(document).on("click","input[name='isEnabled']",function(e){
            var ischeck=$(this).is(':checked');
            var id=this.id;
            if(ischeck){
              database.collection('coupons').doc(id).update({'isEnabled': true}).then(function (result) {

              });
            }else{
              database.collection('coupons').doc(id).update({'isEnabled': false}).then(function (result) {

              });
            }

        });

    /*toggal publish action code end*/

    async function getStoreName(vendorId) {

        var refData = await database.collection('vendors').where("id", "==", vendorId).get().then(async function (snapshots) {

            var data = snapshots.docs[0].data();

            $('.storeName_' + vendorId).html(data.title);


        });

    }

    $("#is_active").click(function () {
        $("#couponTable .is_open").prop('checked', $(this).prop('checked'));

    });

    $("#deleteAll").click(function () {
        if ($('#couponTable .is_open:checked').length) {
            if (confirm('Are You Sure want to Delete Selected Data ?')) {
                jQuery("#data-table_processing").show();
                $('#couponTable .is_open:checked').each(function () {
                    var dataId = $(this).attr('dataId');

                    database.collection('coupons').doc(dataId).delete().then(function () {

                        window.location.reload();
                    });

                });

            }
        } else {
            alert('Please Select Any One Record .');
        }
    });

    function prev() {
        if (endarray.length == 1) {
            return false;
        }
        end = endarray[endarray.length - 2];

        if (end != undefined || end != null) {
            jQuery("#data-table_processing").show();

            if (jQuery("#selected_search").val() == 'code' && jQuery("#search").val().trim() != '') {

                listener = ref.orderBy('code').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAt(end).get();
            } else if (jQuery("#selected_search").val() == 'description' && jQuery("#search").val().trim() != '') {

                listener = ref.orderBy('description').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAt(end).get();

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
            // listener = ref.startAfter(start).limit(pagesize).get();

            if (jQuery("#selected_search").val() == 'code' && jQuery("#search").val().trim() != '') {

                listener = ref.orderBy('code').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAfter(start).get();
            } else if (jQuery("#selected_search").val() == 'description' && jQuery("#search").val().trim() != '') {
                //console.log("Dsecription");
                listener = ref.orderBy('description').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAfter(start).get();
            } else {
                listener = ref.startAfter(start).limit(pagesize).get();
            }
            listener.then((snapshots) => {

                html = '';
                html = buildHTML(snapshots);
                //console.log(snapshots);
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

        if (jQuery("#selected_search").val() == 'code' && jQuery("#search").val().trim() != '') {

            wherequery = ref.orderBy('code').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();

        } else if (jQuery("#selected_search").val() == 'description' && jQuery("#search").val().trim() != '') {

            wherequery = ref.orderBy('description').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();

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

    $(document).on("click", "a[name='coupon_delete_btn']", function (e) {
        var id = this.id;
        jQuery("#data-table_processing").show();

        database.collection('coupons').doc(id).delete().then(function () {

            window.location = "{{! url()->current() }}";
        });


    });


</script>

@endsection
