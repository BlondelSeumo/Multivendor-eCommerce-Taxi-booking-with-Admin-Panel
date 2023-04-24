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

                    <h3 class="text-themecolor">{{trans('lang.order_review')}}</h3>

                </div>

                <div class="col-md-7 align-self-center">

                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                        <li class="breadcrumb-item active">{{trans('lang.order_review_table')}}</li>

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

                                <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
                                <!-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> -->
                            <div id="users-table_filter" class="pull-right"><label>{{ trans('lang.search_by')}}

                                <select name="selected_search" id="selected_search" class="form-control input-sm">
                                    <option value="order_id">{{ trans('lang.order_id')}}</option>
                                </select>

                                <div class="form-group">
                                <input type="search" id="search" class="search form-control" placeholder="Search" aria-controls="users-table"></label>&nbsp;<button onclick="searchtext();" class="btn btn-warning btn-flat">{{ trans('lang.search')}}</button>&nbsp;<button onclick="searchclear();" class="btn btn-warning btn-flat">{{ trans('lang.clear')}}</button>
                            </div>
                            </div>

                                <div class="table-responsive m-t-10">

                                    <table id="example24" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                        <thead>

                                            <tr>

                                                <th>{{trans('lang.order_id')}}</th>

                                                <th class="address-list">{{ trans('lang.order_review')}}</th>

                                                <th>{{ trans('lang.item_review_rate')}}</th>

                                                <th>{{ trans('lang.item_review_user_id')}}</th>

                                                <th>{{trans('lang.actions')}}</th>

                                            </tr>

                                        </thead>

                                        <tbody id="append_list1">

                                        </tbody>

                                    </table>
                                    <div id="data-table_paginate">
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
    </div>



@endsection

@section('scripts')

<script type="text/javascript">

 var database = firebase.firestore();

    var offest=1;
    var pagesize=10;
    var end = null;
    var endarray=[];
    var start = null;
    var user_number = [];
    var append_list = '';
    var vendorUserId = "<?php echo $id; ?>";
    var ref = '';

    getVendorId(vendorUserId).then(data => {
        vendorId= data;
        ref = database.collection('items_review').where('VendorId','==',vendorId);
        $(document).ready(function() {

            $(document.body).on('click', '.redirecttopage' ,function(){
                var url=$(this).attr('data-url');
                window.location.href = url;
            });

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
                if(snapshots.docs.length<pagesize){
                    jQuery("#data-table_paginate").hide();
                }
                //disableClick();
             }
          });

        });
    })


   function buildHTML(snapshots){
        var html='';
        var alldata=[];
        var number= [];
        snapshots.docs.forEach((listval) => {
            var datas=listval.data();
            datas.id=listval.id;
            alldata.push(datas);
        });

        var count = 0;
        alldata.forEach((listval) => {

                var val=listval;
                html=html+'<tr>';
                newdate='';
                var reviewId = val.Id;
                var route1 =  '{{route("orderReview.edit",":id")}}';
                route1 = route1.replace(':id', reviewId);

                var orderRoute =  '{{route("orders.edit",":id")}}';
                orderRoute = orderRoute.replace(':id', val.orderid);
                html=html+'<td data-url="'+orderRoute+'" class="redirecttopage">'+val.orderid+'</td>';
                html=html+'<td class="address-list">'+val.comment+'</td>';

                // if(val.hasOwnProperty("rating") && val.rating > 0){
                // var rate = val.rating.toFixed(1)*10;
                // var rating = "stars-container stars-"+rate;
                // html=html+"<td><div><span class='"+rating+"' style='width:auto'>★★★★★</span></div></td>";
                // }else{
                //   html=html+"<td></td>";
                // }
                html=html + '<td><ul class="rating" data-rating="'+val.rating+'"><li class="rating__item"></li><li class="rating__item"></li><li class="rating__item"></li><li class="rating__item"></li><li class="rating__item"></li></ul></td>';


                const user_name=userName(val.CustomerId);
                html=html+'<td class="name_'+val.CustomerId+'"></td>';


                // if(val.hasOwnProperty("createdAt")){
                //   var date = val.createdAt.toDate().toDateString();
                // var day = val.createdAt.toDate().toLocaleTimeString('en-US');
                // html = html+'<td>'+day+ ' '+date+'</td>';
                // }else{
                // html = html+'<td></td>';
                // }



                html=html+'<td class="action-btn"><a href="'+route1+'"><i class="fa fa-edit"></i></a><a id="'+val.Id+'" name="item-review-delete" class="do_not_delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>';



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
                 if(jQuery("#selected_search").val()=='order_id' && jQuery("#search").val().trim()!=''){

                  listener=ref.orderBy('Id').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAt(end).get();

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

          if(jQuery("#selected_search").val()=='order_id' && jQuery("#search").val().trim()!=''){

              listener=ref.orderBy('Id').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAfter(start).get();

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

   if(jQuery("#selected_search").val()=='order_id' && jQuery("#search").val().trim()!=''){

     wherequery=ref.orderBy('orderid').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').get();

   }else{

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

async function userName(userID) {
var userName='';
await database.collection('users').where("id","==",userID).get().then( async function(snapshotss){

            if(snapshotss.docs[0]){
                var user = snapshotss.docs[0].data();
                userName = user.firstName+" "+user.lastName;
                console.log(userName);
                jQuery(".name_"+userID).html(userName);

            }else{
                jQuery(".name_"+userID).html('');

            }
});
return userName;
}


async function vendorName(vendorID) {
var vendorName ='';
await database.collection('vendors').where("id","==",vendorID).get().then( async function(snapshotss){

            if(snapshotss.docs[0]){
                var vendor = snapshotss.docs[0].data();
                vendorName = vendor.title;

                jQuery(".item_"+vendorID).html(vendorName);

            }else{
                jQuery(".item_"+vendorID).html('');

            }
});
return vendorName;
}

$(document).on("click","a[name='item-review-delete']", function (e) {
    var id = this.id;
     database.collection('items_review').doc(id).delete().then(function(result) {
        window.location.href = '{{ route("orderReview")}}';
    })


});

async function getVendorId(vendorUser){
    var vendorId = '';
    var ref;
    await database.collection('vendors').where('author',"==",vendorUser).get().then(async function(vendorSnapshots){
        var vendorData = vendorSnapshots.docs[0].data();
        vendorId = vendorData.id;
    })

            return vendorId;
}

</script>

@endsection
