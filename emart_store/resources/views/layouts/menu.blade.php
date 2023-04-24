
<div class="user-profile">

    <!-- User profile text-->

    <div class="profile-text">

        <h5>Welcome to {{ config('app.name', 'Laravel') }} !</h5>
        <h3>Log Out</h3>
        <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();" class="" data-toggle="tooltip" title="Log out"><i class="mdi mdi-power"></i></a>

        <div class="dropdown-menu animated flipInY">

            <!-- text-->

            <a href="#" class="dropdown-item"><i class="ti-user"></i> </a>

            <!-- text-->

            <a href="#" class="dropdown-item"><i class="ti-wallet"></i> </a>

            <div class="dropdown-divider"></div>

            <!-- text-->

            <a href="{{ route('logout') }}" class="dropdown-item"><i class="fa fa-power-off"></i> Log Out</a>

            <!-- text-->

        </div>

    </div>

</div>

<nav class="sidebar-nav">

    <ul id="sidebarnav">

        <li class="nav-devider"></li>
        
        <li class="nav-small-cap">{{ config('app.name', 'Laravel') }}</li>

        <li>
        	<a class="has-arrow waves-effect waves-dark" href="{!! url('dashboard') !!}" aria-expanded="false">
                <i class="mdi mdi-home"></i>
                <span class="hide-menu">Home</span>
            </a>
            <ul aria-expanded="false" class="collapse">
                <li><a href="{!! url('dashboard') !!}" >Dashboard</a></li>
            </ul>
        </li>
        
        <li> 
        	<a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                <i class="mdi mdi-shopping"></i>
                <span class="hide-menu">{{trans('lang.item_plural')}}</span>
            </a>

            <ul aria-expanded="false" class="collapse">
                <li><a href="{!! url('items') !!}">{{trans('lang.item_plural')}}</a></li>
            </ul>
        </li>

        <li> 
        	<a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                <i class="mdi mdi-reorder-horizontal"></i>
                <span class="hide-menu">{{trans('lang.order_plural')}}</span>
            </a>

            <ul aria-expanded="false" class="collapse">
                <li><a href="{!! url('orders') !!}">{{trans('lang.order_plural')}}</a></li>
                <li><a href="{!! url('placedOrders') !!}">{{trans('lang.placed_orders')}}</a></li>
                <li><a href="{!! url('acceptedOrders') !!}">{{trans('lang.accepted_orders')}}</a></li>
                <li><a href="{!! url('rejectedOrders') !!}">{{trans('lang.rejected_orders')}}</a></li>
                <li><a href="{!! url('orderReview') !!}">{{trans('lang.order_review')}}</a></li>
            </ul>

        </li>
            <li><a class="has-arrow waves-effect waves-dark" href="{!! url('coupons') !!}" aria-expanded="false">
                <i class="mdi mdi-sale"></i>
                <span class="hide-menu">{{trans('lang.coupon_plural')}}</span>
            </a>           
        </li>
        <li class="specialOfferDiv" style="display: none;">
            <a class="has-arrow waves-effect waves-dark"
               href="{!! url('special-offer') !!}" aria-expanded="false">
                <i class="fa fa-table "></i>
                <span class="hide-menu">{{trans('lang.special_offer')}}</span>
            </a>
        </li>
    
        <li class="dineInHistory"><a class="has-arrow waves-effect waves-dark" href="{!! url('booktable') !!}" aria-expanded="false">
                <i class="fa fa-table "></i>
                <span class="hide-menu">{{trans('lang.book_table')}} / DINE IN History</span>
            </a>
        </li>

        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                <i class="mdi mdi-wallet"></i>
                <span class="hide-menu">{{trans('lang.payment_plural')}}</span>
            </a>
            <ul aria-expanded="false" class="collapse">
                <li><a href="{!! url('payments') !!}">{{trans('lang.payment_plural')}}</a></li>
            </ul>
        </li> 
    </ul>

    <p class="web_version"></p>
</nav>    

<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-storage.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-database.js"></script>
<script src="https://unpkg.com/geofirestore/dist/geofirestore.js"></script>
<script src="https://cdn.firebase.com/libs/geofire/5.0.1/geofire.min.js"></script>
<script type="text/javascript">@include('vendor.notifications.init_firebase')</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script type="text/javascript">
    var database = firebase.firestore();
    var vendorUserId = "<?php echo $id; ?>";
	$(document).ready(function(){
        database.collection('vendors').where('author',"==",vendorUserId).get().then(async function(vendorSnapshots){
	        var vendorData = vendorSnapshots.docs[0].data();    
	        var enabledDiveInFuture = vendorData.enabledDiveInFuture;
	        if(enabledDiveInFuture){
	            $('.dineInHistory').show();
	        }else{
	            $('.dineInHistory').hide();
	        }
    	})
    });
</script>

<script type="text/javascript">
    var database = firebase.firestore();
    var ref = database.collection('settings').doc("specialDiscountOffer");
    ref.get().then(async function (snapshots) {
        var specialDiscountOffer = snapshots.data();
        if (specialDiscountOffer.isEnable) {
            $('.specialOfferDiv').show();
        }
    });
</script>
