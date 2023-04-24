@extends('layouts.app')

@section('content')
	<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{ trans('lang.radios_configuration')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{ trans('lang.radios_configuration')}}</li>
            </ol>
        </div>
    </div>

      <div class="card-body">
         <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
         <div class="error_top" style="display:none"></div>
        <div class="row vendor_payout_create">
          <div class="vendor_payout_create-inner">
              <fieldset>
                <legend>{{trans('lang.radios_configuration')}}</legend>
                <div class="form-group row width-50">
                    <label class="col-4 control-label">{{ trans('lang.vendornearby_radios')}}</label>
                    <div class="col-7">
                      <div class="control-inner">
                        <input type="number" class="form-control vendor_near_by" required>
                        <span>{{ trans('lang.miles')}}</span>
                      </div>
                    </div>
                  </div>
                <div class="form-group row width-50">
                    <label class="col-4 control-label">{{ trans('lang.driver_nearby_radios')}}</label>
                    <div class="col-7">
                      <div class="control-inner">
                        <input type="number" class="form-control driver_nearby_radios" required>
                        <span>{{ trans('lang.miles')}}</span>
                    </div>
                    </div>
                </div>

                <div class="form-group row width-50">
                    <label class="col-4 control-label">{{ trans('lang.driverOrderAcceptRejectDuration')}}</label>
                    <div class="col-7">
                      <div class="control-inner">
                        <input type="number" class="form-control driverOrderAcceptRejectDuration" required>
                        <span>{{ trans('lang.second')}}</span>
                    </div>
                    </div>
                </div>

              </fieldset>

              <fieldset>
                <legend>{{trans('lang.cab_service_settings')}}</legend>
                <div class="form-check width-100">
                    <input type="checkbox" class="enableOTPTripStart" id="enableOTPTripStart">
                    <label class="col-3 control-label" for="enable_stripe">{{trans('lang.enableOTPTripStart')}}</label>
                </div>
              </fieldset>

              <fieldset>
                <legend>{{trans('lang.parcel_service_settings')}}</legend>

                <div class="form-check width-100">
                    <input type="checkbox" class="enableOTPParcelReceive" id="enableOTPParcelReceive">
                    <label class="col-3 control-label" for="enable_stripe">{{trans('lang.enableOTPParcelReceive')}}</label>
                </div>

              </fieldset>

          </div>
        </div>
      </div>
          <div class="form-group col-12 text-center btm-btn">
            <button type="button" class="btn btn-primary vendor_near_by_save_btn" ><i class="fa fa-save"></i> {{trans('lang.save')}}</button>
            <a href="{{url('/dashboard')}}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
          </div>
        </div>    


 @endsection

@section('scripts')

<script>
    


    var database = firebase.firestore();
    var ref = database.collection('settings').doc("VendorNearBy");
    var refDriver = database.collection('settings').doc("DriverNearBy");



    $(document).ready(function(){
       jQuery("#data-table_processing").show();
        ref.get().then( async function(snapshots){  
          var radios = snapshots.data();
          $(".vendor_near_by").val(radios.radios);
        })

        refDriver.get().then( async function(snapshots){  
          var radios = snapshots.data();
          $(".driver_nearby_radios").val(radios.driverRadios);
          $(".driverOrderAcceptRejectDuration").val(radios.driverOrderAcceptRejectDuration);
          if (radios.enableOTPParcelReceive) {
                $(".enableOTPParcelReceive").prop('checked', true);
          }
          if (radios.enableOTPTripStart) {
                $(".enableOTPTripStart").prop('checked', true);
          }

        })
          jQuery("#data-table_processing").hide();
    })


      $(".vendor_near_by_save_btn").click(function(){
        var vendorNearBy = $(".vendor_near_by").val();
        var driverNearBy = $(".driver_nearby_radios").val();
        var enableOTPParcelReceive = $(".enableOTPParcelReceive").is(":checked");
        var enableOTPTripStart = $(".enableOTPTripStart").is(":checked");
        var driverOrderAcceptRejectDuration = $(".driverOrderAcceptRejectDuration").val();
        if(vendorNearBy == ''){
          $(".error_top").show();
          $(".error_top").html("");
          $(".error_top").append("<p>{{trans('lang.enter_vendor_nearby_error')}}</p>");
        }else if(driverNearBy == ''){
            $(".error_top").show();
            $(".error_top").html("");
            $(".error_top").append("<p>{{trans('lang.enter_driver_nearby_radios_error')}}</p>");
        }else if(driverOrderAcceptRejectDuration == ''){
            $(".error_top").show();
            $(".error_top").html("");
            $(".error_top").append("<p>{{trans('lang.driverOrderAcceptRejectDuration_error')}}</p>");
        }else{
         database.collection('settings').doc("VendorNearBy").update({'radios':vendorNearBy}).then(function(result) {

              database.collection('settings').doc("DriverNearBy").update({'driverRadios':driverNearBy,'driverOrderAcceptRejectDuration':Number(driverOrderAcceptRejectDuration),'enableOTPParcelReceive':enableOTPParcelReceive,'enableOTPTripStart':enableOTPTripStart}).then(function(result) {
                     window.location.href = '{{ url()->current() }}';         
              });

        });
        }
        
    })

</script>




@endsection