<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleList extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','name', 'qty', 'unit', 'price', 'total_cost'];
}
