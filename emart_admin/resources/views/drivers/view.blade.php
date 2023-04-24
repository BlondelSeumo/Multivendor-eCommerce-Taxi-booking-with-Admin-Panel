@extends('layouts.app')

@section('content')
	<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.driver_plural')}} <span class="itemTitle"></span></h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href= "{!! route('vendors') !!}" >{{trans('lang.driver_plural')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.driver_details')}}</li>
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
                  <li class="active">
                      <a href="{{route('drivers.view',$id)}}">{{trans('lang.tab_basic')}}</a>
                  </li>
									<li>
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
                    <legend>{{trans('lang.driver_details')}}</legend>
                          <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.first_name')}}</label>
                          <div class="col-7" class="driver_name">
                              <span class="driver_name" id="driver_name"></span>
                            </div>
                        </div>

                        <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.email')}}</label>
                          <div class="col-7">
                          <span class="email"></span>
                          </div>
                        </div>

                        <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.user_phone')}}</label>
                          <div class="col-7">
                          <span class="phone"></span>
                          </div>
                        </div>
                        <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.profile_image')}}</label>
                          <div class="col-7 profile_image">
                          </div>
                          </div>
                        <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.service_type')}}</label>
                          <div class="col-7">
                          <span class="service_type"></span>
                          </div>
                        </div>
                        <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.type')}}</label>
                          <div class="col-7">
                          <span class="type"></span>
                          </div>
                        </div>
                        <div class="company_details" style="display:none">
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

      <!-- <div class="row vendor_payout_create">
          <div class="vendor_payout_create-inner"> -->
                <fieldset>
                  <legend>{{trans('lang.bankdetails')}}</legend>
                        <div class="form-group row width-50">
                          <label class="col-4 control-label">{{
                          trans('lang.bank_name')}}</label>
                          <div class="col-7">
                          <span class="bank_name"></span>
                          </div>
                        </div>

                        <div class="form-group row width-50">
                          <label class="col-4 control-label">{{
                          trans('lang.branch_name')}}</label>
                          <div class="col-7">
                          <span class="branch_name"></span>
                          </div>
                        </div>


                        <div class="form-group row width-50">
                          <label class="col-4 control-label">{{
                          trans('lang.holer_name')}}</label>
                          <div class="col-7">
                          <span class="holer_name"></span>
                          </div>
                        </div>

                        <div class="form-group row width-50">
                          <label class="col-4 control-label">{{
                          trans('lang.account_number')}}</label>
                          <div class="col-7">
                          <span class="account_number"></span>
                          </div>
                        </div>

                        <div class="form-group row width-50">
                          <label class="col-4 control-label">{{
                          trans('lang.other_information')}}</label>
                          <div class="col-7">
                          <span class="other_information"></span>
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

       $(".service_type").text(dirver.serviceType);
       if(dirver.isCompany != false){
        $(".type").text('Company');
        $(".company_details").show();
        $(".company_address").text(dirver.companyAddress)
        $(".company_name").text(dirver.companyName)
       }else{
        $(".type").text('Individual');
       }
      var image="";
      if (dirver.profilePictureURL) {
        image='<img width="200px" id="" height="auto" src="'+dirver.profilePictureURL+'">';
      }else{
        image='<img width="200px" id="" height="auto" src="'+placeholderImage+'">';
      }
			$(".profile_image").html(image);
      $(".bank_name").text(dirver.userBankDetails.bankName);
      $(".branch_name").text(dirver.userBankDetails.branchName);
       $(".holer_name").text(dirver.userBankDetails.holderName);
       $(".account_number").text(dirver.userBankDetails.accountNumber);
       $(".other_information").text(dirver.userBankDetails.otherDetails);

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
