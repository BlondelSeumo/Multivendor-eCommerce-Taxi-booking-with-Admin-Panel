@include('layouts.app')



@include('layouts.header')

<div class="siddhi-popular">


   

		<div class="container">
       
			
			<!-- <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div> -->
			<div class="error_top"></div>
			<div class="row vendor_payout_create">
				<div class="vendor_payout_create-inner">

					<fieldset>
						<legend>{{trans('lang.user_profile')}}</legend>
						<div class="form-group row width-50">
							<label class="col-3 control-label">{{trans('lang.first_name')}}</label>
							<div class="col-7">
								<input type="text" class="form-control user_first_name">
								<div class="form-text text-muted">
									{{ trans("lang.user_first_name_help") }}
								</div>
							</div>
						</div>
						
						<div class="form-group row width-50">
							<label class="col-3 control-label">{{trans('lang.last_name')}}</label>
							<div class="col-7">
								<input type="text" class="form-control user_last_name">
								<div class="form-text text-muted">
									{{ trans("lang.user_last_name_help") }}
								</div>
							</div>
						</div>
						<div class="form-group row width-50">
							<label class="col-3 control-label">{{trans('lang.email')}}</label>
							<div class="col-7">
								<input type="text" class="form-control user_email">
								<div class="form-text text-muted">
									{{ trans("lang.user_email_help") }}
								</div>
							</div>
						</div>
						<!-- <div class="form-group row width-50">
							<label class="col-3 control-label">{{trans('lang.password')}}</label>
							<div class="col-7">
								<input type="password" class="form-control user_password">
								<div class="form-text text-muted">
									{{ trans("lang.user_password_help") }}
								</div>
							</div>
						</div> -->
						<div class="form-group row width-50">
							<label class="col-3 control-label">{{trans('lang.user_phone')}}</label>
							<div class="col-7">
								<input type="text" class="form-control user_phone">
								<div class="form-text text-muted w-50">
									{{ trans("lang.user_phone_help") }}
								</div>
							</div>
							
						</div>
						
						<div class="form-group row width-100">
							<label class="col-3 control-label">{{trans('lang.vendor_image')}}</label>
							<input type="file" onChange="handleFileSelect(event)" class="col-7">
							<div class="placeholder_img_thumb user_image"></div>
							<div id="uploding_image"></div>
						</div>
						<div class="form-group row width-100">
							
							<div class="form-check">
								<input type="checkbox" class="user_active" id="user_active">
								<label class="col-3 control-label" for="user_active">{{trans('lang.active')}}</label>
							</div>
							<!-- <div class="checkbox">
										<label class="col-3 control-label">{{trans('lang.active')}}</label>
										<input type="checkbox" class="col-7 form-control form-check-inline user_active">
							</div> -->
							
						</div>
					</fieldset>

					<fieldset>
						<legend>{{trans('lang.address')}}</legend>
						<div class="form-group row width-50">
							<label class="col-3 control-label">{{trans('lang.address_line1')}}</label>
							<div class="col-7">
								<input type="text" class="form-control address_line1">
								<div class="form-text text-muted w-50">
									{{ trans("lang.address_line1_help") }}
								</div>
							</div>
							
						</div>
						<div class="form-group row width-50">
							<label class="col-3 control-label">{{trans('lang.address_line2')}}</label>
							<div class="col-7">
								<input type="text" class="form-control address_line2">
								<div class="form-text text-muted w-50">
									{{ trans("lang.address_line2_help") }}
								</div>
							</div>
							
						</div>
						
						<div class="form-group row width-50">
							<label class="col-3 control-label">{{trans('lang.city')}}</label>
							<div class="col-7">
								<input type="text" class="form-control city">
								<div class="form-text text-muted w-50">
									{{ trans("lang.city_help") }}
								</div>
							</div>
							
						</div>
						<div class="form-group row width-50">
							<label class="col-3 control-label">{{trans('lang.country')}}</label>
							<div class="col-7">
								<input type="text" class="form-control country">
								<div class="form-text text-muted w-50">
									{{ trans("lang.country_help") }}
								</div>
							</div>
							
						</div>
						<div class="form-group row width-50">
							<label class="col-3 control-label">{{trans('lang.postalcode')}}</label>
							<div class="col-7">
								<input type="text" class="form-control postalcode">
								<div class="form-text text-muted w-50">
									{{ trans("lang.postalcode_help") }}
								</div>
							</div>
							
						</div>
						<div class="form-group row width-100">
							<div class="col-12">
								<h6>{{ trans("lang.know_your_cordinates") }} <a target="_blank" href="https://www.latlong.net/"> {{ trans("lang.latitude_and_longitude_finder") }} </a></h6>
							</div>
						</div>
						<div class="form-group row width-50">
							<label class="col-3 control-label">{{trans('lang.user_latitude')}}</label>
							<div class="col-7">
								<input type="text" class="form-control user_latitude">
								<div class="form-text text-muted w-50">
									{{ trans("lang.user_latitude_help") }}
								</div>
							</div>
							
						</div>
						<div class="form-group row width-50">
							<label class="col-3 control-label">{{trans('lang.user_longitude')}}</label>
							<div class="col-7">
								<input type="text" class="form-control user_longitude">
								<div class="form-text text-muted w-50">
									{{ trans("lang.user_longitude_help") }}
								</div>
							</div>
							
						</div>
						
					</fieldset>

					<fieldset>
			             <legend>{{trans('lang.password')}}</legend>
			             <div class="form-group row width-50">
			              <label class="col-3 control-label">{{trans('lang.old_password')}}</label>
			              <div class="col-7">
			                <input type="password" class="form-control user_old_password" required>
			                <div class="form-text text-muted">
			                  {{ trans("lang.user_password_help") }}
			                </div>
			              </div>
			            </div>

			            <div class="form-group row width-50">
			              <label class="col-3 control-label">{{trans('lang.new_password')}}</label>
			              <div class="col-7">
			                <input type="password" class="form-control user_new_password" required>
			                <div class="form-text text-muted">
			                  {{ trans("lang.user_password_help") }}
			                </div>
			              </div>
			            </div>
			            <div class="form-group col-12 text-center">
			            <button type="button" class="btn btn-primary  change_user_password" ><i class="fa fa-save"></i>{{trans('lang.change_password')}}</button>
			          </div>

			        </fieldset>

				</div>
			</div>
		</div>
		<div class="form-group col-12 text-center btm-btn" >
			<button type="button" class="btn btn-primary  save_user_btn" ><i class="fa fa-save"></i> {{ trans('lang.save')}}</button>
			<a href="{!! url('home') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
		</div>

	</div>

@include('layouts.footer')



@include('layouts.nav')

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>

<script>

    console.log('user_uuid  '+user_uuid);
	var id = user_uuid;
	var database = firebase.firestore();
	var ref = database.collection('users').where("id","==",id);

	var photo ="";
	var placeholderImage = '';
    var placeholder = database.collection('settings').doc('placeHolderImage');
 
    placeholder.get().then( async function(snapshotsimage){
        var placeholderImageData = snapshotsimage.data();
        placeholderImage = placeholderImageData.image;
    })
	$(document).ready(function(){

 		//jQuery("#data-table_processing").show();

  		ref.get().then( async function(snapshots){

		var user = snapshots.docs[0].data();
		$(".user_first_name").val(user.firstName);
		$(".user_last_name").val(user.lastName);
		$(".user_email").val(user.email);
		$(".user_phone").val(user.phoneNumber);

		$(".address_line1").val(user.shippingAddress.line1);
		$(".address_line2").val(user.shippingAddress.line2);
		$(".city").val(user.shippingAddress.city);
		$(".country").val(user.shippingAddress.country);
		$(".postalcode").val(user.shippingAddress.postalCode);
		$(".user_latitude").val(user.shippingAddress.location.latitude);
		$(".user_longitude").val(user.shippingAddress.location.longitude);

		photo = user.profilePictureURL;
		if (photo!='') {

			$(".user_image").append('<img class="rounded" style="width:50px" src="'+photo+'" alt="image">');
		}else{

			$(".user_image").append('<img class="rounded" style="width:50px" src="'+placeholderImage+'" alt="image">');
		}
		
		if(user.active){
		  $(".user_active").prop('checked',true);
		}


  	jQuery("#data-table_processing").hide();
 
  })

  	$(".change_user_password").click(function(){
	    var userOldPassword =  $(".user_old_password").val();
	    var userNewPassword = $(".user_new_password").val();
	    var userEmail = $(".user_email").val();

	    if(userOldPassword == ''){
	        $(".error_top").show();
	        $(".error_top").html("");
	        $(".error_top").append("<p>{{trans('lang.old_password_error')}}</p>");
	        window.scrollTo(0, 0);
	    }else if(userNewPassword == ''){
	        $(".error_top").show();
	        $(".error_top").html("");
	        $(".error_top").append("<p>{{trans('lang.new_password_error')}}</p>");
	        window.scrollTo(0, 0);
	    }else{
	        
	      	var user = firebase.auth().currentUser;

		 	firebase.auth().signInWithEmailAndPassword(userEmail, userOldPassword).then((userCredential) => {
			    var user = userCredential.user;
			      user.updatePassword(userNewPassword).then(() => {
			            $(".error_top").show();
			            $(".error_top").html("");
			            $(".error_top").append("<p>{{trans('lang.password_updated_successfully')}}</p>");
			            window.scrollTo(0, 0);
			          }).catch((error) => { 
			            $(".error_top").show();
			            $(".error_top").html("");
			            $(".error_top").append("<p>"+error+"</p>");
			            window.scrollTo(0, 0);
			          });
			  	}).catch((error) => {
			      var errorCode = error.code;
			      var errorMessage = error.message;
			      $(".error_top").show();
			      $(".error_top").html("");
			      $(".error_top").append("<p>"+errorMessage+"</p>");
			      window.scrollTo(0, 0);
			  });


	    	}
	  });
  
$(".save_user_btn").click(function(){
 
	var userFirstName = $(".user_first_name").val();
	var userLastName = $(".user_last_name").val();
	var email = $(".user_email").val();
	var userPhone = $(".user_phone").val();
	var active = $(".user_active").is(":checked");
	var password = $(".user_password").val();
	var user_name = userFirstName+" "+userLastName;

	var address_line1 = $(".address_line1").val();
	var address_line2 = $(".address_line2").val();
	var city = $(".city").val();
	var country = $(".country").val();
	var postalcode = $(".postalcode").val();

	var latitude = parseFloat($(".user_latitude").val());
	var longitude = parseFloat($(".user_longitude").val());

	var location = {'latitude':latitude ,'longitude':longitude };
	var shippingAddress = { 'city': city,'country': country,'email': email,'line1': address_line1,'line2': address_line2,'location': location, 'name': name,'postalCode': postalcode};

 	if(userFirstName == ''){
        $(".error_top").show();
        $(".error_top").html("");
        $(".error_top").append("<p>{{trans('lang.user_firstname_error')}}</p>");
        window.scrollTo(0, 0);

    }else if(email == ''){
        $(".error_top").show();
        $(".error_top").html("");
        $(".error_top").append("<p>{{trans('lang.user_email_error')}}</p>");
        window.scrollTo(0, 0);
    } else if(userPhone == '' ){
        $(".error_top").show();
        $(".error_top").html("");
        $(".error_top").append("<p>{{trans('lang.user_phone_error')}}</p>");
        window.scrollTo(0, 0);
    }else if(address_line1 == '' ){
	    $(".error_top").show();
	    $(".error_top").html("");
	    $(".error_top").append("<p>{{trans('lang.address_line1_error')}}</p>");
	    window.scrollTo(0, 0);
 	}  else if(city == '' ){
	    $(".error_top").show();
	    $(".error_top").html("");
	    $(".error_top").append("<p>{{trans('lang.city_error')}}</p>");
	    window.scrollTo(0, 0);
 	}  else if(country == '' ){
	    $(".error_top").show();
	    $(".error_top").html("");
	    $(".error_top").append("<p>{{trans('lang.country_error')}}</p>");
	    window.scrollTo(0, 0);
 	} else if(postalcode == '' ){
	    $(".error_top").show();
	    $(".error_top").html("");
	    $(".error_top").append("<p>{{trans('lang.postalcode_error')}}</p>");
	    window.scrollTo(0, 0);
 	} else if(latitude < -90 || latitude > 90){
      	$(".error_top").show();
        $(".error_top").html("");
        $(".error_top").append("<p>{{trans('lang.user_lattitude_limit_error')}}</p>");
        window.scrollTo(0, 0);
  	}else if(longitude < -180 || longitude > 180){
      $(".error_top").show();
      $(".error_top").html("");
      $(".error_top").append("<p>{{trans('lang.user_longitude_limit_error')}}</p>");
      window.scrollTo(0, 0);

  	}else{

       database.collection('users').doc(id).update({'firstName':userFirstName,'lastName':userLastName,'email':email,'phoneNumber':userPhone,'isActive':active,'profilePictureURL':photo,'role':'customer','shippingAddress':shippingAddress,'active':active}).then(function(result) {
                
                window.location.href = '{{ url("home")}}';

             }); 
   }
    
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
            $(".user_image").empty();
            $(".user_image").append('<img class="rounded" style="width:50px" src="'+photo+'" alt="image">');


      });   
    });
    
    };
  })(f);
  reader.readAsDataURL(f);
}   


</script>
