<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'balance',
        'customer_id',
        'address1',
        'address2',
        'city',
        'state',
        'zip'
    ];

    protected $casts = ['balance' => 'decimal:2'];

    /** RELATIONS */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
