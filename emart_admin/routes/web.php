<?php

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


Route::get('home/', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('lang/change', [App\Http\Controllers\LangController::class, 'change'])->name('changeLang');

Route::post('payments/razorpay/createorder', [App\Http\Controllers\RazorPayController::class, 'createOrderid']);

Route::post('payments/getpaytmchecksum', [App\Http\Controllers\PaymentController::class, 'getPaytmChecksum']);

Route::post('payments/validatechecksum', [App\Http\Controllers\PaymentController::class, 'validateChecksum']);

Route::post('payments/initiatepaytmpayment', [App\Http\Controllers\PaymentController::class, 'initiatePaytmPayment']);

Route::get('payments/paytmpaymentcallback', [App\Http\Controllers\PaymentController::class, 'paytmPaymentcallback']);

Route::post('payments/paypalclientid', [App\Http\Controllers\PaymentController::class, 'getPaypalClienttoken']);

Route::post('payments/paypaltransaction', [App\Http\Controllers\PaymentController::class, 'createBraintreePayment']);

Route::post('payments/stripepaymentintent', [App\Http\Controllers\PaymentController::class, 'createStripePaymentIntent']);

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::get('/users', [App\Http\Controllers\HomeController::class, 'users'])->name('users');

Route::get('/vendors', [App\Http\Controllers\VendorController::class, 'index'])->name('vendors');

Route::get('/vendors/edit/{id}', [App\Http\Controllers\VendorController::class, 'edit'])->name('vendors.edit');

Route::get('/vendors/view/{id}', [App\Http\Controllers\VendorController::class, 'view'])->name('vendors.view');

Route::get('/coupon/{id}', [App\Http\Controllers\CouponController::class, 'index'])->name('vendors.coupons');

Route::get('/items/{id}', [App\Http\Controllers\FoodController::class, 'index'])->name('vendors.items');

Route::get('/item/create/{id}', [App\Http\Controllers\FoodController::class, 'create']);

Route::get('/coupon/create/{id}', [App\Http\Controllers\CouponController::class, 'create']);

Route::get('/orders/{id}', [App\Http\Controllers\OrderController::class, 'index'])->name('vendors.orders');

Route::get('/reviews/{id}', [App\Http\Controllers\OrderReviewController::class, 'index'])->name('vendors.reviews');

Route::get('/vendors/promos/{id}', [App\Http\Controllers\VendorController::class, 'promos'])->name('vendors.promos');

Route::get('/coupons/create/{id}', [App\Http\Controllers\CouponController::class, 'create']);

Route::get('/vendors/create', [App\Http\Controllers\VendorController::class, 'create'])->name('vendors.create');

Route::get('/vendorFilters', [App\Http\Controllers\VendorFiltersController::class, 'index'])->name('vendorFilters');

Route::get('/vendorFilters/create', [App\Http\Controllers\VendorFiltersController::class, 'create'])->name('vendorFilters.create');

Route::get('/vendorFilters/edit/{id}', [App\Http\Controllers\VendorFiltersController::class, 'edit'])->name('vendorFilters.edit');

Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories');

Route::get('/categories/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');

Route::get('/categories/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');

Route::get('/section', [App\Http\Controllers\SectionController::class, 'index'])->name('section');

Route::get('/section/edit/{id}', [App\Http\Controllers\SectionController::class, 'edit'])->name('section.edit');

Route::get('/section/create', [App\Http\Controllers\SectionController::class, 'create'])->name('section.create');

Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');

Route::get('/users/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');

Route::get('/users/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('users.profile');

Route::post('/users/profile/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.profile.update');

Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');

Route::get('/items', [App\Http\Controllers\FoodController::class, 'index'])->name('items');

Route::get('/items/edit/{id}', [App\Http\Controllers\FoodController::class, 'edit'])->name('items.edit');

Route::get('/item/create', [App\Http\Controllers\FoodController::class, 'create'])->name('items.create');

Route::get('/item/view/{id}', [App\Http\Controllers\FoodController::class, 'view'])->name('items.view');

Route::get('/drivers', [App\Http\Controllers\DriverController::class, 'index'])->name('drivers');

Route::get('/drivers/edit/{id}', [App\Http\Controllers\DriverController::class, 'edit'])->name('drivers.edit');

Route::get('/drivers/create', [App\Http\Controllers\DriverController::class, 'create'])->name('drivers.create');

Route::get('/drivers/view/{id}', [App\Http\Controllers\DriverController::class, 'view'])->name('drivers.view');

Route::get('/parcelCategory', [App\Http\Controllers\ParcelController::class, 'index'])->name('parcelCategory');

Route::get('/parcelCategory/create', [App\Http\Controllers\ParcelController::class, 'create'])->name('parcelCategory.create');

Route::get('/parcelCategory/edit/{id}', [App\Http\Controllers\ParcelController::class, 'edit'])->name('parcelCategory.edit');

Route::get('/parcelCategory/view/{id}', [App\Http\Controllers\ParcelController::class, 'view'])->name('parcelCategory.view');

Route::get('/parcel_weight', [App\Http\Controllers\ParcelController::class, 'parcelWeight'])->name('parcel_weight');

Route::get('/parcel_coupons', [App\Http\Controllers\ParcelController::class, 'parcelCoupons'])->name('parcel_coupons');

Route::get('/parcel_coupons/edit/{id}', [App\Http\Controllers\ParcelController::class, 'parcelCouponsEdit'])->name('parcel_coupons.edit');

Route::get('/parcel_coupons/create', [App\Http\Controllers\ParcelController::class, 'parcelCouponsCreate'])->name('parcel_coupons.create');

Route::get('/parcel_orders', [App\Http\Controllers\ParcelController::class, 'parcelOrders'])->name('parcel_orders');

Route::get('/parcel_orders/edit/{id}', [App\Http\Controllers\ParcelController::class, 'parcelOrderEdit'])->name('parcel_orders.edit');

Route::get('/rides/{id}', [App\Http\Controllers\RideController::class, 'index'])->name('drivers.ride');

Route::get('/ride/{sosId}', [App\Http\Controllers\RideController::class, 'index2'])->name('ride');

Route::get('/rides', [App\Http\Controllers\RideController::class, 'index'])->name('rides');

Route::get('/rides/view/{id}', [App\Http\Controllers\RideController::class, 'view'])->name('rides.view');

Route::get('/rides/edit/{id}', [App\Http\Controllers\RideController::class, 'edit'])->name('rides.edit');

Route::get('/orders/', [App\Http\Controllers\OrderController::class, 'index'])->name('orders');

Route::get('/orders/edit/{id}', [App\Http\Controllers\OrderController::class, 'edit'])->name('orders.edit');

Route::get('/orders/review/{oid}', [App\Http\Controllers\OrderController::class, 'review'])->name('orders.review');

Route::get('/orderReview', [App\Http\Controllers\OrderReviewController::class, 'index'])->name('orderReview');

Route::get('/orderReview/edit/{id}', [App\Http\Controllers\OrderReviewController::class, 'edit'])->name('orderReview.edit');

Route::get('/coupons', [App\Http\Controllers\CouponController::class, 'index'])->name('coupons');

Route::get('/coupons/edit/{id}', [App\Http\Controllers\CouponController::class, 'edit'])->name('coupons.edit');

Route::get('/coupons/create', [App\Http\Controllers\CouponController::class, 'create'])->name('coupons.create');

Route::get('/payments', [App\Http\Controllers\AdminPaymentsController::class, 'index'])->name('payments');

Route::get('driverpayments', [App\Http\Controllers\AdminPaymentsController::class, 'driverIndex'])->name('driver.driverpayments');

Route::get('vendorsPayouts', [App\Http\Controllers\VendorsPayoutController::class, 'index'])->name('vendorsPayouts');

Route::get('vendorsPayouts/create', [App\Http\Controllers\VendorsPayoutController::class, 'create'])->name('vendorsPayouts.create');

Route::get('/vendorsPayouts/{id}', [App\Http\Controllers\VendorsPayoutController::class, 'index'])->name('vendors.payout');

Route::get('/vendorsPayouts/create/{id}', [App\Http\Controllers\VendorsPayoutController::class, 'create']);

Route::get('driversPayouts/create', [App\Http\Controllers\DriversPayoutController::class, 'create'])->name('driversPayouts.create');

Route::get('driversPayouts', [App\Http\Controllers\DriversPayoutController::class, 'index'])->name('driversPayouts');

Route::get('driversPayouts/{id}', [App\Http\Controllers\DriversPayoutController::class, 'index'])->name('driver.payouts');

Route::get('walletstransaction', [App\Http\Controllers\TransactionController::class, 'index'])->name('walletstransaction');

Route::get('/walletstransaction/{id}', [App\Http\Controllers\TransactionController::class, 'index'])->name('users.walletstransaction');

Route::post('order-status-notification', [App\Http\Controllers\OrderController::class, 'sendNotification'])->name('order-status-notification');

Route::prefix('settings')->group(function () {

    Route::get('/currencies', [App\Http\Controllers\CurrencyController::class, 'index'])->name('currencies');

    Route::get('/currencies/edit/{id}', [App\Http\Controllers\CurrencyController::class, 'edit'])->name('currencies.edit');

    Route::get('/currencies/create', [App\Http\Controllers\CurrencyController::class, 'create'])->name('currencies.create');

    Route::get('app/globals', [App\Http\Controllers\SettingsController::class, 'globals'])->name('settings.app.globals');

    Route::get('app/adminCommission', [App\Http\Controllers\SettingsController::class, 'adminCommission'])->name('settings.app.adminCommission');

    Route::get('app/radiusConfiguration', [App\Http\Controllers\SettingsController::class, 'radiosConfiguration'])->name('settings.app.radiusConfiguration');

    Route::get('app/notifications', [App\Http\Controllers\SettingsController::class, 'notifications'])->name('settings.app.notifications');

    Route::get('mobile/globals', [App\Http\Controllers\SettingsController::class, 'mobileGlobals'])->name('settings.mobile.globals');

    Route::get('payment/stripe', [App\Http\Controllers\SettingsController::class, 'stripe'])->name('payment.stripe');

    Route::get('payment/applepay', [App\Http\Controllers\SettingsController::class, 'applepay'])->name('payment.applepay');

    Route::get('payment/razorpay', [App\Http\Controllers\SettingsController::class, 'razorpay'])->name('payment.razorpay');

    Route::get('payment/cod', [App\Http\Controllers\SettingsController::class, 'cod'])->name('payment.cod');

    Route::get('payment/paypal', [App\Http\Controllers\SettingsController::class, 'paypal'])->name('payment.paypal');

    Route::get('payment/paytm', [App\Http\Controllers\SettingsController::class, 'paytm'])->name('payment.paytm');

    Route::get('payment/wallet', [App\Http\Controllers\SettingsController::class, 'wallet'])->name('payment.wallet');

    Route::get('payment/payfast', [App\Http\Controllers\SettingsController::class, 'payfast'])->name('payment.payfast');

    Route::get('payment/paystack', [App\Http\Controllers\SettingsController::class, 'paystack'])->name('payment.paystack');

    Route::get('payment/flutterwave', [App\Http\Controllers\SettingsController::class, 'flutterwave'])->name('payment.flutterwave');

    Route::get('payment/parcelPayStack', [App\Http\Controllers\SettingsController::class, 'parcelPayStack'])->name('payment.parcelPayStack');

    Route::get('payment/mercadopago', [App\Http\Controllers\SettingsController::class, 'mercadopago'])->name('payment.mercadopago');

    Route::get('payment/rentalPayStack', [App\Http\Controllers\SettingsController::class, 'rentalPayStack'])->name('payment.rentalPayStack');

    Route::get('app/deliveryCharge', [App\Http\Controllers\SettingsController::class, 'deliveryCharge'])->name('settings.app.deliveryCharge');

    Route::get('app/languages', [App\Http\Controllers\SettingsController::class, 'languages'])->name('settings.app.languages');

    Route::get('app/languages/create', [App\Http\Controllers\SettingsController::class, 'languagescreate'])->name('settings.app.languages.create');

    Route::get('app/languages/edit/{id}', [App\Http\Controllers\SettingsController::class, 'languagesedit'])->name('settings.app.languages.edit');

    Route::get('carMake', [App\Http\Controllers\SettingsController::class, 'carMake'])->name('settings.carMake');

    Route::get('carMake/create', [App\Http\Controllers\SettingsController::class, 'carMakeCreate'])->name('settings.carMake.create');

    Route::get('carMake/edit/{id}', [App\Http\Controllers\SettingsController::class, 'carMakeEdit'])->name('settings.carMake.edit');

    Route::get('carModel', [App\Http\Controllers\SettingsController::class, 'carModel'])->name('settings.carModel');

    Route::get('carModel/create', [App\Http\Controllers\SettingsController::class, 'carModelCreate'])->name('settings.carModel.create');

    Route::get('carModel/edit/{id}', [App\Http\Controllers\SettingsController::class, 'carModelEdit'])->name('settings.carModel.edit');

    Route::get('vehicleType', [App\Http\Controllers\SettingsController::class, 'vehicleType'])->name('settings.vehicleType');

    Route::get('vehicleType/create', [App\Http\Controllers\SettingsController::class, 'vehicleTypeCreate'])->name('settings.vehicleType.create');

    Route::get('vehicleType/edit/{id}', [App\Http\Controllers\SettingsController::class, 'vehicleTypeEdit'])->name('settings.vehicleType.edit');

    Route::get('promos', [App\Http\Controllers\SettingsController::class, 'promos'])->name('settings.promos');

    Route::get('promos/create', [App\Http\Controllers\SettingsController::class, 'promosCreate'])->name('settings.promos.create');

    Route::get('promos/edit/{id}', [App\Http\Controllers\SettingsController::class, 'promosEdit'])->name('settings.promos.edit');

    Route::get('app/specialOffer', [App\Http\Controllers\SettingsController::class, 'specialOffer'])->name('settings.app.specialoffer');

});

Route::get('/termsAndConditions', [App\Http\Controllers\TermsAndConditionsController::class, 'index'])->name('termsAndConditions');

Route::get('/privacyPolicy', [App\Http\Controllers\TermsAndConditionsController::class, 'privacyindex'])->name('privacyPolicy');

Route::get('/banners', [App\Http\Controllers\SettingsController::class, 'menuItems'])->name('setting.banners');

Route::get('/banners2', [App\Http\Controllers\SettingsController::class, 'menuItems2']);

Route::get('/banners/create', [App\Http\Controllers\SettingsController::class, 'menuItemsCreate'])->name('setting.banners.create');

Route::get('/banners/edit/{id}', [App\Http\Controllers\SettingsController::class, 'menuItemsEdit'])->name('setting.banners.edit');

Route::get('/brands', [App\Http\Controllers\BrandController::class, 'brand'])->name('brands');

Route::get('/brands/create', [App\Http\Controllers\BrandController::class, 'brandCreate'])->name('brands.create');

Route::get('/brands/edit/{id}', [App\Http\Controllers\BrandController::class, 'brandEdit'])->name('brands.edit');

Route::get('/homepageTemplate', [App\Http\Controllers\SettingsController::class, 'homepageTemplate'])->name('homepageTemplate');

Route::get('rentalvehicleType', [App\Http\Controllers\SettingsController::class, 'rentalvehicleType'])->name('rentalvehicleType');

Route::get('rentalvehicleType/edit/{id}', [App\Http\Controllers\SettingsController::class, 'rentalvehicleTypeEdit'])->name('rentalvehicleType.edit');

Route::get('rentalvehicleType/create', [App\Http\Controllers\SettingsController::class, 'rentalvehicleTypeCreate'])->name('rentalvehicleType.create');

Route::get('complaints', [App\Http\Controllers\SettingsController::class, 'complaints'])->name('complaints');

Route::get('complaints/edit/{id}', [App\Http\Controllers\SettingsController::class, 'complaintsEdit'])->name('complaints.edit');

Route::get('sos', [App\Http\Controllers\SettingsController::class, 'sos'])->name('sos');

Route::get('sos/edit/{id}', [App\Http\Controllers\SettingsController::class, 'sosEdit'])->name('sos.edit');

Route::get('/notification/send', [App\Http\Controllers\NotificationController::class, 'send'])->name('notification/send');

Route::get('/notification', [App\Http\Controllers\NotificationController::class, 'index'])->name('notification');

Route::post('broadcastnotification', [App\Http\Controllers\NotificationController::class, 'broadcastnotification'])->name('broadcastnotification');

Route::get('/booktable/{id}', [App\Http\Controllers\BookTableController::class, 'index'])->name('vendors.booktable');

Route::get('/booktable/edit/{id}', [App\Http\Controllers\BookTableController::class, 'edit'])->name('booktable.edit');

Route::post('/sendnotification', [App\Http\Controllers\BookTableController::class, 'sendnotification'])->name('sendnotification');

Route::get('/payoutRequests/drivers', [App\Http\Controllers\PayoutRequestController::class, 'index'])->name('payoutRequests.drivers');

Route::get('/payoutRequests/drivers/{id}', [App\Http\Controllers\PayoutRequestController::class, 'index'])->name('payoutRequests.drivers.view');

Route::get('/payoutRequests/vendor', [App\Http\Controllers\PayoutRequestController::class, 'vendor'])->name('payoutRequests.vendor');

Route::get('/payoutRequests/vendor/{id}', [App\Http\Controllers\PayoutRequestController::class, 'vendor'])->name('payoutRequests.vendor.view');

Route::get('order_transactions', [App\Http\Controllers\PaymentController::class, 'index'])->name('order_transactions');

Route::get('/order_transactions/{id}', [App\Http\Controllers\PaymentController::class, 'index'])->name('order_transactions.index');

Route::get('/orders/print/{id}', [App\Http\Controllers\OrderController::class, 'orderprint'])->name('vendors.orderprint');

Route::get('/attributes', [App\Http\Controllers\AttributeController::class, 'index'])->name('attributes');

Route::get('/attributes/edit/{id}', [App\Http\Controllers\AttributeController::class, 'edit'])->name('attributes.edit');

Route::get('/attributes/create', [App\Http\Controllers\AttributeController::class, 'create'])->name('attributes.create');

Route::get('/reviewattributes', [App\Http\Controllers\ReviewAttributeController::class, 'index'])->name('reviewattributes');

Route::get('/reviewattributes/edit/{id}', [App\Http\Controllers\ReviewAttributeController::class, 'edit'])->name('reviewattributes.edit');

Route::get('/reviewattributes/create', [App\Http\Controllers\ReviewAttributeController::class, 'create'])->name('reviewattributes.create');

Route::get('/rentaldiscount', [App\Http\Controllers\SettingsController::class, 'rentalDiscount'])->name('rentaldiscount');

Route::get('/rentaldiscount/edit/{id}', [App\Http\Controllers\SettingsController::class, 'rentalDiscountEdit'])->name('rentaldiscount.edit');

Route::get('/rentaldiscount/create', [App\Http\Controllers\SettingsController::class, 'rentalDiscountCreate'])->name('rentaldiscount.create');

Route::get('/rental_orders', [App\Http\Controllers\RentalController::class, 'rentalOrders'])->name('rental_orders');

Route::get('/rental_orders/edit/{id}', [App\Http\Controllers\RentalController::class, 'rentalOrderEdit'])->name('rental_orders.edit');

Route::get('rentalvehicle', [App\Http\Controllers\SettingsController::class, 'rentalvehicle'])->name('rentalvehicle');

Route::get('/rentalvehicle/view/{id}', [App\Http\Controllers\SettingsController::class, 'rentalVehicleView'])->name('drivers.vehicle');

Route::get('footerTemplate', [App\Http\Controllers\SettingsController::class, 'footerTemplate'])->name('footerTemplate');

Route::post('complaint_notification', [App\Http\Controllers\RideController::class, 'complaintNotification'])->name('complaint_notification');

Route::get('cms', [App\Http\Controllers\CmsController::class, 'index'])->name('cms');

Route::get('/cms/edit/{id}', [App\Http\Controllers\CmsController::class, 'edit'])->name('cms.edit');

Route::get('/cms/create', [App\Http\Controllers\CmsController::class, 'create'])->name('cms.create');
