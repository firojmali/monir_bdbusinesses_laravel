<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
    use HasFactory;

    protected $fillable = [ "updated_at","created_at", 'upazila_id', 'upazila_code_id', 'code_id', 'bn_name', 'en_name'];

    
    public function upazila()
    {
        return $this->hasOne(Upazila::class, 'code_id', 'upazila_code_id');
    }
}
