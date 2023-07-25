<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProfile extends Model
{
    use SoftDeletes;
    protected $connection = 'phf';
    protected $table = 'user_profiles';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id','father_name', 'gender','date_of_birth','cnic','cnic_expiry','marital_status','domicile','city_of_residence','address','profile_image',
        'domicile_image','cnic_front_image','cnic_back_image','pnc_certificate_image'
    ];
}

