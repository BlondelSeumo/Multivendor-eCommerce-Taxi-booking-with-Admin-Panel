@include('layouts.app')

@include('layouts.header')

<div class="st-brands-page pt-5 category-listing-page <?php //echo $type; ?>">

	<div class="container">


		<div class="row">

			<div class="col-md-12">
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

    var placeholderImageRef = database.collection('settings').doc('placeHolderImage');
    var placeholderImageSrc = '';
    placeholderImageRef.get().then( async function(placeholderImageSnapshots){
        var placeHolderImageData = placeholderImageSnapshots.data();
        placeholderImageSrc = placeHolderImageData.image;
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
		var productsRef = database.collection('vendor_products').where('section_id', '==', section_id).where("publish","==",true);

    	jQuery("#data-table_processing").show();
    	var product_list = document.getElementById('product-list');
        product_list.innerHTML = '';
        var html = '';
        productsRef.get().then( async function(snapshots){
    		html = buildProductsHTML(snapshots);
    		if (html != '') {
    			product_list.innerHTML = html;
    			jQuery("#data-table_processing").hide();
    		}
    	});

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
