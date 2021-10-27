<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function company(): HasOne
    {
        return $this->HasOne(Company::class);
    }
}
