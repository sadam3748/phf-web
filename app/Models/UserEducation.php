<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserEducation extends Model
{
    use SoftDeletes;
    protected $connection = 'phf';
    protected $table = 'user_education';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id','education_level', 'obtain_marks','institute','passing_date','degree_image'
    ];

}
