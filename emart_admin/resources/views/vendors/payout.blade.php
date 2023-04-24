@extends('layouts.app')

@section('content')
	<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.vendor_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href= "{!! route('vendors') !!}" >{{trans('lang.vendor_plural')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.vendor_edit')}}</li>
            </ol>
        </div>
    <div>

    <div class="card-body">
      	<div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
      <div class="menu-tab">
      		<ul>
      			<li>
      					<a href="{{route('vendors.view',$id)}}">{{trans('lang.tab_basic')}}</a>
      			</li>
      			<li>
      					<a href="{{route('vendors.items',$id)}}">{{trans('lang.item')}}</a>
      			</li>
      			<li>
      					<a href="{{route('vendors.orders',$id)}}">{{trans('lang.order_plural')}}</a>
      			</li>
      			<li>
      					<a href="{{route('vendors.reviews',$id)}}">{{trans('lang.tab_reviews')}}</a>
      			</li>
      			<li>
      					<a href="{{route('vendors.promos',$id)}}">{{trans('lang.tab_promos')}}</a>
      			</li>
      			<li class="active">
      					<a href="#">{{trans('lang.tab_payouts')}}</a>
      			</li>
      		</ul>
      </div>
      <div class="row daes-top-sec">
      				<div class="col-lg-4 col-md-6">

                  <div class="card">

                      <div class="flex-row">

                          <div class="p-10 bg-info col-md-12 text-center">

                              <h3 class="text-white box m-b-0"><i class="mdi mdi-bank"></i></h3></div>

                          <div class="align-self-center pt-3 col-md-12 text-center">

                              <h3 class="m-b-0 text-info" id="vendor_count">44</h3>

                              <h5 class="text-muted m-b-0">{{trans('lang.dashboard_total_earnings')}}</h5>

                          </div>

                      </div>

                  </div>

            </div>

            <div class="col-lg-4 col-md-6">

                  <div class="card">

                      <div class="flex-row">

                          <div class="p-10 bg-info col-md-12 text-center">

                              <h3 class="text-white box m-b-0"><i class="ti-wallet"></i></h3></div>

                          <div class="align-self-center pt-3 col-md-12 text-center">

                              <h3 class="m-b-0 text-info" id="vendor_count">44</h3>

                              <h5 class="text-muted m-b-0">{{trans('lang.dashboard_total_payment')}}</h5>

                          </div>

                      </div>

                  </div>

            </div>

            <div class="col-lg-4 col-md-6">

                  <div class="card">

                      <div class="flex-row">

                          <div class="p-10 bg-info col-md-12 text-center">

                              <h3 class="text-white box m-b-0"><i class="ti-wallet"></i></h3></div>

                          <div class="align-self-center pt-3 col-md-12 text-center">

                              <h3 class="m-b-0 text-info" id="vendor_count">44</h3>

                              <h5 class="text-muted m-b-0">{{trans('lang.remaining_payment')}}</h5>

                          </div>

                      </div>

                  </div>

            </div>

      </div>
      <div class="row vendor_payout_create">
        <div class="vendor_payout_create-inner">
          <fieldset>
             <legend>{{trans('lang.vendor_details')}}</legend>
            
              <div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.vendor_name')}}</label>
               	<div class="col-7">
                	<input type="text" class="form-control vendor_name">
                	<div class="form-text text-muted">
                  	{{ trans("lang.vendor_name_help") }}
                	</div>
              	</div>
            	</div>

      			<div class="form-group row">
        			<label class="col-3 control-label">{{trans('lang.vendor_cuisines')}}</label>
        			<div class="col-9">
        				<select id='vendor_cuisines' class="form-control">
        					<option value="">{{trans('lang.select_cuisines')}}</option>
        				</select>
        				<div class="form-text text-muted">
                  			{{ trans("lang.vendor_cuisines_help") }}
        				</div>
      				</div>
      			</div>

            <div class="form-group row">
        			<label class="col-3 control-label">{{trans('lang.vendor_phone')}}</label>
        			<div class="col-9">
        				<input type="text" class="form-control vendor_phone">
        				<div class="form-text text-muted">
                  	{{ trans("lang.vendor_phone_help") }}
        				</div>
      				</div>
      			</div>

            <div class="form-group row">
        			<label class="col-3 control-label">{{trans('lang.vendor_address')}}</label>
        			<div class="col-9">
        				<input type="text" class="form-control vendor_address">
        				<div class="form-text text-muted">
                  			{{ trans("lang.vendor_address_help") }}
        				</div>
      				</div>
      			</div>
      

      			<div class="form-group row">
        			<label class="col-3 control-label">{{trans('lang.vendor_latitude')}}</label>
        			<div class="col-9">
        				<input type="text" class="form-control vendor_latitude">
        				<div class="form-text text-muted">
                  			{{ trans("lang.vendor_latitude_help") }}
        				</div>
      				</div>

      			</div>

      			<div class="form-group row">
        			<label class="col-3 control-label">{{trans('lang.vendor_longitude')}}</label>
        			<div class="col-9">
        				<input type="text" class="form-control vendor_longitude">
        				<div class="form-text text-muted">
                  			{{ trans("lang.vendor_longitude_help") }}
        				</div>
      				</div>
      			</div>
          

          <div class="form-group row">
            <label class="col-3 control-label ">{{trans('lang.vendor_description')}}</label>
              <div class="col-7">
                <textarea rows="7" class="vendor_description form-control" id="vendor_description"></textarea>
              </div>
          </div>
      
          <div class="form-group row">
            <label class="col-3 control-label">{{trans('lang.vendor_image')}}</label>
            <div class="col-9">
              <input type="file" onChange="handleFileSelect(event)">
              <div id="uploding_image"></div>
              <div class="form-text text-muted">
                {{ trans("lang.vendor_image_help") }}
              </div>
            </div>
          </div>

      </fieldset>

      <fieldset>
        <legend>{{trans('lang.admin_area')}}</legend>

        <div class="form-group row">
          <label class="col-3 control-label">{{trans('lang.vendor_users')}}</label>
          <input type="text" class=" col-3 form-control vendor_owners" disabled>
        </div>
      </fieldset>

    </div>
  </div>
</div>
      <div class="form-group col-12 text-center">
          <button type="button" class="btn btn-primary  save_vendor_btn" ><i class="fa fa-save"></i> {{trans('lang.save')}}</button>
         <a href="{!! route('vendors') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
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
	var ref = database.collection('vendors').where("id","==",id);
	var photo ="";
	var vendorOwnerId = "";
	var vendorOwnerOnline = false;
	$(document).ready(function(){
  		jQuery("#data-table_processing").show();
  		ref.get().then( async function(snapshots){
			var vendor = snapshots.docs[0].data();
			$(".vendor_name").val(vendor.title);
			$(".vendor_cuisines").val(vendor.filters.Cuisine);
			$(".vendor_address").val(vendor.location);
			$(".vendor_latitude").val(vendor.latitude);
			$(".vendor_longitude").val(vendor.longitude);
			$(".vendor_description").val(vendor.description);

			vendorOwnerOnline = vendor.isActive;
	   		photo = vendor.photo;
	    	vendorOwnerId = vendor.author;
	 		await database.collection('users').where("id","==",vendor.author).get().then( async function(snapshots){
	   			snapshots.docs.forEach((listval) => {
	            var user = listval.data();
				$(".vendor_owners").val(user.firstName+" "+user.lastName);
	          })
			});

			await database.collection('vendor_categories').get().then( async function(snapshots){
	   			snapshots.docs.forEach((listval) => {
	            	var data = listval.data();
	            	if(data.id == vendor.categoryID){
	                	$('#vendor_cuisines').append($("<option selected></option>")
	                    	.attr("value", data.id)
	                    	.text(data.title));
	            	}else{
	                	$('#vendor_cuisines').append($("<option></option>")
	                    	.attr("value", data.id)
	                    	.text(data.title));
			    	}
	          	})

			});  
	    
	    	if(vendor.hasOwnProperty('phonenumber')){
	     		$(".vendor_phone").val(vendor.phonenumber);
	    	}
	  		jQuery("#data-table_processing").hide();
  		})


  
		$(".save_vendor_btn").click(function(){
		  	var vendorname = $(".vendor_name").val();
			var cuisines = $("#vendor_cuisines option:selected").val();
			var address = $(".vendor_address").val();	
			var latitude = parseFloat($(".vendor_latitude").val());
			var longitude = parseFloat($(".vendor_longitude").val());
			var description = $(".vendor_description").val();
			var phonenumber = $(".vendor_phone").val();
			var categoryTitle = $( "#vendor_cuisines option:selected" ).text();

		    database.collection('vendors').doc(id).update({'title':vendorname,'description':description,'latitude':latitude,
		      'longitude':longitude,'location':address,'photo':photo,'categoryID':cuisines,'phonenumber':phonenumber,'categoryTitle':categoryTitle}).then(function(result) {
		                window.location.href = '{{ route("vendors")}}';
		             }); 
		})

	})

	var storageRef = firebase.storage().ref('images');
	function handleFileSelect(evt) {
  		var f = evt.target.files[0];
  		var reader = new FileReader();
	  	reader.onload = (function(theFile) {
		    return function(e) {
		        
		      var filePayload = e.target.result;
		      var hash = CryptoJS.SHA256(Math.random() + CryptoJS.SHA256(filePayload));
		        var val =f.name;       
		      var ext=val.split('.')[1];
		      var docName=val.split('fakepath')[1];
		      var filename = (f.name).replace(/C:\\fakepath\\/i, '')

		      var timestamp = Number(new Date());      
		      var uploadTask = storageRef.child(filename).put(theFile);
		      console.log(uploadTask);
		      uploadTask.on('state_changed', function(snapshot){

		      var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
		      console.log('Upload is ' + progress + '% done');
		      jQuery("#uploding_image").text("Image is uploading...");
		    }, function(error) {
		    }, function() {
		        uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {
		            jQuery("#uploding_image").text("Upload is completed");
		            photo = downloadURL;

		      });   
		    });
	    
	    };
	  })(f);
  reader.readAsDataURL(f);
}   

</script>
@endsection