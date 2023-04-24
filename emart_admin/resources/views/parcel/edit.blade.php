@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.driver_plural')}}</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href= "{!! route('drivers') !!}" >{{trans('lang.driver_plural')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.driver_edit')}}</li>
            </ol>
        </div>
  </div>
  <div>

   <div class="card-body">

    <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>


      <div class="error_top"></div>
      <div class="row vendor_payout_create">
        <div class="vendor_payout_create-inner">
        <fieldset>
                        <legend>{{trans('lang.parcel_category')}}</legend>
                          <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.title')}}</label>
                          <div class="col-7">
                            <input type="text" class="form-control title" id="title">
                          </div>
                        </div>

                        <div class="form-group row width-50">
                          <label class="col-3 control-label">{{trans('lang.set_order')}}</label>
                          <div class="col-7">
                            <input type="text" class="form-control set_order" id="set_order">
                          </div>
                        </div>
                        <div class="form-group row width-50">

                          <label class="col-3 control-label">{{trans('lang.photo')}}</label>

                          <input type="file" onChange="handleFileSelect(event)" class="col-7">

                          <div id="uploding_image"></div>
                          <div class="placeholder_img_thumb user_image"></div>
                        </div>
                        <div class="form-check width-100" >
                    <input type="checkbox" id="publish" name="publish">
                    <label class="col-4 control-label" for="publish">{{ trans('lang.is_publish')}}</label><br>

                    </div>


                      </fieldset>
</div>
</div>
</div>
<div class="form-group col-12 text-center btm-btn">
<button type="button" class="btn btn-primary save_parcel_btn" ><i class="fa fa-save"></i> {{ trans('lang.save')}}</button>
<a href="{!! route('parcelCategory') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a>
</div>

</div>

</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>

<script>

var id = "<?php echo $id;?>";
var database = firebase.firestore();
var ref = database.collection('parcel_categories').where("id","==",id);
var photo ="";
var storageRef = firebase.storage().ref('images');





$(document).ready(function(){
  jQuery("#data-table_processing").show();
  ref.get().then( async function(snapshots){
    var parcel = snapshots.docs[0].data();



    $("#title").val(parcel.title);

    $("#set_order").val(parcel.set_order);
    if(parcel.publish){
        $("#publish").prop('checked',true);
        }

        photo = parcel.image;
if (photo!='') {
  $(".user_image").append('<img class="rounded" style="width:50px" src="'+photo+'" alt="image">');

}


jQuery("#data-table_processing").hide();
/* console.log($(".note-editable").html()); */
})



  $(".save_parcel_btn").click(function(){
//var photo ="https://assets.bonappetit.com/photos/5d03bea59ffc67bff3c6f86e/master/pass/HLY_Lentil_Burger_Horizontal.jpg";

    var title = $('#title').val();
    var set_order =  parseInt($("#set_order").val());
    var publish = $("#publish").is(":checked");


    if(title == ''){
        $(".error_top").show();
        $(".error_top").html("");
        $(".error_top").append("<p>{{trans('lang.enter_parcel_title_error')}}</p>");
        window.scrollTo(0, 0);

    }else if(set_order == ''){
        $(".error_top").show();
        $(".error_top").html("");
        $(".error_top").append("<p>{{trans('lang.enter_parcel_set_order')}}</p>");
        window.scrollTo(0, 0);
      }
      else {
        database.collection('parcel_categories').doc(id).update({
                        'title': title,
                        'set_order': set_order,
                        'publish': publish,
                        'image': photo,

                    }).then(function (result) {
                        window.location.href = '{{ route("parcelCategory")}}';
                    });

      }
  })
})
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

    console.log(uploadTask);

    uploadTask.on('state_changed', function(snapshot){



    var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;

    console.log('Upload is ' + progress + '% done');

    jQuery("#uploding_image").text("Image is uploading...");



}, function(error) {

}, function() {

    uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {

        jQuery("#uploding_image").text("Upload is completed");

        photo = downloadURL;

        $(".user_image").empty();

        $(".user_image").append('<img class="rounded" style="width:50px" src="'+photo+'" alt="image">');



    });

});

};

})(f);

reader.readAsDataURL(f);

}


</script>
@endsection
