@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">

            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.section_plural')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('section') !!}">{{trans('lang.section_plural')}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{trans('lang.section_edit')}}</li>
                </ol>
            </div>
        </div>


        <div class="card-body">

            <div id="data-table_processing" class="dataTables_processing panel panel-default"
                 style="display: none;">{{trans('lang.processing')}}</div>
            <div class="error_top" style="display:none"></div>
            <div class="row vendor_payout_create">

                <div class="vendor_payout_create-inner">
                    <fieldset>
                        <legend>{{trans('lang.section_edit')}}</legend>
                        <div class="form-group row width-100">
                            <label class="col-3 control-label">{{trans('lang.section_name')}}</label>
                            <div class="col-7">
                                <input type="text" class="form-control cat-name">
                                <div class="form-text text-muted">{{ trans("lang.section_name_help") }} </div>
                            </div>
                        </div>

                        <div class="form-group row width-100">
                            <label class="col-3 control-label ">{{trans('lang.section_color')}}</label>
                            <div class="col-7">
                                <input type="color" id="colorpicker" value="#0000ff">
                                <div class="form-text text-muted">{{ trans("lang.section_color_help") }}</div>
                            </div>
                        </div>

                        <div class="form-group row width-100">
                            <label class="col-3 control-label">{{trans('lang.section_image')}}</label>
                            <div class="col-7">
                                <input type="file" id="sectionImage" onChange="handleFileSelect(event)">
                                <div class="placeholder_img_thumb cat_image"></div>
                                <div id="uploding_image"></div>
                                <div class="form-text text-muted w-50">{{ trans("lang.section_image_help") }}</div>
                            </div>
                        </div>

                        <div class="form-group row width-100">

                            <div class="form-check">
                                <input type="checkbox" class="section_active" id="section_active">
                                <label class="col-3 control-label" for="section_active">{{trans('lang.active')}}</label>
                            </div>
                        </div>

                    </fieldset>

                    <fieldset>
                        <legend>{{trans('lang.tax_section')}}</legend>

                        <div class="form-group row width-100">
                            <label class="col-3 control-label">{{trans('lang.tax_lable')}}</label>
                            <div class="col-7">
                                <input type="text" name="tax_lable" class="form-control" id="tax_lable">
                                <div class="form-text text-muted">{{ trans("lang.tax_lable_help") }} </div>
                            </div>
                        </div>

                        <div class="form-group row width-100">
                            <label class="col-3 control-label">{{trans('lang.tax_amount')}}</label>
                            <div class="col-7">
                                <input type="text" name="tax_amount" class="form-control" id="tax_amount">
                                <div class="form-text text-muted">{{ trans("lang.tax_amount_help") }} </div>
                            </div>
                        </div>


                        <div class="form-group row width-50">
                            <label class="col-3 control-label ">{{trans('lang.tax_type')}}</label>
                            <div class="col-7">
                                <select name="tax_type" id="tax_type" class="form-control">
                                    <option value="">{{trans('lang.select')}}</option>
                                    <option value="fix">Fix</option>
                                    <option value="percent">Percent</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row width-50">
                            <label class="col-3 control-label ">{{trans('lang.service_type')}}</label>
                            <div class="col-12">
                                <select name="service_type" id="service_type" class="form-control service_type">
                                    <option value="">{{trans('lang.select')}} {{trans('lang.service_type')}}</option>
                                    <!-- <option value="multivendor" flag="delivery-service">{{trans('lang.multivendor_delivery')}}</option>
                                    <option value="cabservice" flag="cab-service">{{trans('lang.taxi_booking_service')}}</option> -->
                                </select>
                            </div>
                        </div>

                        <div class="form-group row width-100">
                            <div class="form-check">
                                <input type="checkbox" class="section_tax_active" id="section_tax_active">
                                <label class="col-3 control-label"
                                       for="section_tax_active">{{trans('lang.active')}}</label>
                            </div>
                        </div>

                    </fieldset>
                    <fieldset id="" class="diliverychargeDiv" style="display: none">
                        <legend>{{trans('lang.deliveryCharge')}}</legend>
                        <div class="form-group row width-50"  >
                            <label class="col-4 control-label">{{ trans('lang.deliveryCharge')}}</label>
                            <div class="col-7">
                                <input type="number" id="deliveryCharge" class="form-control ">
                            </div>
                        </div>
                    </fieldset>

{{--                    <fieldset>--}}
{{--                        <legend>{{trans('lang.deliveryCharge')}}</legend>--}}

{{--                        <div class="form-check width-100">--}}
{{--                            <input type="checkbox" class="form-check-inline" id="vendor_can_modify">--}}
{{--                            <label class="col-5 control-label"--}}
{{--                                   for="vendor_can_modify">{{ trans('lang.vendor_can_modify')}}</label>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row width-100">--}}
{{--                            <label class="col-4 control-label">{{ trans('lang.delivery_charges_per_km')}}</label>--}}
{{--                            <div class="col-7">--}}
{{--                                <input type="number" class="form-control" id="delivery_charges_per_km">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row width-100">--}}
{{--                            <label class="col-4 control-label">{{ trans('lang.minimum_delivery_charges')}}</label>--}}
{{--                            <div class="col-7">--}}
{{--                                <input type="number" class="form-control" id="minimum_delivery_charges">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row width-100">--}}
{{--                            <label class="col-4 control-label">{{ trans('lang.minimum_delivery_charges_within_km')}}</label>--}}
{{--                            <div class="col-7">--}}
{{--                                <input type="number" class="form-control" id="minimum_delivery_charges_within_km">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </fieldset>--}}

                   <fieldset>
                        <legend>{{trans('lang.food_delivery_feature')}}</legend>

                        <div class="form-group row width-100">
                            <div class="form-check">
                                <input type="checkbox" class="section_dine_in_active" id="section_dine_in_active">
                                <label class="col-3 control-label"
                                       for="section_dine_in_active">{{trans('lang.active')}}</label>
                                       <span style="font-size: 15px;">{{trans('lang.food_delivery_feature_note')}}</span>
                            </div>
                        </div>

                    </fieldset>

                    <fieldset class="adminCommisitionDiv" style="display:none">
                    <legend>{{trans('lang.admin_commission')}}</legend>
                    <div class="form-check width-100">
                    <label style="font-size: 15px;">{{trans('lang.admin_commision_note_section')}}</label>
                    </div>
                    <div class="form-check width-100">
                      <input type="checkbox" class="form-check-inline" onclick="ShowHideDiv()" id="enable_commission">
                        <label class="col-5 control-label" for="enable_commission">{{ trans('lang.enable_adminCommission')}}</label>
                    </div>

                    <div class="form-group row width-50 how_much_div" id="how_much_div" style="display:none">
                        <label class="col-4 control-label">{{ trans('lang.commission_type')}}</label>
                        <div class="col-7">
                          <select class="form-control commission_type">
                            <option value="Percent">{{trans('lang.coupon_percent')}}</option>
                            <option value="Fixed">{{trans('lang.coupon_fixed')}}</option>
                          </select>
                        </div>
                    </div>

                    <div class="form-group row width-50 how_much_div" id="how_much_div" style="display:none">
                      <label class="col-4 control-label">{{ trans('lang.admin_commission')}}</label>
                      <div class="col-7">
                        <input type="number" class="form-control commission_fix">
                      </div>
                    </div>

                    <!-- <div class="form-group row width-100">
                        <label class="col-4 control-label">{{ trans('lang.deliveryCharge')}}</label>
                        <div class="col-7">
                          <input type="number" class="form-control deliveryCharge">
                        </div>
                    </div> -->

              </fieldset>
              <fieldset class="htmlTemplateDiv" style="display:none">
                    <legend>{{trans('lang.html_template')}}</legend>
                      <div class="form-group width-100">
                        <textarea class="form-control col-7" name="html_template" id="html_template"></textarea>
                        </div>
              </fieldset>
                </div>

            </div>

        </div>
        <div class="form-group col-12 text-center btm-btn">
            <button type="button" class="btn btn-primary save_section_btn"><i
                        class="fa fa-save"></i> {{trans('lang.save')}}</button>
            <a href="{!! route('section') !!}" class="btn btn-default"><i
                        class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
        </div>

    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
    <script>
        var id = "<?php echo $id;?>";
        var database = firebase.firestore();
        var ref_sections = database.collection('sections');
        var ref = database.collection('sections').where("id", "==", id);
        var services = database.collection('services');
        var htmlTemplate = ""
        var sectionImage = "";
        var placeholderImage = '';
        var placeholder = database.collection('settings').doc('placeHolderImage');

        placeholder.get().then(async function (snapshotsimage) {
            var placeholderImageData = snapshotsimage.data();
            placeholderImage = placeholderImageData.image;
        })
        $('#html_template').summernote({
        height: 400,
        width: 1000,
        toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['forecolor', ['forecolor']],
    ['backcolor', ['backcolor']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']],
    ['view', ['fullscreen', 'codeview', 'help']],
  ]
    });

        $(document).ready(function () {
            jQuery("#data-table_processing").show();
            services.get().then( async function(snapshots){
	            snapshots.docs.forEach((listval) => {
                var data = listval.data();

                $('.service_type').append($("<option></option>")
                    .attr("value", data.name).attr("flag",data.flag)
                    .text(data.name));
            })
        })

            ref.get().then(async function (snapshots) {
                if (snapshots.docs) {
                    var section = snapshots.docs[0].data();
                    $(".cat-name").val(section.name);
                    $(".section_description").val(section.description);
                    $("#colorpicker").val(section.color);
                    if (section.isActive) {
                        $(".section_active").prop('checked', true);
                    }

                    if (section.dine_in_active) {
                        $("#section_dine_in_active").prop('checked', true);
                    }
                    if (section.tax_active) {
                        $("#section_tax_active").prop('checked', true);
                    }

                    if(section.serviceType){
                        $('.service_type').val(section.serviceType).trigger('change');

                        if(section.serviceType == "Cab Service"){
                            $('.adminCommisitionDiv').show();
                            $('.diliverychargeDiv').hide();

                            if(section.hasOwnProperty('isEnableCommission')){

                                if(section.isEnableCommission == true){
                                $("#enable_commission").prop('checked',true);
                                $(".how_much_div").show();
                                }

                                if(section.commissionType != ""){
                                    $(".commission_type").val(section.commissionType);

                                }
                                $(".commission_fix").val(section.commissionAmount);

                            }
                            if(section.hasOwnProperty('cab_service_template')){
                                $('#html_template').summernote("code", section.cab_service_template);

                            }

                        }
                        if(section.serviceType == "Parcel Delivery Service"){
                            $('.adminCommisitionDiv').show();

                            if(section.hasOwnProperty('isEnableCommission')){

                                if(section.isEnableCommission == true){
                                $("#enable_commission").prop('checked',true);
                                $(".how_much_div").show();
                                }

                                if(section.commissionType != ""){
                                    $(".commission_type").val(section.commissionType);

                                }
                                $(".commission_fix").val(section.commissionAmount);

                            }
                        }
                        if(section.serviceType == "Rental Service"){
                            $('.adminCommisitionDiv').show();

                            if(section.hasOwnProperty('isEnableCommission')){

                                if(section.isEnableCommission == true){
                                $("#enable_commission").prop('checked',true);
                                $(".how_much_div").show();
                                }

                                if(section.commissionType != ""){
                                    $(".commission_type").val(section.commissionType);

                                }
                                $(".commission_fix").val(section.commissionAmount);

                            }
                        }
                        if (section.serviceType =="Ecommerce Service"){
                            $('.adminCommisitionDiv').hide();
                            $('.diliverychargeDiv').show();
                            if (section.delivery_charge!=''){
                                $('#deliveryCharge').val(section.delivery_charge);
                            }
                        }
                    }

                    $("#tax_type").val(section.tax_type);
                    $("#tax_amount").val(section.tax_amount);
                    $("#tax_lable").val(section.tax_lable);

                    sectionImage = section.sectionImage;

                    if (sectionImage != '' && sectionImage != null) {

                        $(".cat_image").append('<img class="rounded" style="width:50px" src="' + sectionImage + '" alt="image">');
                    } else {

                        $(".cat_image").append('<img class="rounded" style="width:50px" src="' + placeholderImage + '" alt="image">');
                    }


                }
            })
            jQuery("#data-table_processing").hide();

            $(".save_section_btn").click(function () {

                var name = $(".cat-name").val();
                var color = $("#colorpicker").val();
                var active = $(".section_active").is(":checked");

                var section_dine_in_active = $("#section_dine_in_active").is(":checked");
                var section_tax_active = $("#section_tax_active").is(":checked");
                var tax_type = $("#tax_type").val();
                var tax_amount = $("#tax_amount").val();
                var tax_lable = $("#tax_lable").val();
                var service_type = $('.service_type').val();
                var service_type_flag = $('.service_type option:selected').attr('flag');
                var enable_commission = $("#enable_commission").is(":checked");
                var commission_type = $(".commission_type").val();
                var commission_fix = parseInt($(".commission_fix").val());
                if (service_type=="Ecommerce Service"){
                    var delivery_charge=$('#deliveryCharge').val();
                }else{
                    var delivery_charge='';
                }

                if (service_type=="Cab Service"){
                    var htmlTemplate =  $('#html_template').summernote('code');

                }else{
                    var htmlTemplate='';
                }

                if (name == '') {

                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.enter_cat_name_error')}}</p>");
                    window.scrollTo(0, 0);
                }else if(service_type == ""){
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.service_type_error')}}</p>");
                    window.scrollTo(0, 0);

                }else {

                    if (section_tax_active == true) {
                        if (tax_lable == '') {
                            $(".error_top").show();
                            $(".error_top").html("");
                            $(".error_top").append("<p>{{trans('lang.enter_tax_lable')}}</p>");
                            window.scrollTo(0, 0);
                            return false;
                        } else if (tax_amount == '') {
                            $(".error_top").show();
                            $(".error_top").html("");
                            $(".error_top").append("<p>{{trans('lang.enter_tax_amount')}}</p>");
                            window.scrollTo(0, 0);
                            return false;
                        } else if (tax_type == '') {
                            $(".error_top").show();
                            $(".error_top").html("");
                            $(".error_top").append("<p>{{trans('lang.enter_tax_type')}}</p>");
                            window.scrollTo(0, 0);
                            return false;
                        }



                    }

                    if(enable_commission == true){
                        if(commission_fix == "" || commission_fix == "0"){
                            $(".error_top").show();
                            $(".error_top").html("");
                            $(".error_top").append("<p>{{trans('lang.commission_fix_error')}}</p>");
                            window.scrollTo(0, 0);
                            return false;
                        }
                    }else{
                        commission_type = "";
                        commission_fix = "";
                    }

                    if(service_type != "Cab Service" && service_type != "Parcel Delivery Service" && service_type != "Rental Service"){
                        enable_commission = false;
                        commission_type = "";
                        commission_fix = "";
                    }

                    database.collection('sections').doc(id).update({
                        'name': name,
                        'color': color,
                        'sectionImage': sectionImage,
                        'isActive': active,
                        'dine_in_active': section_dine_in_active,
                        'tax_active': section_tax_active,
                        'tax_lable': tax_lable,
                        'tax_amount': tax_amount?tax_amount:'0',
                        'tax_type': tax_type,
                        'serviceType' :service_type,
                        'serviceTypeFlag' : service_type_flag,
                        'isEnableCommission' : enable_commission,
                        'commissionType' : commission_type,
                        'commissionAmount' :commission_fix,
                        'delivery_charge':delivery_charge,
                        'cab_service_template':htmlTemplate

                    }).then(function (result) {
                        window.location.href = '{{ route("section")}}';
                    });


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
                    var val = $('#sectionImage').val().toLowerCase();
                    var ext = val.split('.')[1];
                    var docName = val.split('fakepath')[1];
                    var filename = $('#sectionImage').val().replace(/C:\\fakepath\\/i, '')
                    var timestamp = Number(new Date());
                     var filename = filename.split('.')[0]+"_"+timestamp+'.'+ext;
                    var uploadTask = storageRef.child(filename).put(theFile);
                    uploadTask.on('state_changed', function (snapshot) {
                        var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                    }, function (error) {
                    }, function () {
                        uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {
                            jQuery("#uploding_image").text("Upload is completed");
                            sectionImage = downloadURL;
                            $(".cat_image").empty();
                            $(".cat_image").append('<img class="rounded" style="width:50px" src="' + sectionImage + '" alt="image">');

                        });
                    });

                };
            })(f);
            reader.readAsDataURL(f);
        }

        function ShowHideDiv(){
            var checkboxValue = $("#enable_commission").is(":checked");
            if(checkboxValue){
            $(".how_much_div").show();
            }else{
            $(".how_much_div").hide();

            }

        }

        $('.service_type').change(function(){
            var serviceType = $(this).val();

            if(serviceType == "Cab Service"){
                $('.adminCommisitionDiv').show();
                $('.diliverychargeDiv').hide();
                $('.htmlTemplateDiv').show();

            }else if(serviceType == "Parcel Delivery Service"){
                $('.adminCommisitionDiv').show();
               // $('.diliverychargeDiv').show();
               $('.htmlTemplateDiv').hide();
            }
            else if(serviceType=="Ecommerce Service"){
                $('.adminCommisitionDiv').hide();
                $('.diliverychargeDiv').show();
                $('.htmlTemplateDiv').hide();
            }else if(serviceType=="Rental Service"){
                $('.adminCommisitionDiv').show();
                $('.diliverychargeDiv').hide();
                $('.htmlTemplateDiv').hide();
            }
            else{
                $('.adminCommisitionDiv').hide();
                $('.diliverychargeDiv').hide();
                $('.htmlTemplateDiv').hide();

            }
        })

    </script>
@endsection
