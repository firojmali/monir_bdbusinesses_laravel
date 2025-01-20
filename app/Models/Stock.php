<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        "updated_at","created_at", "product_uid","quantity_good", "quantity_damaged", "opening_quantity_good", "opening_quantity_damaged", "challan_uids", 'opening_date', "remarks"
    ];
}
