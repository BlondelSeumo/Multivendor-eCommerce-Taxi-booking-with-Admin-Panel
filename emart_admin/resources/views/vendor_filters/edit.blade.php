@extends('layouts.app')

@section('content')
	<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.vendor_filter')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a>
                </li>
                <li class="breadcrumb-item">
                  <a href="{{url('/vendorFilters')}}">{{trans('lang.vendor_filter')}}</a>
                </li>
                <li class="breadcrumb-item">{{trans('lang.vendor_filter_edit')}}</li>
            </ol>
        </div>
    </div>

        <div class="card-body">

      	 <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>

            <div class="row vendor_payout_create">
      
            <div class="vendor_payout_create-inner">

            <!-- <div class="col-md-6"> -->
            <fieldset>
              <legend>{{trans('lang.vendor_filter_edit')}}</legend>
              <div class="form-group row width-100">
                  <label class="col-3 control-label">{{ trans('lang.vendor_filter_name')}}</label>
                  <div class="col-7">
                    <input type="text" class="form-control filter_name">
                  </div>
              </div>

              <div class="form-group row width-100">
                  <label class="col-3 control-label">{{ trans('lang.add_new_option')}}</label>
                  <div class="col-7">
                    <input type="text" class="form-control add_option_name">&nbsp;&nbsp;
                  </div>
                  <div class="col-2">
                    <button type="button" class="btn btn-primary add_option_btn">{{ trans('lang.add_option')}}</button>
                  </div>
              </div>

              <div class="form-group row width-100">
                <label class="col-3 control-label">{{trans('lang.vendor_filter_options')}}</label>
                <div class="filter_options col-7">
                 <!-- <input type="text" class="form-control filter_options"> -->
                </div>
              </div>

            <!-- <div class="col-6">          
              
            </div> -->
           </fieldset>

           </div>
        
          </div>

          <div class="form-group col-12 text-center btm-btn">
            <button type="button" class="btn btn-primary save_filter_btn" ><i class="fa fa-save"></i> {{ trans('lang.save')}}</button>
            <a href="{!! route('vendorFilters') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
          </div>

          </div>
        </div>    


 @endsection

@section('scripts')

 <script>
      
  var id = "<?php echo $id;?>";
var database = firebase.firestore();
var ref = database.collection('vendor_filters').where("id","==",id);


$(document).ready(function(){
  jQuery("#data-table_processing").show();
  ref.get().then( async function(snapshots){
  var filter = snapshots.docs[0].data();




  $(".filter_name").val(filter.name);
        

  filter.options.forEach((option)=>{
      $(".filter_options").append('<input checked type="checkbox" name="action" id="'+option+'" value="'+option+'" /><label for="'+option+'">'+option+'</label><br />');
  })

            
  jQuery("#data-table_processing").hide();

  })


  
  $(".save_filter_btn").click(function(){
      //var photo ="https://assets.bonappetit.com/photos/5d03bea59ffc67bff3c6f86e/master/pass/HLY_Lentil_Burger_Horizontal.jpg";
      var filterName = $(".filter_name").val();
      var RButtons = [];
      $("input:checkbox[name=action]:checked").each(function(){
        RButtons.push($(this).val());
      });

      database.collection("vendor_filters").doc(id).update({'name':filterName,'options':RButtons}).then(function(result){

       window.location.href = '{{ url()->current() }}';
      })
       
    })

  $(".add_option_btn").click(function(){
    var optionname = $(".add_option_name").val();
    if(optionname != ''){
      $(".filter_options").append('<input checked type="checkbox" name="action" id="'+optionname+'" value="'+optionname+'" /><label for="'+optionname+'">'+optionname+'</label><br />&nbsp');
    }

    
  })


})


</script>

@endsection