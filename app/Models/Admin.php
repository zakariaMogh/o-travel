<?php

namespace App\Models;

//use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Model
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'pic',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'image_url'
    ];

    public function getImageUrlAttribute()
    {
        if (Str::contains($this->pic,'http'))
        {
            return $this->pic;
        }

        return $this->pic
            ? asset('storage/'.$this->pic)
            : asset('assets/admin/app-assets/images/user.png');
    }

//    /**
//     * @param $token
//     */
//    public function sendPasswordResetNotification($token): void
//    {
//        $this->notify(new AdminResetPasswordNotification($token));
//    }
}
