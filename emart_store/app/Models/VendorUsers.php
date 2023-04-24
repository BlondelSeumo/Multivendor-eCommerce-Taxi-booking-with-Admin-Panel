<?php
/**
 * File name: VendorUser.php
 * Last modified: 2020.06.11 at 16:10:52
 * Copyright (c) 2020
 */

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 * @package App\Models
 * @version July 10, 2018, 11:44 am UTC
 *
 * @property \App\Models\Cart[] cart
 * @property string name
 * @property string email
 * @property string password
 * @property string api_token
 * @property string device_token
 */
class VendorUsers extends Authenticatable
{
    // use Notifiable;
    // use Billable;
    // use HasMediaTrait {
    //     getFirstMediaUrl as protected getFirstMediaUrlTrait;
    // }
    // use HasRoles;

    /**
     * Validation rules
     *
     * @var array
     */

    public $table = 'vendor_users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    /* public function getFirstMediaUrl($collectionName = 'default', $conversion = '')
    {
        $url = $this->getFirstMediaUrlTrait($collectionName);
        if ($url) {
            $array = explode('.', $url);
            $extension = strtolower(end($array));
            if (in_array($extension, config('medialibrary.extensions_has_thumb'))) {
                return asset($this->getFirstMediaUrlTrait($collectionName, $conversion));
            } else {
                return asset(config('medialibrary.icons_folder') . '/' . $extension . '.png');
            }
        }else{
            return asset('images/avatar_default.png');
        }
    } */
}
