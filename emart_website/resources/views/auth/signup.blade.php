@include('auth.default')

<?php if(isset($_COOKIE['section_color'])){ ?>
<style type="text/css">
	.btn-primary{background:<?php echo $_COOKIE['section_color']; ?>;border-color:<?php echo $_COOKIE['section_color']; ?>;}
	.btn-primary:hover,.btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .btn-primary:focus{background: <?php echo $_COOKIE['section_color']; ?>;border-color: <?php echo $_COOKIE['section_color']; ?>;}
</style>
<?php } ?>

<div class="siddhi-signup login-page">



<div class="d-flex align-items-center justify-content-center flex-column pt-4">

<div class="col-md-6">

<div class="col-10 mx-auto card p-3">


	<h3 class="text-dark my-0 mb-3">{{trans('lang.sign_up_with_us')}}</h3>

	<p class="text-50">{{trans('lang.sign_up_to_continue')}}</p>

<div class="error" id="field_error"></div>

<form class="mt-3 mb-4" action="#" onsubmit="return signupClick()">

 <!-- <div class="form-group">

<label for="exampleInputName1" class="text-dark">Name</label>

<input type="text" placeholder="Enter Name" class="form-control" id="exampleInputName1" aria-describedby="nameHelp">

</div> -->


	<div class="form-group">

		<label for="firstName" class="text-dark">{{trans('lang.first_name')}}</label>

		<input type="text" placeholder="{{trans('lang.first_name_help_2')}}" class="form-control" id="firstName" aria-describedby="FnameHelp">

	</div>

	<div class="form-group">

		<label for="lastName" class="text-dark">{{trans('lang.last_name')}}</label>

		<input type="text" placeholder="{{trans('lang.last_name_help_2')}}" class="form-control" id="lastName" aria-describedby="LnameHelp">

	</div>

	<div class="form-group">

		<label for="email" class="text-dark">{{trans('lang.email_address')}}</label>

		<input type="email" placeholder="{{trans('lang.email_address_help')}}" class="form-control" id="email">

	</div>

	<div class="form-group">

		<label for="mobileNumber" class="text-dark">{{trans('lang.mobile_number')}}</label>

		<input type="text" placeholder="{{trans('lang.mobile_number_help')}}" class="form-control" id="mobileNumber" aria-describedby="numberHelp">

	</div>

	<div class="form-group">

		<label for="password" class="text-dark">{{trans('lang.password')}}</label>

		<input type="password" placeholder="{{trans('lang.user_password_help_2')}}" class="form-control" id="password">

	</div>





<button type="submit" class="btn btn-primary btn-lg btn-block">

	{{trans('lang.sign_up')}}

</button>

<!-- <div class="py-2">

<button class="btn btn-facebook btn-lg btn-block"><i class="feather-facebook"></i> Connect with Facebook</button>

</div> -->

</form>

</div>

<div class="new-acc d-flex align-items-center justify-content-center">

<a href="{{url('login')}}">

	<p class="text-center m-0">{{trans('lang.already_an_account')}} {{trans('lang.sign_in')}}</p>

</a>

</div>

</div>

</div>

</div>





<script type="2962f67e2ff6ccac59b12edc-text/javascript" src="vendor/jquery/jquery.min.js"></script>

<script type="2962f67e2ff6ccac59b12edc-text/javascript" src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



<script type="2962f67e2ff6ccac59b12edc-text/javascript" src="vendor/slick/slick.min.js"></script>



<script type="2962f67e2ff6ccac59b12edc-text/javascript" src="vendor/sidebar/hc-offcanvas-nav.js"></script>



<script type="2962f67e2ff6ccac59b12edc-text/javascript" src="js/siddhi.js"></script>

<script src="js/rocket-loader.min.js" data-cf-settings="2962f67e2ff6ccac59b12edc-|49" defer=""></script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194" integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw==" data-cf-beacon='{"rayId":"6c83f3c58cbe41ab","version":"2021.12.0","r":1,"token":"dd471ab1978346bbb991feaa79e6ce5c","si":100}' crossorigin="anonymous"></script>







<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-app.js"></script>

    <script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-firestore.js"></script>

        <script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-storage.js"></script>

    <script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-auth.js"></script>

<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-database.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>



<script type="text/javascript">@include('vendor_include.init_firebase')</script>



<script type="text/javascript">

		var createdAtman=firebase.firestore.Timestamp.fromDate(new Date());
        var createdAt={_nanoseconds: createdAtman.nanoseconds,_seconds: createdAtman.seconds};

		 var database = firebase.firestore();

          function signupClick(){

        	var email = $("#email").val();

        	var password = $("#password").val();

        	var mobileNumber = $("#mobileNumber").val();

        	var firstName = $("#firstName").val();

        	var lastName = $("#lastName").val();

        	firebase.auth().createUserWithEmailAndPassword(email, password)

  			.then((userCredential) => {

  				var uuid=userCredential.user.uid;

			  	database.collection("users").doc(uuid).set({'email': email,'firstName': firstName,'lastName': lastName,'id':uuid,'phoneNumber': mobileNumber,
			  		'role': "customer",'profilePictureURL':"",'createdAt':createdAt
				})

				.then(() => {

						firebase.auth().signInWithEmailAndPassword(email, password).then(function(result) {
								var url = "{{route('newRegister')}}";

								$.ajax({
          							type:'POST',
          							url:url,
          							data:{userId:uuid,email:email,password:password,firstName:firstName,lastName:lastName},
          					   		headers: {
        								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    								},

          							success:function(data){

          						  	if(data.access){	

                          				window.location = "{{url('/')}}";

                        		  	}

          							}

          						})

						})

					})

						.catch((error) => {

		    				console.error("Error writing document: ", error);

                $("#field_error").html(error);

						});

     

  		})

  		.catch((error) => {

    		var errorCode = error.code;

    		var errorMessage = error.message;

        $("#field_error").html(errorMessage);

		});



       

        return false;

    	}



</script>

