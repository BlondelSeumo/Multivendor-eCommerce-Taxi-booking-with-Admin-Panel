@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.category_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a
                            href="{!! route('categories') !!}">{{trans('lang.category_plural')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.category_edit')}}</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="cat-edite-page max-width-box">
            <div class="card  pb-4">
                <div class="card-header">
                    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                        <li role="presentation" class="nav-item">
                            <a href="#category_information" aria-controls="category_information" role="tab"
                               data-toggle="tab" class="nav-link active">{{trans('lang.category_information')}}</a>
                        </li>
                        <li role="presentation" class="nav-item">
                            <a href="#review_attributes" aria-controls="review_attributes" role="tab"
                               data-toggle="tab" class="nav-link">{{trans('lang.reviewattribute_plural')}}</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">

                    <div id="data-table_processing" class="dataTables_processing panel panel-default"
                         style="display: none;">{{trans('lang.processing')}}
                    </div>
                    <div class="error_top" style="display:none"></div>
                    <div class="row vendor_payout_create" role="tabpanel">

                        <div class="vendor_payout_create-inner tab-content">

                            <div role="tabpanel" class="tab-pane active" id="category_information">

                                <fieldset>
                                    <legend>{{trans('lang.category_edit')}}</legend>
                                    <div class="form-group row width-100">
                                        <label class="col-3 control-label">{{trans('lang.category_name')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control cat-name">
                                            <div class="form-text text-muted">{{ trans("lang.category_name_help") }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row width-100">
                                        <label class="col-3 control-label ">{{trans('lang.category_description')}}</label>
                                        <div class="col-7">
                                                <textarea rows="7" class="category_description form-control"
                                                          id="category_description"></textarea>
                                            <div class="form-text text-muted">{{ trans("lang.category_description_help")
                                                }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row width-100">
                                        <label class="col-3 control-label ">{{trans('lang.select_section')}}</label>
                                        <div class="col-7">
                                            <select name="section_id" id="section_id" class="form-control">
                                                <option value="">{{trans('lang.select')}}</option>
                                            </select>
                                            <p style="color: red;font-size: 13px;"> Rental/Parcel/Cab Service are not
                                                shown in this sections</p>

                                        </div>
                                    </div>

                                    <div class="form-group row width-100">
                                        <label class="col-3 control-label">{{trans('lang.category_image')}}</label>
                                        <div class="col-7">
                                            <input type="file" id="category_image"
                                                   onChange="handleFileSelect(event)">
                                            <div class="placeholder_img_thumb cat_image"></div>
                                            <div id="uploding_image"></div>
                                            <div class="form-text text-muted w-50">{{ trans("lang.category_image_help")
                                                }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-check width-100">
                                        <input type="checkbox" class="item_publish" id="item_publish">
                                        <label class="col-3 control-label"
                                               for="item_publish">{{trans('lang.item_publish')}}</label>
                                    </div>

                                    <div class="form-check row width-100" id="show_in_home" style="display: none;">
                                        <input type="checkbox" id="show_in_homepage">
                                        <label class="col-3 control-label"
                                               for="show_in_homepage">{{trans('lang.show_in_home')}}</label>
                                        <div class="form-text text-muted w-50">{{trans('lang.show_in_home_desc')}}
                                            <span id="forsection"></span></div>
                                    </div>

                                </fieldset>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="review_attributes">
                            </div>
                        </div>

                    </div>

                </div>
                <div class="form-group col-12 text-center btm-btn">
                    <button type="button" class="btn btn-primary save_category_btn"><i
                                class="fa fa-save"></i> {{trans('lang.save')}}
                    </button>
                    <a href="{!! route('categories') !!}" class="btn btn-default"><i
                                class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
<script>
    var id = "<?php echo $id;?>";
    var database = firebase.firestore();
    var ref_sections = database.collection('sections');
    var ref = database.collection('vendor_categories').where("id", "==", id);
    var ref_review_attributes = database.collection('review_attributes');
    var selected_review_attributes = '';
    var category = '';
    var photo = "";
    var placeholderImage = '';
    var placeholder = database.collection('settings').doc('placeHolderImage');

    var order = 0;
    placeholder.get().then(async function (snapshotsimage) {
        var placeholderImageData = snapshotsimage.data();
        placeholderImage = placeholderImageData.image;
    })

    $(document).ready(function () {
        jQuery("#data-table_processing").show();

        ref_sections.get().then(async function (snapshots) {

            snapshots.docs.forEach((listval) => {
                var data = listval.data();
                if (data.serviceTypeFlag == "delivery-service" || data.serviceTypeFlag == "ecommerce-service") {
                    $('#section_id').append($("<option></option>")
                        .attr("value", data.id).attr("data-service-type", data.serviceTypeFlag)
                        .text(data.name));
                }
            })
        })

        ref.get().then(async function (snapshots) {
            category = snapshots.docs[0].data();
            $(".cat-name").val(category.title);

            order = category.order;


            $(".category_description").val(category.description);
            if (category.section_id != undefined) {
                $("#section_id").val(category.section_id);
            }
            photo = category.photo;

            if (photo != '' && photo != null) {

                $(".cat_image").append('<img class="rounded" style="width:50px" src="' + photo + '" alt="image">');
            } else {

                $(".cat_image").append('<img class="rounded" style="width:50px" src="' + placeholderImage + '" alt="image">');
            }

            if (category.publish) {
                $(".item_publish").prop('checked', true);
            }

            if ($("#section_id").val() && ($("#section_id").find(':selected').data('service-type') == "ecommerce-service" || $("#section_id").find(':selected').data('service-type') == "delivery-service")) {
                $("#show_in_home").show();
                if (category.show_in_homepage) {
                    $("#show_in_homepage").prop('checked', true);
                }
                $("#forsection").text(" for " + $("#section_id option:selected").text() + " section");
            } else {
                $("#show_in_homepage").prop('checked', false);
                $("#show_in_home").hide();
            }

            jQuery("#data-table_processing").hide();


        })

        ref_review_attributes.get().then(async function (snapshots) {
            var ra_html = '';
            snapshots.docs.forEach((listval) => {
                var data = listval.data();
                ra_html += '<div class="form-check width-100" >';
                var checked = $.inArray(data.id, category.review_attributes) !== -1 ? 'checked' : '';
                ra_html += '<input type="checkbox" id="review_attribute_' + data.id + '" value="' + data.id + '" ' + checked + '>';
                ra_html += '<label class="col-3 control-label" for="review_attribute_' + data.id + '">' + data.title + '</label>';
                ra_html += '</div>';
            })
            $('#review_attributes').html(ra_html);
        })


        $("#section_id").change(function () {
            var service_type = $(this).find(':selected').data('service-type')
            if (service_type == "ecommerce-service" || service_type == "delivery-service") {
                $("#show_in_home").show();
                $("#forsection").text(" for " + $("#section_id option:selected").text() + " section");
            } else {
                $("#show_in_home").hide();
            }
            $("#show_in_homepage").prop('checked', false);
        });


        $(".save_category_btn").click(async function () {

            var title = $(".cat-name").val();
            var description = $(".category_description").val();
            var section_id = $("#section_id").val();
            var itemPublish = $(".item_publish").is(":checked");
            var show_in_homepage = $("#show_in_homepage").is(":checked");

            var review_attributes = [];
            $('#review_attributes input').each(function () {
                if ($(this).is(':checked')) {
                    review_attributes.push($(this).val());
                }
            });

            if (title == '') {

                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.enter_cat_title_error')}}</p>");
                window.scrollTo(0, 0);
            } else if (section_id == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.select_section_error')}}</p>");
                window.scrollTo(0, 0);
            } else if (photo == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.upload_image_error')}}</p>");
                window.scrollTo(0, 0);
            } else {


                var count_vendor_categories = 0;
                if (show_in_homepage) {

                    await database.collection('vendor_categories').where('show_in_homepage', "==", true).where("section_id", "==", section_id).where("id", "!=", id).get().then(async function (snapshots) {

                        count_vendor_categories = snapshots.docs.length;

                    });
                }

                if (count_vendor_categories >= 5) {
                    alert("Already 5 categories are active for show in homepage..");
                    return false;
                    
                } else {

                    database.collection('vendor_categories').doc(id).update({
                        'section_id': section_id,
                        'title': title,
                        'description': description,
                        'photo': photo,
                        'review_attributes': review_attributes,
                        'publish': itemPublish,
                        'show_in_homepage': show_in_homepage,
                        'order': parseInt(order),
                    }).then(function (result) {
                        window.location.href = '{{ route("categories")}}';
                    });
                }


            }

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
                var val = $('#category_image').val().toLowerCase();
                var ext = val.split('.')[1];
                var docName = val.split('fakepath')[1];
                var filename = $('#category_image').val().replace(/C:\\fakepath\\/i, '')
                var timestamp = Number(new Date());
                var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;
                var uploadTask = storageRef.child(filename).put(theFile);
                uploadTask.on('state_changed', function (snapshot) {
                    var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                }, function (error) {
                }, function () {
                    uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {
                        jQuery("#uploding_image").text("Upload is completed");
                        photo = downloadURL;
                        $(".cat_image").empty();
                        $(".cat_image").append('<img class="rounded" style="width:50px" src="' + photo + '" alt="image">');

                    });
                });

            };
        })(f);
        reader.readAsDataURL(f);
    }

</script>
@endsection
