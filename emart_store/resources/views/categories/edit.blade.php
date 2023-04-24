@extends('layouts.app')

@section('content')
	<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.category_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item"><a href= "{!! route('categories') !!}" >{{trans('lang.category_plural')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.category_plural')}}</li>
            </ol>
        </div>
    </div>

        <div class="card-body">
      	   <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>
            <div class="form-group row">
              <label class="col-3 control-label">{{trans('lang.category_name')}}</label>
              <div class="col-6">
                <input type="text" class="form-control cat-name">
                <div class="form-text text-muted">
                  {{ trans("lang.category_name_help") }}
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-3 control-label ">{{trans('lang.category_description')}}</label>
              <div class="col-6">
                  <textarea rows="7" class="category_description form-control" id="category_description"></textarea>
                  <div class="form-text text-muted">{{ trans("lang.category_description_help") }}</div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-3 control-label">{{trans('lang.category_image')}}</label>
              <div class="col-7">
                <input type="file" onChange="handleFileSelect(event)">
                <div id="uploding_image"></div>
                <div class="form-text text-muted w-50">
                  {{ trans("lang.category_image_help") }}
                </div>
              </div>
            </div>


                  <div class="form-group col-12 text-right">
          <button type="button" class="btn btn-primary save_category_btn" ><i class="fa fa-save"></i> {{trans('lang.save')}}</button>
          <a href="{!! route('categories') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
      </div>

          </div>
        </div>    


 @endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
 <script>
	var id = "<?php echo $id;?>";
  var database = firebase.firestore();
  var ref = database.collection('vendor_categories').where("id","==",id);
  var photo ="";

  $(document).ready(function(){
    jQuery("#data-table_processing").show();
    ref.get().then( async function(snapshots){
      var category = snapshots.docs[0].data();
      $(".cat-name").val(category.title);
      $(".category_description").val(category.description);
      photo = category.photo;
      jQuery("#data-table_processing").hide();
    })


  $(".save_category_btn").click(function(){

    var title = $(".cat-name").val();
    var description = $(".category_description").val();
    database.collection('vendor_categories').doc(id).update({'title':title,'description':description,'photo':photo}).then(function(result) { 
      window.location.href = '{{ route("categories")}}';
    });
  });


});

  var storageRef = firebase.storage().ref('images');
  function handleFileSelect(evt) {
    var f = evt.target.files[0];
    var reader = new FileReader();
    reader.onload = (function(theFile) {
    return function(e) {
        
      var filePayload = e.target.result;
      var hash = CryptoJS.SHA256(Math.random() + CryptoJS.SHA256(filePayload));
      var val = "categorytestpng";         
      var ext=val.split('.')[1];
      var docName=val.split('fakepath')[1];
      var filename = ('categorytest.png').replace(/C:\\fakepath\\/i, '')
      var timestamp = Number(new Date());      
      var uploadTask = storageRef.child(filename).put(theFile);
      uploadTask.on('state_changed', function(snapshot){
      var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
      }, function(error) {
      }, function() {
        uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {
            jQuery("#uploding_image").text("Upload is completed");
            photo = downloadURL;

      });   
    });
    
    };
  })(f);
  reader.readAsDataURL(f);
}   

</script>
@endsection
