<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // Define the fillable properties to allow mass assignment
    protected $fillable = ['category', 'service_name', 'price_min', 'price_max'];

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_service');
    }
}
