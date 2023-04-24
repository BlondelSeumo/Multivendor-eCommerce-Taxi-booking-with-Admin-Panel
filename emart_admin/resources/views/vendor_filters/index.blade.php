@extends('layouts.app')



<?php

error_reporting(E_ALL ^ E_NOTICE);
 ?>

@section('content')
        <div class="page-wrapper">


            <div class="row page-titles">

                <div class="col-md-5 align-self-center">

                    <h3 class="text-themecolor">{{trans('lang.vendor_filter')}}</h3>

                </div>

                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('lang.vendor_filter')}}</li>
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
                                    <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.vendor_filter_table')}}</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{!! route('vendorFilters.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.vendor_filter_create')}}</a>
                                  </li>

                              </ul>
                            </div>
                            <div class="card-body">

                                <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>

                                <!-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> -->
                            <div id="users-table_filter" class="pull-right"><label>{{trans('lang.search_by')}}
                                <select name="selected_search" id="selected_search" class="form-control input-sm">
                                    <option value="title">{{ trans('lang.name')}}</option>
                                </select>
                                <div class="form-group">
                                <input type="search" id="search" class="search form-control" placeholder="Search" aria-controls="users-table"></label>&nbsp;<button onclick="searchtext();" class="btn btn-warning btn-flat">{{trans('lang.search')}}</button>&nbsp;<button onclick="searchclear();" class="btn btn-warning btn-flat">{{trans('lang.clear')}}</button>
                            </div>
                            </div>



                                <div class="table-responsive m-t-10">


                                    <table id="example24" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                        <thead>

                                            <tr>
                                                <th>{{ trans('lang.vendor_filter_name')}}</th>
                                                <th>{{trans('lang.vendor_filter_options')}}</th>
                                                <th>{{trans('lang.actions')}}</th>
                                            </tr>

                                        </thead>

                                        <tbody id="append_list1">


                                        </tbody>

                                    </table>
                                                                         <nav aria-label="Page navigation example">
                                         <ul class="pagination justify-content-center">
                                            <li class="page-item ">
                                                <a class="page-link" href="javascript:void(0);" id="users_table_previous_btn" onclick="prev()"  data-dt-idx="0" tabindex="0">{{trans('lang.previous')}}</a>
                                            </li>
                                            <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);" id="users_table_next_btn" onclick="next()"  data-dt-idx="2" tabindex="0">{{trans('lang.next')}}</a>
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



@endsection


@section('scripts')
 <script>

  var database = firebase.firestore();
    var offest=1;
    var pagesize=10;
    var end = null;
    var endarray=[];
    var start = null;
    var user_number = [];
    var ref = database.collection('vendor_filters');

    var append_list = '';

$(document).ready(function() {

    var inx= parseInt(offest) * parseInt(pagesize);
    jQuery("#data-table_processing").show();

    append_list = document.getElementById('append_list1');
    append_list.innerHTML='';
    ref.limit(pagesize).get().then( async function(snapshots){
    html='';

    html=buildHTML(snapshots);
    jQuery("#data-table_processing").hide();
    if(html!=''){
        append_list.innerHTML=html;
        start = snapshots.docs[snapshots.docs.length - 1];
        endarray.push(snapshots.docs[0]);
        if(snapshots.docs.length < pagesize){
            jQuery("#data-table_paginate").hide();
        }
     }
  });

});


function buildHTML(snapshots){
        var html='';
        var alldata=[];
        var number= [];
        snapshots.docs.forEach((listval) => {
            var datas=listval.data();
            datas.id=listval.id;
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

            var val=listval;

                html=html+'<tr>';
                newdate='';

                var id = val.id;
                var route1 =  '{{route("vendorFilters.edit",":id")}}';
                route1 = route1.replace(':id', id);
                var options = val.options.toString();

                html=html+'<td>'+val.name+'</td>';
                html=html+'<td>'+val.options+'</td>';
                html=html+'<td class="action-btn"><a href="'+route1+'"><i class="fa fa-edit"></i></a><a id="'+val.id+'" name="vendor-filter-delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>';



                html=html+'</tr>';
                count =count +1;
          });
          return html;
}

  function prev(){
      if(endarray.length==1){
        return false;
    }
    end=endarray[endarray.length-2];

  if(end!=undefined || end!=null){
            jQuery("#data-table_processing").show();
                 if(jQuery("#selected_search").val()=='title' && jQuery("#search").val().trim()!=''){

                    listener=ref.orderBy('name').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAt(end).get();
                }else{
                    listener = ref.startAt(end).limit(pagesize).get();
                }

                listener.then((snapshots) => {
                html='';
                html=buildHTML(snapshots);
                jQuery("#data-table_processing").hide();
                if(html!=''){
                    append_list.innerHTML=html;
                    start = snapshots.docs[snapshots.docs.length - 1];
                    endarray.splice(endarray.indexOf(endarray[endarray.length-1]),1);

                    if(snapshots.docs.length < pagesize){

                        jQuery("#users_table_previous_btn").hide();
                    }

                }
            });
  }
}


function next(){
  if(start!=undefined || start!=null){

        jQuery("#data-table_processing").hide();
          // listener = ref.startAfter(start).limit(pagesize).get();

          if(jQuery("#selected_search").val()=='title' && jQuery("#search").val().trim()!=''){

                listener=ref.orderBy('name').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAfter(start).get();
            }else{
                listener = ref.startAfter(start).limit(pagesize).get();
            }
          listener.then((snapshots) => {

                html='';
                html=buildHTML(snapshots);
                console.log(snapshots);
                jQuery("#data-table_processing").hide();
                if(html!=''){
                    append_list.innerHTML=html;
                    start = snapshots.docs[snapshots.docs.length - 1];

                    if(endarray.indexOf(snapshots.docs[0])!=-1){
                        endarray.splice(endarray.indexOf(snapshots.docs[0]),1);
                    }
                    endarray.push(snapshots.docs[0]);
                }
            });
    }
}

function searchclear(){
    jQuery("#search").val('');
    searchtext();
}

function searchtext(){

  /* var offest=1;
  var pagesize=10;
  var start = null;
  var end = null;
  var endarray=[];
  var inx= parseInt(offest) * parseInt(pagesize); */
  jQuery("#data-table_processing").show();

  append_list.innerHTML='';

   if(jQuery("#selected_search").val()=='title' && jQuery("#search").val().trim()!=''){

     wherequery=ref.orderBy('name').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').get();

   } else{

    wherequery=ref.limit(pagesize).get();
  }

  wherequery.then((snapshots) => {
    html='';
    html=buildHTML(snapshots);
    jQuery("#data-table_processing").hide();
    if(html!=''){
        append_list.innerHTML=html;
        start = snapshots.docs[snapshots.docs.length - 1];
        endarray.push(snapshots.docs[0]);
        /*if(snapshots.docs.length<pagesize && jQuery("#selected_search").val().trim()!='' && jQuery("#search").val().trim()!=''){*/
        if(snapshots.docs.length < pagesize){

            jQuery("#data-table_paginate").hide();
        }else{

            jQuery("#data-table_paginate").show();
        }
    }
});

}

$(document).on("click","a[name='vendor-filter-delete']", function (e) {
        var id = this.id;
    database.collection('vendor_filters').doc(id).delete().then(function(result){

      window.location = "{{! url()->current() }}";
    });


});


    </script>



@endsection
