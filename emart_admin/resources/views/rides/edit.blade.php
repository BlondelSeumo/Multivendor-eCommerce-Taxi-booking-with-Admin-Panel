@extends('layouts.app')

@section('content')
	<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.rides')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                <?php if(isset($_GET['eid']) && $_GET['eid'] != ''){?>
                    <li class="breadcrumb-item"><a href= "{{route('drivers.ride',$_GET['eid'])}}" >{{trans('lang.order_plural')}}</a></li>
                <?php }else{ ?>
                    <li class="breadcrumb-item"><a href= "javascript:window.history.go(-1);" >{{trans('lang.rides')}}</a></li>
                <?php } ?>

                <li class="breadcrumb-item">{{trans('lang.ride_edit')}}</li>
            </ol>
        </div>
    </div>

        <div class="card-body">
      	   <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>

        <div class="order_detail" id="order_detail">
          <div class="order_detail-top">
            <div class="row">
              <div class="order_edit-genrl col-md-4">

                <h3>{{trans('lang.general_details')}}</h3>
                <div class="order_detail-top-box">

                  <div class="form-group row widt-100 gendetail-col">
                    <label class="col-12 control-label"><strong>{{trans('lang.date_created')}} : </strong><span id="createdAt"></span></label>
                    <!-- <div class="col-7">
                       <span id="createdAt"></span>
                    </div> -->
                  </div>

                 <!--  <div class="form-group row widt-100 gendetail-col"> -->
                  <div class="form-group row widt-100 gendetail-col payment_method">
                    <label class="col-12 control-label"><strong>{{trans('lang.payment_methods')}}: </strong><span id="payment_method"></span></label>
                    <!-- <div class="col-7">
                       <span id="payment_method"></span>
                    </div> -->
                  </div>

                  <div class="form-group row widt-100 gendetail-col">
                    <label class="col-12 control-label"><strong>{{trans('lang.order_type')}}:</strong> <span id="order_type"></span></label>
                  </div>

                  <div class="form-group row width-100 ">
                    <label class="col-3 control-label">{{trans('lang.status')}}:</label>
                    <div class="col-7">
                      <select id= "order_status" class="form-control">
                          <option value="Order Placed" id="order_placed">{{ trans('lang.order_placed')}}</option>
                          <option value="Order Accepted" id="order_accepted">{{ trans('lang.order_accepted')}}</option>
                          <option value="Order Rejected" id="order_rejected">{{ trans('lang.order_rejected')}}</option>
                          <option value="Driver Pending" id="driver_pending">{{ trans('lang.driver_pending')}}</option>
                          <option value="Driver Rejected" id="driver_rejected">{{ trans('lang.driver_rejected')}}</option>
                          <option value="Order Shipped" id="order_shipped">{{ trans('lang.order_shipped')}}</option>
                          <option value="In Transit" id="in_transit">{{ trans('lang.in_transit')}}</option>
                          <option value="Order Completed" id="order_completed">{{ trans('lang.order_completed')}}</option>
                      </select>
                   </div>
                  </div>

                  <!-- <div class="form-group row width-100">
                  <label class="col-3 control-label">Customer:</label>
                   <div class="col-7">
                    <select id="coupon_discount_type" class="form-control">
                    <option vale="percent">Completed</option>
                    <option value="fixed">Cancelled</option>
                    <option value="fixed">Cancelled</option>
                    <option value="fixed">Cancelled</option>
                    <option value="fixed">Cancelled</option>
                    <option value="fixed">Cancelled</option>
                  </select>
                   </div>
                  </div> -->
                  <div class="form-group row width-100">
                    <label class="col-3 control-label"></label>
                    <div class="col-7 text-right">
                     <button type="button" class="btn btn-primary save_order_btn" ><i class="fa fa-save"></i> {{trans('lang.update')}}</button>
                   </div>
                  </div>
                </div>

              </div>

              <div class="order_edit-genrl col-md-4">
                <h3>{{ trans('lang.billing_details')}}</h3>

                  <div class="address order_detail-top-box">
										<div class="address order_detail-top-box">
											<div class="form-group row widt-100 gendetail-col">
													<label class="col-12 control-label"><strong>{{trans('lang.name')}}
																	: </strong><span id="billing_name"></span></label>

											</div>
											<div class="form-group row widt-100 gendetail-col">
													<label class="col-12 control-label"><strong>{{trans('lang.address')}}
																	: </strong><span id="billing_line1"></span>  <span id="billing_line2"></span><span id="billing_country"></span></label>

											</div>

											<div class="form-group row widt-100 gendetail-col">
													<label class="col-12 control-label"><strong>{{trans('lang.email_address')}}
																	: </strong><span id="billing_email"></span></label>

											</div>
                  
                    <p><strong>{{trans('lang.phone')}}:</strong>
                      <span id="billing_phone"></span>
                    </p>
                  </div>
              </div>

              <div class="order_addre-edit col-md-4 driver_details_hide">
                <h3>{{ trans('lang.driver_detail')}}</h3>

                <div class="address order_detail-top-box">
                  <p>
                      <span id="driver_firstName"></span> <span id="driver_lastName"></span><br>
                  </p>
                  <p><strong>{{trans('lang.email_address')}}:</strong>
                       <span id="driver_email"></span>
                  </p>
                  <p><strong>{{trans('lang.phone')}}:</strong>
                    <span id="driver_phone"></span>
                  </p>
                  <p><strong>{{trans('lang.car_name')}}:</strong>
                    <span id="driver_carName"></span>
                  </p>
                  <p><strong>{{trans('lang.car_number')}}:</strong>
                    <span id="driver_carNumber"></span>
                  </p>
                </div>
              </div>

            </div>

          </div>



        <div class="order-deta-btm mt-4">
          <div class="row">
            <div class="col-md-8 order-deta-btm-left">
          <div class="order-items-list ">
            <div class="row">
              <div class="col-md-12">
                <table cellpadding="0" cellspacing="0" class="table table-striped table-valign-middle">

                   <thead>
                     <tr>
                      <th>{{trans('lang.from')}}</th>
                      <th>{{trans('lang.to')}}</th>
                      <th>{{trans('lang.price')}}</th>
                      <!-- <th>{{trans('lang.qty')}}</th> -->
                      <!-- <th>{{trans('lang.extras')}}</th> -->
                      <th>{{trans('lang.total')}}</th>
                    </tr>

                  </thead>

                  <tbody id="order_products">
                    <!-- <div id="order_products"></div> -->
                   <?php /*<tr>
                       <td class="order-product">
                          <div class="order-product-box">
                          <img class="img-circle img-size-32 mr-2" style="width:60px;height:60px;" src="https://firebasestorage.googleapis.com/v0/b/itemies-3c1d9.appspot.com/o/images%2FovRQ5Opxe6gIOjO7YrvyUfFVADU2.png?alt=media&amp;token=7a11b826-0d55-4ba5-bd03-a67a3bdb6361" alt="image">
                          </div>
                          <div class="woo-orders-tracking-container">
                            <h6>Product Name</h6>
                              <div class="woo-orders-tracking-item-details">
                                  <div class="woo-orders-tracking-item-tracking-code-label">
                                      <span >Tracking number</span>
                                  </div>
                                  <div class="woo-orders-tracking-item-tracking-code-value" title="Tracking carrier Fedex">
                                      <!-- <a href="http://162.241.125.167/~oleumvitae/orders-tracking/?tracking_id=1234567812345" target="_blank">1234567812345</a> -->
                                      <span id="trackng_number" ></span>
                                  </div>
                                  <div class="woo-orders-tracking-item-tracking-button-edit-container">
                                   <a href="#"><i class="fa fa-edit"></i></a>

                                  </div>
                              </div>
                            </div>
                        </td>
                        <td>$172.00</td>
                        <td>× 1</td>
                        <td>$172.00</td>
                    </tr> */ ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="order-data-row order-totals-items">
            <div class="row">
              <div class="col-md-12">
                 <table class="order-totals">

                    <tbody id="order_products_total">
                        <!-- <tr>
                            <td class="label">Items Subtotal:</td>
                            <td class="total">
                              $ 172.00
                            </td>
                          </tr>
                        <tr>
                            <td class="label">Shipping:</td>
                            <td class="total">
                              $ 10.00</td>
                          </tr>
                        <tr>
                          <td class="label">Order Total:</td>
                          <td class="total">
                            $ 182.00 </td>
                        </tr>

                         <tr class="paid">
                          <td class="label">Paid</td>
                          <td class="total">
                            $ 182.00</td>
                        </tr> -->

                  </tbody>
                </table>
              </div>
            </div>
         </div>
        </div>

         <div class="col-md-4 order-deta-btm-right">
            <div class="resturant-detail">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-header-title">{{trans('lang.driver_detail')}}</h4>
                </div>

                <div class="card-body">
                  <a href="#" class="row redirecttopage" id="resturant-view">
                    <div class="col-4">
                      <img src="" class="resturant-img rounded-circle" alt="driver" width="70px" height="70px">
                    </div>
                    <div class="col-8">
                      <h4 class="vendor-title"></h4>
                    </div>
                  </a>

                  <h5 class="contact-info">{{trans('lang.contact_info')}}:</h5>
                   <!-- <p><strong>{{trans('lang.email_address')}}:</strong>
                       <span id="vendor_email"></span>
                    </p> -->
                    <p><strong>{{trans('lang.phone')}}:</strong>
                      <span id="vendor_phone"></span>
                    </p>
                    <h5 class="contact-info">{{trans('lang.car_info')}}:</h5>
                    <a href="#" class="row redirecttopage" id="car-view">
                    <div class="col-4">
                      <img src="" class="car-img rounded-circle" alt="car" width="70px" height="70px">
                    </div>

                  </a>
                   <br>
                   <p ><strong style="width:auto !important;">{{trans('lang.car_name')}}:</strong>
                    <span id="driver_carName"></span>
                  </p> <br>
                  <p ><strong style="width:auto !important;">{{trans('lang.car_number')}}:</strong>
                    <span id="driver_carNumber"></span>
                  </p> <br>
                  <p ><strong style="width:auto !important;">{{trans('lang.car_make')}}:</strong>
                    <span id="driver_car_make"></span>
                  </p>

                </div>
             </div>
            </div>
         </div>

        </div>
        </div>

       </div>

      </div>





   <!--  </div> -->


            <div class="form-group col-12 text-center btm-btn">
          <button type="button" class="btn btn-primary save_order_btn" ><i class="fa fa-save"></i> {{trans('lang.save')}}</button>

          <?php if(isset($_GET['eid']) && $_GET['eid'] != ''){?>
              <a href="{{route('vendors.orders',$_GET['eid'])}}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
          <?php }else{ ?>
             <a href="javascript:window.history.go(-1);" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
          <?php } ?>

          <!-- <a href="{!! route('orders') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a> -->
      </div>

      </div>



          </div>
        </div>


 @endsection

@section('style')
<style type="text/css">

</style>
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.js"></script>
<script>
var adminCommission=0;
var id_rendom = "<?php echo uniqid();?>";
var id = "<?php echo $id;?>";
var driverId='';
var fcmToken='';
var old_order_status='';
var payment_shared=false;
var deliveryChargeVal = 0;
var tip_amount_val = 0;
var tip_amount=0;
var vendorname='';
var database = firebase.firestore();
var ref = database.collection('rides').where("id","==",id);
var append_procucts_list = '';
var append_procucts_total = '';
var total_price=0;
var currentCurrency = '';
var currencyAtRight = false;
var refCurrency = database.collection('currencies').where('isActive', '==' , true);
var orderPreviousStatus = '';
var orderTakeAwayOption = false;
var manfcmTokenVendor='';
var manname='';
refCurrency.get().then( async function(snapshots){
    var currencyData = snapshots.docs[0].data();
    currentCurrency = currencyData.symbol;
    currencyAtRight = currencyData.symbolAtRight;
});


var geoFirestore = new GeoFirestore(database);
var place_image ='';
var ref_place = database.collection('settings').doc("placeHolderImage");
 ref_place.get().then( async function(snapshots){

    var placeHolderImage = snapshots.data();
    place_image = placeHolderImage.image;
  //  console.log('place_image'+place_image);

});

$(document).ready(function(){

    var alovelaceDocumentRef = database.collection('vendor_orders').doc();
    if(alovelaceDocumentRef.id){
        id_rendom=alovelaceDocumentRef.id;
    }
    $(document.body).on('click', '.redirecttopage' ,function(){
        var url=$(this).attr('data-url');
        window.location.href = url;
    });

    jQuery("#data-table_processing").show();

    ref.get().then( async function(snapshots){
    var ride = snapshots.docs[0].data();

    append_procucts_list = document.getElementById('order_products');
    append_procucts_list.innerHTML='';

    append_procucts_total = document.getElementById('order_products_total');
    append_procucts_total.innerHTML='';


    $("#billing_name").text(ride.author.shippingAddress.name);
    var billingAddressstring = '';

    $("#trackng_number").text(id);
    if(ride.author.shippingAddress.hasOwnProperty('line1')){
      $("#billing_line1").text(ride.author.shippingAddress.line1);
    }
    if(ride.author.shippingAddress.hasOwnProperty('line2')){
      billingAddressstring = billingAddressstring + ride.author.shippingAddress.line2;
    }
    if(ride.author.shippingAddress.hasOwnProperty('city')){
      billingAddressstring = billingAddressstring+", "+ ride.author.shippingAddress.city;
    }

    if(ride.author.shippingAddress.hasOwnProperty('postalCode')){
      billingAddressstring = billingAddressstring+", "+ ride.author.shippingAddress.postalCode;
    }

    if(ride.author.hasOwnProperty('phoneNumber')){
      $("#billing_phone").text(ride.author.phoneNumber);
    }

    $("#billing_line2").text(billingAddressstring);

    if(ride.author.shippingAddress.hasOwnProperty('country')){

      $("#billing_country").text(ride.author.shippingAddress.country);

    }

    if(ride.author.shippingAddress.hasOwnProperty('email')){
      $("#billing_email").html('<a href="mailto:'+ride.author.shippingAddress.email+'">'+ride.author.shippingAddress.email+'</a>');
    }

    if (ride.createdAt) {
        var date1 = ride.createdAt.toDate().toDateString();
        var date = new Date(date1);
        var dd = String(date.getDate()).padStart(2, '0');
        var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = date.getFullYear();
        var createdAt_val = yyyy + '-' + mm + '-' + dd;
        var time = ride.createdAt.toDate().toLocaleTimeString('en-US');
        //console.log('time'+time);
      $('#createdAt').text(createdAt_val+' '+time);
    }

    if (ride.payment_method) {

      if (ride.payment_method == 'cod') {
        $('#payment_method').text('{{trans("lang.cash_on_delivery")}}');
      } else if(ride.payment_method == 'paypal') {
        $('#payment_method').text('{{trans("lang.paypal")}}');
      }else{
        $('#payment_method').text(ride.payment_method);
      }

    }
    if(ride.hasOwnProperty('takeAway') && ride.takeAway){
      $('#driver_pending').hide();
      $('#driver_rejected').hide();
      $('#order_shipped').hide();
      $('#in_transit').hide();
      $('#order_type').text('{{trans("lang.order_takeaway")}}');
      $('.payment_method').hide();
      orderTakeAwayOption = true;

    }else{
      $('#order_type').text('{{trans("lang.order_delivery")}}');
      $('.payment_method').show();

    }

    if ((ride.driver!='' && ride.driver!=undefined ) && (ride.takeAway) ) {

      $('#driver_carName').text(ride.driver.carName);
      $('#driver_carNumber').text(ride.driver.carNumber);
      $('#driver_email').html('<a href="mailto:'+ride.driver.email+'">'+ride.driver.email+'</a>');
      $('#driver_firstName').text(ride.driver.firstName);
      $('#driver_lastName').text(ride.driver.lastName);
      $('#driver_phone').text(ride.driver.phoneNumber);

    }else{
      $('.order_edit-genrl').removeClass('col-md-4').addClass('col-md-6');
      $('.order_addre-edit').removeClass('col-md-4').addClass('col-md-6');
      $('.driver_details_hide').empty();

    }

    if (ride.driverID != '' && ride.driverID != undefined) {
        driverId = ride.driverID;
    }
    if (ride.vendor && ride.vendor.author != '' && ride.vendor.author != undefined) {
        vendorAuthor = ride.vendor.author;
    }
    fcmToken=ride.author.fcmToken;
		if (ride.driver!=undefined) {
			drivername=ride.driver.firstName;
		}else{
			drivername='';
		}



    customername = ride.author.firstName;

    driverID = ride.driverID;
    old_order_status=ride.status;
    if(ride.payment_shared!=undefined){
        payment_shared = ride.payment_shared;
    }
    var productsListHTML=buildHTMLProductsList(snapshots);
   var productstotalHTML=buildHTMLProductstotal(ride);

     if(productsListHTML!=''){
        append_procucts_list.innerHTML=productsListHTML;
     }

     if(productstotalHTML!=''){
        append_procucts_total.innerHTML=productstotalHTML;
     }

  // var address =

    orderPreviousStatus = ride.status;
    if (ride.hasOwnProperty('payment_method')) {
        orderPaymentMethod = ride.payment_method;
    }

    // $(".order_id").val(ride.id);
    // $(".client_name").val(ride.author.firstName+' '+ride.author.lastName);
    $("#order_status option[value='"+ride.status+"']").attr("selected","selected");
    if(ride.status=="Order Rejected" || ride.status=="Driver Rejected"){
      $("#order_status").prop("disabled", true);
    }
    var price = 0;


    // $(".order_price").val(price);
    // $("#order_status").val(ride.status);
    // $(".order_vendor").val(ride.vendor.title);



   if (ride.driverID) {
     var driver = database.collection('users').where("id","==",ride.driverID);

     driver.get().then( async function(snapshotsnew){
       var driverdata = snapshotsnew.docs[0].data();

         if (driverdata.id) {
             var route_view =  '{{route("drivers.view",":id")}}';
               route_view = route_view.replace(':id', driverdata.id);

             $('#resturant-view').attr('data-url',route_view);
         }
         if (driverdata.profilePictureURL) {
             $('.resturant-img').attr('src',driverdata.profilePictureURL);
         }else{
             $('.resturant-img').attr('src',place_image);
         }
         if (driverdata.firstName) {
             $('.vendor-title').html(driverdata.firstName+' '+driverdata.lastName);
         }

          if (driverdata.email) {
              $('#vendor_email').html(driverdata.email);
          }
         if (driverdata.phoneNumber) {
             $('#vendor_phone').text(driverdata.phoneNumber);
          }
          if (driverdata.id) {
             var route_view =  '{{route("drivers.view",":id")}}';
               route_view = route_view.replace(':id', driverdata.id);

             $('#resturant-car').attr('data-url',route_view);
         }
         if (driverdata.carPictureURL) {
             $('.car-img').attr('src',driverdata.carPictureURL);
         }else{
             $('.car-img').attr('src',place_image);
         }
         if (driverdata.carName) {
             $('#driver_carName').html(driverdata.carName);
         }

          if (driverdata.carNumber) {
              $('#driver_carNumber').html(driverdata.carNumber);
          }
         if (driverdata.carMakes) {
             $('#driver_car_make').text(driverdata.carMakes);
          }

     });

    }
    ref.get().then( async function(snapshotsride){

      snapshotsride.docs.forEach((listval) => {
    database.collection('rides').where('id','==',listval.id).where("status","in",["Order Completed"]).get().then( async function(orderSnapshots){
            var count_order_complete=orderSnapshots.docs.length;
            // database.collection('users').doc(listval.id).update({'orderCompleted':count_order_complete}).then(function(result) {

            //  });

        });

    });
});

       jQuery("#data-table_processing").hide();
  })


$(".save_order_btn").click(async function(){

  var clientName = $(".client_name").val();
  var orderStatus = $("#order_status").val();
  if(old_order_status!=orderStatus){
        database.collection('rides').doc(id).update({'status':orderStatus}).then( async function(result) {

              if(orderStatus=="Order Completed"){
                  //manfcmTokenVendor = fcmTokenVendor;
                  manname = customername;
              }else{
                  manfcmTokenRide = fcmToken;
                  manname = drivername;
              }
              if (orderStatus != orderPreviousStatus && payment_shared==false) {
                  if (orderStatus == 'Order Completed') {

                  vendorAmount=parseFloat(total_price) + (parseFloat(adminCommission));
                  driverAmount=parseFloat(deliveryChargeVal) - parseFloat(tip_amount);
                  var vendor = database.collection('users').where("driverID", "==", driverID);
                  var vendorWallet = 0;
                  await database.collection('order_transactions').doc(id_rendom).set({'date': vendorWallet,'driverAmount':driverAmount,'driverId':driverID,'id':id_rendom,'order_id':id}).then( async function (result) {
                          // await vendor.get().then(async function (snapshotsnew) {
                          //     var vendordata = snapshotsnew.docs[0].data();
                          //     if(vendordata){
                          //         if(isNaN(vendordata.wallet_amount) || vendordata.wallet_amount==undefined){
                          //             vendorWallet=0;
                          //         }else{
                          //             vendorWallet=parseFloat(vendordata.wallet_amount);
                          //         }
                          //         if(orderPaymentMethod == 'cod' && orderTakeAwayOption == true){
                          //             vendorWallet=vendorWallet-parseFloat(adminCommission);
                          //         }else{
                          //             vendorWallet=vendorWallet+parseFloat(vendorAmount);
                          //         }

                          //         if(!isNaN(vendorWallet)){
                          //           database.collection('users').doc(vendordata.id).update({'wallet_amount': vendorWallet}).then(function (result) {

                          //         });
                          //         }

                          //     }
                          // });
                      if(driverId && driverAmount){
                          var driver = database.collection('users').where("id", "==", driverId);
                          await driver.get().then(async function (snapshotsdriver) {
                              var driverdata = snapshotsdriver.docs[0].data();
                              if(driverdata){
                                  if(isNaN(driverdata.wallet_amount) || driverdata.wallet_amount==undefined){
                                      driverWallet=0;
                                  }else{
                                      driverWallet=driverdata.wallet_amount;
                                  }
                                  if(orderPaymentMethod == 'cod' && orderTakeAwayOption == true){
                                      driverWallet=driverWallet-parseFloat(total_price)-parseFloat(driverAmount);
                                  }else{
                                      driverWallet=driverWallet+driverAmount;
                                  }
                                  if(!isNaN(vendorWallet)){
                                    await database.collection('users').doc(driverdata.id).update({'wallet_amount': driverWallet}).then( async function (result) {

                                    });
                                  }

                              }
                          })
                      }
                  });

                  await database.collection('rides').doc(id).update({'payment_shared':true}).then( async function (result) {
                  });
              }

              await $.ajax({
                  type: 'POST',
                  url: "<?php echo route('order-status-notification'); ?>",
                  data: {
                      _token: '<?php echo csrf_token() ?>',
                      'fcm': manfcmTokenVendor,
                      'drivername': manname,
                      'orderStatus': orderStatus
                  },
                  success: function (data) {

                      if (orderPreviousStatus != 'Order Rejected' && orderPreviousStatus != 'Driver Rejected' && orderPaymentMethod != 'cod' && orderTakeAwayOption == false) {
                          if (orderStatus == 'Order Rejected' || orderStatus == 'Driver Rejected') {
                              var walletId = "<?php echo uniqid();?>";
                              var canceldateNew = new Date();
                              var orderCancelDate = new Date(canceldateNew.setHours(23, 59, 59, 999));
                              database.collection('wallet').doc(walletId).set({
                                  'amount': parseFloat(orderPaytableAmount),
                                  'date': orderStatus,
                                  'id': walletId,
                                  'payment_status': 'success',
                                  'user_id': orderCustomerId,
                                  'payment_method': 'Cancelled Order Payment'
                              }).then(function (result) {
                                  window.location.href = '{{ route("orders")}}';
                              })
                          } else {

                              window.location.href = '{{ route("orders")}}';
                          }
                      } else {
                          window.location.href = '{{ route("orders")}}';
                      }

                  }
              });

              }

                await $.ajax({
                 type:'POST',
                 url:"<?php echo route('order-status-notification'); ?>",
                 data:{_token:'<?php echo csrf_token() ?>','fcm':fcmToken,'drivername':drivername,'orderStatus':orderStatus},
                 success:function(data) {
                    <?php if(isset($_GET['eid']) && $_GET['eid'] != ''){?>
                         window.location.href = "{{ route('driver.ride',$_GET['eid']) }}";
                    <?php }else{ ?>
                         window.location.href = '{{ route("rides")}}';
                    <?php } ?>
                 }
               });

        });
 }

})

})

function buildHTMLProductsList(snapshots){
        var html='';
        var alldata=[];
        var number= [];
        snapshots.docs.forEach((listval) => {
            var datas=listval.data();
            datas.id=listval.id;
            alldata.push(datas);
        });



        var count = 0;
        alldata.forEach((listval) => {

            var val=listval;
          console.log(val);


                html=html+'<tr>';

                // var extra_html='';
                // if(val.extras!=undefined && val.extras!='' && val.extras.length>0){
                //   extra_html=extra_html+'<span>';
                //   var extra_count=1;
                //   try{
                //     val.extras.forEach((extra) => {

                //     if(extra_count>1){
                //       extra_html=extra_html+','+extra;
                //      }else{
                //       extra_html=extra_html+extra;
                //      }
                //     extra_count++;
                //   })
                // }catch(error){

                // }

                //   extra_html=extra_html+'</span>';
                // }

                // html=html+'<td class="order-product"><div class="order-product-box">';


                // if(val.photo != ''){
                //   html=html +'<img class="img-circle img-size-32 mr-2" style="width:60px;height:60px;" src="'+val.photo+'" alt="image">';
                // }else{
                //   html=html +'<img class="img-circle img-size-32 mr-2" style="width:60px;height:60px;" src="'+place_image+'" alt="image">';
                // }

                // html=html+'</div><div class="orders-tracking"><h6>'+val.sourceLocationName+'</h6><div class="orders-tracking-item-details">';
                // if(extra_count>1 || val.size){
                //   html=html+'<strong>{{trans("lang.extras")}} :</strong>';
                // }
                // if(extra_count>1){
                //    html=html+'<div class="extra"><span>{{trans("lang.extras")}} :</span><span class="ext-item">'+extra_html+'</span></div>';
                // }
                if(val.size){
                   html=html+'<div class="type"><span>{{trans("lang.type")}} :</span><span class="ext-size">'+val.size+'</span></div>';
                }

                /*<div class="woo-orders-tracking-item-tracking-button-edit-container"><a href="#"><i class="fa fa-edit"></i></a></div>*/

                //price_item=parseFloat(val.price).toFixed(2);
                /*if(val.hasOwnProperty('discountPrice') && val.discountPrice != ''){
                    price_item=parseFloat(val.discountPrice).toFixed(2);
                }else{*/
                    price_item=parseFloat(val.subTotal).toFixed(2);
                /*}*/
                totalProductPrice =   price_item;
                var extras_price=0;
                // if(val.extras!=undefined && val.extras!='' && val.extras.length>0){
                //   extras_price_item=(parseFloat(val.extras_price)*parseInt(val.quantity)).toFixed(2);
                //   if(parseFloat(extras_price_item)!=NaN && val.extras_price!=undefined){
                //       extras_price=extras_price_item;
                //   }
                //   totalProductPrice =parseFloat(extras_price)+parseFloat(totalProductPrice);
                // }
                totalProductPrice=parseFloat(totalProductPrice).toFixed(2);

                if(currencyAtRight){
                    price_val = price_item+""+currentCurrency;
                    extras_price_val = extras_price+""+currentCurrency;
                    totalProductPrice_val = totalProductPrice+""+currentCurrency;
                }else{
                   price_val = currentCurrency+""+price_item;
                  extras_price_val = currentCurrency+""+extras_price;
                   totalProductPrice_val = currentCurrency+""+totalProductPrice;
                }

                html=html+'</div></div></td>';
                html=html+'<td>'+val.sourceLocationName+'</td><td>'+val.destinationLocationName+'</td><td>'+price_val+'</td><td>  '+totalProductPrice_val+'</td>';

                html=html+'</tr>';
                total_price +=parseFloat(totalProductPrice);
          });
          totalProductPrice=0;

        return html;
      }





      function buildHTMLProductstotal(snapshotsProducts){
        var html='';
        var alldata=[];
        var number= [];
        var adminCommission = snapshotsProducts.adminCommission;
        var adminCommissionType = snapshotsProducts.adminCommissionType;
        var discount = snapshotsProducts.discount;
        var couponCode = snapshotsProducts.couponCode;
        var extras = snapshotsProducts.extras;
        var extras_price = snapshotsProducts.extras_price;
        var rejectedByDrivers = snapshotsProducts.rejectedByDrivers;
        var tip_amount = snapshotsProducts.tip_amount;
        var notes = snapshotsProducts.notes;
        // var tax_amount = snapshotsProducts.vendor.tax_amount;
        var status = snapshotsProducts.status;
        var products = snapshotsProducts.products;
        var deliveryCharge = snapshotsProducts.vehicleType.delivery_charges_per_km;
    //   var totalProductPrice=snapshotsProducts.subTotal;

        var intRegex = /^\d+$/;
        var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;

        if (products) {

          products.forEach((product) => {

              var val=product;
              console.log(product);

              /*if(intRegex.test(val.addon_price) || floatRegex.test(val.addon_price)) {
                total_price +=val.addon_price;
              }*/
              // if(intRegex.test(val.price) || floatRegex.test(val.price)) {
              //   total_price +=parseInt(val.price)*parseInt(val.quantity);
              // }
             /* if (val.addon_name && val.addon_price) {
                html=html+'<tr><td class="label">Addon : '+val.addon_name+'</td><td class="total">'+val.addon_price+'</td></tr>';
              }*/
          });
        }
          /*if (extras) {
            var extra_val='';
            extras.forEach((extra) => {
              extra_val += extra+',';
            });

            html=html+'<tr><td class="label">Extras : '+extra_val+'</td><td class="total">'+extras_price+'</td></tr>';
          }*/

					if(currencyAtRight){
							total_price_val = total_price+""+currentCurrency;
					}else{
						 total_price_val = currentCurrency+""+total_price;
					}
					html=html+'<tr><td class="label">{{trans("lang.total")}}</td><td>	'+total_price_val+'</td></tr>';



          if(intRegex.test(discount) || floatRegex.test(discount)) {

            discount=parseFloat(discount).toFixed(2);
            total_price -=parseFloat(discount);

            if(currencyAtRight){
                discount_val = discount+""+currentCurrency;
            }else{
               discount_val = currentCurrency+""+discount;
            }

            couponCode_html='';
            if (couponCode) {
              couponCode_html='</br><small>{{trans("lang.coupon_codes")}} :'+couponCode+'</small>';
            }
            html=html+'<tr><td class="label">{{trans("lang.discount")}}'+couponCode_html+'</td><td class="discount">-'+discount_val+'</td></tr>';
          }




            var tax = 0;
            taxlabel = '';
            taxlabeltype = '';
            try{
              if(snapshotsProducts.tax){
                  if(snapshotsProducts.taxType && snapshotsProducts.tax){
                      if(snapshotsProducts.taxType=="percent"){
                          tax=(snapshotsProducts.tax*total_price)/100;
                          taxlabeltype="%";
                      }else{
                          tax=snapshotsProducts.tax;
                          taxlabeltype="fix";
                      }
                      // taxlabel = snapshotsProducts.taxSetting.label;
                  }
              }
            }catch(error){

            }
             if(!isNaN(tax) && tax!=0){
              var tax_fixed =parseFloat(tax) .toFixed(2)
                if(currencyAtRight){
                  html=html+'<tr><td class="label">{{trans("lang.tax")}}</td><td class="deliveryCharge">+'+tax_fixed+''+currentCurrency+'('+snapshotsProducts.tax+' '+taxlabeltype+')</td></tr>';
                }else{
                  html=html+'<tr><td class="label">{{trans("lang.tax")}}</td><td class="deliveryCharge">+'+currentCurrency+tax_fixed+'( '+snapshotsProducts.tax +' '+taxlabeltype+')</td></tr>';
                }

                total_price = total_price + parseFloat(tax);
								//console.log(total_price);
             }
//console.log(total_price);
          //    if(intRegex.test(deliveryCharge) || floatRegex.test(deliveryCharge)) {
          //       deliveryCharge=parseFloat(deliveryCharge).toFixed(2);
          //       total_price +=parseFloat(deliveryCharge);

          //       if(currencyAtRight){
          //         deliveryCharge_val = deliveryCharge+""+currentCurrency;

          //       }else{
          //          deliveryCharge_val = currentCurrency+""+deliveryCharge;
          //          console.log(deliveryCharge_val);

          //       }
          //       if (deliveryCharge) {
          //           deliveryChargeVal = deliveryCharge;
          //           html=html+'<tr><td class="label">{{trans("lang.deliveryCharge")}}</td><td class="deliveryCharge">+'+deliveryCharge_val+'</td></tr>';
          //       }
          // }

          var total_item_price=total_price;
          if(intRegex.test(tip_amount) || floatRegex.test(tip_amount)) {

              tip_amount=parseFloat(tip_amount).toFixed(2);
              total_price +=parseFloat(tip_amount);
              total_price=parseFloat(total_price).toFixed(2);

                if(currencyAtRight){
                  tip_amount_val = tip_amount+""+currentCurrency;
                }else{
                   tip_amount_val = currentCurrency+""+tip_amount;
                }
                if (tip_amount) {
                    html=html+'<tr><td class="label">{{trans("lang.tip_amount")}}</td><td class="tip_amount_val">+'+tip_amount_val+'</td></tr>';
                }
            }

            if(currencyAtRight){
              total_price_val = parseFloat(total_price).toFixed(2)+""+currentCurrency;
            }else{
               total_price_val = currentCurrency+""+parseFloat(total_price).toFixed(2);
            }

          html=html+'<tr><td class="label">{{trans("lang.total_amount")}}</td><td class="total_price_val">'+total_price_val+'</td></tr>';

          if(adminCommission!=undefined && adminCommissionType!=undefined){
              var commission = 0;
              console.log(total_item_price);
              console.log("total_item_price");
              if(adminCommissionType=="Percent"){
                  commission = (total_item_price*parseFloat(adminCommission))/100;
              }else{
                  commission = parseFloat(adminCommission);
              }
                adminCommission = commission;
            }else if(adminCommission!=undefined){
                var commission = parseFloat(adminCommission);
                adminCommission = commission;
          }

          if (adminCommission) {

            adminCommission = parseFloat(adminCommission).toFixed(2);
            if(currencyAtRight){
              adminCommission_val = adminCommission+""+currentCurrency;
            }else{
               adminCommission_val = currentCurrency+""+adminCommission;
            }
              html=html+'<tr><td class="label"><small>( {{trans("lang.admin_commission")}} </small></td><td class="adminCommission_val"><small>'+adminCommission_val+')</small></td></tr>';
          }

             if (notes) {


              html=html+'<tr><td class="label">{{trans("lang.notes")}}</td><td class="adminCommission_val">'+notes+'</td></tr>';
          }


          return html;
}

</script>

@endsection
