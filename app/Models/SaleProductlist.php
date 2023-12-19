<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleProductlist extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id','category_id', 'qty','unit','small_package',  'price', 'shop_id', 'Date'];
}
