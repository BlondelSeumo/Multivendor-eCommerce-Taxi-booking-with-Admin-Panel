@include('layouts.app')



@include('layouts.header')



<div class="d-none">

	<div class="bg-primary p-3 d-flex align-items-center">

		<a class="toggle togglew toggle-2" href="#"><span></span></a>

		<h4 class="font-weight-bold m-0 text-white">{{trans('lang.trending')}}</h4>

	</div>

</div>

<div class="siddhi-trending">



	<div class="container">

		<div class="most_popular py-5">

			<div class="d-flex align-items-center mb-4">

				<h3 class="font-weight-bold text-dark mb-0">{{trans('lang.trending')}}</h3>

				<a href="#" data-toggle="modal" data-target="#filters" class="ml-auto btn btn-primary">{{trans('lang.filter')}}</a>

			</div>

			<div id="trendingList"></div>

			<?php /*

<div class="row">

<div class="col-lg-4 mb-3">

<div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm grid-card">

<div class="list-card-image">

<div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>

<div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>

<div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>

<a href="vendor.html">

<img alt="#" src="{{asset('img/trending1.png')}}" class="img-fluid item-img w-100">

</a>

</div>

<div class="p-3 position-relative">

<div class="list-card-body">

<h6 class="mb-1"><a href="vendor.html" class="text-black">The siddhi Store

</a>

</h6>

<p class="text-gray mb-3">North • Hamburgers • Pure veg</p>

<p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="feather-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $500 FOR TWO</span></p>

</div>

<div class="list-card-badge">

<span class="badge badge-danger">OFFER</span> <small>65% siddhi50</small>

</div>

</div>

</div>

</div>

<div class="col-lg-4 mb-3">

<div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm grid-card">

<div class="list-card-image">

<div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>

<div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>

<div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>

<a href="vendor.html">

<img alt="#" src="{{asset('img/trending2.png')}}" class="img-fluid item-img w-100">

</a>

</div>

<div class="p-3 position-relative">

<div class="list-card-body">

<h6 class="mb-1"><a href="vendor.html" class="text-black">Thai Famous Cuisine</a></h6>

<p class="text-gray mb-3">North Indian • Indian • Pure veg</p>

<p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="feather-clock"></i> 30–35 min</span> <span class="float-right text-black-50"> $250 FOR TWO</span></p>

</div>

<div class="list-card-badge">

<span class="badge badge-success">OFFER</span> <small>65% off</small>

</div>

</div>

</div>

</div>

<div class="col-lg-4 mb-3">

<div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm grid-card">

<div class="list-card-image">

<div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>

<div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>

<div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>

<a href="vendor.html">

<img alt="#" src="{{asset('img/trending3.png')}}" class="img-fluid item-img w-100">

</a>

</div>

<div class="p-3 position-relative">

<div class="list-card-body">

<h6 class="mb-1"><a href="vendor.html" class="text-black">The siddhi Store

</a>

</h6>

<p class="text-gray mb-3">North • Hamburgers • Pure veg</p>

<p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="feather-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $500 FOR TWO</span></p>

</div>

<div class="list-card-badge">

<span class="badge badge-danger">OFFER</span> <small>65% siddhi50</small>

</div>

</div>

</div>

</div>

</div>

<div class="row">

<div class="col-lg-4 mb-3">

<div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm grid-card">

<div class="list-card-image">

<div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>

<div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>

<div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>

<a href="vendor.html">

<img alt="#" src="{{asset('img/trending4.png')}}" class="img-fluid item-img w-100">

</a>

</div>

<div class="p-3 position-relative">

<div class="list-card-body">

<h6 class="mb-1"><a href="vendor.html" class="text-black">Bite Me Sandwiches</a></h6>

<p class="text-gray mb-3">North Indian • American • Pure veg</p>

<p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="feather-clock"></i> 30–35 min</span> <span class="float-right text-black-50"> $250 FOR TWO</span></p>

</div>

<div class="list-card-badge">

<span class="badge badge-success">OFFER</span> <small>65% off</small>

</div>

</div>

</div>

</div>

<div class="col-lg-4 mb-3">

<div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm grid-card">

<div class="list-card-image">

<div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>

<div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>

<div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>

<a href="vendor.html">

<img alt="#" src="{{asset('img/trending5.png')}}" class="img-fluid item-img w-100">

</a>

</div>

<div class="p-3 position-relative">

<div class="list-card-body">

<h6 class="mb-1"><a href="vendor.html" class="text-black">The siddhi Store

</a>

</h6>

<p class="text-gray mb-3">North • Hamburgers • Pure veg</p>

<p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="feather-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $500 FOR TWO</span></p>

</div>

<div class="list-card-badge">

<span class="badge badge-danger">OFFER</span> <small>65% siddhi50</small>

</div>

</div>

</div>

</div>

<div class="col-lg-4 mb-3">

<div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm grid-card">

<div class="list-card-image">

<div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>

<div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>

<div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>

<a href="vendor.html">

<img alt="#" src="{{asset('img/trending6.png')}}" class="img-fluid item-img w-100">

</a>

</div>

<div class="p-3 position-relative">

<div class="list-card-body">

<h6 class="mb-1"><a href="vendor.html" class="text-black">Bite Me Sandwiches</a></h6>

<p class="text-gray mb-3">North Indian • American • Pure veg</p>

<p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="feather-clock"></i> 30–35 min</span> <span class="float-right text-black-50"> $250 FOR TWO</span></p>

</div>

<div class="list-card-badge">

<span class="badge badge-success">OFFER</span> <small>65% off</small>

</div>

</div>

</div>

</div>

</div>

<div class="row">

<div class="col-lg-4 mb-3">

<div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm grid-card">

<div class="list-card-image">

<div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>

<div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>

<div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>

<a href="vendor.html">

<img alt="#" src="{{asset('img/trending7.png')}}" class="img-fluid item-img w-100">

</a>

</div>

<div class="p-3 position-relative">

<div class="list-card-body">

<h6 class="mb-1"><a href="vendor.html" class="text-black">The siddhi Store

</a>

</h6>

<p class="text-gray mb-3">North • Hamburgers • Pure veg</p>

<p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="feather-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $500 FOR TWO</span></p>

</div>

<div class="list-card-badge">

<span class="badge badge-danger">OFFER</span> <small>65% siddhi50</small>

</div>

</div>

</div>

</div>

<div class="col-lg-4 mb-3">

<div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm grid-card">

<div class="list-card-image">

<div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>

<div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>

 <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>

<a href="vendor.html">

<img alt="#" src="{{asset('img/trending8.png')}}" class="img-fluid item-img w-100">

</a>

</div>

<div class="p-3 position-relative">

<div class="list-card-body">

<h6 class="mb-1"><a href="vendor.html" class="text-black">Bite Me Sandwiches</a></h6>

<p class="text-gray mb-3">North Indian • American • Pure veg</p>

<p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="feather-clock"></i> 30–35 min</span> <span class="float-right text-black-50"> $250 FOR TWO</span></p>

</div>

<div class="list-card-badge">

<span class="badge badge-success">OFFER</span> <small>65% off</small>

</div>

</div>

</div>

</div> */ ?>

		</div>

	</div>

</div>



<?php /* <div class="siddhi-menu-fotter fixed-bottom bg-white px-3 py-2 text-center d-none">

<div class="row">

<div class="col">

<a href="home.html" class="text-dark small font-weight-bold text-decoration-none">

<p class="h4 m-0"><i class="feather-home"></i></p>

Home

</a>

</div>

<div class="col selected">

<a href="trending.html" class="text-danger small font-weight-bold text-decoration-none">

<p class="h4 m-0"><i class="feather-map-pin text-danger"></i></p>

Trending

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

Favorites

</a>

</div>

<div class="col">

<a href="profile.html" class="text-dark small font-weight-bold text-decoration-none">

<p class="h4 m-0"><i class="feather-user"></i></p>

Profile

</a>

</div>

</div>

</div>

</div> */ ?>



@include('layouts.footer')



@include('layouts.nav')



<script type="text/javascript">

	//var categoryId = "<?php // echo $_GET['id']; ?>";

	var append_categories = '';

	// var trendingStoreRef= database.collection('vendor_products').where('categoryID',"==",categoryId);
	var trendingStoreRef= database.collection('vendor_products');
	var vendorIds = [];

	var html = '';



	getTrendingStoreID().then(data => {

		vendorIds= data;

		var trendingList = '';

		var count = 0;

		console.log(data.length);

		$(document).ready(function() {

			vendorIds.forEach((listval) => {

				count++;

				html = html + vendorBuildHTML(listval);

				if(count == (vendorIds.length + 1)){

					getVendorData();

				}

			})

		})

	})



	function getVendorData(){

		console.log(html);

		trendingList = document.getElementById('trendingList');

		trendingList.innerHTML=html;



	}



	async function getTrendingStoreID(){

		var allStoreId = [];

		await trendingStoreRef.get().then( async function(trendingSnapshots){

			trendingSnapshots.docs.forEach((listval) => {

				var datas=listval.data();

				if(datas.vendorID != '' && (!allStoreId.includes(datas.vendorID))){

					var vdId = datas.vendorID;

					allStoreId.push(vdId);

				}

			});

		})

		return allStoreId;

	}



	async function vendorBuildHTML(vendorId){

		var vendorHTML = '';

		var vendorRef= database.collection('vendors').where('id',"==",vendorId);

		vendorRef.get().then( async function(vendorSnapshots){

			var vendor = vendorSnapshots.docs[0].data();



			vendorHTML = '<div class="col-lg-4 mb-3"><div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm grid-card"><div class="list-card-image"><div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div><div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div><div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div><a href="vendor.html"><img alt="#" src="'+vendor.photo+'" class="img-fluid item-img w-100"></a></div><div class="p-3 position-relative"><div class="list-card-body"><h6 class="mb-1"><a href="vendor.html" class="text-black">'+vendor.title+'</a></h6><p class="text-gray mb-3">North • Hamburgers • Pure veg</p><p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="feather-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $500 FOR TWO</span></p></div><div class="list-card-badge"><span class="badge badge-danger">OFFER</span> <small>65% siddhi50</small></div></div></div></div></div>';



		})

		return vendorHTML;

	}







</script>