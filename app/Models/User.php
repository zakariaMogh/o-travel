<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'country_code',
        'image',
        'wallet',
        'device_token',
        'state'
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
    ];
    /**
     * @var string[]
     */
    protected $appends = [
        'image_url'
    ];

    public function adminPath()
    {
        if ($this->id)
        {
            return route('admin.users.show',$this->id);
        }
        return '#';
    }

    public function getImageUrlAttribute()
    {
        if (Str::contains($this->image,'http'))
        {
            return $this->image;
        }

        return $this->image ? asset('storage/'.$this->image) : asset('assets/admin/app-assets/images/user.png');
    }

    public function comments():hasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function favorites():BelongsToMany
    {
        return $this->belongsToMany(Offer::class);
    }
}
