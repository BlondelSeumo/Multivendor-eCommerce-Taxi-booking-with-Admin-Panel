@extends('layouts.app')

@section('content')
	<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{ trans('lang.admin_commission')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{ trans('lang.admin_commission')}}</li>
            </ol>
        </div>
    </div>

        <div class="card-body">
      	  <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>
          <div class="row vendor_payout_create">
            <div class="vendor_payout_create-inner"> 
              <fieldset>
                <legend>{{trans('lang.admin_commission')}}</legend>
                    
                    <div class="form-check width-100">
                      <input type="checkbox" class="form-check-inline" onclick="ShowHideDiv()" id="enable_commission">
                        <label class="col-5 control-label" for="enable_commission">{{ trans('lang.enable_adminCommission')}}</label>
                    </div>

                    <div class="form-group row width-50">
                        <label class="col-4 control-label">{{ trans('lang.commission_type')}}</label>
                        <div class="col-7">
                          <select class="form-control commission_type" id="commission_type">
                            <option value="Percent">{{trans('lang.coupon_percent')}}</option>
                            <option value="Fixed">{{trans('lang.coupon_fixed')}}</option>
                          </select>
                        </div>
                    </div>

                    <div class="form-group row width-50" id="how_much_div"style="display:none">
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
            </div>
          </div>

          <div class="form-group col-12 text-center">
            <button type="button" class="btn btn-primary save_admin_commission" ><i class="fa fa-save"></i> {{trans('lang.save')}}</button>
            <a href="{{url('/dashboard')}}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
          </div>
        </div>    


 @endsection

@section('scripts')

<script>
    
    var database = firebase.firestore();
    var ref = database.collection('settings').doc("AdminCommission");
    var ref_deliverycharge = database.collection('settings').doc("DeliveryCharge");

    var photo = "";
    $(document).ready(function(){
        jQuery("#data-table_processing").show();
        ref.get().then( async function(snapshots){
          var adminCommissionSettings = snapshots.data();
          jQuery("#data-table_processing").hide();
            if(adminCommissionSettings.isEnabled){
                $("#enable_commission").prop('checked',true);
                $("#how_much_div").show();
            }
          $(".commission_fix").val(adminCommissionSettings.fix_commission);
          $("#commission_type").val(adminCommissionSettings.commissionType);
        })
        jQuery("#data-table_processing").hide();
        /*ref_deliverycharge.get().then( async function(snapshots_charge){
            var deliveryChargeSettings = snapshots_charge.data();
            jQuery("#data-table_processing").hide();
            $(".deliveryCharge").val(deliveryChargeSettings.amount);
        })*/




        $(".save_admin_commission").click(function(){
          var checkboxValue = $("#enable_commission").is(":checked");
          /*var deliveryCharge = parseInt($(".deliveryCharge").val());*/
          var commission_type = $("#commission_type").val();
          var howmuch = parseInt($(".commission_fix").val());
              database.collection('settings').doc("AdminCommission").update({'isEnabled':checkboxValue,'fix_commission':howmuch,'commissionType':commission_type}).then(function(result) {
                        /*database.collection('settings').doc("DeliveryCharge").update({'amount':deliveryCharge}).then(function(result) {*/
                            window.location.href = '{{ url("settings/app/adminCommission")}}';
                        /*});*/
                });

                    

        })
    })

    function ShowHideDiv(){
      var checkboxValue = $("#enable_commission").is(":checked");
      if(checkboxValue){
      $("#how_much_div").show();
    }else{
      $("#how_much_div").hide();
    }

  }

 
</script>




@endsection