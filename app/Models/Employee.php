<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees'; // Explicitly defining the table

    // Fields that can be mass assigned
    protected $fillable = [
        'name',
        'email',
        'position',
    ];
}