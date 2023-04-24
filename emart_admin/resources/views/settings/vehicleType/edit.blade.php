@extends('layouts.app')

@section('content')
<div class="page-wrapper">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">{{trans('lang.edit_vehicle_type')}}</h3>
		</div>

		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
				<li class="breadcrumb-item"><a href= "{!! route('settings.vehicleType') !!}" >{{trans('lang.vehicle_type')}}</a></li>
				<li class="breadcrumb-item active">{{trans('lang.edit_vehicle_type')}}</li>
			</ol>
		</div>

			<div class="card-body">

				<div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
				<div class="error_top"></div>

				<div class="row vendor_payout_create">
          		<div class="vendor_payout_create-inner">
          			<fieldset>
					  <legend>{{trans('lang.vehicle_type')}}</legend>
						<div class="form-group row width-50">
							<label class="col-3 control-label">{{trans('lang.name')}}</label>
							<div class="col-7">
								<input type="text" class="form-control name" id="name">
								<div class="form-text text-muted">{{trans('lang.user_name_help')}}</div>

							</div>
						</div>

						<div class="form-group row width-50">
							<label class="col-3 control-label">{{trans('lang.capacity')}}</label>
							<div class="col-7">
								<input type="text" class="form-control capacity" id="capacity">
								<div class="form-text text-muted">{{trans('lang.capacity_help')}}</div>

							</div>
						</div>
						<div class="form-group row width-50">
							<label class="col-3 control-label">{{trans('lang.short_description')}}</label>
							<div class="col-7">
								<input type="text" class="form-control short_description" id="short_description">
								<div class="form-text text-muted">{{trans('lang.short_description_help')}}</div>

							</div>
						</div>
						<div class="form-group row width-50">
							<label class="col-3 control-label">{{trans('lang.description')}}</label>
							<div class="col-7">
								<textarea class="form-control description" id="description" rows="2"></textarea>
								<div class="form-text text-muted">{{trans('lang.description_help')}}</div>

							</div>
						</div>
						<div class="form-group row width-50">
							<label class="col-3 control-label">{{trans('lang.supported_vehicle')}}</label>
							<div class="col-7">
								<textarea class="form-control supported_vehicle" id="supported_vehicle" rows="2"></textarea>
								<div class="form-text text-muted">{{trans('lang.supported_vehicle_help')}}</div>

							</div>
						</div>
						<div class="form-group row width-100">
							<label class="col-3 control-label">{{trans('lang.icon')}}</label>
							<input type="file" onChange="handleFileSelect(event)" class="col-7">
							<div class="placeholder_img_thumb user_image"></div>
							<div id="uploding_image"></div>
						</div>

						<div class="form-group row width-100">
						<div class="form-check">
							<input type="checkbox" class="vehicle_type_active" id="vehicle_type_active">
							<label class="col-3 control-label" for="vehicle_type_active">{{trans('lang.active')}}</label>

						</div>


					</div>
					</fieldset>

					<fieldset>
                        <legend>{{trans('lang.deliveryCharge')}}</legend>

                        <div class="form-group row width-100">
                            <label class="col-4 control-label">{{ trans('lang.delivery_charges_per_km')}}</label>
                            <div class="col-7">
                                <input type="number" class="form-control" id="delivery_charges_per_km">
                            </div>
                        </div>

                        <div class="form-group row width-100">
                            <label class="col-4 control-label">{{ trans('lang.minimum_delivery_charges')}}</label>
                            <div class="col-7">
                                <input type="number" class="form-control" id="minimum_delivery_charges">
                            </div>
                        </div>

                        <div class="form-group row width-100">
                            <label class="col-4 control-label">{{ trans('lang.minimum_delivery_charges_within_km')}}</label>
                            <div class="col-7">
                                <input type="number" class="form-control" id="minimum_delivery_charges_within_km">
                            </div>
                        </div>
                    </fieldset>
			</div>
		</div>
	</div>

		<div class="form-group col-12 text-center btm-btn" >
			<button type="button" class="btn btn-primary  create_user_btn" ><i class="fa fa-save"></i> {{ trans('lang.save')}}</button>
			<a href="{!! url('settings/vehicleType') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
		</div>

</div>

</div>

@endsection

@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>

<script>
var database = firebase.firestore();
var photo ="";
var placeholderImage = '';
var id = "<?php echo $id;?>";
var ref = database.collection('vehicle_type').where('id','==',id);

var placeholder = database.collection('settings').doc('placeHolderImage');

			placeholder.get().then( async function(snapshotsimage){
				var placeholderImageData = snapshotsimage.data();
				placeholderImage = placeholderImageData.image;
			})

$(document).ready(function(){
	jQuery("#data-table_processing").show();

	ref.get().then( async function(snapshots){

		var vehicleType = snapshots.docs[0].data();
		 $(".name").val(vehicleType.name);
		 $('.capacity').val(vehicleType.capacity);
		 $('.short_description').val(vehicleType.short_description);
		 $('.description').text(vehicleType.description);
		 $('.supported_vehicle').text(vehicleType.supported_vehicle);
		photo = vehicleType.vehicle_icon;
		if (photo!='') {

			$(".user_image").append('<img class="rounded" style="width:50px" src="'+photo+'" alt="image">');
		}else{

			$(".user_image").append('<img class="rounded" style="width:50px" src="'+placeholderImage+'" alt="image">');
		}

		if(vehicleType.isActive == true){
			$(".vehicle_type_active").prop('checked',true);
		}

		if(vehicleType.delivery_charges_per_km){
			$("#delivery_charges_per_km").val(vehicleType.delivery_charges_per_km);
		}
		if(vehicleType.minimum_delivery_charges){
			$("#minimum_delivery_charges").val(vehicleType.minimum_delivery_charges);
		}
		if(vehicleType.minimum_delivery_charges_within_km){
			$("#minimum_delivery_charges_within_km").val(vehicleType.minimum_delivery_charges_within_km);

		}
	jQuery("#data-table_processing").hide();

	});
});

$(".create_user_btn").click(function(){

		var name = $(".name").val();
		var capacity = $('.capacity').val();
		var short_description = $('.short_description').val();
		var description = $('.description').val();
		var supported_vehicle = $('.supported_vehicle').val();
		var delivery_charges_per_km = parseInt($("#delivery_charges_per_km").val());
		var minimum_delivery_charges = parseInt($("#minimum_delivery_charges").val());
		var minimum_delivery_charges_within_km = parseInt($("#minimum_delivery_charges_within_km").val());
		var active = $(".vehicle_type_active").is(":checked");


		if(name == ''){
			$(".error_top").show();
			$(".error_top").html("");
			$(".error_top").append("<p>{{trans('lang.name_error')}}</p>");
			window.scrollTo(0, 0);

		}else if(capacity == ''){
			$(".error_top").show();
			$(".error_top").html("");
			$(".error_top").append("<p>{{trans('lang.capacity_error')}}</p>");
			window.scrollTo(0, 0);

		}else if(short_description == ''){
			$(".error_top").show();
			$(".error_top").html("");
			$(".error_top").append("<p>{{trans('lang.short_description_error')}}</p>");
			window.scrollTo(0, 0);

		}else if(description == ''){
			$(".error_top").show();
			$(".error_top").html("");
			$(".error_top").append("<p>{{trans('lang.description_error')}}</p>");
			window.scrollTo(0, 0);

		}else if(supported_vehicle == ''){
			$(".error_top").show();
			$(".error_top").html("");
			$(".error_top").append("<p>{{trans('lang.supported_vehicle_error')}}</p>");
			window.scrollTo(0, 0);

		}else{
			jQuery("#data-table_processing").show();
			database.collection('vehicle_type').doc(id).update({'id':id, 'name':name, 'capacity':capacity,'short_description':short_description,'description':description, 'supported_vehicle':supported_vehicle, 'vehicle_icon':photo, 'isActive':active,
				'delivery_charges_per_km':delivery_charges_per_km, 'minimum_delivery_charges':minimum_delivery_charges, 'minimum_delivery_charges_within_km':minimum_delivery_charges_within_km}).then(function(result) {
				jQuery("#data-table_processing").hide();
				window.location.href = '{{ route("settings.vehicleType") }}';
			});
		}

});
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
			 var filename = filename.split('.')[0]+"_"+timestamp+'.'+ext;   
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
            $(".user_image").empty();
            $(".user_image").append('<img class="rounded" style="width:50px" src="'+photo+'" alt="image">');

      });
    });

    };
  })(f);
  reader.readAsDataURL(f);
}
</script>
@endsection
