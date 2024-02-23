<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class TeamMember extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'is_visible' => 'boolean',
        'links' => 'array'
    ];
}
