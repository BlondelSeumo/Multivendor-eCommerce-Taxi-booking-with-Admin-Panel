@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.complaints')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                <?php if (isset($_GET['eid']) && $_GET['eid'] != '') { ?>
                    <li class="breadcrumb-item"><a href="{{route('drivers.ride',$_GET['eid'])}}">{{trans('lang.order_plural')}}</a>
                    </li>
                <?php } else { ?>
                    <li class="breadcrumb-item"><a href="{!! route('complaints') !!}">{{trans('lang.complaints')}}</a>
                    </li>
                <?php } ?>

                <li class="breadcrumb-item">{{trans('lang.edit_complaints')}}</li>
            </ol>
        </div>
    </div>

    <div class="card-body">
        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">
            {{trans('lang.processing')}}
        </div>

        <div class="order_detail" id="order_detail">
            <div class="order_detail-top">
                <div class="row">
                    <div class="order_edit-genrl col-md-4">

                        <h3>{{trans('lang.general_details')}}</h3>
                        <div class="order_detail-top-box">

                            <div class="form-group row widt-100 gendetail-col">
                                <label class="col-12 control-label"><strong>{{trans('lang.date_created')}}
                                        : </strong><span id="createdAt"></span></label>
                                <!-- <div class="col-7">
                                   <span id="createdAt"></span>
                                </div> -->
                            </div>

                            <!--  <div class="form-group row widt-100 gendetail-col"> -->
                            <div class="form-group row widt-100 gendetail-col payment_method">
                                <label class="col-12 control-label"><strong>{{trans('lang.item_title')}}: </strong><span
                                            id="title"></span></label>
                                <!-- <div class="col-7">
                                   <span id="payment_method"></span>
                                </div> -->
                            </div>

                            <div class="form-group row widt-100 gendetail-col">
                                <label class="col-12 control-label"><strong>{{trans('lang.vendor_description')}}:</strong>
                                    <span id="description"></span></label>
                            </div>
                            <div class="form-group row widt-100 gendetail-col">
                                <label class="col-12 control-label"><strong>{{trans('lang.rider_name')}}:</strong> <span
                                            id="rider"></span></label>
                            </div>
                            <div class="form-group row width-100 ">
                                <label class="col-3 control-label">{{trans('lang.status')}}:</label>
                                <div class="col-7">
                                    <select id="order_status" class="form-control">
                                        <option value="Initiated" id="Initiated">{{ trans('lang.initiated')}}</option>
                                        <option value="Resolved" id="Resolved">{{ trans('lang.resolved')}}</option>
                                        <option value="Under Investigation" id="Under_investigation">{{
                                            trans('lang.Under_investigation')}}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row width-100">
                                <label class="col-3 control-label"></label>
                                <div class="col-7 text-right">
                                    <button type="button" class="btn btn-primary save_order_btn"><i
                                                class="fa fa-save"></i> {{trans('lang.update')}}
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="order_addre-edit col-md-4 ">
                        <h3>{{ trans('lang.driver_detail')}}</h3>

                        <div class="address order_detail-top-box">
                            <a href="#" class="row redirecttopage" id="resturant-view">
                                <div class="col-4">
                                    <img src="" class="resturant-img rounded-circle" alt="driver" width="70px"
                                         height="70px">
                                </div>

                            </a>
                            <p>
                                <span class="vendor-title" id="driver_firstName"></span> <br>
                            </p>
                            <p><strong>{{trans('lang.email_address')}}:</strong>
                                <span id="driver_email"></span>
                            </p>
                            <p><strong>{{trans('lang.phone')}}:</strong>
                                <span id="driver_phone"></span>
                            </p>

                        </div>
                    </div>
                    <div class="order_addre-edit col-md-4 ">
                        <h3>{{ trans('lang.customer_details')}}</h3>

                        <div class="address order_detail-top-box">
                            <a href="#" class="row redirecttopage" id="resturant-view">
                                <div class="col-4">
                                    <img src="" class="resturant-img-customer rounded-circle" alt="customer"
                                         width="70px" height="70px">
                                </div>

                            </a>
                            <p>
                                <span class="vendor-title-customer" id="customer_firstName"></span> <br>
                            </p>
                            <p><strong>{{trans('lang.email_address')}}:</strong>
                                <span id="customer_email"></span>
                            </p>
                            <p><strong>{{trans('lang.phone')}}:</strong>
                                <span id="customer_phone"></span>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


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
    var adminCommission = 0;
    var id_rendom = "<?php echo uniqid();?>";
    var id = "<?php echo $id;?>";
    var driverId = '';
    var fcmToken = '';
    var customerName = '';
    var old_order_status = '';
    var payment_shared = false;
    var deliveryChargeVal = 0;
    var tip_amount_val = 0;
    var tip_amount = 0;
    var vendorname = '';
    var database = firebase.firestore();
    var ref = database.collection('complaints').where("id", "==", id);
    var append_procucts_list = '';
    var append_procucts_total = '';
    var total_price = 0;
    var currentCurrency = '';
    var currencyAtRight = false;
    var refCurrency = database.collection('currencies').where('isActive', '==', true);
    var orderPreviousStatus = '';
    var orderTakeAwayOption = false;
    var manfcmTokenVendor = '';
    var manname = '';
    refCurrency.get().then(async function (snapshots) {
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;
    });


    var geoFirestore = new GeoFirestore(database);
    var place_image = '';
    var ref_place = database.collection('settings').doc("placeHolderImage");
    ref_place.get().then(async function (snapshots) {

        var placeHolderImage = snapshots.data();
        place_image = placeHolderImage.image;
        //  console.log('place_image'+place_image);

    });

    $(document.body).on('click', '.redirecttopage', function () {
        var url = $(this).attr('data-url');
        window.location.href = url;
    });

    $(document).ready(function () {

        var alovelaceDocumentRef = database.collection('vendor_orders').doc();
        if (alovelaceDocumentRef.id) {
            id_rendom = alovelaceDocumentRef.id;
        }

        jQuery("#data-table_processing").show();

        ref.get().then(async function (snapshots) {
            var ride = snapshots.docs[0].data();

            if (ride.createdAt) {
                var date1 = ride.createdAt.toDate().toDateString();
                var date = new Date(date1);
                var dd = String(date.getDate()).padStart(2, '0');
                var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = date.getFullYear();
                var createdAt_val = yyyy + '-' + mm + '-' + dd;
                var time = ride.createdAt.toDate().toLocaleTimeString('en-US');

                $('#createdAt').text(createdAt_val + ' ' + time);
            }

            if (ride.title) {
                $('#title').text(ride.title);
            }
            if (ride.description) {
                $('#description').text(ride.description);
            }
            if (ride.riderName) {
                $('#rider').text(ride.riderName);
            }
            driverID = ride.driverID;
            old_order_status = ride.status;

            orderPreviousStatus = ride.status;
            if (ride.status) {
                orderPaymentMethod = ride.status;
            }

            $("#order_status option[value='" + ride.status + "']").attr("selected", "selected");

            var price = 0;

            var customerId = ride.customerId;

            $('#customer_firstName').text(ride.customerName);
            customerName = ride.customerName;

            var user = await database.collection('users').where("id", "==", customerId).get().then(async function (usersnapshots) {
                var userData = usersnapshots.docs[0].data();

                if (userData.profilePictureURL) {
                    $('.resturant-img-customer').attr('src', userData.profilePictureURL);
                } else {
                    $('.resturant-img-customer').attr('src', place_image);
                }

                if (userData.email) {
                    $('#customer_email').html(userData.email);
                }
                if (userData.phoneNumber) {
                    $('#customer_phone').text(userData.phoneNumber);
                }

                fcmToken = userData.fcmToken;

            });

            if (ride.driverId) {
                var driver = database.collection('users').where("id", "==", ride.driverId);
                driver.get().then(async function (snapshotsnew) {
                    var driverdata = snapshotsnew.docs[0].data();

                    if (driverdata.id) {
                        var route_view = '{{route("drivers.view",":id")}}';
                        route_view = route_view.replace(':id', driverdata.id);

                        $('#resturant-view').attr('data-url', route_view);
                    }
                    if (driverdata.profilePictureURL) {
                        $('.resturant-img').attr('src', driverdata.profilePictureURL);
                    } else {
                        $('.resturant-img').attr('src', place_image);
                    }
                    if (driverdata.firstName) {
                        $('.vendor-title').text(driverdata.firstName + ' ' + driverdata.lastName);
                    }

                    if (driverdata.email) {
                        $('#driver_email').html(driverdata.email);
                    }
                    if (driverdata.phoneNumber) {
                        $('#driver_phone').text(driverdata.phoneNumber);
                    }
                });

            }
            if (ride.riderId) {
                console.log(ride.riderName)
                var driver = database.collection('users').where("id", '==', ride.riderId);
                driver.get().then(async function (snapshotsnew) {
                    var driverdata = snapshotsnew.docs[0].data();


                    if (driverdata.profilePictureURL) {
                        $('.resturant-img-customer').attr('src', driverdata.profilePictureURL);
                    } else {
                        $('.resturant-img-customer').attr('src', place_image);
                    }
                    if (driverdata.firstName) {
                        $('.vendor-title-customer').text(driverdata.firstName + ' ' + driverdata.lastName);
                    }

                    if (driverdata.email) {
                        $('#customer_email').html(driverdata.email);
                    }
                    if (driverdata.phoneNumber) {
                        $('#customer_phone').text(driverdata.phoneNumber);
                    }

                });

            }

            jQuery("#data-table_processing").hide();
        })

    })

    $(".save_order_btn").click(async function () {

        var orderStatus = $("#order_status").val();
        if (old_order_status != orderStatus) {
            database.collection('complaints').doc(id).update({'status': orderStatus}).then(async function (result) {

                if (orderStatus != 'Initiated') {
                    await $.ajax({
                        type: 'POST',
                        url: "<?php echo route('complaint_notification'); ?>",
                        data: {
                            _token: '<?php echo csrf_token() ?>',
                            'fcm': fcmToken,
                            'orderStatus': orderStatus
                        },
                        success: function (data) {

                            window.location.href = '{{ route("complaints")}}';

                        }
                    });
                }

            });
        }

    })


    function buildHTMLProductsList(snapshots) {
        var html = '';
        var alldata = [];
        var number = [];
        snapshots.docs.forEach((listval) => {
            var datas = listval.data();
            datas.id = listval.id;
            alldata.push(datas);
        });


        var count = 0;
        alldata.forEach((listval) => {

            var val = listval;
            console.log(val);


            html = html + '<tr>';

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
            if (val.size) {
                html = html + '<div class="type"><span>{{trans("lang.type")}} :</span><span class="ext-size">' + val.size + '</span></div>';
            }

            /*<div class="woo-orders-tracking-item-tracking-button-edit-container"><a href="#"><i class="fa fa-edit"></i></a></div>*/

            //price_item=parseFloat(val.price).toFixed(2);
            /*if(val.hasOwnProperty('discountPrice') && val.discountPrice != ''){
                price_item=parseFloat(val.discountPrice).toFixed(2);
            }else{*/
            price_item = parseFloat(val.subTotal).toFixed(2);
            /*}*/
            totalProductPrice = price_item;
            var extras_price = 0;
            // if(val.extras!=undefined && val.extras!='' && val.extras.length>0){
            //   extras_price_item=(parseFloat(val.extras_price)*parseInt(val.quantity)).toFixed(2);
            //   if(parseFloat(extras_price_item)!=NaN && val.extras_price!=undefined){
            //       extras_price=extras_price_item;
            //   }
            //   totalProductPrice =parseFloat(extras_price)+parseFloat(totalProductPrice);
            // }
            totalProductPrice = parseFloat(totalProductPrice).toFixed(2);

            if (currencyAtRight) {
                price_val = price_item + "" + currentCurrency;
                extras_price_val = extras_price + "" + currentCurrency;
                totalProductPrice_val = totalProductPrice + "" + currentCurrency;
            } else {
                price_val = currentCurrency + "" + price_item;
                extras_price_val = currentCurrency + "" + extras_price;
                totalProductPrice_val = currentCurrency + "" + totalProductPrice;
            }

            html = html + '</div></div></td>';
            html = html + '<td>' + val.sourceLocationName + '</td><td>' + price_val + '</td><td>  ' + totalProductPrice_val + '</td>';

            html = html + '</tr>';
            total_price += parseFloat(totalProductPrice);
        });
        totalProductPrice = 0;

        return html;
    }


    function buildHTMLProductstotal(snapshotsProducts) {
        var html = '';
        var alldata = [];
        var number = [];
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


        var intRegex = /^\d+$/;
        var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;

        if (products) {

            products.forEach((product) => {

                var val = product;
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

        if (intRegex.test(discount) || floatRegex.test(discount)) {

            discount = parseFloat(discount).toFixed(2);
            total_price -= parseFloat(discount);

            if (currencyAtRight) {
                discount_val = discount + "" + currentCurrency;
            } else {
                discount_val = currentCurrency + "" + discount;
            }

            couponCode_html = '';
            if (couponCode) {
                couponCode_html = '</br><small>{{trans("lang.coupon_codes")}} :' + couponCode + '</small>';
            }
            html = html + '<tr><td class="label">{{trans("lang.discount")}}' + couponCode_html + '</td><td class="discount">-' + discount_val + '</td></tr>';
        }


        var tax = 0;
        taxlabel = '';
        taxlabeltype = '';
        try {
            if (snapshotsProducts.tax) {
                if (snapshotsProducts.taxType && snapshotsProducts.tax) {
                    if (snapshotsProducts.taxType == "percent") {
                        tax = (snapshotsProducts.tax * total_price) / 100;
                        taxlabeltype = "%";
                    } else {
                        tax = snapshotsProducts.tax;
                        taxlabeltype = "fix";
                    }
                    // taxlabel = snapshotsProducts.taxSetting.label;
                }
            }
        } catch (error) {

        }

        if (!isNaN(tax) && tax != 0) {
            if (currencyAtRight) {
                html = html + '<tr><td class="label">{{trans("lang.tax")}}</td><td class="deliveryCharge">+' + tax.toFixed(2) + '' + currentCurrency + '(' + snapshotsProducts.tax + ' ' + taxlabeltype + ')</td></tr>';
            } else {
                html = html + '<tr><td class="label">{{trans("lang.tax")}}</td><td class="deliveryCharge">+' + currentCurrency + tax.toFixed(2) + '( ' + snapshotsProducts.tax + ' ' + taxlabeltype + ')</td></tr>';
            }

            total_price = total_price + tax;
        }

        if (intRegex.test(deliveryCharge) || floatRegex.test(deliveryCharge)) {
            deliveryCharge = parseFloat(deliveryCharge).toFixed(2);
            total_price += parseFloat(deliveryCharge);

            if (currencyAtRight) {
                deliveryCharge_val = deliveryCharge + "" + currentCurrency;

            } else {
                deliveryCharge_val = currentCurrency + "" + deliveryCharge;
                console.log(deliveryCharge_val);

            }
            if (deliveryCharge) {
                deliveryChargeVal = deliveryCharge;
                html = html + '<tr><td class="label">{{trans("lang.deliveryCharge")}}</td><td class="deliveryCharge">+' + deliveryCharge_val + '</td></tr>';
            }
        }

        var total_item_price = total_price;
        if (intRegex.test(tip_amount) || floatRegex.test(tip_amount)) {

            tip_amount = parseFloat(tip_amount).toFixed(2);
            total_price += parseFloat(tip_amount);
            total_price = parseFloat(total_price).toFixed(2);

            if (currencyAtRight) {
                tip_amount_val = tip_amount + "" + currentCurrency;
            } else {
                tip_amount_val = currentCurrency + "" + tip_amount;
            }
            if (tip_amount) {
                html = html + '<tr><td class="label">{{trans("lang.tip_amount")}}</td><td class="tip_amount_val">+' + tip_amount_val + '</td></tr>';
            }
        }

        if (currencyAtRight) {
            total_price_val = parseFloat(total_price).toFixed(2) + "" + currentCurrency;
        } else {
            total_price_val = currentCurrency + "" + parseFloat(total_price).toFixed(2);
        }

        html = html + '<tr><td class="label">{{trans("lang.total_amount")}}</td><td class="total_price_val">' + total_price_val + '</td></tr>';

        if (adminCommission != undefined && adminCommissionType != undefined) {
            var commission = 0;
            console.log(total_item_price);
            console.log("total_item_price");
            if (adminCommissionType == "Percent") {
                commission = (total_item_price * parseFloat(adminCommission)) / 100;
            } else {
                commission = parseFloat(adminCommission);
            }
            adminCommission = commission;
        } else if (adminCommission != undefined) {
            var commission = parseFloat(adminCommission);
            adminCommission = commission;
        }

        if (adminCommission) {

            adminCommission = parseFloat(adminCommission).toFixed(2);
            if (currencyAtRight) {
                adminCommission_val = adminCommission + "" + currentCurrency;
            } else {
                adminCommission_val = currentCurrency + "" + adminCommission;
            }
            html = html + '<tr><td class="label"><small>( {{trans("lang.admin_commission")}} </small></td><td class="adminCommission_val"><small>' + adminCommission_val + ')</small></td></tr>';
        }

        if (notes) {


            html = html + '<tr><td class="label">{{trans("lang.notes")}}</td><td class="adminCommission_val">' + notes + '</td></tr>';
        }


        return html;
    }

</script>

@endsection