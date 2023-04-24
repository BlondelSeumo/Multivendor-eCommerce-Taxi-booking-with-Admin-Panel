@include('layouts.app')

@include('layouts.header')

<div class="st-brands-page pt-5 category-listing-page category">

	<div class="container">
	
		<div class="d-flex align-items-center mb-3 page-title">
	
	    	<h3 class="font-weight-bold text-dark" id="title"></h3>
	
		</div>
		
		<div class="row">
		
			<div class="col-md-3">
				<div id="brand-list"></div>
				<div id="category-list"></div>
			</div>
			
			<div class="col-md-9">
				<div id="store-list"></div>
			</div>
			
		</div>
		
	</div>
	
</div>

<div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">
    {{trans('lang.processing')}}
</div>

@include('layouts.footer')


<script type="text/javascript">

	var id = '<?php echo $id; ?>';

	var idRef= database.collection('vendor_categories').doc(id);
	var catsRef= database.collection('vendor_categories').where('section_id', '==', section_id).where("publish","==",true);
   
    var placeholderImageRef = database.collection('settings').doc('placeHolderImage');
    var placeholderImageSrc = '';
    placeholderImageRef.get().then( async function(placeholderImageSnapshots){
        var placeHolderImageData = placeholderImageSnapshots.data();
        placeholderImageSrc = placeHolderImageData.image;
    })
    
    idRef.get().then( async function(idRefSnapshots){
        var idRefData = idRefSnapshots.data();
        $("#title").text(idRefData.title+' '+"{{trans('lang.stores')}}");
    })
    
    var decimal_degits = 0;
    var refCurrency = database.collection('currencies').where('isActive', '==', true);
    refCurrency.get().then(async function (snapshots) {
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;
        if (currencyData.decimal_degits) {
            decimal_degits = currencyData.decimal_degits;
        }
    });
    
    jQuery("#data-table_processing").show();	
    
    $(document).ready(function() {
    	getCategories();
    	$(document).on("click",".category-item",function(){
        	if(!$(this).hasClass('active')){
        		$(this).addClass('active').siblings().removeClass('active');
        		getStores($(this).data('category-id'));
        	}
        });
    });
    
    async function getCategories(){
    	
    	catsRef.get().then( async function(snapshots){

            if(snapshots!=undefined){
               var html='';
                html=buildCategoryHTML(snapshots);
                if(html!=''){
                    var append_list = document.getElementById('category-list');
                    append_list.innerHTML=html;
                    
                    var category_id = $('#category-list .category-item').first().addClass('active').data('category-id');
		            if(category_id){
		            	getStores(category_id);
		            	jQuery("#data-table_processing").hide();
		            }
                }
            }
        });
    }
    
    function buildCategoryHTML(snapshots){
    	var html='';
        var alldata=[];
        snapshots.docs.forEach((listval) => {
            var datas=listval.data();
            datas.id=listval.id;
            alldata.push(datas);
        });
        
        html = html+ '<div class="vandor-sidebar">';
        html = html+ '<h3>{{trans("lang.categories")}}</h3>';
    
        html = html+ '<ul class="vandorcat-list">';
        alldata.forEach((listval) => {
            var val=listval;
            if (val.photo) {
                photo = val.photo;
            } else {
                photo = placeholderImageSrc;
            }
            html = html+ '<li class="category-item" data-category-id="'+val.id+'">';
            html = html +'<a href="javascript:void(0)"><span><img src="'+photo+'"></span>'+val.title+'</a>';
            html = html +'</li>';
		});
		html = html +'</ul>';
		
		return html;
     }
     
     async function getStores(id){
    	
    	jQuery("#data-table_processing").show();		
    	var store_list = document.getElementById('store-list');
        store_list.innerHTML = '';
        var html = '';
        
        var storesRef = database.collection('vendors').where('categoryID','==',id).where("reststatus","==",true);
        var idRef = database.collection('vendor_categories').doc(id);
        
        idRef.get().then( async function(idRefSnapshots){
	        var idRefData = idRefSnapshots.data();
	        $("#title").text(idRefData.title+' '+"{{trans('lang.stores')}}");
	    })
        
        storesRef.get().then( async function(snapshots){
    		html = buildStoresHTML(snapshots);
    		if (html != '') {
    			store_list.innerHTML = html;
    			jQuery("#data-table_processing").hide();
    		}	
    	});	
    }
    
    function buildStoresHTML(snapshots){
        var html='';
        var alldata=[];
        snapshots.docs.forEach((listval) => {
            var datas=listval.data();
            datas.id=listval.id;
            alldata.push(datas);
        });
        
        var count = 0;
        var popularFoodCount = 0;
        html = html+ '<div class="row">';
        
        if(alldata.length){
        	
	        alldata.forEach((listval) => {
	            var val=listval;
	            
	            var rating = 0;
	            var reviewsCount = 0;
	            if (val.hasOwnProperty('reviewsSum') && val.reviewsSum != 0 && val.hasOwnProperty('reviewsCount') && val.reviewsCount != 0) {
	                rating = (val.reviewsSum / val.reviewsCount);
	                rating = Math.round(rating * 10) / 10;
	                reviewsCount = val.reviewsCount;
	            }
	
	            html = html+ '<div class="col-md-4 pb-3 product-list"><div class="list-card position-relative"><div class="list-card-image">';
	
	            if(val.photo){
	                photo=val.photo;
	            }else{
	                photo=placeholderImageSrc;
	            }
	            
	            var view_vendor_details = "{{ route('vendor',':id')}}";
                view_vendor_details = view_vendor_details.replace(':id', 'id=' + val.id);
	
	            html = html +'<a href="'+view_vendor_details+'"><img alt="#" src="'+photo+'" class="img-fluid item-img w-100"></a></div><div class="py-2 position-relative"><div class="list-card-body"><h6 class="mb-1"><a href="'+view_vendor_details+'" class="text-black">'+val.title+'</a></h6><h6>'+val.location+'</h6>';
	            
	            html = html + '<div class="star position-relative mt-3"><span class="badge badge-success"><i class="feather-star"></i>' + rating + ' (' + reviewsCount + ')</span></div>';
	
	            html = html +'</div>';
	            html = html +'</div></div></div>';
	
			});
			
		}else{
			html = html +"<h5>{{trans('lang.no_results')}}</h5>";
		}
		
        html = html + '</div>';
        return html;
    }

</script>

@include('layouts.nav')