<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportRequestItem extends Model
{
    use HasFactory;

    protected $casts = [
        'read' => 'boolean'
    ];


    protected $guarded = ['id'];
}
