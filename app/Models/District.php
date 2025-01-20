<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $fillable = [ "updated_at","created_at", 'division_id', 'division_code', 'code', 'bn_name', 'en_name', 'code_id'];

    public function upazilas()
    {
        return $this->hasMany(Upazila::class, 'district_code','code');
    }
    public function division()
    {
        return $this->hasOne(Division::class, 'code', 'division_code');
    }
}
