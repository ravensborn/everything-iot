<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCodeUser extends Model
{
    use HasFactory;


    protected $table = 'promo_code_user';

    protected $guarded = [
        'id'
    ];



}
