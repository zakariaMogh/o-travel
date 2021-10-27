<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class Company extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'country_code',
        'image',
        'wallet',
        'device_token',
        'state',
        'checked',
        'facebook', 'whatsapp', 'snapchat', 'instagram', 'twitter',
        'trade_register',
        'rate',
        'latitude', 'longitude', 'address',
        'city_id',
        'domain_id',

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
        'checked' => 'integer',
    ];

    /**
     * @var string[]
     */
    protected $appends = [
        'image_url','trade_register_url'
    ];

    public function adminPath()
    {
        if ($this->id)
        {
            return route('admin.companies.show',$this->id);
        }
        return '#';
    }

    public function getImageUrlAttribute()
    {
        if (Str::contains($this->image,'http'))
        {
            return $this->image;
        }

        return $this->image
            ? asset('storage/'.$this->image)
            : asset('assets/admin/app-assets/images/user.png');
    }

    public function getTradeRegisterUrlAttribute()
    {
        if (Str::contains($this->trade_register,'http'))
        {
            return $this->trade_register;
        }

        return $this->trade_register
            ? asset('storage/'.$this->trade_register)
            : asset('assets/admin/app-assets/images/user.png');
    }

    public function city(): belongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function domain(): belongsTo
    {
        return $this->belongsTo(Domain::class);
    }

    public function comments():hasMany
    {
        return $this->hasMany(Comment::class);
    }

}
