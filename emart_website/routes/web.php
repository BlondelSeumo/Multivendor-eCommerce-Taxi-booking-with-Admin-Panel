<?php

use App\Http\Controllers\Auth\AjaxController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\OffersController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrendingController;
use App\Http\Controllers\AllVendorsController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ParcelController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DiveinVendorController;
use App\Http\Controllers\CmsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('set-location',[HomeController::class, 'setLocation'])->name('set-location');

Route::get('login', [LoginController::class, 'login'])->name('login');

Route::get('signup', [LoginController::class, 'signup'])->name('signup');

Route::get('search', [SearchController::class, 'index'])->name('search');

Route::get('privacy', [CmsController::class,'privacypolicy'])->name('privacy');

Route::get('terms', [CmsController::class,'termsofuse'])->name('terms');

Route::get('deliveryofsupport', [CmsController::class,'deliveryofsupport'])->name('deliveryofsupport');

Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');

Route::post('takeaway', [PaymentController::class, 'takeawayOption'])->name('takeaway');

Route::get('parcel/{id}', [ParcelController::class, 'parcel'])->name('parcel');

Route::get('parcel_checkout', [ParcelController::class, 'parcelCheckout'])->name('parcel_checkout');

Route::post('parcel_cart', [ParcelController::class, 'parcelCart'])->name('parcel_cart');

Route::post('parcel_order_proccessing', [ParcelController::class, 'parcelOrderProccessing'])->name('parcel_order_proccessing');

Route::get('process_parcel_order_pay', [ParcelController::class, 'processParcelOrderPay'])->name('process_parcel_order_pay');

Route::post('parcel_razorpay_payment', [ParcelController::class, 'parcelRazorpayPayment'])->name('parcel_razorpay_payment');

Route::get('parcel_success', [ParcelController::class, 'parcelSuccess'])->name('parcel_success');

Route::post('process_parcel_stripe', [ParcelController::class, 'processParcelStripePayment'])->name('process_parcel_stripe');

Route::post('apply_parcel_coupon', [ParcelController::class, 'applyParcelCoupon'])->name('apply_parcel_coupon');

Route::post('process_parcel_paypal', [ParcelController::class, 'processParcelPaypalPayment'])->name('process_parcel_paypal');

Route::get('parcel_notify', [ParcelController::class, 'parcelNotify'])->name('parcel_notify');

Route::post('parcel_order_complete', [ParcelController::class, 'parcelOrderComplete'])->name('parcel_order_complete');

Route::get('parcel_orders', [ParcelController::class, 'parcelOrders'])->name('parcel_orders');

Route::get('rental', [RentalController::class, 'index'])->name('rental');

Route::get('rental_cars', [RentalController::class, 'rentalCars'])->name('rental_cars');

Route::get('rental_cars/{id}', [RentalController::class, 'rentalCarsDetails'])->name('rental_cars.view');

Route::post('find_rental_cars', [RentalController::class, 'findRentalCars'])->name('find_rental_cars');

Route::get('rental_success', [RentalController::class, 'rentalSuccess'])->name('rental_success');

Route::post('rental_order_proccessing', [RentalController::class, 'rentalOrderProccessing'])->name('rental_order_proccessing');

Route::get('process_rental_order_pay', [RentalController::class, 'processRentalOrderPay'])->name('process_rental_order_pay');

Route::post('rental_razorpay_payment', [RentalController::class, 'rentalRazorpayPayment'])->name('rental_razorpay_payment');

Route::post('rental_order_complete', [RentalController::class, 'rentalOrderComplete'])->name('rental_order_complete');

Route::get('rental_notify', [RentalController::class, 'rentalNotify'])->name('rental_notify');

Route::post('process_rental_stripe', [RentalController::class, 'processRentalStripePayment'])->name('process_rental_stripe');

Route::post('process_rental_paypal', [RentalController::class, 'processRentalPaypalPayment'])->name('process_rental_paypal');

Route::post('apply_rental_coupon', [RentalController::class, 'applyRentalCoupon'])->name('apply_rental_coupon');

Route::get('rental_cars_checkout/{id}', [RentalController::class, 'rentalCarsCheckout'])->name('rental_cars_checkout');

Route::get('rental_orders', [RentalController::class, 'RentalOrders'])->name('rental_orders');

Route::get('rental_orders_detail/{id}', [RentalController::class, 'RentalOrdersDetails'])->name('rental_orders_detail');

Route::get('my_order', [OrderController::class, 'index'])->name('my_order');

Route::get('completed_order', [OrderController::class, 'completedOrders'])->name('completed_order');

Route::get('pending_order', [OrderController::class, 'pendingOrder'])->name('pending_order');

Route::get('cancelled_order', [OrderController::class, 'cancelledOrder'])->name('cancelled_order');

Route::get('my_dinein', [OrderController::class, 'myDinein'])->name('my_dinein');

Route::get('dinein', [OrderController::class, 'dinein'])->name('dinein');

Route::get('contact-us', [ContactUsController::class, 'index'])->name('contact_us');

Route::get('trending', [TrendingController::class, 'index'])->name('trending');

Route::get('category/{id}', [VendorController::class, 'categoryDetail'])->name('category_detail');

Route::get('vendor-detail', [VendorController::class, 'index'])->name('vendor');

Route::get('cart', [ProductController::class, 'cart'])->name('cart');

Route::post('add-to-cart', [ProductController::class, 'addToCart'])->name('add-to-cart');

Route::post('reorder-add-to-cart', [ProductController::class, 'reorderaddToCart'])->name('reorder-add-to-cart');

Route::post('update-cart', [ProductController::class, 'update'])->name('update-cart');

Route::post('remove-from-cart', [ProductController::class, 'remove'])->name('remove-from-cart');

Route::post('change-quantity-cart', [ProductController::class, 'changeQuantityCart'])->name('change-quantity-cart');

Route::post('apply-coupon', [ProductController::class, 'applyCoupon'])->name('apply-coupon');

Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout');

Route::post('order-complete', [ProductController::class, 'orderComplete'])->name('order-complete');

Route::post('order-tip-add', [ProductController::class, 'orderTipAdd'])->name('order-tip-add');

Route::post('order-delivery-option', [ProductController::class, 'orderDeliveryOption'])->name('order-delivery-option');

Route::get('pay', [CheckoutController::class, 'proccesstopay'])->name('pay');

Route::post('order-proccessing', [CheckoutController::class, 'orderProccessing'])->name('order-proccessing');

Route::post('stripepaymentcallback', [PaymentController::class, 'stripePaymentcallback'])->name('stripepaymentcallback');

Route::post('process-stripe', [CheckoutController::class, 'processStripePayment'])->name('process-stripe');

Route::post('process-paypal', [CheckoutController::class, 'processPaypalPayment'])->name('process-paypal');

Route::post('razorpaypayment', [CheckoutController::class, 'razorpaypayment'])->name('razorpaypayment');

Route::get('success', [CheckoutController::class, 'success'])->name('success');

Route::get('failed', [CheckoutController::class, 'failed'])->name('failed');

Route::get('notify', [CheckoutController::class, 'notify'])->name('notify');

Route::get('transactions', [TransactionController::class, 'index'])->name('transactions');

Route::get('offers', [OffersController::class, 'index'])->name('offers');

Route::get('profile', [ProfileController::class, 'index'])->name('profile');

Route::get('favorite-stores', [FavoritesController::class, 'index'])->name('favorites');

Route::get('favorite-products', [FavoritesController::class, 'favProduct'])->name('favorites.product');

Route::get('faq', [FaqController::class, 'index'])->name('faq');

Route::get('vendors', [AllVendorsController::class, 'index'])->name('vendors');

Route::get('vendors/category/{id}', [AllVendorsController::class, 'VendorsbyCategory'])->name('vendorsbycategory');

Route::get('brands', [BrandsController::class, 'index'])->name('brands');

Route::get('categories', [VendorController::class, 'categoryList'])->name('categorylist');

Route::get('products/{type}/{id}', [ProductController::class, 'productList'])->name('productlist');

Route::get('products', [ProductController::class, 'productListAll'])->name('productlist.all');

Route::get('product/{id}', [ProductController::class, 'productDetail'])->name('productdetail');

Route::get('dinein', [DiveinVendorController::class, 'index'])->name('dineinVendors');

Route::get('dyiningvendor', [DiveinVendorController::class, 'dyiningvendor'])->name('dyiningvendor');

Route::post('sendnotification', [VendorController::class, 'sendnotification'])->name('sendnotification');

Route::post('setToken', [AjaxController::class, 'setToken'])->name('setToken');

Route::post('logout', [AjaxController::class, 'logout'])->name('logout');

Route::post('newRegister', [AjaxController::class, 'newRegister'])->name('newRegister');

Route::post('sendemail/send', [SendEmailController::class, 'send'])->name('sendContactUsMail');

Route::get('my_order/{id}', [OrderController::class, 'edit'])->name('orderDetails');

Route::post('add-cart-note', [OrderController::class, 'addCartNote'])->name('add-cart-note');

Route::get('page/{slug}', [CmsController::class,'index'])->name('page');