@include('layouts.app')

<div class="home" id="home"></div>

<div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">
    {{trans('lang.processing')}}
</div>

<script type="text/javascript">
	var is_layer = 1;
</script>

@include('layouts.footer')

<script type="text/javascript">
		
		jQuery("#data-table_processing").show();	
		
		var placeholderImageRef = database.collection('settings').doc('placeHolderImage');
	    var placeholderImageSrc = '';
	    placeholderImageRef.get().then(async function (placeholderImageSnapshots) {
	        var placeHolderImageData = placeholderImageSnapshots.data();
	        placeholderImageSrc = placeHolderImageData.image;
	    })
		var globalSettingsRef = database.collection('settings').doc('globalSettings');
		
		var homepageTemplateRef = database.collection('settings').doc('homepageTemplate');
		
		homepageTemplateRef.get().then(async function (homepageTemplateSnapshots) {
	        var homepageTemplateData = homepageTemplateSnapshots.data();
			$('#home').html(homepageTemplateData.homepageTemplate);
		
			globalSettingsRef.get().then(async function (globalSettingsSnapshots) {
				var globalSettingsData = globalSettingsSnapshots.data();
				var src_new = globalSettingsData.appLogo;
				$('#logo_web').html('<img alt="#" class="logo_web img-fluid" src="'+src_new+'">');
				
				$('.location-group .locate-me').attr("onclick","getCurrentLocation()");
			})
			getSections();
			initialize();
	        jQuery("#data-table_processing").hide();
		});
		
		$(document).ready(function () {
			
			$(document).on("click", ".cat-slider .cat-item", function (e) {
	        	$(this).addClass('section-selected').siblings().removeClass('section-selected');
	        });
	        
			$(document).on("click", ".btn-continue", function (e) {
				var element = $('.cat-slider .cat-item.section-selected');
	            var section_id = element.attr('data-id');
	            
	            if($('#user_locationnew').val() == ''){
	            	alert('Please select your address');
	            	return false;
	            }
	            if(!section_id){
	            	alert('Please select your section');
	            	return false;
	            }
	            var section_name = element.attr('data-name');
	            var section_color = element.attr('data-color');
	            var dine_in_active = element.attr('data-dine_in');
	            var service_type = element.attr('service_type');
	            if (dine_in_active != 'true') {
	                dine_in_active = 'false';
	            }
	            setCookie('section_id', section_id, 365);
	            setCookie('section_name', section_name, 365);
	            setCookie('section_color', section_color, 365);
	            setCookie('dine_in_active', dine_in_active.toString(), 365);
	            setCookie('service_type', service_type, 365);
	            window.location.href = "<?php echo url('/'); ?>";
	        });
	    });
	
		async function getSections(){
			database.collection('sections').where('isActive','==',true).get().then(async function (sectionsSnapshot) {
				sections = document.getElementById('sections');
				sections.innerHTML = '';
				sectionshtml = buildHTMLSections(sectionsSnapshot);
				sections.innerHTML = sectionshtml;
				slickcatCarousel();
			})
		}
		
		function buildHTMLSections(sectionsSnapshot) {
	        var html = '';
	        var alldata = [];
	        sectionsSnapshot.docs.forEach((listval) => {
	            var datas = listval.data();
	            datas.id=listval.id;
	            alldata.push(datas);
	        });
	
	        alldata.forEach((listval) => {
	            var val = listval;
	            var category_id = val.id;
	            var trending_route = "{{ route('category_detail',':id')}}";
	            trending_route = trending_route.replace(':id', category_id);
	
	            if (val.sectionImage) {
	                photo = val.sectionImage;
	            } else {
	                photo = placeholderImageSrc;
	            }
	            html = html + '<div class="cat-item px-2 py-1" data-color="' + val.color + '" service_type="' + val.serviceType + '" data-name="' + val.name + '" data-dine_in="' + val.dine_in_active + '" data-id="' + val.id + '"><a class="bg-white d-block p-2 text-center shadow-sm cat-link" href="javascript:void(0)"><img alt="#" src="' + photo + '" class="img-fluid mb-2"><p class="m-0 small">' + val.name + '</p></a></div>';
	        });
	        return html;
	    }
		
		function slickcatCarousel() {
	        $('.cat-slider').slick({
	        	slidesToShow: 4,
	        	arrows: true,    
	        	responsive: [{
	                breakpoint: 1199,
	                settings: {
	                    arrows: true,
	                    centerMode: true,
	                    centerPadding: '40px',
	                    slidesToShow: 4
	                }
	            },{
	                breakpoint: 992,
	                settings: {
	                    arrows: true,
	                    centerMode: true,
	                    centerPadding: '40px',
	                    slidesToShow: 3
	                }
	            },{
	                breakpoint: 768,
	                settings: {
	                    arrows: true,
	                    centerMode: true,
	                    centerPadding: '40px',
	                    slidesToShow: 2
	                }
	            },
	            {
	                breakpoint: 560,
	                settings: {
	                    arrows: false,
	                    centerMode: true,
	                    centerPadding: '20px',
	                    slidesToShow: 2
	                }
	            }
	        ]
	    });
	  }
	  
	  function initialize() {
			
        if (address_name != '') { 
            document.getElementById('user_locationnew').value = address_name;
        }
        var input = document.getElementById('user_locationnew');
        autocomplete = new google.maps.places.Autocomplete(input);

        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            address_name = place.name;
            address_lat = place.geometry.location.lat();
            address_lng = place.geometry.location.lng();

            $.each(place.address_components, function (i, address_component) {
                address_name1 = '';
                if (address_component.types[0] == "premise") {
                    if (address_name1 == '') {
                        address_name1 = address_component.long_name;
                    } else {
                        address_name2 = address_component.long_name;
                    }
                } else if (address_component.types[0] == "postal_code") {
                    address_zip = address_component.long_name;
                } else if (address_component.types[0] == "locality") {
                    address_city = address_component.long_name;
                } else if (address_component.types[0] == "administrative_area_level_1") {
                    var address_state = address_component.long_name;
                } else if (address_component.types[0] == "country") {
                    var address_country = address_component.long_name;
                }
            });

            setCookie('address_name1', address_name1, 365);
            setCookie('address_name2', address_name2, 365);
            setCookie('address_name', address_name, 365);
            setCookie('address_lat', address_lat, 365);
            setCookie('address_lng', address_lng, 365);
            setCookie('address_zip', address_zip, 365);
            setCookie('address_city', address_city, 365);
            setCookie('address_state', address_state, 365);
            setCookie('address_country', address_country, 365);
        });
    }
</script>
