
@include('auth.default')

<?php 
$countries = file_get_contents(asset('countriesdata.json'));
    $countries = json_decode($countries);
    $countries=(array)$countries;
    $newcountries=array();
    $newcountriesjs=array();
    foreach ($countries as $keycountry => $valuecountry) {
        $newcountries[$valuecountry->phoneCode]=$valuecountry;
        $newcountriesjs[$valuecountry->phoneCode]=$valuecountry->code;
    }
?>

<?php if(isset($_COOKIE['section_color'])){ ?>
<style type="text/css">
	.btn-primary{background:<?php echo $_COOKIE['section_color']; ?>;border-color:<?php echo $_COOKIE['section_color']; ?>;}
	.btn-primary:hover,.btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .btn-primary:focus{background: <?php echo $_COOKIE['section_color']; ?>;border-color: <?php echo $_COOKIE['section_color']; ?>;}
</style>
<?php } ?>

<link href="{{ asset('vendor/select2/dist/css/select2.min.css')}}" rel="stylesheet">
<div class="login-page vh-100">
  <div class="d-flex align-items-center justify-content-center vh-100">
    <div class="col-md-6">
      <div class="col-10 mx-auto card p-3">
          <h3 class="text-dark my-0 mb-3">{{trans('lang.login')}}</h3>
          <p class="text-50">{{trans('lang.sign_in_to_continue')}}</p>
          <form class="mt-3 mb-4" action="#" onsubmit="return loginClick()" id="login-box">
              <div class="form-group">
                  <label for="email" class="text-dark">{{trans('lang.user_email')}}</label>
                  <input type="email" placeholder="{{trans('lang.user_email_help_2')}}" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                  <div id="emil_required"></div>
              </div>
              <div class="form-group">
                  <label for="password" class="text-dark">{{trans('lang.password')}}</label>
                  <input type="password" placeholder="{{trans('lang.user_password_help_2')}}" class="form-control" id="password" name="password">
                  <div class="error" id="password_required"></div>
              </div>
              <button type="submit" class="btn btn-primary btn-lg btn-block" id="login_btn">{{trans('lang.log_in')}}</button>
              <a href="{{route('signup')}}" class="btn btn-primary btn-lg btn-block">{{trans('lang.sign_up')}}</a>

              <button type="button" onclick="loginWithPhoneClick()"  id="loginphon_btn" class="btn btn-dark btn-lg btn-block text-uppercase waves-effect waves-light btn btn-primary">{{ __('Login') }} {{trans('lang.with_phone')}}</button>

          <!-- <div class="py-2">
            <button class="btn btn-lg btn-facebook btn-block"><i class="feather-facebook"></i> Connect with Facebook</button>
          </div> -->
        </form>

        <form class="form-horizontal form-material" name="loginwithphon" id="login-with-phone-box" action="#" style="display:none;">
                            @csrf
                            <div class="box-title m-b-20">{{ __('Login') }}</div>
                                <div class="form-group " id="phone-box">
                                    <div class="col-xs-12">
                                    <select name="country" id="country_selector">
                                            <?php foreach ($newcountries as $keycy => $valuecy) { ?>
                                                <?php $selected=""; ?>
                                                <option <?php echo $selected; ?> code="<?php echo $valuecy->code; ?>" value="<?php echo $keycy; ?>">+<?php echo $valuecy->phoneCode; ?></option>
                                            <?php } ?>
                                    </select>
                                        <input class="form-control" placeholder="{{trans('lang.user_phone')}}"  id="phone" type="phone" class="form-control" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus> </div>
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>
                                <div class="form-group " id="otp-box" style="display:none;">
                                    <input class="form-control" placeholder="{{trans('lang.otp')}}"  id="verificationcode" type="text" class="form-control" name="otp" value="{{ old('otp') }}" required autocomplete="otp" autofocus> 
                                </div>
                                <div id="recaptcha-container" style="display:none;"></div>

                                <div class="form-group text-center m-t-20">
                                    <div class="col-xs-12">
                                        <button type="button" style="display:none;" onclick="applicationVerifier()"  id="verify_btn" class="btn btn-dark btn-lg btn-block text-uppercase waves-effect waves-light btn btn-primary">{{trans('lang.otp_verify')}}</button>
                                        <button type="button" style="display:none;" onclick="sendOTP()"  id="sendotp_btn" class="btn btn-dark btn-lg btn-block text-uppercase waves-effect waves-light btn btn-primary">{{trans('lang.otp_send')}}</button>
                                        <button type="button" onclick="loginBackClick()" class="btn btn-dark btn-lg btn-block text-uppercase waves-effect waves-light btn btn-primary">{{ __('Login') }} {{trans('lang.with_email')}}</button>
                                        <div class="error" id="password_required_new"></div>

                                    </div>
                                </div>
                        </form>

      </div>
    </div>
  </div>
</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>
<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js"></script>

<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-firestore.js"></script>

<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-storage.js"></script>

<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-auth.js"></script>

<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-database.js"></script>
<!-- <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-messaging.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>

<script type="text/javascript">@include('vendor_include.init_firebase')</script>

<script type="text/javascript">

		 var database = firebase.firestore();
     /*var messaging=firebase.messaging();
     var currentToken='';
     messaging.requestPermission()
            .then(function(){
                console.log("GRANTED");
                console.log(messaging.getToken());
                return messaging.getToken();
            })
            .then(function(token){
                
                currentToken=token;
                console.log(currentToken);
                console.log("currentToken");
            })
            .catch(function(err){
                console.log('Error Occurred.' + err)
            });*/



  //$(".login_btn").click(async function(){

          function loginClick(){

        	var email = $("#email").val();

        	var password = $("#password").val(); 



        	firebase.auth().signInWithEmailAndPassword(email, password).then(function(result) {

          			var userEmail = result.user.email;

          			database.collection("users").where("email","==",userEmail).get().then( async function(snapshots){

          				var userData = snapshots.docs[0].data();

          				if(userData.role == "customer"){

          					var userToken = result.user.getIdToken();

          					var uid = result.user.uid;

                    		var user = userData.id;

                    		var firstName = userData.firstName;

                    		var lastName = userData.lastName;

                    		var imageURL = userData.profilePictureURL;

          					    var url = "{{route('setToken')}}";
                        /*database.collection('users').doc(uid).update({'fcmToken':currentToken}).then(function(result) {*/
                            $.ajax({

                              type:'POST',

                              url:url,

                              data:{id:uid,userId:user,email:email,password:password,firstName:firstName,lastName:lastName,profilePicture:imageURL},

                                headers: {

                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                              },

                              success:function(data){

                                if(data.access){


                                          window.location = "{{url('/')}}";

                                      }

                              }

                            /* }) */  

                            });

                        /*})
                        .then(function(token){
                            console.log(token);
                        })
                        .catch(function(err){
                            console.log('Error Occurred.' + err);
                        });*/

                              					

          				}else{



          				}

          			})



        	})

        .catch(function(error) {

          		console.log(error.message);

          		$("#password_required").html(error.message);

        	});

        return false;

    	}


function loginWithPhoneClick(){
    /*jQuery("#email-box").hide();
    jQuery("#password-box").hide();
    jQuery("#loginphon_btn").hide();*/
    jQuery("#login-box").hide();
    jQuery("#login-with-phone-box").show();
    jQuery("#phone-box").show();
    jQuery("#recaptcha-container").show();
    jQuery("#sendotp_btn").show();
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
    'size': 'invisible',
    'callback': (response) => {
        /*jQuery("#password_required_new").html(response);*/
    }
    });
}

function loginBackClick() {
    jQuery("#login-box").show();
    jQuery("#login-with-phone-box").hide();
    jQuery("#sendotp_btn").hide();
}
function sendOTP(){
  
  if(jQuery("#phone").val() && jQuery("#country_selector").val()){
    var phoneNumber='+'+jQuery("#country_selector").val()+''+jQuery("#phone").val();
    database.collection("users").where("phoneNumber","==",phoneNumber).where("role","==",'customer').get().then( async function(snapshots){
        if(snapshots.docs.length){
            var userData = snapshots.docs[0].data();
            firebase.auth().signInWithPhoneNumber(phoneNumber, window.recaptchaVerifier) 
              .then(function(confirmationResult) {
                window.confirmationResult = confirmationResult;
                if(confirmationResult.verificationId){
                    jQuery("#phone-box").hide();    
                    jQuery("#recaptcha-container").hide();
                    jQuery("#otp-box").show();
                    jQuery("#verify_btn").show();
                }
              });
        }else{
            jQuery("#password_required_new").html("User not found.");
        }
    });
  }
}
function applicationVerifier() {
    window.confirmationResult.confirm(document.getElementById("verificationcode").value)
    .then(function(result) {
        database.collection("users").doc(result.user.uid).get().then( async function(snapshots_login){
                        userData=snapshots_login.data();
                        if(userData){
                            if(userData.role == "customer"){
                                    var uid = result.user.uid;
                                    var user = result.user.uid;
                                    var firstName = userData.firstName;
                                    var lastName = userData.lastName;
                                    var imageURL = userData.profilePictureURL;
                                    var url = "{{route('setToken')}}";
                                        $.ajax({
                                          type:'POST',
                                          url:url,
                                          data:{id:uid,userId:user,email:userData.phoneNumber,password:'',firstName:firstName,lastName:lastName,profilePicture:imageURL},
                                          headers: {
                                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                          },
                                          success:function(data){
                                            if(data.access){
                                              window.location = "{{url('/')}}";
                                            }
                                          }
                                        });             
                            }else{
                                jQuery("#password_required_new").html("User not found.");
                            }
                        }
                    })
              }).catch(function(error) {
                jQuery("#password_required_new").html(error.message);
              });
}

var newcountriesjs='<?php echo json_encode($newcountriesjs); ?>';
var newcountriesjs=JSON.parse(newcountriesjs);
function formatState (state) {
      
      if (!state.id) {
        return state.text;
      }
      var baseUrl ="<?php echo URL::to('/');?>/flags/120/";
      var $state = $(
        '<span><img src="' + baseUrl + '/' + newcountriesjs[state.element.value].toLowerCase() + '.png" class="img-flag" /> ' + state.text + '</span>'
      );
      return $state;
 }

function formatState2 (state) {
  if (!state.id) {
    return state.text;
  }

  var baseUrl ="<?php echo URL::to('/');?>/flags/120/"
  var $state = $(
    '<span><img class="img-flag" /> <span></span></span>'
  );
  $state.find("span").text(state.text);
  $state.find("img").attr("src", baseUrl + "/" + newcountriesjs[state.element.value].toLowerCase() + ".png");

  return $state;
}

jQuery( document ).ready(function() {

    jQuery("#country_selector").select2({
          templateResult: formatState,
          templateSelection: formatState2,
          placeholder: "Select Country",
          allowClear: true
    });
    
});

</script>