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

                    <h3 class="text-themecolor">{{trans('lang.vendor_plural')}}</h3>

                </div>

                <div class="col-md-7 align-self-center">

                    <ol class="breadcrumb">

                        <li class="breadcrumb-item"><a href="index.php">{{trans('lang.dashboard')}}</a></li>

                        <li class="breadcrumb-item">{{trans('lang.vendor_plural')}}</li>

                        <li class="breadcrumb-item active">{{trans('lang.vendor_table')}}</li>

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
                                    <option value="title">{{trans('lang.title')}}</option>
                                </select>
                                <div class="form-group">
                                <input type="search" id="search" class="search form-control" placeholder="Search" aria-controls="users-table"></label>&nbsp;<button onclick="searchtext();" class="btn btn-warning btn-flat">{{trans('lang.search')}}</button>&nbsp;<button onclick="searchclear();" class="btn btn-warning btn-flat">{{trans('lang.clear')}}</button>
                            </div>
                            </div>
 


                                <div class="table-responsive m-t-10">


                                    <table id="example24" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                        <thead>

                                            <tr>

                                                <th>{{trans('lang.vendor_image')}}</th>

                                                <th>{{trans('lang.vendor_name')}}</th>

                                                <th>{{trans('lang.vendor_address')}}</th>

                                                <th>{{trans('lang.vendor_phone')}}</th>

                                                <th>{{trans('lang.actions')}}</th>

                                            </tr>

                                        </thead>

                                        <tbody id="append_list1">


                                        </tbody>

                                    </table>
                                                    <div class="dataTables_paginate paging_simple_numbers" id="data-table_paginate"><ul class="pagination"><li class="paginate_button previous" id="users-table_previous">
                <a href="javascript:void(0);" id="users_table_previous_btn" onclick="prev()" aria-controls="users-table" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button">
                <a href="javascript:void(0);" id="users_table_next_btn" onclick="next()" aria-controls="users-table" data-dt-idx="2" tabindex="0">Next</a></li></ul></div>
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
    var ref = database.collection('vendors');
    var append_list = '';
    
$(document).ready(function() {
	
    var inx= parseInt(offest) * parseInt(pagesize);
    jQuery("#data-table_processing").show();
  
    append_list = document.getElementById('append_list1');
    append_list.innerHTML='';
    ref.limit(pagesize).get().then( async function(snapshots){  
    html='';
    html=await buildHTML(snapshots);
    jQuery("#data-table_processing").hide();
    if(html!=''){
        append_list.innerHTML=html;
        start = snapshots.docs[snapshots.docs.length - 1];
        endarray.push(snapshots.docs[0]);
        if(snapshots.docs.length<pagesize){
            jQuery("#data-table_paginate").hide();
        }
    }
});

})

 function buildHTML(snapshots){
        var html='';
        var number= [];
        var count = 0;
         snapshots.docs.forEach( async(listval) => {
            var listval=listval.data();
            
            var val=listval;
            val.id=listval.id;
                html=html+'<tr>';
                newdate='';
                var id = val.id;
                var route1 =  '{{route("vendors.edit",":id")}}';
                route1 = route1.replace(':id', id);
                // var route1 = "#";
                html=html+'<td><img alt="" width="100%" style="width:70px;height:70px;" src="'+val.photo+'" alt="image"></td>';



                html=html+'<td>'+val.title+'</td>';
                if(val.hasOwnProperty("location") != ''){
                    html=html+'<td>'+val.location+'</td>';
                }else{
                    html=html+'<td></td>';
                }
                const phone=userPhone(val.author);
                if(val.hasOwnProperty('phonenumber')){
                    html=html+'<td>'+val.phonenumber+'</td>';
                }else{
                    html=html+'<td></td>';
                }
                
                var active = val.isActive;

                html=html+'<td class="vendor-action-btn"><a href="'+route1+'"><i class="fa fa-edit"></i></a><a id="'+val.id+'" name="vendor-delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>';
                
                html=html+'</tr>';
                count =count +1;
          });
          return html;      
}





async function userPhone(author) {
var userPhones='';
await database.collection('users').where("id","==",author).get().then( async function(snapshotss){
	
            if(snapshotss.docs[0]){
                var user = snapshotss.docs[0].data();
                userPhones=user.phoneNumber;
                if(user.isActive){

                  jQuery(".active_vendor_"+author+" span").addClass('badge-danger');
                  jQuery(".active_vendor_"+author+" span").text('No');

                }else{
                  jQuery(".active_vendor_"+author+" span").addClass('badge-success');
                  jQuery(".active_vendor_"+author+" span").text('Yes');
                }

            }else{
                jQuery(".phone_"+author).html('');
                jQuery(".active_vendor_"+author+" span").addClass('badge-success');
                jQuery(".active_vendor_"+author+" span").text('Yes');
            } 
});
return userPhones;
}

async function next(){
  if(start!=undefined || start!=null){
        jQuery("#data-table_processing").hide();

          if(jQuery("#selected_search").val()=='title' && jQuery("#search").val().trim()!=''){
            console.log(jQuery("#selected_search").val());

                listener=ref.orderBy('title').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAfter(start).get();
            }else{
                listener = ref.startAfter(start).limit(pagesize).get();
            }
          listener.then( async(snapshots) => {
            
                html='';
                html=await buildHTML(snapshots);
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

async function prev(){
    if(endarray.length==1){
        return false;
    }
    end=endarray[endarray.length-2];
  
  if(end!=undefined || end!=null){
            jQuery("#data-table_processing").show();
                 if(jQuery("#selected_search").val()=='title' && jQuery("#search").val().trim()!=''){

                    listener=ref.orderBy('title').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAt(end).get();
                }else{
                    listener = ref.startAt(end).limit(pagesize).get();
                }
                
                listener.then(async(snapshots) => {
                html='';
                html=await buildHTML(snapshots);
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


function searchtext(){

  jQuery("#data-table_processing").show();

  append_list.innerHTML='';

   if(jQuery("#selected_search").val()=='title' && jQuery("#search").val().trim()!=''){
     
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
        if(snapshots.docs.length < pagesize){ 
   
            jQuery("#data-table_paginate").hide();
        }else{

            jQuery("#data-table_paginate").show();
        }
    }
}); 

}

function searchclear(){
    jQuery("#search").val('');
    searchtext();
}
</script>

@endsection
