@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">

            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{ trans('lang.special_offer')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{ trans('lang.special_offer')}}</li>
                </ol>
            </div>
        </div>

        <div class="card-body">
            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">
                Processing...
            </div>
            <div class="row vendor_payout_create">
                <div class="vendor_payout_create-inner">
                    <fieldset>
                        <legend>{{trans('lang.special_offer')}}</legend>

                        <div class="form-check width-100">
                            <input type="checkbox" class="form-check-inline" id="enable_special_discount">
                            <label class="col-5 control-label"
                                   for="enable_special_discount">{{ trans('lang.enable_special_discount_offer')}}</label>
                        </div>

                    </fieldset>
                </div>
            </div>

            <div class="form-group col-12 text-center">
                <button type="button" class="btn btn-primary save_special_offer"><i
                            class="fa fa-save"></i> {{trans('lang.save')}}</button>
                <a href="{{url('/dashboard')}}" class="btn btn-default"><i
                            class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
            </div>
        </div>


        @endsection

        @section('scripts')

            <script>

                var database = firebase.firestore();
                var ref = database.collection('settings').doc("specialDiscountOffer");

                var photo = "";
                $(document).ready(function () {

                    jQuery("#data-table_processing").show();
                    ref.get().then(async function (snapshots) {
                        var specialDiscountOffer = snapshots.data();
                       
                        if (specialDiscountOffer == undefined) {
                            database.collection('settings').doc('specialDiscountOffer').set({});
                        }
                        try {
                            if (specialDiscountOffer.isEnable) {
                                $("#enable_special_discount").prop('checked', true);

                            }

                        } catch (error) {

                        }

                        jQuery("#data-table_processing").hide();

                    })

                    $(".save_special_offer").click(function () {
                        var checkboxValue = $("#enable_special_discount").is(":checked");

                        database.collection('settings').doc("specialDiscountOffer").update({'isEnable': checkboxValue}).then(function (result) {
                            window.location.href = '{{ url("settings/app/specialOffer")}}';
                        });

                    })
                })
            </script>




@endsection
