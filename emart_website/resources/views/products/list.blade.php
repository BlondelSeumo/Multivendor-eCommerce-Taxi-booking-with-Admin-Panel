@include('layouts.app')

@include('layouts.header')

<div class="st-brands-page pt-5 category-listing-page <?php echo $type; ?>">

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
				<div id="product-list"></div>
			</div>
			
		</div>
		
	</div>
	
</div>

<div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">
    {{trans('lang.processing')}}
</div>

@include('layouts.footer')


<script type="text/javascript">

	var type = '<?php echo $type; ?>';
	var id = '<?php echo $id; ?>';

	if(type == "category"){
	    var idRef= database.collection('vendor_categories').doc(id);
	    var catsRef= database.collection('vendor_categories').where('section_id', '==', section_id).where("publish","==",true);
   }else{
   		var idRef= database.collection('brands').doc(id);
   		var brandRef= database.collection('brands').where('sectionId', '==', section_id).where("is_publish","==",true);
   }
   
    var placeholderImageRef = database.collection('settings').doc('placeHolderImage');
    var placeholderImageSrc = '';
    placeholderImageRef.get().then( async function(placeholderImageSnapshots){
        var placeHolderImageData = placeholderImageSnapshots.data();
        placeholderImageSrc = placeHolderImageData.image;
    })
    
    idRef.get().then( async function(idRefSnapshots){
        var idRefData = idRefSnapshots.data();
        $("#title").text(idRefData.title+' '+"{{trans('lang.products')}}");
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
    	if(type == "category"){
    		getCategories();
    	}else{
    		getBrands(id);
    	}
    	$(document).on("click",".category-item",function(){
        	if(!$(this).hasClass('active')){
        		$(this).addClass('active').siblings().removeClass('active');
        		getProducts(type,$(this).data('category-id'));
        	}
        });
        $(document).on("click",".brand-item",function(){
        	if(!$(this).hasClass('active')){
        		$(this).addClass('active').siblings().removeClass('active');
        		getProducts(type,$(this).data('brand-id'));
        	}
        });
    })
    
    async function getCategories(){
    	
    	catsRef.get().then( async function(snapshots){

            if(snapshots!=undefined){
               var html='';
                html=buildCategoryHTML(snapshots);
                if(html!=''){
                    var append_list = document.getElementById('category-list');
                    append_list.innerHTML=html;
                    
                   // var category_id = $('#category-list .category-item').first().addClass('active').data('category-id');
					var category_id = $('#category-list .active').data('category-id');
		            if(category_id){
		            	getProducts(type,category_id);
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
            if(id==val.id){
				html = html+ '<li class="category-item active" data-category-id="'+val.id+'">';
			}else{
				html = html+ '<li class="category-item" data-category-id="'+val.id+'">';
			}

            html = html +'<a href="javascript:void(0)"><span><img src="'+photo+'"></span>'+val.title+'</a>';
            html = html +'</li>';
		});
		html = html +'</ul>';
		
		return html;
     }
    
     async function getBrands(id){
     	
     	brandRef.get().then( async function(snapshots){
            if(snapshots!=undefined){
                var html='';
                html=buildBrandsHTML(snapshots);
                jQuery("#data-table_processing").hide();

                if(html!=''){
                    var append_list = document.getElementById('brand-list');
					
                    append_list.innerHTML=html;
					brandId = $('#brand-list .brand-item').data('brand-id');
					console.log(brandId);
                    //var brand_id = $('#brand-list .brand-item').first().addClass('active').data('brand-id');
					var brand_id = $('#brand-list .active').data('brand-id');
		            if(brand_id){
		            	getProducts(type,brand_id);
		            	jQuery("#data-table_processing").hide();
		            }
                }
            }
        });
     }
     
     function buildBrandsHTML(snapshots){
        var html='';
        var alldata=[];
        snapshots.docs.forEach((listval) => {
            var datas=listval.data();
            datas.id=listval.id;
            alldata.push(datas);
        });
        
        html = html+ '<div class="vandor-sidebar">';
          html = html+ '<h3>{{trans("lang.brands")}}</h3>';
            html = html+ '<ul class="vandorcat-list">';
	        alldata.forEach((listval) => {
	            var val=listval;
	            if (val.photo) {
	                photo = val.photo;
	            } else {
	                photo = placeholderImageSrc;
	            }
				if(id==val.id){
					html = html+ '<li class="brand-item active" data-brand-id="'+val.id+'">';
				}else{
					html = html+ '<li class="brand-item" data-brand-id="'+val.id+'">';
				}
	            html = html+ '<li class="brand-item" data-brand-id="'+val.id+'">';
	            html = html +'<a href="javascript:void(0)"><span><img src="'+photo+'"></span>'+val.title+'</a>';
	            html = html +'</li>';
			});
			html = html +'</ul>';
   	    html = html + '</div>';
   	    
        return html;
     }
     
     async function getProducts(type,id){
    	
    	jQuery("#data-table_processing").show();		
    	var product_list = document.getElementById('product-list');
        product_list.innerHTML = '';
        var html = '';
        
        if(type == "category"){
        	var productsRef = database.collection('vendor_products').where('categoryID','==',id).where("publish","==",true);
        	var idRef = database.collection('vendor_categories').doc(id);
        }else{
        	var productsRef = database.collection('vendor_products').where('brandID','==',id).where("publish","==",true);
        	var idRef = database.collection('brands').doc(id);
        }
        
        idRef.get().then( async function(idRefSnapshots){
	        var idRefData = idRefSnapshots.data();
	        $("#title").text(idRefData.title+' '+"{{trans('lang.products')}}");
	    })
        
        productsRef.get().then( async function(snapshots){
    		html = buildProductsHTML(snapshots);
    		if (html != '') {
    			product_list.innerHTML = html;
    			jQuery("#data-table_processing").hide();
    		}	
    	});	
    }
    
    function buildProductsHTML(snapshots){
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
	            console.log(val);
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
	            
	            var view_product_details = "{{ route('productdetail',':id')}}";
	            view_product_details = view_product_details.replace(':id',val.id);
	
	            html = html +'<a href="'+view_product_details+'"><img alt="#" src="'+photo+'" class="img-fluid item-img w-100"></a></div><div class="py-2 position-relative"><div class="list-card-body"><h6 class="mb-1"><a href="'+view_product_details+'" class="text-black">'+val.name+'</a></h6>';
	            
	            val.price = parseFloat(val.price);
	            if (val.hasOwnProperty('disPrice') && val.disPrice != '' && val.disPrice != '0') {
	            	val.disPrice = parseFloat(val.disPrice);
	                var dis_price = '';
	                var or_price = '';
	                if (currencyAtRight) {
	                    or_price = val.price.toFixed(decimal_degits) + "" + currentCurrency;
	                    dis_price = val.disPrice.toFixed(decimal_degits) + "" + currentCurrency;
	                } else {
	                    or_price = currentCurrency + "" + val.price.toFixed(decimal_degits);
	                    dis_price = currentCurrency + "" + val.disPrice.toFixed(decimal_degits);
	                }
	
	                html = html + '<span class="pro-price">' + dis_price + '  <s>' + or_price + '</s></span>';
	            } else {
	                var or_price = '';
	                if (currencyAtRight) {
	                    or_price = val.price.toFixed(decimal_degits) + "" + currentCurrency;
	                } else {
	                    or_price = currentCurrency + "" + val.price.toFixed(decimal_degits);
	                }
	
	                html = html + '<span class="pro-price">' + or_price + '</span>'
	            }
	            
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