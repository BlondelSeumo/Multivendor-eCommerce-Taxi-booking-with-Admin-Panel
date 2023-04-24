@extends('layouts.app')

@section('content')
	<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.item_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">{{trans('lang.dashboard')}}</a></li> 
                <li class="breadcrumb-item"><a href= "{!! route('items') !!}" >{{trans('lang.item_plural')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.item_details')}}</li>
            </ol>
        </div>
  </div>

  <div>

    <div class="card-body">
          <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
        <div class="error_top" style="display:none"></div>
       <div class="row vendor_payout_create">
          <div class="vendor_payout_create-inner">

            <fieldset>
              <legend>{{trans('lang.item_information')}}</legend>

              <div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.item_name')}}</label>
                <div class="col-7">
                    <span class="item_name" id="item_name"></span>
                </div>
              </div>

              <div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.item_price')}}</label>
                <div class="col-7">
                    <span class="item_price" id="item_price"></span>
                </div>
              </div>

              <div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.item_discount')}}</label>
                <div class="col-7">
                    <span class="item_discount" id="item_discount"></span>
                </div>
              </div>

              <div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.item_vendor_id')}}</label>
                <div class="col-7">
                    <span class="item_vendor" id="item_vendor"></span>
                </div>
              </div>

              <div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.item_category_id')}}</label>
                <div class="col-7">
                    <span class="item_category" id="item_category"></span>

                </div>
              </div>
                <div class="form-group row width-50">
                    <label class="col-3 control-label">{{trans('lang.brand')}}</label>
                    <div class="col-7">
                        <span class="brand" id="brand"></span>
                    </div>
                </div>
                <div class="form-group row width-50">
                    <label class="col-3 control-label">{{trans('lang.section')}}</label>
                    <div class="col-7">
                        <span class="section" id="section"></span>
                    </div>
                </div>
              
 {{--             <div class="form-group row width-100">
              	<div class="item_attributes" id="item_attributes"></div>
                <div class="item_variants" id="item_variants"></div>
                <input type="hidden" id="attributes" value="" />
                <input type="hidden" id="variants" value="" />
              </div>	--}}

              <div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.item_image')}}</label>
                <div class="col-7 product_image">
                </div>
              </div>
      
              <div class="form-group row width-100">
                  <label class="col-3 control-label">{{trans('lang.item_description')}}</label>
                  <div class="col-7">
                      <span class="item_description" id="item_description"></span>
                  </div>
              </div>
            {{-- <div class="form-check width-100">
                    <input type="checkbox" class="item_publish" id="item_publish">
                <label class="col-3 control-label" for="item_publish">{{trans('lang.item_publish')}}</label>
              </div>

              <div class="form-check width-100 section_hide" style="display: none;">
                <input type="checkbox" class="item_nonveg" id="item_nonveg">
                <label class="col-3 control-label" for="item_nonveg">{{ trans('lang.non_veg')}}</label>
              </div>

              <div class="form-check width-100 section_hide" style="display: none;">
                <input type="checkbox" class="item_take_away_option" id="item_take_away_option">
                <label class="col-3 control-label" for="item_take_away_option">{{trans('lang.item_take_away')}}</label>
              </div>    --}}

            </fieldset>

            <fieldset class="section_hide" >

              <legend>{{trans('lang.ingredients')}}</legend>

                <div class="form-group row width-50">
                  <label class="col-3 control-label">{{trans('lang.calories')}}</label>
                  <div class="col-7">
                      <span class="item_calories" id="item_calories"></span>
                  </div>
                </div>

                <div class="form-group row width-50">
                  <label class="col-3 control-label">{{trans('lang.grams')}}</label>
                  <div class="col-7">
                      <span class="item_grams" id="item_grams"></span>
                  </div>
                </div>

                <div class="form-group row width-50">
                  <label class="col-3 control-label">{{trans('lang.fats')}}</label>
                  <div class="col-7">
                      <span class="item_fats" id="item_fats"></span>
                  </div>
                </div>

                <div class="form-group row width-50">
                  <label class="col-3 control-label">{{trans('lang.proteins')}}</label>
                  <div class="col-7">
                      <span class="item_proteins" id="item_proteins"></span>
                  </div>
                </div>

            </fieldset>



                  </div>
                  </div>
      <div class="form-group col-12 text-center btm-btn">

         <a href="{!! route('items') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
      </div>
    </div>
  </div>
</div>


 @endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
 

<script>
var id = "<?php echo $id;?>";
var database = firebase.firestore();
var ref = database.collection('vendor_products').where("id","==",id);
var ref_sections = database.collection('sections');

var categories_list = [];
var brand_list=[];

var attributes_list = [];
var vendor_list=[];
var photo ="";
var addOnesTitle = [];
var addOnesPrice = [];
var sizeTitle = [];
var sizePrice = [];
var product_specification = [];
var photos = [];
var productImagesCount = 0;

var vendors=[];
var sections_list=[];
var placeholderImage = '';
var placeholder = database.collection('settings').doc('placeHolderImage');

placeholder.get().then( async function(snapshotsimage){
    var placeholderImageData = snapshotsimage.data();
    placeholderImage = placeholderImageData.image;
})

$(document).ready(function(){
  
  jQuery(document).on("click",".mdi-cloud-upload",function(){
  		var variant = jQuery(this).data('variant');
  		jQuery("#file_"+variant).click();
  	});
  	
  	jQuery(document).on("click",".mdi-delete",function(){
  		var variant = jQuery(this).data('variant');
  		var fileurl = jQuery("#variant_"+variant+"_url").val();
  		if(fileurl){
  			firebase.storage().refFromURL(fileurl).delete();
  			jQuery("#variant_"+variant+"_image").empty();
  			jQuery("#variant_"+variant+"_url").val('');
  		}
  	});	
  	


  jQuery("#data-table_processing").show();
  ref.get().then( async function(snapshots){
    var product = snapshots.docs[0].data();
if(getCookie('section_id') != ""){
  var vendorsDb = database.collection('vendor_categories').where('section_id','==',getCookie('section_id'));
    var brand = database.collection('brands').where('sectionId','==',getCookie('section_id'));

}else{
  var vendorsDb = database.collection('vendor_categories');
    var brand = database.collection('brands');
}
     await ref_sections.get().then(async function (snapshots) {
          snapshots.docs.forEach((listval) => {
              var data = listval.data();
             // console.log(data);
              sections_list.push(data);
              if(data.id == product.section_id){
                  $('#section').text(data.name);
              }
          })
      });
 await database.collection('vendors').get().then( async function(snapshots){
   snapshots.docs.forEach((listval) => {
              var data = listval.data();
              vendor_list.push(data);
              vendors.push(data);
                if(data.id == product.vendorID){
                    $('#item_vendor').text(data.title);
                }
        })
       // checkVendorSection();
        

}); 

await vendorsDb.get().then( async function(snapshots){
  
   snapshots.docs.forEach((listval) => {
              var data = listval.data();
                categories_list.push(data);
                if(data.id == product.categoryID){
                    $('#item_category').text(data.title);
                }
      })

   //change_categories(product.vendorID);


});
      await brand.get().then( async function(snapshots){

          snapshots.docs.forEach((listval) => {
              var data = listval.data();
              brand_list.push(data);
              if(data.id == product.brandID){
                  $('#brand').text(data.title);
              }
          })
      });

  $(".item_name").text(product.name);
  $(".item_price").text(product.price);
  $(".item_discount").text(product.disPrice);
  if(product.hasOwnProperty("calories")){
    $(".item_calories").text(product.calories)
  }
  if(product.hasOwnProperty("grams")){
    $(".item_grams").text(product.grams);
  }
  if(product.hasOwnProperty("proteins")){
    $(".item_proteins").text(product.proteins)
  }
  if(product.hasOwnProperty("fats")){
    $(".item_fats").text(product.fats);
  }

  // $(".item_quantity").val(parseFloat(product.quantity));
  $("#item_description").text(product.description);
 //  if(product.publish){
 //    $(".item_publish").prop('checked',true);
 //  }
 //
 //  if(product.nonveg){
 //
 //  $(".item_nonveg").prop('checked',true);
 // }
 // if(product.takeawayOption){
 //  $(".item_take_away_option").prop('checked',true);
 // }


if(product.hasOwnProperty('photo')){

photos = product.photo;
  if (photos!='' && photos!=null) {
      image='<img width="200px" id="" height="auto" src="' + photos + '">'

  }else{

    image='<img class="rounded" width="200px" id="" height="auto" src="'+placeholderImage+'" alt="image">';
  }
}
$('.product_image').html(image);
  jQuery("#data-table_processing").hide();

  })
})



function selectAttribute(item_attribute=''){
	
	if(item_attribute){
		var item_attribute = $.parseJSON(atob(item_attribute));
	}
	
	var html = '';
	$("#item_attribute").find('option:selected').each(function(){
		var $this = $(this);
		var selected_options = [];
	  	if(item_attribute){
	  		$.each(item_attribute.attributes, function( index, attribute ) {
	  			if($this.val() == attribute.attribute_id){
	  	 	  		selected_options.push(attribute.attribute_options);
	  	 		}
	  		});
	  	}
	  	html += '<div class="row" id="attr_'+$this.val()+'">';
			html += '<div class="col-md-3">';
				html += '<label>'+$this.text()+'</label>';
			html += '</div>';
			html += '<div class="col-lg-9">';
				html += '<input type="text" class="form-control" id="attribute_options_'+$this.val()+'" value="'+selected_options+'" placeholder="Add attribute values" data-role="tagsinput" onchange="variants_update(\''+btoa(JSON.stringify(item_attribute))+'\')">';
			html += '</div>';
		html += '</div>';	
	});
	$("#item_attributes").html(html);	
	$("#item_attributes input[data-role=tagsinput]").tagsinput();
	
	if($("#item_attribute").val().length == 0){
		$("#attributes").val('');
		$("#variants").val('');
		$("#item_variants").html('');
	}
}



</script>
@endsection