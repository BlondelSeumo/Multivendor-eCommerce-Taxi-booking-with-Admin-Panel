@include('layouts.app')



@include('layouts.header')

<div class="d-none">
	<div class="bg-primary p-3 d-flex align-items-center">
		<a class="toggle togglew toggle-2" href="#"><span></span></a>
		<h4 class="font-weight-bold m-0 text-white">{{trans('lang.my_request')}}</h4>
	</div>
</div>
<section class="py-4 siddhi-main-body">
	<div class="container">
		<div class="row">
			<div class="col-md-12 top-nav mb-3">
				<ul class="nav nav-tabsa custom-tabsa border-0 bg-white rounded overflow-hidden shadow-sm p-2 c-t-order" id="myTab" role="tablist">
					<li class="nav-item" role="presentation">
						<a class="nav-link border-0 text-dark py-3 active" href="{{url('my_dinein')}}"> <i class="feather-check mr-2 text-success mb-0"></i>
							{{trans('lang.completed')}}</a>
					</li>
					<li class="nav-item border-top" role="presentation">
						<a class="nav-link border-0 text-dark py-3" href="{{url('my_dinein')}}"> <i class="feather-clock mr-2 text-warning mb-0"></i>
							{{trans('lang.on_progress')}}</a>
					</li>
					<li class="nav-item border-top" role="presentation">
						<a class="nav-link border-0 text-dark py-3" href="{{url('my_dinein')}}"> <i class="feather-x-circle mr-2 text-danger mb-0"></i>
							{{trans('lang.canceled')}}</a>
					</li>
				</ul>
			</div>
			<div class="col-md-12">
				<section class="bg-white siddhi-main-body rounded shadow-sm overflow-hidden">
					<div class="container p-0">
						<div class="p-3 border-bottom gendetail-row">
							<div class="row">
								<div class="col-lg-12">
									<div class="card p-3">
										<h3>{{trans('lang.general_details')}}</h3>
										<div class="form-group widt-100 gendetail-col">
											<label class="control-label"><strong>{{trans('lang.date_created')}} : </strong><span id="order-date"></span></label>
										</div>
										<div class="form-group widt-100 gendetail-col">
											<label class="control-label"><strong>{{trans('lang.order_number')}} :</strong><span id="order-number"></span></label>
										</div>
										<div class="form-group widt-100 gendetail-col">
											<label class="control-label"><strong>{{trans('lang.status')}} : </strong><span id="order-status"></span></label>
										</div>
										
									</div>
									
								</div>
								
							</div>
							
						</div>
						
						<div class="p-3 border-bottom order-secdetail">
							<div class="row">
								<div class="col-12">
									<div class=" order-deta-btm-right">
										<div class="resturant-detail">
											<div class="card">
												<div class="card-header">
													<h4 class="card-header-title">{{trans('lang.restaurant')}}</h4>
												</div>
												<div class="card-body">
													<a href="#" class="row redirecttopage" id="resturant-view">
														<div class="col-4">
															<img src="" class="resturant-img rounded-circle" alt="restaurant" width="70px" height="70px">
														</div>
														<div class="col-8">
															<h4 class="restaurant-title"></h4>
														</div>
													</a>
													<h5 class="contact-info">{{trans('lang.contact_info')}}:</h5>
													<p><strong>{{trans('lang.phone')}}:</strong>
														<span id="restaurant_phone"></span>
													</p>
													<p><strong>{{trans('lang.address')}}:</strong>
														<span id="restaurant_address"></span>
													</p>
													
												</div>
											</div>
										</div>
									</div>
								</div>
								
							</div>
						</div>
						
						
						<div class="modal fade" id="reviewModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">{{trans('lang.review_order')}}</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">{{trans('lang.rate')}}</label>
											<div class="col-sm-10">
												<!-- <input type="number" class="form-control review_rate" placeholder="Rate"> -->
												<select class="form-control review_rate">
													<option value="1">1</option>
													<option value="1.5">1.5</option>
													<option value="2">2</option>
													<option value="2.5">2.5</option>
													<option value="3">3</option>
													<option value="3.5">3.5</option>
													<option value="4">4</option>
													<option value="4.5">4.5</option>
													<option value="5">5</option>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">{{trans('lang.comment')}}</label>
											<div class="col-sm-10">
												<input type="text" class="form-control review_comment" placeholder="Review Comment">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">{{trans('lang.image')}}</label>
											<div class="col-sm-10">
												<input type="file" onChange="handleFileSelect(event)">
												<div id="uploding_image"></div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('lang.close')}}</button>
										<button type="button" class="btn btn-primary add_review_btn	">{{trans('lang.add_review')}}</button>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
</section>


@include('layouts.footer')



@include('layouts.nav')



<script type="text/javascript">

	
	var orderId =   "<?php echo $_GET['id']; ?>";
	var append_categories = '';
	var completedorsersref= database.collection('booked_table').where('id',"==",orderId);
	var reviewOrderImage = '';
	var orderVendorId = '';
	var reviewUserName = '';
	var reviewUserProfile = '';
	$(document).ready(function() {
		getOrderDetails();
	});

	var place_image ='';
	var ref_place = database.collection('settings').doc("placeHolderImage");
 	ref_place.get().then( async function(snapshots){
    	var placeHolderImage = snapshots.data();            
    	place_image = placeHolderImage.image;
    
	});

	var currentCurrency ='';
    var currencyAtRight = false;
    var refCurrency = database.collection('currencies').where('isActive', '==' , true);
    refCurrency.get().then( async function(snapshots){
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;
    });

	var review_data = database.collection('foods_review').where('orderid',"==",orderId);
	//console.log('user_uuid '+user_uuid);
	
	review_data.get().then( async function(snapshots){
        if (snapshots.docs[0]) {
	        var r_data = snapshots.docs[0].data();
	        var orderid_data = r_data.orderid;
			//console.log('orderid_data '+orderid_data);
	        if (orderId === orderid_data) {
			//console.log('orderId '+orderId);
	        	$('#review_btn').hide();
	        	$('#reviewModel').hide();
	        }else{
			//console.log('orderId false'+orderId);
	        	$('#review_btn').show();
	        	$('#reviewModel').show();
	        }

        }

    });
	
    $(".add_review_btn").click(function(){
		var rating = parseFloat($(".review_rate").val());
		var comment = $(".review_comment").val();
		var photos = [];
		photos[0] = reviewOrderImage;
		var orderid = "<?php echo $_GET['id']; ?>";
		var CustomerId = user_uuid;
		var VendorId = orderVendorId;
		var uname = reviewUserName;
		var reviewId = database.collection("tmp").doc().id;
		var userProfile = reviewUserProfile;
		//alert(reviewId);
		  database.collection('foods_review').doc(reviewId).set({'CustomerId':CustomerId,'Id':reviewId,'VendorId':VendorId,'comment':comment,'orderid':orderid,'photos':photos,'rating':rating,"uname":uname,'profile':userProfile}).then(function(result) {
                location.reload();
             });


    })

	async function getOrderDetails(){



		completedorsersref.get().then( async function(completedorderSnapshots){

		

			var orderDetails = completedorderSnapshots.docs[0].data();
			if(orderDetails.author.id != user_uuid){
				window.location.href = '{{ route("login")}}';
			}else{


			

			var orderDate = orderDetails.createdAt.toDate().toDateString();

			var time = orderDetails.createdAt.toDate().toLocaleTimeString('en-US');

			$("#order-date").html(orderDate+' '+time);

			

			//var order_address = orderDetails.address.line1+' '+orderDetails.address.line2 +', '+orderDetails.address.city +', '+orderDetails.address.country;

			


		$("#order-addreess").html("");

			
			$("#order-number").html(order_number);
			if(order_status=="Order Placed"){
				$("#order-status").html("Requested");
			}else if(order_status=="Order Rejected"){
				$("#order-status").html("Request Rejected");
			}else if(order_status=="Order Accepted"){
				$("#order-status").html("Request Accepted");
			}

			

			var order_restaurant = '<tr>';
			var restaurantImage = orderDetails.vendor.photo;
            var view_vendor_details = "{{ route('restaurant',':id')}}";
            view_vendor_details = view_vendor_details.replace(':id', 'id='+orderDetails.vendorID);
            orderVendorId = orderDetails.vendorID;
            reviewUserName = orderDetails.author.firstName+' '+orderDetails.author.lastName;
            reviewUserProfile = orderDetails.author.profilePictureURL;
			if(restaurantImage == ''){
				restaurantImage = place_image;
			}
			// order_restaurant += '<td class="ord-photo"><a href="'+view_vendor_details+'" class="row redirecttopage" id="resturant-view"><img alt="#" src="'+restaurantImage+'" class="img-fluid order_img rounded"></a></td>';
			// order_restaurant += '<td class="prod-name"><a href="'+view_vendor_details+'" class="row redirecttopage" id="resturant-view">'+orderDetails.vendor.title+'</a></td>';
			// order_restaurant += '</tr>';

			// $("#restaurant-details").html('<table class="order-list">'+order_restaurant+'</table>');

            $('.resturant-img').attr('src',restaurantImage);

          	if (orderDetails.vendor.title) {
              $('.restaurant-title').html('<a href="'+view_vendor_details+'" class="row redirecttopage" id="resturant-view">'+orderDetails.vendor.title+'</a>');  
          	}

          	if (orderDetails.vendor.phonenumber) {
              $('#restaurant_phone').text(orderDetails.vendor.phonenumber);  
          	}

          	if (orderDetails.vendor.location) {
              $('#restaurant_address').text(orderDetails.vendor.location);  
          	}



				if(orderDetails.hasOwnProperty('takeAway') && orderDetails.takeAway == true){
					$(".order_driver_details").hide();
					$(".order_shopping_div").hide();
					$(".order_tip_div").hide();
				}else if(orderDetails.hasOwnProperty('driver')){
						var driverImage = orderDetails.driver.profilePictureURL;
						if(driverImage == ''){
							driverImage = place_image;
						}
						var name = orderDetails.driver.firstName+" "+orderDetails.driver.lastName;
						// var order_driver = '<tr>';
						// order_driver += '<td class="ord-photo"><img alt="#" src="'+driverImage+'" class="img-fluid order_img rounded"></td>';
						// order_driver += '<td class="prod-name">'+name+'</td>';
						// order_driver += '</tr>';
						// $("#driver_details").html('<table class="order-list">'+order_driver+'</table>');	

						$('.driver-img').attr('src',driverImage);

				        if (name) {
				              $('.driver-name-title').html(name);  
				       	}

			          	if (orderDetails.driver.phoneNumber) {
			              $('#driver_phone').text(orderDetails.driver.phoneNumber);  
			          	}

			          	if (orderDetails.driver.carNumber) {
			              $('#driver_car_number').text(orderDetails.driver.carNumber);  
			          	}

			          	// if(orderDetails.driver.carName){

			          	// 	$('#driver_car_name').text(orderDetails.driver.carName);  
			          	// }		
					}

							if(!orderDetails.driver){
								$("#order_driver_details").hide();
							}




}

		})

	}

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
            reviewOrderImage = downloadURL;

      });   
    });
    
    };
  })(f);
  reader.readAsDataURL(f);
}   



</script>