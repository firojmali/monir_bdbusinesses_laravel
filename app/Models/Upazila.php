<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
    use HasFactory;
    protected $fillable = [ "updated_at","created_at", 'district_id', 'district_code', 'code', 'bn_name', 'en_name', 'code_id', 'district_code_id'];

    public function unions()
    {
        return $this->hasMany(Union::class, 'upazila_code_id','code_id');
    }
    public function district()
    {
        return $this->hasOne(District::class, 'code', 'district_code');
    }
}
