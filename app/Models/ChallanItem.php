<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChallanItem extends Model
{
    use HasFactory;
    protected $fillable = [ "updated_at","created_at", 'is_in', 'product_uid', 'quantity_good', 'quantity_damaged', 'challan_uid', 'active_date_time', 'remarks' ];

    public function challan()
    {
        return $this->hasOne(Challan::class, 'uid','challan_uid');
    }
    public function product()
    {
        return $this->hasOne(Product::class, 'uid','product_uid');
    }
}
