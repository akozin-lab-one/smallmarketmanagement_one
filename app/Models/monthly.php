<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class monthly extends Model
{
    use HasFactory;

    protected $fillable = ['month', 'most_sale_item', 'total'];
}
