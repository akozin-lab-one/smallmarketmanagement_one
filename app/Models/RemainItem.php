<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemainItem extends Model
{
    use HasFactory;

    protected $fillable = ['product_name', 'category_name', 'qty', 'shop_name','user_id', 'date'];
}
