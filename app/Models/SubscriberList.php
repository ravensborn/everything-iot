<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriberList extends Model
{
    use HasFactory;

    protected $table = 'subscriber_list';

    protected $guarded = ['id'];
}
