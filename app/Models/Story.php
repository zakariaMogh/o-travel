<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Story extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'video',
        'type',
        'meta',
        'views',
        'company_id',
        'state'
    ];

    protected $appends = [
        'image_url'
    ];

    protected $with = [
        'company'
    ];

    /**
     * @return mixed|string|void
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image)
        {
            return;
        }

        return  Str::contains($this->image,'http')
            ? $this->image
            : asset('storage/'.$this->image);
    }

    public function scopeVisible($query)
    {
        $query->whereState(1);
    }

    public function scopeActive($query)
    {
        $query->whereDate('created_at','>',now()->subDays(1));
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
