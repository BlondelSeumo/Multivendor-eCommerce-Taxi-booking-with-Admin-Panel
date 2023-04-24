@extends('layouts.app')


<?php

error_reporting(E_ALL ^ E_NOTICE);
?>

@section('content')
<div class="page-wrapper">

    <!-- ============================================================== -->

    <!-- Bread crumb and right sidebar toggle -->

    <!-- ============================================================== -->

    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">{{trans('lang.special_offer')}}</h3>

        </div>

        <div class="col-md-7 align-self-center">

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.special_offer')}}</li>
            </ol>

        </div>

        <div>

        </div>

    </div>


    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="card">

                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                            <li class="nav-item active">
                                <a class="nav-link" href="{!! route('specialOffer') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.specialoffer_list')}}</a>
                            </li>

                        </ul>
                    </div>

                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                             style="display: none;">{{trans('lang.processing')}}
                        </div>

                        <!-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> -->


                        <div class="error_top"></div>
                        <div class="row vendor_payout_create">
                            <div class="vendor_payout_create-inner">
                                <fieldset>
                                    <legend>{{trans('lang.special_offer')}}</legend>

                                    <div class="form-group row">


                                        <div class="special_offer_div">

                                            <div class="form-group row">
                                                <label class="col-12 control-label"
                                                       style="color:red;font-size:15px;">NOTE : Please Click on Edit
                                                    Button After Making Changes in Special Discount, Otherwise Data
                                                    may not Save!! </label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-1 control-label">{{trans('lang.sunday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary add_more_sunday"
                                                            onclick="addMoreButton('Sunday','sunday','1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>


                                            <div class="restaurant_discount_options_Sunday_div restaurant_discount"
                                                 style="display:none">


                                                <table class="booking-table" id="special_offer_table_Sunday">
                                                    <tr>
                                                        <th><label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                                        </th>
                                                        <th><label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                                        </th>
                                                        <th><label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>
                                                        </th>
                                                        <th><label class="col-3 control-label">{{trans('lang.coupon_discount')}}
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
                                                            onclick="addMoreButton('Monday','monday','1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="restaurant_discount_options_Monday_div restaurant_discount"
                                                 style="display:none">

                                                <table class="booking-table" id="special_offer_table_Monday">
                                                    <tr>
                                                        <th><label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                                        </th>
                                                        <th><label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                                        </th>
                                                        <th><label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>
                                                        </th>
                                                        <th><label class="col-3 control-label">{{trans('lang.coupon_discount')}}
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
                                                            onclick="addMoreButton('Tuesday','tuesday','1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="restaurant_discount_options_Tuesday_div restaurant_discount"
                                                 style="display:none">

                                                <table class="booking-table" id="special_offer_table_Tuesday">
                                                    <tr>
                                                        <th><label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                                        </th>
                                                        <th><label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                                        </th>
                                                        <th><label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>
                                                        </th>
                                                        <th><label class="col-3 control-label">{{trans('lang.coupon_discount')}}
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
                                                            onclick="addMoreButton('Wednesday','wednesday','1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>


                                            <div class="restaurant_discount_options_Wednesday_div restaurant_discount"
                                                 style="display:none">
                                                <table class="booking-table" id="special_offer_table_Wednesday">
                                                    <tr>
                                                        <th><label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                                        </th>
                                                        <th><label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                                        </th>
                                                        <th><label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>
                                                        </th>
                                                        <th><label class="col-3 control-label">{{trans('lang.coupon_discount')}}
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
                                                            onclick="addMoreButton('Thursday','thursday','1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="restaurant_discount_options_Thursday_div restaurant_discount"
                                                 style="display:none">
                                                <table class="booking-table" id="special_offer_table_Thursday">
                                                    <tr>
                                                        <th><label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                                        </th>
                                                        <th><label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                                        </th>
                                                        <th><label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>
                                                        </th>
                                                        <th><label class="col-3 control-label">{{trans('lang.coupon_discount')}}
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
                                                            onclick="addMoreButton('Friday','friday','1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="restaurant_discount_options_Friday_div restaurant_discount"
                                                 style="display:none">
                                                <table class="booking-table" id="special_offer_table_Friday">
                                                    <tr>
                                                        <th><label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                                        </th>
                                                        <th><label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                                        </th>
                                                        <th><label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>
                                                        </th>
                                                        <th><label class="col-3 control-label">{{trans('lang.coupon_discount')}}
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
                                                        <th><label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                                        </th>
                                                        <th><label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                                        </th>
                                                        <th><label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>
                                                        </th>
                                                        <th><label class="col-3 control-label">{{trans('lang.coupon_discount')}}
                                                                {{trans('lang.type')}}</label></th>

                                                        <th>
                                                            <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                        </th>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="form-group col-12 text-center btm-btn">
                                                <button type="button"
                                                        class="btn btn-primary  save_special_offer_btn"><i
                                                            class="fa fa-save"></i> {{trans('lang.save')}}
                                                </button>
                                                <a href="{{url('/dashboard')}}" class="btn btn-default"><i
                                                            class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>
                            </div>


                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</div>
</div>


@endsection


@section('scripts')
<script type="text/javascript">

    var database = firebase.firestore();
    var offest = 1;
    var pagesize = 10;
    var end = null;
    var endarray = [];
    var start = null;
    var user_number = [];
    var vendorUserId = "<?php echo $id; ?>";
    var vendorId = '';

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

    var append_list = '';

    getVendorId(vendorUserId).then(data => {
        jQuery("#data-table_processing").show();
        vendorId = data;
        var ref = database.collection('vendors').where("id", "==", vendorId);
        $(document).ready(function () {

            $(document.body).on('click', '.redirecttopage', function () {
                var url = $(this).attr('data-url');
                window.location.href = url;
            });

            var inx = parseInt(offest) * parseInt(pagesize);
            ref.limit(pagesize).get().then(async function (snapshots) {
                html = '';
                var restaurant = snapshots.docs[0].data();
                if (restaurant.hasOwnProperty('specialDiscount')) {
                    for (i = 0; i < restaurant.specialDiscount.length; i++) {
                        var day = restaurant.specialDiscount[i]['day'];

                        if (restaurant.specialDiscount[i]['timeslot'].length != 0) {
                            for (j = 0; j < restaurant.specialDiscount[i]['timeslot'].length; j++) {
                                $(".restaurant_discount_options_" + day + "_div").show();
                                var timeslot = restaurant.specialDiscount[i]['timeslot'][j];
                                var discount = restaurant.specialDiscount[i]['timeslot'][j]['discount'];
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
                                    '<select id="discount_type' + day + j + i + '" class="form-control ' + i + '_' + j + '_row"  style="width:40%;" onchange="replaceText(`' + i + '`,`' + j + '`,`specialDiscount`)"><option value="percentage">%</option><option value="amount">' + currentCurrency + '</option></select></td>' +
                                    '<td style="width:30%;"><select id="type' + day + j + i + '" class="form-control ' + i + '_' + j + '_row" onchange="replaceText(`' + i + '`,`' + j + '`,`specialDiscount`)"><option value="delivery">Delivery Discount</option></select>' +
                                    '</td>' +
                                    '<td class="action-btn" style="width:20%;">' +
                                    '<button type="button" class="btn btn-primary ' + i + '_' + j + '_row specialDiscount_' + i + '_' + j + '"  onclick="updateMoreFunctionButton(`' + day + '`,`' + j + '`,`' + i + '`)" ><i class="fa fa-edit"></i></button>' +
                                    '&nbsp;&nbsp;<button type="button" class="btn btn-primary ' + i + '_' + j + '_row" onclick="deleteOffer(`' + day + '`,`' + j + '`,`' + i + '`)" ><i class="fa fa-trash"></i></button>' +
                                    '</td></tr>');

                                if (timeslot[`type`] == 'amount') {
                                    $('#discount_type' + day + j + i).val(timeslot[`type`]);
                                }
                                // if (timeslot[`discount_type`] == 'dinein') {
                                //     $('#type' + day + j + i).val(timeslot[`discount_type`]);
                                // }

                            }
                        }
                    }
                }
                jQuery("#data-table_processing").hide();
            });

        });
    })

    function replaceText(i, j, type) {

        $('.' + type + '_' + i + '_' + j).text("Save");
    }

    $(".save_special_offer_btn").click(function () {

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
        console.log(specialDiscount);
        database.collection('vendors').doc(vendorId).update({'specialDiscount': specialDiscount}).then(function (result) {
            window.location.href = '{{ route("specialOffer")}}';
        });
    })

    var countAddButton = 1;

    function addMoreButton(day, day2, count) {
        count = countAddButton;
        $(".restaurant_discount_options_" + day + "_div").show();

        $('#special_offer_table_' + day + ' tr:last').after('<tr>' +
            '<td class="" style="width:10%;"><input type="time" class="form-control" id="openTime' + day + count + '"></td>' +
            '<td class="" style="width:10%;"><input type="time" class="form-control" id="closeTime' + day + count + '"></td>' +
            '<td class="" style="width:30%;">' +
            '<input type="number" class="form-control" id="discount' + day + count + '" style="width:60%;">' +
            '<select id="discount_type' + day + count + '" class="form-control" style="width:40%;"><option value="percentage">%</option><option value="amount">' + currentCurrency + '</option></select>' +
            '</td>' +
            '<td style="width:30%;"><select id="type' + day + count + '" class="form-control"><option value="delivery">Delivery Discount</option></select></td>' +
            '<td class="action-btn" style="width:20%;">' +
            '<button type="button" class="btn btn-primary save_option_day_button' + day + count + '" onclick="addMoreFunctionButton(`' + day2 + '`,`' + day + '`,' + count + ')" style="width:62%;">Save</button>' +
            '</td></tr>');
        countAddButton++;
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

        database.collection('vendors').doc(vendorId).update({'specialDiscount': specialDiscount}).then(function (result) {

        });

    }

    async function getVendorId(vendorUser) {
        var vendorId = '';
        var ref;
        await database.collection('vendors').where('author', "==", vendorUser).get().then(async function (vendorSnapshots) {
            var vendorData = vendorSnapshots.docs[0].data();
            vendorId = vendorData.id;
        })

        return vendorId;
    }


</script>


@endsection
