@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">

            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.vendor_plural')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{!! route('vendors') !!}">{{trans('lang.vendor_plural')}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{trans('lang.vendor_edit')}}</li>
                </ol>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="resttab-sec">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                             style="display: none;">{{trans('lang.processing')}}
                        </div>

                        <div class="error_top"></div>
                        <div class="row vendor_payout_create">
                            <div class="vendor_payout_create-inner">

                                <fieldset>
                                    <legend>{{trans('lang.admin_area')}}</legend>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.first_name')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control user_first_name" required>
                                            <div class="form-text text-muted">
                                                {{ trans("lang.user_first_name_help") }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.last_name')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control user_last_name">
                                            <div class="form-text text-muted">
                                                {{ trans("lang.user_last_name_help") }}
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.email')}}</label>
                                        <div class="col-7">
                                            <input type="email" class="form-control user_email" required>
                                            <div class="form-text text-muted">
                                                {{ trans("lang.user_email_help") }}
                                            </div>
                                        </div>
                                    </div>

                                <!-- <div class="form-group row width-50">
                                  <label class="col-3 control-label">{{trans('lang.password')}}</label>
                                  <div class="col-7">
                                    <input type="password" class="form-control user_password" required>
                                    <div class="form-text text-muted">
                                      {{ trans("lang.user_password_help") }}
                                        </div>
                                      </div>
                                    </div> -->

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.user_phone')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control user_phone">
                                            <div class="form-text text-muted w-50">
                                                {{ trans("lang.user_phone_help") }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row width-100">
                                        <label class="col-3 control-label">{{trans('lang.vendor_image')}}</label>
                                        <input type="file" onChange="handleFileSelectowner(event,'vendor')"
                                               class="col-7">
                                        <div id="uploding_image_owner"></div>

                                        <div class="uploaded_image_owner" style="display:none;"><img
                                                    id="uploaded_image_owner" src="" width="150px" height="150px;">
                                        </div>
                                    </div>

                                </fieldset>

                                <fieldset>
                                    <legend>{{trans('lang.select_section')}}</legend>

                                    <div class="form-group row width-100">
                                        <label class="col-3 control-label ">{{trans('lang.select_section')}}</label>
                                        <div class="col-7">
                                            <select name="section_id" class="form-control" id="section_id">
                                                <option value="">{{trans('lang.select')}}</option>
                                            </select>
                                            <p style="color: red;font-size: 13px;"> Rental/Parcel/Cab Service are not shown in this
                                                sections</p>
                                        </div>
                                    </div>

                                </fieldset>

                                <fieldset>
                                    <legend>{{trans('lang.vendor_details')}}</legend>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.vendor_name')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control vendor_name">
                                            <div class="form-text text-muted">
                                                {{ trans("lang.vendor_name_help") }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.vendor_cuisine')}}</label>
                                        <div class="col-7">
                                            <select id='vendor_cuisines' class="form-control">
                                                <option value="">{{trans('lang.select_category')}}</option>
                                            </select>
                                            <div class="form-text text-muted">
                                                {{ trans("lang.vendor_cuisines_help") }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.vendor_phone')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control vendor_phone">
                                            <div class="form-text text-muted">
                                                {{ trans("lang.vendor_phone_help") }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.vendor_address')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control vendor_address">
                                            <div class="form-text text-muted">
                                                {{ trans("lang.vendor_address_help") }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row width-100">
                                        <div class="col-12">
                                            <h6>* Don't Know your cordinates ? use <a target="_blank"
                                                                                      href="https://www.latlong.net/">Latitude
                                                    and Longitude Finder</a></h6>
                                        </div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.vendor_latitude')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control vendor_latitude">
                                            <div class="form-text text-muted">
                                                {{ trans("lang.vendor_latitude_help") }}
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.vendor_longitude')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control vendor_longitude">
                                            <div class="form-text text-muted">
                                                {{ trans("lang.vendor_longitude_help") }}
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row width-100">
                                        <label class="col-3 control-label ">{{trans('lang.vendor_description')}}</label>
                                        <div class="col-7">
                                        <textarea rows="7" class="vendor_description form-control"
                                                  id="vendor_description"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row width-100">
                                        <label class="col-3 control-label">{{trans('lang.vendor_image')}}</label>
                                        <div class="col79">
                                            <input type="file" onChange="handleFileSelect(event,'photo')">
                                            <div id="uploding_image"></div>
                                            <div class="uploaded_image" style="display:none;"><img id="uploaded_image"
                                                                                                   src="" width="150px"
                                                                                                   height="150px;">
                                            </div>
                                            <div class="form-text text-muted">
                                                {{ trans("lang.vendor_image_help") }}
                                            </div>
                                        </div>
                                    </div>

                                </fieldset>

                                <fieldset>
                                    <legend>{{trans('lang.gallery')}}</legend>

                                    <div class="form-group row width-50 vendor_image">
                                        <div class="">
                                            <div id="photos"></div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div>
                                            <input type="file" onChange="handleFileSelect(event,'photos')">
                                            <div id="uploding_image_photos"></div>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend>{{trans('lang.working_hours')}}</legend>

                                    <div class="form-group row">
                                        <label class="col-12 control-label"
                                               style="color:red;font-size:15px;">{{trans('lang.working_hour_note')}}</label>
                                        <div class="form-group row width-100">
                                            <div class="col-7">
                                                <button type="button"
                                                        class="btn btn-primary  add_working_hours_restaurant_btn">
                                                    <i></i>{{trans('lang.add_working_hours')}}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="working_hours_div" style="display:none">


                                            <div class="form-group row">
                                                <label class="col-1 control-label">{{trans('lang.sunday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary add_more_sunday"
                                                            onclick="addMorehour('Sunday','sunday', '1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>


                                            <div class="restaurant_discount_options_Sunday_div restaurant_discount"
                                                 style="display:none">


                                                <table class="booking-table" id="working_hour_table_Sunday">
                                                    <tr>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.from')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.to')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                        </th>
                                                    </tr>

                                                </table>

                                            </div>

                                            <div class="form-group row">
                                                <label class="col-1 control-label">{{trans('lang.monday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary add_more_sunday"
                                                            onclick="addMorehour('Monday','monday', '1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="restaurant_discount_options_Monday_div restaurant_discount"
                                                 style="display:none">

                                                <table class="booking-table" id="working_hour_table_Monday">
                                                    <tr>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.from')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.to')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                        </th>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-1 control-label">{{trans('lang.tuesday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="addMorehour('Tuesday','tuesday', '1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="restaurant_discount_options_Tuesday_div restaurant_discount"
                                                 style="display:none">

                                                <table class="booking-table" id="working_hour_table_Tuesday">
                                                    <tr>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.from')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.to')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                        </th>
                                                    </tr>

                                                </table>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-1 control-label">{{trans('lang.wednesday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="addMorehour('Wednesday','wednesday', '1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>


                                            <div class="restaurant_discount_options_Wednesday_div restaurant_discount"
                                                 style="display:none">
                                                <table class="booking-table" id="working_hour_table_Wednesday">
                                                    <tr>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.from')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.to')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                        </th>
                                                    </tr>

                                                </table>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-1 control-label">{{trans('lang.thursday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="addMorehour('Thursday','thursday', '1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="restaurant_discount_options_Thursday_div restaurant_discount"
                                                 style="display:none">
                                                <table class="booking-table" id="working_hour_table_Thursday">
                                                    <tr>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.from')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.to')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                        </th>
                                                    </tr>

                                                </table>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-1 control-label">{{trans('lang.friday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="addMorehour('Friday','friday', '1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="restaurant_discount_options_Friday_div restaurant_discount"
                                                 style="display:none">
                                                <table class="booking-table" id="working_hour_table_Friday">
                                                    <tr>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.from')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.to')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                        </th>
                                                    </tr>

                                                </table>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-1 control-label">{{trans('lang.satuarday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="addMorehour('Satuarday','satuarday','1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="restaurant_discount_options_Satuarday_div restaurant_discount"
                                                 style="display:none">
                                                <table class="booking-table" id="working_hour_table_Satuarday">
                                                    <tr>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.from')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.to')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                        </th>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend>{{trans('lang.vendor_status')}}</legend>

                                    <div class="form-group row">

                                        <div class="form-group row width-50">
                                            <div class="form-check width-100">
                                                <input type="checkbox" id="is_open">
                                                <label class="col-3 control-label"
                                                       for="is_open">{{trans('lang.Is_Open')}}</label>
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend>{{trans('lang.vendor')}} {{trans('lang.active_deactive')}}</legend>
                                    <div class="form-group row">

                                        <div class="form-group row width-50">
                                            <div class="form-check width-100">
                                                <input type="checkbox" id="is_active">
                                                <label class="col-3 control-label"
                                                       for="is_active">{{trans('lang.active')}}</label>
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>

                                <fieldset style="display: none;" id="services_feature">
                                    <legend>{{trans('lang.services')}}</legend>
                                    <div class="form-group row">

                                        <div class="form-check width-100">
                                            <input type="checkbox" id="Free_Wi_Fi">
                                            <label class="col-3 control-label"
                                                   for="Free_Wi_Fi">{{trans('lang.wifi')}}</label>
                                        </div>
                                        <div class="form-check width-100">
                                            <input type="checkbox" id="Good_for_Breakfast">
                                            <label class="col-3 control-label"
                                                   for="Good_for_Breakfast">{{trans('lang.breakfast')}}</label>
                                        </div>
                                        <div class="form-check width-100">
                                            <input type="checkbox" id="Good_for_Dinner">
                                            <label class="col-3 control-label"
                                                   for="Good_for_Dinner">{{trans('lang.dinner')}}</label>
                                        </div>
                                        <div class="form-check width-100">
                                            <input type="checkbox" id="Good_for_Lunch">
                                            <label class="col-3 control-label"
                                                   for="Good_for_Lunch">{{trans('lang.lunch')}}</label>
                                        </div>

                                        <div class="form-check width-100">
                                            <input type="checkbox" id="Live_Music">
                                            <label class="col-3 control-label"
                                                   for="Live_Music">{{trans('lang.live_music')}}</label>
                                        </div>

                                        <div class="form-check width-100">
                                            <input type="checkbox" id="Outdoor_Seating">
                                            <label class="col-3 control-label"
                                                   for="Outdoor_Seating">{{trans('lang.outdoor_seating')}}</label>
                                        </div>

                                        <div class="form-check width-100">
                                            <input type="checkbox" id="Takes_Reservations">
                                            <label class="col-3 control-label"
                                                   for="Takes_Reservations">{{trans('lang.reservations')}}</label>
                                        </div>

                                        <div class="form-check width-100">
                                            <input type="checkbox" id="Vegetarian_Friendly">
                                            <label class="col-3 control-label"
                                                   for="Vegetarian_Friendly">{{trans('lang.vegetarian_friendly')}}</label>
                                        </div>

                                    </div>
                                </fieldset>

                                <fieldset style="display: none;" id="is_dine_in_feature">
                                    <legend>{{trans('lang.dine_in_future_setting')}}</legend>

                                    <div class="form-group row">

                                        <div class="form-group row width-100">
                                            <div class="form-check width-100">
                                                <input type="checkbox" id="dine_in_feature" class="">
                                                <label class="col-3 control-label"
                                                       for="dine_in_feature">{{trans('lang.enable_dine_in_feature')}}</label>
                                            </div>
                                        </div>
                                        <div class="divein_div" style="display:none">


                                            <div class="form-group row width-50">
                                                <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                                <div class="col-7">
                                                    <input type="time" class="form-control" id="openDineTime" required>
                                                </div>
                                            </div>

                                            <div class="form-group row width-50">
                                                <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                                <div class="col-7">
                                                    <input type="time" class="form-control" id="closeDineTime" required>
                                                </div>
                                            </div>

                                            <div class="form-group row width-50">
                                                <label class="col-3 control-label">{{trans('lang.cost')}}</label>
                                                <div class="col-7">
                                                    <input type="number" class="form-control vendor_cost" required>
                                                </div>
                                            </div>
                                            <div class="form-group row width-100 vendor_image">
                                                <label class="col-3 control-label">{{trans('lang.menu_card')}}</label>
                                                <div class="">
                                                    <div id="photos_menu_card"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div>
                                                    <input type="file" onChange="handleFileSelectMenuCard(event)">
                                                    <div id="uploaded_image_menu"></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>

                                <fieldset id="delivery_charges_div">
                                    <legend>{{trans('lang.deliveryCharge')}}</legend>

                                    <div class="form-group row">

                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{
                                            trans('lang.delivery_charges_per_km')}}</label>
                                            <div class="col-7">
                                                <input type="number" class="form-control" id="delivery_charges_per_km">
                                            </div>
                                        </div>
                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{
                                            trans('lang.minimum_delivery_charges')}}</label>
                                            <div class="col-7">
                                                <input type="number" class="form-control" id="minimum_delivery_charges">
                                            </div>
                                        </div>
                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{
                                            trans('lang.minimum_delivery_charges_within_km')}}</label>
                                            <div class="col-7">
                                                <input type="number" class="form-control"
                                                       id="minimum_delivery_charges_within_km">
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>


                                <fieldset>
                                    <legend>{{trans('lang.bankdetails')}}</legend>

                                    <div class="form-group row">

                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{
                                            trans('lang.bank_name')}}</label>
                                            <div class="col-7">
                                                <input type="text" name="bank_name" class="form-control" id="bankName">
                                            </div>
                                        </div>

                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{
                                            trans('lang.branch_name')}}</label>
                                            <div class="col-7">
                                                <input type="text" name="branch_name" class="form-control"
                                                       id="branchName">
                                            </div>
                                        </div>


                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{
                                            trans('lang.holer_name')}}</label>
                                            <div class="col-7">
                                                <input type="text" name="holer_name" class="form-control"
                                                       id="holderName">
                                            </div>
                                        </div>

                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{
                                            trans('lang.account_number')}}</label>
                                            <div class="col-7">
                                                <input type="text" name="account_number" class="form-control"
                                                       id="accountNumber">
                                            </div>
                                        </div>

                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{
                                            trans('lang.other_information')}}</label>
                                            <div class="col-7">
                                                <input type="text" name="other_information" class="form-control"
                                                       id="otherDetails">
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>{{trans('lang.special_offer')}}</legend>

                                    <div class="form-group row">
                                        <label class="col-12 control-label"
                                               style="color:red;font-size:15px;">{{trans('lang.special_discount_note')}}</label>
                                        <div class="form-group row width-100">
                                            <div class="col-7">
                                                <button type="button"
                                                        class="btn btn-primary  add_special_offer_restaurant_btn">
                                                    <i></i>{{trans('lang.add_special_offer')}}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="special_offer_div" style="display:none">


                                            <div class="form-group row">
                                                <label class="col-1 control-label">{{trans('lang.sunday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary add_more_sunday"
                                                            onclick="addMoreButton('Sunday','sunday', '1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>


                                            <div class="restaurant_discount_options_Sunday_div restaurant_discount"
                                                 style="display:none">


                                                <table class="booking-table" id="special_offer_table_Sunday">
                                                    <tr>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}
                                                                {{trans('lang.type')}}</label></th>

                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                        </th>
                                                    </tr>

                                                </table>

                                            </div>

                                            <div class="form-group row">
                                                <label class="col-1 control-label">{{trans('lang.monday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary add_more_sunday"
                                                            onclick="addMoreButton('Monday','monday', '1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="restaurant_discount_options_Monday_div restaurant_discount"
                                                 style="display:none">

                                                <table class="booking-table" id="special_offer_table_Monday">
                                                    <tr>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}
                                                                {{trans('lang.type')}}</label></th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                        </th>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-1 control-label">{{trans('lang.tuesday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="addMoreButton('Tuesday','tuesday', '1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="restaurant_discount_options_Tuesday_div restaurant_discount"
                                                 style="display:none">

                                                <table class="booking-table" id="special_offer_table_Tuesday">
                                                    <tr>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}
                                                                {{trans('lang.type')}}</label></th>

                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                        </th>
                                                    </tr>

                                                </table>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-1 control-label">{{trans('lang.wednesday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="addMoreButton('Wednesday','wednesday', '1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>


                                            <div class="restaurant_discount_options_Wednesday_div restaurant_discount"
                                                 style="display:none">
                                                <table class="booking-table" id="special_offer_table_Wednesday">
                                                    <tr>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}
                                                                {{trans('lang.type')}}</label></th>

                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                        </th>
                                                    </tr>

                                                </table>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-1 control-label">{{trans('lang.thursday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="addMoreButton('Thursday','thursday', '1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="restaurant_discount_options_Thursday_div restaurant_discount"
                                                 style="display:none">
                                                <table class="booking-table" id="special_offer_table_Thursday">
                                                    <tr>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}
                                                                {{trans('lang.type')}}</label></th>

                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                        </th>
                                                    </tr>

                                                </table>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-1 control-label">{{trans('lang.friday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="addMoreButton('Friday','friday', '1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="restaurant_discount_options_Friday_div restaurant_discount"
                                                 style="display:none">
                                                <table class="booking-table" id="special_offer_table_Friday">
                                                    <tr>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}
                                                                {{trans('lang.type')}}</label></th>

                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                        </th>
                                                    </tr>

                                                </table>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-1 control-label">{{trans('lang.satuarday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="addMoreButton('Satuarday','satuarday','1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="restaurant_discount_options_Satuarday_div restaurant_discount"
                                                 style="display:none">
                                                <table class="booking-table" id="special_offer_table_Satuarday">
                                                    <tr>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>
                                                        </th>
                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.coupon_discount')}}
                                                                {{trans('lang.type')}}</label></th>

                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                        </th>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                            </div>
                            </fieldset>
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group col-12 text-center btm-btn">
                <button type="button" class="btn btn-primary  save_vendor_btn"><i class="fa fa-save"></i>
                    {{trans('lang.save')}}
                </button>
                <a href="{!! route('vendors') !!}" class="btn btn-default"><i
                            class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
            </div>

        </div>
    </div>
    </div>


@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <script>
        var id = "<?php echo $id;?>";
        var database = firebase.firestore();
        var ref = database.collection('vendors').where("id", "==", id);
        var ref_sections = database.collection('sections');
        var photo = "";
        var vendor_photos = "";
        var vendorOwnerId = "";
        var vendorOwnerOnline = false;
        var photocount = 0;
        var vendorPhoto = '';
        var ownerPhoto = '';
        var ownerId = '';
        var menuPhotoCount = 0;
        var vendorMenuPhotos = "";
        var vendor_menu_photos = [];
        var sections_list = [];
        var categories_list = [];
        var placeholderImage = '';
        var placeholder = database.collection('settings').doc('placeHolderImage');
        var ref_deliverycharge = database.collection('settings').doc("DeliveryCharge");
        var deliveryChargeFlag = false;

        var workingHours = [];
        var timeslotworkSunday = [];
        var timeslotworkMonday = [];
        var timeslotworkTuesday = [];
        var timeslotworkWednesday = [];
        var timeslotworkFriday = [];
        var timeslotworkSatuarday = [];
        var timeslotworkThursday = [];

        var specialDiscount = [];
        var timeslotSunday = [];
        var timeslotMonday = [];
        var timeslotTuesday = [];
        var timeslotWednesday = [];
        var timeslotFriday = [];
        var timeslotSatuarday = [];
        var timeslotThursday = [];
        var currentCurrency = '';
        var currencyAtRight = false;
        var refCurrency = database.collection('currencies').where('isActive', '==', true);
        refCurrency.get().then(async function (snapshots) {
            var currencyData = snapshots.docs[0].data();
            currentCurrency = currencyData.symbol;
            currencyAtRight = currencyData.symbolAtRight;
        });

        placeholder.get().then(async function (snapshotsimage) {
            var placeholderImageData = snapshotsimage.data();
            placeholderImage = placeholderImageData.image;
        })

        var dine_in_active = false;

        ref_deliverycharge.get().then(async function (snapshots_charge) {
            var deliveryChargeSettings = snapshots_charge.data();

            try {
                if (deliveryChargeSettings.vendor_can_modify) {
                    deliveryChargeFlag = true;
                    console.log(deliveryChargeFlag)
                    $("#delivery_charges_per_km").val(deliveryChargeSettings.delivery_charges_per_km);
                    $("#minimum_delivery_charges").val(deliveryChargeSettings.minimum_delivery_charges);
                    $("#minimum_delivery_charges_within_km").val(deliveryChargeSettings.minimum_delivery_charges_within_km);
                } else {
                    deliveryChargeFlag = false;
                    console.log(deliveryChargeSettings)
                    $("#delivery_charges_per_km").val(deliveryChargeSettings.delivery_charges_per_km);
                    $("#minimum_delivery_charges").val(deliveryChargeSettings.minimum_delivery_charges);
                    $("#minimum_delivery_charges_within_km").val(deliveryChargeSettings.minimum_delivery_charges_within_km);
                    $("#delivery_charges_per_km").prop('disabled', true);
                    $("#minimum_delivery_charges").prop('disabled', true);
                    $("#minimum_delivery_charges_within_km").prop('disabled', true);
                }
            } catch (error) {

            }
        });

        $(document).ready(function () {

            ref_sections.get().then(async function (snapshots) {

                snapshots.docs.forEach((listval) => {
                    var data = listval.data();
                    if (data.serviceTypeFlag == "delivery-service" || data.serviceTypeFlag == "ecommerce-service") {

                        sections_list.push(data);
                        $('#section_id').append($("<option selected></option>")
                            .attr("value", data.id)
                            .attr("data-type", data.serviceTypeFlag)
                            .text(data.name + ' (' + data.serviceType + ')'));
                    }
                })
            })

            jQuery("#data-table_processing").show();
            ref.get().then(async function (snapshots) {
                var vendor = snapshots.docs[0].data();
                $(".vendor_name").val(vendor.title);
                try {
                    $("#vendor_cuisines").val(vendor.filters.Cuisine);
                } catch (err) {

                }
                $(".vendor_address").val(vendor.location);
                $(".vendor_latitude").val(vendor.latitude);
                $(".vendor_longitude").val(vendor.longitude);
                $(".vendor_description").val(vendor.description);
                if (vendor.section_id != undefined) {
                    $("#section_id").val(vendor.section_id);
                    var selected_section = vendor.section_id;
                    sections_list.forEach((section) => {
                        if (section.id == selected_section) {
                            if (section.dine_in_active == true) {
                                $("#is_dine_in_feature").show();
                                $("#services_feature").show();
                                dine_in_active = true;
                            }
                        }
                        if (section.id == selected_section && section.serviceTypeFlag == "ecommerce-service") {
                            $("#delivery_charges_div").hide();
                        }
                    });

                }

                if (vendor.photo) {
                    if (vendor.photo != '') {
                        $("#uploaded_image").attr('src', vendor.photo);
                        $(".uploaded_image").show();
                    } else {
                        $("#uploaded_image").attr('src', placeholderImage);
                        $(".uploaded_image").show();
                    }
                } else {
                    $("#uploaded_image").attr('src', placeholderImage);
                    $(".uploaded_image").show();
                }

                if (vendor.opentime) {
                    vendor.opentime = moment(vendor.opentime, 'hh:mm A').format('HH:mm');
                }

                if (vendor.closetime) {
                    vendor.closetime = moment(vendor.closetime, 'hh:mm A').format('HH:mm');

                }
                $("#opentime").val(vendor.opentime);
                $("#closetime").val(vendor.closetime);


                if (vendor.openDineTime) {
                    vendor.openDineTime = moment(vendor.openDineTime, 'hh:mm A').format('HH:mm');
                }

                if (vendor.closeDineTime) {
                    vendor.closeDineTime = moment(vendor.closeDineTime, 'hh:mm A').format('HH:mm');

                }
                $("#openDineTime").val(vendor.openDineTime);
                $("#closeDineTime").val(vendor.closeDineTime);

                if (vendor.reststatus) {
                    $("#is_open").prop("checked", true);
                }


                if (vendor.hasOwnProperty('enabledDiveInFuture')) {
                    if (vendor.enabledDiveInFuture) {
                        $("#dine_in_feature").prop("checked", true);
                    }
                }

                vendorPhoto = vendor.photo;
                if (vendor.hasOwnProperty('vendorMenuPhotos')) {
                    vendorMenuPhotos = vendor.vendorMenuPhotos;
                }

                if (vendor.hasOwnProperty('vendorCost')) {
                    $(".vendor_cost").val(vendor.vendorCost);
                }

                vendorPhoto = vendor.photo;


                for (var key in vendor.filters) {

                    if (key == "Free Wi-Fi" && vendor.filters[key] == "Yes") {
                        $("#Free_Wi_Fi").prop("checked", true);
                    }
                    if (key == "Good for Breakfast" && vendor.filters[key] == "Yes") {
                        $("#Good_for_Breakfast").prop("checked", true);
                    }
                    if (key == "Good for Dinner" && vendor.filters[key] == "Yes") {
                        $("#Good_for_Dinner").prop("checked", true);
                    }
                    if (key == "Good for Lunch" && vendor.filters[key] == "Yes") {
                        $("#Good_for_Lunch").prop("checked", true);
                    }
                    if (key == "Live Music" && vendor.filters[key] == "Yes") {
                        $("#Live_Music").prop("checked", true);
                    }
                    if (key == "Outdoor Seating" && vendor.filters[key] == "Yes") {
                        $("#Outdoor_Seating").prop("checked", true);
                    }
                    if (key == "Takes Reservations" && vendor.filters[key] == "Yes") {
                        $("#Takes_Reservations").prop("checked", true);
                    }
                    if (key == "Vegetarian Friendly" && vendor.filters[key] == "Yes") {
                        $("#Vegetarian_Friendly").prop("checked", true);
                    }


                }

                vendor_photos = vendor.photos;
                var photos = '';
                var menuCardPhotos = '';
                vendor.photos.forEach((photo) => {
                    photocount++;
                    photos = photos + '<span class="image-item" id="photo_' + photocount + '"><span class="remove-btn" data-id="' + photocount + '" data-img="' + photo + '"><i class="fa fa-remove"></i></span><img width="100px" id="" height="auto" src="' + photo + '"></span>';
                })
                if (photos) {
                    $("#photos").html(photos);
                } else {
                    $("#photos").html('<p>photos not available.</p>');
                }


                if (vendor.hasOwnProperty('vendorMenuPhotos')) {
                    vendor_menu_photos = vendor.vendorMenuPhotos;
                    vendor.vendorMenuPhotos.forEach((photo) => {
                        menuPhotoCount++;
                        menuCardPhotos = menuCardPhotos + '<span class="image-item" id="photo_menu' + menuPhotoCount + '"><span class="remove-btn remove-menu-btn" data-id="' + menuPhotoCount + '" data-img="' + photo + '"><i class="fa fa-remove"></i></span><img width="100px" id="" height="auto" src="' + photo + '"></span>';
                    })
                }

                for (var key in vendor.filters) {

                    if (key == "Free Wi-Fi" && vendor.filters[key] == "Yes") {
                        $("#Free_Wi_Fi").prop("checked", true);
                    }
                    if (key == "Good for Breakfast" && vendor.filters[key] == "Yes") {
                        $("#Good_for_Breakfast").prop("checked", true);
                    }
                    if (key == "Good for Dinner" && vendor.filters[key] == "Yes") {
                        $("#Good_for_Dinner").prop("checked", true);
                    }
                    if (key == "Good for Lunch" && vendor.filters[key] == "Yes") {
                        $("#Good_for_Lunch").prop("checked", true);
                    }
                    if (key == "Live Music" && vendor.filters[key] == "Yes") {
                        $("#Live_Music").prop("checked", true);
                    }
                    if (key == "Outdoor Seating" && vendor.filters[key] == "Yes") {
                        $("#Outdoor_Seating").prop("checked", true);
                    }
                    if (key == "Takes Reservations" && vendor.filters[key] == "Yes") {
                        $("#Takes_Reservations").prop("checked", true);
                    }
                    if (key == "Vegetarian Friendly" && vendor.filters[key] == "Yes") {
                        $("#Vegetarian_Friendly").prop("checked", true);
                    }

                }
                if (vendor.hasOwnProperty('specialDiscount')) {
                    for (i = 0; i < vendor.specialDiscount.length; i++) {
                        var day = vendor.specialDiscount[i]['day'];
                        if (vendor.specialDiscount[i]['timeslot'].length != 0) {
                            for (j = 0; j < vendor.specialDiscount[i]['timeslot'].length; j++) {
                                $(".restaurant_discount_options_" + day + "_div").show();

                                if (vendor.specialDiscount[i]) {
                                    if (vendor.specialDiscount[i]['timeslot']) {

                                        if (vendor.specialDiscount[i]['timeslot'].length > 0) {
                                            if (vendor.specialDiscount[i]['timeslot'][j]) {
                                                var timeslot = vendor.specialDiscount[i]['timeslot'][j];

                                                console.log(timeslot);
                                                if (timeslot['discount']) {
                                                    var discount = timeslot['discount'];

                                                    var TimeslotVar = {
                                                        'discount': timeslot[`discount`],
                                                        'from': timeslot[`from`],
                                                        'to': timeslot[`to`],
                                                        'type': timeslot[`type`],
                                                        'discount_type': timeslot[`discount_type`]
                                                    };
                                                    if (day == 'Sunday') {
                                                        timeslotSunday.push(TimeslotVar);
                                                    } else if (day == 'Monday') {
                                                        timeslotMonday.push(TimeslotVar);
                                                    } else if (day == 'Tuesday') {
                                                        timeslotTuesday.push(TimeslotVar);
                                                    } else if (day == 'Wednesday') {
                                                        timeslotWednesday.push(TimeslotVar);
                                                    } else if (day == 'Thursday') {
                                                        timeslotThursday.push(TimeslotVar);
                                                    } else if (day == 'Friday') {
                                                        timeslotFriday.push(TimeslotVar);
                                                    } else if (day == 'Satuarday') {
                                                        timeslotSatuarday.push(TimeslotVar);
                                                    }


                                                    $('#special_offer_table_' + day + ' tr:last').after('<tr>' +
                                                        '<td class="" style="width:10%;"><input type="time" class="form-control ' + i + '_' + j + '_row" value="' + timeslot[`from`] + '" id="openTime' + day + j + i + '" onchange="replaceText(`' + i + '`,`' + j + '`,`specialDiscount`)"></td>' +
                                                        '<td class="" style="width:10%;"><input type="time" class="form-control ' + i + '_' + j + '_row" value="' + timeslot[`to`] + '" id="closeTime' + day + j + i + '" onchange="replaceText(`' + i + '`,`' + j + '`,`specialDiscount`)"></td>' +
                                                        '<td class="" style="width:30%;">' +
                                                        '<input type="number" class="form-control ' + i + '_' + j + '_row" value="' + timeslot[`discount`] + '" style="width:60%;" id="discount' + day + j + i + '" onchange="replaceText(`' + i + '`,`' + j + '`,`specialDiscount`)">' +
                                                        '<select id="discount_type' + day + j + i + '" class="form-control ' + i + '_' + j + '_row"  style="width:40%;" onchange="replaceText(`' + i + '`,`' + j + '`,`specialDiscount`)"><option value="percentage"/>%</option><option value="amount"/>' + currentCurrency + '</option></select></td>' +
                                                        '<td style="width:30%;"><select id="type' + day + j + i + '" class="form-control ' + i + '_' + j + '_row" onchange="replaceText(`' + i + '`,`' + j + '`,`specialDiscount`)"><option value="delivery"/>Delivery Discount</option></select>' +
                                                        '</td>' +
                                                        '<td class="action-btn" style="width:20%;">' +
                                                        '<button type="button" class="btn btn-primary ' + i + '_' + j + '_row  specialDiscount_' + i + '_' + j + '"  onclick="updateMoreFunctionButton(`' + day + '`,`' + j + '`,`' + i + '`)" ><i class="fa fa-edit"></i></button>' +
                                                        '&nbsp;&nbsp;<button type="button" class="btn btn-primary ' + i + '_' + j + '_row" onclick="deleteOffer(`' + day + '`,`' + j + '`,`' + i + '`)" ><i class="fa fa-trash"></i></button>' +
                                                        '</td></tr>');

                                                    if (timeslot[`type`] == 'amount') {
                                                        $('#discount_type' + day + j + i).val(timeslot[`type`]);
                                                    }
                                                    if (timeslot[`discount_type`] == 'dinein') {
                                                        $('#type' + day + j + i).val(timeslot[`discount_type`]);
                                                    }
                                                }

                                            }
                                        }

                                    }
                                }

                            }
                        }
                    }
                }


                if (vendor.hasOwnProperty('workingHours')) {
                    for (i = 0; i < vendor.workingHours.length; i++) {
                        var day = vendor.workingHours[i]['day'];
                        if (vendor.workingHours[i]['timeslot'].length != 0) {
                            for (j = 0; j < vendor.workingHours[i]['timeslot'].length; j++) {
                                $(".restaurant_discount_options_" + day + "_div").show();
                                var timeslot = vendor.workingHours[i]['timeslot'][j];

                                var discount = vendor.workingHours[i]['timeslot'][j]['discount'];
                                var TimeslotHourVar = {'from': timeslot[`from`], 'to': timeslot[`to`]};
                                if (day == 'Sunday') {
                                    timeslotworkSunday.push(TimeslotHourVar);
                                } else if (day == 'Monday') {
                                    timeslotworkMonday.push(TimeslotHourVar);
                                } else if (day == 'Tuesday') {
                                    timeslotworkTuesday.push(TimeslotHourVar);
                                } else if (day == 'Wednesday') {
                                    timeslotworkWednesday.push(TimeslotHourVar);
                                } else if (day == 'Thursday') {
                                    timeslotworkThursday.push(TimeslotHourVar);
                                } else if (day == 'Friday') {
                                    timeslotworkFriday.push(TimeslotHourVar);
                                } else if (day == 'Satuarday') {
                                    timeslotworkSatuarday.push(TimeslotHourVar);
                                }


                                $('#working_hour_table_' + day + ' tr:last').after('<tr>' +
                                    '<td class="" style="width:50%;"><input type="time" class="form-control ' + i + '_' + j + '_row" value="' + timeslot[`from`] + '" id="from' + day + j + i + '" onchange="replaceText(`' + i + '`,`' + j + '`,`workingHours`)"></td>' +
                                    '<td class="" style="width:50%;"><input type="time" class="form-control ' + i + '_' + j + '_row" value="' + timeslot[`to`] + '" id="to' + day + j + i + '" onchange="replaceText(`' + i + '`,`' + j + '`,`workingHours`)"></td>' +
                                    '<td class="action-btn" style="width:20%;">' +
                                    '<button type="button" class="btn btn-primary ' + i + '_' + j + '_row workingHours_' + i + '_' + j + '"  onclick="updatehoursFunctionButton(`' + day + '`,`' + j + '`,`' + i + '`)" ><i class="fa fa-edit"></i></button>' +
                                    '&nbsp;&nbsp;<button type="button" class="btn btn-primary ' + i + '_' + j + '_row" onclick="deleteWorkingHour(`' + day + '`,`' + j + '`,`' + i + '`)" ><i class="fa fa-trash"></i></button>' +
                                    '</td></tr>');


                            }
                        }
                    }
                }
                if (menuCardPhotos) {
                    $("#photos_menu_card").html(menuCardPhotos);
                } else {
                    $("#photos_menu_card").html('<p>Menu card photos not available.</p>');
                }

                vendorOwnerOnline = vendor.isActive;
                if (vendor.hasOwnProperty('enabledDiveInFuture') && vendor.enabledDiveInFuture == true) {
                    $(".divein_div").show();
                }

                vendorOwnerOnline = vendor.isActive;
                photo = vendor.photo;
                vendorOwnerId = vendor.author;
                await database.collection('users').where("id", "==", vendor.author).get().then(async function (snapshots) {
                    snapshots.docs.forEach((listval) => {
                        var user = listval.data();
                        // $(".vendor_owners").val(user.firstName+" "+user.lastName);
                        ownerId = user.id;
                        ownerphoto = user.profilePictureURL
                        $(".user_first_name").val(user.firstName);
                        $(".user_last_name").val(user.lastName);
                        $(".user_email").val(user.email);
                        $(".user_phone").val(user.phoneNumber);
                        if (user.profilePictureURL != '') {
                            $("#uploaded_image_owner").attr('src', user.profilePictureURL);
                            $(".uploaded_image_owner").show();
                        } else {
                            $("#uploaded_image_owner").attr('src', placeholderImage);
                            $(".uploaded_image_owner").show();
                        }


                        if (user.active) {
                            vendor_active = true;
                            $("#is_active").prop("checked", true);
                        }


                        if (user.userBankDetails) {
                            if (user.userBankDetails.bankName != undefined) {
                                $("#bankName").val(user.userBankDetails.bankName);
                            }
                            if (user.userBankDetails.branchName != undefined) {
                                $("#branchName").val(user.userBankDetails.branchName);
                            }
                            if (user.userBankDetails.holderName != undefined) {
                                $("#holderName").val(user.userBankDetails.holderName);
                            }
                            if (user.userBankDetails.accountNumber != undefined) {
                                $("#accountNumber").val(user.userBankDetails.accountNumber);
                            }
                            if (user.userBankDetails.otherDetails != undefined) {
                                $("#otherDetails").val(user.userBankDetails.otherDetails);
                            }
                        }

                    })


                });


                await database.collection('vendor_categories').get().then(async function (snapshots) {
                    snapshots.docs.forEach((listval) => {
                        var data = listval.data();
                        categories_list.push(data);
                        if (data.id == vendor.categoryID) {
                            $('#vendor_cuisines').append($("<option selected></option>")
                                .attr("value", data.id)
                                .text(data.title));
                        } else {
                            $('#vendor_cuisines').append($("<option></option>")
                                .attr("value", data.id)
                                .text(data.title));
                        }
                    })

                });


                if (vendor.hasOwnProperty('phonenumber')) {
                    $(".vendor_phone").val(vendor.phonenumber);
                }

                if (vendor.deliveryCharge && deliveryChargeFlag) {
                    $("#delivery_charges_per_km").val(vendor.deliveryCharge.delivery_charges_per_km);
                    $("#minimum_delivery_charges").val(vendor.deliveryCharge.minimum_delivery_charges);
                    $("#minimum_delivery_charges_within_km").val(vendor.deliveryCharge.minimum_delivery_charges_within_km);
                }
                jQuery("#data-table_processing").hide();
            })


            $(".save_vendor_btn").click(function () {

                var vendorname = $(".vendor_name").val();
                var cuisines = $("#vendor_cuisines option:selected").val();
                var address = $(".vendor_address").val();
                var latitude = parseFloat($(".vendor_latitude").val());
                var longitude = parseFloat($(".vendor_longitude").val());
                var description = $(".vendor_description").val();
                var phonenumber = $(".vendor_phone").val();
                var categoryTitle = $("#vendor_cuisines option:selected").text();

                var userFirstName = $(".user_first_name").val();
                var userLastName = $(".user_last_name").val();
                var email = $(".user_email").val();
                var userPhone = $(".user_phone").val();
                var section_id = $("#section_id").val();

                var enabledDiveInFuture = $("#dine_in_feature").is(':checked');
                var vendorCost = $(".vendor_cost").val();

                var reststatus = false;
                if ($("#is_open").is(':checked')) {
                    reststatus = true;
                }

                var vendor_active = false;
                if ($("#is_active").is(':checked')) {
                    vendor_active = true;
                }
                var createdAt = firebase.firestore.FieldValue.serverTimestamp();

                // var opentime = $("#opentime").val();
                // var opentime_val = $("#opentime").val();
                // if (opentime) {
                //     opentime = new Date('1970-01-01T' + opentime + 'Z')
                //         .toLocaleTimeString('en-US',
                //             {timeZone: 'UTC', hour12: true, hour: 'numeric', minute: 'numeric'}
                //         );
                // }

                // var closetime = $("#closetime").val();
                // var closetime_val = $("#closetime").val();
                // if (closetime) {
                //     closetime = new Date('1970-01-01T' + closetime + 'Z')
                //         .toLocaleTimeString('en-US',
                //             {timeZone: 'UTC', hour12: true, hour: 'numeric', minute: 'numeric'}
                //         );
                // }


                var openDineTime = $("#openDineTime").val();
                var openDineTime_val = $("#openDineTime").val();
                if (openDineTime) {
                    openDineTime = new Date('1970-01-01T' + openDineTime + 'Z')
                        .toLocaleTimeString('en-US',
                            {timeZone: 'UTC', hour12: true, hour: 'numeric', minute: 'numeric'}
                        );
                }

                var closeDineTime = $("#closeDineTime").val();
                var closeDineTime_val = $("#closeDineTime").val();
                if (closeDineTime) {
                    closeDineTime = new Date('1970-01-01T' + closeDineTime + 'Z')
                        .toLocaleTimeString('en-US',
                            {timeZone: 'UTC', hour12: true, hour: 'numeric', minute: 'numeric'}
                        );
                }

                if (dine_in_active == false) {
                    enabledDiveInFuture = false;
                    vendorCost = "";
                    openDineTime = "";
                    closeDineTime = "";
                    vendor_menu_photos = [];
                }

                var specialDiscount = [];

                var sunday = {'day': 'Sunday', 'timeslot': timeslotSunday};
                var monday = {'day': 'Monday', 'timeslot': timeslotMonday};
                var tuesday = {'day': 'Tuesday', 'timeslot': timeslotTuesday};
                var wednesday = {'day': 'Wednesday', 'timeslot': timeslotWednesday};
                var thursday = {'day': 'Thursday', 'timeslot': timeslotThursday};
                var friday = {'day': 'Friday', 'timeslot': timeslotFriday};
                var satuarday = {'day': 'Satuarday', 'timeslot': timeslotSatuarday};

                specialDiscount.push(monday);
                specialDiscount.push(tuesday);
                specialDiscount.push(wednesday);
                specialDiscount.push(thursday);
                specialDiscount.push(friday);
                specialDiscount.push(satuarday);
                specialDiscount.push(sunday);


                var workingHours = [];

                var sunday = {'day': 'Sunday', 'timeslot': timeslotworkSunday};
                var monday = {'day': 'Monday', 'timeslot': timeslotworkMonday};
                var tuesday = {'day': 'Tuesday', 'timeslot': timeslotworkTuesday};
                var wednesday = {'day': 'Wednesday', 'timeslot': timeslotworkWednesday};
                var thursday = {'day': 'Thursday', 'timeslot': timeslotworkThursday};
                var friday = {'day': 'Friday', 'timeslot': timeslotworkFriday};
                var satuarday = {'day': 'Satuarday', 'timeslot': timeslotworkSatuarday};

                workingHours.push(monday);
                workingHours.push(tuesday);
                workingHours.push(wednesday);
                workingHours.push(thursday);
                workingHours.push(friday);
                workingHours.push(satuarday);
                workingHours.push(sunday);

                // coordinates=new firebase.firestore.GeoPoint(latitude,longitude);

                var Free_Wi_Fi = "No";
                if ($("#Free_Wi_Fi").is(':checked')) {
                    Free_Wi_Fi = "Yes";
                }
                var Good_for_Breakfast = "No";
                if ($("#Good_for_Breakfast").is(':checked')) {
                    Good_for_Breakfast = "Yes";
                }
                var Good_for_Dinner = "No";
                if ($("#Good_for_Dinner").is(':checked')) {
                    Good_for_Dinner = "Yes";
                }
                var Good_for_Lunch = "No";
                if ($("#Good_for_Lunch").is(':checked')) {
                    Good_for_Lunch = "Yes";
                }
                var Live_Music = "No";
                if ($("#Live_Music").is(':checked')) {
                    Live_Music = "Yes";
                }
                var Outdoor_Seating = "No";
                if ($("#Outdoor_Seating").is(':checked')) {
                    Outdoor_Seating = "Yes";
                }
                var Takes_Reservations = "No";
                if ($("#Takes_Reservations").is(':checked')) {
                    Takes_Reservations = "Yes";
                }
                var Vegetarian_Friendly = "No";
                if ($("#Vegetarian_Friendly").is(':checked')) {
                    Vegetarian_Friendly = "Yes";
                }

                var filters_new = {
                    "Free Wi-Fi": Free_Wi_Fi,
                    "Good for Breakfast": Good_for_Breakfast,
                    "Good for Dinner": Good_for_Dinner,
                    "Good for Lunch": Good_for_Lunch,
                    "Live Music": Live_Music,
                    "Outdoor Seating": Outdoor_Seating,
                    "Takes Reservations": Takes_Reservations,
                    "Vegetarian Friendly": Vegetarian_Friendly
                };

                var delivery_charges_per_km = parseInt($("#delivery_charges_per_km").val());
                var minimum_delivery_charges = parseInt($("#minimum_delivery_charges").val());
                var minimum_delivery_charges_within_km = parseInt($("#minimum_delivery_charges_within_km").val());
                var deliveryCharge = {
                    'delivery_charges_per_km': delivery_charges_per_km,
                    'minimum_delivery_charges': minimum_delivery_charges,
                    'minimum_delivery_charges_within_km': minimum_delivery_charges_within_km
                };

                if (userFirstName == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.enter_owners_name_error')}}</p>");
                    window.scrollTo(0, 0);
                } /*else if (email == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.enter_owners_email')}}</p>");
                window.scrollTo(0, 0);
            }*/ else if (userPhone == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.enter_owners_phone')}}</p>");
                    window.scrollTo(0, 0);
                } else if (vendorname == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.vendor_name_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (cuisines == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.vendor_cuisine_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (phonenumber == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.vendor_phone_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (address == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.vendor_address_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (isNaN(latitude)) {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.vendor_lattitude_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (latitude < -90 || latitude > 90) {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.vendor_lattitude_limit_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (isNaN(longitude)) {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.vendor_longitude_error')}}</p>");
                    window.scrollTo(0, 0);

                } else if (longitude < -180 || longitude > 180) {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.vendor_longitude_limit_error')}}</p>");
                    window.scrollTo(0, 0);

                } else if (description == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.vendor_description_error')}}</p>");
                    window.scrollTo(0, 0);


                } else if (section_id == '') {

                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.select_section_error')}}</p>");
                    window.scrollTo(0, 0);

                } else {

                    coordinates = new firebase.firestore.GeoPoint(latitude, longitude);

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


                    database.collection('users').doc(ownerId).update({
                        'firstName': userFirstName,
                        'lastName': userLastName,
                        'email': email,
                        'phoneNumber': userPhone,
                        'profilePictureURL': ownerphoto,
                        'active': vendor_active,
                        'userBankDetails': userBankDetails,
                        'section_id': section_id
                    }).then(function (result) {


                        geoFirestore.collection('vendors').doc(id).update({
                            'section_id': section_id,
                            'title': vendorname,
                            'description': description,
                            'latitude': latitude,
                            'longitude': longitude,
                            'location': address,
                            'photo': vendorPhoto,
                            'photos': vendor_photos,
                            'categoryID': cuisines,
                            'phonenumber': phonenumber,
                            'categoryTitle': categoryTitle,
                            'coordinates': coordinates,
                            'filters': filters_new,
                            'reststatus': reststatus,

                            'createdAt': createdAt,
                            'enabledDiveInFuture': enabledDiveInFuture,
                            'vendorMenuPhotos': vendor_menu_photos,
                            'vendorCost': vendorCost,
                            'openDineTime': openDineTime,
                            'closeDineTime': closeDineTime,
                            'specialDiscount': specialDiscount,
                            'workingHours': workingHours,
                        }).then(function (result) {

                            if (deliveryChargeFlag) {

                                geoFirestore.collection('vendors').doc(id).update({
                                    'deliveryCharge': deliveryCharge
                                }).then(function (result) {
                                    window.location.href = '{{ route("vendors")}}';
                                });
                            } else {

                                window.location.href = '{{ route("vendors")}}';
                            }

                        });
                    })
                }

            })

        })


        function replaceText(i, j, type) {

            $('.' + type + '_' + i + '_' + j).text("Save");
        }

        $(document).on("click", ".remove-btn", function () {
            var id = $(this).attr('data-id');
            var photo_remove = $(this).attr('data-img');
            $("#photo_" + id).remove();
            index = vendor_photos.indexOf(photo_remove);
            if (index > -1) {
                vendor_photos.splice(index, 1); // 2nd parameter means remove one item only
            }

        });

        function removeImage(photo_remove, photocount) {

            $("#photo_" + photocount).remove();
            index = vendor_photos.indexOf(photo_remove);
            if (index > -1) {
                vendor_photos.splice(index, 1); // 2nd parameter means remove one item only
            }

            //vendor_photos
        }

        var storageRef = firebase.storage().ref('images');

        function handleFileSelect(evt, type) {
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
                        if (type == "photo") {
                            jQuery("#uploding_image_vendor").text("Image is uploading...");
                        } else {
                            jQuery("#uploding_image_photos").text("Image is uploading...");
                        }

                    }, function (error) {
                    }, function () {
                        uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {

                            if (type == "photo") {
                                jQuery("#uploding_image_vendor").text("Upload is completed");
                            } else {
                                jQuery("#uploding_image_photos").text("Upload is completed");
                            }

                            photo = downloadURL;
                            if (type == "photo") {
                                vendorPhoto = downloadURL;
                            }

                            if (photo) {
                                if (type == 'photo') {
                                    $("#uploaded_image").attr('src', photo);
                                    $(".uploaded_image").show();
                                } else if (type == 'photos') {

                                    photocount++;
                                    photos_html = '<span class="image-item" id="photo_' + photocount + '"><span class="remove-btn" data-id="' + photocount + '" data-img="' + photo + '"><i class="fa fa-remove"></i></span><img width="100px" id="" height="auto" src="' + photo + '"></span>';
                                    $("#photos").append(photos_html);
                                    vendor_photos.push(photo);
                                }
                            }


                        });
                    });

                };
            })(f);
            reader.readAsDataURL(f);
        }

        function handleFileSelectowner(evt) {
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
                        jQuery("#uploding_image_owner").text("Image is uploading...");
                    }, function (error) {
                    }, function () {
                        uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {
                            jQuery("#uploding_image_owner").text("Upload is completed");
                            ownerphoto = downloadURL;

                            $("#uploaded_image_owner").attr('src', ownerphoto);
                            $(".uploaded_image_owner").show();

                        });
                    });

                };
            })(f);
            reader.readAsDataURL(f);
        }

        function handleFileSelectMenuCard(evt) {
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

                        jQuery("#uploaded_image_menu").text("Image is uploading...");


                    }, function (error) {
                    }, function () {
                        uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {

                            jQuery("#uploaded_image_menu").text("Upload is completed");

                            photo = downloadURL;

                            if (photo) {

                                menuPhotoCount++;
                                photos_html = '<span class="image-item" id="photo_menu' + menuPhotoCount + '"><span class="remove-btn remove-menu-btn" data-id="' + menuPhotoCount + '" data-img="' + photo + '"><i class="fa fa-remove"></i></span><img width="100px" id="" height="auto" src="' + photo + '"></span>';
                                $("#photos_menu_card").append(photos_html);
                                vendor_menu_photos.push(photo);
                            }


                        });
                    });

                };
            })(f);
            reader.readAsDataURL(f);
        }

        $("#dine_in_feature").change(function () {
            if (this.checked) {
                $(".divein_div").show();
            } else {
                $(".divein_div").hide();
            }
        });


        $("#section_id").change(function () {
            var selected_section = this.value;

            var serice_type = $("#section_id option:selected").data('type');
            if (serice_type == "ecommerce-service") {
                $("#delivery_charges_div").hide();
            } else {
                $("#delivery_charges_div").show();
            }

            $("#is_dine_in_feature").hide();
            $("#services_feature").hide();
            dine_in_active = false;
            $('#vendor_cuisines').html('');
            $('#vendor_cuisines').val('');
            categories_list.forEach((data) => {
                if (selected_section == data.section_id) {
                    $('#vendor_cuisines').append($("<option></option>")
                        .attr("value", data.id)
                        .text(data.title));
                }
            })

            sections_list.forEach((section) => {
                if (section.id == selected_section) {
                    if (section.dine_in_active == true) {
                        $("#is_dine_in_feature").show();
                        $("#services_feature").show();
                        dine_in_active = true;
                    }
                }
            });
        });

        $(".add_special_offer_restaurant_btn").click(function () {
            $(".special_offer_div").show();
        })

        var countAddButton = 1;

        function addMoreButton(day, day2, count) {
            count = countAddButton;
            $(".restaurant_discount_options_" + day + "_div").show();
            //  $(".restaurant_opentime_options_"+day).append('<input type="time" class="form-control" id="openTime'+day+'">');
            // $(".restaurant_closetime_options_"+day).append('<input type="time" class="form-control" id="closeTime'+day+'"  >');
            // $(".restaurant_discount_options_"+day).append('<input type="number" class="form-control" id="discount'+day+'">');
            // $(".restaurant_action_options_"+day+"_div").append('<button type="button" class="btn btn-primary save_option_day_button'+day+'" onclick="addMoreFunctionButton(`'+day2+'`,`'+day+'`)" >Save</button>');

            $('#special_offer_table_' + day + ' tr:last').after('<tr>' +
                '<td class="" style="width:10%;"><input type="time" class="form-control" id="openTime' + day + count + '"></td>' +
                '<td class="" style="width:10%;"><input type="time" class="form-control" id="closeTime' + day + count + '"></td>' +
                '<td class="" style="width:30%;">' +
                '<input type="number" class="form-control" id="discount' + day + count + '" style="width:60%;">' +
                '<select id="discount_type' + day + count + '" class="form-control" style="width:40%;"><option value="percentage"/>%</option><option value="amount"/>' + currentCurrency + '</option></select>' +
                '</td>' +
                '<td style="width:30%;"><select id="type' + day + count + '" class="form-control"><option value="delivery"/>Delivery Discount</option></select></td>' +
                '<td class="action-btn" style="width:20%;">' +
                '<button type="button" class="btn btn-primary save_option_day_button' + day + count + '" onclick="addMoreFunctionButton(`' + day2 + '`,`' + day + '`,' + countAddButton + ')" style="width:62%;">Save</button>' +
                '</td></tr>');
            countAddButton++;

        }

        function deleteOffer(day, count, i) {
            $('.' + i + '_' + count + '_row').hide();
            if (day == 'Sunday') {
                timeslotSunday.splice(count, 1);
            } else if (day == 'Monday') {
                timeslotMonday.splice(count, 1);
            } else if (day == 'Tuesday') {
                timeslotTuesday.splice(count, 1);
            } else if (day == 'Wednesday') {
                timeslotWednesday.splice(count, 1);
            } else if (day == 'Thursday') {
                timeslotThursday.splice(count, 1);
            } else if (day == 'Friday') {
                timeslotFriday.splice(count, 1);
            } else if (day == 'Satuarday') {
                timeslotSatuarday.splice(count, 1);
            }

            var specialDiscount = [];
            var sunday = {'day': 'Sunday', 'timeslot': timeslotSunday};
            var monday = {'day': 'Monday', 'timeslot': timeslotMonday};
            var tuesday = {'day': 'Tuesday', 'timeslot': timeslotTuesday};
            var wednesday = {'day': 'Wednesday', 'timeslot': timeslotWednesday};
            var thursday = {'day': 'Thursday', 'timeslot': timeslotThursday};
            var friday = {'day': 'Friday', 'timeslot': timeslotFriday};
            var satuarday = {'day': 'Satuarday', 'timeslot': timeslotSatuarday};

            specialDiscount.push(monday);
            specialDiscount.push(tuesday);
            specialDiscount.push(wednesday);
            specialDiscount.push(thursday);
            specialDiscount.push(friday);
            specialDiscount.push(satuarday);
            specialDiscount.push(sunday);


            database.collection('vendors').doc(id).update({'specialDiscount': specialDiscount}).then(function (result) {

            });
        }

        function addMoreFunctionButton(day1, day2, count) {
            var discount = $("#discount" + day2 + count).val();
            var discount_type = $('#discount_type' + day2 + count).val();
            var type = $('#type' + day2 + count).val();
            var closeTime = $("#closeTime" + day2 + count).val();
            var openTime = $("#openTime" + day2 + count).val();
            if (discount == "" && closeTime == '' && openTime == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>Please Enter valid time or discount</p>");
                window.scrollTo(0, 0);
            } else if (discount > 100 || discount == 0) {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>Please Enter valid discount</p>");
                window.scrollTo(0, 0);
            } else {

                var timeslotVar = {
                    'discount': discount,
                    'from': openTime,
                    'to': closeTime,
                    'type': discount_type,
                    'discount_type': type
                };
                console.log(timeslotVar);

                if (day1 == 'sunday') {
                    timeslotSunday.push(timeslotVar);
                } else if (day1 == 'monday') {
                    timeslotMonday.push(timeslotVar);
                } else if (day1 == 'tuesday') {
                    timeslotTuesday.push(timeslotVar);
                } else if (day1 == 'wednesday') {
                    timeslotWednesday.push(timeslotVar);
                } else if (day1 == 'thursday') {
                    timeslotThursday.push(timeslotVar);
                } else if (day1 == 'friday') {
                    timeslotFriday.push(timeslotVar);
                } else if (day1 == 'satuarday') {
                    timeslotSatuarday.push(timeslotVar);
                }

                /*$("#discount"+day2+"").remove();
                $("#discount_type"+day2+"").remove();
                $("#closeTime"+day2+"").remove();
                $("#openTime"+day2+"").remove();*/
                $(".save_option_day_button" + day2 + count).hide();
                $("#discount" + day2 + count).attr('disabled', "true");
                $("#discount_type" + day2 + count).attr('disabled', "true");
                $("#type" + day2 + count).attr('disabled', "true");
                $("#closeTime" + day2 + count).attr('disabled', "true");
                $("#openTime" + day2 + count).attr('disabled', "true");
            }

        }

        function updateMoreFunctionButton(day, rowCount, dayCount) {
            var discount = $("#discount" + day + rowCount + dayCount + "").val();
            var discount_type = $('#discount_type' + day + rowCount + dayCount + "").val();
            var type = $('#type' + day + rowCount + dayCount + "").val();
            var closeTime = $("#closeTime" + day + rowCount + dayCount + "").val();
            var openTime = $("#openTime" + day + rowCount + dayCount + "").val();
            if (discount == "" && closeTime == '' && openTime == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>Please Enter valid time or discount</p>");
                window.scrollTo(0, 0);
            } else if (discount > 100 || discount == 0) {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>Please Enter valid discount</p>");
                window.scrollTo(0, 0);
            } else {

                var timeslotVar = {
                    'discount': discount,
                    'from': openTime,
                    'to': closeTime,
                    'type': discount_type,
                    'discount_type': type
                };
                if (day == 'Sunday') {
                    console.log(timeslotSunday[rowCount]);
                    timeslotSunday[rowCount] = timeslotVar;
                } else if (day == 'Monday') {
                    console.log(timeslotMonday[rowCount]);
                    timeslotMonday[rowCount] = timeslotVar;

                } else if (day == 'Tuesday') {

                    console.log(timeslotTuesday[rowCount]);
                    timeslotTuesday[rowCount] = timeslotVar;
                } else if (day == 'Wednesday') {
                    console.log(timeslotWednesday[rowCount]);
                    timeslotWednesday[rowCount] = timeslotVar;


                } else if (day == 'Thursday') {
                    console.log(timeslotThursday[rowCount]);
                    timeslotThursday[rowCount] = timeslotVar;

                } else if (day == 'Friday') {
                    console.log(timeslotFriday[rowCount]);
                    timeslotFriday[rowCount] = timeslotVar;

                } else if (day == 'Satuarday') {
                    console.log(timeslotSatuarday[rowCount]);
                    timeslotSatuarday[rowCount] = timeslotVar;
                }
            }

        }


        $(".add_working_hours_restaurant_btn").click(function () {
            $(".working_hours_div").show();
        })
        var countAddhours = 1;

        function addMorehour(day, day2, count) {
            count = countAddhours;
            $(".restaurant_discount_options_" + day + "_div").show();
            //  $(".restaurant_opentime_options_"+day).append('<input type="time" class="form-control" id="openTime'+day+'">');
            // $(".restaurant_closetime_options_"+day).append('<input type="time" class="form-control" id="closeTime'+day+'"  >');
            // $(".restaurant_discount_options_"+day).append('<input type="number" class="form-control" id="discount'+day+'">');
            // $(".restaurant_action_options_"+day+"_div").append('<button type="button" class="btn btn-primary save_option_day_button'+day+'" onclick="addMoreFunctionButton(`'+day2+'`,`'+day+'`)" >Save</button>');

            $('#working_hour_table_' + day + ' tr:last').after('<tr>' +
                '<td class="" style="width:50%;"><input type="time" class="form-control" id="from' + day + count + '"></td>' +
                '<td class="" style="width:50%;"><input type="time" class="form-control" id="to' + day + count + '"></td>' +
                '<td><button type="button" class="btn btn-primary save_option_day_button' + day + count + '" onclick="addMoreFunctionhour(`' + day2 + '`,`' + day + '`,' + countAddhours + ')" style="width:62%;">Save</button>' +
                '</td></tr>');
            countAddhours++;

        }

        function addMoreFunctionhour(day1, day2, count) {
            var to = $("#to" + day2 + count).val();
            var from = $("#from" + day2 + count).val();
            if (to == '' && from == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>Please Enter valid time</p>");
                window.scrollTo(0, 0);

            } else {

                var timeslotworkVar = {'from': from, 'to': to,};
                console.log(timeslotworkVar);

                if (day1 == 'sunday') {
                    timeslotworkSunday.push(timeslotworkVar);
                } else if (day1 == 'monday') {
                    timeslotworkMonday.push(timeslotworkVar);
                } else if (day1 == 'tuesday') {
                    timeslotworkTuesday.push(timeslotworkVar);
                } else if (day1 == 'wednesday') {
                    timeslotworkWednesday.push(timeslotworkVar);
                } else if (day1 == 'thursday') {
                    timeslotworkThursday.push(timeslotworkVar);
                } else if (day1 == 'friday') {
                    timeslotworkFriday.push(timeslotworkVar);
                } else if (day1 == 'satuarday') {
                    timeslotworkSatuarday.push(timeslotworkVar);
                }

                /*$("#discount"+day2+"").remove();
                $("#discount_type"+day2+"").remove();
                $("#closeTime"+day2+"").remove();
                $("#openTime"+day2+"").remove();*/
                $(".save_option_day_button" + day2 + count).hide();
                $("#to" + day2 + count).attr('disabled', "true");
                $("#from" + day2 + count).attr('disabled', "true");
            }

        }

        function deleteWorkingHour(day, count, i) {
            $('.' + i + '_' + count + '_row').hide();
            if (day == 'Sunday') {
                timeslotworkSunday.splice(count, 1);
            } else if (day == 'Monday') {
                timeslotworkMonday.splice(count, 1);
            } else if (day == 'Tuesday') {
                timeslotworkTuesday.splice(count, 1);
            } else if (day == 'Wednesday') {
                timeslotworkWednesday.splice(count, 1);
            } else if (day == 'Thursday') {
                timeslotworkThursday.splice(count, 1);
            } else if (day == 'Friday') {
                timeslotworkFriday.splice(count, 1);
            } else if (day == 'Satuarday') {
                timeslotworkSatuarday.splice(count, 1);
            }

            var workingHours = [];
            var sunday = {'day': 'Sunday', 'timeslot': timeslotworkSunday};
            var monday = {'day': 'Monday', 'timeslot': timeslotworkMonday};
            var tuesday = {'day': 'Tuesday', 'timeslot': timeslotworkTuesday};
            var wednesday = {'day': 'Wednesday', 'timeslot': timeslotworkWednesday};
            var thursday = {'day': 'Thursday', 'timeslot': timeslotworkThursday};
            var friday = {'day': 'Friday', 'timeslot': timeslotworkFriday};
            var satuarday = {'day': 'Satuarday', 'timeslot': timeslotworkSatuarday};

            workingHours.push(monday);
            workingHours.push(tuesday);
            workingHours.push(wednesday);
            workingHours.push(thursday);
            workingHours.push(friday);
            workingHours.push(satuarday);
            workingHours.push(sunday);


            database.collection('vendors').doc(id).update({'workingHours': workingHours}).then(function (result) {

            });
        }

        function updatehoursFunctionButton(day, rowCount, dayCount) {
            var to = $("#to" + day + rowCount + dayCount + "").val();
            var from = $("#from" + day + rowCount + dayCount + "").val();
            if (to == '' && from == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>Please Enter valid time </p>");
                window.scrollTo(0, 0);

            } else {

                var timeslotworkVar = {'from': from, 'to': to};
                if (day == 'Sunday') {
                    console.log(timeslotworkSunday[rowCount]);
                    timeslotworkSunday[rowCount] = timeslotworkVar;
                } else if (day == 'Monday') {
                    console.log(timeslotworkMonday[rowCount]);
                    timeslotworkMonday[rowCount] = timeslotworkVar;

                } else if (day == 'Tuesday') {

                    console.log(timeslotworkTuesday[rowCount]);
                    timeslotworkTuesday[rowCount] = timeslotVar;
                } else if (day == 'Wednesday') {
                    console.log(timeslotworkWednesday[rowCount]);
                    timeslotworkWednesday[rowCount] = timeslotVar;


                } else if (day == 'Thursday') {
                    console.log(timeslotworkThursday[rowCount]);
                    timeslotworkThursday[rowCount] = timeslotVar;

                } else if (day == 'Friday') {
                    console.log(timeslotworkFriday[rowCount]);
                    timeslotworkFriday[rowCount] = timeslotVar;

                } else if (day == 'Satuarday') {
                    console.log(timeslotworkSatuarday[rowCount]);
                    timeslotworkSatuarday[rowCount] = timeslotVar;
                }
            }

        }
    </script>
@endsection
