@extends('layouts.app')

@section('content')
	<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.rides')}} <span class="itemTitle"></span></h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href= "{!! route('rides') !!}" >{{trans('lang.rides')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.ride_detail')}}</li>
            </ol>
        </div>
    
  </div>
 
   <div class="container-fluid">
   	  <div class="row">
   		  <div class="col-12">

            <!-- <div class="resttab-sec">
              <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
              <div class="menu-tab">
                <ul>
                  <li class="active">
                      <a href="{{route('drivers.view',$id)}}">{{trans('lang.tab_basic')}}</a>
                  </li>
                  <li>
                      <a href="{{route('drivers.ride',$id)}}">{{trans('lang.rides')}}</a>
                  </li>
                  <li>
                      <a href="{{route('payoutRequests.drivers.view',$id)}}">{{trans('lang.tab_payouts')}}</a>
                  </li>

                  
                </ul>

              </div>
            
            </div> -->

        <div class="row vendor_payout_create">
            <div class="vendor_payout_create-inner">
                <fieldset>
                    <legend>{{trans('lang.ride_detail')}}</legend>
                          <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.driver_plural')}}</label>
                          <div class="col-7" class="driver_name">
                              <span class="driver_name" id="driver_name"></span>
                            </div>
                        </div>

                        <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.order_user_id')}}</label>
                          <div class="col-7">
                          <span class="client_name"></span>
                          </div>    
                        </div>


                        <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.address')}}</label>
                          <div class="col-7">
                          <span class="address"></span>
                          </div> 
                          </div>
                          <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.status')}}</label>
                          <div class="col-7">
                          <span class="status"></span>
                          </div> 
                          </div>
                </fieldset>

              </div>
                <div class="form-group col-12 text-center btm-btn">
                  <a href="{!! route('rides') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                </div>

          </div>
        </div>
</div>


 @endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
<script>
  var id = "<?php echo $id;?>";
  var database = firebase.firestore();
  var ref = database.collection('rides').where("id","==",id);
  var photo ="";
	var vendorOwnerId = "";
	var vendorOwnerOnline = false;



	$(document).ready(async function(){
  		jQuery("#data-table_processing").show();
  		ref.get().then( async function(snapshots){
			var ride = snapshots.docs[0].data();
			$(".driver_name").text(ride.driver.firstName);
            console.log(ride);

    
      $(".client_name").text(ride.author.firstName);
       
       $(".address").text(ride.destinationLocationName);
       $(".status").text(ride.status);
  
		// 	$(".reviewhtml").html(review);

    //   filtershtml='';
    //   for (var key in vendor.filters) {
    //       filtershtml=filtershtml+'<li>'+key+': '+vendor.filters[key]+'</li>';
    //   }

    //   $("#filtershtml").html(filtershtml);
      

    //   await database.collection('vendor_categories').get().then( async function(snapshots){
    //       snapshots.docs.forEach((listval) => {
    //             var data = listval.data();
    //             if(data.id == vendor.categoryID){
    //               $(".vendor_cuisines").text(data.title);
    //             }
    //         })
    //   }); 


    //   await database.collection('sections').get().then( async function(snapshots){
    //       snapshots.docs.forEach((listval) => {
    //             var data = listval.data();
    //             if(data.id == vendor.section_id){
    //               $(".vendor_section").text(data.name);
    //             }
    //         })
    //   }); 

    //   $(".opentime").text(vendor.opentime);
    //   $(".closetime").text(vendor.closetime);
      

		// 	$(".vendor_address").text(vendor.location);
		// 	$(".vendor_latitude").text(vendor.latitude);
		// 	$(".vendor_longitude").text(vendor.longitude);
		// 	$(".vendor_description").text(vendor.description);
    //   vendorOwnerOnline = vendor.isActive;
	  //  		photo = vendor.photo;
	  //   	vendorOwnerId = vendor.author;
	 	// 	await database.collection('users').where("id","==",vendor.author).get().then( async function(snapshots){
	  //  			snapshots.docs.forEach((listval) => {
	  //           var user = listval.data();
		// 		        /*$(".vendor_name").html(user.firstName+" "+user.lastName);*/
    //             $(".vendor_email").html(user.email);
                

    //             $(".vendor_phoneNumber").html(user.phoneNumber);


	  //         })
		// 	});

		// 	await database.collection('vendor_categories').get().then( async function(snapshots){
	  //  			snapshots.docs.forEach((listval) => {
	  //           	var data = listval.data();
	  //           	if(data.id == vendor.categoryID){
	  //               	$('#vendor_cuisines').append($("<option selected></option>")
	  //                   	.attr("value", data.id)
	  //                   	.text(data.title));
	  //           	}else{
	  //               	$('#vendor_cuisines').append($("<option></option>")
	  //                   	.attr("value", data.id)
	  //                   	.text(data.title));
		// 	    	}
	  //         	})

		// 	});  
	    
	  //   	if(vendor.hasOwnProperty('phonenumber')){
	  //    		$(".vendor_phone").text(vendor.phonenumber);
	  //   	}
	 		jQuery("#data-table_processing").hide();
  	// 	})


  
		// $(".save_vendor_btn").click(function(){
		//   	var vendorname = $(".vendor_name").val();
		// 	var cuisines = $("#vendor_cuisines option:selected").val();
		// 	var address = $(".vendor_address").val();	
		// 	var latitude = parseFloat($(".vendor_latitude").val());
		// 	var longitude = parseFloat($(".vendor_longitude").val());
		// 	var description = $(".vendor_description").val();
		// 	var phonenumber = $(".vendor_phone").val();
		// 	var categoryTitle = $( "#vendor_cuisines option:selected" ).text();

		//     database.collection('vendors').doc(id).update({'title':vendorname,'description':description,'latitude':latitude,
		//       'longitude':longitude,'location':address,'photo':photo,'categoryID':cuisines,'phonenumber':phonenumber,'categoryTitle':categoryTitle}).then(function(result) {
		//                 window.location.href = '{{ route("vendors")}}';
		//              }); 
		})

	})
  </script>
@endsection