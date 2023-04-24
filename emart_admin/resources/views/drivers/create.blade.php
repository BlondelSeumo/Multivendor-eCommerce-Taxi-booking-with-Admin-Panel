@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.driver_plural')}}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('drivers') !!}">{{trans('lang.driver_plural')}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{trans('lang.driver_edit')}}</li>
                </ol>
            </div>
            <div>

                <div class="card-body">

                    <div id="data-table_processing" class="dataTables_processing panel panel-default"
                         style="display: none;">{{trans('lang.processing')}}</div>
                    <div class="error_top"></div>

                    <div class="row vendor_payout_create">
                        <div class="vendor_payout_create-inner">
                            <fieldset>
                                <legend>{{trans('lang.driver_details')}}</legend>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.first_name')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control user_first_name">
                                        <div class="form-text text-muted">{{trans('lang.first_name_help')}}</div>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.last_name')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control user_last_name">
                                        <div class="form-text text-muted">{{trans('lang.last_name_help')}}</div>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.email')}}</label>
                                    <div class="col-7">
                                        <input type="email" class="form-control user_email">
                                        <div class="form-text text-muted">{{trans('lang.user_email_help')}}</div>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.password')}}</label>
                                    <div class="col-7">
                                        <input type="password" class="form-control user_password">
                                        <div class="form-text text-muted">{{trans('lang.user_password_help')}}</div>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.user_phone')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control user_phone">
                                        <div class="form-text text-muted">
                                            {{trans('lang.user_phone_help')}}</div>
                                    </div>
                                </div>


                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.user_latitude')}}</label>
                                    <div class="col-7">
                                        <input type="number" class="form-control user_latitude">
                                        <div class="form-text text-muted">{{trans('lang.user_latitude_help')}}</div>
                                    </div>
                                </div>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.user_longitude')}}</label>
                                    <div class="col-7">
                                        <input type="number" class="form-control user_longitude">
                                        <div class="form-text text-muted">{{trans('lang.user_longitude_help')}}</div>
                                    </div>
                                </div>

                                <div class="form-group row width-100">
                                    <label class="col-3 control-label">{{trans('lang.profile_image')}}</label>
                                    <div class="col-7">
                                        <input type="file" onChange="handleFileSelect(event)" class="">
                                        <div class="form-text text-muted">{{trans('lang.profile_image_help')}}</div>
                                    </div>
                                    <div class="placeholder_img_thumb user_image"></div>
                                    <div id="uploding_image"></div>
                                </div>


                                <div class="form-check width-100">
                                    <input type="checkbox" class="col-7 form-check-inline user_active" id="user_active">
                                    <label class="col-3 control-label"
                                           for="user_active">{{trans('lang.active')}}</label>
                                </div>
                                <br>
                                <div class="form-group row width-50 individualDiv" style="display: none">
                                    <label class="col-3 control-label">{{trans('lang.driver_rate')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control driver_rate">
                                        <div class="form-text text-muted">{{trans('lang.driver_rate_help')}}</div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>{{trans('lang.car_details')}}</legend>

                                <div class="form-group row width-50">
                                    <label class="col-3 control-label ">{{trans('lang.service_type')}}</label>
                                    <div class="col-12">
                                        <select name="service_type" id="service_type" class="form-control service_type">
                                            <option value="">{{trans('lang.select')}} {{trans('lang.service_type')}}</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row width-50 car_div">
                                    <label class="col-3 control-label">{{trans('lang.car_name')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control car_name">
                                        <div class="form-text text-muted">{{trans('lang.car_name_help')}}</div>
                                    </div>
                                </div>

                                <div class="form-group row width-50 car_div" id="car_model">
                                    <label class="col-3 control-label">{{trans('lang.car_model')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control carmodel">
                                        <div class="form-text text-muted">{{trans('lang.car_model_help')}}</div>
                                    </div>
                                </div>

                                <div class="form-group row width-50 car_div">
                                    <label class="col-3 control-label">{{trans('lang.car_number')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control car_number">
                                        <div class="form-text text-muted">{{trans('lang.car_number_help')}}</div>
                                    </div>
                                </div>


                                <div class="form-group row width-50">
                                    <label class="col-3 control-label">{{trans('lang.car_image')}}</label>
                                    <div class="col-7">
                                        <input type="file" onChange="handleFileSelectcar(event)" class="">
                                        <div class="form-text text-muted">{{trans('lang.car_image_help')}}</div>
                                    </div>
                                    <div class="placeholder_img_thumb car_image">
                                    </div>
                                    <div id="uploding_image_car"></div>
                                </div>


                                <div class="cab_service" style="display: none">
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.car_make')}}</label>
                                        <div class="col-7">
                                            <select name="car_make" class="form-control car_make">
                                                <option value="">{{trans('lang.select')}} {{trans('lang.car_make')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.car_model')}}</label>
                                        <div class="col-7">
                                            <select name="car_model" class="form-control car_model">
                                                <option value="">{{trans('lang.select')}} {{trans('lang.car_model')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.vehicle_type')}}</label>
                                        <div class="col-7">
                                            <select name="vehicle_type" class="form-control vehicle_type">
                                                <option value="">{{trans('lang.select')}} {{trans('lang.vehicle_type')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.car_color')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control car_color">
                                            <div class="form-text text-muted">{{trans('lang.car_color_help')}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.car_proof')}}</label>
                                        <div class="col-7">
                                            <input type="file" onChange="handleFileSelectCarProof(event)" class="">
                                            <div class="form-text text-muted">{{trans('lang.car_proof_help')}}</div>
                                        </div>
                                        <div class="placeholder_img_thumb car_proof">
                                        </div>
                                        <div id="uploding_car_proof"></div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.driver_proof')}}</label>
                                        <div class="col-7">
                                            <input type="file" onChange="handleFileSelectDriverProof(event)" class="">
                                            <div class="form-text text-muted">{{trans('lang.driver_proof_help')}}</div>
                                        </div>
                                        <div class="placeholder_img_thumb driver_proof">
                                        </div>
                                        <div id="uploding_driver_proof"></div>
                                    </div>

                                </div>

                                <div class="rental_service" style="display: none">

                                    <div class="form-group row width-100 radio-form-row d-flex">
                                        <div class="radio-form col-md-4">
                                            <input type="radio"
                                                   class="isCompany" checked
                                                   value="false" name="isCompany" id="individual">
                                            <label class="custom-control-label">{{trans('lang.individual')}}</label>
                                        </div>

                                        <div class="radio-form col-md-4">
                                            <input type="radio"
                                                   class="isCompany"
                                                   value="true" name="isCompany" id="company">

                                            <label class="custom-control-label">{{trans('lang.company')}}</label>
                                        </div>
                                    </div>

                                    <div class="form-group row width-50 individualDiv" style="display: none">
                                        <label class="col-3 control-label">{{trans('lang.vehicle_type')}}</label>
                                        <div class="col-7">
                                            <select name="rental_vehicle_type" class="form-control rental_vehicle_type">
                                                <option value="">{{trans('lang.select')}} {{trans('lang.vehicle_type')}}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row width-50 individualDiv" style="display: none">
                                        <label class="col-3 control-label">{{trans('lang.car_rate')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control car_rate">
                                            <div class="form-text text-muted">{{trans('lang.car_rate_help')}}</div>
                                        </div>
                                    </div>


                                    <div class="form-group row width-50 individualDiv" style="display: none">
                                        <label class="col-3 control-label">{{trans('lang.passengers')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control passenger">
                                            <div class="form-text text-muted">{{trans('lang.passengers_help')}}</div>
                                        </div>
                                    </div>

                                    <div class="form-group row width-50 individualDiv" style="display: none">
                                        <label class="col-3 control-label">{{trans('lang.doors')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control doors">
                                            <div class="form-text text-muted">{{trans('lang.doors_help')}}</div>
                                        </div>
                                    </div>

                                    <div class="form-group row width-50 individualDiv" style="display: none">
                                        <label class="col-3 control-label">{{trans('lang.air_conditioning')}}</label>
                                        <div class="col-7">
                                            <select name="rental_vehicle_type" class="form-control air_conditioning">
                                                <option value="Yes">{{trans('lang.yes')}}</option>
                                                <option value="No">{{trans('lang.no')}}</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group row width-50 individualDiv" style="display: none">
                                        <label class="col-3 control-label">{{trans('lang.gear')}}</label>
                                        <div class="col-7">
                                            <select name="rental_vehicle_type" class="form-control gear">
                                                <option value="Manual">{{trans('lang.manual')}}</option>
                                                <option value="Auto">{{trans('lang.auto')}}</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group row width-50 individualDiv" style="display: none">
                                        <label class="col-3 control-label">{{trans('lang.mileage')}}</label>
                                        <div class="col-7">
                                            <select name="rental_vehicle_type" class="form-control mileage">
                                                <option value="Average">{{trans('lang.average')}}</option>
                                                <option value="Ultimated">{{trans('lang.ultimated')}}</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group row width-50 individualDiv" style="display: none">
                                        <label class="col-3 control-label">{{trans('lang.fuel_filling')}}</label>
                                        <div class="col-7">
                                            <select name="rental_vehicle_type" class="form-control fuel_filling">
                                                <option value="Full to Full">{{trans('lang.full_to_full')}}</option>
                                                <option value="Half">{{trans('lang.half')}}</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group row width-50 individualDiv" style="display: none">
                                        <label class="col-3 control-label">{{trans('lang.fuel_type')}}</label>
                                        <div class="col-7">
                                            <select name="rental_vehicle_type" class="form-control fuel_type">
                                                <option value="Petrol">{{trans('lang.petrol')}}</option>
                                                <option value="Diesel">{{trans('lang.diesel')}}</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group row width-50 individualDiv" style="display: none">
                                        <label class="col-3 control-label">{{trans('lang.max_power')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control max_power">
                                            <div class="form-text text-muted">{{trans('lang.max_power_help')}}</div>
                                        </div>
                                    </div>

                                    <div class="form-group row width-50 individualDiv" style="display: none">
                                        <label class="col-3 control-label">{{trans('lang.mph')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control mph">
                                            <div class="form-text text-muted">{{trans('lang.mph_help')}}</div>
                                        </div>
                                    </div>
                                    <div class="form-group row width-50 individualDiv" style="display: none">
                                        <label class="col-3 control-label">{{trans('lang.top_speed')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control top_speed">
                                            <div class="form-text text-muted">{{trans('lang.top_speed_help')}}</div>
                                        </div>
                                    </div>


                                    <div class="form-group row width-100 individualDiv" style="display: none">
                                        <label class="col-3 control-label">{{trans('lang.vehicle_images')}}</label>
                                        <div class="col-7">
                                            <input type="file" onChange="handleFileSelectVehicleImages(event)" class="">
                                            <div class="form-text text-muted">{{trans('lang.vehicle_images_help')}}</div>
                                        </div>

                                        <div class="uploding_vehicle_images"></div>

                                        <div class="placeholder_img_thumb vendor_image">

                                            <div id="photos"></div>
                                        </div>
                                    </div>


                                    <div class="companyDiv" style="display: none">
                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">{{trans('lang.company_name')}}</label>
                                            <div class="col-7">
                                                <input type="text" class="form-control company_name">
                                                <div class="form-text text-muted">{{trans('lang.company_name_help')}}</div>
                                            </div>
                                        </div>

                                        <div class="form-group row width-50">
                                            <label class="col-3 control-label">{{trans('lang.company_address')}}</label>
                                            <div class="col-7">
                                                <input type="text" class="form-control company_address">
                                                <div class="form-text text-muted">{{trans('lang.company_address_help')}}</div>
                                            </div>
                                        </div>

                                    </div>

                                </div>


                            </fieldset>
                            <fieldset>
                                <legend>{{trans('lang.bankdetails')}}</legend>
                                <div class="form-group row width-100" style="display: none;" id="companyDriverShowDiv">
                                    <div class="col-12">
                                        <h6><a href="#">{{ trans("lang.driver_add_by_company_info") }}</a>
                                        </h6>
                                    </div>
                                </div>
                                <div class="form-group row" id="companyDriverHideDiv">

                                    <div class="form-group row width-100">
                                        <label class="col-4 control-label">{{trans('lang.bank_name')}}</label>
                                        <div class="col-7">
                                            <input type="text" name="bank_name" class="form-control" id="bankName">
                                        </div>
                                    </div>

                                    <div class="form-group row width-100">
                                        <label class="col-4 control-label">{{trans('lang.branch_name')}}</label>
                                        <div class="col-7">
                                            <input type="text" name="branch_name" class="form-control" id="branchName">
                                        </div>
                                    </div>


                                    <div class="form-group row width-100">
                                        <label class="col-4 control-label">{{trans('lang.holer_name')}}</label>
                                        <div class="col-7">
                                            <input type="text" name="holer_name" class="form-control" id="holderName">
                                        </div>
                                    </div>

                                    <div class="form-group row width-100">
                                        <label class="col-4 control-label">{{trans('lang.account_number')}}</label>
                                        <div class="col-7">
                                            <input type="text" name="account_number" class="form-control"
                                                   id="accountNumber">
                                        </div>
                                    </div>

                                    <div class="form-group row width-100">
                                        <label class="col-4 control-label">{{trans('lang.other_information')}}</label>
                                        <div class="col-7">
                                            <input type="text" name="other_information" class="form-control"
                                                   id="otherDetails">
                                        </div>
                                    </div>

                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>

                <div class="form-group col-12 text-center btm-btn">
                    <button type="button" class="btn btn-primary save_driver_btn"><i
                                class="fa fa-save"></i> {{ trans('lang.save')}}</button>
                    <a href="{!! route('drivers') !!}" class="btn btn-default"><i
                                class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
                </div>

            </div>

        </div>


        @endsection

        @section('scripts')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>

            <script>


                var database = firebase.firestore();

                var photo = "";
                var carPictureURL = "";
                var carProofPictureURL = '';
                var driverProofPictureURL = '';
                var refCarMake = database.collection('car_make');
                var refCarModel = database.collection('car_model');
                var refVehicleType = database.collection('vehicle_type');
                var refRentalVehicleType = database.collection('rental_vehicle_type');
                var services = database.collection('services');
                var rentalImagesCount = 0;
                var rentalImages = [];

                var getCompanyId = '<?php echo @$_GET['companyId'] ?>';

                $(document).ready(function () {


                    jQuery("#data-table_processing").show();

                    refCarMake.get().then(async function (snapshots) {
                        snapshots.docs.forEach((listval) => {
                            var data = listval.data();

                            $('.car_make').append($("<option></option>")
                                .attr("value", data.name)
                                .text(data.name));
                        })

                    });

                    refCarModel.get().then(async function (snapshots) {
                        snapshots.docs.forEach((listval) => {
                            var data = listval.data();

                            $('.car_model').append($("<option></option>")
                                .attr("value", data.name)
                                .text(data.name));
                        })

                    });

                    refVehicleType.get().then(async function (snapshots) {
                        snapshots.docs.forEach((listval) => {
                            var data = listval.data();

                            $('.vehicle_type').append($("<option></option>")
                                .attr("value", data.name)
                                .text(data.name));
                        })

                    });

                    refRentalVehicleType.get().then(async function (snapshots) {
                        snapshots.docs.forEach((listval) => {
                            var data = listval.data();

                            $('.rental_vehicle_type').append($("<option></option>")
                                .attr("value", data.name)
                                .text(data.name));
                        })

                    });

                    services.get().then(async function (snapshots) {
                        snapshots.docs.forEach((listval) => {
                            var data = listval.data();

                            $('.service_type').append($("<option></option>")
                                .attr("value", data.flag)
                                .text(data.name));

                            getComapnyDetails();
                        });
                    });


                    jQuery("#data-table_processing").hide();

                    $("input[name='isCompany']:radio").change(function () {

                        var isCompany = $(this).val();

                        if (isCompany == "false") {
                            $('.companyDiv').hide();
                            $('.individualDiv').show();
                            $('.car_div').show();
                        } else {
                            $('.companyDiv').show();
                            $('.individualDiv').hide();
                            $('.car_div').hide();
                        }
                    });


                });

                function getComapnyDetails() {

                    if (getCompanyId) {

                        $('.service_type').val('rental-service').trigger('change');
                        $('.service_type').attr('disabled', true);
                        $("input[name=isCompany]").attr('disabled', true);

                    }
                }

                $(".save_driver_btn").click(function () {

                    var userFirstName = $(".user_first_name").val();
                    var userLastName = $(".user_last_name").val();
                    var email = $(".user_email").val();
                    var password = $(".user_password").val();
                    var userPhone = $(".user_phone").val();
                    var active = $(".user_active").is(":checked");
                    var carName = $(".car_name").val();
                    var car_model = $(".carmodel").val();
                    var carNumber = $(".car_number").val();
                    var latitude = parseFloat($(".user_latitude").val());
                    var longitude = parseFloat($(".user_longitude").val());
                    var location = {'latitude': latitude, 'longitude': longitude};
                    var id = "<?php echo uniqid(); ?>";
                    var carMakeId = $('.car_make').val();
                    var carMakeName = $('.car_make option:selected').text();
                    var carModelId = $('.car_model').val();
                    var carModelName = $('.car_model option:selected').text();
                    var vehicleTypeId = $('.vehicle_type').val();
                    var vehicleTypeName = $('.vehicle_type option:selected').text();
                    var carColor = $('.car_color').val();

                    var isCompany = false;
                    var driverRate = "";
                    var carRate = "";
                    var vehicleType = "";
                    var service_type = $('.service_type').val();
                    
                    var carInfo = {};
                    var air_conditioning = "";
                    var doors = "";
                    var fuel_filling = "";
                    var fuel_type = "";
                    var gear = "";
                    var maxPower = "";
                    var mileage = "";
                    var mph = "";
                    var passenger = "";
                    var topSpeed = "";
                    var companyId = "";
                    var companyName = "";
                    var companyAddress = "";

                    var isComapnyCheck = $(".isCompany:checked").val();

                    if (getCompanyId) {

                        service_type = "rental-service";
                        isComapnyCheck = "false";
                    }

                    if (service_type == "rental-service") {

                        if (isComapnyCheck == "true") {

                            isCompany = true;
                            companyName = $('.company_name').val();
                            companyAddress = $('.company_address').val();
                            car_model = carName = carNumber = "";
                        } else {

                            vehicleType = $('.rental_vehicle_type').val();
                            air_conditioning = $('.air_conditioning').val();
                            doors = $('.doors').val();
                            fuel_filling = $('.fuel_filling').val();
                            fuel_type = $('.fuel_type').val();
                            gear = $('.gear').val();
                            maxPower = $('.max_power').val();
                            mileage = $('.mileage').val();
                            mph = $('.mph').val();
                            passenger = $('.passenger').val();
                            topSpeed = $('.top_speed').val();
                            driverRate = $('.driver_rate').val();
                            carRate = $('.car_rate').val();
                        }
                    } else if (service_type == "cab-service") {
                        vehicleType = $('.vehicle_type').val();
                    } else {

                    }


                    carInfo = {
                        "air_conditioning": air_conditioning,
                        "car_image": rentalImages,
                        "doors": doors,
                        "fuel_filling": fuel_filling,
                        "fuel_type": fuel_type,
                        "gear": gear,
                        "maxPower": maxPower,
                        "mileage": mileage,
                        "mph": mph,
                        "passenger": passenger,
                        "topSpeed": topSpeed,
                    };

                    if (userFirstName == '') {
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>{{trans('lang.enter_owners_name_error')}}</p>");
                        window.scrollTo(0, 0);

                    } else if (email == '') {
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>{{trans('lang.enter_owners_email')}}</p>");
                        window.scrollTo(0, 0);
                    } else if (userPhone == '') {
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>{{trans('lang.enter_owners_phone')}}</p>");
                        window.scrollTo(0, 0);
                    } else if (service_type == "") {
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>{{trans('lang.service_type_error')}}</p>");
                        window.scrollTo(0, 0);
                    } else if (carName == '' && service_type != "cab-service") {
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>{{trans('lang.car_name_error')}}</p>");
                        window.scrollTo(0, 0);
                    } else if (carNumber == '') {
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>{{trans('lang.car_number_error')}}</p>");
                        window.scrollTo(0, 0);
                    } else if (carMakeId == '' && service_type == "cab-service") {
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>{{trans('lang.car_make_error')}}</p>");
                        window.scrollTo(0, 0);
                    } else if (carModelId == '' && service_type == "cab-service") {
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>{{trans('lang.car_model_error')}}</p>");
                        window.scrollTo(0, 0);
                    } else if (vehicleTypeId == '' && service_type == "cab-service") {
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>{{trans('lang.vehicle_type_error')}}</p>");
                        window.scrollTo(0, 0);
                    } else if (carColor == '' && service_type == "cab-service") {
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>{{trans('lang.car_color_error')}}</p>");
                        window.scrollTo(0, 0);


                    } else {
                        var bankName = $("#bankName").val();
                        var branchName = $("#branchName").val();
                        var holderName = $("#holderName").val();
                        var accountNumber = $("#accountNumber").val();
                        var otherDetails = $("#otherDetails").val();
                        var userBankDetails = {
                            'bankName': bankName,
                            'branchName': branchName,
                            'holderName': holderName,
                            'accountNumber': accountNumber,
                            'accountNumber': accountNumber,
                            'otherDetails': otherDetails,
                        };

                        if (service_type != "cab-service") {
                            carMakeId = car_model;
                            carColor = carProofPictureURL = driverProofPictureURL = "";
                        }


                        firebase.auth().createUserWithEmailAndPassword(email, password)
                            .then(function (firebaseUser) {
                                id = firebaseUser.user.uid;
                                database.collection('users').doc(id).set({
                                    'id': id,
                                    'firstName': userFirstName,
                                    'lastName': userLastName,
                                    'email': email,
                                    'phoneNumber': userPhone,
                                    'active': active,
                                    'profilePictureURL': photo,
                                    'carName': carName,
                                    'carNumber': carNumber,
                                    'carMakes': carMakeId,
                                    // 'carMakeName': carMakeName,
                                    // 'carModelId': carModelId,
                                    // 'carModelName': carModelName,
                                    // 'vehicleTypeId': vehicleTypeId,
                                    // 'vehicleTypeName': vehicleTypeName,
                                    'carColor': carColor,
                                    'carProofPictureURL': carProofPictureURL,
                                    'driverProofPictureURL': driverProofPictureURL,
                                    'location': location,
                                    'carPictureURL': carPictureURL,
                                    'role': 'driver',
                                    'serviceType': service_type,
                                    'driverRate': driverRate,
                                    'isCompany': isCompany,
                                    'vehicleType': vehicleType,
                                    'carRate': carRate,
                                    'carInfo': carInfo,
                                    'companyId': getCompanyId,
                                    'companyName': companyName,
                                    'companyAddress': companyAddress,
                                    'userBankDetails': userBankDetails,
                                }).then(function (result) {

                                    window.location.href = '{{ route("drivers")}}';

                                });

                            }).catch(function (error) {

                            $(".error_top").show();
                            $(".error_top").html("");
                            $(".error_top").append("<p>" + error + "</p>");
                            window.scrollTo(0, 0);
                        });

                    }

                });

                $('.service_type').on('change', function () {

                    var service_type = $(this).val();
                    
                    if (service_type == "rental-service") {
                        $('.rental_service').show();
                        $('.individualDiv').show();
                        $('.cab_service').hide();


                    } 
                    else if (service_type == "parcel_delivery") {
                        $('#car_model').hide();
                    }
                    else if (service_type == "cab-service") {
                        $('.cab_service').show();
                        $('.car_div').hide();
                        $('.rental_service').hide();

                    } else {
                        $('.cab_service').hide();
                        $('.rental_service').hide();

                    }
                });

                var storageRef = firebase.storage().ref('images');

                function handleFileSelect(evt) {
                    var f = evt.target.files[0];
                    var reader = new FileReader();

                    reader.onload = (function (theFile) {
                        return function (e) {

                            var filePayload = e.target.result;
                            // Generate a location that can't be guessed using the file's contents and a random number
                            var hash = CryptoJS.SHA256(Math.random() + CryptoJS.SHA256(filePayload));
                            //var f = new Firebase(firebaseRef + 'pano/' + hash + '/filePayload');
                            //spinner.spin(document.getElementById('spin'));
                            // Set the file payload to Firebase and register an onComplete handler to stop the spinner and show the preview

                            //var val = $('input[type=file]').val().toLowerCase();
                            //var val = "categorytestpng";
                            var val = f.name;
                            var ext = val.split('.')[1];
                            var docName = val.split('fakepath')[1];
                            var filename = (f.name).replace(/C:\\fakepath\\/i, '')

                            var timestamp = Number(new Date());
                            var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;
                            var uploadTask = storageRef.child(filename).put(theFile);
                            console.log(uploadTask);
                            uploadTask.on('state_changed', function (snapshot) {
                                // Observe state change events such as progress, pause, and resume
                                // Get task progress, including the number of bytes uploaded and the total number of bytes to be uploaded
                                var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                                console.log('Upload is ' + progress + '% done');
                                jQuery("#uploding_image").text("Image is uploading...");
                                // switch (snapshot.state) {
                                //   case firebase.storage.TaskState.PAUSED: // or 'paused'
                                //     console.log('Upload is paused');
                                //     break;
                                //   case firebase.storage.TaskState.RUNNING: // or 'running'
                                //     console.log('Upload is running');
                                //     jQuery("#uploding_image").text("Upload is running");
                                //     break;
                                // }
                            }, function (error) {
                                // Handle unsuccessful uploads
                            }, function () {
                                uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {
                                    //spinner.stop();
                                    jQuery("#uploding_image").text("Upload is completed");
                                    //jQuery("#photo").val(downloadURL);
                                    photo = downloadURL;
                                    $(".user_image").empty();
                                    $(".user_image").append('<img class="rounded" style="width:50px" src="' + photo + '" alt="image">');

                                });
                            });

                        };
                    })(f);
                    reader.readAsDataURL(f);
                }

                var storageRefcar = firebase.storage().ref('images');

                function handleFileSelectcar(evt) {
                    var f = evt.target.files[0];
                    var reader = new FileReader();

                    reader.onload = (function (theFile) {
                        return function (e) {

                            var filePayload = e.target.result;
                            // Generate a location that can't be guessed using the file's contents and a random number
                            var hash = CryptoJS.SHA256(Math.random() + CryptoJS.SHA256(filePayload));
                            //var f = new Firebase(firebaseRef + 'pano/' + hash + '/filePayload');
                            //spinner.spin(document.getElementById('spin'));
                            // Set the file payload to Firebase and register an onComplete handler to stop the spinner and show the preview

                            //var val = $('input[type=file]').val().toLowerCase();
                            //var val = "categorytestpng";
                            var val = f.name;
                            var ext = val.split('.')[1];
                            var docName = val.split('fakepath')[1];
                            var filename = (f.name).replace(/C:\\fakepath\\/i, '')

                            var timestamp = Number(new Date());
                            var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;
                            var uploadTask = storageRefcar.child(filename).put(theFile);
                            console.log(uploadTask);
                            uploadTask.on('state_changed', function (snapshot) {
                                // Observe state change events such as progress, pause, and resume
                                // Get task progress, including the number of bytes uploaded and the total number of bytes to be uploaded
                                var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                                console.log('Upload is ' + progress + '% done');
                                jQuery("#uploding_image_car").text("Image is uploading...");
                                // switch (snapshot.state) {
                                //   case firebase.storage.TaskState.PAUSED: // or 'paused'
                                //     console.log('Upload is paused');
                                //     break;
                                //   case firebase.storage.TaskState.RUNNING: // or 'running'
                                //     console.log('Upload is running');
                                //     jQuery("#uploding_image").text("Upload is running");
                                //     break;
                                // }
                            }, function (error) {
                                // Handle unsuccessful uploads
                            }, function () {
                                uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {
                                    //spinner.stop();
                                    jQuery("#uploding_image_car").text("Upload is completed");
                                    //jQuery("#photo").val(downloadURL);
                                    carPictureURL = downloadURL;
                                    $(".car_image").empty();
                                    $(".car_image").append('<img class="rounded" style="width:50px" src="' + carPictureURL + '" alt="image">');

                                });
                            });

                        };
                    })(f);
                    reader.readAsDataURL(f);
                }

                function handleFileSelectCarProof(evt) {
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
                            var uploadTask = storageRefcar.child(filename).put(theFile);
                            console.log(uploadTask);
                            uploadTask.on('state_changed', function (snapshot) {

                                var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                                console.log('Upload is ' + progress + '% done');
                                jQuery("#uploding_car_proof").text("Image is uploading...");

                            }, function (error) {
                            }, function () {
                                uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {

                                    jQuery("#uploding_car_proof").text("Upload is completed");

                                    carProofPictureURL = downloadURL;
                                    $(".car_proof").empty();
                                    $(".car_proof").append('<img class="rounded" style="width:50px" src="' + carProofPictureURL + '" alt="image">');

                                });
                            });

                        };
                    })(f);
                    reader.readAsDataURL(f);
                }

                function handleFileSelectDriverProof(evt) {
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
                            var uploadTask = storageRefcar.child(filename).put(theFile);
                            console.log(uploadTask);
                            uploadTask.on('state_changed', function (snapshot) {

                                var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                                console.log('Upload is ' + progress + '% done');
                                jQuery("#uploding_driver_proof").text("Image is uploading...");

                            }, function (error) {
                            }, function () {
                                uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {

                                    jQuery("#uploding_driver_proof").text("Upload is completed");

                                    driverProofPictureURL = downloadURL;
                                    $(".driver_proof").empty();
                                    $(".driver_proof").append('<img class="rounded" style="width:50px" src="' + driverProofPictureURL + '" alt="image">');

                                });
                            });

                        };
                    })(f);
                    reader.readAsDataURL(f);
                }

                function handleFileSelectVehicleImages(evt) {
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

                                $(".uploding_vehicle_images").text("Image is uploading...");

                            }, function (error) {
                            }, function () {
                                uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {

                                    $(".uploding_vehicle_images").text("Upload is completed");

                                    if (downloadURL) {

                                        rentalImagesCount++;
                                        photos_html = '<span class="image-item" id="photo_' + rentalImagesCount + '"><span class="remove-btn" data-id="' + rentalImagesCount + '" data-img="' + downloadURL + '"><i class="fa fa-remove"></i></span><img width="100px" id="" height="auto" src="' + downloadURL + '"></span>';
                                        $("#photos").append(photos_html);
                                        rentalImages.push(downloadURL);

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
                    index = rentalImages.indexOf(photo_remove);
                    if (index > -1) {
                        rentalImages.splice(index, 1); // 2nd parameter means remove one item only
                    }

                });

            </script>
@endsection
