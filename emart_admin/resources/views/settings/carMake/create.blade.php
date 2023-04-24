@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.add_car_make')}}</h3>
            </div>

            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a
                                href="{!! route('settings.carMake') !!}">{{trans('lang.car_make')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('lang.add_car_make')}}</li>
                </ol>
            </div>

            <div class="card-body">

                <div id="data-table_processing" class="dataTables_processing panel panel-default"
                     style="display: none;">{{trans('lang.processing')}}</div>
                <div class="error_top"></div>

                <div class="row vendor_payout_create">
                    <div class="vendor_payout_create-inner">
                        <fieldset>
                            <legend>{{trans('lang.car_make')}}</legend>

                            <div class="form-group row width-100">
                                <label class="col-3 control-label">{{trans('lang.name')}}</label>
                                <div class="col-7">
                                    <input type="text" class="form-control title" id="title">
                                </div>
                            </div>

                            <div class="form-group row width-100">
                                <div class="form-check">
                                    <input type="checkbox" class="car_make_active" id="car_make_active">
                                    <label class="col-3 control-label"
                                           for="car_make_active">{{trans('lang.active')}}</label>

                                </div>


                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="form-group col-12 text-center btm-btn">
                <button type="button" class="btn btn-primary  create_user_btn"><i
                            class="fa fa-save"></i> {{ trans('lang.save')}}</button>
                <a href="{!! url('settings/carMake') !!}" class="btn btn-default"><i
                            class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
            </div>

        </div>

    </div>

@endsection

@section('scripts')
    <script>
        var database = firebase.firestore();


        $(".create_user_btn").click(function () {

            var title = $("#title").val();
            var active = $(".car_make_active").is(":checked");


            if (title == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.name_error')}}</p>");
                window.scrollTo(0, 0);

            } else {
                var id = "<?php echo uniqid(); ?>";
                jQuery("#data-table_processing").show();
                database.collection('car_make').doc(id).set({
                    'id': id,
                    'name': title,
                    'isActive': active
                }).then(function (result) {
                    jQuery("#data-table_processing").hide();
                    window.location.href = '{{ route("settings.carMake") }}';
                });
            }

        })
    </script>
@endsection