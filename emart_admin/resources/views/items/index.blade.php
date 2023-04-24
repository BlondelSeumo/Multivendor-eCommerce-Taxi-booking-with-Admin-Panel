@extends('layouts.app')


@section('content')
<div class="page-wrapper">

    <!-- ============================================================== -->

    <!-- Bread crumb and right sidebar toggle -->

    <!-- ============================================================== -->

    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor itemTitle">{{trans('lang.item_plural')}}</h3>

        </div>

        <div class="col-md-7 align-self-center">

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.item_plural')}}</li>
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
                            <li class="active">
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
                                            class="fa fa-list mr-2"></i>{{trans('lang.item_table')}}</a>
                            </li>
                            <?php if ($id != '') { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="{!! route('items.create') !!}/{{$id}}"><i
                                                class="fa fa-plus mr-2"></i>{{trans('lang.item_create')}}</a>
                                </li>
                            <?php } else { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="{!! route('items.create') !!}"><i
                                                class="fa fa-plus mr-2"></i>{{trans('lang.item_create')}}</a>
                                </li>
                            <?php } ?>

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
                                    <label>{{trans('lang.search_by')}}
                                        <select name="selected_search" id="selected_search"
                                                class="form-control input-sm">
                                            <option value="title">{{trans('lang.title')}}</option>
                                            <option value="store">{{trans('lang.item_vendor_id')}}</option>
                                            <option value="category">{{trans('lang.category')}}</option>

                                            <?php if ($id != '') { ?>
                                                <option value="brand">{{trans('lang.brand')}}</option>

                                            <?php } ?>
                                        </select>
                                        <div class="form-group">
                                            <input type="search" id="search" class="search form-control"
                                                   placeholder="Search">
                                            <select id="category_search_dropdown" class="form-control">
                                                <option value="All">
                                                    Select Category
                                                </option>
                                            </select>
                                            <?php if ($id != '') { ?>
                                                <select id="brand_search_dropdown" class="form-control">
                                                    <option value='All'>Select Brand</option>

                                                </select>
                                            <?php } ?>


                                        </div>

                                    </label>
                                    <button onclick="searchtext();" class="btn btn-warning btn-flat">
                                        {{trans('lang.search')}}
                                    </button>&nbsp;<button onclick="searchclear();"
                                                           class="btn btn-warning btn-flat">
                                        {{trans('lang.clear')}}
                                    </button>
                                </div>
                                <div class="col-sm-3 sectionDiv">
                                    <select id="section_id" class="form-control allModules" style="width:100%"
                                            onchange="clickLink(this.value)">
                                        <option value="">{{trans('lang.select')}} {{trans('lang.section_plural')}}
                                        </option>
                                    </select>
                                    <p style="color: red;font-size: 13px;"> Rental/Parcel/Cab Service are not shown in this
                                        sections</p>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive m-t-10">


                            <table id="itemTable"
                                   class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                   cellspacing="0" width="100%">

                                <thead>

                                <tr>
                                    <th class="delete-all"><input type="checkbox" id="is_active"><label
                                                class="col-3 control-label" for="is_active"
                                        ><a id="deleteAll" class="do_not_delete"
                                            href="javascript:void(0)"><i
                                                        class="fa fa-trash"></i> {{trans('lang.all')}}</a></label></th>

                                    <th>{{trans('lang.item_image')}}</th>
                                    <th>{{trans('lang.item_name')}}</th>
                                    <th>{{trans('lang.item_price')}}</th>
                                    <th>{{trans('lang.section')}}</th>
                                    <?php if ($id == '') { ?>
                                        <th>{{trans('lang.item_vendor_id')}}</th>
                                    <?php } ?>

                                    <th>{{trans('lang.item_category_id')}}</th>

                                    <th>{{trans('lang.brand')}}</th>

                                    <th>{{trans('lang.item_publish')}}</th>
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
</div>


@endsection


@section('scripts')
<script type="text/javascript">
    const urlParams = new URLSearchParams(location.search);
    for (const [key, value] of urlParams) {
        if (key == 'brandID') {
            var brandID = value;
        } else {
            var brandID = '';
        }
        if (key == 'categoryID') {
            var categoryID = value;
        } else {
            var categoryID = '';
        }

    }
    var database = firebase.firestore();
    var offest = 1;
    var pagesize = 10;
    var end = null;
    var endarray = [];
    var start = null;
    var user_number = [];
    var currentCurrency = '';
    var currencyAtRight = false;
    var decimal_degits = 0;
    var ref_sections = database.collection('sections');

    <?php if($id != ''){ ?>
    $('.sectionDiv').hide();
    const getStoreName = getStoreNameFunction('<?php echo $id; ?>');

    var ref = database.collection('vendor_products').where('vendorID', '==', '<?php echo $id; ?>');
    <?php }else{ ?>
    var section_id = getCookie('section_id');
    $('.sectionDiv').show();
    
    if (brandID != '' && brandID != undefined) {
        if (section_id != '') {
            var ref = database.collection('vendor_products').where('brandID', '==', brandID).where('section_id', '==', section_id);
        } else {
            var ref = database.collection('vendor_products').where('brandID', '==', brandID);
        }

    } else if (categoryID != '' && categoryID != undefined) {
        if (section_id != '') {
            var ref = database.collection('vendor_products').where('categoryID', '==', categoryID).where('section_id', '==', section_id);
        } else {
            var ref = database.collection('vendor_products').where('categoryID', '==', categoryID);
        }
    } else {
        if (section_id != '') {
            var ref = database.collection('vendor_products').where('section_id', '==', section_id);

        } else {
            var ref = database.collection('vendor_products');

        }
    }

    <?php } ?>

    async function getStoreNameFunction(vendorId) {
        var vendorName = '';
        await database.collection('vendors').where('id', '==', vendorId).get().then(async function (snapshots) {
            var vendorData = snapshots.docs[0].data();

            vendorName = vendorData.title;
            $('.itemTitle').html("{{trans('lang.item_plural')}} - " + vendorName);

            if (vendorData.dine_in_active == true) {
                $(".dine_in_future").show();
            }

        });

        return vendorName;

    }

    /* if (section_id != '') {

<?php if($id != ''){ ?>
        $('.sectionDiv').hide();
<?php }else{ ?>
        $('.sectionDiv').show();
<?php } ?>

        var ref = database.collection('vendor_products').where('section_id', '==', section_id);
    } else {
        <?php if($id != ''){ ?>
        $('.sectionDiv').hide();
    var ref = database.collection('vendor_products').where('vendorID', '==', '<?php echo $id; ?>');
        <?php }else{ ?>
        $('.sectionDiv').show();
 var ref = database.collection('vendor_products');
<?php } ?>
        }*/

    var refCurrency = database.collection('currencies').where('isActive', '==', true);
    var append_list = '';

    refCurrency.get().then(async function (snapshots) {
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;

        if(currencyData.decimal_degits){
            decimal_degits = currencyData.decimal_degits;
        }
    });

    var placeholderImage = '';
    var placeholder = database.collection('settings').doc('placeHolderImage');
    placeholder.get().then(async function (snapshotsimage) {
        var placeholderImageData = snapshotsimage.data();
        placeholderImage = placeholderImageData.image;
    })

    $(document).ready(function () {
        $('#brand_search_dropdown').hide();
        $('#category_search_dropdown').hide();

        $(document.body).on('click', '.redirecttopage', function () {
            var url = $(this).attr('data-url');
            window.location.href = url;
        });

        ref_sections.get().then(async function (snapshots) {

            snapshots.docs.forEach((listval) => {
                var data = listval.data();
                if (data.serviceTypeFlag == "delivery-service" || data.serviceTypeFlag == "ecommerce-service") {

                    $('#section_id').append($("<option></option>")
                        .attr("value", data.id)
                        .text(data.name));
                }
            })

            $('#section_id').val(section_id);
        })

        $(document.body).on('change', '#selected_search', function () {

            if (jQuery(this).val() == 'brand') {
                database.collection('brands').get().then(async function (snapshots) {
                    snapshots.docs.forEach((listval) => {
                        var data = listval.data();
                        $('#brand_search_dropdown').append($("<option></option").attr("value", data.id).text(data.title));
                    });

                });
                jQuery('#brand_search_dropdown').show();
                jQuery('#search').hide();
                jQuery('#category_search_dropdown').hide();
            } else if (jQuery(this).val() == 'category') {
                var section_id = getCookie('section_id');
                if (section_id != '') {
                    var ref_category = database.collection('vendor_categories').where('section_id', '==', section_id);
                } else {
                    var ref_category = database.collection('vendor_categories');
                }
                ref_category.get().then(async function (snapshots) {
                    snapshots.docs.forEach((listval) => {
                        var data = listval.data();
                        $('#category_search_dropdown').append($("<option></option").attr("value", data.id).text(data.title));

                    });

                });
                jQuery('#brand_search_dropdown').hide();
                jQuery('#search').hide();
                jQuery('#category_search_dropdown').show();
            } else {
                jQuery('#brand_search_dropdown').hide();
                jQuery('#search').show();
                jQuery('#category_search_dropdown').hide();

            }
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
                //disableClick();
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
            datas.id = listval.id;
            alldata.push(datas);
        });

        var count = 0;
        alldata.forEach((listval) => {

            var val = listval;

            html = html + '<tr>';
            newdate = '';

            var id = val.id;
            var route1 = '{{route("items.edit",":id")}}';
            route1 = route1.replace(':id', id);
            //  var route_view = '//route("items.view",":id")';
            //route_view = route_view.replace(':id', id);

            <?php if($id != ''){ ?>

            route1 = route1 + '?eid={{$id}}';

            <?php }?>

            var caregoryroute = '{{route("categories.edit",":id")}}';
            caregoryroute = caregoryroute.replace(':id', val.categoryID);


            var vendorroute = '{{route("vendors.view",":id")}}';
            vendorroute = vendorroute.replace(':id', val.vendorID);


            var brandroute = '{{route("brands.edit",":id")}}';
            brandroute = brandroute.replace(':id', val.brandID);


            html = html + '<td class="delete-all"><input type="checkbox" id="is_open_' + id + '" class="is_open" dataId="' + id + '"><label class="col-3 control-label"\n' +
                'for="is_open_' + id + '" ></label></td>';

            if (val.photo != '') {
                html = html + '<td><img class="rounded" style="width:50px" src="' + val.photo + '" alt="image"></td>';

            } else {

                html = html + '<td><img class="rounded" style="width:50px" src="' + placeholderImage + '" alt="image"></td>';
            }
            html = html + '<td data-url="' + route1 + '" class="redirecttopage">' + val.name + '</td>';

            /* priceFood = "";
             if(currencyAtRight){
                 priceFood = val.price+""+currentCurrency;
             }else{
                  priceFood = currentCurrency+""+val.price;
             }

             html=html+'<td>'+priceFood+'</td>';*/

            if (val.hasOwnProperty('disPrice') && val.disPrice != '' && val.disPrice != '0') {
                if (currencyAtRight) {

                    html = html + '<td>' + parseFloat(val.disPrice).toFixed(decimal_degits) + '' + currentCurrency + '  <s>' + parseFloat(val.price).toFixed(decimal_degits) + '' + currentCurrency + '</s></td>';
                } else {
                    html = html + '<td>' + '' + currentCurrency + parseFloat(val.disPrice).toFixed(decimal_degits) + '  <s>' + currentCurrency + '' + parseFloat(val.price).toFixed(decimal_degits) + '</s> </td>';
                }

            } else {

                if (currencyAtRight) {
                    html = html + '<td>' + parseFloat(val.price).toFixed(decimal_degits) + '' + currentCurrency + '</td>';
                } else {
                    html = html + '<td>' + currentCurrency + '' + parseFloat(val.price).toFixed(decimal_degits) + '</td>';
                }
            }

            if (val.section_id != undefined) {
                const sectionName = productsection(val.section_id);
                html = html + '<td  class="section_' + val.section_id + '"></td>';

            } else {
                html = html + '<td></td>';

            }

            <?php if($id == ''){ ?>
            const vendor = productvendor(val.vendorID);
            html = html + '<td data-url="' + vendorroute + '" class="redirecttopage vendor_' + val.vendorID + '"></td>';
            <?php }?>

            //deletedata(val.vendorID);

            const category = productCategory(val.categoryID);
            html = html + '<td data-url="' + caregoryroute + '" class="redirecttopage category_' + val.categoryID + '"></td>';


            if (val.hasOwnProperty('brandID')) {
                var brand = productBrand(val.brandID);
            } else {
                var brand = '';
            }

            html = html + '<td data-url="' + brandroute + '" class="redirecttopage brand_' + val.brandID + '"></td>';


            if (val.publish) {
                html = html + '<td><label class="switch"><input type="checkbox" checked id="' + val.id + '" name="publish"><span class="slider round"></span></label></td>';
            } else {
                html = html + '<td><label class="switch"><input type="checkbox" id="' + val.id + '" name="publish"><span class="slider round"></span></label></td>';
            }
            html = html + '<td class="action-btn"><a href="' + route1 + '" class="link-td"><i class="fa fa-edit"></i></a><a id="' + val.id + '" name="item-delete" href="javascript:void(0)" class="link-td do_not_delete"><i class="fa fa-trash"></i></a></td>';

            html = html + '</tr>';
            count = count + 1;
        });
        return html;
    }
    /* toggal publish action code start*/
        $(document).on("click","input[name='publish']",function(e){
            var ischeck=$(this).is(':checked');
            var id=this.id;
            if(ischeck){
              database.collection('vendor_products').doc(id).update({'publish': true}).then(function (result) {

              });
            }else{
              database.collection('vendor_products').doc(id).update({'publish': false}).then(function (result) {

              });
            }

        });

    /*toggal publish action code end*/


    $("#is_active").click(function () {
        $("#itemTable .is_open").prop('checked', $(this).prop('checked'));

    });

    $("#deleteAll").click(function () {
        if ($('#itemTable .is_open:checked').length) {
            if (confirm('Are You Sure want to Delete Selected Data ?')) {
                jQuery("#data-table_processing").show();
                $('#itemTable .is_open:checked').each(function () {
                    var dataId = $(this).attr('dataId');

                    database.collection('vendor_products').doc(dataId).delete().then(function () {

                        window.location.reload();
                    });

                });

            }
        } else {
            alert('Please Select Any One Record .');
        }
    });

    // async function deletedata(vendorId) {
    //
    //     var refCurrency = database.collection('vendors').where('id', '==', vendorId);
    //
    //     refCurrency.get().then(async function (snapshotsVendor) {
    //
    //         if (snapshotsVendor.docs.length == 0) {
    //             database.collection('vendor_products').doc(id).delete().then(function () {
    //             })
    //         }
    //
    //     });
    // }

    //<td class="action-btn"><a href="' + route_view + '"><i class="fa fa-eye"></i></a>

    async function productsection(section) {
        var productsection = '';
        await database.collection('sections').where("id", "==", section).get().then(async function (snapshotss) {

            if (snapshotss.docs[0]) {
                var section_data = snapshotss.docs[0].data();
                productsection = section_data.name;

                jQuery(".section_" + section).html(productsection);
            } else {
                jQuery(".section_" + section).html('');
            }
        });
        return productsection;
    }

    async function productvendor(vendor) {
        var productvendor = '';
        await database.collection('vendors').where("id", "==", vendor).get().then(async function (snapshotss) {
            var vendorroute = '{{route("vendors.edit",":id")}}';
            vendorroute = vendorroute.replace(':id', vendor);

            if (snapshotss.docs[0]) {
                var vendor_data = snapshotss.docs[0].data();
                productvendor = vendor_data.title;

                jQuery(".vendor_" + vendor).html(productvendor);
            } else {
                jQuery(".vendor_" + vendor).html('');
            }
        });
        return productvendor;
    }

    async function productCategory(category) {
        var productCategory = '';
        await database.collection('vendor_categories').where("id", "==", category).get().then(async function (snapshotss) {
            var caregoryroute = '{{route("categories.edit",":id")}}';
            caregoryroute = caregoryroute.replace(':id', category);
            if (snapshotss.docs[0]) {
                var category_data = snapshotss.docs[0].data();
                productCategory = category_data.title;

                jQuery(".category_" + category).html(productCategory);
            } else {
                jQuery(".category_" + category).html('');
            }
        });
        return productCategory;
    }

    async function productBrand(brand) {
        var productBrand = '';
        await database.collection('brands').where("id", "==", brand).get().then(async function (snapshotss) {
            var brandroute = '{{route("brands.edit",":id")}}';
            brandroute = brandroute.replace(':id', brand);
            if (snapshotss.docs[0]) {
                var brand_data = snapshotss.docs[0].data();
                productBrand = brand_data.title;

                jQuery(".brand_" + brand).html(productBrand);
            } else {
                jQuery(".brand" + brand).html('');
            }
        });
        return productBrand;
    }

    function prev() {
        if (endarray.length == 1) {
            return false;
        }
        end = endarray[endarray.length - 2];
        if (end != undefined || end != null) {
            jQuery("#data-table_processing").show();
            if (jQuery("#selected_search").val() == 'title' && jQuery("#search").val().trim() != '') {

                listener = ref.orderBy('name').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAt(end).get();

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
            } else if (jQuery("#selected_search").val() == 'brand' && jQuery("#brand_search_dropdown").val().trim() != '') {
                if (jQuery("#brand_search_dropdown").val() == "All") {
                    listener = ref.startAt(end).limit(pagesize).get();
                } else {
                    listener = ref.orderBy('brandID').limit(pagesize).startAt(jQuery("#brand_search_dropdown").val()).endAt(jQuery("#brand_search_dropdown").val() + '\uf8ff').startAt(end).get();

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
            } else if (jQuery("#selected_search").val() == 'category' && jQuery("#category_search_dropdown").val().trim() != '') {

                if (jQuery("#category_search_dropdown").val() == "All") {
                    wherequery = ref.limit(pagesize).startAt(end).get();
                } else {
                    wherequery = ref.orderBy('categoryID').limit(pagesize).startAt(jQuery("#category_search_dropdown").val()).endAt(jQuery("#category_search_dropdown").val() + '\uf8ff').startAt(end).get();

                }

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

            } else if (jQuery("#selected_search").val() == 'store' && jQuery("#search").val().trim() != '') {
                title = jQuery("#search").val();

                database.collection('vendors').where('title', '==', title).get().then(async function (snapshots) {

                    if (snapshots.docs.length > 0) {
                        var storedata = snapshots.docs[0].data();

                        wherequery = ref.orderBy('vendorID').limit(pagesize).startAt(storedata.id).endAt(storedata.id + '\uf8ff').startAt(end).get();

                        wherequery.then((snapshotsInner) => {
                            html = '';
                            html = buildHTML(snapshotsInner);
                            jQuery("#data-table_processing").hide();
                            if (html != '') {
                                append_list.innerHTML = html;
                                start = snapshotsInner.docs[snapshotsInner.docs.length - 1];

                                endarray.splice(endarray.indexOf(endarray[endarray.length - 1]), 1);

                                if (snapshotsInner.docs.length < pagesize) {

                                    jQuery("#users_table_previous_btn").hide();
                                }

                            }
                        });
                    } else {
                        jQuery("#data-table_processing").hide();
                    }

                });

            } else {
                listener = ref.startAt(end).limit(pagesize).get();

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
    }

    function next() {
        if (start != undefined || start != null) {
            jQuery("#data-table_processing").show();

            if (jQuery("#selected_search").val() == 'title' && jQuery("#search").val().trim() != '') {

                listener = ref.orderBy('name').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAfter(start).get();
            } else if (jQuery("#selected_search").val() == 'brand' && jQuery("#brand_search_dropdown").val().trim() != '') {
                if (jQuery("#brand_search_dropdown").val() == "All") {
                    listener = ref.startAfter(start).limit(pagesize).get();
                } else {
                    listener = ref.orderBy('brandID').limit(pagesize).startAt(jQuery("#brand_search_dropdown").val()).endAt(jQuery("#brand_search_dropdown").val() + '\uf8ff').startAfter(start).get();

                }
            } else if (jQuery("#selected_search").val() == 'category' && jQuery("#category_search_dropdown").val().trim() != '') {

                if (jQuery("#category_search_dropdown").val() == "All") {
                    wherequery = ref.limit(pagesize).startAfter(start).get();
                } else {
                    wherequery = ref.orderBy('categoryID').limit(pagesize).startAt(jQuery("#category_search_dropdown").val()).endAt(jQuery("#category_search_dropdown").val() + '\uf8ff').startAfter(start).get();

                }

                wherequery.then((snapshots) => {

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

            } else if (jQuery("#selected_search").val() == 'store' && jQuery("#search").val().trim() != '') {
                title = jQuery("#search").val();

                database.collection('vendors').where('title', '==', title).get().then(async function (snapshots) {

                    if (snapshots.docs.length > 0) {
                        var storedata = snapshots.docs[0].data();

                        wherequery = ref.orderBy('vendorID').limit(pagesize).startAt(storedata.id).endAt(storedata.id + '\uf8ff').startAfter(start).get();

                        wherequery.then((snapshotsInner) => {

                            html = '';
                            html = buildHTML(snapshotsInner);

                            jQuery("#data-table_processing").hide();
                            if (html != '') {
                                append_list.innerHTML = html;
                                start = snapshotsInner.docs[snapshotsInner.docs.length - 1];

                                if (endarray.indexOf(snapshotsInner.docs[0]) != -1) {
                                    endarray.splice(endarray.indexOf(snapshotsInner.docs[0]), 1);
                                }
                                endarray.push(snapshotsInner.docs[0]);
                            }
                        });
                    } else {
                        jQuery("#data-table_processing").hide();
                    }

                });

            } else {
                listener = ref.startAfter(start).limit(pagesize).get();

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
    }

    function searchclear() {
        jQuery("#search").val('');
        $('#brand_search_dropdown').val("All").trigger('change');
        $('#category_search_dropdown').val("All").trigger('change');
        searchtext();
    }

    function searchtext() {
        var offest = 1;
        jQuery("#data-table_processing").show();

        append_list.innerHTML = '';

        if (jQuery("#selected_search").val() == 'title' && jQuery("#search").val().trim() != '') {

            wherequery = ref.orderBy('name').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();
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

        } else if (jQuery("#selected_search").val() == 'store' && jQuery("#search").val().trim() != '') {
            title = jQuery("#search").val();

            database.collection('vendors').where('title', '==', title).get().then(async function (snapshots) {

                if (snapshots.docs.length > 0) {
                    var storedata = snapshots.docs[0].data();

                    wherequery = ref.orderBy('vendorID').limit(pagesize).startAt(storedata.id).endAt(storedata.id + '\uf8ff').get();

                    wherequery.then((snapshotsInner) => {
                        html = '';
                        html = buildHTML(snapshotsInner);
                        jQuery("#data-table_processing").hide();
                        if (html != '') {
                            append_list.innerHTML = html;
                            start = snapshotsInner.docs[snapshotsInner.docs.length - 1];
                            endarray.push(snapshotsInner.docs[0]);
                            if (snapshotsInner.docs.length < pagesize) {

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

        } else if (jQuery("#selected_search").val() == 'brand' && jQuery("#brand_search_dropdown").val().trim() != '') {
            if (jQuery("#brand_search_dropdown").val() == "All") {
                wherequery = ref.limit(pagesize).get();
            } else {
                wherequery = ref.orderBy('brandID').limit(pagesize).startAt(jQuery("#brand_search_dropdown").val()).endAt(jQuery("#brand_search_dropdown").val() + '\uf8ff').get();

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
        } else if (jQuery("#selected_search").val() == 'category' && jQuery("#category_search_dropdown").val().trim() != '') {

            if (jQuery("#category_search_dropdown").val() == "All") {
                wherequery = ref.limit(pagesize).get();
            } else {
                wherequery = ref.orderBy('categoryID').limit(pagesize).startAt(jQuery("#category_search_dropdown").val()).endAt(jQuery("#category_search_dropdown").val() + '\uf8ff').get();

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
                    if (snapshots.docs.length < pagesize) {

                        jQuery("#data-table_paginate").hide();
                    } else {

                        jQuery("#data-table_paginate").show();
                    }
                }
            });
        }


    }

    $(document).on("click", "a[name='item-delete']", function (e) {
        var id = this.id;
        jQuery("#data-table_processing").show();
        database.collection('vendor_products').doc(id).delete().then(function (result) {
            window.location.href = '{{ url()->current() }}';
        });


    });

    function clickLink(value) {
        setCookie('section_id', value, 30);
        location.reload();
    }

</script>


@endsection
