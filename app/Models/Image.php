<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'link',
        'offer_id'
    ];

    /**
     * @var string[]
     */
    protected $appends = [
        'url'
    ];

    public function getUrlAttribute()
    {
        if (Str::contains($this->link,'http'))
        {
            return $this->link;
        }

        return $this->link
            ? asset('storage/'.$this->link)
            : null;
    }

    public function offer(): belongsTo
    {
        return $this->belongsTo(Offer::class);
    }
}
