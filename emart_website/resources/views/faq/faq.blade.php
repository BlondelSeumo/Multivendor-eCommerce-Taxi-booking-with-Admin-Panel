<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from askbootstrap.com/preview/swiggiweb/faq.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 04 Jan 2022 10:58:46 GMT -->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Askbootstrap">
<meta name="author" content="Askbootstrap">
<link rel="icon" type="image/png" href="img/fav.png">
 <title>{{trans('lang.swiggiweb_online_item_ordering_template')}}</title>

<link rel="stylesheet" type="text/css" href="vendor/slick/slick.min.css" />
<link rel="stylesheet" type="text/css" href="vendor/slick/slick-theme.min.css" />

<link href="vendor/icons/feather.css" rel="stylesheet" type="text/css">

<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<link href="css/style.css" rel="stylesheet">

<link href="vendor/sidebar/demo.css" rel="stylesheet">
</head>
<body class="fixed-bottom-bar">
<header class="section-header">
<section class="header-main shadow-sm bg-white">
<div class="container">
<div class="row align-items-center">
<div class="col-1">
<a href="home.html" class="brand-wrap mb-0">
<img alt="#" class="img-fluid" src="img/logo_web.png">
</a>

</div>
<div class="col-3 d-flex align-items-center m-none">
<div class="dropdown mr-3">
<a class="text-dark dropdown-toggle d-flex align-items-center py-3" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<div><i class="feather-map-pin mr-2 bg-light rounded-pill p-2 icofont-size"></i></div>
<div>
 <p class="text-muted mb-0 small">{{trans('lang.select_location')}}</p>
Jawaddi Ludhiana...
</div>
</a>
<div class="dropdown-menu p-0 drop-loc" aria-labelledby="navbarDropdown">
<div class="osahan-country">
<div class="search_location bg-primary p-3 text-right">
<div class="input-group rounded shadow-sm overflow-hidden">
<div class="input-group-prepend">
<button class="border-0 btn btn-outline-secondary text-dark bg-white btn-block"><i class="feather-search"></i></button>
</div>
<input type="text" class="shadow-none border-0 form-control" placeholder="Enter Your Location">
</div>
</div>
<div class="p-3 border-bottom">
<a href="home.html" class="text-decoration-none">
<p class="font-weight-bold text-primary m-0"><i class="feather-navigation"></i> New York, USA</p>
</a>
</div>
<div class="filter">
 <h6 class="px-3 py-3 bg-light pb-1 m-0 border-bottom">{{trans('lang.choose_your_country')}}</h6>
<div class="custom-control  border-bottom px-0 custom-radio">
<input type="radio" id="customRadio1" name="location" class="custom-control-input">
<label class="custom-control-label py-3 w-100 px-3" for="customRadio1">Afghanistan</label>
 </div>
<div class="custom-control  border-bottom px-0 custom-radio">
<input type="radio" id="customRadio2" name="location" class="custom-control-input" checked="">
<label class="custom-control-label py-3 w-100 px-3" for="customRadio2">India</label>
</div>
<div class="custom-control  border-bottom px-0 custom-radio">
<input type="radio" id="customRadio3" name="location" class="custom-control-input">
<label class="custom-control-label py-3 w-100 px-3" for="customRadio3">USA</label>
</div>
<div class="custom-control  border-bottom px-0 custom-radio">
<input type="radio" id="customRadio4" name="location" class="custom-control-input">
<label class="custom-control-label py-3 w-100 px-3" for="customRadio4">Australia</label>
</div>
<div class="custom-control  border-bottom px-0 custom-radio">
<input type="radio" id="customRadio5" name="location" class="custom-control-input">
<label class="custom-control-label py-3 w-100 px-3" for="customRadio5">Japan</label>
</div>
<div class="custom-control  px-0 custom-radio">
<input type="radio" id="customRadio6" name="location" class="custom-control-input">
<label class="custom-control-label py-3 w-100 px-3" for="customRadio6">China</label>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="col-8">
<div class="d-flex align-items-center justify-content-end pr-5">

 <a href="search.html" class="widget-header mr-4 text-dark">
  <div class="icon d-flex align-items-center">
   <i class="feather-search h6 mr-2 mb-0"></i> <span>{{trans('lang.search')}}</span>
  </div>
 </a>

 <a href="offers.html" class="widget-header mr-4 text-white btn bg-primary m-none">
  <div class="icon d-flex align-items-center">
   <i class="feather-disc h6 mr-2 mb-0"></i> <span>{{trans('lang.offers')}}</span>
  </div>
 </a>

 <a href="login.html" class="widget-header mr-4 text-dark m-none">
  <div class="icon d-flex align-items-center">
   <i class="feather-user h6 mr-2 mb-0"></i> <span>{{trans('lang.sign_in')}}</span>
  </div>
 </a>

<div class="dropdown mr-4 m-none">
<a href="#" class="dropdown-toggle text-dark py-3 d-block" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<img alt="#" src="img/user/1.jpg" class="img-fluid rounded-circle header-user mr-2 header-user"> Hi Osahan
</a>
 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
  <a class="dropdown-item" href="profile.html">{{trans('lang.my_account')}}</a>
  <a class="dropdown-item" href="{{ route('faq') }}">{{trans('lang.delivery_support')}}</a>
  <a class="dropdown-item" href="{{url('contact_us')}}">{{trans('lang.contact_us')}}</a>
  <a class="dropdown-item" href="{{ route('terms') }}">{{trans('lang.terms_use')}}</a>
  <a class="dropdown-item" href="{{ route('privacy') }}">{{trans('lang.privacy_policy')}}</a>
  <a class="dropdown-item" href="login.html">{{trans('lang.logout')}}</a>
</div>
</div>

<a href="checkout.html" class="widget-header mr-4 text-dark">
<div class="icon d-flex align-items-center">
 <i class="feather-shopping-cart h6 mr-2 mb-0"></i> <span>{{trans('lang.cart')}}</span>
</div>
</a>
<a class="toggle" href="#">
<span></span>
</a>
</div>

</div>

</div>

</div>

</section>

</header>
<div class="osahan-profile ">
<div class="d-none">
<div class="bg-primary border-bottom p-3 d-flex align-items-center">
<a class="toggle togglew toggle-2" href="#"><span></span></a>
 <h4 class="font-weight-bold m-0 text-white">{{trans('lang.user_profile')}}</h4>
</div>
</div>

<div class="container position-relative">
<div class="py-5 osahan-profile row">
<div class="col-md-4 mb-3">
<div class="bg-white rounded shadow-sm sticky_sidebar overflow-hidden">
<a href="profile.html" class="">
<div class="d-flex align-items-center p-3">
<div class="left mr-3">
<img alt="#" src="img/user1.jpg" class="rounded-circle">
</div>
<div class="right">
<h6 class="mb-1 font-weight-bold">Gurdeep Singh <i class="feather-check-circle text-success"></i></h6>
<p class="text-muted m-0 small"><span class="__cf_email__" data-cfemail="a4cdc5c9cbd7c5ccc5cae4c3c9c5cdc88ac7cbc9">[email&#160;protected]</span></p>
</div>
</div>
</a>
<div class="osahan-credits d-flex align-items-center p-3 bg-light">
 <p class="m-0">{{trans('lang.accounts_credits')}}</p>
<h5 class="m-0 ml-auto text-primary">$52.25</h5>
</div>

 <div class="bg-white profile-details">
  <a data-toggle="modal" data-target="#paycard" class="d-flex w-100 align-items-center border-bottom p-3">
   <div class="left mr-3">
    <h6 class="font-weight-bold mb-1 text-dark">{{trans('lang.payment_cards')}}</h6>
    <p class="small text-muted m-0">{{trans('lang.add_credit_debit_card')}}</p>
   </div>
   <div class="right ml-auto">
    <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
   </div>
  </a>
  <a data-toggle="modal" data-target="#exampleModal" class="d-flex w-100 align-items-center border-bottom p-3">
   <div class="left mr-3">
    <h6 class="font-weight-bold mb-1 text-dark">{{trans('lang.user_address')}}</h6>
    <p class="small text-muted m-0">{{trans('lang.add_remove_delivery_address')}}</p>
   </div>
   <div class="right ml-auto">
    <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
   </div>
  </a>
  <a class="d-flex align-items-center border-bottom p-3" data-toggle="modal" data-target="#inviteModal">
   <div class="left mr-3">
    <h6 class="font-weight-bold mb-1">{{trans('lang.refer_friends')}}</h6>
    <p class="small text-primary m-0">Get $10.00 FREE</p>
   </div>
   <div class="right ml-auto">
    <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
   </div>
  </a>
  <a href="{{ route('faq') }}" class="d-flex w-100 align-items-center border-bottom px-3 py-4">
   <div class="left mr-3">
    <h6 class="font-weight-bold m-0 text-dark"><i class="feather-truck bg-danger text-white p-2 rounded-circle mr-2"></i>
     {{trans('lang.delivery_support')}}</h6>
   </div>
   <div class="right ml-auto">
    <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
   </div>
  </a>
  <a href="{{url('contact_us')}}" class="d-flex w-100 align-items-center border-bottom px-3 py-4">
   <div class="left mr-3">
    <h6 class="font-weight-bold m-0 text-dark"><i class="feather-phone bg-primary text-white p-2 rounded-circle mr-2"></i> Contact</h6>
   </div>
   <div class="right ml-auto">
    <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
   </div>
  </a>
  <a href="{{ route('terms') }}" class="d-flex w-100 align-items-center border-bottom px-3 py-4">
   <div class="left mr-3">
    <h6 class="font-weight-bold m-0 text-dark"><i class="feather-info bg-success text-white p-2 rounded-circle mr-2"></i>
     {{trans('lang.terms_use')}}</h6>
   </div>
   <div class="right ml-auto">
    <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
   </div>
  </a>
  <a href="{{ route('privacy') }}" class="d-flex w-100 align-items-center px-3 py-4">
   <div class="left mr-3">
    <h6 class="font-weight-bold m-0 text-dark"><i class="feather-lock bg-warning text-white p-2 rounded-circle mr-2"></i>
     {{trans('lang.privacy_policy')}}</h6>
   </div>
   <div class="right ml-auto">
    <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
   </div>
  </a>
 </div>
</div>
</div>

 <div class="col-md-8 mb-3">
  <div class="osahan-cart-item-profile">
   <div class="box bg-white mb-3 shadow-sm rounded">
    <div class="p-3 d-flex align-items-center">
     <i class="feather-message-circle display-4"></i>
     <div class="ml-3">
      <h6 class="text-dark mb-2 mt-0">{{tans('lang.help_forum')}}</h6>
      <p class="mb-0 text-muted">{{trans('lang.find_answer_to_question')}}
      </p>
     </div>
    </div>
    <div class="overflow-hidden border-top d-flex align-items-center p-3">
     <a class="font-weight-bold d-block" href="#"> {{tans('lang.help_forum')}} </a>
     <i class="feather-arrow-right-circle ml-auto text-primary"></i>
    </div>
   </div>
   <div class="box bg-white mb-3 shadow-sm rounded">
    <div class="p-3 d-flex align-items-center">
     <i class="feather-lock display-4"></i>
     <div class="ml-3">
      <h6 class="text-dark mb-2 mt-0">{{trans('lang.safety_center')}}</h6>
      <p class="mb-0 text-muted">{{trans('lang.want_learn_setting_managing')}}
      </p>
     </div>
    </div>
    <div class="overflow-hidden border-top d-flex align-items-center p-3">
     <a class="font-weight-bold d-block" href="#"> {{trans('lang.swiggiweb_safety_center')}} </a>
     <i class="feather-arrow-right-circle ml-auto text-primary"></i>
    </div>
   </div>
   <div id="basics">

    <div class="mb-2 mt-3">
     <h5 class="font-weight-semi-bold mb-0">{{trans('lang.basics')}}</h5>
    </div>


    <div id="basicsAccordion">

     <div class="box border-bottom bg-white mb-2 rounded shadow-sm overflow-hidden">
      <div id="basicsHeadingOne">
       <h5 class="mb-0">
        <button class="shadow-none btn btn-block d-flex justify-content-between card-btn p-3 collapsed" data-toggle="collapse" data-target="#basicsCollapseOne" aria-expanded="false" aria-controls="basicsCollapseOne">
         {{trans('lang.do_you_have_any_built_in_caching')}}
         <span class="card-btn-arrow">
<span class="feather-chevron-down"></span>
</span>
        </button>
       </h5>
      </div>
      <div id="basicsCollapseOne" class="collapse show" aria-labelledby="basicsHeadingOne" data-parent="#basicsAccordion" style="">
       <div class="card-body border-top p-3 text-muted">
        {{trans('lang.anim_pariatur_message')}}
       </div>
      </div>
     </div>
     <div class="box border-bottom bg-white mb-2 rounded shadow-sm overflow-hidden">
      <div id="basicsHeadingTwo">
       <h5 class="mb-0">
        <button class="shadow-none btn btn-block d-flex justify-content-between card-btn p-3 collapsed" data-toggle="collapse" data-target="#basicsCollapseTwo" aria-expanded="false" aria-controls="basicsCollapseTwo">
         {{trans('lang.add_upgrade_plan')}}
         <span class="card-btn-arrow">
<span class="feather-chevron-down"></span>
</span>
        </button>
       </h5>
      </div>
      <div id="basicsCollapseTwo" class="collapse" aria-labelledby="basicsHeadingTwo" data-parent="#basicsAccordion" style="">
       <div class="card-body border-top p-3 text-muted">
        {{trans('lang.anim_pariatur_message')}}
       </div>
      </div>
     </div>
     <div class="box border-bottom bg-white mb-2 rounded shadow-sm overflow-hidden">
      <div id="basicsHeadingThree">
       <h5 class="mb-0">
        <button class="shadow-none btn btn-block d-flex justify-content-between card-btn p-3 collapsed" data-toggle="collapse" data-target="#basicsCollapseThree" aria-expanded="false" aria-controls="basicsCollapseThree">

         {{trans('lang.access_comes_plan')}}
         <span class="card-btn-arrow">
<span class="feather-chevron-down"></span>
</span>
        </button>
       </h5>
      </div>
      <div id="basicsCollapseThree" class="collapse" aria-labelledby="basicsHeadingThree" data-parent="#basicsAccordion" style="">
       <div class="card-body border-top p-3 text-muted">
        {{trans('lang.anim_pariatur_message')}}
       </div>
      </div>
     </div>
     <div class="box border-bottom bg-white mb-2 rounded shadow-sm overflow-hidden">
      <div id="basicsHeadingFour">
       <h5 class="mb-0">
        <button class="shadow-none btn btn-block d-flex justify-content-between card-btn collapsed p-3" data-toggle="collapse" data-target="#basicsCollapseFour" aria-expanded="false" aria-controls="basicsCollapseFour">

         {{trans('lang.change_my_password')}}
         <span class="card-btn-arrow">
<span class="feather-chevron-down"></span>
</span>
        </button>
       </h5>
      </div>
      <div id="basicsCollapseFour" class="collapse" aria-labelledby="basicsHeadingFour" data-parent="#basicsAccordion">
       <div class="card-body border-top p-3 text-muted">
        {{trans('lang.anim_pariatur_message')}}
       </div>
      </div>
     </div>

    </div>

   </div>
   <div id="account">

    <div class="mb-2 mt-3">
     <h5 class="font-weight-semi-bold mb-0"> {{trans('lang.account')}}</h5>
    </div>


    <div id="accountAccordion">

     <div class="box border-bottom bg-white mb-2 rounded shadow-sm overflow-hidden">
      <div id="accountHeadingOne">
       <h5 class="mb-0">
        <button class="shadow-none btn btn-block d-flex justify-content-between card-btn p-3" data-toggle="collapse" data-target="#accountCollapseOne" aria-expanded="false" aria-controls="accountCollapseOne">

         {{trans('lang.change_my_password')}}
         <span class="card-btn-arrow">
<span class="feather-chevron-down"></span>
</span>
        </button>
       </h5>
      </div>
      <div id="accountCollapseOne" class="collapse show" aria-labelledby="accountHeadingOne" data-parent="#accountAccordion">
       <div class="card-body border-top p-3 text-muted">
        {{trans('lang.anim_pariatur_message')}}
       </div>
      </div>
     </div>


     <div class="box border-bottom bg-white mb-2 rounded shadow-sm overflow-hidden">
      <div id="accountHeadingTwo">
       <h5 class="mb-0">
        <button class="shadow-none btn btn-block d-flex justify-content-between card-btn collapsed p-3" data-toggle="collapse" data-target="#accountCollapseTwo" aria-expanded="false" aria-controls="accountCollapseTwo">
         {{trans('lang.delete_account')}}

         <span class="card-btn-arrow">
<span class="feather-chevron-down"></span>
</span>
        </button>
       </h5>
      </div>
      <div id="accountCollapseTwo" class="collapse" aria-labelledby="accountHeadingTwo" data-parent="#accountAccordion">
       <div class="card-body border-top p-3 text-muted">
        {{trans('lang.anim_pariatur_message')}}
       </div>
      </div>
     </div>


     <div class="box border-bottom bg-white mb-2 rounded shadow-sm overflow-hidden">
      <div id="accountHeadingThree">
       <h5 class="mb-0">
        <button class="shadow-none btn btn-block d-flex justify-content-between card-btn collapsed p-3" data-toggle="collapse" data-target="#accountCollapseThree" aria-expanded="false" aria-controls="accountCollapseThree">

         {{trans('lang.change_account_setting')}}
         <span class="card-btn-arrow">
<span class="feather-chevron-down"></span>
</span>
        </button>
       </h5>
      </div>
      <div id="accountCollapseThree" class="collapse" aria-labelledby="accountHeadingThree" data-parent="#accountAccordion">
       <div class="card-body border-top p-3 text-muted">
        {{trans('lang.anim_pariatur_message')}}
       </div>
      </div>
     </div>


     <div class="box border-bottom bg-white mb-2 rounded shadow-sm overflow-hidden">
      <div id="accountHeadingFour">
       <h5 class="mb-0">
        <button class="shadow-none btn btn-block d-flex justify-content-between card-btn collapsed p-3" data-toggle="collapse" data-target="#accountCollapseFour" aria-expanded="false" aria-controls="accountCollapseFour">

         {{trans('lang.forgot_password_reset_it')}}
         <span class="card-btn-arrow">
<span class="feather-chevron-down"></span>
</span>
        </button>
       </h5>
      </div>
      <div id="accountCollapseFour" class="collapse" aria-labelledby="accountHeadingFour" data-parent="#accountAccordion">
       <div class="card-body border-top p-3 text-muted">
        {{trans('lang.anim_pariatur_message')}}
       </div>
      </div>
     </div>

    </div>

   </div>
  </div>
 </div>
</div>
</div>

 <div class="osahan-menu-fotter fixed-bottom bg-white px-3 py-2 text-center d-none">
  <div class="row">
   <div class="col">
    <a href="home.html" class="text-dark small font-weight-bold text-decoration-none">
     <p class="h4 m-0"><i class="feather-home text-dark"></i></p>
     {{trans('lang.home')}}
    </a>
   </div>
   <div class="col">
    <a href="most_popular.html" class="text-dark small font-weight-bold text-decoration-none">
     <p class="h4 m-0"><i class="feather-map-pin"></i></p>
     {{trans('lang.trending')}}

    </a>
   </div>
   <div class="col bg-white rounded-circle mt-n4 px-3 py-2">
    <div class="bg-danger rounded-circle mt-n0 shadow">
     <a href="checkout.html" class="text-white small font-weight-bold text-decoration-none">
      <i class="feather-shopping-cart"></i>
     </a>
    </div>
   </div>
   <div class="col">
    <a href="favorites.html" class="text-dark small font-weight-bold text-decoration-none">
     <p class="h4 m-0"><i class="feather-heart"></i></p>

     {{trans('lang.favorites')}}
    </a>
   </div>
   <div class="col selected">
    <a href="profile.html" class="text-danger small font-weight-bold text-decoration-none">
     <p class="h4 m-0"><i class="feather-user"></i></p>
     {{trans('lang.profile')}}
    </a>
   </div>
  </div>
 </div>
</div>

<footer class="section-footer border-top bg-dark">
 <div class="container">
  <section class="footer-top padding-y py-5">
   <div class="row pt-3">
    <aside class="col-md-4 footer-about">
     <article class="d-flex pb-3">
      <div><img alt="#" src="img/logo_web.png" class="logo-footer mr-3"></div>
      <div>
       <h6 class="title text-white">{{trans('lang.about_us')}}</h6>
       <p class="text-muted">Some short text about company like You might remember the Dell computer commercials in which a youth reports.</p>
       <div class="d-flex align-items-center">
        <a class="btn btn-icon btn-outline-light mr-1 btn-sm" title="Facebook" target="_blank" href="#"><i class="feather-facebook"></i></a>
        <a class="btn btn-icon btn-outline-light mr-1 btn-sm" title="Instagram" target="_blank" href="#"><i class="feather-instagram"></i></a>
        <a class="btn btn-icon btn-outline-light mr-1 btn-sm" title="Youtube" target="_blank" href="#"><i class="feather-youtube"></i></a>
        <a class="btn btn-icon btn-outline-light mr-1 btn-sm" title="Twitter" target="_blank" href="#"><i class="feather-twitter"></i></a>
       </div>
      </div>
     </article>
    </aside>
    <aside class="col-sm-3 col-md-2 text-white">
     <h6 class="title">{{trans('lang.error_pages')}}</h6>
     <ul class="list-unstyled hov_footer">
      <li> <a href="not-found.html" class="text-muted">{{trans('lang.not_found')}}</a></li>
      <li> <a href="maintence.html" class="text-muted">{{trans('lang.maintence')}} </a></li>
      <li> <a href="coming-soon.html" class="text-muted">{{trans('lang.coming_soon')}}</a></li>
     </ul>
    </aside>
    <aside class="col-sm-3 col-md-2 text-white">
     <h6 class="title">{{trans('lang.services')}}  </h6>
     <ul class="list-unstyled hov_footer">
      <li> <a href="{{ route('faq') }}" class="text-muted">{{trans('lang.delivery_support')}} </a></li>
      <li> <a href="{{url('contact_us')}}" class="text-muted">{{trans('lang.contact_us')}}</a></li>
      <li> <a href="{{ route('terms') }}" class="text-muted">{{trans('lang.terms_use')}} </a></li>
      <li> <a href="{{ route('privacy') }}" class="text-muted">{{trans('lang.privacy_policy')}}</a></li>
     </ul>
    </aside>
    <aside class="col-sm-3  col-md-2 text-white">
     <h6 class="title">For users</h6>
     <ul class="list-unstyled hov_footer">
      <li> <a href="login.html" class="text-muted"> User {{trans('lang.login')}} </a></li>
      <li> <a href="signup.html" class="text-muted"> User {{trans('lang.register')}}  </a></li>
      <li> <a href="forgot_password.html" class="text-muted"> {{trans('lang.forgot_password')}}  </a></li>
      <li> <a href="profile.html" class="text-muted"> {{trans('lang.account_setting')}} </a></li>
     </ul>
    </aside>
    <aside class="col-sm-3  col-md-2 text-white">
     <h6 class="title">{{trans('lang.more_pages')}} </h6>
     <ul class="list-unstyled hov_footer">
      <li> <a href="trending.html" class="text-muted"> {{trans('lang.trending')}} </a></li>
      <li> <a href="most_popular.html" class="text-muted">{{trans('lang.most_popular')}} </a></li>
      <li> <a href="vendor.html" class="text-muted"> {{trans('lang.store_details')}}   </a></li>
      <li> <a href="favorites.html" class="text-muted">{{trans('lang.favorites')}}  </a></li>
     </ul>
    </aside>
   </div>

  </section>

  <section class="footer-center border-top padding-y py-5">
   <h6 class="title text-white">{{trans('lang.countries')}}</h6>
   <div class="row">
    <aside class="col-sm-2 col-md-2 text-white">
     <ul class="list-unstyled hov_footer">
      <li> <a href="#" class="text-muted">India</a></li>
      <li> <a href="#" class="text-muted">Indonesia</a></li>
      <li> <a href="#" class="text-muted">Ireland</a></li>
      <li> <a href="#" class="text-muted">Italy</a></li>
      <li> <a href="#" class="text-muted">Lebanon</a></li>
     </ul>
    </aside>
    <aside class="col-sm-2 col-md-2 text-white">
     <ul class="list-unstyled hov_footer">
      <li> <a href="#" class="text-muted">Malaysia</a></li>
      <li> <a href="#" class="text-muted">New Zealand</a></li>
      <li> <a href="#" class="text-muted">Philippines</a></li>
      <li> <a href="#" class="text-muted">Poland</a></li>
      <li> <a href="#" class="text-muted">Portugal</a></li>
     </ul>
    </aside>
    <aside class="col-sm-2 col-md-2 text-white">
     <ul class="list-unstyled hov_footer">
      <li> <a href="#" class="text-muted">Australia</a></li>
      <li> <a href="#" class="text-muted">Brasil</a></li>
      <li> <a href="#" class="text-muted">Canada</a></li>
      <li> <a href="#" class="text-muted">Chile</a></li>
      <li> <a href="#" class="text-muted">Czech Republic</a></li>
     </ul>
    </aside>
    <aside class="col-sm-2 col-md-2 text-white">
     <ul class="list-unstyled hov_footer">
      <li> <a href="#" class="text-muted">Turkey</a></li>
      <li> <a href="#" class="text-muted">UAE</a></li>
      <li> <a href="#" class="text-muted">United Kingdom</a></li>
      <li> <a href="#" class="text-muted">United States</a></li>
      <li> <a href="#" class="text-muted">Sri Lanka</a></li>
     </ul>
    </aside>
    <aside class="col-sm-2 col-md-2 text-white">
     <ul class="list-unstyled hov_footer">
      <li> <a href="#" class="text-muted">Qatar</a></li>
      <li> <a href="#" class="text-muted">Singapore</a></li>
      <li> <a href="#" class="text-muted">Slovakia</a></li>
      <li> <a href="#" class="text-muted">South Africa</a></li>
      <li> <a href="#" class="text-muted">Green Land</a></li>
     </ul>
    </aside>
    <aside class="col-sm-2 col-md-2 text-white">
     <ul class="list-unstyled hov_footer">
      <li> <a href="#" class="text-muted">Pakistan</a></li>
      <li> <a href="#" class="text-muted">Bangladesh</a></li>
      <li> <a href="#" class="text-muted">Bhutaan</a></li>
      <li> <a href="#" class="text-muted">Nepal</a></li>
     </ul>
    </aside>
   </div>

  </section>
 </div>

 <section class="footer-copyright border-top py-3 bg-light">
  <div class="container d-flex align-items-center">
   <p class="mb-0"> © 2020 Company All rights reserved </p>
   <p class="text-muted mb-0 ml-auto d-flex align-items-center">
    <a href="#" class="d-block"><img alt="#" src="img/appstore.png" height="40"></a>
    <a href="#" class="d-block ml-3"><img alt="#" src="img/playmarket.png" height="40"></a>
   </p>
  </div>
 </section>
</footer>
<nav id="main-nav">
 <ul class="second-nav">
  <li><a href="home.html"><i class="feather-home mr-2"></i> {{trans('lang.home_page')}} </a></li>
  <li><a href="my_order.html"><i class="feather-list mr-2"></i> {{trans('lang.my_orders')}}</a></li>
  <li>
   <a href="#"><i class="feather-edit-2 mr-2"></i> {{trans('lang.authentication')}} </a>
   <ul>
    <li><a href="login.html">{{trans('lang.login')}}</a></li>
    <li><a href="signup.html"> {{trans('lang.register')}}</a></li>
    <li><a href="forgot_password.html">{{trans('lang.forgot_password')}} </a></li>
    <li><a href="verification.html"> {{trans('lang.verification')}}</a></li>
    <li><a href="location.html">{{trans('lang.location')}}</a></li>
   </ul>
  </li>
  <li><a href="favorites.html"><i class="feather-heart mr-2"></i> {{trans('lang.favorites')}}  </a></li>
  <li><a href="trending.html"><i class="feather-trending-up mr-2"></i> {{trans('lang.trending')}} </a></li>
  <li><a href="most_popular.html"><i class="feather-award mr-2"></i> {{trans('lang.most_popular')}} </a></li>
  <li><a href="vendor.html"><i class="feather-paperclip mr-2"></i>  {{trans('lang.store_detail')}}</a></li>
  <li><a href="checkout.html"><i class="feather-list mr-2"></i> {{trans('lang.checkout')}} </a></li>
  <li><a href="successful.html"><i class="feather-check-circle mr-2"></i>  {{trans('lang.successful')}}</a></li>
  <li><a href="map.html"><i class="feather-map-pin mr-2"></i> {{trans('lang.live_map')}} </a></li>
  <li>
   <a href="#"><i class="feather-user mr-2"></i> {{trans('lang.user_profile')}}</a>
   <ul>
    <li><a href="profile.html">{{trans('lang.user_profile')}} </a></li>
    <li><a href="favorites.html"> {{trans('lang.delivery_support')}}  </a></li>
    <li><a href="{{url('contact_us')}}">{{trans('lang.contact_us')}} </a></li>
    <li><a href="{{ route('terms') }}"> {{trans('lang.terms_use')}}</a></li>
    <li><a href="{{ route('privacy') }}">{{trans('lang.privacy_policy')}} </a></li>
   </ul>
  </li>
  <li>
   <a href="#"><i class="feather-alert-triangle mr-2"></i> {{trans('lang.error')}}</a>
   <ul>
    <li><a href="not-found.html">{{trans('lang.not_found')}}</a>
    <li><a href="maintence.html"> {{trans('lang.maintence')}}</a>
    <li><a href="coming-soon.html">{{trans('lang.coming_soon')}}</a>
   </ul>
  </li>
  <li>
   <a href="#"><i class="feather-link mr-2"></i> Navigation  {{trans('lang.link')}} Example</a>
   <ul>
    <li>
     <a href="#"> {{trans('lang.link')}} Example 1</a>
     <ul>
      <li>
       <a href="#"> {{trans('lang.link')}} Example 1.1</a>
       <ul>
        <li><a href="#"> {{trans('lang.link')}}</a></li>
        <li><a href="#"> {{trans('lang.link')}}</a></li>
        <li><a href="#"> {{trans('lang.link')}}</a></li>
        <li><a href="#"> {{trans('lang.link')}}</a></li>
        <li><a href="#"> {{trans('lang.link')}}</a></li>
       </ul>
      </li>
      <li>
       <a href="#"> {{trans('lang.link')}} Example 1.2</a>
       <ul>
        <li><a href="#"> {{trans('lang.link')}}</a></li>
        <li><a href="#"> {{trans('lang.link')}}</a></li>
        <li><a href="#"> {{trans('lang.link')}}</a></li>
        <li><a href="#"> {{trans('lang.link')}}</a></li>
       </ul>
      </li>
     </ul>
    </li>
    <li><a href="#"> {{trans('lang.link')}} Example 2</a></li>
    <li><a href="#"> {{trans('lang.link')}} Example 3</a></li>
    <li><a href="#"> {{trans('lang.link')}} Example 4</a></li>
    <li data-nav-custom-content>
     <div class="custom-message">
      You can add any custom content to your navigation items. This text is just an example.
     </div>
    </li>
   </ul>
  </li>
 </ul>
 <ul class="bottom-nav">
  <li class="email">
   <a class="text-danger" href="home.html">
    <p class="h5 m-0"><i class="feather-home text-danger"></i></p>

    {{trans('lang.home')}}
   </a>
  </li>
  <li class="github">
   <a href="{{ route('faq') }}">
    <p class="h5 m-0"><i class="feather-message-circle"></i></p>

    {{trans('lang.faq')}}
   </a>
  </li>
  <li class="ko-fi">
   <a href="{{url('contact_us')}}">
    <p class="h5 m-0"><i class="feather-phone"></i></p>
    {{trans('lang.help')}}
   </a>
  </li>
 </ul>
</nav>
<div class="modal fade" id="paycard" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
   <div class="modal-header">
    <h5 class="modal-title">{{trans('lang.add_credit_debit_card')}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
    </button>
   </div>
   <div class="modal-body">
    <h6 class="m-0">{{trans('lang.add_new_card')}}</h6>
    <p class="small">WE ACCEPT <span class="osahan-card ml-2 font-weight-bold">( Master Card / Visa Card / Rupay )</span></p>
    <form>
     <div class="form-row">
      <div class="col-md-12 form-group">
       <label class="form-label font-weight-bold small">{{trans('lang.card_number')}}</label>
       <div class="input-group">
        <input placeholder="Card number" type="number" class="form-control">
        <div class="input-group-append"><button type="button" class="btn btn-outline-secondary"><i class="feather-credit-card"></i></button></div>
       </div>
      </div>
      <div class="col-md-8 form-group"><label class="form-label font-weight-bold small">{{trans('lang.valid_through_mm_yy')}}</label><input placeholder="Enter Valid through(MM/YY)" type="number" class="form-control"></div>
      <div class="col-md-4 form-group"><label class="form-label font-weight-bold small">{{trans('lang.cvv')}}</label><input placeholder="Enter CVV Number" type="number" class="form-control"></div>
      <div class="col-md-12 form-group"><label class="form-label font-weight-bold small">{{trans('lang.name_on_card')}}</label><input placeholder="Enter Card number" type="text" class="form-control"></div>
      <div class="col-md-12 form-group mb-0">
       <div class="custom-control custom-checkbox"><input type="checkbox" id="custom-checkbox1" class="custom-control-input"><label title="" type="checkbox" for="custom-checkbox1" class="custom-control-label small pt-1">Securely save this card for a faster checkout next time.</label></div>
      </div>
     </div>
    </form>
   </div>
   <div class="modal-footer p-0 border-0">
    <div class="col-6 m-0 p-0">
     <button type="button" class="btn border-top btn-lg btn-block" data-dismiss="modal">{{trans('lang.close')}}</button>
    </div>
    <div class="col-6 m-0 p-0">
     <button type="button" class="btn btn-primary btn-lg btn-block">{{trans('lang.save_changes')}}</button>
    </div>
   </div>
  </div>
 </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
   <div class="modal-header">
    <h5 class="modal-title">{{trans('lang.add_delivery_address')}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
    </button>
   </div>
   <div class="modal-body">
    <form class="">
     <div class="form-row">
      <div class="col-md-12 form-group">
       <label class="form-label">{{trans('lang.delivery_area')}}</label>
       <div class="input-group">
        <input placeholder="Delivery Area" type="text" class="form-control">
        <div class="input-group-append"><button type="button" class="btn btn-outline-secondary"><i class="feather-map-pin"></i></button></div>
       </div>
      </div>
      <div class="col-md-12 form-group"><label class="form-label">{{trans('lang.complete_address')}}</label><input placeholder="Complete Address e.g. house number, street name, landmark" type="text" class="form-control"></div>
      <div class="col-md-12 form-group"><label class="form-label">{{trans('lang.delivery_instructions')}}</label><input placeholder="Delivery Instructions e.g. Opposite Gold Souk Mall" type="text" class="form-control"></div>
      <div class="mb-0 col-md-12 form-group">
       <label class="form-label">{{trans('lang.nick_name')}}</label>
       <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
        <label class="btn btn-outline-secondary active">
         <input type="radio" name="options" id="option1" checked>  {{trans('lang.home')}}
        </label>
        <label class="btn btn-outline-secondary">
         <input type="radio" name="options" id="option2">  {{trans('lang.work')}}
        </label>
        <label class="btn btn-outline-secondary">
         <input type="radio" name="options" id="option3"> {{trans('lang.other')}}
        </label>
       </div>
      </div>
     </div>
    </form>
   </div>
   <div class="modal-footer p-0 border-0">
    <div class="col-6 m-0 p-0">
     <button type="button" class="btn border-top btn-lg btn-block" data-dismiss="modal">{{trans('lang.close')}}</button>
    </div>
    <div class="col-6 m-0 p-0">
     <button type="button" class="btn btn-primary btn-lg btn-block">{{trans('lang.save_changes')}}</button>
    </div>
   </div>
  </div>
 </div>
</div>

<div class="modal fade" id="inviteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
   <div class="modal-header border-0">
    <h5 class="modal-title font-weight-bold text-dark">{{trans('lang.invite')}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">&times;</span>
    </button>
   </div>
   <div class="modal-body py-0">
    <button class="btn btn-light text-primary btn-sm"><i class="feather-plus"></i></button>
    <span class="ml-2 smal text-primary">Send an invite to a friend</span>
    <p class="mt-3 small">Invited friends (2)</p>
    <div class="d-flex align-items-center mb-3">
     <div class="mr-3"><img alt="#" src="img/user1.jpg" class="img-fluid rounded-circle"></div>
     <div>
      <p class="small font-weight-bold text-dark mb-0">Kate Simpson</p>
      <P class="mb-0 small"><a href="https://askbootstrap.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="6e050f1a0b1d07031e1d01002e011b1a0c010105400d0103">[email&#160;protected]</a></P>
     </div>
    </div>
    <div class="d-flex align-items-center mb-3">
     <div class="mr-3"><img alt="#" src="img/user2.png" class="img-fluid rounded-circle"></div>
     <div>
      <p class="small font-weight-bold text-dark mb-0">Andrew Smith</p>
      <P class="mb-0 small"><a href="https://askbootstrap.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="65040b0117001216080c110d25100c5d4b060a08">[email&#160;protected]</a></P>
     </div>
    </div>
   </div>
   <div class="modal-footer border-0">
   </div>
  </div>
 </div>
</div>

<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script type="70bc925eb21d34a7d8eb3710-text/javascript" src="vendor/jquery/jquery.min.js"></script>
<script type="70bc925eb21d34a7d8eb3710-text/javascript" src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script type="70bc925eb21d34a7d8eb3710-text/javascript" src="vendor/slick/slick.min.js"></script>

<script type="70bc925eb21d34a7d8eb3710-text/javascript" src="vendor/sidebar/hc-offcanvas-nav.js"></script>

<script type="70bc925eb21d34a7d8eb3710-text/javascript" src="js/osahan.js"></script>
<script src="js/rocket-loader.min.js" data-cf-settings="70bc925eb21d34a7d8eb3710-|49" defer=""></script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194" integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw==" data-cf-beacon='{"rayId":"6c83f3752ca50fee","version":"2021.12.0","r":1,"token":"dd471ab1978346bbb991feaa79e6ce5c","si":100}' crossorigin="anonymous"></script>
</body>

<!-- Mirrored from askbootstrap.com/preview/swiggiweb/faq.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 04 Jan 2022 10:58:46 GMT -->
</html>