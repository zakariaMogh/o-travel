<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_ar',
    ];


    public function offers(): hasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function countries(): belongsToMany
    {
        return $this->belongsToMany(Country::class)->withTimestamps();
    }

}
