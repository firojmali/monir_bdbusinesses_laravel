<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challan extends Model
{
    use HasFactory;
    protected $fillable = [ "updated_at","created_at", 'is_in', 'party', 'uid', 'challan_number', 'challan_date', 'active_date_time', 'remarks'];

    public function challan_items()
    {
        return $this->hasMany(ChallanItem::class, 'challan_uid','uid');
    }
}
