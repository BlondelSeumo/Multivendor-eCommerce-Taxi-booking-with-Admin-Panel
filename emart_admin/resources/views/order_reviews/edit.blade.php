@extends('layouts.app')

@section('content')
<div class="page-wrapper">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">{{trans('lang.order_review')}}</h3>
		</div>

		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
        <?php if(isset($_GET['eid']) && $_GET['eid'] != ''){?>
          <li class="breadcrumb-item"><a href= "{{route('vendors.reviews',$_GET['eid'])}}" >{{trans('lang.order_review')}}</a></li>
        <?php }else{ ?>
          <li class="breadcrumb-item"><a href= "{!! route('orderReview') !!}" >{{trans('lang.order_review')}}</a></li>
        <?php } ?>
				
				<li class="breadcrumb-item active">{{trans('lang.item_review_edit')}}</li>
			</ol>
		</div>
		

	</div>

<div>

      <div class="card-body">
        
        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>

        <div class="row vendor_payout_create">
      
          <div class="vendor_payout_create-inner">

          <!-- <div class="col-md-6"> -->
            <fieldset>
              <legend>{{trans('lang.item_review_edit')}}</legend>
            
              <div class="form-group row width-100">
                <label class="col-3 control-label">{{ trans('lang.item_review_user_id')}}</label>
                <div class="col-7">
                  <select id="reviewer_id" class="form-control" disabled>
                    <option value="">{{ trans('lang.select_user') }}</option>
                  </select>                  
                </div>
              </div>

              <div class="form-group row width-100">
                <label class="col-4 control-label">{{trans('lang.vendor')}}</label>
                <div class="col-7"> 
                    <select id="vendor_id" class="form-control" disabled>
                      <option value="">{{trans('lang.select_vendor')}}</option>
                    </select>
                  </div>
              </div>

              <div class="form-group row width-100">
                  <label class="col-3 control-label">{{ trans('lang.item_review_rate')}}</label>
                  <div class="col-7">
                    <input type="number" class="form-control user_review_rate" disabled max=5 min=0>
                  <!-- <div class="form-text text-muted">
                    {{ trans("lang.rating_out_of_five") }}
                  </div> -->
                  </div>
              </div>

              <div class="form-group row width-100">
                  <label class="col-3 control-label">{{ trans('lang.order_review')}}</label>
                  <div class="col-7">
                      <textarea type="text" rows="7" class="form-control form-control user_review"></textarea>
                  </div>
              </div>

          <!-- </div>
          
          <div class="col-md-6"> -->

            <div class="form-group row width-100">
                <label class="col-3 control-label">{{trans('lang.vendors_payout_amount')}}</label>
                <div class="col-7">
                  <input type="text" class=" col-7 form-control order_price" disabled>
              </div>  
            </div>

            <div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.product')}}</label>
                <div class="col-7" id="order_products_list">                  
              </div>  
            </div>

            <div class="form-group row width-50">
                <label class="col-3 control-label">{{trans('lang.quantity')}}</label>
                <div class="col-7" id="order_products_quantity">                  
                </div>  
            </div>
            
           <!--  <div class="form-group row width-100">

                <div class="col-6">
                  <div class="form-group row">
                    <label class="col-12 control-label">{{ trans('lang.product')}}</label>
                    <div id="order_products_list"></div>
                  </div>
              </div>
              <div class="col-6">
                <div class="form-group row">
                  <label class="col-12 control-label">{{ trans('lang.quantity')}}</label>
                  <div id="order_products_quantity"></div>
                </div>
              </div>
          
            </div> -->
          </fieldset>
        </div>
        <!-- </div> -->
      
      </div>

    </div>
    
      
      <div class="form-group col-12 text-center btm-btn">
        <button type="button" class="btn btn-primary save_user_review_btn" ><i class="fa fa-save"></i> {{ trans('lang.save')}}</button>
        <?php if(isset($_GET['eid']) && $_GET['eid'] != ''){?>            
          <a href="{{route('vendors.reviews',$_GET['eid'])}}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
        <?php }else{ ?>
          <a href="{!! route('orderReview') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
        <?php } ?>
        <!-- <a href="{!! route('orderReview') !!}" class="btn btn-default"><i class="fa fa-undo"></i>{{ trans('lang.cancel')}}</a> -->
      </div>

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
var ref = database.collection('items_review').where("Id","==",id);

$(document).ready(function(){
  jQuery("#data-table_processing").show();
  ref.get().then( async function(snapshots){
  var review = snapshots.docs[0].data();


     
     await database.collection('vendors').get().then( async function(snapshots){
      
       snapshots.docs.forEach((listval) => {
                  var data = listval.data();

                    if(data.id == review.VendorId){
                        $('#vendor_id').append($("<option selected></option>")
                        .attr("value", data.id)
                        .text(data.title));
                    }else{
                          $('#vendor_id').append($("<option></option>")
                        .attr("value", data.id)
                        .text(data.title));
                    }
     

              })

    }); 

     await database.collection('users').where("role","in",["customer","driver"]).get().then( async function(snapshots){
      
       snapshots.docs.forEach((listval) => {
                  var data = listval.data();
                  var userName = data.firstName+" "+data.lastName;
                    if(data.id == review.CustomerId){
                        $('#reviewer_id').append($("<option selected></option>")
                        .attr("value", data.id)
                        .text(userName));
                    }else{
                          $('#reviewer_id').append($("<option></option>")
                        .attr("value", data.id)
                        .text(userName));
                    }
     

              })

    }); 

      var price = 0;
    await database.collection('vendor_orders').where("id","==",review.orderid).get().then( async function(snapshots){
        console.log(snapshots);
      var order = snapshots.docs[0].data();
        order.products.forEach((product)=>{
        $("#order_products_list").append('<input type="text" class="form-control" value="'+product.name+'" disabled>');
        $("#order_products_quantity").append('<input type="number" class="form-control" value="'+product.quantity+'" disabled>');

        if(product.price && product.quantity != 0){
          var productTotal = parseInt(product.price)*parseInt(product.quantity);
          price = price + productTotal;
        }
      })
    })

  $(".order_price").val(price);
  $(".user_review_rate").val(review.rating);
  $(".user_review").val(review.comment);
  // $(".note-editable").html(review.review);
  jQuery("#data-table_processing").hide();

  })


  
  $(".save_user_review_btn").click(function(){
      //var photo ="https://assets.bonappetit.com/photos/5d03bea59ffc67bff3c6f86e/master/pass/HLY_Lentil_Burger_Horizontal.jpg";
      // var user_review = $(".note-editable").html();
      var user_review = $(".user_review").val();
      var rate = parseFloat($(".user_review_rate").val());
      var user_id = $("#reviewer_id option:selected").val();
      var vendor_id = $("#vendor_id option:selected").val();
         database.collection('items_review').doc(id).update({'comment':user_review,'rating':rate,'CustomerId':user_id,'VendorId':vendor_id}).then(function(result) {
                    // scroll(0,0); */
                <?php if( isset($_GET['eid']) && $_GET['eid'] !=''){ ?>

                     window.location.href = "{{ route('vendors.reviews',$_GET['eid']) }}";                    
                <?php  }else{ ?>

                     window.location.href = '{{ route("orderReview")}}';

                <?php } ?>
                  /* // window.location.href = '{{ route("orderReview")}}'; */
                 }); 
       
    })


})

</script>
@endsection
