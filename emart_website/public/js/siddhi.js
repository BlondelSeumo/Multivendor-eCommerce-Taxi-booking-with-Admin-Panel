(function($) {
    "use strict"; // Start of use strict
$( document ).ready(function() {

    $(document).on("click", '.dec', function(event) { 
        var node=$(this).next();
        var vqty = $(this).data('vqty');
        var vqtymsg = $(this).data('vqtymsg');
        
        if(node.prop('type')=='text'){

            var tvalue=node.val();
            if(tvalue==''){
                tvalue=0;
            }else{
              tvalue=parseInt(tvalue)-1;    
              if(tvalue>=1){
                node.val(tvalue);
              }else{
                node.val(0);
              }
            }
            
            if(vqty != undefined && tvalue > vqty && vqty != -1){
            	alert(vqtymsg);
            	node.val(vqty);
            	return false;
            }
        }
    });

    $(document).on("click", '.inc', function(event) { 
        var node=$(this).prev();
        var vqty = $(this).data('vqty');
        var vqtymsg = $(this).data('vqtymsg');
        
        if(node.prop('type')=='text'){
            var tvalue=node.val();
            
            if(tvalue==''){
                tvalue=1;
            }else{
              tvalue=parseInt(tvalue)+1;    
              if(tvalue>1){
                node.val(tvalue);
              }else{
                node.val(1);
              }
            }
            
            if(vqty != undefined && tvalue > vqty && vqty != -1){
            	alert(vqtymsg);
            	node.val(vqty);
            	return false;
            }
            
        }
    });

    $('[data-toggle="tooltip"]').tooltip();

    $('.cat-slider').slick({
        //   centerMode: true,
        //   centerPadding: '30px',
        slidesToShow: 8,
        arrows: true,
        responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: true,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 4
                }
            }
        ]
    });

    // Trending slider

    $('.trending-slider').slick({
        slidesToShow: 3,
        arrows: true,
        responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            }
        ]
    });

    $('.offers-coupons').slick({
        slidesToShow: 3,
        arrows: true,
        responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            }
        ]
    });
    


    // Most popular slider

    $('.popular-slider').slick({
        centerMode: true,
        centerPadding: '30px',
        slidesToShow: 1,
        arrows: false,
        responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            }
        ]
    });

    // siddhi Slider
    $('.siddhi-slider').slick({
        centerMode: false,
        slidesToShow: 1,
        arrows: false,
        dots: true
    });

    // siddhi-slider-map
    $('.siddhi-slider-map').slick({
        //   centerMode: true,
        //   centerPadding: '30px',
        autoplay: true,
        slidesToShow: 5,
        arrows: true,
        responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: false,
                    autoplay: true,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    autoplay: true,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 3
                }
            }
        ]
    });
});
})(jQuery); // End of use strict