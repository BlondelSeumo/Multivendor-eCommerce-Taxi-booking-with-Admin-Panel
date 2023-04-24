@extends('layouts.app')

@section('content')
	<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.vehicle_plural')}} <span class="itemTitle"></span></h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href= "{!! route('rentalvehicle') !!}" >{{trans('lang.vehicle_plural')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.vehicle_details')}}</li>
            </ol>
        </div>

  </div>

   <div class="container-fluid">
   	  <div class="row">
   		  <div class="col-12">

            <div class="resttab-sec">
              <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
              <div class="menu-tab">
                <ul>
                  <li >
                      <a href="{{route('drivers.view',$id)}}">{{trans('lang.tab_basic')}}</a>
                  </li>
									<li class="active">
                      <a href="{{route('drivers.vehicle',$id)}}">{{trans('lang.vehicle')}}</a>
                  </li>
                  <li>
                      <a href="{{route('drivers.ride',$id)}}">{{trans('lang.rides')}}</a>
                  </li>
                  <li>
                      <a href="{{route('payoutRequests.drivers.view',$id)}}">{{trans('lang.tab_payouts')}}</a>
                  </li>


                </ul>

              </div>

            </div>

        <div class="row vendor_payout_create">
            <div class="vendor_payout_create-inner">
                <fieldset>
                    <legend>{{trans('lang.vehicle_details')}}</legend>
                          <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.car_name')}}</label>
                          <div class="col-7" class="car_name">
                              <span class="car_name" id="car_name"></span>
                            </div>
                        </div>

                        <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.car_number')}}</label>
                          <div class="col-7">
                          <span class="car_number"></span>
                          </div>
                        </div>

                        <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.car_model')}}</label>
                          <div class="col-7">
                          <span class="care_model"></span>
                          </div>
                        </div>
                        <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.car_image')}}</label>
                          <div class="col-7 car_image">
                          </div>
                          </div>
                        <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.vehicle_type')}}</label>
                          <div class="col-7">
                          <span class="vehicle_type"></span>
                          </div>
                        </div>
												<div class="form-group row width-50">
													<label class="col-3 control-label">{{trans('lang.type')}}</label>
													<div class="col-7">
													<span class="type"></span>
													</div>
												</div>
                        <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.air_conditioning')}}</label>
                          <div class="col-7">
                          <span class="air_conditioning"></span>
                          </div>
                        </div>
												<div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.doors')}}</label>
                          <div class="col-7">
                          <span class="doors"></span>
                          </div>
                        </div>
												<div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.fuel_filling')}}</label>
                          <div class="col-7">
                          <span class="fuel_filling"></span>
                          </div>
                        </div>
												<div class="form-group row width-50">
													<label class="col-3 control-label">{{trans('lang.fuel_type')}}</label>
													<div class="col-7">
													<span class="fuel_type"></span>
													</div>
												</div>
												<div class="form-group row width-50">
													<label class="col-3 control-label">{{trans('lang.gear')}}</label>
													<div class="col-7">
													<span class="gear"></span>
													</div>
												</div>
												<div class="form-group row width-50">
													<label class="col-3 control-label">{{trans('lang.max_power')}}</label>
													<div class="col-7">
													<span class="max_power"></span>
													</div>
												</div>
												<div class="form-group row width-50">
													<label class="col-3 control-label">{{trans('lang.mileage')}}</label>
													<div class="col-7">
													<span class="mileage"></span>
													</div>
												</div>
												<div class="form-group row width-50">
													<label class="col-3 control-label">{{trans('lang.mph')}}</label>
													<div class="col-7">
													<span class="mph"></span>
													</div>
												</div>

												<div class="form-group row width-50">
													<label class="col-3 control-label">{{trans('lang.top_speed')}}</label>
													<div class="col-7">
													<span class="top_speed"></span>
													</div>
												</div>
												<div class="form-group row width-50">
													<label class="col-3 control-label">{{trans('lang.passengers')}}</label>
													<div class="col-7">
													<span class="passengers"></span>
													</div>
												</div>


                </fieldset>


      <!-- <div class="row vendor_payout_create">
          <div class="vendor_payout_create-inner"> -->
                <fieldset class="company_details" style="display:none">
                  <legend>{{trans('lang.company_details')}}</legend>

									<div  >
									<div class="form-group row width-50 ">
										<label class="col-3 control-label">{{trans('lang.company_name')}}</label>
										<div class="col-7">
										<span class="company_name"></span>
										</div>
									</div>
									<div class="form-group row width-50 ">
										<label class="col-3 control-label">{{trans('lang.company_address')}}</label>
										<div class="col-7">
										<span class="company_address"></span>
										</div>
									</div>
									</div>



                    </fieldset>
                  </div>
              </div>
                <div class="form-group col-12 text-center btm-btn">
                  <a href="{!! route('drivers') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
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
  var ref = database.collection('users').where("id","==",id);
  var photo ="";
	var vendorOwnerId = "";
	var vendorOwnerOnline = false;

  var placeholderImage = '';
  var placeholder = database.collection('settings').doc('placeHolderImage');

  placeholder.get().then( async function(snapshotsimage){
    var placeholderImageData = snapshotsimage.data();
    placeholderImage = placeholderImageData.image;
  })

	$(document).ready(async function(){
  		jQuery("#data-table_processing").show();
  		ref.get().then( async function(snapshots){
			var dirver = snapshots.docs[0].data();
      console.log(dirver);
			$(".driver_name").text(dirver.firstName);
			$(".email").text(dirver.email);
			 $(".phone").text(dirver.phoneNumber);
			$(".car_name").text(dirver.carName);
      $(".car_number").text(dirver.carNumber);
       $(".car_model").text(dirver.carModelName);

       $(".vehicle_type").text(dirver.vehicleType);
       if(dirver.companyName != ""){
        $(".type").text('Company');
        $(".company_details").show();
        $(".company_address").text(dirver.companyAddress)
        $(".company_name").text(dirver.companyName)
       }else{
        $(".type").text('Individual');
       }
      var image="";
      if (dirver.carPictureURL) {
        image='<img width="200px" id="" height="auto" src="'+dirver.carPictureURL+'">';
      }else{
        image='<img width="200px" id="" height="auto" src="'+placeholderImage+'">';
      }
			$(".car_image").html(image);

			var driver_image="";
      if (dirver.profilePictureURL) {
        driver_image='<img width="200px" id="" height="auto" src="'+dirver.profilePictureURL+'">';
      }else{
        driver_image='<img width="200px" id="" height="auto" src="'+placeholderImage+'">';
      }
			$(".profile_image").html(driver_image);
      $(".air_conditioning").text(dirver.carInfo.air_conditioning);
      $(".doors").text(dirver.carInfo.doors);
       $(".fuel_filling").text(dirver.carInfo.fuel_filling);
       $(".fuel_type").text(dirver.carInfo.fuel_type);
       $(".gear").text(dirver.carInfo.gear);
			 $(".max_power").text(dirver.carInfo.max_power);
			 $(".mileage").text(dirver.carInfo.mileage);
			 $(".mph").text(dirver.carInfo.mph);

			 $(".passengers").text(dirver.carInfo.passenger);

			 $(".top_speed").text(dirver.carInfo.topSpeed);


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
