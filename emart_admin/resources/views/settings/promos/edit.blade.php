@extends('layouts.app')

@section('content')
<div class="page-wrapper">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">{{trans('lang.promo')}}</h3>
		</div>

		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

          <li class="breadcrumb-item"><a href= "{!! route('settings.promos') !!}" >{{trans('lang.promo')}}</a></li>

				<li class="breadcrumb-item active">{{trans('lang.promo_edit')}}</li>
			</ol>
		</div>

</div>
  <div>

      <div class="card-body">

        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>

        <div class="error_top" style="display:none"></div>

       <div class="row vendor_payout_create">

          <div class="vendor_payout_create-inner">

          <!-- <div class="col-md-6"> -->
          <fieldset>
              <legend>{{trans('lang.promo_edit')}}</legend>

            <div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.coupon_code')}}</label>
                <div class="col-7">
                  <input type="text" type="text" class="form-control coupon_code">
                  <div class="form-text text-muted">{{ trans("lang.coupon_code_help") }} </div>
                </div>
            </div>

            <div class="form-group row width-50">
              <label class="col-3 control-label">{{trans('lang.coupon_discount_type')}}</label>
              <div class="col-7">
                <select id="coupon_discount_type" class="form-control">
                  <option value="Percentage">{{trans('lang.coupon_percent')}}</option>
                  <option value="Fix Price">{{trans('lang.coupon_fixed')}}</option>
                </select>
                <div class="form-text text-muted">{{ trans("lang.coupon_discount_help") }}</div>
              </div>
            </div>

            <div class="form-group row width-50">
              <label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>
              <div class="col-7">
                <input type="number" type="text" class="form-control coupon_discount">
                <div class="form-text text-muted">{{ trans("lang.coupon_discount_type_help") }}</div>
              </div>
            </div>

            <div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.coupon_expires_at')}}</label>
                <div class="col-7">
                  <!-- <div class="form-group"> -->
                    <div class='input-group date' id='datetimepicker1'>
                      <input type='text' class="form-control date_picker input-group-addon" />
                      <span class="">

                      </span>
                    </div>
                  <div class="form-text text-muted">
                    {{ trans("lang.coupon_expires_at_help") }}
                  </div>

                </div>
            </div>

            <div class="form-group row width-100">
              <label class="col-3 control-label">{{trans('lang.coupon_description')}}</label>
              <div class="col-7">
                <textarea rows="12" class="form-control coupon_description" id="coupon_description"></textarea>
                <div class="form-text text-muted">{{ trans("lang.coupon_description_help") }}</div>
              </div>
            </div>

            <div class="form-group row width-100">
              <label class="col-3 control-label">{{trans('lang.category_image')}}</label>
              <div class="col-7">
                <input type="file" onChange="handleFileSelect(event)">
                <div class="placeholder_img_thumb coupon_image"></div>
                <div id="uploding_image"></div>
              </div>
            </div>

            <div class="form-group row width-100">
              <div class="form-check">
                <input type="checkbox" class="coupon_enabled" id="coupon_enabled">
                <label class="col-3 control-label" for="coupon_enabled">{{trans('lang.coupon_enabled')}}</label>

              </div>
            </div>


        </fieldset>
        </div>

       </div>

    </div>
    <div class="form-group col-12 text-center btm-btn">
        <button type="button" class="btn btn-primary save_coupon_btn" ><i class="fa fa-save"></i> {{ trans('lang.save')}}</button>

           <a href="{!! route('settings.promos') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
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
var ref = database.collection('promos').where("id","==",id);
var photo_promo ="";

var placeholderImage = '';
var placeholder = database.collection('settings').doc('placeHolderImage');

placeholder.get().then( async function(snapshotsimage){
    var placeholderImageData = snapshotsimage.data();
    placeholderImage = placeholderImageData.image;
})

$(document).ready(function(){

      $(function() {
          $('#datetimepicker1').datepicker({
            dateFormat:'mm/dd/yyyy'
          });
        });


  jQuery("#data-table_processing").show();
  ref.get().then( async function(snapshots){
  var promo = snapshots.docs[0].data();

  if (promo.image!='' && promo.image!=null) {
    photo_promo = promo.image;

    $(".coupon_image").append('<img class="rounded" style="width:50px" src="'+photo_promo+'" alt="image">');
  }else{

    $(".coupon_image").append('<img class="rounded" style="width:50px" src="'+placeholderImage+'" alt="image">');
  }
  $(".coupon_code").val(promo.code);
  $("#coupon_discount_type").val(promo.discountType);
  $(".coupon_discount").val(parseInt(promo.discount));
  $(".coupon_description").val(promo.description);

  if(promo.isEnabled){
      $(".coupon_enabled").prop("checked",true);
  }


  if(promo.hasOwnProperty("expiresAt")){

try{
    var date1 = promo.expiresAt.toDate().toDateString();
    var date = new Date(date1);
    var dd = String(date.getDate()).padStart(2, '0');
    var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = date.getFullYear();
    var expiresDate = mm + '/' + dd + '/' + yyyy;
  }
  catch(err){

    var date1 = '';
    var date = '';
    var dd = '';
    var mm = '';
    var yyyy = '';
    var expiresDate = '';

  }
    var $datepicker = $('.date_picker');
    $datepicker.datepicker();
    $datepicker.datepicker('setDate', expiresDate);
  }

  jQuery("#data-table_processing").hide();

  })


  $(".save_coupon_btn").click(function(){

  var code = $(".coupon_code").val();
  var discount = $(".coupon_discount").val();
  var description = $(".coupon_description").val();
  var newdate = new Date($(".date_picker").val());
  var expiresAt = new Date(newdate.setHours(23,59,59,999));
  var isEnabled = $(".coupon_enabled").is(":checked");
  var discountType = $("#coupon_discount_type").val();

      if(code == ''){
        $(".error_top").show();
        $(".error_top").html("");
        $(".error_top").append("<p>{{trans('lang.enter_promo_code_error')}}</p>");
        window.scrollTo(0,0);
      }else if(discount == ''){
        $(".error_top").show();
        $(".error_top").html("");
        $(".error_top").append("<p>{{trans('lang.enter_promo_discount_error')}}</p>");
        window.scrollTo(0,0);
      }else if(discountType == ''){
          $(".error_top").show();
          $(".error_top").html("");
          $(".error_top").append("<p>{{trans('lang.select_promo_discountType_error')}}</p>");
          window.scrollTo(0,0);
      }else if(newdate == 'Invalid Date'){
              $(".error_top").show();
              $(".error_top").html("");
              $(".error_top").append("<p>{{trans('lang.select_promo_expdate_error')}}</p>");
              window.scrollTo(0,0);

        }else{
        database.collection('promos').doc(id).update({'code':code,'description':description,'discount':discount,'expiresAt':expiresAt,'isEnabled':isEnabled,'id':id,'discountType':discountType,'image':photo_promo}).then(function(result) {


                 window.location.href = '{{ route("settings.promos")}}';

        });

    }

})

})

var storageRef = firebase.storage().ref('images');

function handleFileSelect(evt) {
  var f = evt.target.files[0];
  var reader = new FileReader();

  reader.onload = (function(theFile) {
    return function(e) {

      var filePayload = e.target.result;
      var hash = CryptoJS.SHA256(Math.random() + CryptoJS.SHA256(filePayload));
        var val =f.name;
      var ext=val.split('.')[1];
      var docName=val.split('fakepath')[1];
      var filename = (f.name).replace(/C:\\fakepath\\/i, '')
      var timestamp = Number(new Date());
			 var filename = filename.split('.')[0]+"_"+timestamp+'.'+ext;    
      var uploadTask = storageRef.child(filename).put(theFile);
      uploadTask.on('state_changed', function(snapshot){
      var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
      jQuery("#uploding_image").text("Image is uploading...");

    }, function(error) {
    }, function() {
        uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {
            jQuery("#uploding_image").text("Upload is completed");
            photo_promo = downloadURL;
             $(".coupon_image").empty();
            $(".coupon_image").append('<img class="rounded" style="width:50px" src="'+photo_promo+'" alt="image">');


      });
    });

    };
  })(f);
  reader.readAsDataURL(f);
}

</script>
@endsection
