@include('layouts.app')
@include('layouts.header')
<div class="siddhi-profile">
    <div class="d-none">
        <div class="bg-primary border-bottom p-3 d-flex align-items-center">
            <a class="toggle togglew toggle-2" href="#"><span></span></a>
            <h4 class="font-weight-bold m-0 text-white">{{trans('lang.user_profile')}}</h4>
        </div>
    </div>
    <div class="container position-relative">
        <div class="py-5 siddhi-profile row">

            <div class="col-md-12">
                <div class="contac-fotm-wrap">
                    <div class="siddhi-cart-item-profile bg-white rounded shadow-sm p-4 contct-form">
                        @if(session()->has('success_contact'))
                        <div class="alert alert-success">
                            {{ session()->get('success_contact') }}
                        </div>
                        @endif
                        <div class="flex-column">
                            <div class="form-title">
                                <h4 class="font-weight-bold mb-3 text-center">{{trans('lang.tell_us_about_yourself')}}</h4>
                            </div>
                            <!-- <p class="text-muted">Whether you have questions or you would just like to say hello, contact us.</p> -->
                            <form action="{{url('sendemail/send')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" class="small font-weight-bold">{{trans('lang.your_name')}}</label>
                                    <input type="text" class="form-control user_name_form" id="exampleFormControlInput1" value="" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput2" class="small font-weight-bold">{{trans('lang.email_address')}}</label>
                                    <input type="email" class="form-control user_email_form" id="exampleFormControlInput2" value=""  name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput3" class="small font-weight-bold">{{trans('lang.phone_number')}}</label>
                                    <input type="number" class="form-control user_phone_form" id="exampleFormControlInput3" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1" class="small font-weight-bold">{{trans('lang.how_can_we_help_you')}}</label>
                                    <textarea class="form-control user_comment_form" id="exampleFormControlTextarea1" placeholder="Hi there, I would like to ..." rows="3" name="message" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" href="#">{{trans('lang.submit')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            

        </div>
    </div>
   <div class="contact-map">
                <div class="siddhi-cart-item-profile bg-white p-0">
                    <div class="mapouter pt-0">
                        <div class="gmap_canvas">
                            <iframe width="100%" height="450" id="gmap_canvas" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6084.772831870492!2d72.52684476258722!3d23.073179147007263!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e8349581307df%3A0x85dda8269e834d5!2sSiddhi%20Infosoft!5e0!3m2!1sen!2sin!4v1648036249302!5m2!1sen!2sin" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                        </div>
                    </div>
                   
                </div>
            </div>

    @include('layouts.footer')
    @include('layouts.nav')
    <!-- <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script type="3d9fa72af2be5f5f8c3d5a7d-text/javascript" src="vendor/jquery/jquery.min.js"></script>
    <script type="3d9fa72af2be5f5f8c3d5a7d-text/javascript" src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="3d9fa72af2be5f5f8c3d5a7d-text/javascript" src="vendor/slick/slick.min.js"></script>
    <script type="3d9fa72af2be5f5f8c3d5a7d-text/javascript" src="vendor/sidebar/hc-offcanvas-nav.js"></script>
    <script type="3d9fa72af2be5f5f8c3d5a7d-text/javascript" src="js/siddhi.js"></script>
    <script src="js/rocket-loader.min.js" data-cf-settings="3d9fa72af2be5f5f8c3d5a7d-|49" defer=""></script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194" integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw==" data-cf-beacon='{"rayId":"6c83f3779a1873c7","version":"2021.12.0","r":1,"token":"dd471ab1978346bbb991feaa79e6ce5c","si":100}' crossorigin="anonymous"></script> -->
    <script type="text/javascript">
    
    //var ref= database.collection('users').where('id','==',user_uuid);
        
    var currentCurrency ='';
    var currencyAtRight = false;
    var placeholderImage = '';
    var refCurrency = database.collection('currencies').where('isActive', '==' , true);
    refCurrency.get().then( async function(snapshots){
    var currencyData = snapshots.docs[0].data();
    currentCurrency = currencyData.symbol;
    currencyAtRight = currencyData.symbolAtRight;
    });
    var placeholder = database.collection('settings').doc('placeHolderImage');
    placeholder.get().then( async function(snapshotsimage){
    var placeholderImageData = snapshotsimage.data();
        placeholderImage = placeholderImageData.image;
    })
    $(document).ready(function() {
        database.collection('users').where("id","==",user_uuid).get().then(
        (usersnapshot) => {
            var user = usersnapshot.docs[0].data();
            var userName = user.firstName+" "+user.lastName;
            if(user.profilePictureURL != ''){
                    $(".user_image").attr("src", user.profilePictureURL);
            }else{
                $(".user_image").attr("src", placeholderImage);
            }
            
            $(".user_name_main").text(userName);
            $(".user_name_form").attr("value",userName);
            $(".user_email_form").attr("value",user.email);
            $(".user_phone_form").attr("value",user.phoneNumber);
            
        jQuery("#total_payment").empty();
        });
        $("#data-table_processing").show();
    })
    </script>