@extends('layouts.app')


@section('content')

<div class="page-wrapper">

    <div class="row page-titles">


        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">{{trans('lang.brand')}}</h3>

        </div>

        <div class="col-md-7 align-self-center">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                <li class="breadcrumb-item"><a href="{!! route('brands') !!}">{{trans('lang.brand')}}</a></li>

                <li class="breadcrumb-item active">{{trans('lang.brand_create')}}</li>

            </ol>

        </div>

    </div>

    <div class="card-body">

        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">
            {{trans('lang.processing')}}
        </div>

        <div class="error_top"></div>

        <div class="row vendor_payout_create">

            <div class="vendor_payout_create-inner">

                <fieldset>

                    <legend>{{trans('lang.brand')}}</legend>


                    <div class="form-group row width-50">

                        <label class="col-3 control-label">{{trans('lang.title')}}</label>

                        <div class="col-7">

                            <input type="text" class="form-control title">

                        </div>

                    </div>
                    <div class="form-group row width-50">
                        <label class="col-3 control-label ">{{trans('lang.select_section')}}</label>
                        <div class="col-7">
                            <select name="section_id" id="section_id" class="form-control">
                                <option value="">{{trans('lang.select')}}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row width-100">

                        <div class="form-check width-100">

                            <input type="checkbox" id="is_publish">

                            <label class="col-3 control-label" for="is_publish">{{trans('lang.is_publish')}}</label>

                        </div>

                    </div>

                    <div class="form-group row width-50">

                        <label class="col-3 control-label">{{trans('lang.photo')}}</label>

                        <input type="file" onChange="handleFileSelect(event)" class="col-7">

                        <div id="uploding_image"></div>

                        <div class="placeholder_img_thumb user_image"></div>
                    </div>

                </fieldset>

            </div>
        </div>

    </div>

    <div class="form-group col-12 text-center">

        <button type="button" class="btn btn-primary  create_banner_btn"><i class="fa fa-save"></i>
            {{trans('lang.save')}}
        </button>

        <a href="{!! route('brands') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>

    </div>

</div>


@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>

<script>

    var database = firebase.firestore();

    var photo = "";

    var storageRef = firebase.storage().ref('images');
    var ref_sections = database.collection('sections').where("serviceTypeFlag", "==", "ecommerce-service");
    var sections_list = [];
    $(document).ready(function () {
        ref_sections.get().then(async function (snapshots) {

            snapshots.docs.forEach((listval) => {
                var data = listval.data();
                sections_list.push(data);
                $('#section_id').append($("<option></option>")
                    .attr("value", data.id)
                    .text(data.name));
            })
        })
    });

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
                var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;
                var uploadTask = storageRef.child(filename).put(theFile);

                console.log(uploadTask);

                uploadTask.on('state_changed', function (snapshot) {


                    var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;

                    console.log('Upload is ' + progress + '% done');

                    jQuery("#uploding_image").text("Image is uploading...");


                }, function (error) {

                }, function () {

                    uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {

                        jQuery("#uploding_image").text("Upload is completed");

                        photo = downloadURL;

                        $(".user_image").empty();

                        $(".user_image").append('<img class="rounded" style="width:50px" src="' + photo + '" alt="image">');


                    });

                });

            };

        })(f);

        reader.readAsDataURL(f);

    }

    $(".create_banner_btn").click(function () {


        var section = $('#section_id').val();
        var title = $(".title").val();
        var is_publish = false;

        if ($("#is_publish").is(':checked')) {

            is_publish = true;

        }

        if (title == '') {

            $(".error_top").show();

            $(".error_top").html("");

            $(".error_top").append("<p>{{trans('lang.title_error')}}</p>");

            window.scrollTo(0, 0);

        } else {

            var id = "<?php echo uniqid(); ?>";

            database.collection('brands').doc(id).set({
                'title': title,
                'photo': photo,
                'id': id,
                'is_publish': is_publish,
                'sectionId': section
            }).then(function (result) {
                window.location.href = '{{ route("brands")}}';

            }).catch(function (error) {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>" + error + "</p>");

            });
        }
    });


</script>

@endsection
