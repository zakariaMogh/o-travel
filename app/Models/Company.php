<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class Company extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'country_code',
        'codeC',
        'image',
        'wallet',
        'device_token',
        'state',
        'auto_accepted',
        'story_state',
        'checked',
        'facebook', 'whatsapp', 'snapchat', 'instagram', 'twitter',
        'trade_register',
        'rate',
        'latitude', 'longitude', 'address',
        'city_id',
        'domain_id',
        'description',
        'max_number_of_offers',
        'SML_visibility',
        'website'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'checked' => 'boolean',
        'state' => 'integer',
        'story_state' => 'integer',
    ];

    /**
     * @var string[]
     */
    protected $appends = [
        'image_url', 'trade_register_url', 'full_phone', 'offers_count',
    ];

    public function adminPath()
    {
        if ($this->id) {
            return route('admin.companies.show', $this->id);
        }
        return '#';
    }

    public function getImageUrlAttribute()
    {
        if (Str::contains($this->image, 'http')) {
            return $this->image;
        }

        return $this->image
            ? asset('storage/' . $this->image)
            : asset('assets/admin/app-assets/images/user.png');
    }

    public function getFullPhoneAttribute()
    {
        return $this->country_code . ' ' . $this->phone;
    }

    public function getOffersCountAttribute()
    {
        return $this->offers()->where('featured', 1)->count();
    }

    public function getTradeRegisterUrlAttribute()
    {
        if (Str::contains($this->trade_register, 'http')) {
            return $this->trade_register;
        }

        return $this->trade_register
            ? asset('storage/' . $this->trade_register)
            : asset('');
    }

    public function scopeNotApproved($query)
    {
        $query->where('trade_register', '<>', null)->where('checked', false);
    }

    public function scopeHasActiveStories($query)
    {
        $query->whereHas('stories', function ($q) {
            $q->scopes(['active', 'visible']);
        });
    }

    public function city(): belongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function domain(): belongsTo
    {
        return $this->belongsTo(Domain::class);
    }

    public function offers(): hasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function comments(): hasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function reports(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    public function stories(): HasMany
    {
        return $this->hasMany(Story::class);
    }

    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Offer::class);
    }
}
