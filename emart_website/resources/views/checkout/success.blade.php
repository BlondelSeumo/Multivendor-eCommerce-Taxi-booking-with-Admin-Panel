@include('layouts.app')



@include('layouts.header')



<div class="siddhi-checkout">





<div class="container position-relative">

<div class="py-5 row">

<div class="col-md-12 mb-3">

<div>



<div class="siddhi-cart-item mb-3 rounded shadow-sm bg-white overflow-hidden">

<div class="siddhi-cart-item-profile bg-white p-3">

<div class="card card-default">

    

    <?php $authorName=@$cart['cart_order']['authorName']; ?>



    @if($message = Session::get('success'))

        <div class="py-5 linus-coming-soon d-flex justify-content-center align-items-center">

            <div class="col-md-6">

            <div class="text-center pb-3">

                <h1 class="font-weight-bold"><?php if(@$authorName){ echo @strtoupper($authorName).","; } ?> {{trans('lang.your_order_has_been_successful')}}</h1>

                <p>Check your order status in <a href="{{route('my_order')}}" class="font-weight-bold text-decoration-none text-primary">{{trans('lang.my_orders')}}</a>
                    {{trans('lang.about_next_steps_information')}}</p>
            </div>



            <div class="bg-white rounded text-center p-4 shadow-sm">

            <h1 class="display-1 mb-4">{{trans('lang.emoji')}}</h1>

                <h6 class="font-weight-bold mb-2">{{trans('lang.preparing_your_order')}}</h6>

                <p class="small text-muted">{{trans('lang.your_order_will_prepared')}}</p>

                <a href="{{route('my_order')}}" class="btn rounded btn-primary btn-lg btn-block">{{trans('lang.view_order')}}</a>

            </div>

            </div>

        </div>



    @endif

</div>



</div>

</div>





</div>

</div>

</div>



</div>

</div>

<div id="data-table_processing_order" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>



@include('layouts.footer')



@include('layouts.nav')



@if($message = Session::get('success'))     

    <script src="https://unpkg.com/geofirestore/dist/geofirestore.js"></script>

<script type="text/javascript">

    var fcmToken='';

    var id_order = "<?php echo uniqid();?>";

    var userId =  "<?php echo $id; ?>";

    var userDetailsRef= database.collection('users').where('id',"==",userId);

    var vendorDetailsRef= database.collection('vendors');

    var uservendorDetailsRef= database.collection('users');

    var AdminCommission = database.collection('settings').doc('AdminCommission');

    var razorpaySettings = database.collection('settings').doc('razorpaySettings');

    var geoFirestore = new GeoFirestore(firestore);



        

        <?php if(@$cart['payment_status']==true && !empty(@$cart['cart_order']['order_json'])){ ?>

        
        $("#data-table_processing_order").show();
        var order_json='<?php echo json_encode($cart['cart_order']['order_json']); ?>';

        order_json=JSON.parse(order_json);

        main_vendor_id=$("#main_vendor_id").val();
         
         uservendorDetailsRef.where('vendorID',"==",order_json.vendorID).get().then( async function(uservendorSnapshots){
            var userVendorDetails = uservendorSnapshots.docs[0].data();
            if(userVendorDetails && userVendorDetails.fcmToken){
                fcmToken=userVendorDetails.fcmToken;
            }
            

        });

        finalCheckout();

        

        function finalCheckout() {
        
        userDetailsRef.get().then( async function(userSnapshots){

            

            var userDetails = userSnapshots.docs[0].data();

            

            

            payment_method='<?php echo $payment_method; ?>';

            console.log(payment_method);

            var vendorID=order_json.vendorID;

            vendorDetailsRef.where('id',"==",vendorID).get().then( async function(vendorSnapshots){

            var vendorDetails=vendorSnapshots.docs[0].data();

            

            var createdAt= firebase.firestore.FieldValue.serverTimestamp();

            if(order_json.take_away=='true'){
                order_json.take_away=true;
            }
            if(order_json.take_away=='false'){
                order_json.take_away=false;
            }
            for (var n = 0; n < order_json.products.length; n++) {
                if(order_json.products[n].photo==null){
                    order_json.products[n].photo="";
                }
                if(order_json.products[n].size==null){
                    order_json.products[n].size="";
                }
                order_json.products[n].quantity=parseInt(order_json.products[n].quantity);
            }
			
			if(order_json.taxSetting.active == 'true'){
				order_json.taxSetting.active = true;
			}
			if(order_json.taxSetting.active == 'false'){
				order_json.taxSetting.active = false;
			}
			order_json.specialDiscount.special_discount = parseInt(order_json.specialDiscount.special_discount);
			order_json.specialDiscount.special_discount_label = parseInt(order_json.specialDiscount.special_discount_label);
			
			console.log(order_json);
			
            database.collection('vendor_orders').doc(id_order).set({'address':userDetails.shippingAddress,
                'author':userDetails,
                'authorID':order_json.authorID,
                'couponCode':order_json.couponCode,
                'couponId':order_json.couponId,
                "createdAt":createdAt,'id':id_order,
                'products':order_json.products,
                'status':order_json.status,
                'vendor':vendorDetails,
                'vendorID':vendorDetails.id,
                'deliveryCharge':order_json.deliveryCharge,
                'tip_amount':order_json.tip_amount,
                'adminCommission':order_json.adminCommission,
                'adminCommissionType':order_json.adminCommissionType,
                'payment_method':payment_method,
                'takeAway':order_json.take_away,
                "tax_label": order_json.tax_label,
                "tax": order_json.tax,
                "taxSetting": order_json.taxSetting,
                "notes": order_json.notes,
                'specialDiscount': order_json.specialDiscount,
                'section_id': order_json.section_id
            }).then(function(result) {
                        console.log(result);
                        console.log("result");    
                         $.ajax({

                           type:'POST',

                           url:"<?php echo route('order-complete'); ?>",

                           data:{_token:'<?php echo csrf_token() ?>','fcm':fcmToken,'authorName':userDetails.firstName},

                           success:function(data) {

                                $("#data-table_processing_order").hide();

                               data=JSON.parse(data);   

                           }

                        }); 



            });

            

            }); 

        });

    } 

<?php } ?>

    </script>

    

@endif