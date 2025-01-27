<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserArea extends Model
{
    use HasFactory;
    protected $fillable = [ 'user_uid', "updated_at","created_at", 'district_code', 'district_code', 'upazila_code'
    , 'union_code', 'area_name', 'region_type', 'created_by_user_uid'
];

}
