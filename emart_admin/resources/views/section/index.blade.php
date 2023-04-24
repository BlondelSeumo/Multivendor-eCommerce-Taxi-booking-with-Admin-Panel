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

                    <h3 class="text-themecolor">{{trans('lang.section_plural')}}</h3>

                </div>

                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('lang.section_plural')}}</li>
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
                                      <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.section_table')}}</a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link" href="{!! route('section.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.section_create')}}</a>
                                    </li>
                              </ul>
                            </div>

                            <div class="card-body">

                                <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>

                            <div id="users-table_filter" class="pull-right"><label>{{trans('lang.search_by')}}
                                <select name="selected_search" id="selected_search" class="form-control input-sm">
                                    <option value="name">{{trans('lang.name')}}</option>
                                </select>
                                <div class="form-group">
                                <input type="search" id="search" class="search form-control" placeholder="Search" aria-controls="users-table"></label>&nbsp;<button onclick="searchtext();" class="btn btn-warning btn-flat">{{trans('lang.search')}}</button>&nbsp;<button onclick="searchclear();" class="btn btn-warning btn-flat">{{trans('lang.clear')}}</button>
                            </div>
                            </div>



                                <div class="table-responsive m-t-10">


                                    <table id="example24" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                        <thead>

                                            <tr>

                                                <th>{{trans('lang.section_image')}}</th>

                                                <th>{{trans('lang.faq_section_name')}}</th>
                                                <th>{{trans('lang.service_type')}}</th>

                                                  <th>{{trans('lang.status')}}</th>

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
   <script type="text/javascript">

     var database = firebase.firestore();
    var offest=1;
    var pagesize=10;
    var end = null;
    var endarray=[];
    var start = null;
    var user_number = [];
    var ref = database.collection('sections');
    var append_list = '';
    var placeholderImage = '';

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
            if(snapshots.docs.length < pagesize){
                jQuery("#data-table_paginate").hide();
            }
            //disableClick();
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

        var count = 0;
        alldata.forEach((listval) => {

            var val=listval;

                html=html+'<tr>';
                newdate='';
                var id = val.id;
                var route1 =  '{{route("section.edit",":id")}}';
                route1 = route1.replace(':id', id);
                if(val.sectionImage == ''){
                    html=html+'<td><img class="rounded" style="width:50px" src="'+placeholderImage+'" alt="image"></td>';
                }else{
                    html=html+'<td><img class="rounded" style="width:50px" src="'+val.sectionImage+'" alt="image"></td>';
                }

                // html=html+'<td>'+val.name+'</td>';
                html=html+'<td><a href="'+route1+'">'+val.name+'</a></td>';
                html=html+'<td><a href="'+route1+'">'+val.serviceType+'</a></td>';
                if (val.isActive) {
                  html = html + '<td><label class="switch"><input type="checkbox" checked id="' + val.id + '" name="isActive"><span class="slider round"></span></label></td>';
                } else {
                  html = html + '<td><label class="switch"><input type="checkbox" id="' + val.id + '" name="isActive"><span class="slider round"></span></label></td>';
                }
                html=html+'<td class="action-btn"><a href="'+route1+'"><i class="fa fa-edit"></i></a><a id="'+val.id+'" name="category-delete" class="do_not_delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>';



                html=html+'</tr>';
                count =count +1;
          });
          return html;
}
/* toggal publish action code start*/
    $(document).on("click","input[name='isActive']",function(e){
        var ischeck=$(this).is(':checked');
        var id=this.id;
        if(ischeck){
          database.collection('sections').doc(id).update({'isActive': true}).then(function (result) {
          });
        }else{
          database.collection('sections').doc(id).update({'isActive': false}).then(function (result) {
          });
        }

    });

/*toggal publish action code end*/

function prev(){
      if(endarray.length==1){
        return false;
    }
    end=endarray[endarray.length-2];

  if(end!=undefined || end!=null){
            jQuery("#data-table_processing").show();
                 if(jQuery("#selected_search").val()=='name' && jQuery("#search").val().trim()!=''){

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

          if(jQuery("#selected_search").val()=='name' && jQuery("#search").val().trim()!=''){

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

  jQuery("#data-table_processing").show();

  append_list.innerHTML='';

   if(jQuery("#selected_search").val()=='name' && jQuery("#search").val().trim()!=''){

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

        if(snapshots.docs.length < pagesize){

            jQuery("#data-table_paginate").hide();
        }else{

            jQuery("#data-table_paginate").show();
        }
    }
});

}

$(document).on("click","a[name='category-delete']", function (e) {
    var id = this.id;
    var all_delete_alert = '{{trans("lang.all_delete_alert")}}';
    if(confirm(all_delete_alert)){
    	jQuery("#data-table_processing").show();
     	database.collection('sections').doc(id).delete().then(function(result) {
        	deleteAllSectionData(id).then(function(){
	          	setTimeout(function(){
	            	window.location.reload();
	          	},9000);
            	//window.location.reload();
        	});
      	});
    }
});

async function deleteAllSectionData(sectionId){

  //jQuery("#data-table_processing").show();
   await database.collection('banner_items').where('sectionId','==',sectionId).get().then(async function(bannersnapshots){
     if(bannersnapshots.docs.length>0){

       bannersnapshots.docs.forEach((val) => {
          var item_data=val.data();
          database.collection('banner_items').doc(item_data.id).delete().then(function(){

          });
       });

     }

   });


   await database.collection('coupons').where('section_id','==',sectionId).get().then(async function(couponssnapshots){
     if(couponssnapshots.docs.length>0){
       couponssnapshots.docs.forEach((val) => {
          var item_data=val.data();
          database.collection('coupons').doc(item_data.id).delete().then(function(){

          });
       });

     }

   });
   await database.collection('favorite_item').where('section_id','==',sectionId).get().then(async function(favitemsnapshots){
     if(favitemsnapshots.docs.length>0){
       favitemsnapshots.docs.forEach((val) => {
          var item_data=val.data();
          database.collection('favorite_item').doc(item_data.id).delete().then(function(){

          });
       });

     }

   });
   await database.collection('favorite_vendor').where('section_id','==',sectionId).get().then(async function(favvendorsnapshots){
     if(favvendorsnapshots.docs.length>0){
       favvendorsnapshots.docs.forEach((val) => {
          var item_data=val.data();
          database.collection('favorite_vendor').doc(item_data.id).delete().then(function(){

          });
       });

     }

   });

   await database.collection('brands').where('sectionId','==',sectionId).get().then(async function(brandsnapshots){


     if(brandsnapshots.docs.length>0){

       brandsnapshots.docs.forEach((val) => {
          var item_data=val.data();
          database.collection('brands').doc(item_data.id).delete().then(function(){

          });
       });

     }

   });
   await database.collection('vendor_categories').where('section_id','==',sectionId).get().then(async function(vendorcatsnapshots){


     if(vendorcatsnapshots.docs.length>0){

       vendorcatsnapshots.docs.forEach((val) => {
          var item_data=val.data();
          database.collection('vendor_categories').doc(item_data.id).delete().then(function(){

          });
       });

     }

   });
   await database.collection('vendor_products').where('section_id','==',sectionId).get().then(async function(vendorproductsanpshots){
           if(vendorproductsanpshots.docs.length>0){
             vendorproductsanpshots.docs.forEach((val) => {
               var item_data=val.data();
                 database.collection('vendor_products').doc(item_data.id).delete().then(function(){

                 });
             });

         }
   });

   await database.collection('vendors').where('section_id','==',sectionId).get().then(async function(vendorsnapshots){

     if(vendorsnapshots.docs.length>0){

       vendorsnapshots.docs.forEach((val) => {
          var item_data=val.data();
          var vendorID=item_data.id;
            database.collection('vendors').doc(item_data.id).delete().then(async function(){


                await  database.collection('order_transactions').where('vendorId','==',vendorID).get().then(async function(ordertransactionsanpshots){
                if(ordertransactionsanpshots.docs.length>0){
                  ordertransactionsanpshots.docs.forEach((val) => {
                    var item_data=val.data();
                        database.collection('order_transactions').doc(item_data.id).delete().then(function(){

                        });
                  });

                }
              });
        await database.collection('payouts').where('vendorID','==',vendorID).get().then(async function(payoutssanpshots){
            if(payoutssanpshots.docs.length>0){
              payoutssanpshots.docs.forEach((val) => {
                var item_data=val.data();
                    database.collection('payouts').doc(item_data.id).delete().then(function(){

                    });
              });

            }
                  });
    await  database.collection('users').where('vendorID','==',vendorID).get().then(async function(userssanpshots){
        if(userssanpshots.docs.length>0){
          var projectId = '<?php echo env('FIREBASE_PROJECT_ID') ?>';
          userssanpshots.docs.forEach((val) => {
            var item_data=val.data();
            	var dataObject = {"data":{ "uid": item_data.id } };
		        jQuery.ajax({
			        url: 'https://us-central1-'+projectId+'.cloudfunctions.net/deleteUser',
			        method: 'POST',
			        contentType: "application/json; charset=utf-8",
			        data: JSON.stringify(dataObject),
			        success: function(data){
			          	console.log('Delete user success:',data.result);
			          	database.collection('users').doc(item_data.id).delete().then(function(){
                		});
			        },
			        error: function(xhr, status, error) {
			        	var responseText = JSON.parse(xhr.responseText);
					  	console.log('Delete user error:',responseText.error);
					}
			    });
           });
        }
	});

  await database.collection('vendor_orders').where('vendorID','==',vendorID).get().then(async function(vendorordersanpshots){
    if(vendorordersanpshots.docs.length>0){
      vendorordersanpshots.docs.forEach((val) => {
        var item_data=val.data();
        database.collection('vendor_orders').doc(item_data.id).delete().then(function(){

            });
      });

    }
                  });
    await database.collection('vendor_products').where('vendorID','==',vendorID).get().then(async function(vendorproductsanpshots){
            if(vendorproductsanpshots.docs.length>0){
              vendorproductsanpshots.docs.forEach((val) => {
                var item_data=val.data();
                  database.collection('vendor_products').doc(item_data.id).delete().then(function(){

                  });
              });

          }
    });
    // await database.collection('booked_table').where('vendorID','==',vendorID).get().then(async function(booktablesnapshots){
    //
    //
    //   if(booktablesnapshots.docs.length>0){
    //
    //     booktablesnapshots.docs.forEach((val) => {
    //        var item_data=val.data();
    //        database.collection('booked_table').doc(item_data.id).delete().then(function(){
    //
    //        });
    //     });
    //
    //   }
    //
    // });

          });


    });
  }

});



}


</script>

@endsection
