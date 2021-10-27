<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'company_id',
    ];

    public function company():BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
