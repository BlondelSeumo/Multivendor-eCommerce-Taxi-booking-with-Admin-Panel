@include('layouts.app')

@include('layouts.header')

<div class="siddhi-home-page">
    <div class="bg-primary px-3 d-none mobile-filter pb-3">
        <div class="row align-items-center">
            <div class="input-group rounded shadow-sm overflow-hidden col-md-9 col-sm-9">
                <div class="input-group-prepend">
                    <button class="border-0 btn btn-outline-secondary text-dark bg-white btn-block">
                        <i
                            class="feather-search"></i>
                    </button>
                </div>
                <input type="text" class="shadow-none border-0 form-control" placeholder="Search for vendors or dishes">
            </div>
            <div class="text-white col-md-3 col-sm-3">
                <div class="title d-flex align-items-center">
                    <a class="text-white font-weight-bold ml-auto" data-toggle="modal" data-target="#exampleModal"
                       href="#">{{trans('lang.filter')}}</a>
                </div>
            </div>

        </div>
    </div>

    <div class="ecommerce-banner">

        <div class="ecommerce-inner">

            <div class="" id="top_banner"></div>

        </div>
    </div>

    <div class="ecommerce-content">

        <section class="top-categories">

            <div class="container">

                <div class="title d-flex align-items-center">
                    <h5>{{trans('lang.top_categories')}}</h5>
                    <span class="see-all ml-auto">
						<a href="{{ route('categorylist')}}">{{trans('lang.see_all')}}</a>
					</span>
                </div>
                <div class="append_categories" id="append_categories"></div>
            </div>

        </section>

        <section class="new-arrivals">

            <div class="container">

                <div class="title d-flex align-items-center">
                    <h5>{{trans('lang.new_arrivals')}}</h5>
                    <span class="see-all ml-auto">
						<a href="{{ route('vendors')}}">{{trans('lang.see_all')}}</a>
					</span>
                </div>
                <div class="most_sale1" id="most_sale1"></div>
            </div>

        </section>

        <section class="popular-fashion-store">

            <div class="container">

                <div class="title d-flex align-items-center">
                    <h5>{{trans('lang.popular_fashion_store')}}</h5>
                    <span class="see-all ml-auto">
						<a href="{{ route('vendors','popular=yes')}}">{{trans('lang.see_all')}}</a>
					</span>
                </div>
                <div class="most_popular" id="most_popular"></div>
            </div>

        </section>

        <section class="brands">

            <div class="container brands_item">

                <div class="title d-flex align-items-center">
                    <h5>{{trans('lang.brands')}}</h5>
                    <span class="see-all ml-auto">
						<a href="{{ route('brands')}}">{{trans('lang.see_all')}}</a>
					</span>
                </div>
                <div class="brands" id="brands"></div>
            </div>

        </section>
        <!--
                <section class="middle-banners">

                    <div class="container">

                        <div class="middle_banner" id="middle_banner"></div>

                    </div>

                </section> -->

        <section class="home-categories">

            <div class="container" id="home_categories"></div>

        </section>

        <section class="all-stores">

            <div class="container">

                <div class="title d-flex align-items-center">
                    <h5>{{trans('lang.all_stores')}}</h5>
                    <span class="see-all ml-auto">
						<a href="{{ route('vendors')}}">{{trans('lang.see_all')}}</a>
					</span>
                </div>

                <div id="all-stores"></div>

                <div class="row fu-loadmore-btn">
                    <a class="page-link loadmore-btn" href="{{ route('vendors')}}"
                       data-dt-idx="0" tabindex="0">{{trans('lang.see_all_store')}}</a>
                </div>

            </div>

        </section>

        <section class="shipping-method-system-sec">
            <div class="container rtl mb-3">
                <div class="row shipping-policy-web" style="margin-right: 0px; margin-left:0px;">
                    <div class="col-md-3 d-flex justify-content-center">
                        <div class="shipping-method-system">
                            <div style="text-align: center;">
                                <img style="height: 60px;width:60px;" src="{{url('img/delivery.png')}}" alt="">
                            </div>
                            <div style="text-align: center;">
                                <p>{{trans('lang.fast_delivery')}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 d-flex justify-content-center">
                        <div class="shipping-method-system">
                            <div style="text-align: center;">
                                <img style="height: 60px;width:60px;" src="{{url('img/Payment.png')}}" alt="">
                            </div>
                            <div style="text-align: center;">
                                <p>{{trans('lang.safe_payment')}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 d-flex justify-content-center">
                        <div class="shipping-method-system">
                            <div style="text-align: center;">
                                <img style="height: 60px;width:60px;" src="{{url('img/money.png')}}" alt="">
                            </div>
                            <div style="text-align: center;">
                                <p>{{trans('lang.return_policy')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center">
                        <div class="shipping-method-system">
                            <div style="text-align: center;">
                                <img style="height: 60px;width:60px;" src="{{url('img/Genuine.png')}}" alt="">
                            </div>
                            <div style="text-align: center;">
                                <p>{{trans('lang.authentic_products')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 our-contact-sec">
            <div class="d-flex justify-content-center text-center text-md-left mt-3">
                <div class="col-md-3 d-flex justify-content-center">
                    <div>
                        <a href="/index.php">
                            <div style="text-align: center;">
                                <img style="height: 60px;width:60px;" src="{{url('img/about company.png')}}" alt="">
                            </div>
                            <div style="text-align: center;">
                                <p>{{trans('lang.about_company')}}</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 d-flex justify-content-center">
                    <div>
                        <a href="/contact-us">
                            <div style="text-align: center;">
                                <img style="height: 60px;width:60px;" src="{{url('img/contact us.png')}}" alt="">
                            </div>
                            <div style="text-align: center;">
                                <p>{{trans('lang.contact_us')}}</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 d-flex justify-content-center">
                    <div>
                        <a href="/faq">
                            <div style="text-align: center;">
                                <img style="height: 60px;width:60px;" src="{{url('img/faq.png')}}" alt="">
                            </div>
                            <div style="text-align: center;">
                                <p>{{trans('lang.faq')}}</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </div>

</div>

<div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">
    {{trans('lang.processing')}}
</div>

@include('layouts.footer')
<script src="https://unpkg.com/geofirestore@5.2.0/dist/geofirestore.js"></script>
<script src="https://cdn.firebase.com/libs/geofire/5.0.1/geofire.min.js"></script>
<script type="text/javascript" src="{{asset('vendor/slick/slick.min.js')}}"></script>
<script type="text/javascript">

    var geoFirestore = new GeoFirestore(firestore);
    var vendorId;
    var ref;
    var append_list = '';
    var append_categories = '';
    var most_popular = '';
    var most_sale = '';
    var offers_coupons = '';
    var appName = '';
    var popularStoresList = [];
    var currentCurrency = '';
    var currencyAtRight = false;
    var VendorNearBy = '';
    var placeholderImageRef = database.collection('settings').doc('placeHolderImage');
    var placeholderImageSrc = '';

    placeholderImageRef.get().then(async function (placeholderImageSnapshots) {
        var placeHolderImageData = placeholderImageSnapshots.data();
        placeholderImageSrc = placeHolderImageData.image;
    })

    //console.log(placeholderImageSrc);
    var DriverNearByRef = database.collection('settings').doc('DriverNearBy');

    var itemCategoriesref = database.collection('vendor_categories').where('section_id', '==', section_id).where("publish", "==", true).limit(7);
    var bannerref = database.collection('banner_items').where('sectionId', '==', section_id).where("is_publish", "==", true).orderBy('set_order', 'asc');
    var vendorsref = geoFirestore.collection('vendors').where('section_id', '==', section_id);
    var refCurrency = database.collection('currencies').where('isActive', '==', true);
    var brandsRef = database.collection('brands').where('sectionId', '==', section_id).where('is_publish', '==', true).limit(7);
    var productref = database.collection('vendor_products').where('section_id', '==', section_id);
    var position1_banners = [];
    var position2_banners = [];

    bannerref.get().then(async function (banners) {

        banners.docs.forEach((banner) => {
            var bannerData = banner.data();
            var redirect_type = '';
            var redirect_id = '';

            if (bannerData.position == 'top') {
                if (bannerData.hasOwnProperty('redirect_type')) {
                    redirect_type = bannerData.redirect_type;
                    redirect_id = bannerData.redirect_id;
                }

                var object = {
                    'photo': bannerData.photo,
                    'redirect_type': redirect_type,
                    'redirect_id': redirect_id,
                }

                position1_banners.push(object);
            }
            if (bannerData.position == 'middle') {

                if (bannerData.hasOwnProperty('redirect_type')) {
                    redirect_type = bannerData.redirect_type;
                    redirect_id = bannerData.redirect_id;
                }
                var object = {
                    'photo': bannerData.photo,
                    'redirect_type': redirect_type,
                    'redirect_id': redirect_id,
                }
                position2_banners.push(object);
            }
        });
        appendBanner();
    });

    function appendBanner() {
        if (position1_banners.length > 0) {
            var html = '';
            for (banner of position1_banners) {
                html += '<div class="banner-item">';
                html += '<div class="banner-img">';

                var redirect_id = 'javascript::void()';

                if (banner.redirect_type != '') {
                    if (banner.redirect_type == "store") {

                        redirect_id = "{{ route('vendor',':id')}}";
                        redirect_id = redirect_id.replace(':id', 'id=' + banner.redirect_id);

                    } else if (banner.redirect_type == "product") {

                        redirect_id = "{{ route('productdetail',':id')}}";
                        redirect_id = redirect_id.replace(':id', banner.redirect_id);


                    } else if (banner.redirect_type == "external_link") {
                        redirect_id = banner.redirect_id;
                    }
                }
                html += '<a href="' + redirect_id + '"><img src="' + banner.photo + '"></a>';
                html += '</div>';
                html += '</div>';
            }
            $("#top_banner").html(html);
        }
        if (position2_banners.length > 0) {
            var html = '';
            for (banner of position2_banners) {
                html += '<div class="banner-item">';
                html += '<div class="banner-img">';

                var redirect_id = 'javascript::void()';

                if (banner.redirect_type != '') {
                    if (banner.redirect_type == "store") {

                        redirect_id = "{{ route('vendor',':id')}}";
                        redirect_id = redirect_id.replace(':id', 'id=' + banner.redirect_id);

                    } else if (banner.redirect_type == "product") {

                        redirect_id = "{{ route('productdetail',':id')}}";
                        redirect_id = redirect_id.replace(':id', banner.redirect_id);

                    } else if (banner.redirect_type == "external_link") {
                        redirect_id = banner.redirect_id;
                    }
                }

                html += '<a href="' + redirect_id + '"><img src="' + banner.photo + '"></a>';
                html += '</div>';
                html += '</div>';
            }
            $("#middle_banner").html(html);
        }
        slickcatCarousel();
    }

    const refs = database.collection('vendors').where('section_id', '==', section_id).limit(16);
    const popularRestauantRef = geoFirestore.collection('vendors').where('section_id', '==', section_id).where('reviewsSum', '>', 4);


    var decimal_degits = 0;
    refCurrency.get().then(async function (snapshots) {
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;
        if (currencyData.decimal_degits) {
            decimal_degits = currencyData.decimal_degits;
        }
    });

    var couponsRef = database.collection('coupons').where('isEnabled', '==', true).where("section_id", "==", section_id).orderBy("expiresAt").startAt(new Date());

    var globalSettingsRef = database.collection('settings').doc("globalSettings");
    globalSettingsRef.get().then(async function (globalSettingsSnapshots) {
        var appData = globalSettingsSnapshots.data();
        appName = appData.applicationName;
    })

    if (address_lat == '' || address_lng == '' || address_lng == NaN || address_lat == NaN || address_lat == null || address_lng == null) {
        var res = getCurrentLocation();
    }
    var myInterval = setInterval(callStore, 1000);

    function myStopTimer() {
        clearInterval(myInterval);
    }

    jQuery("#data-table_processing").show();
    $(document).ready(function () {
        getItemCategories();
        getHomepageCategory();
        getBrands();
        getAllStore();
    });

    async function callStore() {
        if (address_lat == '' || address_lng == '' || address_lng == NaN || address_lat == NaN || address_lat == null || address_lng == null) {
            return false;
        }

        DriverNearByRef.get().then(async function (DriverNearByRefSnapshots) {
            var DriverNearByRefData = DriverNearByRefSnapshots.data();
            VendorNearBy = parseInt(DriverNearByRefData.driverRadios);
            VendorNearBy = 200000

            address_lat = parseFloat(address_lat);
            address_lng = parseFloat(address_lng);
            myStopTimer();
            getMostPopularStores();
            getMostSalesStore();
        })
    }

    async function getItemCategories() {
        itemCategoriesref.get().then(async function (foodCategories) {
            append_categories = document.getElementById('append_categories');
            append_categories.innerHTML = '';
            foodCategorieshtml = buildHTMLItemCategory(foodCategories);
            append_categories.innerHTML = foodCategorieshtml;
        })
    }

    async function getHomepageCategory() {

        var home_cat_ref = database.collection('vendor_categories').where('section_id', '==', section_id).where("publish", "==", true).where('show_in_homepage', '==', true).limit(5);

        home_cat_ref.get().then(async function (homeCategories) {
            home_categories = document.getElementById('home_categories');
            home_categories.innerHTML = '';

            var homeCategorieshtml = '';
            var alldata = [];
            homeCategories.docs.forEach((listval) => {
                var datas = listval.data();
                datas.id = listval.id;
                alldata.push(datas);

            });

            for (listval of alldata) {

                var val = listval;
                var category_id = val.id;

                var category_route = "{{ route('productlist',[':type',':id'])}}";
                category_route = category_route.replace(':type', 'category');
                category_route = category_route.replace(':id', category_id);

                if (val.photo) {
                    photo = val.photo;
                } else {
                    photo = placeholderImageSrc;
                }

                var haveProductsRes = catHaveProducts(category_id);
                var haveProducts = await haveProductsRes.then(function (status) {
                    return status;
                });

                if (haveProducts == true) {
                    homeCategorieshtml += '<div class="category-content mb-5 ">';
                    homeCategorieshtml += '<div class="title d-flex align-items-center">';
                    homeCategorieshtml += '<h5>' + val.title + '</h5>';
                    homeCategorieshtml += '<span class="see-all ml-auto"><a href="' + category_route + '">{!! trans("lang.see_all") !!}</a></span>';
                    homeCategorieshtml += '</div>';
                    var productHtmlRes = buildHTMLHomeCategoryProducts(category_id);
                    var productHtml = await productHtmlRes.then(function (html) {
                        return html;
                    })
                    homeCategorieshtml += productHtml;
                    homeCategorieshtml += '</div>';
                    homeCategorieshtml += '</div>';

                }
            }

            home_categories.innerHTML = homeCategorieshtml;

            if (homeCategorieshtml != "" && position2_banners.length > 0) {
                var html = '';
                for (banner of position2_banners) {
                    html += '<div class="banner-item">';
                    html += '<div class="banner-img">';
                    var redirect_id = 'javascript::void()';

                    if (banner.redirect_type != '') {
                        if (banner.redirect_type == "store") {

                            redirect_id = "{{ route('vendor',':id')}}";
                            redirect_id = redirect_id.replace(':id', 'id=' + banner.redirect_id);

                        } else if (banner.redirect_type == "product") {

                            redirect_id = "{{ route('productdetail',':id')}}";
                            redirect_id = redirect_id.replace(':id', banner.redirect_id);


                        } else if (banner.redirect_type == "external_link") {
                            redirect_id = banner.redirect_id;
                        }
                    }
                    html += '<a href="' + redirect_id + '"><img src="' + banner.photo + '"></a>';
                    html += '</div>';
                    html += '</div>';
                }
                $(".brands_item").after('<section class="middle-banners"><div class="container"><div class="middle_banner" id="middle_banner1">' + html + '</div></div></section>');

                slickcatCarousel();
            } else {
                $('.middle-banners').remove();
            }
        })
    }

    async function getPopularItem() {

        if (popularStoresList.length > 0) {

            var popularStoresListnw = [];

            append_trending_vendor = document.getElementById('trending-slider');
            append_trending_vendor.innerHTML = '';

            var from = 0;
            var total = 0;
            for (let i = 0; i < (popularStoresList.length / 10); i++) {
                from = i * 10;
                popularStoresListnw = [];
                total = 0;
                for (let j = 0; j < popularStoresList.length; j++) {
                    if (j > from && total < 10) {
                        total++;
                        popularStoresListnw.push(popularStoresList[j]);
                    }
                }
                if (popularStoresListnw.length) {
                    var refpopularItem = database.collection('vendor_products').where("vendorID", "in", popularStoresListnw).limit(4);
                    refpopularItem.get().then(async function (snapshotsPopularItem) {

                        var trendingStorehtml = buildHTMLPopularItem(snapshotsPopularItem);
                        append_trending_vendor.innerHTML = trendingStorehtml;
                    });
                }

            }

        }

    }

    async function getMostPopularStores() {

        var popularRestauantRefnew = geoFirestore.collection('vendors').near({
            center: new firebase.firestore.GeoPoint(address_lat, address_lng),
            radius: VendorNearBy
        }).where('section_id', '==', section_id).limit(200);

        popularRestauantRefnew.get().then(async function (popularRestauantSnapshot) {
            most_popular = document.getElementById('most_popular');
            most_popular.innerHTML = '';
            var popularStorehtml = buildHTMLPopularStore(popularRestauantSnapshot);
            most_popular.innerHTML = popularStorehtml;
        })
    }

    async function getCouponsList() {

        couponsRef.get().then(async function (couponListSnapshot) {
            offers_coupons = document.getElementById('offers_coupons');
            offers_coupons.innerHTML = '';
            var couponlistHTML = buildHTMLCouponList(couponListSnapshot);
            if (couponlistHTML != '') {
                offers_coupons.innerHTML = couponlistHTML;
            } else {
                $('.vendor-offer-section').remove();
            }
        })
    }

    function buildHTMLCouponList(couponListSnapshot) {
        var html = '';
        var alldata = [];
        couponListSnapshot.docs.forEach((listval) => {
            var datas = listval.data();
            datas.id = listval.id;

            alldata.push(datas);
        });

        if (alldata.length > 0) {

            html = html + '<div class="row">';

            alldata.forEach((listval) => {

                var val = listval;

                var status = 'Closed';
                var statusclass = "closed";
                if (val.hasOwnProperty('reststatus') && val.reststatus) {
                    status = 'Open';
                    statusclass = "open";
                }

                var vendor_id_single = val.vendorID;

                var view_vendor_details = "";
                if (vendor_id_single) {
                    view_vendor_details = "{{ route('vendor',':id')}}";
                    view_vendor_details = view_vendor_details.replace(':id', 'id=' + vendor_id_single);

                }

                html = html + '<div class="col-md-3 pro-list"><div class="list-card position-relative"><div class="list-card-image">';

                if (val.image) {
                    photo = val.image;
                } else {
                    photo = placeholderImageSrc;
                }

                const vendorTitle = getVendorName(vendor_id_single);
                html = html + '<a href="' + view_vendor_details + '"><img alt="#" src="' + photo + '" class="img-fluid item-img w-100"></a></div><div class="py-2 position-relative"><div class="list-card-body"><h6 class="mb-1 popul-title"><a href="' + view_vendor_details + '" class="text-black vendor_title_' + vendor_id_single + '"></a></h6>';

                //html = html + '<p class="text-gray mb-1 small location vendor_location_' + vendor_id_single + '"></p>';
                html = html + '<div class="text-gray mb-1 small"><a href="javascript:void(0)" onclick="copyToClipboard(`' + val.code + '`)"><i class="fa fa-file-text-o"></i> ' + val.code + '</a></div>';

                html = html + '</div>';
                html = html + '</div></div></div>';

            });

            html = html + '</div>';
        }

        return html;

    }

    function copyToClipboard(text) {
        navigator.clipboard.writeText("");
        navigator.clipboard.writeText(text);
        $(".coupon_code_copied_div").show();
        setTimeout(
            function () {
                $(".coupon_code_copied_div").hide();
            }, 4000);

    }

    async function getVendorName(vendorId) {
        var vendorName = '';

        await database.collection('vendors').where("id", "==", vendorId).get().then(async function (categorySnapshots) {

            if (categorySnapshots.docs[0]) {
                var categoryData = categorySnapshots.docs[0].data();
                vendorName = categoryData.title;
                jQuery(".vendor_title_" + vendorId).text(vendorName);
                //jQuery(".vendor_location_" + vendorId).html('<span class="fa fa-map-marker"></span> ' +categoryData.location);
            }
        });
        return vendorName;
    }

    async function getMostSalesStore() {
        var mostSalesStore = database.collection('vendors').where('section_id', '==', section_id).orderBy('createdAt', 'desc').limit(4);
        mostSalesStore.get().then(async function (mostSaleSnapshot) {
            most_sale = document.getElementById('most_sale1');
            most_sale.innerHTML = '';
            var mostSaleStorehtml = buildHTMLMostSaleStore(mostSaleSnapshot);
            most_sale.innerHTML = mostSaleStorehtml;
        });

        /*var newProducts = productref.where('section_id', '==', section_id).limit(4);
        newProducts.get().then(async function (newproductsnapshots) {
            most_sale = document.getElementById('most_sale1');
            most_sale.innerHTML = '';
            var mostSaleStorehtml = buildHTMLNewProducts(newproductsnapshots);
            most_sale.innerHTML = mostSaleStorehtml;
        })*/
    }

    async function getBrands() {
        brandsRef.get().then(async function (snapshots) {
            if (snapshots != undefined) {
                var html = buildBrandsHTML(snapshots);
                var append_list = document.getElementById('brands');
                append_list.innerHTML = html;
            }
        });
    }

    async function getAllStore() {
        refs.get().then(async function (snapshots) {
            if (snapshots != undefined) {
                var html = buildAllStoresHTML(snapshots);
                var append_list = document.getElementById('all-stores');
                append_list.innerHTML = html;
                jQuery("#data-table_processing").hide();
            }
        });
    }

    function buildAllStoresHTML(snapshots) {
        var html = '';
        var alldata = [];
        snapshots.docs.forEach((listval) => {
            var datas = listval.data();
            datas.id = listval.id;
            alldata.push(datas);
        });

        var count = 0;

        html = html + '<div class="row">';
        alldata.forEach((listval) => {

            var val = listval;
            var rating = 0;
            var reviewsCount = 0;
            if (val.hasOwnProperty('reviewsSum') && val.reviewsSum != 0 && val.hasOwnProperty('reviewsCount') && val.reviewsCount != 0) {
                rating = (val.reviewsSum / val.reviewsCount);
                rating = Math.round(rating * 10) / 10;
                reviewsCount = val.reviewsCount;
            }

            var vendor_id_single = val.id;
            var view_vendor_details = "{{ route('vendor',':id')}}";
            view_vendor_details = view_vendor_details.replace(':id', 'id=' + vendor_id_single);
            count++;

            getMinDiscount(val.id);

            html = html + '<div class="col-md-3 pro-list"><div class="list-card position-relative"><div class="list-card-image">';

            if (val.photo) {
                photo = val.photo;
            } else {
                photo = placeholderImageSrc;
            }

            html = html + '<a href="' + view_vendor_details + '"><img alt="#" src="' + photo + '" class="img-fluid item-img w-100"></a></div><div class="py-2 position-relative"><div class="list-card-body">';

            html = html + '<div class="star position-relative"><span class="badge badge-success "><i class="feather-star"></i>' + rating + ' (' + reviewsCount + ')</span></div>';

            html = html + '<h6 class="mb-1 popul-title"><a href="' + view_vendor_details + '" class="text-black">' + val.title + '</a></h6><h6>' + val.location + '</h6><h6 class="pr-discount vendor_dis_' + val.id + '"></h6>';

            html = html + '</div>';
            html = html + '</div></div></div>';

        });
        html = html + '</div>';

        /*getPopularItem();*/
        return html;
    }

    function buildBrandsHTML(snapshots) {
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

            html = html + '<div class="col-md-2 brand-list"><div class="list-card position-relative"><div class="list-card-image">';

            if (val.photo) {
                photo = val.photo;
            } else {
                photo = placeholderImageSrc;
            }

            var view_vendor_details = "{{ route('productlist',[':type',':id'])}}";
            view_vendor_details = view_vendor_details.replace(':type', 'brand');
            view_vendor_details = view_vendor_details.replace(':id', val.id);

            html = html + '<a href="' + view_vendor_details + '"><img alt="#" src="' + photo + '" class="img-fluid item-img w-100"></a></div><div class="p-2 position-relative brand-title"><div class="list-card-body"><h6><a href="' + view_vendor_details + '" class="text-black mb-0">' + val.title + '</a></h6>';

            html = html + '</div>';
            html = html + '</div></div></div>';

        });

        html = html + '</div>';
        return html;
    }

    function buildHTMLItemCategory(foodCategories) {
        var html = '';
        var alldata = [];
        foodCategories.docs.forEach((listval) => {
            var datas = listval.data();
            datas.id = listval.id;
            alldata.push(datas);
        });

        html += '<div class="row">';
        alldata.forEach((listval) => {
            var val = listval;
            var category_id = val.id;
            var trending_route = "{{ route('productlist',[':type',':id'])}}";
            trending_route = trending_route.replace(':type', 'category');
            trending_route = trending_route.replace(':id', category_id);

            if (val.photo) {
                photo = val.photo;
            } else {
                photo = placeholderImageSrc;
            }
            html = html + '<div class="col-md-2 top-cat-list"><a class="d-block text-center cat-link" href="' + trending_route + '"><span class="cat-img"><img alt="#" src="' + photo + '" class="img-fluid mb-2"></span><h4 class="m-0">' + val.title + '</h4></a></div>';
        });
        html += '</div>';
        return html;
    }

    function buildHTMLHomeCategoryProducts(category_id) {

        var html = '';

        var vendorCatRef = database.collection('vendor_products').where('categoryID', "==", category_id).limit(4);

        var productHtmlRes = vendorCatRef.get().then(async function (nearestRestauantSnapshot) {

            var alldata = [];
            nearestRestauantSnapshot.docs.forEach((listval) => {
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

                html = html + '<div class="col-md-3 product-list"><div class="list-card position-relative"><div class="list-card-image">';

                if (val.photo) {
                    photo = val.photo;
                } else {
                    photo = placeholderImageSrc;
                }

                html = html + '<a href="' + view_vendor_details + '"><img alt="#" src="' + photo + '" class="img-fluid item-img w-100"></a></div><div class="py-2 position-relative"><div class="list-card-body position-relative"><h6 class="product-title mb-1"><a href="' + view_vendor_details + '" class="text-black">' + val.name + '</a></h6>';
                /*var popularItemCategorytitle = popularItemCategory(val.categoryID, val.id);*/
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
        });

        return productHtmlRes;
    }

    sortArrayOfObjects = (arr, key) => {
        return arr.sort((a, b) => {
            return b[key] - a[key];
        });
    };

    function buildHTMLPopularStore(popularRestauantSnapshot) {

        var html = '';
        var alldata = [];
        popularRestauantSnapshot.docs.forEach((listval) => {
            var datas = listval.data();
            datas.id = listval.id;

            var rating = 0;
            var reviewsCount = 0;
            if (datas.hasOwnProperty('reviewsSum') && datas.reviewsSum != 0 && datas.hasOwnProperty('reviewsCount') && datas.reviewsCount != 0) {
                rating = (datas.reviewsSum / datas.reviewsCount);
                rating = Math.round(rating * 10) / 10;
            }
            datas.rating = rating;
            alldata.push(datas);
        });

        if (alldata.length) {
            alldata = sortArrayOfObjects(alldata, "rating");
            //alldata = alldata.reverse();
            alldata = alldata.slice(0, 4);
        }

        var count = 0;
        var popularItemCount = 0;
        html = html + '<div class="row">';
        alldata.forEach((listval) => {

            var val = listval;
            var rating = 0;
            var reviewsCount = 0;
            if (val.hasOwnProperty('reviewsSum') && val.reviewsSum != 0 && val.hasOwnProperty('reviewsCount') && val.reviewsCount != 0) {
                rating = (val.reviewsSum / val.reviewsCount);

                rating = Math.round(rating * 10) / 10;
                reviewsCount = val.reviewsCount;
            }

            if (popularItemCount < 10) {
                popularItemCount++;
                popularStoresList.push(val.id);
            }

            var status = 'Closed';
            var statusclass = "closed";
            if (val.hasOwnProperty('reststatus') && val.reststatus) {
                status = 'Open';
                statusclass = "open";
            }

            var vendor_id_single = val.id;
            var view_vendor_details = "{{ route('vendor',':id')}}";
            view_vendor_details = view_vendor_details.replace(':id', 'id=' + vendor_id_single);
            count++;

            getMinDiscount(val.id);

            html = html + '<div class="col-md-3 pro-list"><div class="list-card position-relative"><div class="list-card-image">';

            if (val.photo) {
                photo = val.photo;
            } else {
                photo = placeholderImageSrc;
            }

            html = html + '<a href="' + view_vendor_details + '"><img alt="#" src="' + photo + '" class="img-fluid item-img w-100"></a></div><div class="py-2 position-relative"><div class="list-card-body"><h6 class="mb-1 popul-title"><a href="' + view_vendor_details + '" class="text-black">' + val.title + '</a></h6><h6>' + val.location + '</h6><h6 class="pr-discount vendor_dis_' + val.id + '"></h6>';

            html = html + '</div>';

            html = html + '<div class="star position-relative"><span class="badge badge-success "><i class="feather-star"></i>' + rating + ' (' + reviewsCount + ')</span></div>';

            html = html + '</div></div></div>';

        });
        html = html + '</div>';

        /*getPopularItem();*/
        return html;
    }

    async function getMinDiscount(vendorId) {
        var min_discount = '';
        var disdata = [];
        var discountRes = couponsRef.where('vendorID', '==', vendorId).get().then(function (couponSnapshots) {
            var min_discount = '';
            couponSnapshots.docs.forEach((coupon) => {
                var cdata = coupon.data();
                disdata.push(parseInt(cdata.discount));
            });
            if (disdata.length) {
                discount = Math.min.apply(Math, disdata);
                min_discount = "Min " + discount + "% off";
                return min_discount;
            }
        });
        var min_discount = await discountRes.then(function (html) {
            return html;
        })
        $('.vendor_dis_' + vendorId).text(min_discount);
    }

    function buildHTMLNewProducts(newproductSnapshot) {

        var html = '';
        var alldata = [];
        newproductSnapshot.docs.forEach((listval) => {
            var datas = listval.data();
            datas.id = listval.id;
            alldata.push(datas);
        });

        html = html + '<div class="row">';
        alldata.forEach((listval) => {
            var val = listval;
            var product_id_single = val.id;
            var view_product_details = "{{ route('productdetail',':id')}}";
            view_product_details = view_product_details.replace(':id', product_id_single);
            var rating = 0;
            var reviewsCount = 0;
            if (val.hasOwnProperty('reviewsSum') && val.reviewsSum != 0 && val.hasOwnProperty('reviewsCount') && val.reviewsCount != 0) {
                rating = (val.reviewsSum / val.reviewsCount);
                rating = Math.round(rating * 10) / 10;
                reviewsCount = val.reviewsCount;
            }

            html = html + '<div class="col-md-3 product-list"><div class="list-card position-relative"><div class="list-card-image">';

            if (val.photo) {
                photo = val.photo;
            } else {
                photo = placeholderImageSrc;
            }
            html = html + '<a href="' + view_product_details + '"><img alt="#" src="' + photo + '" class="img-fluid item-img w-100"></a></div><div class="py-2 position-relative"><div class="list-card-body position-relative"><h6 class="mb-1"><a href="' + view_product_details + '" class="arv-title">' + val.name + '</a></h6>';


            if (val.hasOwnProperty('disPrice') && val.disPrice != '' && val.disPrice != '0') {
                var dis_price = '';
                var or_price = '';
                if (currencyAtRight) {
                    or_price = val.price + "" + currentCurrency;
                    dis_price = val.disPrice + "" + currentCurrency;
                } else {
                    or_price = currentCurrency + "" + val.price;
                    dis_price = currentCurrency + "" + val.disPrice;
                }
                html = html + '<span class="text-gray mb-0 pro-price ">' + dis_price + '  <s>' + or_price + '</s></span>';

            } else {
                var or_price = '';
                if (currencyAtRight) {
                    or_price = val.price + "" + currentCurrency;
                } else {
                    or_price = currentCurrency + "" + val.price;
                }
                html = html + '<span class="text-gray mb-0 pro-price ">' + or_price + '</span>';

            }


            html = html + '<div class="star position-relative"><span class="badge badge-success "><i class="feather-star"></i>' + rating + ' (' + reviewsCount + ')</span></div>';
            html = html + '</div>';
            html = html + '</div></div></div>';
        });
        html = html + '</div>';
        return html;
    }

    function buildHTMLMostSaleStore(mostSaleSnapshot) {
        var html = '';
        var alldata = [];
        mostSaleSnapshot.docs.forEach((listval) => {
            var datas = listval.data();
            datas.id = listval.id;
            alldata.push(datas);
        });

        html = html + '<div class="row">';
        alldata.forEach((listval) => {
            var val = listval;
            var vendor_id_single = val.id;
            var view_vendor_details = "{{ route('vendor',':id')}}";
            view_vendor_details = view_vendor_details.replace(':id', 'id=' + vendor_id_single);
            var rating = 0;
            var reviewsCount = 0;
            if (val.hasOwnProperty('reviewsSum') && val.reviewsSum != 0 && val.hasOwnProperty('reviewsCount') && val.reviewsCount != 0) {
                rating = (val.reviewsSum / val.reviewsCount);
                rating = Math.round(rating * 10) / 10;
                reviewsCount = val.reviewsCount;
            }

            var status = 'Closed';
            var statusclass = "closed";
            if (val.hasOwnProperty('reststatus') && val.reststatus) {
                status = 'Open';
                statusclass = "open";
            }

            getMinDiscount(val.id);

            html = html + '<div class="col-md-3"><div class="align-items-center list-card position-relative"><div class="list-card-image">';

            if (val.photo) {
                photo = val.photo;
            } else {
                photo = placeholderImageSrc;
            }

            html = html + '<a href="' + view_vendor_details + '"><img alt="#" src="' + photo + '" class="img-fluid item-img w-100"></a></div><div class="most-pop-bottom"><div class="list-card-body"><h6 class="mb-1"><a href="' + view_vendor_details + '" class="arv-title">' + val.title + '</a></h6><h6 class="arv-discount vendor_dis_' + val.id + '"></h6>';
            html = html + '</div>';
            html = html + '</div></div></div>';
        });
        html = html + '</div>';
        return html;
    }

    function buildHTMLPopularItem(popularItemsnapshot) {
        var html = '';
        var alldata = [];
        popularItemsnapshot.docs.forEach((listval) => {
            var datas = listval.data();
            datas.id = listval.id;
            alldata.push(datas);
        });

        html = html + '<div class="row">';
        alldata.forEach((listval) => {
            var val = listval;
            var vendor_id_single = val.vendorID;
            var view_vendor_details = "{{ route('vendor',':id')}}";
            view_vendor_details = view_vendor_details.replace(':id', 'id=' + vendor_id_single);
            var rating = 0;
            var reviewsCount = 0

            html = html + '<div class="col-md-3 product-list"><div class="list-card position-relative"><div class="list-card-image">';

            if (val.photo) {
                photo = val.photo;
            } else {
                photo = placeholderImageSrc;
            }

            html = html + '<a href="' + view_vendor_details + '"><img alt="#" src="' + photo + '" class="img-fluid item-img w-100"></a></div><div class="py-2 position-relative"><div class="list-card-body"><h6 class="product-title mb-1"><a href="' + view_vendor_details + '" class="text-black">' + val.name + '</a></h6>';
            var popularItemCategorytitle = popularItemCategory(val.categoryID, val.id);
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


            html = html + '</div>';

            html = html + '</div></div></div>';
        });

        html = html + '</div>';

        return html;
    }

    async function popularItemCategory(categoryId, foodId) {
        var popularItemCategory = '';

        await database.collection('vendor_categories').where("id", "==", categoryId).get().then(async function (categorySnapshots) {

            if (categorySnapshots.docs[0]) {
                var categoryData = categorySnapshots.docs[0].data();
                popularItemCategory = categoryData.title;
                jQuery("#popular_food_category_" + categoryId + "_" + foodId).text(popularItemCategory);
            }
        });
        return popularItemCategory;
    }

    async function catHaveProducts(categoryId) {
        var response = database.collection('vendor_products').where("categoryID", "==", categoryId).get().then(function (CatProducts) {
            if (CatProducts.docs.length > 0) {
                return true;
            } else {
                return false;
            }
        });
        return response;
    }

    function slickcatCarousel() {

        if ($('#top_banner').hasClass('slick-initialized')) {
            $('#top_banner').slick('destroy');
        }

        if ($('#middle_banner').hasClass('slick-initialized')) {
            $('#middle_banner').slick('destroy');

        }
        if ($('#middle_banner1').hasClass('slick-initialized')) {
            $('#middle_banner1').slick('destroy');

        }

        $('#top_banner').slick({
            slidesToShow: 1,
            arrows: true
        });

        $('.middle_banner').slick({
            slidesToShow: 3,
            arrows: true
        });
    }

</script>

@include('layouts.nav')
