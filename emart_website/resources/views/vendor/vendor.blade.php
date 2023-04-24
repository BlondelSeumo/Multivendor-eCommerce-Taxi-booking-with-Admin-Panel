@include('layouts.app')

@include('layouts.header')

<div class="vendor-page bg-white ecom-vendor-page category-listing-page">

    <div class="ecomvendor-banner">
    <div class="container">
        <div class="resturant-banner-inner" id="vendor_image">
        </div>
    </div>
    </div>

    <div class="container position-relative pb-5">

        <div class="d-flex align-items-start rest-basic-detail mt-3 mb-3">

            <div class="text-dark">
                <h2 class="font-weight-bold h6" id="vendor_title"></h2>
                <div class="d-flex">
                    <p class="text-dark m-0" id="vendor_address"><span class="fa fa-map-marker "></span></p>
                    <div class="rest-time">
                        <span class="text-dark-50 font-weight-bold m-0 pl-3 time"></span>
                        <spanclass
                        ="text-dark m-0 font-weight-bold" id="vendor_open_time1"></span>
                    </div>
                </div>
                <div class="rating-wrap d-flex align-items-center mt-2" id="vendor_ratings"></div>
            </div>

            <div class="feather_icon ml-auto">
                <div class="row fu-review">
                    <?php /*<a href="javascript:void(0)" class="text-decoration-none mx-1 p-2 rest-right-btn"><i
                                class="font-weight-bold feather-star view_ratings_review"></i></a>*/ ?>
                    <?php if(Auth::check()): ?>
                      	<a href="javascript:void(0)"  class="text-decoration-none mx-1 p-2 rest-right-btn addToFavorite"><i class="font-weight-bold feather-heart"></i></a>
                      <?php else: ?>
                        <a href="javascript:void(0)"  class="text-decoration-none mx-1 p-2 rest-right-btn loginAlert"><i class="font-weight-bold feather-heart"></i></a>
                    <?php endif; ?>
                    <a class="text-decoration-none mx-1 p-2 rest-right-btn vendor_location_btn" target="_blank"><i
                                class="font-weight-bold feather-map-pin"></i></a>
                    <a href="{{route('contact_us')}}" class="btn">{{trans('lang.contact')}}</a>
                </div>

                <?php if($_COOKIE['service_type'] !='Ecommerce Service'){ ?>
                <div class="row fu-time" >
                    <a class="text-decoration-none mx-1 p-2 rest-right-btn time" style="pointer-events: none">
                        <span class="text-dark-50 font-weight-bold m-0 pl-3 time ">{{trans('lang.time')}} : </span>
                        <span class="text-dark m-0 font-weight-bold" id="vendor_open_time"></span>
                    </a>
                </div>
                <div class="row fu-status">
                    <a class="text-decoration-none mx-1 p-2 rest-right-btn">
                        <span class="text-dark m-0 font-weight-bold" style="pointer-events: none"
                              id="vendor_shop_status"></span>
                    </a>
                </div>
                <?php } ?>

        </div>
        </div>
        <div class="foodies-detail-coupon">
        <div class="coupon_detail">

              </div>
        </div>
        <div class="ecom-vendor-product-section">
            <div class="row">
                <div class="col-md-3 vendor-detail-left">
                    <div id="category-list"></div>
                </div>
                <div class="col-md-9 vendor-detail-right">
                    <div id="product-list"></div>
                </div>
            </div>
        </div>

    </div>

</div>

<div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">
    {{trans('lang.processing')}}
</div>

<input type="hidden" name="vendor_id" id="vendor_id" value="<?php echo $_GET['id']; ?>">

<input type="hidden" name="vendor_name" id="vendor_name" value="">

<input type="hidden" name="vendor_location" id="vendor_location" value="">

<input type="hidden" name="vendor_latitude" id="vendor_latitude" value="">

<input type="hidden" name="vendor_longitude" id="vendor_longitude" value="">

<input type="hidden" name="vendor_image" id="vendor_image" value="">

</div>

@include('layouts.footer')

@include('layouts.nav')

<script type="text/javascript">

    var section_id = "<?php echo @$_COOKIE['section_id'] ?>";
    var vendorID = "<?php echo $_GET['id']; ?>";
    var service_type="<?php echo @$_COOKIE['service_type']?>"
    var currentCurrency = '';
    var currencyAtRight = false;
    var specialOfferVendor = [];
    let specialOfferForHour = [];

    var enableSpecialOffer = false;
    var enableDinein=false;
    var sectionRef=database.collection('sections').where('id','==',section_id);
    sectionRef.get().then(async function (sectionsnapShots) {
        var sectiondata = sectionsnapShots.docs[0].data();
        if (sectiondata.dine_in_active) {
            enableDinein = sectiondata.dine_in_active;
        }
    });

    var specialOfferRef = database.collection('settings').doc('specialDiscountOffer');
    specialOfferRef.get().then(async function (snapShots) {
        var specialOfferData = snapShots.data();
        if (specialOfferData.isEnable) {
            enableSpecialOffer = specialOfferData.isEnable;
        }
    });

    var catsRef = database.collection('vendor_categories').where('section_id', '==', section_id).where("publish","==",true);
    var vendorDetailsRef = database.collection('vendors').where('id', "==", vendorID);
    var vendorProductsRef = database.collection('vendor_products').where('vendorID', "==", vendorID).where("publish","==",true);

    var decimal_degits = 0;
    var refCurrency = database.collection('currencies').where('isActive', '==', true);
    refCurrency.get().then(async function (snapshots) {
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;
        if (currencyData.decimal_degits) {
            decimal_degits = currencyData.decimal_degits;
        }
    });

    var placeholderImageRef = database.collection('settings').doc('placeHolderImage');
    var placeholderImageSrc = '';
    placeholderImageRef.get().then(async function (placeholderImageSnapshots) {
        var placeHolderImageData = placeholderImageSnapshots.data();
        placeholderImageSrc = placeHolderImageData.image;
    })

    jQuery("#data-table_processing").show();
    $(document).ready(function () {
        getVendorDetails();
        getCategories();

        $(document).on("click", ".category-item", function () {
            if (!$(this).hasClass('active')) {
                $(this).addClass('active').siblings().removeClass('active');
                getProducts($(this).data('category-id'));
            }
        });

        getCouponDetails();

    });

    async function getCategories() {

        catsRef.get().then(async function (snapshots) {
            if (snapshots != undefined) {
                var html = '';

                var alldata = [];
                snapshots.docs.forEach((listval) => {
                    var datas = listval.data();
                    datas.id = listval.id;
                    alldata.push(datas);
                });

                var cats = [];
                for (i = 0; i < alldata.length; i++) {
                    var countProduct = await vendorProductsRef.where('categoryID', '==', alldata[i].id).get().then(function (snapshots) {
                        return snapshots.docs.length;
                    });
                    if (countProduct > 0) {
                        cats.push(alldata[i]);
                    }
                }

                html = html + '<div class="vandor-sidebar">';
                html = html + '<h3>{{trans("lang.categories")}}</h3>';
                if (cats.length > 0) {
                    html = html + '<ul class="vandorcat-list">';
                    cats.forEach((listval) => {
                        var val = listval;
                        if (val.photo) {
                            photo = val.photo;
                        } else {
                            photo = placeholderImageSrc;
                        }
                        html = html + '<li class="category-item" data-category-id="' + val.id + '">';
                        html = html + '<a href="javascript:void(0)"><span><img src="' + photo + '"></span>' + val.title + '</a>';
                        html = html + '</li>';
                    });
                    html = html + '</ul>';
                } else {
                    html = html + '<p>{{trans("lang.no_results")}}</p>';
                }

                if (html != '') {
                    var append_list = document.getElementById('category-list');
                    append_list.innerHTML = html;

                    var category_id = $('#category-list .category-item').first().addClass('active').data('category-id');
                    if (category_id) {
                        getProducts(category_id);
                    }
                }
            }
            jQuery("#data-table_processing").hide();
        });
    }


    async function getCouponDetails() {
        var date = new Date();
        var couponRef = database.collection('coupons').where('vendorID', '==', vendorID).where('expiresAt', '>=', date);
        var couponHtml = '';

        let menuHtmlx = couponRef.get().then(async function (couponRefSnapshots) {
        	if(couponRefSnapshots.docs.length > 0){
	            couponHtml += '<div class="coupon-code"><label>{{trans("lang.available_coupon")}}</label><span></span></div>';
	            couponHtml += '<div class="copupon-list">';
	            couponHtml += '<ul>';
	            couponRefSnapshots.docs.forEach((doc) => {
	                	coupon = doc.data();
	                    if(coupon.expiresAt){
	                        var date1 = coupon.expiresAt.toDate().toDateString();
	                        var date = new Date(date1);
	                        var dd = String(date.getDate()).padStart(2, '0');
	                        var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
	                        var yyyy = date.getFullYear();
	                        var expiresDate = yyyy + '-' + mm + '-' + dd;
	                    }
	                    if(coupon.discountType == 'Percentage'){
	                        var discount = coupon.discount+'%'
	                    }else{
	                    	coupon.discount = parseFloat(coupon.discount);
	                        if (currencyAtRight) {
	                            var discount = coupon.discount.toFixed(decimal_degits) + "" + currentCurrency;
	                        } else {
	                            var discount = currentCurrency + "" + coupon.discount.toFixed(decimal_degits);
	                        }
	                    }
	                	if(coupon.isEnabled == true){
	                    	couponHtml += '<li value="' + coupon.code + '"><span class="per-off">' + discount + ' OFF </span><span>' + coupon.code+' | Valid till '+expiresDate +'</span></li>';
			            }
	            });
	            couponHtml += '</ul></div>';
            }
            return couponHtml;
        })

        let menuHtml = await menuHtmlx.then(function (html) {
            if (html != undefined) {
                return html;
            }
        })
        $('.coupon_detail').html(menuHtml);
    }


    async function getProducts(category_id) {

        jQuery("#data-table_processing").show();
        var product_list = document.getElementById('product-list');
        product_list.innerHTML = '';

        var html = '';

        vendorProductsRef.where('categoryID', '==', category_id).orderBy('name').get().then(async function (snapshots) {
            html = buildProductsHTML(snapshots);
            if (html != '') {
                product_list.innerHTML = html;

                jQuery("#data-table_processing").hide();
            }
        });
    }

    function buildProductsHTML(snapshots) {

        var html = '';

        var alldata = [];
        snapshots.docs.forEach((listval) => {
            var datas = listval.data();
            datas.id = listval.id;
            alldata.push(datas);
        });

        var count = 0;
        var popularFoodCount = 0;

        html = html + '<div class="row">';

        alldata.forEach((listval) => {

            var val = listval;
            var vendor_id_single = val.id;

            var view_vendor_details = "{{ route('productdetail',':id')}}";
            view_vendor_details = view_vendor_details.replace(':id', vendor_id_single);

            var rating = 0;
            var reviewsCount = 0;

            if (val.hasOwnProperty('reviewsSum') && val.reviewsSum != 0 && val.hasOwnProperty('reviewsCount') && val.reviewsCount != 0) {
                rating = (val.reviewsSum / val.reviewsCount);
                rating = Math.round(rating * 10) / 10;
                reviewsCount = val.reviewsCount;
            }

            html = html + '<div class="col-md-4 product-list"><div class="list-card position-relative"><div class="list-card-image">';

            if (val.photo) {
                photo = val.photo;
            } else {
                photo = placeholderImageSrc;
            }
            if(enableDinein){
              if(val.hasOwnProperty('nonveg')){
              if(val.nonveg == true) {
                  html = html +'<div class="member-plan position-absolute"><span class="badge badge-danger">non veg</span></div>';

              }
              else{
                  html = html +'<div class="member-plan position-absolute"><span class="badge badge-success">Pure veg</span></div>';

              }
          }
            }

            html = html + '<a href="' + view_vendor_details + '"><img alt="#" src="' + photo + '" class="img-fluid item-img w-100"></a></div><div class="py-2 position-relative"><div class="list-card-body position-relative"><h6 class="product-title mb-1"><a href="' + view_vendor_details + '" class="text-black">' + val.name + '</a></h6>';

            html = html + '<h6 class="mb-1 popular_food_category_ pro-cat" id="popular_food_category_' + val.categoryID + '_' + val.id + '" ></h6>';

            val.price = parseFloat(val.price);
            if (val.hasOwnProperty('disPrice') && val.disPrice != '' && val.disPrice != '0') {
                val.disPrice = parseFloat(val.disPrice);
                var dis_price = '';
                var or_price = '';
                if (currencyAtRight) {
                    or_price = val.price.toFixed(decimal_degits) + "" + currentCurrency;
                    dis_price = val.disPrice.toFixed(decimal_degits) + "" + currentCurrency;
                } else {
                    or_price = currentCurrency + "" + val.price.toFixed(decimal_degits);
                    dis_price = currentCurrency + "" + val.disPrice.toFixed(decimal_degits);
                }

                html = html + '<span class="pro-price">' + dis_price + '  <s>' + or_price + '</s></span>';
            } else {
                var or_price = '';
                if (currencyAtRight) {
                    or_price = val.price.toFixed(decimal_degits) + "" + currentCurrency;
                } else {
                    or_price = currentCurrency + "" + val.price.toFixed(decimal_degits);
                }

                html = html + '<span class="pro-price">' + or_price + '</span>'
            }

            html = html + '<div class="star position-relative mt-3"><span class="badge badge-success"><i class="feather-star"></i>' + rating + ' (' + reviewsCount + ')</span></div>';

            html = html + '</div>';

            html = html + '</div></div></div>';
        });

        html = html + '</div>';

        return html;
    }

    async function getVendorDetails() {

        vendorDetailsRef.get().then(async function (vendorSnapshots) {

            var vendorDetails = vendorSnapshots.docs[0].data();

            $("#vendor_title").append(vendorDetails.title);
            $("#vendor_address").append(vendorDetails.location);
           // $("#vendor_open_time").append(vendorDetails.opentime + ' - ' + vendorDetails.closetime);


            var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            var currentdate = new Date();
            var currentDay = days[currentdate.getDay()];
            var currentHours = currentdate.getHours();
        if(vendorDetails.hasOwnProperty('workingHours')){
        for(i=0; i< vendorDetails.workingHours.length; i++){
        var day = vendorDetails.workingHours[i]['day'];
        if(vendorDetails.workingHours[i]['day'] == currentDay){
        if(vendorDetails.workingHours[i]['timeslot'].length != 0){
            for(j=0; j<vendorDetails.workingHours[i]['timeslot'].length; j++){
            var timeslot = vendorDetails.workingHours[i]['timeslot'][j];
            var TimeslotHourVar = {'from':timeslot[`from`],'to':timeslot[`to`],'closeingType':timeslot[`closeingType`]};
            var [h, m] = timeslot[`from`].split(":");
            var from =((h % 12 ? h % 12 : 12) + ":" + m, h >= 12 ? 'PM' : 'AM');

            var [h2, m2] = timeslot[`to`].split(":");
            var to =((h2 % 12 ? h2 % 12 : 12) + ":" + m2, h2 >= 12 ? 'PM' : 'AM');

            $('#vendor_open_time').append(timeslot[`from`]+' '+from+' - '+timeslot[`to`]+' '+to+'<br/><span class="margine" style="margin-right: 65px;"></span>');






            }
                $("#vendor_shop_status").append("{{trans('lang.open')}}");
                $("#vendor_shop_status").addClass('open');
            }else{
                $("#vendor_shop_status").append("{{trans('lang.closed')}}");
                $("#vendor_shop_status").addClass('close');
            }

            }
        }

}
if (vendorDetails.hasOwnProperty('reststatus') && vendorDetails.reststatus == true) {
                // $("#vendor_shop_status").append("{{trans('lang.open')}}");
                // $("#vendor_shop_status").addClass('open');
                vendorOpen = vendorDetails.reststatus;
            } else {
                // $("#vendor_shop_status").append("{{trans('lang.closed')}}");
                // $("#vendor_shop_status").addClass('close');
            }
            var newdeliveryCharge = [];
            try {

                if (deliveryChargemain.vendor_can_modify) {
                    if (vendorDetails.deliveryCharge) {
                        if (vendorDetails.deliveryCharge.delivery_charges_per_km && vendorDetails.deliveryCharge.minimum_delivery_charges && vendorDetails.deliveryCharge.minimum_delivery_charges_within_km) {
                            deliveryChargemain = vendorDetails.deliveryCharge;
                        }
                    }
                }

            } catch (error) {

            }
            if (vendorDetails.hasOwnProperty('specialDiscount')) {

                specialOfferVendor = vendorDetails.specialDiscount;
            }

            var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            var currentdate = new Date();
            var currentDay = days[currentdate.getDay()];
            var currentTime = currentdate.getHours() + ":" + currentdate.getMinutes();


            if (enableSpecialOffer) {

                if (specialOfferVendor.length != 0) {
                    for (i = 0; i < specialOfferVendor.length; i++) {
                        
                        if (specialOfferVendor[i]['day'] == currentDay) {
                            if (specialOfferVendor[i]['timeslot'].length > 0) {
                        
                                for (j = 0; j < specialOfferVendor[i]['timeslot'].length; j++) {


                                    if (currentTime >= specialOfferVendor[i]['timeslot'][j]['from'] && currentTime <= specialOfferVendor[i]['timeslot'][j]['to']) {

                                        if (specialOfferVendor[i]['timeslot'][j]['discount_type'] == 'delivery') {
                                            specialOfferForHour = [];
                                            specialOfferForHour.push(specialOfferVendor[i]['timeslot'][j]);

                                        }

                                    }
                                }
                            }


                        }
                    }
                }
            }

            setCookie('specialOfferForHourMain', JSON.stringify(specialOfferForHour), 365);

            $(".vendor_location_btn").attr("href", "http://maps.google.com?q=" + vendorDetails.latitude + "," + vendorDetails.longitude);



            if (vendorDetails.hasOwnProperty('photo') && vendorDetails.photo != '') {
                photo = vendorDetails.photo;
            } else {
                photo = placeholderImageSrc
            }
            $("#vendor_image").html('<img src="' + photo + '">');

            if (vendorDetails.hasOwnProperty('reviewsCount') && vendorDetails.reviewsCount != '') {
                rating = Math.round(parseFloat(vendorDetails.reviewsSum) / parseInt(vendorDetails.reviewsCount));
                reviewsCount = vendorDetails.reviewsCount;
            } else {
                reviewsCount = 0;
                rating = 0;
            }

            var html_rating = '<ul class="rating" data-rating="' + rating + '">';
            html_rating = html_rating + '<li class="rating__item"></li>';
            html_rating = html_rating + '<li class="rating__item"></li>';
            html_rating = html_rating + '<li class="rating__item"></li>';
            html_rating = html_rating + '<li class="rating__item"></li>';
            html_rating = html_rating + '<li class="rating__item"></li>';
            html_rating = html_rating + '</ul><p class="label-rating ml-2 small" id="vendor_reviews">(' + reviewsCount + ' Reviews)</p>';

            $("#vendor_ratings").html(html_rating);

            if ($("#vendor_place").length) {
                $("#vendor_name_place").html(vendorDetails.title);
                if (vendorDetails.photo) {
                    $("#vendor_image_place").attr('src', vendorDetails.photo);
                    setTimeout(function () {
                        $("#vendor_image_place").show()
                    }, 1000);
                } else {
                    $("#vendor_image_place").remove();
                }
                $("#vendor_location_place").html('<i class="feather-map-pin"></i>' + vendorDetails.location);
                $("#vendor_place").show();

            }
        })
    }
    /* Add to favorite Code start*/
      $(document).ready(function () {

        var store_id=vendorID;
        if(user_uuid!=undefined){
          var user_id=user_uuid;
        }else{
          var user_id='';
        }
        database.collection('favorite_vendor').where('store_id','==',store_id).where('user_id','==',user_id).get().then(async function(favoritevendorsnapshots){
          if(favoritevendorsnapshots.docs.length>0){
            $('.addToFavorite').html('<i class="font-weight-bold fa fa-heart" style="color:red"></i>');
          }else{
              $('.addToFavorite').html('<i class="font-weight-bold feather-heart" ></i>');
          }
        });

        $('.loginAlert').on('click',function(){
             alert('Please Login For Add to favorite');
        });

        $('.addToFavorite').on('click',function(){
                var section_id = "<?php echo @$_COOKIE['section_id'] ?>";
              if(section_id!=undefined ){
                  var section_id=section_id;
              }else{
                  var section_id='';
              }
              
              var user_id=user_uuid;
              database.collection('favorite_vendor').where('store_id','==',store_id).where('user_id','==',user_id).get().then(async function(favoritevendorsnapshots){
                if(favoritevendorsnapshots.docs.length>0){
                    var id=favoritevendorsnapshots.docs[0].id;
                      database.collection('favorite_vendor').doc(id).delete().then(function(){
                        $('.addToFavorite').html('<i class="font-weight-bold feather-heart" ></i>');
                      });
                }else{
                    var id = "<?php echo uniqid();?>";
                    database.collection('favorite_vendor').doc(id).set({'store_id':store_id,'section_id':section_id,'user_id':user_id}).then(function(result){
                        $('.addToFavorite').html('<i class="font-weight-bold fa fa-heart" style="color:red"></i>');
                    });
                }
             });
        });
        /* Add to favorite Code End*/
      });
</script>
