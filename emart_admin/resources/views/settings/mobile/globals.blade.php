@extends('layouts.app')

@section('content')
	<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.app_setting_mobile')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.app_setting_mobile')}}</li>
            </ol>
        </div>
    </div>

        <div class="card-body">
      	    <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div>
            <div class="row vendor_payout_create">
                <div class="vendor_payout_create-inner">
                    <fieldset>
                      <legend><i class="mr-3 fa fa-map"></i></i>{{trans('lang.app_setting_google_maps_key')}}</legend>
                      <div class="form-group row">
                        <label class="col-3 control-label">{{trans('lang.app_setting_google_maps_key')}}</label>
                        <div class="col-7">
                          <input type="text" class="form-control google_map_key">
                          <div class="form-text text-muted">
                            {!! trans('lang.app_setting_google_maps_key_help') !!}
                          </div>
                        </div>
                      </div>
                    </fieldset>

                  </div>
                </div>
              </div>

              <div class="form-group col-12 text-center btm-btn">
                <button type="button" class="btn btn-primary save_map_key_button" ><i class="fa fa-save"></i> {{trans('lang.save')}}</button>
                <a href="{{url('/dashboard')}}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
              </div>

      </div>    
</div>

 @endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
 <script>
        var database = firebase.firestore();
        var ref = database.collection('settings');
        

        $(document).ready(function(){
            $("#data-table_processing").show();
            ref.doc('googleMapKey').get().then( async function(snapshots){
            var data = snapshots.data();
            $("#data-table_processing").hide();
            $(".google_map_key").val(data.key);

            })    
        })  

        $(".save_map_key_button").click(function(){
            var mapKey = $(".google_map_key").val();
            database.collection('settings').doc('googleMapKey').update({'key':mapKey}).then(function(result) {
                 
                    window.location.href = '{!! url()->current() !!}';

                 });
        })

var storageRef = firebase.storage().ref('images');
function handleFileSelect(evt) {
  var f = evt.target.files[0];
  var reader = new FileReader();

  reader.onload = (function(theFile) {
    return function(e) {
        
      var filePayload = e.target.result;
      // Generate a location that can't be guessed using the file's contents and a random number
      var hash = CryptoJS.SHA256(Math.random() + CryptoJS.SHA256(filePayload));

        var val =f.name;       
      var ext=val.split('.')[1];
      var docName=val.split('fakepath')[1];
      var filename = (f.name).replace(/C:\\fakepath\\/i, '')

      var timestamp = Number(new Date());      
      var uploadTask = storageRef.child(filename).put(theFile);

      uploadTask.on('state_changed', function(snapshot){
      
      var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
      console.log('Upload is ' + progress + '% done');
      jQuery("#uploding_image").text("Image is uploading...");
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