@extends('layouts.app')


<?php

error_reporting(E_ALL ^ E_NOTICE);
?>

@section('content')
    <div class="page-wrapper">


        <div class="row page-titles">

            <div class="col-md-5 align-self-center">

                <h3 class="text-themecolor">{{ trans('lang.driver')}} {{trans('lang.payment_plural')}}</h3>

            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{ trans('lang.driver')}} {{trans('lang.payment_plural')}}</li>
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

                            <!-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> -->
                            <div id="users-table_filter" class="pull-right"><label>{{trans('lang.search_by')}}
                                    <select name="selected_search" id="selected_search" class="form-control input-sm">
                                        <option value="vendor">{{ trans('lang.driver')}}</option>
                                    </select>
                                    <div class="form-group">
                                        <input type="search" id="search" class="search form-control"
                                               placeholder="Search" aria-controls="users-table">
                                </label>&nbsp;<button onclick="searchtext();"
                                                      class="btn btn-warning btn-flat">{{trans('lang.search')}}</button>&nbsp;<button
                                        onclick="searchclear();"
                                        class="btn btn-warning btn-flat">{{trans('lang.clear')}}</button>
                            </div>
                        </div>


                        <div class="table-responsive m-t-10">


                            <table id="example24"
                                   class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                   cellspacing="0" width="100%">

                                <thead>

                                <tr>
                                    <th>{{ trans('lang.driver')}}</th>
                                    <th>{{ trans('lang.total_amount')}}</th>
                                    <th>{{trans('lang.paid_amount')}}</th>
                                    <th>{{trans('lang.remaining_amount')}}</th>
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
        // var ref=[];
        // var ref = database.collection('vendors_review');
        var ref = database.collection('users').where('role', '==', 'driver');
        /* var  user_search = database.collection('users'); */

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
                jQuery("#data-table_processing").hide();
                if (html != '') {
                    append_list.innerHTML = html;
                    start = snapshots.docs[snapshots.docs.length - 1];
                    endarray.push(snapshots.docs[0]);
                    if (snapshots.docs.length < pagesize) {
                        jQuery("#data-table_paginate").hide();
                    }
                }
            });

        });


        function buildHTML(snapshots) {
            var html = '';
            var alldata = [];
            var number = [];
            snapshots.docs.forEach((listval) => {
                var datas = listval.data();

                alldata.push(datas);
            });


            /* alldata.sort(function(a, b) {
                 console.log(a);
               var keyA = a.createdAt,
                keyB = b.createdAt;
                  console.log(keyA);
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
                // const total_price=totalPrice(val.id);
                // html=html+'<td class="name_'+val.id+'"></td>';

                html = html + '<td data-url="' + route1 + '" class="redirecttopage">' + val.firstName + ' ' + val.lastName + '</td>';
                html = html + '<td class="total_' + val.id + '"></td>';
                html = html + '<td class="name_' + val.id + '"></td>';
                const remaining_price = remainingPrice(val.id);
                html = html + '<td class="remaining_' + val.id + '"></td>';
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

                console.log(jQuery("#selected_search").val());
                if (jQuery("#selected_search").val() == 'vendor' && jQuery("#search").val().trim() != '') {
                    listener = ref.orderBy('firstName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAt(end).get();

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

                    listener = ref.orderBy('firstName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAfter(start).get();

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

                wherequery = ref.orderBy('firstName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();

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

        // async function totalPrice(driverID) {
        // var price=0;
        // await database.collection('vendor_orders').where('driverID','==',driverID).where("status","==","Order Completed").get().then( async function(orderSnapshots){

        //             orderSnapshots.docs.forEach((order)=>{

        //               var orderData = order.data();

        //               orderData.products.forEach((product)=> {

        //                   if(product.price && product.quantity != 0){
        //                     var productTotal = parseInt(product.price)*parseInt(product.quantity);
        //                     price = price + productTotal;
        //                   }
        //                 })

        //             })
        // });
        // jQuery(".name_"+driverID).html(price);
        // return price;
        // }

        async function remainingPrice(driverID) {

            var paid_price = 0;

            var total_price = 0;

            var remaining = 0;

            await database.collection('driver_payouts').where('driverID', '==', driverID).get().then(async function (payoutSnapshots) {

                payoutSnapshots.docs.forEach((payout) => {

                    var payoutData = payout.data();

                    paid_price = parseFloat(paid_price) + parseFloat(payoutData.amount);

                })


                /*await database.collection('vendor_orders').where('driverID','==',driverID).where("status","in",["Order Completed"]).get().then( async function(orderSnapshots){



                    orderSnapshots.docs.forEach((order)=>{

                      var orderData = order.data();



                        if(orderData.deliveryCharge!=undefined && orderData.tip_amount!=undefined){

                            var orderDataTotal = parseInt(orderData.deliveryCharge)+parseInt(orderData.tip_amount);

                            total_price = total_price + orderDataTotal;

                          }else if(orderData.deliveryCharge!=undefined){

                            var orderDataTotal = parseInt(orderData.deliveryCharge);

                            total_price = total_price + orderDataTotal;

                          }else if(orderData.tip_amount!=undefined){

                            var orderDataTotal = parseInt(orderData.tip_amount);

                            total_price = total_price + orderDataTotal;

                          }





                    })



                    remaining = total_price - paid_price;*/

                await database.collection('users').where('id', '==', driverID).get().then(async function (driverSnapshots) {
                    var driver = [];
                    var wallet_amount = 0;
                    if (driverSnapshots.docs.length) {
                        driver = driverSnapshots.docs[0].data();
                        if (isNaN(driver.wallet_amount) || driver.wallet_amount == undefined) {
                            wallet_amount = 0;
                        } else {
                            wallet_amount = driver.wallet_amount;
                        }

                    }

                    remaining = wallet_amount;

                    total_price = wallet_amount + paid_price;


                    if (Number.isNaN(paid_price)) {

                        paid_price = 0;

                    }

                    if (Number.isNaN(total_price)) {

                        total_price = 0;

                    }

                    if (Number.isNaN(remaining)) {

                        remaining = 0;

                    }

                    if (currencyAtRight) {

                        total_price_val = parseFloat(total_price).toFixed(decimal_degits) + "" + currentCurrency;

                        paid_price_val = parseFloat(paid_price).toFixed(decimal_degits) + "" + currentCurrency;

                        remaining_val = parseFloat(remaining).toFixed(decimal_degits) + "" + currentCurrency;

                    } else {

                        total_price_val = currentCurrency + "" + parseFloat(total_price).toFixed(decimal_degits);

                        paid_price_val = currentCurrency + "" + parseFloat(paid_price).toFixed(decimal_degits);

                        remaining_val = currentCurrency + "" + parseFloat(remaining).toFixed(decimal_degits);

                    }

                    jQuery(".total_" + driverID).html(total_price_val);

                    jQuery(".name_" + driverID).html(paid_price_val);

                    jQuery(".remaining_" + driverID).html(remaining_val);

                    jQuery("#data-table_processing").hide();

                });

            });

            return remaining;

        }


    </script>



@endsection
