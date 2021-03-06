<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_ar',
        'longitude',
        'latitude'
    ];


    public function offers(): belongsToMany
    {
        return $this->belongsToMany(Offer::class);
    }

    public function categories(): belongsToMany
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
}
