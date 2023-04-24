@extends('layouts.app')

@section('content')

    <?php

    $back_url = url()->current();
    if (isset($_GET['id'])) {
        $back_url = route('vendors.booktable', $_GET['id']);
    }

    ?>
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.book_table')}}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{ $back_url }}">{{trans('lang.book_table_table')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('lang.bookig_edit')}}</li>
                </ol>
            </div>

        </div>
        <div>

            <div class="card-body">

                <div id="data-table_processing" class="dataTables_processing panel panel-default"
                     style="display: none;">{{trans('lang.processing')}}</div>

                <div class="error_top" style="display:none"></div>

                <div class="row vendor_payout_create">

                    <div class="vendor_payout_create-inner">

                        <!-- <div class="col-md-6"> -->
                        <fieldset>
                            <legend>{{trans('lang.book_table')}}</legend>


                            <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.date')}}</label>
                                <div class="col-7">
                                    <input class="form-control event_date" id="date" type="text" disabled>
                                </div>
                            </div>

                            <div class="form-group row width-50">
                                <label class="col-3 control-label">{{trans('lang.total_guest')}}</label>
                                <div class="col-7">
                                    <input class="form-control total_guest" type="number" disabled>
                                </div>
                            </div>


                            <div class="form-group row width-50">
                                <div class="col-7">
                                    <input class="form-control guest_first_name" id="guest_name" type="text"
                                           placeholder="{{trans('lang.first_name_help')}}" disabled>
                                </div>
                            </div>

                            <div class="form-group row width-50">
                                <div class="col-7">
                                    <input class="form-control guest_last_name" type="text" placeholder="{{trans('lang.last_name_help')}}"
                                           disabled>
                                </div>
                            </div>

                            <div class="form-group row width-50">
                                <div class="col-7">
                                    <input class="form-control guest_email" type="email" placeholder="Email" disabled>
                                </div>
                            </div>

                            <div class="form-group row width-50">
                                <div class="col-7">
                                    <input class="form-control guest_phone" placeholder="Phone" disabled>
                                </div>
                            </div>
                            <div class="form-group row width-50">
                                <div class="col-7">
                                    <select id='booking_status' class="form-control">
                                        <option value="Order Placed">{{trans('lang.order_placed')}}</option>
                                        <option value="Order Rejected">{{trans('lang.order_rejected')}}</option>
                                        <option value="Order Accepted">{{trans('lang.order_accepted')}}</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row width-50">
                                <div class="col-7">
                                    <input class="form-control booking_restaurant" disabled>
                                </div>
                            </div>


                            <div class="form-group row width-100">
                                <label for="birthday_occasion">{{trans('lang.spectal_occasion')}}</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="birthday"
                                           name="special_occassion" id="birthday" disabled>
                                    <label class="form-check-label" for="birthday">
                                        {{trans('lang.birthday')}}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="special_occassion"
                                           value="anniversary" id="anniversary" disabled>
                                    <label class="form-check-label" for="anniversary">
                                        {{trans('lang.anniversary')}}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row width-100">
                                <div class="form-check">
                                    <input type="checkbox" class="first_visit" id="first_visit" disabled>

                                    <label class="form-check-label" for="first_visit">
                                        {{trans('lang.first_visit')}}
                                    </label>

                                </div>
                            </div>

                            <div class="form-group row col-12">
                                <label for="special_request control-label">{{trans('lang.additional_request')}}</label>
                                <input class="form-control special_request" id="date" type="text" placeholder=""
                                       disabled>
                            </div>

                        </fieldset>
                    </div>

                </div>

            </div>
            <div class="form-group col-12 text-center btm-btn">
                <button type="button" class="btn btn-primary save_booking_btn"><i
                            class="fa fa-save"></i> {{ trans('lang.save')}}</button>
                <a href="{{route('vendors.booktable',$id)}}" class="btn btn-default"><i
                            class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
            </div>

        </div>

        @endsection

        @section('scripts')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
            <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
            <link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
            <script>
                var id = "<?php echo $id;?>";
                var database = firebase.firestore();
                var ref = database.collection('booked_table').where("id", "==", id);
                var auth = '';
                var type = '';
                var fullname = '';

                $(document).ready(function () {

                    jQuery("#data-table_processing").show();
                    ref.get().then(async function (snapshots) {
                        var book = snapshots.docs[0].data();


                        try {
                            $(".event_date").val(book.date.toDate().toDateString());
                            $(".total_guest").val(parseInt(book.totalGuest));
                            $(".guest_first_name").val(book.guestFirstName);
                            $(".guest_last_name").val(book.guestLastName);
                            $(".guest_email").val(book.guestEmail);
                            $(".guest_phone").val(book.guestPhone);
                            $(".special_request").val(book.specialRequest);

                            try {
                                if (book.occasion != undefined && book.occasion.trim() != '' && !isNaN(book.occasion)) {
                                    if (book.occasion.trim()) {
                                        $('#' + book.occasion).prop('checked', true);
                                    }
                                }
                            } catch (error) {

                            }

                            $('#booking_status').val(book.status);
                            $('.booking_restaurant').val(book.vendor.title);

                            auth = book.author.id;
                            fullname = book.vendor.title;

                            if (book.firstVisit) {
                                $(".first_visit").prop("checked", true);
                            }
                        } catch (error) {

                        }
                        jQuery("#data-table_processing").hide();

                    })


                    $(".save_booking_btn").click(function () {

                        var status = $("#booking_status").val();

                        database.collection('booked_table').doc(id).update({'status': status}).then(function (result) {

                            if (status == "Order Rejected") {
                                type = 'booktable_request_reject';
                            } else if (status == "Order Placed") {
                                type = '';
                            } else if (status == "Order Accepted") {
                                type = 'booktable_request_accepted';
                            }
                            database.collection('users').where('id', '==', auth).get().then(function (snapshots) {
                                if (snapshots.length && type == '') {
                                    snapshots.forEach((doc) => {
                                        if (doc.fcmToken) {
                                            $.ajax({
                                                method: 'POST',
                                                url: '<?php echo route('sendnotification'); ?>',
                                                data: {
                                                    'fcm': doc.fcmToken,
                                                    'type': type,
                                                    'authorName': fullname,
                                                    '_token': '<?php echo csrf_token() ?>'
                                                }
                                            }).done(function (data) {
                                                window.location.href = '{{ url()->current() }}';
                                            }).fail(function (xhr, textStatus, errorThrown) {
                                                window.location.href = '{{ url()->current() }}';
                                            });
                                        } else {
                                            window.location.href = '{{ url()->current() }}';
                                        }
                                    });
                                } else {
                                    window.location.href = '{{ url()->current() }}';
                                }
                            });

                        });

                    })

                })


            </script>
@endsection
