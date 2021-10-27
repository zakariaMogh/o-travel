<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'rate',
        'date',
        'published_at',
        'company_id',
        'category_id'
    ];
}
