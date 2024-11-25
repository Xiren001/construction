<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanceledWorkload extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'employee_id',
        'services',
    ];

    // Cast 'services' as an array
    protected $casts = [
        'services' => 'array',
    ];
}
