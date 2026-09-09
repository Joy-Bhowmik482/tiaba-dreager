<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_code',
        'name',
        'phone',
        'alternate_phone',
        'address',
        'position',
        'salary',
        'joining_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'salary' => 'decimal:2',
        'joining_date' => 'date',
    ];

    public function getStatusLabelAttribute(): string
    {
        return $this->status === 'active' ? 'সক্রিয়' : 'নিষ্ক্রিয়';
    }
}
