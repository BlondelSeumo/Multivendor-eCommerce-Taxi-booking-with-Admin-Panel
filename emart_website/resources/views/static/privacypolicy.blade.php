@include('layouts.app')

@include('layouts.header') 

<div class="container position-relative extra-page">

<div class="col-md-12 mb-3 mt-5 pb-5 pt-3">
 <div class="privacy"></div>
</div>
</div>





@include('layouts.footer');

<script>

    console.log('user_uuid  '+user_uuid);
	var id = user_uuid;
	var database = firebase.firestore();
	var ref = database.collection('settings').doc('privacyPolicy');

	
	$(document).ready(function(){

 		//jQuery("#data-table_processing").show();

  		ref.get().then( async function(snapshots){

		var user = snapshots.data();
        console.log(user);
		$(".privacy").html(user.privacy_policy);
		


  	jQuery("#data-table_processing").hide();
 
  })
    });
  


</script>




