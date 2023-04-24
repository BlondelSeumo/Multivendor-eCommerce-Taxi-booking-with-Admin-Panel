@include('layouts.app')

@include('layouts.header')

<div class="siddhi-home-page">
    <div class="bg-primary px-3 d-none mobile-filter pb-3">
        <div class="row align-items-center">
            <div class="input-group rounded shadow-sm overflow-hidden col-md-9 col-sm-9">
                <div class="input-group-prepend">
                    <button class="border-0 btn btn-outline-secondary text-dark bg-white btn-block">
                        <i class="feather-search"></i>
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

    <div class="cabLandingPage">

    </div>
    {{--<div class="car-landing-page">

        <div class="car-landing-banner">
            <img src="https://emartweb.siswebapp.com/img/car-banner.png">
            <div class="car-banner-content">
                <h1 class="mb-4">The Best way to get<br> Wherever you’re going</h1>
                <p class="text-light">We will bring you quickly and comfortably to anywhere in your city</p>
            </div>
        </div>


        <section class="car-lan-about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="content-block">
                            <div class="block-title">
                                <div class="dot-line"></div>
                                <p>Few words about our cab service</p>
                                <h2>Learn about our<br>taxi company</h2>
                            </div>
                            <p>Cab service has provided car services in Oakland area since 2007. What started as a small company has grown into a premier limousine and private transportation company. We have experienced staff and professionally trained chauffeurs, also we are providing you the right vehicle at the right price to fit your budget.</p>
                            <a href="" class="about-btn">Discover More</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hvr-float-shadow">
                            <div class="image-block">
                                <img src="https://emartweb.siswebapp.com/img/car-about.jpg" alt="Image">
                                <div class="bubble-block">
                                    <div class="inner-block">
                                        <p>Trusted by</p>
                                        <span class="counter">4880</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="car-whychoose-sec">

            <div class="container">
                <div class="block-title text-center mb-5">
                    <div class="dot-line"></div>
                    <p>Conexi benefit list</p>
                    <h2 class="text-light">Why choose us</h2>
                </div>
                <div class="row">


                    <div class="col-lg-4">
                        <div class="single-feature-one text-center">
                            <div class="icon-block mb-4">
                                <img src="https://emartweb.siswebapp.com/img/ic1.png">
                            </div>
                            <h3>Safety Guarantee</h3>
                            <p>As a defensive driver, we can avoid crashes and help lower your risk behind the wheel.</p>

                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="single-feature-one text-center">
                            <div class="icon-block mb-4">
                                <img src="https://emartweb.siswebapp.com/img/ic2.png">
                            </div>
                            <h3>DBS Cleared Drivers</h3>
                            <p>We only hire dubs clear drivers, customer safety is our priority</p>

                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="single-feature-one text-center">
                            <div class="icon-block mb-4">
                                <img src="https://emartweb.siswebapp.com/img/ic3.png">
                            </div>
                            <h3>Free Quotation</h3>
                            <p>We can offer you the right vehicle at the right price to fit your budget get free quotation now</p>

                        </div>
                    </div>


                </div>
            </div>
        </section>

        <section class="car-our-adenture bg-white">

            <div class="container">

                <div class="block-title text-center mb-5">

                    <h5>WHE CLIENTS CHOOSE US</h5>
                    <h2 class="pb-2 mb-2">Our advantages</h2>
                    <p>We created our taxi to help you to find the most dependable and highest quality taxi services, anytime and anywhere. All our drivers are uniformed and fully licensed.</p>
                </div>
                <div class="row">
                    <div class="col-md-3 our-adenture-col">
                        <div class="our-adenture-list">
                            <ul class="block-icon">
                                <li>
                                    <span class="icon-image"><img src="https://emartweb.siswebapp.com/img/taxi.png"
                                                                  class="icon-image"></span>
                                    <div class="block-right"><h5>Luxury cars</h5>
                                        <div class="descr">We provide high-quality luxury car rentals for competitive prices across World.

                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <span class="icon-image"><img
                                                src="https://emartweb.siswebapp.com/img/carlocation-icon.png"
                                                class="icon-image"></span>
                                    <div class="block-right">
                                        <h5>Lots of locations </h5>
                                        <div class="descr">We provide our transportation services nationwide
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 our-adenture-col-center">
                        <div class="our-adenture-img mb-4">
                            <img src="https://emartweb.siswebapp.com/img/texi-car.jpg">
                        </div>
                    </div>
                    <div class="col-md-3 our-adenture-col">
                        <div class="our-adenture-list adenture-list-rg">
                            <ul class="block-icon">
                                <li>
                                    <span class="icon-image"><img
                                                src="https://emartweb.siswebapp.com/img/navigation.png"
                                                class="icon-image"></span>
                                    <div class="block-right">
                                        <h5>Amazing app</h5>
                                        <div class="descr">Download our amazing app for book a quick ride & better experience
                                        </div>
                                    </div>
                                </li>
                                <li>

                                    <span class="icon-image bg-transparent"><img
                                                src="https://emartweb.siswebapp.com/img/suitcase-bag.png"
                                                class="icon-image"></span>
                                    <div class="block-right">
                                        <h5>Additional services </h5>
                                        <div class="descr">We offer vehicles including sedans, limousines and coach buses</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="car-download-sec position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 text-lg-start">
                        <div class="block-title mb-4">
                            <p class="sub-title">Download eMart App Now</p>
                            <h2 class="sec-title text-white fw-semibold">Get Free eMart App<br>On Online Store</h2>
                        </div>
                        <p class="text-light mb-4">With our app we are sure to have a ride to fit your needs. We get you where you want to go, when you want to go and in the type of vehicle best suited to you.</p>
                        <div class="download-btn-wrap">
                            <a target="_blank" href="https://play.google.com/" class="download-btn">
                                <img src="https://emartweb.siswebapp.com/img/cab_google_play.png">
                            </a>
                            <a target="_blank" href="https://www.apple.com/store" class="download-btn">
                                <img src="https://emartweb.siswebapp.com/img/cab_app_store.png">

                            </a>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="app-mockup">
                            <img src="https://emartweb.siswebapp.com/img/down-mobile_img.png" alt="app mockup">
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>--}}

</div>
@include('layouts.footer')

<script src="https://unpkg.com/geofirestore@5.2.0/dist/geofirestore.js"></script>
<script src="https://cdn.firebase.com/libs/geofire/5.0.1/geofire.min.js"></script>
<script type="text/javascript" src="{{asset('vendor/slick/slick.min.js')}}"></script>

<script type="text/javascript">

    var database = firebase.firestore();

    var cabLandingPageRef = database.collection('sections').where('id', '==', section_id);

    cabLandingPageRef.get().then(async function (snapshots) {

        var cabLandingPageData = snapshots.docs[0].data();

            if (cabLandingPageData.cab_service_template && cabLandingPageData.cab_service_template != "" && cabLandingPageData.cab_service_template != undefined) {
                $('.cabLandingPage').html(cabLandingPageData.cab_service_template);

            }
    });
</script>
@include('layouts.nav')