@extends('layouts.app')

<?php

error_reporting(E_ALL ^ E_NOTICE);
?>

@section('content')
    <div class="page-wrapper">


        <div class="row page-titles">

            <div class="col-md-5 align-self-center">

                <h3 class="text-themecolor">{{trans('lang.rental_vehicle')}}</h3>

            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('lang.rental_vehicle')}} </li>
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
                                 style="display: none;">{{ trans('lang.processing')}}</div>
                            <!-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> -->
                            <div id="users-table_filter" class="pull-right">
                                <label>{{trans('lang.search_by')}}
                                    <select name="selected_search" id="selected_search" class="form-control input-sm">
                                        <option value="car">{{trans('lang.car_name')}}</option>

                                        <option value="company">{{trans('lang.company_name')}}</option>

                                    </select>
                                </label>&nbsp;
                                <div class="form-group">
                                    <!-- <div id="selected_change"> -->


                                    <input type="search" id="search" class="search form-control" placeholder="Search"
                                           aria-controls="users-table" >

                                    <button onclick="searchtext();"
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

                                        <th>{{trans('lang.image')}}</th>

                                        <th>{{trans('lang.car_name')}}</th>

                                        <th>{{trans('lang.associate_driver')}}</th>

                                        <th>{{trans('lang.company_name')}}</th>

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
        var refData = database.collection('users').where('serviceType','==','rental-service');

        var placeholderImage = '';








        $(document).ready(function () {

            $(document.body).on('click', '.redirecttopage', function () {
                var url = $(this).attr('data-url');
                window.location.href = url;
            });
          //  jQuery('#search').hide();




            jQuery("#data-table_processing").show();
            append_list = document.getElementById('append_list1');
            append_list.innerHTML = '';
            database.collection('users').where('serviceType','==','rental-service').limit(pagesize).get().then(async function (snapshots) {
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

      async function getPlaceHolderImage(id){
          await database.collection('settings').doc('placeHolderImage').get().then(async function(snapshotsimage){
            var placeholderImageData = snapshotsimage.data();
            placeholderImage = placeholderImageData.image;

            $('.image_'+id).attr('src',placeholderImage);
          });
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
                html = html + '<tr>';

                var id = val.id;
                var route1 = '{{route("rental_orders.edit",":id")}}';
                route1 = route1.replace(':id', id);


//console.log(carImage);

                var route1 =  '{{route("drivers.edit",":id")}}';
                route1 = route1.replace(':id', val.id);
                var route2 =  '{{route("drivers.vehicle",":id")}}';
                route2 = route2.replace(':id', val.id);


                  if(val.carPictureURL!=undefined && val.carPictureURL!=''){
                    html = html + '<td><img  style="width:50px" src="'+ val.carPictureURL +'" alt="Image"></td>';

                  }
                  else{
                    console.log('in');
                    getPlaceHolderImage(val.id);
                    html = html + '<td><img class="image_'+val.id+'" style="width:50px" src="" alt="Image"></td>';

                  }

                html = html + '<td>' + val.carName  + '</td>';

                html = html + '<td data-url="'+route1+'" class="redirecttopage driver_'+val.driverID+'">'+val.firstName+" "+val.lastName+'</td>';
                html = html + '<td>' + val.companyName  + '</td>';



                html = html + '<td class="action-btn">' +
                    '<a href="' + route2 + '"><i class="fa fa-eye"></i></a>'+
                    '<a href="' + route1 + '"><i class="fa fa-edit"></i></a>'+

                    '</td>';

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
                if (jQuery("#selected_search").val() == 'car'  && jQuery("#search").val().trim() != '') {

                    listener = refData.orderBy('carName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAt(end).get();

                } else if (jQuery("#selected_search").val() == 'company' && jQuery("#search").val().trim() != '') {

                    listener = refData.orderBy('companyName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAt(end).get();

                } else {
                    listener = refData.startAt(end).limit(pagesize).get();
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
                if (jQuery("#selected_search").val() == 'car'  && jQuery("#search").val().trim() != '') {

                    listener = refData.orderBy('carName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAfter(start).get();

                } else if (jQuery("#selected_search").val() == 'company' && jQuery("#search").val().trim() != '') {

                    listener = refData.orderBy('companyName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAfter(start).get();

                } else {

                    listener = refData.startAfter(start).limit(pagesize).get();
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

            //searchtext();
            location.reload();
        }

        function searchtext() {
            var offest = 1;
            jQuery("#data-table_processing").show();

            append_list.innerHTML = '';

            if (jQuery("#selected_search").val() == 'car'  && jQuery("#search").val().trim() != '') {

                wherequery = refData.orderBy('carName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();

            } else if (jQuery("#selected_search").val() == 'company' && jQuery("#search").val().trim() != '') {

                wherequery = refData.orderBy('companyName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();

            } else {

                wherequery = refData.limit(pagesize).get();
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


    </script>


@endsection
