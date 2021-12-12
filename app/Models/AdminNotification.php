<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminNotification extends Model
{
    use HasFactory;


    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'message',
        'image',
        'receivers',
    ];


}
