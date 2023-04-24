@extends('layouts.app')

@section('content')
<div class="page-wrapper">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">{{trans('lang.homepageTemplate')}}</h3>
		</div>

		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a>
				</li>
				<li class="breadcrumb-item active">
					{{trans('lang.homepageTemplate')}}
				</li>
			</ol>
		</div>
		<div>

		</div>

	</div>

	<div class="card-body">

		<div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">
			{{trans('lang.processing')}}
		</div>
		<div class="error_top"></div>

		<div class="row vendor_payout_create">
			<div class="vendor_payout_create-inner">
				<fieldset>
					<legend>
						{{trans('lang.homepageTemplate')}}
					</legend>

					<div class="form-group width-100">
						<textarea class="form-control col-7" name="homepageTemplate" id="homepageTemplate"></textarea>
					</div>

				</fieldset>

			</div>
		</div>
	</div>

	<div class="form-group col-12 text-center btm-btn" >
		<button type="button" class="btn btn-primary  create_user_btn" >
			<i class="fa fa-save"></i> {{ trans('lang.save')}}
		</button>
		<a href="{!! route('users') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
	</div>

</div>

@endsection

@section('scripts')

<script>

var database = firebase.firestore();
var photo ="";
var ref = database.collection('settings').doc('homepageTemplate');

$(document).ready(function () {
  try {
    jQuery("#data-table_processing").show();
	ref.get().then(async function (snapshots) {
    var user = snapshots.data();
    	if(user.homepageTemplate){
              $('#homepageTemplate').summernote("code", user.homepageTemplate);
		}
	});
	jQuery("#data-table_processing").hide();
} catch (error) {
    jQuery("#data-table_processing").hide();
}

$('#homepageTemplate').summernote({
        height: 400,
        width: 1024,
        toolbar: [
		    // [groupName, [list of button]]
		    ['style', ['bold', 'italic', 'underline', 'clear']],
		    ['font', ['strikethrough', 'superscript', 'subscript']],
		    ['fontsize', ['fontsize']],
		    ['color', ['color']],
		    ['forecolor', ['forecolor']],
		    ['backcolor', ['backcolor']],
		    ['para', ['ul', 'ol', 'paragraph']],
		    ['height', ['height']],
		    ['view', ['fullscreen', 'codeview', 'help']],
  		]
    });
    
	$(".create_user_btn").click(function(){
	 
	  var homepageTemplate =  $('#homepageTemplate').summernote('code');
	    if(homepageTemplate == ''){
	        $(".error_top").show();
	        $(".error_top").html("");
	        $(".error_top").append("<p>{{trans('lang.homepageTemplate_error')}}</p>");
	        window.scrollTo(0, 0);
	  	}else{
		  	database.collection('settings').doc('homepageTemplate').update({'homepageTemplate':homepageTemplate}).then(function(result) {
				window.location.href = '{{ route("homepageTemplate")}}';
            });
		}
	})
});

</script>
@endsection