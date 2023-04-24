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

                    <h3 class="text-themecolor">{{trans('lang.parcelcategory_plural')}}</h3>

                </div>

                <div class="col-md-7 align-self-center">

                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                        <li class="breadcrumb-item active">{{trans('lang.parcel_category')}}</li>

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
                                      <a class="nav-link active" href="{!! route('parcelCategory') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.parcel_category')}}</a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link" href="{!! route('parcelCategory.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.parcel_create')}}</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body">



                                <!-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> -->
                            <div id="users-table_filter" class="pull-right"><label>{{ trans('lang.search_by')}}
                                <select name="selected_search" id="selected_search" class="form-control input-sm">
                                            <option value="first_name">{{ trans('lang.title')}}</option>
                                </select>
                                <div class="form-group">
                                <input type="search" id="search" class="search form-control" placeholder="Search" aria-controls="users-table"></label>&nbsp;<button onclick="searchtext();" class="btn btn-warning btn-flat">Search</button>&nbsp;<button onclick="searchclear();" class="btn btn-warning btn-flat">Clear</button>
                            </div>
                            </div>

                                <div class="table-responsive m-t-10">

                                    <table id="example24" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                        <thead>

                                            <tr>

                                            <th class="delete-all">
                                                <input type="checkbox" id="is_active">
                                                <label class="col-3 control-label" for="is_active">
                                                    <a id="deleteAll" class="do_not_delete" href="javascript:void(0)"><i class="fa fa-trash"></i> {{trans('lang.all')}}</a>
                                                </label>
                                            </th>

                                                <th>{{trans('lang.extra_image')}}</th>

                                                <th >{{trans('lang.title')}}</th>

                                                <th >{{trans('lang.item_publish')}}</th>

                                                <th >{{trans('lang.set_order')}}</th>

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

    var offest=1;
    var pagesize=10;
    var end = null;
    var endarray=[];
    var start = null;
    var user_number = [];
    var ref = database.collection('parcel_categories');
    var alldriver = database.collection('users').where("role","==","driver");
    var placeholderImage = '';
    var append_list = '';

$(document).ready(function() {

    var inx= parseInt(offest) * parseInt(pagesize);
    jQuery("#data-table_processing").show();

    var placeholder = database.collection('settings').doc('placeHolderImage');
    placeholder.get().then( async function(snapshotsimage){
      var placeholderImageData = snapshotsimage.data();
      placeholderImage = placeholderImageData.image;
    })


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
        if(snapshots.docs.length<pagesize){
            jQuery("#data-table_paginate").hide();
        }
        //disableClick();
     }
  });


// alldriver.get().then( async function(snapshotsdriver){

//     snapshotsdriver.docs.forEach((listval) => {
//     database.collection('vendor_orders').where('driverID','==',listval.id).where("status","in",["Order Completed"]).get().then( async function(orderSnapshots){
//             var count_order_complete=orderSnapshots.docs.length;
//             database.collection('users').doc(listval.id).update({'orderCompleted':count_order_complete}).then(function(result) {

//              });

//         });

//     });
// });

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


           /* alldata.sort(function(a, b) {

              var keyA = a.createdAt.seconds,
                keyB = b.createdAt.seconds;

              if (keyA < keyB) return -1;
              if (keyA > keyB) return 1;
              return 0;
        }); */

        var count = 0;
        alldata.forEach((listval) => {

            var val=listval;

                html=html+'<tr>';
                newdate='';
                var id = val.id;
                var route1 =  '{{route("parcelCategory.edit",":id")}}';
                route1 = route1.replace(':id', id);

                var parcelCategoryView =  '{{route("parcelCategory.view",":id")}}';
                parcelCategoryView = parcelCategoryView.replace(':id', id);

                html = html + '<td class="delete-all"><input type="checkbox" id="is_open_' + id + '" class="is_open" dataId="' + id + '"><label class="col-3 control-label"\n' +
                'for="is_open_' + id + '" ></label></td>';

                /* html=html+'<td>'+val.id+'</td>'; */
                if(val.image != ''){
                      html=html+'<td><img class="rounded" style="width:50px" src="'+val.image+'" alt="image"></td>';
                }else{
                    html=html+'<td><img class="rounded" style="width:50px" src="'+placeholderImage+'" alt="image"></td>';
                }

                 html = html + '<td>'+val.title+' </td>';

                 if (val.publish) {
                     html = html + '<td><label class="switch"><input type="checkbox" checked id="' + val.id + '" name="publish"><span class="slider round"></span></label></td>';
                 } else {
                     html = html + '<td><label class="switch"><input type="checkbox" id="' + val.id + '" name="publish"><span class="slider round"></span></label></td>';
                 }
                html = html + '<td>'+val.set_order+' </td>';


                html=html+'<td class="action-btn"><a href="'+route1+'"><i class="fa fa-edit"></i></a><a id="'+val.id+'" name="parcel-delete" class="do_not_delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>';

                html=html+'</tr>';
                count =count +1;
          });
          return html;
}
/* toggal publish action code start*/
    $(document).on("click","input[name='publish']",function(e){
        var ischeck=$(this).is(':checked');
        var id=this.id;
        if(ischeck){
          database.collection('parcel_categories').doc(id).update({'publish': true}).then(function (result) {

          });
        }else{
          database.collection('parcel_categories').doc(id).update({'publish': false}).then(function (result) {

          });
        }

    });

/*toggal publish action code end*/

$(document.body).on('click', '.redirecttopage' ,function(){
            var url=$(this).attr('data-url');
            window.location.href = url;
        });

function prev(){
    if(endarray.length==1){
        return false;
    }
    end=endarray[endarray.length-2];

  if(end!=undefined || end!=null){
            jQuery("#data-table_processing").show();

                  if(jQuery("#selected_search").val()=='first_name' && jQuery("#search").val().trim()!=''){

                      listener=ref.orderBy('title').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAt(end).get();


                   /* else if(jQuery("#selected_search").val()=='email' && jQuery("#search").val().trim()!=''){

                      listener=ref.orderBy('email').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAt(end).get();

                    }else if(jQuery("#selected_search").val()=='role' && jQuery("#search").val().trim()!=''){

                      listener=ref.orderBy('role').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAt(end).get();

                    } */
                }
                    else{
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

          /* if(jQuery("#selected_search").val()=='title' && jQuery("#search").val().trim()!=''){

                listener=ref.orderBy('title').limit(pagesize).startAfter(start).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').get();
            } */
            if(jQuery("#selected_search").val()=='first_name' && jQuery("#search").val().trim()!=''){

      listener=ref.orderBy('firstName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAfter(start).get();

    }else if(jQuery("#selected_search").val()=='last_name' && jQuery("#search").val().trim()!=''){

      listener=ref.orderBy('lastName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAfter(start).get();

    }
   /* else if(jQuery("#selected_search").val()=='email' && jQuery("#search").val().trim()!=''){

      listener=ref.orderBy('email').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAfter(start).get();

    }else if(jQuery("#selected_search").val()=='role' && jQuery("#search").val().trim()!=''){

      listener=ref.orderBy('role').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAfter(start).get();

    } */



            else{
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

    if(jQuery("#selected_search").val()=='first_name' && jQuery("#search").val().trim()!=''){

      wherequery=ref.orderBy('title').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').get();


    }

    else{

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




 $(document).on("click","a[name='parcel-delete']", function (e) {
        var id = this.id;

     database.collection('parcel_categories').doc(id).delete().then(function(){
                      window.location.reload();
    });


});

 function searchclear(){
    jQuery("#search").val('');
    searchtext();
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
