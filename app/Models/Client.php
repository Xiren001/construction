<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'address_home'
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'client_service');
    }
}
