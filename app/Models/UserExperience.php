<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserExperience extends Model
{
    use SoftDeletes;
    protected $connection = 'phf';
    protected $table = 'user_experience';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id','organization_type', 'organization_name','position_title','from_date','to_date','is_working','certificate','noc'
    ];
}
