<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customerCards extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_number',
        'balance',
        'customer_id',
    ];
}
