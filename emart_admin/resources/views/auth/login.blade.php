<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->

    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/plugins/toast-master/css/jquery.toast.css')}}" rel="stylesheet">

    <link href="{{ asset('css/colors/blue.css') }}" rel="stylesheet">

    @yield('style')

</head>

<body>


<style type="text/css">
	.form-group.default-admin{padding: 10px;font-size: 14px;color: #000;font-weight: 600;border-radius: 10px;box-shadow: 0 0px 6px 0px rgba(0,0,0,0.5);margin: 20px 10px 10px 10px;}
	.form-group.default-admin .crediantials-field{position: relative;padding-right: 15px;text-align: left;padding-top: 5px; padding-bottom: 5px;}
	.form-group.default-admin .crediantials-field > a{position: absolute;right: 0;top: 0;bottom: 0;margin: auto;height: 20px;}
	.login-register{background-color:#FF683A;}

<?php if(isset($_COOKIE['admin_panel_color'])){ ?>
	a,a:hover, a:focus{color:<?php echo $_COOKIE['admin_panel_color']; ?>;}
	.btn-primary, .btn-primary.disabled,.btn-primary:hover, .btn-primary.disabled:hover{background: <?php echo $_COOKIE['admin_panel_color']; ?>;border: 1px solid <?php echo $_COOKIE['admin_panel_color']; ?>;}
	[type="checkbox"]:checked + label::before{border-right: 2px solid <?php echo $_COOKIE['admin_panel_color']; ?>;border-bottom: 2px solid <?php echo $_COOKIE['admin_panel_color']; ?>;}
	.form-material .form-control, .form-material .form-control.focus, .form-material .form-control:focus{background-image: linear-gradient(<?php echo $_COOKIE['admin_panel_color']; ?>, <?php echo $_COOKIE['admin_panel_color']; ?>), linear-gradient(rgba(120, 130, 140, 0.13), rgba(120, 130, 140, 0.13));}
	.btn-primary.active, .btn-primary:active, .btn-primary:focus, .btn-primary.disabled.active, .btn-primary.disabled:active, .btn-primary.disabled:focus, .btn-primary.active.focus, .btn-primary.active:focus, .btn-primary.active:hover, .btn-primary.focus:active, .btn-primary:active:focus, .btn-primary:active:hover, .open > .dropdown-toggle.btn-primary.focus, .open > .dropdown-toggle.btn-primary:focus, .open > .dropdown-toggle.btn-primary:hover, .btn-primary.focus, .btn-primary:focus, .btn-primary:not(:disabled):not(.disabled).active:focus, .btn-primary:not(:disabled):not(.disabled):active:focus, .show > .btn-primary.dropdown-toggle:focus{background: <?php echo $_COOKIE['admin_panel_color']; ?>;
	border-color: <?php echo $_COOKIE['admin_panel_color']; ?>;box-shadow: 0 0 0 0.2rem <?php echo $_COOKIE['admin_panel_color']; ?>;}
	.login-register{background-color:<?php echo $_COOKIE['admin_panel_color']; ?>;}
<?php } ?>

</style>

<section id="wrapper">


<div class="login-register">
 

 <div class="login-logo text-center py-3">

           <a href="#" style="display: inline-block;background: #fff;padding: 10px;border-radius: 5px;"><img src="{{ asset('images/logo_web.png') }}"> </a>

        </div>

<div class="login-box card" style="margin-bottom:0%;">

        

        <!-- <div class="row justify-content-center">



            <div class="col-md-8">

                <div class="card"> -->

                    



                    <div class="card-body">

                        <form class="form-horizontal form-material" method="POST" action="{{ route('login') }}">

                            @csrf

                            <div class="box-title m-b-20">{{ __('Login') }}</div>





                                <div class="form-group ">



                                    <div class="col-xs-12">



                                        <input class="form-control" placeholder="{{ __('Email Address') }}"  id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> </div>



                                        @error('email')

                                        <span class="invalid-feedback" role="alert">

                                            <strong>{{ $message }}</strong>

                                        </span>

                                        @enderror



                                </div>



                                <div class="form-group">



                                    <div class="col-xs-12">



                                        <input id="password" placeholder="{{ __('Password') }}" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"> </div>



                                        @error('password')

                                            <span class="invalid-feedback" role="alert">

                                                <strong>{{ $message }}</strong>

                                            </span>

                                        @enderror



                                </div>



                                <div class="form-group text-center m-t-20">



                                    <div class="col-xs-12">



                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>



                                        <label class="form-check-label" for="remember">

                                            {{ __('Remember Me') }}

                                        </label>



                                    </div>



                                </div>



                                <div class="form-group text-center m-t-20 mb-0">



                                    <div class="col-xs-12">



                                        <button type="submit" class="btn btn-dark btn-lg btn-block text-uppercase waves-effect waves-light btn btn-primary">

                                        {{ __('Login') }}

                                         </button>



                                          <?php /*@if (Route::has('password.request'))

                                            <a class="btn btn-link" href="{{ route('password.request') }}">

                                                {{ __('Forgot Your Password?') }}

                                            </a>

                                         @endif*/ ?>

                                    </div>



                                </div>





                            <?php /*<div class="row mb-3">

                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>



                                <div class="col-md-6">

                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>



                                    @error('email')

                                        <span class="invalid-feedback" role="alert">

                                            <strong>{{ $message }}</strong>

                                        </span>

                                    @enderror

                                </div>

                            </div>



                            <div class="row mb-3">

                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>



                                <div class="col-md-6">

                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">



                                    @error('password')

                                        <span class="invalid-feedback" role="alert">

                                            <strong>{{ $message }}</strong>

                                        </span>

                                    @enderror

                                </div>

                            </div>



                            <div class="row mb-3">

                                <div class="col-md-6 offset-md-4">

                                    <div class="form-check">

                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>



                                        <label class="form-check-label" for="remember">

                                            {{ __('Remember Me') }}

                                        </label>

                                    </div>

                                </div>

                            </div>



                            <div class="row mb-0">

                                <div class="col-md-8 offset-md-4">

                                    <button type="submit" class="btn btn-primary">

                                        {{ __('Login') }}

                                    </button>



                                    @if (Route::has('password.request'))

                                        <a class="btn btn-link" href="{{ route('password.request') }}">

                                            {{ __('Forgot Your Password?') }}

                                        </a>

                                    @endif

                                </div>

                            </div> */?>

                        </form>

                    </div>

                <!-- </div>

            </div>

        </div> -->

</div>

</div>

</section>

<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>

<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>

<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('js/jquery.slimscroll.js') }}"></script>

<script src="{{ asset('js/waves.js') }}"></script>

<script src="{{ asset('js/sidebarmenu.js') }}"></script>

<script src="{{ asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>

<script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>

<script src="{{ asset('js/custom.min.js') }}"></script>

<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-storage.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-database.js"></script>
{{--    <script src="https://unpkg.com/geofirestore/dist/geofirestore.js"></script>--}}
    <script src="https://unpkg.com/geofirestore@5.2.0/dist/geofirestore.js"></script>
    <script src="https://cdn.firebase.com/libs/geofire/5.0.1/geofire.min.js"></script>
    <script src="{{ asset('js/chosen.jquery.js') }}"></script>
	<script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>
    <script type="text/javascript">@include('vendor.notifications.init_firebase')</script>
    <script type="text/javascript">
    function copyToClipboard(text) {
           const elem = document.createElement('textarea');
           elem.value = text;
           document.body.appendChild(elem);
           elem.select();
           document.execCommand('copy');
           document.body.removeChild(elem);
    }
    var database = firebase.firestore();
    var ref = database.collection('settings').doc("globalSettings");
    $(document).ready(function () {
            ref.get().then(async function (snapshots) {
                var globalSettings = snapshots.data();
                console.log(globalSettings);
                admin_panel_color = globalSettings.admin_panel_color;
                setCookie('admin_panel_color', admin_panel_color, 365);
                $('.login-register').css({'background-color':admin_panel_color});
            })
            
            });
            function setCookie(cname, cvalue, exdays) {
            const d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            let expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }
</script>


</body>

</html>