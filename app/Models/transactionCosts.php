<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transactionCosts extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_cost',
        'transaction_id',
        'card_id',
    ];
}
