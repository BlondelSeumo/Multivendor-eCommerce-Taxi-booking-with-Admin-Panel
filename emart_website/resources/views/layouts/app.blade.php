<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" <?php if(str_replace('_', '-', app()->getLocale())=='ar' || @$_COOKIE['is_rtl']=='true'){ ?> dir="rtl"  <?php } ?>>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="<?php echo env('APP_NAME'); ?>">
	<meta name="author" content="<?php echo env('APP_NAME'); ?>">
	<link rel="icon" type="image/png" href="{{asset('img/fav.png')}}">
	<title><?php echo env('APP_NAME'); ?> - Online Item Ordering System</title>
	
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/slick/slick.min.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/slick/slick-theme.min.css')}}" />
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
	
	<script type="text/javascript">
	var section_id='';
	<?php if(isset($_COOKIE['section_id'])){ ?>
		section_id='<?php echo $_COOKIE['section_id']; ?>';
	<?php }?>
	</script>
	
	<link href="{{asset('vendor/icons/feather.css')}}" rel="stylesheet" type="text/css">
	
	<link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
	
	<?php if(str_replace('_', '-', app()->getLocale())=='ar' || @$_COOKIE['is_rtl']=='true'){ ?>
	<link href="{{asset('vendor/bootstrap/css/bootstrap-rtl.min.css')}}" rel="stylesheet">
	<?php } ?>
	
	<link href="{{asset('css/style.css')}}" rel="stylesheet">
	
	<?php if(str_replace('_', '-', app()->getLocale())=='ar' || @$_COOKIE['is_rtl']=='true'){ ?>
	<link href="{{asset('css/style_rtl.css')}}" rel="stylesheet">
	<?php } ?>
	
	<link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
	
	<link href="{{asset('vendor/sidebar/demo.css')}}" rel="stylesheet">
	
	<?php if(isset($_COOKIE['section_color'])){ ?>
		
	<style type="text/css">
		a,.list-card a:hover,a:hover{color: <?php echo $_COOKIE['section_color']; ?>;}
	    .hc-offcanvas-nav h2,.hc-offcanvas-nav:not(.touch-device) li:not(.custom-content) a:hover,.cat-item a.cat-link:hover{background-color:<?php echo $_COOKIE['section_color']; ?> !important;}
		.homebanner-content .ban-btn a,.open-ticket-btn a, .select-sec-btn a{ background-color:<?php echo $_COOKIE['section_color']; ?> ;border-color: <?php echo $_COOKIE['section_color']; ?> !important; }	
		.homebanner-content .ban-btn a:hover,.open-ticket-btn a:hover, .select-sec-btn a:hover{color:<?php echo $_COOKIE['section_color']; ?> !important;}
		.header-main .takeaway-div input[type="checkbox"]::before,.list-card .member-plan .badge.open,.rest-basic-detail .feather_icon .fu-status a.rest-right-btn > span.open,.header-main .takeaway-div input[type="checkbox"]:checked::before{background-color:<?php echo $_COOKIE['section_color']; ?> ;}
		.offer_coupon_code .offer_code p.badge,.offer_coupon_code .offer_price{color: <?php echo $_COOKIE['section_color']; ?>;}
	    .cat-item a.cat-link:hover i.fa{color: <?php echo $_COOKIE['section_color']; ?> !important;}
	    .rest-basic-detail .feather_icon a.rest-right-btn,.rest-basic-detail .feather_icon a.btn{border-color:<?php echo $_COOKIE['section_color']; ?> ;}
	    .rest-basic-detail .feather_icon a.rest-right-btn .feather-star,.rest-basic-detail .feather_icon a.btn,.rest-basic-detail .feather_icon a.rest-right-btn:hover,ul.rating {color: <?php echo $_COOKIE['section_color']; ?> !important;}
	
	    .vendor-detail-left h4.h6::after, .sidebar-header h3.h6::after {background-color: <?php echo $_COOKIE['section_color']; ?>;}
	    .gold-members .add-btn .menu-itembtn a.btn{border-color: <?php echo $_COOKIE['section_color']; ?>;color: <?php echo $_COOKIE['section_color']; ?>;}
	    .btn-primary,.transactions-list .media-body .app-off-btn a{background:<?php echo $_COOKIE['section_color']; ?>;border-color:<?php echo $_COOKIE['section_color']; ?>;}
	    .btn-primary:hover,.btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show > .btn-primary.dropdown-toggle, .btn-primary.focus, .btn-primary:focus,.custom-control-input:checked ~ .custom-control-label::before,.row.fu-loadmore-btn .page-link{background: <?php echo $_COOKIE['section_color']; ?>;border-color: <?php echo $_COOKIE['section_color']; ?>;}
	    .count-number-box .count-number .count-number-input, .count-number .count-number-input,.count-number-box .count-number button.count-number-input-cart:hover, .count-number button.btn-sm.btn:hover,.btn-link{color: <?php echo $_COOKIE['section_color']; ?>;}
	    
	     .transactions-banner{background: <?php echo $_COOKIE['section_color']; ?>;}
	     .transactions-list .media-body .app-off-btn a:hover,.rating-stars .feather-star.star_active, .rating-stars .feather-star.text-warning{color: <?php echo $_COOKIE['section_color']; ?> !important;}
	     .search .nav-tabs .nav-item.show .nav-link, .search .nav-tabs .nav-link.active{border-color: <?php echo $_COOKIE['section_color']; ?> !important;background-color: <?php echo $_COOKIE['section_color']; ?> !important;}
	     .text-primary,.card-icon > span{color: <?php echo $_COOKIE['section_color']; ?> !important;}
	     .checkout-left-box.siddhi-cart-item::after,.checkout-left-box.accordion::after,.dropdown-item.active, .dropdown-item:active{background: <?php echo $_COOKIE['section_color']; ?>;}
	     .page-link,.rest-basic-detail .feather_icon a.rest-right-btn{color: <?php echo $_COOKIE['section_color']; ?> ;}
	     .page-link:hover{background:<?php echo $_COOKIE['section_color']; ?>; border-color: <?php echo $_COOKIE['section_color']; ?>;}
	     
	     .btn-outline-primary{color: <?php echo $_COOKIE['section_color']; ?>;border-color:<?php echo $_COOKIE['section_color']; ?>;}  
	     .btn-outline-primary:hover{background: <?php echo $_COOKIE['section_color']; ?>;border-color:<?php echo $_COOKIE['section_color']; ?>;}  
	     .gendetail-row h3{border-color:<?php echo $_COOKIE['section_color']; ?>;}
	     .dyn-menulist button.view_all_menu_btn{color: <?php echo $_COOKIE['section_color']; ?>;}
	     .daytab-cousines ul li > span{color: <?php echo $_COOKIE['section_color']; ?>; border-color:<?php echo $_COOKIE['section_color']; ?>;}
	     .daytab-cousines ul li > span:hover{border-color:<?php echo $_COOKIE['section_color']; ?>;background: <?php echo $_COOKIE['section_color']; ?>;}
	     .feather-star.text-warning,.list-card .offer_coupon_code .star .badge .feather-star.star_active, .list-card-body .offer-btm .star .badge .feather-star.star_active{color: <?php echo $_COOKIE['section_color']; ?> !important;}
	     a.restaurant_direction img{filter: grayscale(100%);   -webkit-filter: grayscale(100%);}
	      .modal-body .recepie-body .custom-control .custom-control-label > span.text-muted{color: <?php echo $_COOKIE['section_color']; ?> !important;}
	     .payment-table tr th{background: <?php echo $_COOKIE['section_color']; ?>;}
	
	     .sidebar-item-list .product-item .media-body p span.sku,.car-det-head .car-det-price span.price,.rentalcar-list .car-price span{color: <?php echo $_COOKIE['section_color']; ?>;}
	     .carrent-book a,.rental-left-box .nav-pills .nav-link.active{background: <?php echo $_COOKIE['section_color']; ?>;}
	     .rental-left-box .nav-pills-custom .nav-link.active::before {border-left-color: <?php echo $_COOKIE['section_color']; ?>;border-right-color: <?php echo $_COOKIE['section_color']; ?>;}
	     .form-check .switch input:checked + .slider{background-color: <?php echo $_COOKIE['section_color']; ?>;}
	     .product-detail-page .addtocart .add-to-cart.btn.btn-primary{border-color:<?php echo $_COOKIE['section_color']; ?>;color: <?php echo $_COOKIE['section_color']; ?>;}
	     .product-detail-page .addtocart .add-to-cart.btn.btn-primary.booknow{background: <?php echo $_COOKIE['section_color']; ?>;}
	     .parcelImageUploadDiv:after,.parcel_payment-way ul li label::before{background: <?php echo $_COOKIE['section_color']; ?>;}
	
	     .parcel_delivery_content #tabs .nav-tabs .nav-item.show .nav-link, .parcel_delivery_content #tabs .nav-tabs .nav-item.active,.tab-title h3 span,.tab-btn button.btn.btn-primary,.appendParcelImages #parcelPhotos .image-item span.remove-btn{background:<?php echo $_COOKIE['section_color']; ?>; }
	     .tab-title h3,.parcel_payment-detail > div.sender-det > h3 strong,.parcel_payment_total .parcel_payment-box span.total.price{color:<?php echo $_COOKIE['section_color']; ?>;}
	     .parcel_payment_left .coupon_detail .copupon-list ul li a{border-color: <?php echo $_COOKIE['section_color']; ?>;color:<?php echo $_COOKIE['section_color']; ?>;}
	     .parcel_payment_right .search-box-inner a,.pay-btn a,.parcel_payment_left .coupon_detail .copupon-list ul li a.active,.parcel_payment_left .coupon_detail .copupon-list ul li a:hover{background: <?php echo $_COOKIE['section_color']; ?>;border-color:<?php echo $_COOKIE['section_color']; ?>;}
	     .sction-title h2::before,.product-detail-page .addons-option .custom-control .custom-control-input:checked ~ .custom-control-label::before {background: <?php echo $_COOKIE['section_color']; ?>;}
	
	     .ecommerce-content .title .see-all a{background: <?php echo $_COOKIE['section_color']; ?>;}
	     .order-summery .payment-total.total-price span.price,.brand span a:hover,.store span a:hover,.vandor-sidebar .vandorcat-list li a:hover,.vandor-sidebar .vandorcat-list li.active a{color: <?php echo $_COOKIE['section_color']; ?>;}
	     .vandor-sidebar .vandorcat-list li a:hover,.vandor-sidebar .vandorcat-list li.active a {border-left: 3px solid <?php echo $_COOKIE['section_color']; ?>;}  
	     .bg-primary{background: <?php echo $_COOKIE['section_color']; ?> !important;}
	     .section_list .section-block:hover, .section_list .section-selected .section-block{border-color: <?php echo $_COOKIE['section_color']; ?> !important;}
	     .parcel_payment-way ul li input[type="radio"]:checked ~ label::after{border-color: <?php echo $_COOKIE['section_color']; ?>;}
	      .section_list .section-block::after {border-color: <?php echo $_COOKIE['section_color']; ?>; background: <?php echo $_COOKIE['section_color']; ?>;}
	</style>
	<?php } ?>
	
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>

<body class="fixed-bottom-bar">
	
</body>

</html>