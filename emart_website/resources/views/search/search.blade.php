@include('layouts.app')

@include('layouts.header')


<div class="d-none">

    <div class="bg-primary p-3 d-flex align-items-center">

        <a class="toggle togglew toggle-2" href="#"><span></span></a>

        <h4 class="font-weight-bold m-0 text-white">{{trans('lang.search')}}</h4>

    </div>

</div>

<div class="siddhi-popular">


    <div class="container">

        <div class="search py-5">

            <div class="input-group mb-4">


                <input type="text" class="form-control form-control-lg input_search border-right-0 food_search"
                       id="inlineFormInputGroup" value="" placeholder="{{trans('lang.search_product_items')}}">

                <div class="input-group-prepend">

                    <div class="btn input-group-text bg-white border_search border-left-0 text-primary search_food_btn">
                        <i class="feather-search"></i>

                    </div>

                </div>


            </div>


            <ul class="nav nav-tabs border-0" id="myTab" role="tablist">

                <li class="nav-item" role="presentation">

                    <a class="nav-link active border-0 bg-light text-dark rounded" id="home-tab" data-toggle="tab"
                       href="#home" role="tab" aria-controls="home" aria-selected="true"><i
                                class="feather-home mr-2"></i><span class="vendor_counts"></span></a>

                </li>

                <!-- <li class="nav-item" role="presentation">

                <a class="nav-link border-0 bg-light text-dark rounded ml-3" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="feather-disc mr-2"></i>Dishes (23)</a>

                </li> -->

            </ul>


            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>


            <div class="text-center py-5 not_found_div" style="display:none">

                <p class="h4 mb-4"><i class="feather-search bg-primary rounded p-2"></i></p>

                <p class="font-weight-bold text-dark h5">{{trans('lang.nothing_found')}} </p>

                <p>{{trans('lang.please_try_again')}} </p>

            </div>


            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">


                    <div class="container mt-4 mb-4 p-0">

                        <div id="append_list1" class="res-search-list-1"></div>


                    </div>

                </div>

            </div>

            <ul class="nav nav-tabs border-0" id="myTab2" role="tablist">

                <li class="nav-item" role="presentation">

                    <a class="nav-link active border-0 bg-light text-dark rounded" id="home-tab" data-toggle="tab"
                       href="#home" role="tab" aria-controls="home" aria-selected="true"><i
                                class="feather-home mr-2"></i><span class="products_counts"></span></a>

                </li>

                <!-- <li class="nav-item" role="presentation">

                <a class="nav-link border-0 bg-light text-dark rounded ml-3" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="feather-disc mr-2"></i>Dishes (23)</a>

                </li> -->

            </ul>
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">


                    <div class="container mt-4 mb-4 p-0">

                          <div id="append_list2" class="res-search-list-1">

                        </div>



                    </div>

                </div>

            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


                <div class="row d-flex align-items-center justify-content-center py-5">

                    <div class="col-md-4 py-5">


                    </div>

                </div>


            </div>


        </div>


    </div>

</div>


@include('layouts.footer')


@include('layouts.nav')


<script type="text/javascript">
    var currentCurrency = '';
    var currencyAtRight = false;
    var placeholderImage = '';
    var placeholder = database.collection('settings').doc('placeHolderImage');
    placeholder.get().then(async function (snapshotsimage) {
        var placeholderImageData = snapshotsimage.data();
        placeholderImage = placeholderImageData.image;
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
    var productsref = database.collection('vendor_products').where('section_id','==',section_id);
    var vendorsref = database.collection('vendors').where('section_id','==',section_id);

    var append_list = document.getElementById('append_list1');
    var append_list2=document.getElementById('append_list2');

    var productdata=[];
    var vendordata=[];
    productsref.get().then(async function(productsnapshot){
        productsnapshot.docs.forEach((listval) => {
            var val=listval.data();
            productdata.push(val);
        });

    });
    vendorsref.get().then(async function(vendorsnapshot){
        vendorsnapshot.docs.forEach((listval) => {
            var val=listval.data();
            vendordata.push(val);
        });

    });
    $(document).ready(function () {

		getResults();

        $(".food_search").keypress(function (e) {
            if (e.which == 13) {
                getResults();
            }
        })

        $(".search_food_btn").click(function () {
			getResults();
        });

    });

	async function getResults(){

		var vendors = [];

		$("#data-table_processing").show();

		var foodsearch = $(".food_search").val();

    var filter_product=[];
    var products = [];
		if(foodsearch != ''){
      productdata.forEach((listval) => {
        var data=listval;
        var Name=data.name.toLowerCase();
        var Ans=Name.indexOf(foodsearch.toLowerCase());
        if(Ans>-1){
          filter_product.push(data);
          products.push(data.vendorID);
        }
        //var Ans=Name.filter(item => item.toLowerCase().indexOf(foodsearch) > -1);
      });

			// await productsref.orderBy('name').startAt(foodsearch).endAt(foodsearch + '\uf8ff').get().then(async function (snapshots) {
      //   console.log(snapshots.docs.length);
			// 	 if(snapshots.docs.length > 0){
			//         snapshots.docs.forEach((listval) => {
			//         	var datas = listval.data();
      //           console.log(datas);
			//         	products.push(datas.vendorID);
      //           //products_data.push(datas);
			//         });
			// 	}
			// });

			if(products.length > 0){
				for(i=0;i<products.length;i++){
					var vendorId = products[i];
					await database.collection('vendors').doc(vendorId).get().then(async function (snapshotss) {
			        	 var vendor_data = snapshotss.data();

			        	 vendors.push(vendor_data);
			        });
		        }
	        }

			// await vendorsref.orderBy('title').startAt(foodsearch).endAt(foodsearch + '\uf8ff').get().then(async function (snapshotsKeypress) {
	    // 		if (snapshotsKeypress.docs.length > 0) {
      //
	    // 			snapshotsKeypress.docs.forEach((listval) => {
			//             var datas = listval.data();
      //
			//             vendors.push(datas);
			//         });
			//     }
      //   });
      vendordata.forEach((listval) => {
        var data=listval;
        var Name=data.title.toLowerCase();
        var Ans=Name.indexOf(foodsearch.toLowerCase());
        if(Ans>-1){
          vendors.push(data);

        }
      });

       	}else{

       		await vendorsref.get().then(async function (snapshots) {
            	if (snapshots != undefined) {
                	snapshots.docs.forEach((listval) => {
		            	var datas = listval.data();
		            	vendors.push(datas);
		        	});
            	}
			});
        $('#myTab2').hide();
       	}

        var html_keypress = '';
        html_keypress = buildHTML(vendors);

        product_keypress=buildProductHTML(filter_product);

        if (html_keypress == '' && product_keypress=='' ){
          $(".not_found_div").show();
          append_list.innerHTML = '';
          append_list2.innerHTML='';
          $(".vendor_counts").text('Stores (0)');
          $(".products_counts").text('Products (0)');
            $("#data-table_processing").hide();
        }
        else if (html_keypress != '' || product_keypress!='' ) {

            $(".not_found_div").hide();
            append_list.innerHTML = '';
            append_list.innerHTML = html_keypress;
            append_list2.innerHTML='';
            append_list2.innerHTML=product_keypress;
           $("#data-table_processing").hide();
        }

        else {
        }
	}

     function buildHTML(alldata) {

        var html = '';

        var count = 0;

        $(".vendor_counts").text('Stores (' + alldata.length + ')');

        alldata.forEach((listval) => {

            count++;

            var val = listval;
            if (val.vendorID != '') {

                if (count == 1) {
                    html = html + '<div class="row">';
                }

                productStoreImage = val.photo;

                productStoreTitle = val.title;

                var view_vendor_details = "{{ route('vendor',':id')}}";

                view_vendor_details = view_vendor_details.replace(':id', 'id=' + val.id);

                var rating = 0;
                var reviewsCount = 0;
                var status = 'Closed';
                var statusclass = "closed";
                if (val.hasOwnProperty('reststatus') && val.reststatus) {
                    status = 'Open';
                    statusclass = "open";
                }

                if (val.hasOwnProperty('reviewsSum') && val.reviewsSum != 0 && val.hasOwnProperty('reviewsCount') && val.reviewsCount != 0) {
                    rating = (val.reviewsSum / val.reviewsCount);
                    reviewsCount = val.reviewsCount;
                    rating = Math.round(rating * 10) / 10;
                    rating = parseInt(rating);
                }

                if (productStoreImage == '') {
                    productStoreImage = placeholderImage
                }

                var ratinghtml = '<ul class="rating-stars list-unstyled"><li>';

                if (rating >= 1) {
                    ratinghtml = ratinghtml + '<i class="feather-star star_active"></i>';
                } else {
                    ratinghtml = ratinghtml + '<i class="feather-star"></i>';
                }
                if (rating >= 2) {
                    ratinghtml = ratinghtml + '<i class="feather-star star_active"></i>';
                } else {
                    ratinghtml = ratinghtml + '<i class="feather-star"></i>';
                }

                if (rating >= 3) {
                    ratinghtml = ratinghtml + '<i class="feather-star star_active"></i>';
                } else {
                    ratinghtml = ratinghtml + '<i class="feather-star"></i>';
                }
                if (rating >= 4) {
                    ratinghtml = ratinghtml + '<i class="feather-star star_active"></i>';
                } else {
                    ratinghtml = ratinghtml + '<i class="feather-star"></i>';
                }
                if (rating == 5) {
                    ratinghtml = ratinghtml + '<i class="feather-star star_active"></i>';
                } else {
                    ratinghtml = ratinghtml + '<i class="feather-star"></i>';
                }
                ratinghtml = ratinghtml + '</li></ul>';

				html = html + '<div class="col-md-3 pb-3"><div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm"><div class="list-card-image">';

                html = html + '<div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i>' + rating + ' (' + reviewsCount + '+)</span></div>';

                html = html + '<div class=""><a href="' + view_vendor_details + '"><img alt="#" src="' + productStoreImage + '" class="img-fluid item-img w-100"></a></div>';

                html = html + '</div>';

                html = html + '<div class="p-3 position-relative">';

                html = html + '<div class="list-card-body" ><h6 class="mb-1"><a href="' + view_vendor_details + '" class="text-black">' + productStoreTitle + '</a></h6><p class="text-gray mb-3"><span class="fa fa-map-marker"></span> ' + val.location + '</p>'+ratinghtml+'</div>';

                html = html + '</div></div></div>';

                if (count == 4) {

                    html = html + '</div>';

                    count = 0;

                }

            }

        });

        return html;

    }

    function buildProductHTML(allProductdata) {

       var html = '';

       var count = 0;
       $(".products_counts").text('products (' + allProductdata.length + ')');
       if(allProductdata!=undefined && allProductdata!=''){
         $('#myTab2').show();


       allProductdata.forEach((listval) => {
          count++;
           var val = listval;
           if (count == 1) {
               html = html + '<div class="row">';
           }
           var product_id_single = val.id;
           var view_product_details = "{{ route('productdetail',':id')}}";
           view_product_details = view_product_details.replace(':id',product_id_single);
           var rating = 0;
           var reviewsCount = 0;
           if (val.hasOwnProperty('reviewsSum') && val.reviewsSum != 0 && val.hasOwnProperty('reviewsCount') && val.reviewsCount != 0) {
               rating = (val.reviewsSum / val.reviewsCount);
               rating = Math.round(rating * 10) / 10;
               reviewsCount = val.reviewsCount;
           }

           html = html + '<div class="col-md-3 product-list"><div class="list-card position-relative"><div class="list-card-image">';

             if (val.photo) {
                 photo = val.photo;
             } else {
                 photo = placeholderImage;
             }
             html = html + '<a href="' + view_product_details + '"><img alt="#" src="' + photo + '" class="img-fluid item-img w-100"></a></div><div class="py-2 position-relative"><div class="list-card-body position-relative"><h6 class="mb-1"><a href="' + view_product_details + '" class="arv-title">' + val.name + '</a></h6>';



           if (val.hasOwnProperty('disPrice') && val.disPrice != '' && val.disPrice != '0') {
               var dis_price = '';
               var or_price = '';
               if (currencyAtRight) {
                   or_price = val.price + "" + currentCurrency;
                   dis_price = val.disPrice + "" + currentCurrency;
               } else {
                   or_price = currentCurrency + "" + val.price;
                   dis_price = currentCurrency + "" + val.disPrice;
               }
               html = html + '<span class="text-gray mb-0 pro-price ">'+ dis_price + '  <s>' + or_price +'</s></span>';

           } else {
               var or_price = '';
               if (currencyAtRight) {
                   or_price = val.price + "" + currentCurrency;
               } else {
                   or_price = currentCurrency + "" + val.price;
               }
               html = html + '<span class="text-gray mb-0 pro-price ">'+ or_price +'</span>';

           }


           html = html + '<div class="star position-relative"><span class="badge badge-success "><i class="feather-star"></i>'+ rating + ' (' + reviewsCount +')</span></div>';
           html = html + '</div>';
           html = html + '</div></div></div>';
           if (count == 4) {

               html = html + '</div>';

               count = 0;

           }
       });
       html = html + '</div>';

     }
     return html;
   }


</script>
