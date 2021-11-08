<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'category_id',
        'featured',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    public function images(): hasMany
    {
        return $this->hasMany(Image::class);
    }

    public function category(): belongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function company(): belongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function countries(): belongsToMany
    {
        return $this->belongsToMany(Country::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

}
