<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_code',
        'name',
        'phone',
        'alternate_phone',
        'address',
        'type',
        'opening_balance',
        'notes',
    ];

    protected $casts = [
        'opening_balance' => 'decimal:2',
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function getTypeLabelAttribute(): string
    {
        return $this->type === 'buyer' ? 'ক্রেতা' : 'বিক্রেতা';
    }

    public function getCurrentBalanceAttribute(): float
    {
        $credit = (float) $this->transactions()->where('type', 'credit')->sum('amount');
        $debit = (float) $this->transactions()->where('type', 'debit')->sum('amount');

        return $credit - $debit + (float) $this->opening_balance;
    }
}
