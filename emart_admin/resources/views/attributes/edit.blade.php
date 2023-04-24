@extends('layouts.app')

@section('content')
	<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.item_attribute_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href= "{!! route('attributes') !!}" >{{trans('lang.item_attribute_plural')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.attribute_edit')}}</li>
            </ol>
        </div>
    </div>

        <div class="card-body">
      	  
          <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
          <div class="error_top" style="display:none"></div>
          <div class="row vendor_payout_create">          

            <div class="vendor_payout_create-inner">
              <fieldset>
              <legend>{{trans('lang.attribute_edit')}}</legend>
              <div class="form-group row width-100">
                <label class="col-3 control-label">{{trans('lang.attribute_name')}}</label>
                <div class="col-7">
                  <input type="text" class="form-control attribute-name">
                  <div class="form-text text-muted">{{ trans("lang.attribute_name_help") }} </div>
                </div>
              </div>

              </fieldset>
            </div>

          </div>

        </div>
        <div class="form-group col-12 text-center btm-btn">
          <button type="button" class="btn btn-primary save_attribute_btn" ><i class="fa fa-save"></i> {{trans('lang.save')}}</button>
          <a href="{!! route('attributes') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
        </div>
    
    </div>    


 @endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>

<script>

	var id = "<?php echo $id;?>";
  	var database = firebase.firestore();
  	var ref = database.collection('vendor_attributes').where("id","==",id);
  
  	$(document).ready(function(){
    	jQuery("#data-table_processing").show();
    	ref.get().then( async function(snapshots){
      		var attribute = snapshots.docs[0].data();
      		console.log(attribute);
      		$(".attribute-name").val(attribute.title);
      		jQuery("#data-table_processing").hide();
    	})

	$(".save_attribute_btn").click(function(){
		var title = $(".attribute-name").val();
 		if (title == '') {
  			$(".error_top").show();
  			$(".error_top").html("");
  			$(".error_top").append("<p>{{trans('lang.enter_cat_title_error')}}</p>");
    		window.scrollTo(0,0);
  		}else{
    		database.collection('vendor_attributes').doc(id).update({'title':title}).then(function(result) { 
    	  		window.location.href = '{{ route("attributes")}}';
	    	});
  		}
	});
});
  
</script>
@endsection