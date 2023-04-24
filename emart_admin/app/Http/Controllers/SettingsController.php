<?php

namespace App\Http\Controllers;


class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function social()
    {
        return view("settings.app.social");
    }

    public function globals()
    {
        return view("settings.app.global");
    }

    public function notifications()
    {
        return view("settings.app.notification");
    }

    public function cod()
    {
        return view('settings.app.cod');
    }

    public function applePay()
    {
        return view('settings.app.applepay');
    }

    public function stripe()
    {
        return view('settings.app.stripe');
    }

    public function mobileGlobals()
    {
        return view('settings.mobile.globals');
    }

    public function razorpay()
    {
        return view('settings.app.razorpay');
    }

    public function paytm()
    {
        return view('settings.app.paytm');
    }

    public function paypal()
    {
        return view('settings.app.paypal');
    }

    public function adminCommission()
    {
        return view("settings.app.adminCommission");
    }

    public function radiosConfiguration()
    {
        return view("settings.app.radiosConfiguration");
    }

    public function wallet()
    {
        return view('settings.app.wallet');
    }


    public function payfast()
    {
        return view('settings.app.payfast');
    }

    public function paystack()
    {
        return view('settings.app.paystack');
    }

    public function parcelPayStack()
    {
        return view('settings.app.parcelPayStack');
    }

    public function mercadopago()
    {
        return view('settings.app.mercadopago');
    }

    public function flutterwave()
    {
        return view('settings.app.flutterwave');
    }

    public function deliveryCharge()
    {
        return view('settings.app.deliveryCharge');
    }

    public function languages()
    {
        return view('settings.languages.index');
    }

    public function languagesedit($id)
    {
        return view('settings.languages.edit')->with('id', $id);
    }

    public function languagescreate()
    {
        return view('settings.languages.create');
    }

    public function carMake()
    {
        return view('settings.carMake.index');
    }

    public function carMakeEdit($id)
    {
        return view('settings.carMake.edit')->with('id', $id);
    }

    public function carMakeCreate()
    {
        return view('settings.carMake.create');
    }

    public function carModel()
    {
        return view('settings.carModel.index');
    }

    public function carModelEdit($id)
    {
        return view('settings.carModel.edit')->with('id', $id);
    }

    public function carModelCreate()
    {
        return view('settings.carModel.create');
    }

    public function vehicleType()
    {
        return view('settings.vehicleType.index');
    }


    public function vehicleTypeEdit($id)
    {
        return view('settings.vehicleType.edit')->with('id', $id);
    }

    public function vehicleTypeCreate()
    {
        return view('settings.vehicleType.create');
    }

    public function rentalvehicleType()
    {
        return view('rentalvehicleType.index');
    }

    public function rentalvehicleTypeEdit($id)
    {
        return view('rentalvehicleType.edit')->with('id', $id);
    }

    public function rentalvehicleTypeCreate()
    {
        return view('rentalvehicleType.create');
    }

    public function promos()
    {
        return view('settings.promos.index');
    }

    public function promosEdit($id)
    {
        return view('settings.promos.edit')->with('id', $id);
    }

    public function promosCreate()
    {
        return view('settings.promos.create');
    }

    public function complaints()
    {
        return view('complaints.index');
    }

    public function complaintsEdit($id)
    {
        return view('complaints.edit')->with('id', $id);

    }

    public function sos()
    {
        return view('sos.index');
    }

    public function sosEdit($id)
    {
        return view('sos.edit')->with('id', $id);

    }

    public function specialOffer()
    {
        return view('settings.app.specialDiscountOffer');
    }

    public function menuItems()
    {
        return view('settings.menu_items.index');
    }
    public function menuItems2(){
        return view('settings.menu_items.index_newbackup');
    }
    public function menuItemsCreate()
    {
        return view('settings.menu_items.create');
    }

    public function menuItemsEdit($id)
    {
        return view('settings.menu_items.edit')->with('id', $id);
    }

    public function rentalDiscount()
    {
        return view('rentalDiscount.index');
    }

    public function rentalDiscountEdit($id)
    {
        return view('rentalDiscount.edit')->with('id', $id);
    }

    public function rentalDiscountCreate()
    {
        return view('rentalDiscount.create');
    }

    public function homepageTemplate()
    {
        return view('homepage_Template.index');
    }

    public function rentalPayStack()
    {
        return view('settings.app.rentalPayStack');
    }

    public function rentalvehicle()
    {
        return view('rentalVehicle.index');
    }

    public function rentalVehicleView($id)
    {
        return view('rentalVehicle.view')->with('id', $id);
    }

    public function footerTemplate()
    {
        return view('footerTemplate.index');
    }

}
