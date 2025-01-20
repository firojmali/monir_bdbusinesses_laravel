<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $fillable = [ "updated_at","created_at", 'code', 'bn_name', 'en_name', 'code_id'];

    public function districts()
    {
        return $this->hasMany(District::class, 'division_code','code');
    }
}
