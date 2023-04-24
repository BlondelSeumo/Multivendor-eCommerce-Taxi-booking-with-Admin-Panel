<?php

namespace App\Http\Controllers;

use App\Models\VendorUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	if(!isset($_COOKIE['section_id']) && !isset($_COOKIE['address_name'])) {
    		\Redirect::to('set-location')->send();
		}
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function productList($type, $id)
    {
        return view('products.list', ['type' => $type, 'id' => $id]);
    }
    public function productListAll()
    {
        return view('products.list_arrivals');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function productDetail($id)
    {
        $cart = session()->get('cart', []);
        return view('products.detail', ['id' => $id, 'cart' => $cart]);
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function cart()
    {
        return view('checkout');
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart(Request $request)
    {

        $req = $request->all();
        $id = $req['id'];
        $vendor_id = $req['vendor_id'];

        $cart = Session::get('cart', []);

        if (@$cart['item'] && isset($cart['item'][$vendor_id])) {

        } else {
            $cart['item'] = array();
            Session::put('cart', $cart);
            Session::save();
        }

        $cart['vendor_latitude'] = $req['vendor_latitude'];
        $cart['vendor_longitude'] = $req['vendor_longitude'];

        $deliveryChargemain = @$_COOKIE['deliveryChargemain'];
        $address_lat = @$_COOKIE['address_lat'];
        $address_lng = @$_COOKIE['address_lng'];
        $vendor_latitude = @$_COOKIE['vendor_latitude'];
        $vendor_longitude = @$_COOKIE['vendor_longitude'];

        if(isset($_COOKIE['service_type']) == "Ecommerce Service" && isset($_COOKIE['ecommerce_delivery_charge'])){
				$cart['deliverychargemain'] = @$_COOKIE['ecommerce_delivery_charge'];
				$cart['deliverykm'] = '';
		}else{
			if (@$deliveryChargemain && @$address_lat && @$address_lng && @$vendor_latitude && @$vendor_longitude) {
	            $deliveryChargemain = json_decode($deliveryChargemain);
	            if (!empty($deliveryChargemain)) {
	                $delivery_charges_per_km = $deliveryChargemain->delivery_charges_per_km;
	                $minimum_delivery_charges = $deliveryChargemain->minimum_delivery_charges;
	                $minimum_delivery_charges_within_km = $deliveryChargemain->minimum_delivery_charges_within_km;
	                $kmradius = $this->distance($address_lat, $address_lng, $vendor_latitude, $vendor_longitude, 'K');
	                if ($minimum_delivery_charges_within_km > $kmradius) {
	                    $cart['deliverychargemain'] = $minimum_delivery_charges;
	                } else {
	                    $cart['deliverychargemain'] = round(($kmradius * $delivery_charges_per_km), 2);
	                }
	                $cart['deliverykm'] = $kmradius;
	            }
	        }
		}

        if (Session::get('takeawayOption') == "true") {
            $req['delivery_option'] = "takeaway";
        } else {
            $req['delivery_option'] = "delivery";
        }

        if (@$req['delivery_option'] == "delivery") {
            $cart['deliverycharge'] = $cart['deliverychargemain'];
        } else {
            $cart['deliverycharge'] = 0;
            $cart['tip_amount'] = 0;
        }

        $cart['delivery_option'] = $req['delivery_option'];

        $cart['tip_amount'] = 0;

        /*by thm*/
        if (isset($req['variant_info']) && !empty($req['variant_info']['variant_id'])) {
            $id = $id . 'PV' . $req['variant_info']['variant_id'];
        }
       // Print_r($req['variant_info'])
        $cart['item'][$vendor_id][$id] = [
            "name" => $req['name'],
            "quantity" => $req['quantity'],
            "stock_quantity" => $req['stock_quantity'],
            "item_price" => $req['item_price'],
            "price" => $req['price'],
            "dis_price" => $req['dis_price'],
            "extra_price" => $req['extra_price'],
            "extra" => @$req['extra'],
            "size" => @$req['size'],
            "image" => @$req['image'],
            "veg" => @$req['veg'],
            "variant_info" => @$req['variant_info'],
            "category_id" => @$req['category_id'],
        ];

        $cart['vendor']['id'] = @$vendor_id;
        $cart['vendor']['name'] = @$req['vendor_name'];
        $cart['vendor']['location'] = @$req['vendor_location'];
        $cart['vendor']['image'] = @$req['vendor_image'];
        $cart['taxValue'] = $req['taxValue'];

        $tax = 0;
        $tax_label = '';
        if (is_array($cart['taxValue'])) {
            $total_item_price = 0;
            foreach ($cart['item'][$vendor_id] as $key_cart => $value_cart) {

                $total_one_item_price = $value_cart['item_price'] * $value_cart['quantity'];
                if ($value_cart['extra_price']) {
                    $total_one_item_price = $total_one_item_price + ($value_cart['extra_price'] * $value_cart['quantity']);
                }
                $total_item_price = $total_item_price + $total_one_item_price;
            }

            $discount_amount = 0;
            /*Disctount*/
            if (@$cart['coupon'] && $cart['coupon']['discountType']) {
                $discountType = $cart['coupon']['discountType'];
                $coupon_code = $cart['coupon']['coupon_code'];
                $coupon_id = @$cart['coupon']['coupon_id'];
                $discount = $cart['coupon']['discount'];
                if ($discountType == "Fix Price") {
                    $discount_amount = $cart['coupon']['discount'];
                    if ($discount_amount > $total_item_price) {
                        $discount_amount = $total_item_price;
                    }
                } else {
                    $discount_amount = $cart['coupon']['discount'];
                    $discount_amount = ($total_item_price * $discount_amount) / 100;
                    if ($discount_amount > $total_item_price) {
                        $discount_amount = $total;
                    }
                }
            }

            // $total_item_price=$total_item_price-$discount_amount;
            /*Special Offer Disctount*/
            $specialOfferDiscount = 0;
            $specialOfferType = '';
            $specialOfferDiscountVal = 0;
            if (@$req['specialOfferForHour']) {
                $specialOfferForHour = $req['specialOfferForHour'];
                if (count($specialOfferForHour) > 0) {


                    foreach ($specialOfferForHour as $key => $value) {
                        $specialOfferType = $value['type'];
                        $specialOfferDiscountVal = $value['discount'];

                        if ($value['type'] == 'percentage') {

                            $specialOfferDiscount = ($total_item_price * $value['discount']) / 100;

                        } else {
                            $specialOfferDiscount = $value['discount'];

                        }
                    }


                }
            }

            $total_item_price = $total_item_price - $discount_amount - $specialOfferDiscount;

            $cart['specialOfferDiscount'] = $specialOfferDiscount;
            $cart['specialOfferDiscountVal'] = $specialOfferDiscountVal;
            $cart['specialOfferType'] = $specialOfferType;

            if ($cart['taxValue']['type'] == 'percent') {
                $tax = ($cart['taxValue']['tax'] * $total_item_price) / 100;
            } else {
                $tax = $cart['taxValue']['tax'];
            }
            $tax_label = $cart['taxValue']['label'];
        }
        $cart['tax_label'] = $tax_label;
        $cart['tax'] = $tax;

        $cart['decimal_degits'] = $req['decimal_degits'];

		Session::put('cart', $cart);
        Session::save();

        $res = array('status' => true, 'html' => view('vendor.cart_item', ['cart' => $cart])->render());
        echo json_encode($res);
        exit;
    }

    public function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function reorderaddToCart(Request $request)
    {

        $req = $request->all();
        $vendor_id = $req['vendor_id'];
        $cart = Session::get('cart', []);

        /*if(@$cart['item'] && isset($cart['item'][$vendor_id])){

        }else{*/
        $cart['item'] = array();
        Session::put('cart', $cart);
        Session::save();
        /*}*/
        if (@$req['deliveryCharge']) {
            $cart['deliverychargemain'] = $req['deliveryCharge'];
        } else {
            $cart['deliverychargemain'] = 0;
        }

        if (Session::get('takeawayOption') == "true") {
            $req['delivery_option'] = "takeaway";
        } else {
            $req['delivery_option'] = "delivery";
        }
        if (@$req['delivery_option'] == "delivery") {
            $cart['deliverycharge'] = $cart['deliverychargemain'];
        } else {
            $cart['deliverycharge'] = 0;
            $cart['tip_amount'] = 0;
        }
        $cart['delivery_option'] = $req['delivery_option'];
        $cart['tip_amount'] = 0;
        foreach ($req['item'] as $key => $value) {

            $id = 0;
            $name = '';
            $quantity = 0;
			$stock_quantity = 0;
			$item_price = 0;
            $price = 0;
            $extra_price = 0;
            $extra = '';
            $size = 0;
            $image = '';
            if ($value['id']) {
                $id = $value['id'];
            }
            if ($value['name']) {
                $name = $value['name'];
            }
            if ($value['quantity']) {
                $quantity = $value['quantity'];
            }
			if ($value['stock_quantity']) {
                $stock_quantity = $value['stock_quantity'];
            }
            if ($value['item_price']) {
                $item_price = $value['item_price'];
            }
            if ($value['price']) {
                $price = $value['price'];
            }
            if ($value['extra_price']) {
                $extra_price = $value['extra_price'];
            }
            if ($value['extra']) {
                $extra = explode(',', $value['extra']);
            }
            if ($value['size']) {
                $size = $value['size'];
            }
            if ($value['image']) {
                $image = $value['image'];
            }

            /*by thm*/
            $variant_info = '';
            if ($value['variant_info']) {
                $variant_info = $value['variant_info'];
            }

            if ($value['category_id']) {
                $category_id = $value['category_id'];
            }

            $cart['item'][$vendor_id][$id] = [
                "name" => @$name,
                "quantity" => @$quantity,
                "stock_quantity" => @$stock_quantity,
                "item_price" => @$item_price,
                "price" => ($quantity * $price),
                "extra_price" => ($quantity * $extra_price),
                "extra" => @$extra,
                "size" => @$size,
                "image" => @$image,
                "variant_info" => @$variant_info,
                "category_id" => @$category_id,
            ];

        }

        $cart['vendor']['id'] = @$vendor_id;
        $cart['vendor']['name'] = @$req['vendor_name'];
        $cart['vendor']['location'] = @$req['vendor_location'];
        $cart['vendor']['image'] = @$req['vendor_image'];


        $cart['taxValue'] = $req['taxValue'];
        $tax = 0;
        $tax_label = '';
        if (is_array($cart['taxValue'])) {
            $total_item_price = 0;
            foreach ($cart['item'][$vendor_id] as $key_cart => $value_cart) {

                $total_one_item_price = $value_cart['item_price'] * $value_cart['quantity'];
                if ($value_cart['extra_price']) {
                    $total_one_item_price = $total_one_item_price + ($value_cart['extra_price'] * $value_cart['quantity']);
                }
                $total_item_price = $total_item_price + $total_one_item_price;
            }
            $discount_amount = 0;
            /*Special Offer Disctount*/
            $specialOfferDiscount = 0;
            $specialOfferType = '';
            $specialOfferDiscountVal = 0;
            if (@$req['specialOfferForHour']) {
                $specialOfferForHour = $req['specialOfferForHour'];
                if (count($specialOfferForHour) > 0) {


                    foreach ($specialOfferForHour as $key => $value) {
                        $specialOfferType = $value['type'];
                        $specialOfferDiscountVal = $value['discount'];

                        if ($value['type'] == 'percentage') {

                            $specialOfferDiscount = ($total_item_price * $value['discount']) / 100;

                        } else {
                            $specialOfferDiscount = $value['discount'];

                        }
                    }


                }
            }

            $total_item_price = $total_item_price - $discount_amount - $specialOfferDiscount;

            $cart['specialOfferDiscount'] = $specialOfferDiscount;
            $cart['specialOfferDiscountVal'] = $specialOfferDiscountVal;
            $cart['specialOfferType'] = $specialOfferType;

            if ($cart['taxValue']['type'] == 'percent') {
                $tax = ($cart['taxValue']['tax'] * $total_item_price) / 100;
            } else {
                $tax = $cart['taxValue']['tax'];
            }
            $tax_label = $cart['taxValue']['label'];
        }
        $cart['tax_label'] = $tax_label;
        $cart['tax'] = $tax;

        Session::put('cart', $cart);
        Session::save();
        $res = array('status' => true);
        echo json_encode($res);
        exit;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function orderTipAdd(Request $request)
    {

        $req = $request->all();
        $cart = Session::get('cart', []);
        $type = $req['type'];
        if ($type == 'plus') {
            $cart['tip_amount'] = $req['tip'];
        } else {
            $cart['tip_amount'] = 0;
        }
        //$cart['tip_amount']=$req['tip'];
        Session::put('cart', $cart);
        Session::save();
        if (@$req['is_checkout']) {
            $email = Auth::user()->email;
            $user = VendorUsers::where('email', $email)->first();
            $res = array('status' => true, 'html' => view('vendor.cart_item', ['is_checkout' => 1, 'id' => $user->uuid, 'cart' => $cart])->render());
        } else {
            $res = array('status' => true, 'html' => view('vendor.cart_item', ['cart' => $cart])->render());
        }

        echo json_encode($res);
        exit;

    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function orderDeliveryOption(Request $request)
    {

        $req = $request->all();
        $cart = Session::get('cart', []);
        $cart['delivery_option'] = $req['delivery_option'];
        if ($req['delivery_option'] == "takeaway") {
            //deliveryCharge
            $cart['tip_amount'] = 0;
            $cart['deliverycharge'] = 0;
        } else {
            //delivery
            if (isset($cart['deliverychargemain'])) {
                $cart['deliverycharge'] = $cart['deliverychargemain'];
            } else if (isset($req['deliveryCharge'])) {
                $cart['deliverychargemain'] = $req['deliveryCharge'];
                $cart['deliverycharge'] = $cart['deliverychargemain'];
            }
        }


        Session::put('cart', $cart);
        Session::save();
        if (@$req['is_checkout']) {
            $email = Auth::user()->email;
            $user = VendorUsers::where('email', $email)->first();
            $res = array('status' => true, 'html' => view('vendor.cart_item', ['is_checkout' => 1, 'id' => $user->uuid, 'cart' => $cart])->render());
        } else {
            $res = array('status' => true, 'html' => view('vendor.cart_item', ['cart' => $cart])->render());
        }

        echo json_encode($res);
        exit;

    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function changeQuantityCart(Request $request)
    {

        $req = $request->all();
        $id = $req['id'];
        $vendor_id = $req['vendor_id'];
        $quantity = $req['quantity'];
        $cart = Session::get('cart');

        if (isset($cart['item'][$vendor_id][$id])) {
            if ($req['quantity'] == 0) {

                if (isset($cart['item'][$vendor_id][$id])) {
                  $cart['item'][$vendor_id][$id]['quantity'] = $req['quantity'];
                  $cart['item'][$vendor_id][$id]['price'] = $cart['item'][$vendor_id][$id]['item_price'] * $cart['item'][$vendor_id][$id]['quantity'];
                  if (is_array($cart['taxValue'])) {
                      $total_item_price = 0;
                      foreach ($cart['item'][$vendor_id] as $key_cart => $value_cart) {

                          $total_one_item_price = $value_cart['item_price'] * $value_cart['quantity'];
                          if ($value_cart['extra_price']) {
                              $total_one_item_price = $total_one_item_price + ($value_cart['extra_price'] * $value_cart['quantity']);
                          }
                          $total_item_price = $total_item_price + $total_one_item_price;
                      }

                      $discount_amount = 0;
                      /*Disctount*/
                      if (@$cart['coupon'] && $cart['coupon']['discountType']) {
                          $discountType = $cart['coupon']['discountType'];
                          $coupon_code = $cart['coupon']['coupon_code'];
                          $coupon_id = @$cart['coupon']['coupon_id'];
                          $discount = $cart['coupon']['discount'];
                          if ($discountType == "Fix Price") {
                              $discount_amount = $cart['coupon']['discount'];
                              if ($discount_amount > $total_item_price) {
                                  $discount_amount = $total_item_price;
                              }
                          } else {
                              $discount_amount = $cart['coupon']['discount'];
                              $discount_amount = ($total_item_price * $discount_amount) / 100;
                              if ($discount_amount > $total_item_price) {
                                  $discount_amount = $total;
                              }
                          }
                      }

                      // $total_item_price=$total_item_price-$discount_amount;

                      $specialOfferDiscount = 0;
                      if (@$cart['specialOfferType'] && $cart['specialOfferType']) {
                          $specialOfferType = $cart['specialOfferType'];
                          $specialOfferDiscountVal = $cart['specialOfferDiscountVal'];

                          if ($specialOfferType == "amount") {
                              $specialOfferDiscount = $specialOfferDiscountVal;

                          } else {

                              $specialOfferDiscount = ($total_item_price * $specialOfferDiscountVal) / 100;


                          }
                      }

                      $total_item_price = $total_item_price - $discount_amount - $specialOfferDiscount;

                      if ($cart['taxValue']['type'] == 'percent') {
                          $tax = ($cart['taxValue']['tax'] * $total_item_price) / 100;
                      } else {
                          $tax = $cart['taxValue']['tax'];
                      }
                      $tax_label = $cart['taxValue']['label'];
                      $cart['tax_label'] = $tax_label;
                      $cart['tax'] = $tax;

                  }
                    unset($cart['item'][$vendor_id][$id]);
                    Session::put('cart', $cart);
                    Session::save();
                }

            } else {
                $cart['item'][$vendor_id][$id]['quantity'] = $req['quantity'];
                $cart['item'][$vendor_id][$id]['price'] = $cart['item'][$vendor_id][$id]['item_price'] * $cart['item'][$vendor_id][$id]['quantity'];
                // $cart['item'][$vendor_id][$id]['price'] = $req['price'];
                //$cart['item'][$vendor_id][$id]['price']= ($cart['item'][$vendor_id][$id]['item_price'] + $cart['item'][$vendor_id][$id]['extra_price']) * $cart['item'][$vendor_id][$id]['quantity'];


                if (is_array($cart['taxValue'])) {
                    $total_item_price = 0;
                    foreach ($cart['item'][$vendor_id] as $key_cart => $value_cart) {

                        $total_one_item_price = $value_cart['item_price'] * $value_cart['quantity'];
                        if ($value_cart['extra_price']) {
                            $total_one_item_price = $total_one_item_price + ($value_cart['extra_price'] * $value_cart['quantity']);
                        }
                        $total_item_price = $total_item_price + $total_one_item_price;
                    }

                    $discount_amount = 0;
                    /*Disctount*/
                    if (@$cart['coupon'] && $cart['coupon']['discountType']) {
                        $discountType = $cart['coupon']['discountType'];
                        $coupon_code = $cart['coupon']['coupon_code'];
                        $coupon_id = @$cart['coupon']['coupon_id'];
                        $discount = $cart['coupon']['discount'];
                        if ($discountType == "Fix Price") {
                            $discount_amount = $cart['coupon']['discount'];
                            if ($discount_amount > $total_item_price) {
                                $discount_amount = $total_item_price;
                            }
                        } else {
                            $discount_amount = $cart['coupon']['discount'];
                            $discount_amount = ($total_item_price * $discount_amount) / 100;
                            if ($discount_amount > $total_item_price) {
                                $discount_amount = $total;
                            }
                        }
                    }

                    // $total_item_price=$total_item_price-$discount_amount;

                    $specialOfferDiscount = 0;
                    if (@$cart['specialOfferType'] && $cart['specialOfferType']) {
                        $specialOfferType = $cart['specialOfferType'];
                        $specialOfferDiscountVal = $cart['specialOfferDiscountVal'];

                        if ($specialOfferType == "amount") {
                            $specialOfferDiscount = $specialOfferDiscountVal;

                        } else {

                            $specialOfferDiscount = ($total_item_price * $specialOfferDiscountVal) / 100;


                        }
                    }

                    $total_item_price = $total_item_price - $discount_amount - $specialOfferDiscount;

                    if ($cart['taxValue']['type'] == 'percent') {
                        $tax = ($cart['taxValue']['tax'] * $total_item_price) / 100;
                    } else {
                        $tax = $cart['taxValue']['tax'];
                    }
                    $tax_label = $cart['taxValue']['label'];
                    $cart['tax_label'] = $tax_label;
                    $cart['tax'] = $tax;

                }


                Session::put('cart', $cart);
                Session::save();
            }


        }
        $cart = Session::get('cart');

        $res = array('status' => true, 'html' => view('vendor.cart_item', ['cart' => $cart])->render());
        echo json_encode($res);
        exit;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function changeQuantityCartOLD(Request $request)
    {

        $req = $request->all();
        $id = $req['id'];
        $vendor_id = $req['vendor_id'];
        $quantity = $req['quantity'];
        $cart = Session::get('cart');

        if (isset($cart['item'][$vendor_id][$id])) {
            if ($req['quantity'] == 0) {

                if (isset($cart['item'][$vendor_id][$id])) {
                    unset($cart['item'][$vendor_id][$id]);
                    Session::put('cart', $cart);
                    Session::save();
                }

            } else {
                $cart['item'][$vendor_id][$id]['quantity'] = $req['quantity'];
                $cart['item'][$vendor_id][$id]['price'] = $cart['item'][$vendor_id][$id]['item_price'] * $cart['item'][$vendor_id][$id]['quantity'];
                // $cart['item'][$vendor_id][$id]['price'] = $req['price'];
                //$cart['item'][$vendor_id][$id]['price']= ($cart['item'][$vendor_id][$id]['item_price'] + $cart['item'][$vendor_id][$id]['extra_price']) * $cart['item'][$vendor_id][$id]['quantity'];
                Session::put('cart', $cart);
                Session::save();
            }
        }
        $cart = Session::get('cart');

        $res = array('status' => true, 'html' => view('vendor.cart_item', ['cart' => $cart])->render());
        echo json_encode($res);
        exit;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = Session::get('cart');
            $cart['item'][$request->id]["quantity"] = $request->quantity;

            if (is_array($cart['taxValue'])) {
                $total_item_price = 0;
                foreach ($cart['item'][$vendor_id] as $key_cart => $value_cart) {

                    $total_one_item_price = $value_cart['item_price'] * $value_cart['quantity'];
                    if ($value_cart['extra_price']) {
                        $total_one_item_price = $total_one_item_price + ($value_cart['extra_price'] * $value_cart['quantity']);
                    }
                    $total_item_price = $total_item_price + $total_one_item_price;
                }

                $discount_amount = 0;
                /*Disctount*/
                if (@$cart['coupon'] && $cart['coupon']['discountType']) {
                    $discountType = $cart['coupon']['discountType'];
                    $coupon_code = $cart['coupon']['coupon_code'];
                    $coupon_id = @$cart['coupon']['coupon_id'];
                    $discount = $cart['coupon']['discount'];
                    if ($discountType == "Fix Price") {
                        $discount_amount = $cart['coupon']['discount'];
                        if ($discount_amount > $total_item_price) {
                            $discount_amount = $total_item_price;
                        }
                    } else {
                        $discount_amount = $cart['coupon']['discount'];
                        $discount_amount = ($total_item_price * $discount_amount) / 100;
                        if ($discount_amount > $total_item_price) {
                            $discount_amount = $total;
                        }
                    }
                }

                // $total_item_price=$total_item_price-$discount_amount;
                $specialOfferDiscount = 0;
                if (@$cart['specialOfferType'] && $cart['specialOfferType']) {
                    $specialOfferType = $cart['specialOfferType'];
                    $specialOfferDiscountVal = $cart['specialOfferDiscountVal'];

                    if ($specialOfferType == "amount") {
                        $specialOfferDiscount = $cart['specialOfferDiscount'];

                    } else {
                        $specialOfferDiscount = ($total_item_price * $specialOfferDiscountVal) / 100;

                    }
                }


                $total_item_price = $total_item_price - $discount_amount - $specialOfferDiscount;

                if ($cart['taxValue']['type'] == 'percent') {
                    $tax = ($cart['taxValue']['tax'] * $total_item_price) / 100;
                } else {
                    $tax = $cart['taxValue']['tax'];
                }
                $tax_label = $cart['taxValue']['label'];
                $cart['tax_label'] = $tax_label;
                $cart['tax'] = $tax;

            }

            Session::put('cart', $cart);
            Session::save();
            $res = array('status' => true, 'html' => view('vendor.cart_item', ['cart' => $cart])->render());
            echo json_encode($res);
            exit;
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function applyCoupon(Request $request)
    {
        if ($request->coupon_code) {
            $cart = Session::get('cart');
            $cart['coupon']['coupon_code'] = $request->coupon_code;
            $cart['coupon']['coupon_id'] = $request->coupon_id;
            $cart['coupon']['discount'] = $request->discount;
            $cart['coupon']['discountType'] = $request->discountType;


            if (is_array($cart['taxValue'])) {
                $total_item_price = 0;
                $id = array_key_first($cart['item']);
                $vendor_id = $id;
                if ($vendor_id) {
                    foreach ($cart['item'][$vendor_id] as $key_cart => $value_cart) {

                        $total_one_item_price = $value_cart['item_price'] * $value_cart['quantity'];
                        if ($value_cart['extra_price']) {
                            $total_one_item_price = $total_one_item_price + ($value_cart['extra_price'] * $value_cart['quantity']);
                        }
                        $total_item_price = $total_item_price + $total_one_item_price;
                    }

                    $discount_amount = 0;
                    /*Disctount*/
                    if (@$cart['coupon'] && $cart['coupon']['discountType']) {
                        $discountType = $cart['coupon']['discountType'];
                        $coupon_code = $cart['coupon']['coupon_code'];
                        $coupon_id = @$cart['coupon']['coupon_id'];
                        $discount = $cart['coupon']['discount'];
                        if ($discountType == "Fix Price") {
                            $discount_amount = $cart['coupon']['discount'];
                            if ($discount_amount > $total_item_price) {
                                $discount_amount = $total_item_price;
                            }
                        } else {
                            $discount_amount = $cart['coupon']['discount'];
                            $discount_amount = ($total_item_price * $discount_amount) / 100;
                            if ($discount_amount > $total_item_price) {
                                $discount_amount = $total;
                            }
                        }
                    }

                    //$total_item_price=$total_item_price-$discount_amount;
                    $specialOfferDiscount = 0;
                    if (@$cart['specialOfferType'] && $cart['specialOfferType']) {
                        $specialOfferType = $cart['specialOfferType'];
                        $specialOfferDiscountVal = $cart['specialOfferDiscountVal'];

                        if ($specialOfferType == "amount") {
                            $specialOfferDiscount = $cart['specialOfferDiscount'];

                        } else {
                            $specialOfferDiscount = ($total_item_price * $specialOfferDiscountVal) / 100;

                        }
                    }


                    $total_item_price = $total_item_price - $discount_amount - $specialOfferDiscount;

                    if ($cart['taxValue']['type'] == 'percent') {
                        $tax = ($cart['taxValue']['tax'] * $total_item_price) / 100;
                    } else {
                        $tax = $cart['taxValue']['tax'];
                    }
                    $tax_label = $cart['taxValue']['label'];
                    $cart['tax_label'] = $tax_label;
                    $cart['tax'] = $tax;
                }
            }
            Session::put('cart', $cart);
            Session::save();
            $res = array('status' => true, 'html' => view('vendor.cart_item', ['cart' => $cart])->render());
            echo json_encode($res);
            exit;
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function orderComplete(Request $request)
    {
        $cart = array();
        Session::put('cart', $cart);
		Session::put('payfast_payment_token', '');
        Session::put('success', 'Your order has been successful!');
        $fcm = $request->fcm;
        $authorName = $request->authorName;
        $response = array();
        /*$fcm="ecQjqEgr3_SRGvQosRZhs5:APA91bETUYKoVEYMRuPDPfParjVxdiTIU0YD5flY4yNkaWFZ9uLC83hMSewrG9I5bpXo13WDFOfDFG7J3s4If0C4mvensGSIX6uMxoDT2FNtI2sytzLVzNxsbHa6l7cBcwIk7DV5Mp0K";*/
        if ($fcm) {
            $server_key = env('FIREBASE_KEY');
            if ($server_key) {
                $target = $fcm;
                /*$target="ecQjqEgr3_SRGvQosRZhs5:APA91bETUYKoVEYMRuPDPfParjVxdiTIU0YD5flY4yNkaWFZ9uLC83hMSewrG9I5bpXo13WDFOfDFG7J3s4If0C4mvensGSIX6uMxoDT2FNtI2sytzLVzNxsbHa6l7cBcwIk7DV5Mp0K";*/
                /*$target="eE5Pq9zASCqcvAwrJuC9gm:APA91bGoMT81ZTgEGoROebTCg2WpxwtkiYw_aQL-cSkRhRIpW4FV8LiSiFswSweN4Pbu6mmQnpYYWTZZFbXezo74oGxezD-SNtfiWbsk-1d9BCzJXb_H5GxwrvdnLzaueJieqkNdo6hL";*/
                /*$target="ecQjqEgr3_SRGvQosRZhs5:APA91bETUYKoVEYMRuPDPfParjVxdiTIU0YD5flY4yNkaWFZ9uLC83hMSewrG9I5bpXo13WDFOfDFG7J3s4If0C4mvensGSIX6uMxoDT2FNtI2sytzLVzNxsbHa6l7cBcwIk7DV5Mp0K";*/
                $url = 'https://fcm.googleapis.com/fcm/send';
                $fields = array();
                $fields['priority'] = "high";
                $fields['notification']['title'] = "New Order!";
                $fields['notification']['body'] = $authorName . " has Ordered";
                $fields['notification']['sound'] = 'default';
                $fields['data']['click_action'] = 'FLUTTER_NOTIFICATION_CLICK';
                $fields['data']['id'] = '1';
                $fields['data']['status'] = 'done';
                if (is_array($target)) {
                    $fields['registration_ids'] = $target;
                } else {
                    $fields['to'] = $target;
                }

                $headers = array(
                    'Content-Type:application/json',
                    'Authorization:key=' . $server_key
                );
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                $result = curl_exec($ch);
                if ($result === FALSE) {
                    die('FCM Send Error: ' . curl_error($ch));
                }
                curl_close($ch);
                $result2 = $result;
                $result = json_decode($result);
                $response = array();
                $response['target'] = $target;
                $response['fields'] = $fields;
                $response['result'] = $result;

            } else {
                $response = array();
                $response['message'] = 'Firebase Server key not found!';
                $response['target'] = '';
                $response['fields'] = '';
                $response['result'] = '';

            }
        }
        Session::save();
        $res = array('status' => true, 'order_complete' => true, 'html' => view('vendor.cart_item', ['cart' => $cart, 'order_complete' => true, 'is_checkout' => 1])->render(), 'response' => $response);
        echo json_encode($res);
        exit;

    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if ($request->id && $request->vendor_id) {
            $cart = Session::get('cart');

            if (isset($cart['item'][$request->vendor_id][$request->id])) {
                unset($cart['item'][$request->vendor_id][$request->id]);

                if (is_array($cart['taxValue'])) {
                    $total_item_price = 0;
                    $id = array_key_first($cart['item']);
                    $vendor_id = $id;
                    if ($vendor_id) {
                        foreach ($cart['item'][$vendor_id] as $key_cart => $value_cart) {

                            $total_one_item_price = $value_cart['item_price'] * $value_cart['quantity'];
                            if ($value_cart['extra_price']) {
                                $total_one_item_price = $total_one_item_price + ($value_cart['extra_price'] * $value_cart['quantity']);
                            }
                            $total_item_price = $total_item_price + $total_one_item_price;
                        }

                        $discount_amount = 0;
                        /*Disctount*/
                        if (@$cart['coupon'] && $cart['coupon']['discountType']) {
                            $discountType = $cart['coupon']['discountType'];
                            $coupon_code = $cart['coupon']['coupon_code'];
                            $coupon_id = @$cart['coupon']['coupon_id'];
                            $discount = $cart['coupon']['discount'];
                            if ($discountType == "Fix Price") {
                                $discount_amount = $cart['coupon']['discount'];
                                if ($discount_amount > $total_item_price) {
                                    $discount_amount = $total_item_price;
                                }
                            } else {
                                $discount_amount = $cart['coupon']['discount'];
                                $discount_amount = ($total_item_price * $discount_amount) / 100;
                                if ($discount_amount > $total_item_price) {
                                    $discount_amount = $total;
                                }
                            }
                        }

                        //$total_item_price=$total_item_price-$discount_amount;
                        $specialOfferDiscount = 0;
                        if (@$cart['specialOfferType'] && $cart['specialOfferType']) {
                            $specialOfferType = $cart['specialOfferType'];
                            $specialOfferDiscountVal = $cart['specialOfferDiscountVal'];

                            if ($specialOfferType == "amount") {
                                $specialOfferDiscount = $cart['specialOfferDiscount'];

                            } else {
                                $specialOfferDiscount = ($total_item_price * $specialOfferDiscountVal) / 100;

                            }
                        }


                        $total_item_price = $total_item_price - $discount_amount - $specialOfferDiscount;

                        if ($cart['taxValue']['type'] == 'percent') {
                            $tax = ($cart['taxValue']['tax'] * $total_item_price) / 100;
                        } else {
                            $tax = $cart['taxValue']['tax'];
                        }
                        $tax_label = $cart['taxValue']['label'];
                        $cart['tax_label'] = $tax_label;
                        $cart['tax'] = $tax;
                    }
                }

                Session::put('cart', $cart);
                Session::save();
            }
            $cart = Session::get('cart');
            session()->flash('success', 'Product removed successfully');
            $res = array('status' => true, 'html' => view('vendor.cart_item', ['cart' => $cart])->render());
            echo json_encode($res);
            exit;
        }
    }

}
