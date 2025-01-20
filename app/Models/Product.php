<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Product extends Model
{
    use HasFactory;    
    protected $fillable = ["updated_at","created_at",  'uid', 'type', 'name', 'description', 'unit_uid', 'is_complete', 'is_saleable', 'entry_by', 'changes' ];


    public function unit()
    {
        return $this->hasOne(Unit::class, 'uid','unit_uid');
    }

    public function stock(){
        return $this->hasOne(Stock::class, 'product_uid', 'uid');
    }
     
}
