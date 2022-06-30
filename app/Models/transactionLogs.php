<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transactionLogs extends Model
{
    use HasFactory;

    protected $fillable = [
        'original_card_number',
        'destination_card_number',
        'payment_value',
        'reference_id',
    ];
}
