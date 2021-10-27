<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'link',
        'offer_id'
    ];

    public function offer(): belongsTo
    {
        return $this->belongsTo(Offer::class);
    }
}
