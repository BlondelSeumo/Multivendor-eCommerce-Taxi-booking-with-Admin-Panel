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


    <div class="parcel_delivery_content mt-5 mb-5">


        <section id="tabs">
            <div class="container">

                <div class="parcel_delivery">

                    <div class="error_top"></div>
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                               href="#as-soon-as-possible" role="tab" aria-controls="as-soon-as-possible"
                               aria-selected="true"><img
                                        src="../img/asap_unselected.png">{{trans('lang.as_soon_as_possible')}}</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#schedule"
                               role="tab" aria-controls="schedule" aria-selected="false"><img
                                        src="../img/schedule_unselected.png"> {{trans('lang.schedule')}}</a>

                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="as-soon-as-possible" role="tabpanel"
                             aria-labelledby="nav-home-tab">
                            <div class="tab-inner">
                                <div class="tab-title sende-title">
                                    <h3><span>1</span>{{trans('lang.sender_info')}}</h3>
                                </div>
                                <form action="https://emartweb.siswebapp.com/sendemail/send" method="post">
                                    <div class="row">
                                        <div class="inputField col-md-6">

                                            <input type="text" class="form-control senderAddress" value="" id="sender_address"
                                                   name="address" required="" placeholder=" ">
                                            <span for="exampleFormControlInput1">{{trans('lang.sender_address')}}</span>
                                        </div>
                                        <div class="inputField col-md-6">

                                            <input type="email" class="form-control senderName" value="" name="name"
                                                   required="" placeholder=" ">
                                            <span for="exampleFormControlInput2">{{trans('lang.sender_name')}}</span>
                                        </div>
                                        <div class="inputField col-md-6">

                                            <input type="text" class="form-control senderPhone" required=""
                                                   placeholder=" ">
                                            <span for="exampleFormControlInput3">{{trans('lang.phone_number')}}</span>
                                        </div>
                                        <div class="inputField col-md-6">
                                            <label for="exampleFormControlTextarea1"></label>
                                            <br><br>
                                            <select class="form-control senderParcelWeight"
                                                    style="border-top:none;border-left:none;border-right:none;">
                                                <option value="">{{trans('lang.select')}} {{trans('lang.parcel_weight')}}</option>
                                            </select>

                                        </div>
                                        <div class="inputField col-md-6">

                                            <input type="text" class="form-control senderNote" required=""
                                                   placeholder=" ">
                                            <span for="exampleFormControlTextarea1">{{trans('lang.note')}}</span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-inner">
                                <div class="tab-title sende-title">
                                    <h3><span>2</span> {{trans('lang.receiver_info')}}</h3>
                                </div>
                                <form action="https://emartweb.siswebapp.com/sendemail/send" method="post">
                                    <div class="row">
                                        <div class="inputField col-md-6">

                                            <input type="text" class="form-control receiverAddress" value=""
                                                id="receiver_address"   name="address" required="" placeholder=" ">
                                            <span for="exampleFormControlInput1">{{trans('lang.receiver_address')}}</span>
                                        </div>
                                        <div class="inputField col-md-6">

                                            <input type="email" class="form-control receiverName" value="" name="name"
                                                   required="" placeholder=" ">
                                            <span for="exampleFormControlInput2">{{trans('lang.sender_name')}}</span>
                                        </div>

                                        <div class="inputField col-md-6">

                                            <input type="text" class="form-control receiverPhone" required=""
                                                   placeholder="">
                                            <span for="exampleFormControlInput3">{{trans('lang.phone_number')}}</span>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-inner">
                                <div class="tab-title sende-title">
                                    <h3><span>3</span> {{trans('lang.upload_parcel_image')}}</h3>
                                </div>
                                <form action="https://emartweb.siswebapp.com/sendemail/send" method="post">

                                    <div class="row">
                                        <div class="inputField col-md-6">
                                            <div class="parcelImageUploadDiv">
                                                <input type="file" onChange="handleFileSelect(event)" class="col-7">
                                                <div class="uploding_image_photos"></div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="form-group row width-50">
                                        <div class="appendParcelImages">

                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-btn">
                                <button type="button" class="btn btn-primary parcel_btn">Continue</button>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="schedule" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="tab-inner">
                                <div class="tab-title sende-title">
                                    <h3><span>1</span>{{trans('lang.sender_info')}}</h3>
                                </div>
                                <form action="https://emartweb.siswebapp.com/sendemail/send" method="post">
                                    <div class="row">
                                        <div class="inputField col-md-6">

                                            <input type="text" class="form-control senderAddress sender_address pac-target-input" value=""
                                             id="sender_address_schedule"
                                                   name="address" required="" placeholder=" " >

                                            <span for="exampleFormControlInput1">{{trans('lang.sender_address')}}</span>
                                        </div>
                                        <div class="inputField col-md-6">

                                            <input type="email" class="form-control senderName" value="" name="name"
                                                   required="" placeholder=" ">
                                            <span for="exampleFormControlInput2">{{trans('lang.sender_name')}}</span>
                                        </div>
                                        <div class="inputField col-md-6">

                                            <input type="text" class="form-control senderPhone" required=""
                                                   placeholder=" ">
                                            <span for="exampleFormControlInput3">{{trans('lang.phone_number')}}</span>
                                        </div>

                                        <div class="inputField col-md-6">
                                            <label for="exampleFormControlTextarea1"></label>
                                            <br><br>
                                            <select class="form-control senderParcelWeight"
                                                    style="border-top:none;border-left:none;border-right:none;">
                                                <option value="">{{trans('lang.select')}} {{trans('lang.parcel_weight')}}</option>
                                            </select>

                                        </div>
                                        <div class="inputField col-md-6">

                                            <input type="datetime-local" class="form-control senderArrive" required=""
                                                   placeholder="Select date & time">
                                            <span for="exampleFormControlTextarea1">{{trans('lang.when_pickup_address')}}</span>
                                        </div>
                                        <div class="inputField col-md-6">

                                            <input type="text" class="form-control senderNote" required=""
                                                   placeholder=" ">
                                            <span for="exampleFormControlTextarea1">{{trans('lang.note')}}</span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-inner">
                                <div class="tab-title sende-title">
                                    <h3><span>2</span> {{trans('lang.receiver_info')}} </h3>
                                </div>
                                <form action="https://emartweb.siswebapp.com/sendemail/send" method="post">
                                    <div class="row">
                                        <div class="inputField col-md-6">

                                            <input type="text" class="form-control receiverAddress" value=""
                                                  id="receiver_address_schedule"  name="address" required="" placeholder="">
                                            <span for="exampleFormControlInput1">{{trans('lang.receiver_address')}}</span>
                                        </div>
                                        <div class="inputField col-md-6">

                                            <input type="email" class="form-control receiverName" value="" name="name"
                                                   required="" placeholder=" ">
                                            <span for="exampleFormControlInput2">{{trans('lang.sender_name')}}</span>
                                        </div>
                                        <div class="inputField col-md-6">

                                            <input type="text" class="form-control receiverPhone" required=""
                                                   placeholder=" ">
                                            <span for="exampleFormControlInput3">{{trans('lang.phone_number')}}</span>
                                        </div>

                                        <div class="inputField col-md-6">

                                            <input type="datetime-local" class="form-control rceiverArrive" required=""
                                                   placeholder="Select date & time">
                                            <span for="exampleFormControlTextarea1">{{trans('lang.when_arrive_address')}}</span>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-inner">
                                <div class="tab-title sende-title">
                                    <h3><span>3</span> {{trans('lang.upload_parcel_image')}}</h3>
                                </div>
                                <form action="https://emartweb.siswebapp.com/sendemail/send" method="post">

                                    <div class="row">
                                        <div class="inputField col-md-6">
                                            <div class="parcelImageUploadDiv">
                                                <input type="file" onChange="handleFileSelect(event)" class="col-7">
                                                <div class="uploding_image_photos"></div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="form-group row width-50">
                                        <div class="appendParcelImages">

                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-btn">
                                <button type="button" class="btn btn-primary parcel_btn">Continue</button>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>

    </div>


</div>

@include('layouts.footer')

<script src="https://unpkg.com/geofirestore/dist/geofirestore.js"></script>
<script src="https://cdn.firebase.com/libs/geofire/5.0.1/geofire.min.js"></script>
<script type="text/javascript" src="{{asset('vendor/slick/slick.min.js')}}"></script>

<script type="text/javascript">


    var section_id = "<?php echo @$_COOKIE['section_id'] ?>";

    var tax_amount = "";
    var tax_lable = "";
    var tax_type = "";
    var parcelWeightRef = database.collection('parcel_weight');
    var parcelImages = [];
    var parcelImagesCount = 0;

    var currentCurrency = '';
    var currencyAtRight = false;
    var decimal_degits = 0;

    var refCurrency = database.collection('currencies').where('isActive', '==', true);


    refCurrency.get().then(async function (snapshots) {
        currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;

        if (currencyData.decimal_degits) {
            decimal_degits = currencyData.decimal_degits;
        }
    });

    parcelWeightRef.get().then(async function (parcelWeightSnapshots) {

        parcelWeightSnapshots.docs.forEach((listval) => {
            var data = listval.data();
            $('.senderParcelWeight').append($("<option></option>")
                .attr("value", data.id)
                .text(data.title)
                .attr("delivery_charge", data.delivery_charge));

        });

    });

    var sectionRef = database.collection('sections').doc(section_id);

    sectionRef.get().then(async function (sectionRefSnapshots) {

        section = sectionRefSnapshots.data();

        if (section.tax_active) {
            tax_type = section.tax_type;
            tax_lable = section.tax_lable;
            tax_amount = section.tax_amount;
        }
    });

    var address_name = getCookie('address_name');
    let sender_address_lng = getCookie('address_lng');
    let sender_address_lat = getCookie('address_lat');
    let receiver_address_lng = "";
    let receiver_address_lat = "";

    if (address_name != undefined) {
        $('.active').find('.senderAddress').val(address_name);
    }

    let activeTabId = $('.active').attr('href');

    $(document).on('click', '.nav-item', function () {

        activeTabId = $(this).attr('href');
        $(activeTabId).find('.senderAddress').val(address_name);

    });

    async function getSenderAddress(callback) {

        var geocoder = new google.maps.Geocoder();

        var senderAddress = $(activeTabId).find('.senderAddress').val();
        console.log(senderAddress);
        geocoder.geocode({'address': senderAddress}, function (results, status) {

            if (status == google.maps.GeocoderStatus.OK) {
                sender_address_lat = results[0].geometry.location.lat();
                sender_address_lng = results[0].geometry.location.lng();
                callback(true);
            }
        });
    }

    function getReceiverAddress(callback) {
        var geocoder = new google.maps.Geocoder();

        var receiverAddress = $(activeTabId).find('.receiverAddress').val();
        console.log(receiverAddress);
        geocoder.geocode({'address': receiverAddress}, function (results, status) {

            if (status == google.maps.GeocoderStatus.OK) {
                receiver_address_lat = results[0].geometry.location.lat();
                receiver_address_lng = results[0].geometry.location.lng();
                callback(true);
            }
        });

    }

    $(document).on('click', '.parcel_btn', function () {

        var senderAddress = $(activeTabId).find('.senderAddress').val();
        var senderName = $(activeTabId).find('.senderName').val();
        var senderPhone = $(activeTabId).find('.senderPhone').val();
        var senderParcelWeight = $(activeTabId).find('.senderParcelWeight option:selected').val();
        var senderParcelWeightName = $(activeTabId).find('.senderParcelWeight option:selected').text();
        var delivery_charge = $(activeTabId).find('.senderParcelWeight option:selected').attr('delivery_charge');
        var senderNote = $(activeTabId).find('.senderNote').val();
        let senderPickupDateTime = "";
        let receiverPickupDateTime = "";

        var receiverAddress = $(activeTabId).find('.receiverAddress').val();
        var receiverName = $(activeTabId).find('.receiverName').val();
        var receiverPhone = $(activeTabId).find('.receiverPhone').val();
        var parcelCategoryId = '<?php echo $id; ?>';
        var isSchedule = false;

        getSenderAddress(function (response) {

            getReceiverAddress(function (response) {

                if (activeTabId == "#schedule") {

                    isSchedule = true;

                    senderPickupDateTime = new Date($(activeTabId).find('.senderArrive').val());
                    receiverPickupDateTime = new Date($(activeTabId).find('.rceiverArrive').val());

                }

                var discount = 0;

                if (senderAddress == "") {

                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.sender_address_error')}}</p>");
                    window.scrollTo(0, 0);

                } else if (senderName == "") {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.sender_name_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (senderPhone == "") {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.sender_phone_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (senderParcelWeight == "") {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.sender_parcel_weight_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (senderNote == "") {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.sender_note_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (activeTabId == "#schedule" && senderPickupDateTime == "") {

                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.when_pickup_address_error')}}</p>");
                    window.scrollTo(0, 0);

                } else if (activeTabId == "#schedule" && receiverPickupDateTime == "") {

                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.when_arrive_address_error')}}</p>");
                    window.scrollTo(0, 0);

                } else if (receiverAddress == "") {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.receiver_address_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (receiverName == "") {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.receiver_name_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (receiverPhone == "") {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.receiver_phone_error')}}</p>");
                    window.scrollTo(0, 0);
                } else {


                    $.ajax({

                        type: 'POST',

                        url: "<?php echo route('parcel_cart'); ?>",

                        data: {
                            _token: '<?php echo csrf_token(); ?>',
                            section_id: section_id,
                            parcelCategoryId: parcelCategoryId,
                            isSchedule: isSchedule,
                            senderAddress: senderAddress,
                            senderName: senderName,
                            senderPhone: senderPhone,
                            senderParcelWeight: senderParcelWeight,
                            senderParcelWeightName: senderParcelWeightName,
                            senderNote: senderNote,
                            senderPickupDateTime: senderPickupDateTime,
                            receiverPickupDateTime: receiverPickupDateTime,
                            receiverAddress: receiverAddress,
                            receiverName: receiverName,
                            receiverPhone: receiverPhone,
                            sender_address_lng: sender_address_lng,
                            sender_address_lat: sender_address_lat,
                            receiver_address_lng: receiver_address_lng,
                            receiver_address_lat: receiver_address_lat,
                            delivery_charge: delivery_charge,
                            tax_type: tax_type,
                            tax_lable: tax_lable,
                            tax_amount: tax_amount,
                            discount: discount,
                            parcelImages: JSON.stringify(parcelImages),
                            decimal_degits : decimal_degits,

                        },

                        success: function (data) {
                            data = JSON.parse(data);

                            var url = "{{ route('parcel_checkout')}}";
                            window.location.href = url;
                        }

                    });
                }

            });
        });

    });

    var storageRef = firebase.storage().ref('images');

    function handleFileSelect(evt) {
        var f = evt.target.files[0];
        var reader = new FileReader();
        reader.onload = (function (theFile) {
            return function (e) {

                var filePayload = e.target.result;
                var hash = CryptoJS.SHA256(Math.random() + CryptoJS.SHA256(filePayload));
                var val = f.name;
                var ext = val.split('.')[1];
                var docName = val.split('fakepath')[1];
                var filename = (f.name).replace(/C:\\fakepath\\/i, '')

                var timestamp = Number(new Date());
                 var filename = filename.split('.')[0]+"_"+timestamp+'.'+ext;
                var uploadTask = storageRef.child(filename).put(theFile);
                console.log(uploadTask);
                uploadTask.on('state_changed', function (snapshot) {

                    var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                    console.log('Upload is ' + progress + '% done');

                    $(activeTabId).find(".uploding_image_photos").text("Image is uploading...");

                }, function (error) {
                }, function () {
                    uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {

                        $(activeTabId).find(".uploding_image_photos").text("Upload is completed");

                        if (downloadURL) {

                            parcelImagesCount++;
                            photos_html = '<div id="parcelPhotos"><span class="image-item" id="photo_' + parcelImagesCount + '"><span class="remove-btn" data-id="' + parcelImagesCount + '" data-img="' + downloadURL + '"><i class="fa fa-remove"></i></span><img width="100px" id="" height="auto" src="' + downloadURL + '"></span></div>';
                            $(activeTabId).find(".appendParcelImages").append(photos_html);
                            parcelImages.push(downloadURL);

                        }

                    });
                });

            };
        })(f);
        reader.readAsDataURL(f);
    }

    $(document).on("click", ".remove-btn", function () {
        var id = $(this).attr('data-id');
        var photo_remove = $(this).attr('data-img');
        $("#photo_" + id).remove();
        index = parcelImages.indexOf(photo_remove);
        if (index > -1) {
            parcelImages.splice(index, 1); // 2nd parameter means remove one item only
        }

    });

$(document).ready(function () {
  var input = document.getElementById('sender_address');
 var autocomplete = new google.maps.places.Autocomplete(input);

  autocomplete.addListener('place_changed', function () {

      var place = autocomplete.getPlace();
      address_name = place.name;
      address_lat = place.geometry.location.lat();
      address_lng = place.geometry.location.lng();

    //  $('#address_lng').val(address_lng);
      //$('#address_lat').val(address_lat);

      $('#sender_address').val(place.name);
      });

      var receiver_address = document.getElementById('receiver_address');
     var autocomplete = new google.maps.places.Autocomplete(receiver_address);

      autocomplete.addListener('place_changed', function () {

          var place = autocomplete.getPlace();
          address_name = place.name;
          address_lat = place.geometry.location.lat();
          address_lng = place.geometry.location.lng();

        //  $('#address_lng').val(address_lng);
          //$('#address_lat').val(address_lat);

          $('#receiver_address').val(place.name);

      });
      var sender_address_schedule = document.getElementById('sender_address_schedule');
     var autocomplete = new google.maps.places.Autocomplete(sender_address_schedule);

      autocomplete.addListener('place_changed', function () {

          var place = autocomplete.getPlace();
          address_name = place.name;
          address_lat = place.geometry.location.lat();
          address_lng = place.geometry.location.lng();

        //  $('#address_lng').val(address_lng);
          //$('#address_lat').val(address_lat);

          $('#sender_address_schedule').val(place.name);
          });
      var receiver_address_schedule = document.getElementById('receiver_address_schedule');
     var autocomplete = new google.maps.places.Autocomplete(receiver_address_schedule);

      autocomplete.addListener('place_changed', function () {

          var place = autocomplete.getPlace();
          address_name = place.name;
          address_lat = place.geometry.location.lat();
          address_lng = place.geometry.location.lng();

        //  $('#address_lng').val(address_lng);
          //$('#address_lat').val(address_lat);

          $('#receiver_address_schedule').val(place.name);

      });




});






</script>
@include('layouts.nav')
