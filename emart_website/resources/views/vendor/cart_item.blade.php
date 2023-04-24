<?php

session_start();

if(@$order_complete){ ?>

	<div class="d-flex siddhi-cart-item-profile bg-white p-3">
	
	    <p>{{trans('lang.your_order_placed_successfully')}}</p>
	
	</div>

<?php } ?>

<?php $item_count = 0; $total_price = 0; $total_item_price = 0;

if(@$cart['item']){ foreach ($cart['item'] as $key => $value_vendor) {  $item_count++; ?>
	
<div class="sidebar-header p-3">
    <h3 class="font-weight-bold h6 w-100">{{trans('lang.cart')}}</h3>
</div>

<div class="bg-white p-3 sidebar-item-list">

    <h6 class="pb-3">{{trans('lang.item')}}</h6>

    <input type="hidden" name="main_vendor_id" value="<?php echo @$key; ?>" id="main_vendor_id">

    <?php foreach ($value_vendor as $key1 => $value_item) { ?>


    <div class="product-item gold-members row align-items-center py-2 border mb-2 rounded-lg m-0"
         id="item_<?php echo @$key1; ?>" data-id="<?php echo @$key1; ?>">

        <input type="hidden" id="price_<?php echo @$key1; ?>"
               value="<?php echo floatval($value_item['price']) + floatval($value_item['extra_price']); ?>">
               
        <input type="hidden" id="dis_price_<?php echo @$key1; ?>"
               value="<?php echo floatval(@$value_item['dis_price']); ?>">       

        <input type="hidden" id="item_price_<?php echo @$key1; ?>"
               value="<?php echo floatval($value_item['item_price']);?>">


        <input type="hidden" id="photo_<?php echo @$key1; ?>" value="<?php echo $value_item['image']; ?>">

        <input type="hidden" id="name_<?php echo @$key1; ?>" value="<?php echo @$value_item['name']; ?>">

        <input type="hidden" id="quantity_<?php echo @$key1; ?>" value="<?php echo $value_item['quantity']; ?>">

        <input type="hidden" id="variant_info_<?php echo @$key1; ?>"
               value="<?php echo @$value_item['variant_info'] ? base64_encode(json_encode($value_item['variant_info'])) : ''; ?>">

        <input type="hidden" id="category_id_<?php echo @$key1; ?>" value="<?php echo $value_item['category_id']; ?>">

        <div class="media align-items-center col-md-6">

            <?php //var_dump($value_item);
            if(isset($_COOKIE['dine_in_active']) && $_COOKIE['dine_in_active'] == 'true'){
            if ( isset($value_item['veg']) && $value_item['veg'] === "true" ) { ?>
            <div class="mr-2 text-success veg">
                &middot;
            </div>
            <?php }else{ ?>
            <div class="mr-2 text-danger non_veg">
                &middot;
            </div>
            <?php } } ?>


            <div class="media-body">

                <p class="m-0">
                    
                <?php 
                if(isset($value_item['variant_info']) && !empty($value_item['variant_info'])) {
                    //print_r($value_item['variant_info']['variant_image']);
                    if(!empty($value_item['variant_info']['variant_image'])){
                    
                        echo '<img src="'.$value_item['variant_info']['variant_image'].'" class="img-responsive img-rounded" style="max-height: 40px; max-width: 25px;">'; 

                    }
                    // else{
                    //     echo '<img src="'.$value_item['variant_info']['variant_image'].'" class="img-responsive img-rounded" style="max-height: 40px; max-width: 25px;">'; 
                    // }
                }else{
                    echo '<img src="'.$value_item['image'].'" class="img-responsive img-rounded" style="max-height: 40px; max-width: 25px;">'; 

                }
               
                ?>

                    <?php echo $value_item['name']; ?>

                    <?php if (isset($value_item['variant_info']) && !empty($value_item['variant_info'])) {
                        echo '<div class="variant-info">';
                        echo '<ul>';
                        foreach ($value_item['variant_info']['variant_options'] as $label => $value) {
                            echo '<li class="variant"><span class="label">' . $label . '</span><span class="value">' . $value . '</span></li>';
                        }
                        echo '</ul>';
                        echo '</div>';
                    }
                    ?>
                </p>

                <?php if(@$value_item['extra']){ ?>

                <div class="extras">

                    <span>{{trans('lang.extra')}}</span>

                    <?php if(@is_array($value_item['extra'])){ foreach ($value_item['extra'] as $key3 => $extra) { ?>

                    <input type="hidden" class="extras_<?php echo @$key1; ?>" value="<?php echo $extra; ?>">

                    <p><?php echo $extra; ?></p>

                    <?php } } ?>

                </div>

                <?php } ?>

                <input type="hidden" id="extras_price_<?php echo @$key1; ?>"
                       value="<?php echo @$value_item['extra_price']; ?>">

                <?php if(@$value_item['size']){ ?>

                <div class="size">

                    <span>{{trans('lang.size')}}</span>

                    <p><?php echo $value_item['size']; ?></p>

                </div>

                <?php } ?>

                <input type="hidden" id="size_<?php echo @$key1; ?>" value="<?php echo @$value_item['size']; ?>">
                <input type="hidden" id="vegs_<?php echo @$key1; ?>" value="<?php echo @$value_item['veg']; ?>">

            </div>


        </div>

        <div class="d-flex align-items-center count-number-box col-md-5">

											<span class="count-number float-right">
												
												<button type="button" data-vendor="<?php echo $key; ?>"
                                                        data-id="<?php echo $key1; ?>"
                                                		
                                                		<?php if (isset($value_item['variant_info']) && !empty($value_item['variant_info'])) {
															$varient_qty = $value_item['variant_info']['variant_qty'];
														 ?>
															data-vqty="<?php echo $varient_qty; ?>"
															data-vqtymsg="{{trans('lang.invalid_stock_qty')}}"
														 <?php }else{ ?>
														 	data-vqty="<?php echo $value_item['stock_quantity']; ?>"
															data-vqtymsg="{{trans('lang.invalid_stock_qty')}}"
														 <?php } ?>        
                                                        
                                                        class="count-number-input-cart btn-sm left dec btn btn-outline-secondary">

													<i class="feather-minus"></i>

												</button>

												<input class="count-number-input count_number_<?php echo $key1; ?>"
                                                       type="text" readonly
                                                       value="<?php echo $value_item['quantity']; ?>">

												<button type="button" data-vendor="<?php echo $key; ?>"
                                                        data-id="<?php echo $key1; ?>"
                                                        
                                                        <?php if (isset($value_item['variant_info']) && !empty($value_item['variant_info'])) {
															$varient_qty = $value_item['variant_info']['variant_qty'];
														 ?>
															data-vqty="<?php echo $varient_qty; ?>"
															data-vqtymsg="{{trans('lang.invalid_stock_qty')}}"
														 <?php }else{ ?>
														 	data-vqty="<?php echo $value_item['stock_quantity']; ?>"
															data-vqtymsg="{{trans('lang.invalid_stock_qty')}}"
														<?php } ?>		
                                                        
                                                        class="count-number-input-cart btn-sm right inc btn btn-outline-secondary">

													<i class="feather-plus"></i>

												</button></span>

            <p class="text-gray mb-0 float-right ml-3 text-muted small">
                <span class="currency-symbol-left"></span>
                <span class="cart_iteam_total_<?php echo $key1; ?>">

                    <?php  $totalItemPrice = @floatval($value_item['price']) + (@floatval($value_item['extra_price']) * @floatval($value_item['quantity']));
                    $digit_decimal = 0;

                    if (@$cart['decimal_degits']) {
                        $digit_decimal = $cart['decimal_degits'];
                    }
                    echo number_format($totalItemPrice, $digit_decimal);
                    ?>
                </span>
                <span class="currency-symbol-right"></span>
            </p>

        </div>

        <div class="close remove_item col-md-1" data-vendor="<?php echo $key; ?>" data-id="<?php echo $key1; ?>"><i
                    class="fa fa-times"></i></div>

    </div>

    <?php $total_price = $total_price + (floatval($value_item['price']) + (@floatval($value_item['extra_price']) * @floatval($value_item['quantity']))); } ?>




    <?php } ?>
    <?php $total_item_price = $total_price; ?>
</div>


<div class="bg-white px-3 clearfix">

    <div class="border-bottom pb-3">
        <div class="input-group-sm mb-2 input-group">

            <input placeholder="{{trans('lang.promo_help')}}" data-vendor="<?php echo @$key1; ?>" data-vendor-id="<?php echo @$cart['vendor']['id'] ?>"
                   value="<?php echo @$cart['coupon']['coupon_code'] ?>" id="coupon_code" type="text"
                   class="form-control">

            <div class="input-group-append">

                <button type="button" class="btn btn-primary" id="apply-coupon-code">

                    <i class="feather-percent"></i> {{trans('lang.apply')}}

                </button>

            </div>

        </div>
    </div>

    <!-- <div class="mb-0 input-group">

        <div class="input-group-prepend">

            <span class="input-group-text"><i class="feather-message-square"></i></span>

        </div>

        <textarea placeholder="Any suggestions? We will pass it on..." aria-label="With textarea" class="form-control"></textarea>

    </div> -->

</div>


<?php  } ?>



<?php if($item_count == 0){ ?>

<div class="bg-white border-bottom py-2">

    <div class="gold-members d-flex align-items-center justify-content-between px-3 py-2 border-bottom">
        <span>{{trans('lang.your_cart_is_empty')}}</span>

    </div>

</div>

<?php } ?>

<?php

if (@$cart['tip_amount']) {

    $tip_amount = $cart['tip_amount'];

} else {

    $tip_amount = '';

}

?>


<div class="bg-white p-3 clearfix delivery-box">

    <h3>{{trans('lang.delivery_option')}}</h3>

    <div class="delevery-option">
        <?php $delivery_option = '';
        if (@$cart['delivery_option']) {
            $delivery_option = $cart['delivery_option'];
        } else {

            $delivery_option = @$cart['delivery_option'];
            Session::get('takeawayOption');
            if (Session::get('takeawayOption') == "true") {
                $delivery_option = "takeaway";
            } else {
                $delivery_option = "delivery";
            }
        } 
        ?>
        
        <input type="hidden" name="delivery_option" value="<?php echo $delivery_option; ?>">
        
        <?php if($delivery_option == "takeaway"){ ?>
        
        	<label class="custom-control-labels" for="takeaway">{{trans('lang.take_away')}}({{trans('lang.free')}})</label>
        
        <?php }else{ ?>
        	
	        <label class="custom-control-labels" for="takeaway">Delivery 
	        	
	        	<?php if(@$cart['deliverychargemain']){ ?> (<span class="currency-symbol-left"></span>
	        	
		        	<?php
		            $digit_decimal = 0;
					if (@$cart['decimal_degits']) {
		                $digit_decimal = $cart['decimal_degits'];
		            }
		            echo number_format(@$cart['deliverychargemain'],$digit_decimal);
		            ?>
		            
		            <span class="currency-symbol-right"></span> ) 
	            <?php } ?>
	            
	         </label>
	         
        <?php } ?>

    </div>

</div>


<div class="bg-white px-3 clearfix delevery-partner" style="<?php if(@$cart['delivery_option'] == "takeaway"){ ?> display:none; <?php } ?>">
	
    <div class="border-bottom py-3">

        <h3>{{trans('lang.tip_your_delivery_partner')}}</h3>

        <span class="float-center">100% of the {{trans('lang.tip_go_to_your_delivery_partner')}}</span>

        <div class="tip-box">

            <div class="custom-control custom-radio border-bottom py-2">

                <input type="radio" name="tip" id="10" value="10" class="this_tip custom-control-input 
                	<?php if (@$tip_amount == 10) {
                           echo 'tip_checked';
                       }?>" 
                    <?php if(@$tip_amount == 10){ ?> checked <?php } ?>>

                <label class="custom-control-label" for="10"><span class="currency-symbol-left"></span>10<span class="currency-symbol-right"></span></label>

            </div>

            <div class="custom-control custom-radio border-bottom py-2">

                <input type="radio" name="tip" id="20" value="20" class="this_tip custom-control-input 
                		<?php if (@$tip_amount == 20) {
                           echo 'tip_checked';
                       }?>" 
                      <?php if(@$tip_amount == 20){ ?> checked <?php } ?>>

                <label class="custom-control-label" for="20"><span class="currency-symbol-left"></span>20<span class="currency-symbol-right"></span></label>

            </div>

            <div class="custom-control custom-radio border-bottom py-2">

                <input type="radio" name="tip" id="30" value="30" class="this_tip custom-control-input 
                		<?php if (@$tip_amount == 30) {
                           echo 'tip_checked';
                       }?>" 
                       <?php if(@$tip_amount == 30){ ?> checked <?php } ?>>

                <label class="custom-control-label" for="30"><span class="currency-symbol-left"></span>30<span class="currency-symbol-right"></span></label>

            </div>

            <div class="custom-control custom-radio border-bottom py-2">

                <input type="radio" name="tip" id="Other_tip" value="Other" class="custom-control-input"
                       <?php if($tip_amount && (@$tip_amount != 10 && @$tip_amount != 20 && @$tip_amount != 30)){ ?> checked <?php } ?>>

                <label class="custom-control-label" for="Other_tip">{{trans('lang.other')}}</label>

            </div>

            <div class="custom-control custom-radio border-bottom py-2" style="display: none;" id="add_tip_box">

                <input type="number" onchange="tipAmountChange()" name="tip_amount" id="tip_amount" value="<?php echo @$cart['tip_amount']; ?>">

            </div>

        </div>
    </div>

</div>


<div class="bg-white p-3 clearfix btm-total">

    <p class="mb-2">
        {{trans('lang.sub_total')}} 
        <span class="float-right text-dark">
        	<span class="currency-symbol-left"></span>
        	<?php
            	$digit_decimal = 0;
            	if (@$cart['decimal_degits']) {
                	$digit_decimal = $cart['decimal_degits'];
            	}
        	    echo number_format($total_price, $digit_decimal);
            ?>
           	<span class="currency-symbol-right"></span>
        </span>
	</p>

    <hr>
    <?php  $discount_amount = 0; $coupon_id = ''; $coupon_code = ''; $discount = ''; $discountType = '';

    if(@$cart['coupon'] && $cart['coupon']['discountType']){ ?>

	    <p class="mb-1 text-success">
	
	        <?php $discountType = $cart['coupon']['discountType'];
	
	        $coupon_code = $cart['coupon']['coupon_code'];
	
	        $coupon_id = @$cart['coupon']['coupon_id'];
	
	        $discount = $cart['coupon']['discount'];
	
	        if ($discountType == "Fix Price") {
	
	            $discount_amount = $cart['coupon']['discount'];
	
	            $total = $total_price - $discount_amount;
	
	            if ($discount_amount > $total) {
	
	                $discount_amount = $total;
	
	            }
	
	            if ($total < 0) {
	
	                $total = 0;
	
	            }
	
	        } else {
	
	            $discount_amount = $cart['coupon']['discount'];
	
	            $discount_amount = ($total_item_price * $discount_amount) / 100;
	
	            $total = $total_price - $discount_amount;
	
	            if ($discount_amount > $total) {
	
	                $discount_amount = $total;
	
	            }
	
	            if ($total < 0) {
	
	                $total = 0;
	
	            }
	
	        }
	
	
	
	        ?>
	
	        {{trans('lang.total')}} {{trans('lang.discount')}} <span class="float-right text-success"><span
	                    class="currency-symbol-left"></span><?php
	
	            $digit_decimal = 0;
	
	            if (@$cart['decimal_degits']) {
	                $digit_decimal = $cart['decimal_degits'];
	            }
	            echo number_format($discount_amount, $digit_decimal);
	
	            ?><span
	                    class="currency-symbol-right"></span></span>
	
	    </p>

    <?php }else { ?>

			<?php $total = $total_price; ?>
	
	<?php } ?>


    <input type="hidden" id="discount_amount" value="<?php echo $discount_amount; ?>">

    <input type="hidden" id="coupon_id" value="<?php echo $coupon_id; ?>">

    <input type="hidden" id="coupon_code_main" value="<?php echo $coupon_code; ?>">

    <input type="hidden" id="discount" value="<?php echo $discount; ?>">

    <input type="hidden" id="discountType" value="<?php echo $discountType; ?>">

    <?php  $specialOfferDiscount = 0; $specialOfferType = ''; $specialOfferDiscountVal = 0;


    if(@$cart['specialOfferDiscount'] && $total_item_price > 0){ ?>
    <p class="mb-1 text-success">
        <?php
        $specialOfferDiscount = $cart['specialOfferDiscount'];
        $specialOfferType = $cart['specialOfferType'];

        $specialOfferDiscountVal = $cart['specialOfferDiscountVal'];

        if ($specialOfferType == "amount") {
            $specialOfferDiscount = $specialOfferDiscountVal;

        } else {

            $specialOfferDiscount = ($total_item_price * $specialOfferDiscountVal) / 100;


        }
        $specialOfferDiscount = round($specialOfferDiscount, 2);

        $total = $total - $specialOfferDiscount;

        if ($specialOfferDiscount > $total) {

            $specialOfferDiscount = $total;

        }



        if ($total < 0) {

            $total = 0;

        }
        $special_html = "";
        if ($specialOfferType == "percentage") {
            $special_html = "(" . $specialOfferDiscountVal . "%)";
        }
        ?>
        {{trans('lang.special')}} {{trans('lang.offer')}} {{trans('lang.discount')}} <?php echo $special_html;?><span
                class="float-right text-success"><span
                    class="currency-symbol-left"></span><?php

            $digit_decimal = 0;

            if (@$cart['decimal_degits']) {
                $digit_decimal = $cart['decimal_degits'];
            }
            echo number_format($specialOfferDiscount, $digit_decimal);

            ?><span
                    class="currency-symbol-right"></span></span>

    </p>

    <?php } ?>

    <input type="hidden" id="specialOfferDiscountAmount" value="<?php echo $specialOfferDiscount; ?>">
    <input type="hidden" id="specialOfferType" value="<?php echo $specialOfferType; ?>">
    <input type="hidden" id="specialOfferDiscountVal" value="<?php echo $specialOfferDiscountVal; ?>">
    <?php if($item_count && $total_price && @$cart['tax_label'] && @$cart['tax']){ ?>

    <?php  $total = $total + $cart['tax']; ?>

    <p class="mb-2"><?php echo $cart['tax_label'];

        if(@$cart['taxValue']){ ?>
        <?php if($cart['taxValue']['type'] == 'fix'){ ?>
        ( <span class="currency-symbol-left"></span>
        <?php
        $digit_decimal = 0;
        if (@$cart['decimal_degits']) {
            $digit_decimal = $cart['decimal_degits'];
        }
        echo number_format($cart['taxValue']['tax'], $digit_decimal);
        ?><span class="currency-symbol-right"></span> )
        <?php }else{ ?>
        (<?php echo $cart['taxValue']['tax']; ?>%)
        <?php } ?>

        <?php } ?>

        <span class="float-right text-dark">
         	<span class="currency-symbol-left"></span>
         	<?php
            $digit_decimal = 0;
            if (@$cart['decimal_degits']) {
                $digit_decimal = $cart['decimal_degits'];
            }
            echo number_format(@$cart['tax'], $digit_decimal);
            ?>
            <span class="currency-symbol-right"></span>
        </span>

    </p>

    <?php } ?>

    <input type="hidden" id="tax_label" value="<?php echo @$cart['tax_label']; ?>">

    <input type="hidden" id="tax" value="<?php echo @$cart['tax']; ?>">

    <?php if($item_count && $total_price && @$cart['deliverycharge']){ ?>

	    <?php  $total = $total + $cart['deliverycharge']; ?>
	
	    <p class="mb-2">
	
	        {{trans('lang.deliveryCharge')}} <span class="float-right text-dark"><span
	                    class="currency-symbol-left"></span><?php
	
	            $digit_decimal = 0;
	
	            if (@$cart['decimal_degits']) {
	                $digit_decimal = $cart['decimal_degits'];
	            }
	            echo number_format(@$cart['deliverycharge'], $digit_decimal);
	            ?><span
	                    class="currency-symbol-right"></span> <?php if(@$cart['deliverykm']){ ?> (<?php echo round($cart['deliverykm'], 2); ?>Km) <?php } ?> </span>
	
	    </p>

    <?php } ?>

    <?php if($item_count && $tip_amount){ $total = $total + $tip_amount; ?>

    <p class="mb-2">

        {{trans('lang.tip_amount')}} <span class="float-right text-dark"><span
                    class="currency-symbol-left"></span><?php

            $digit_decimal = 0;

            if (@$cart['decimal_degits']) {
                $digit_decimal = $cart['decimal_degits'];
            }
            echo number_format($tip_amount, $digit_decimal);
            ?><span
                    class="currency-symbol-right"></span></span>

    </p>

    <?php } ?>



    <input type="hidden" value="<?php echo @$cart['deliverycharge']; ?>" id="deliveryCharge">

    <input type="hidden" value="" id="deliveryChargeMain">

    <input type="hidden" id="adminCommission" value="0">

    <input type="hidden" id="adminCommissionType" value="Fix Price">


    <input type="hidden" id="total_pay" value="<?php echo round($total, 2); ?>">

    <hr>

    <h6 class="font-weight-bold mb-0">{{trans('lang.total')}} 
    	<p class="float-right">
    		<span class="currency-symbol-left"></span>
    		<span>
    			<?php
                $digit_decimal = 0;
                if (@$cart['decimal_degits']) {
                    $digit_decimal = $cart['decimal_degits'];
                }
                echo number_format($total, $digit_decimal);
                ?>
            </span>
            <span class="currency-symbol-right"></span>
     	</p>
    </h6>
</div>

<div class="p-3">

    <?php if($item_count == 0){ ?>

    <a class="btn btn-primary btn-block btn-lg disable" href="javascript:void(0)">{{trans('lang.pay')}} <span
                class="currency-symbol-left"></span><?php echo $total; ?><span class="currency-symbol-right"></span><i
                class="feather-arrow-right"></i></a>

    <?php }else if(@$is_checkout){ ?>

    <a class="btn btn-primary btn-block btn-lg" href="javascript:void(0)"
       onclick="finalCheckout()">{{trans('lang.pay')}} <span class="currency-symbol-left"></span><?php echo $total; ?>
        <span class="currency-symbol-right"></span><i class="feather-arrow-right"></i></a>

    <?php }else{ ?>

    <a class="btn btn-primary btn-block btn-lg" href="{{route('checkout')}}">{{trans('lang.pay')}} <span
                class="currency-symbol-left"></span><?php echo $total; ?><span class="currency-symbol-right"></span><i
                class="feather-arrow-right"></i></a>

    <?php } ?>

</div>
