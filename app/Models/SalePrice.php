<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalePrice extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'user_id','sale_price'];
}
