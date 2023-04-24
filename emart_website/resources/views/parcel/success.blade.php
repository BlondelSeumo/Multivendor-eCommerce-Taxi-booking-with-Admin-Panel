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


                                <?php $authorName = @$parcel_cart['cart_order']['authorName'];
                                ?>

                                @if($message = Session::get('success'))

                                <div class="py-5 linus-coming-soon d-flex justify-content-center align-items-center">

                                    <div class="col-md-6">

                                        <div class="text-center pb-3">

                                            <h1 class="font-weight-bold"><?php if (@$authorName) {
                                                    echo @strtoupper($authorName) . ",";
                                                } ?> {{trans('lang.your_parcel_place_successfully')}}</h1>

                                            {{-- <p>Check your order status in <a href="{{route('my_order')}}"
                                                                                  class="font-weight-bold text-decoration-none text-primary">{{trans('lang.my_orders')}}</a>--}}
                                                {{-- {{trans('lang.about_next_steps_information')}}</p>--}}
                                        </div>


                                        <div class="bg-white rounded text-center p-4 shadow-sm">

                                            <h1 class="display-1 mb-4">{{trans('lang.emoji')}}</h1>

                                            {{-- <h6 class="font-weight-bold mb-2">
                                                {{trans('lang.preparing_your_order')}}</h6>--}}

                                            {{-- <p class="small text-muted">
                                                {{trans('lang.your_order_will_prepared')}}</p>--}}

                                            <a href="{{route('parcel_orders')}}"
                                               class="btn rounded btn-primary btn-lg btn-block">{{trans('lang.view_order')}}</a>

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

<div id="data-table_processing_order" class="dataTables_processing panel panel-default" style="display: none;">
    Processing...
</div>


@include('layouts.footer')


@include('layouts.nav')


@if($message = Session::get('success'))

<script src="https://unpkg.com/geofirestore/dist/geofirestore.js"></script>

<script type="text/javascript">

    var fcmToken = '';

    var id_order = "<?php echo uniqid();?>";

    var userId = "<?php echo $id; ?>";

    var userDetailsRef = database.collection('users').where('id', "==", userId);

    var geoFirestore = new GeoFirestore(firestore);

    <?php

    if(@$parcel_cart['payment_status'] == true && !empty(@$parcel_cart['cart_order']['order_json'])){ ?>


    $("#data-table_processing_order").show();
    var order_json = '<?php echo json_encode($parcel_cart['cart_order']['order_json']); ?>';

    order_json = JSON.parse(order_json);

    finalCheckout();

    function finalCheckout() {

        userDetailsRef.get().then(async function (userSnapshots) {


            var userDetails = userSnapshots.docs[0].data();

            payment_method = '<?php echo $payment_method; ?>';

            console.log(payment_method);

            var createdAt = firebase.firestore.FieldValue.serverTimestamp();

            console.log(order_json);
            regex = /^\s*(true|1|on)\s*$/i;

            var isSchedule = regex.test(order_json.isSchedule);
            var sendToDriver = regex.test(order_json.sendToDriver);
            var paymentCollectByReceiver = regex.test(order_json.paymentCollectByReceiver);

            var receiverObject = {
                'address': order_json.receiverAddress,
                'name': order_json.receiverName,
                'phone': order_json.receiverPhone,
            }


            var receiverLatLongObject = {
                'latitude': parseFloat(order_json.receiver_address_lat),
                'longitude': parseFloat(order_json.receiver_address_lng)
            }

            var senderObject = {
                'address': order_json.senderAddress,
                'name': order_json.senderName,
                'phone': order_json.senderPhone,
            }

            var senderLatLongObject = {
                'latitude': parseFloat(order_json.sender_address_lat),
                'longitude': parseFloat(order_json.sender_address_lng)
            }


            var senderPickupDateTime = new Date();
            var receiverPickupDateTime = new Date();

            if (order_json.senderPickupDateTime != null && order_json.receiverPickupDateTime != null) {

                senderPickupDateTime = firebase.firestore.Timestamp.fromDate(new Date(order_json.senderPickupDateTime)).toDate();
                receiverPickupDateTime = firebase.firestore.Timestamp.fromDate(new Date(order_json.receiverPickupDateTime)).toDate();
            }

            var discount = "0";
            var coupon_id = "";
            var discountType = "";
            var discountLabel = "";

            if (order_json.discount != null && order_json.coupon_id != null && order_json.discountType != null && order_json.discountLabel != null) {
                discount = order_json.discount;
                coupon_id = order_json.coupon_id;
                discountType = order_json.discountType;
                discountLabel = order_json.discountLabel;
            }
            var parcelImages = [];
            if (order_json.parcelImages) {
                parcelImages = order_json.parcelImages;
            }

            console.log(userDetails);
            database.collection('parcel_orders').doc(id_order).set({
                'adminCommission': order_json.adminCommission,
                'adminCommissionType': order_json.adminCommissionType,
                'author': userDetails,
                'authorID': order_json.authorID,
                "createdAt": createdAt,
                'discount': discount,
                'discountType': discountType,
                'discountLabel': discountLabel,
                'couponId': coupon_id,
                'distance': order_json.distance,
                'id': id_order,
                'isSchedule': isSchedule,
                'note': order_json.senderNote,
                'parcelWeight': order_json.senderParcelWeightName,
                'parcelWeightCharge': order_json.deliveryCharge,
                'paymentCollectByReceiver': paymentCollectByReceiver,
                'payment_method': order_json.payment_method,
                'receiver': receiverObject,
                'receiverLatLong': receiverLatLongObject,
                'sender': senderObject,
                'senderPickupDateTime': senderPickupDateTime,
                'senderLatLong': senderLatLongObject,
                'receiverPickupDateTime': receiverPickupDateTime,
                'status': order_json.status,
                'subTotal': order_json.subTotal,
                'tax': order_json.tax_amount,
                'taxType': order_json.tax_type,
                'taxLabel': order_json.tax_label,
                'section_id': order_json.section_id,
                'parcelCategoryId': order_json.parcelCategoryId,
                'parcelImages': parcelImages,
                'sendToDriver': sendToDriver,
            }).then(function (result) {

                $.ajax({

                    type: 'POST',

                    url: "<?php echo route('parcel_order_complete'); ?>",

                    data: {
                        _token: '<?php echo csrf_token() ?>',
                        'fcm': fcmToken,
                        'authorName': userDetails.firstName
                    },

                    success: function (data) {

                        $("#data-table_processing_order").hide();

                        data = JSON.parse(data);

                    }

                });

            });

        });

    }

    <?php } ?>

</script>


@endif
