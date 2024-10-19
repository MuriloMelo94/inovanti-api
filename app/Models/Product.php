<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'status'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
