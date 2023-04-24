@extends('layouts.app')

@section('content')
	<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{ trans('lang.app_setting_notifications')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{ trans('lang.app_setting_notifications')}}</li>
            </ol>
        </div>
    </div>

        <div class="card-body">
      	   <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>
                <div class="row vendor_payout_create">
                    <div class="vendor_payout_create-inner">
                            <fieldset>
                                <legend><i class="mr-3 fa fa-bell"></i>{{trans('lang.app_setting_notifications')}}</legend>
                                <div class="form-check width-100">
                                    <input type="checkbox" class="enable_pushnotification" id="enable_pushnotification" >
                                    <label class="col-5 control-label" for="enable_pushnotification">{{trans('lang.app_setting_enable_notifications')}}</label>
                                    <div class="form-text text-muted">
                                        {!! trans('lang.app_setting_enable_notifications_help') !!}
                                    </div>
                                </div>

                                <div class="form-group row width-100">
                                    <label class="col-3 control-label">{{trans('lang.app_setting_fcm_key')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control fcm_key">
                                        <div class="form-text text-muted">
                                            {!! trans('lang.app_setting_fcm_key_help') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row width-100">
                                    <label class="col-5 control-label">{{trans('lang.app_setting_firebase_api_key')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control firebase_api_key">
                                        <div class="form-text text-muted">
                                            {!! trans('lang.app_setting_firebase_api_key_help') !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row width-100">
                                    <label class="col-5 control-label">{{trans('lang.app_setting_firebase_database_url')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control firebase_db_url">
                                        <div class="form-text text-muted">
                                            {!! trans('lang.app_setting_firebase_database_url_help') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row width-100">
                                    <label class="col-5 control-label">{{trans('lang.app_setting_firebase_storage_bucket')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control firebase_storage_bucket">
                                        <div class="form-text text-muted">
                                            {!! trans('lang.app_setting_firebase_storage_bucket_help') !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row width-100">
                                    <label class="col-5 control-label">{{trans('lang.app_setting_firebase_app_id')}}</label>
                                    <div class="col-7">
                                        <input type="text" class=" form-control firebase_app_id">
                                        <div class="form-text text-muted">
                                            {!! trans('lang.app_setting_firebase_app_id_help') !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row width-100">
                                    <label class="col-5 control-label">{{trans('lang.app_setting_firebase_auth_domain')}}</label>
                                    <div class="col-7">
                                        <input type="text" class=" form-control firebase_auth_domain">
                                        <div class="form-text text-muted">
                                            {!! trans('lang.app_setting_firebase_auth_domain_help') !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row width-100">
                                    <label class="col-5 control-label">{{trans('lang.app_setting_firebase_project_id')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control firebase_project_id">
                                        <div class="form-text text-muted">
                                            {!! trans('lang.app_setting_firebase_project_id_help') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row width-100">
                                    <label class="col-5 control-label">{{trans('lang.app_setting_firebase_messaging_sender_id')}}</label>
                                    <div class="col-7">
                                        <input type="text" class="form-control firebase_message_sender_id">
                                        <div class="form-text text-muted">
                                            {!! trans('lang.app_setting_firebase_messaging_sender_id_help') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row width-100">
                                    <label class="col-5 control-label">{{trans('lang.app_setting_firebase_measurement_id')}}</label>
                                    <div class="col-7">
                                        <input type="text" class=" col-6 form-control firebase_measurment_id">
                                        <div class="form-text text-muted">
                                            {!! trans('lang.app_setting_firebase_measurement_id_help') !!}
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                    </div>
                </div>
            </div>


            <div class="form-group col-12 text-center btm-btn">
                <button type="button" class="btn btn-primary notification_save_btn" ><i class="fa fa-save"></i> {{trans('lang.save')}}</button>
                <a href="{{url('/dashboard')}}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
            </div>

          </div>
        </div>    
 @endsection

@section('scripts')

<script>
    


    var database = firebase.firestore();
    var ref = database.collection('settings').doc("pushNotification");


    $(document).ready(function(){
        jQuery("#data-table_processing").show();
        ref.get().then( async function(snapshots){  
        var pushNotification = snapshots.data();
        jQuery("#data-table_processing").hide();

        if(pushNotification.isEnabled){
            $(".enable_pushnotification").prop("checked",true);    
        }
        
        $(".fcm_key").val(pushNotification.firebaseCloudKey);
        $(".firebase_api_key").val(pushNotification.apiKey);
        $(".firebase_db_url").val(pushNotification.databaseURL);
        $(".firebase_storage_bucket").val(pushNotification.storageBucket);
        $(".firebase_app_id").val(pushNotification.applicationId);
        $(".firebase_auth_domain").val(pushNotification.authDomain);
        $(".firebase_project_id").val(pushNotification.projectId);
        $(".firebase_message_sender_id").val(pushNotification.messagingSenderId);
        $(".firebase_measurment_id").val(pushNotification.measurmentId);

      })


        $(".notification_save_btn").click(function(){
  
            var isEnabled = $(".enable_pushnotification").is(":checked");
            var fcmKey = $(".fcm_key").val();
            var firebaseApiKey = $(".firebase_api_key").val();
            var firebaseDbURL = $(".firebase_db_url").val();
            var storageBucket = $(".firebase_storage_bucket").val();
            var appId = $(".firebase_app_id").val();
            var authDomain =  $(".firebase_auth_domain").val();
            var projectId = $(".firebase_project_id").val();
            var messageSenderId = $(".firebase_message_sender_id").val();
            var measurmentId = $(".firebase_measurment_id").val();

            database.collection('settings').doc("pushNotification").update({'isEnabled':isEnabled,'firebaseCloudKey':fcmKey,'apiKey':firebaseApiKey,'databaseURL':firebaseDbURL,'storageBucket':storageBucket,'applicationId':appId,'authDomain':authDomain,'projectId':projectId,'messagingSenderId':messageSenderId,'measurmentId':measurmentId}).then(function(result) {
                     window.location.href = '{{ url()->current() }}';         
              });


        })
    })




</script>


@endsection