@include('layouts.app')

@include('layouts.header')

<div class="siddhi-home-page">
    <div class="bg-primary px-3 d-none mobile-filter pb-3">
        <div class="row align-items-center">
            <div class="input-group rounded shadow-sm overflow-hidden col-md-9 col-sm-9">
                <div class="input-group-prepend">
                    <button class="border-0 btn btn-outline-secondary text-dark bg-white btn-block"><i
                                class="feather-search"></i></button>
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


    <!-- /************************home banner****************/ -->

    <div class="parcel-banner">

        <div class="parcel-inner">

            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="homebanner-content">
                            <h1>{{trans('lang.we_give_best_service')}}<br>{{trans('lang.for_you')}}</h1>
                            <!-- <p>Premium & prestige car hourly rental. Experience the trill at a lower price.</p>
                            <a href="#" class="btn btn-primary">Get Started</a>-->
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="banner-img">
                            <img src="img/parcel_hero_banner.png">
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>


    <!-- /************************home banner****************/ -->

    <div class="parcel-content bg-white">


        <section class="whtare-sending">
            <div class="container">
                <div class="sction-title text-center">
                    <h2>What are you sending?</h2>
                </div>
                <div class="row" id="parcel_category"></div>
            </div>
        </section>


    </div>


</div>

@include('layouts.footer')
<script src="https://unpkg.com/geofirestore/dist/geofirestore.js"></script>
<script src="https://cdn.firebase.com/libs/geofire/5.0.1/geofire.min.js"></script>
<script type="text/javascript" src="{{asset('vendor/slick/slick.min.js')}}"></script>
<script type="text/javascript">

    var geoFirestore = new GeoFirestore(firestore);
    var database = firebase.firestore();
    var placeholderImage = '';
    var placeholder = database.collection('settings').doc('placeHolderImage');


    var ref = database.collection('parcel_categories');

    async function placeHolderImage() {
        var placeHolderData = placeholder.get().then(async function (snapshotsimage) {
            var placeholderImageData = snapshotsimage.data();
            placeholderImage = placeholderImageData.image;
            //console.log(placeholderImage);
            return placeholderImage;

        });

        var refResponse = await placeHolderData.then(function (response) {

            return response;
        });

        return refResponse;
    }

    if ($("#parcel_category").html() == '') {
        var ref = database.collection('parcel_categories').where('publish', '==', true);

        placeHolderImage().then(function (response) {

            var parcel_image = response;
            ref.get().then(async function (snapshots) {
                var sections = [];
                snapshots.docs.forEach((section) => {
                    var datas = section.data();

                    if (datas.image != null && datas.image != undefined && datas.image != "") {
                         parcel_image = datas.image;
                    }else{
                        parcel_image = response;
                    }

                    html = '<div class="col-md-4 mb-4 parcel_category_details" data-id="' + datas.id + '"><div class="eh-are-box d-flex align-items-center p-3"><div class="par-img mr-5"><img src="' + parcel_image + '" class="img-fluid"></div><div class="media-body"><h3>' + datas.title + '</h3></div></div></div>';
                    $("#parcel_category").append(html);

                    sections.push(datas);

                });

            });
        });


    }

    $(document).on('click', '.parcel_category_details', function () {

        var id = $(this).attr('data-id');
        var url = "{{ route('parcel',':id')}}";
        url = url.replace(':id', id);

        window.location.href = url;

    });

</script>
@include('layouts.nav')
