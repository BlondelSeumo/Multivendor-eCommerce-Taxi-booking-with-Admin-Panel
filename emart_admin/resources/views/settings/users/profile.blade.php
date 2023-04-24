@extends('layouts.app')




@section('content')
<div class="page-wrapper">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">{{trans('lang.user_profile')}}</h3>
		</div>

		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
				<li class="breadcrumb-item"><a href= "{!! route('users') !!}" >{{trans('lang.user_profile')}}</a></li>
				<li class="breadcrumb-item active">{{trans('lang.user_edit')}}</li>
			</ol>
		</div>

</div>

 <div class="profile-form">
            @if (Session::has('message'))
                <div class="alert alert-error">{{Session::get('message')}}</div>
            @endif

            <div class="card-body">
                
                <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>

                  <div class="column">
                      <form method="post" action="{{ route('users.profile.update',$user->id) }}">
                        @csrf
                   
                   <div class="row vendor_payout_create">
                    <div class="vendor_payout_create-inner">
                        <fieldset>     
                   <legend>{{trans('lang.profile_details')}}</legend> 
                    <div class="form-group row">
                        <label class="col-5 control-label">{{trans('lang.user_name')}}</label>
                       <div class="col-7"> 
                        <input type="text" class=" col-6 form-control" name="name" value="<?php echo $user->name; ?>">
                        <div class="form-text text-muted">
                                {{ trans("lang.user_name_help") }}
                        </div>
                    </div>
                    </div>
                    <div class="form-group row width-50">
                        <label class="col-5 control-label">{{trans('lang.old_password')}}</label>
                       <div class="col-7"> 
                        <input type="password" class=" col-6 form-control" name="old_password" >
                        <div class="form-text text-muted">
                                {{ trans("lang.old_password_help") }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row width-50">
                        <label class="col-5 control-label">{{trans('lang.new_password')}}</label>
                        <div class="col-7"> 
                        <input type="password" class=" col-6 form-control" name="password" >
                        <div class="form-text text-muted">
                                {{ trans("lang.user_password_help") }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row width-50">
                        <label class="col-5 control-label">{{trans('lang.confirm_password')}}</label>
                       <div class="col-7"> 
                        <input type="password" class=" col-6 form-control" name="confirm_password" >
                        <div class="form-text text-muted">
                                {{ trans("lang.confirm_password_help") }}
                            </div>
                        </div>
                    </div>
                      <div class="form-group row width-50">
                        <label class="col-5 control-label">{{trans('lang.user_email')}}</label>
                        <div class="col-7"> 
                        <input type="text" class=" col-6 form-control" value="<?php echo $user->email; ?>" name="email">
                        <div class="form-text text-muted">
                                {{ trans("lang.user_email_help") }}
                            </div>
                        </div>
                    </div>
                   </fieldset> 
                  </div>
                  </div>
                </div>

        <div class="form-group col-12 text-center btm-btn" >
            <button type="submit" class="btn btn-primary  save_user_btn" id="save_user_btn" ><i class="fa fa-save"></i> {{ trans('lang.save')}}</button>
            <a href="{!! route('dashboard') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
        </div>
     </form>

    </div>

</div>

@endsection

@section('scripts')
<script>

</script>
@endsection
