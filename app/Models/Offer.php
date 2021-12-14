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
        'state',
        'link',
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
        'featured' => 'integer',
        'state' => 'integer',
    ];


    public function getUserFavoriteByMeAttribute()
    {
        return $this->auth_user_count > 0;
    }

    public function getCompanyFavoriteByMeAttribute()
    {
        return $this->auth_company_count > 0;
    }


    public function scopePublished($query)
    {
        return $query->whereState(2);
    }

    public function scopeAuthCompany($query)
    {
        return $query->where('company_id', company()->id);
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

    public function authUser(): BelongsToMany
    {
        return $this->users()->where('users.id',auth('user')->id());
    }

    public function authCompany(): BelongsToMany
    {
        return $this->companies()->where('companied.id',auth('company')->id());
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

}
