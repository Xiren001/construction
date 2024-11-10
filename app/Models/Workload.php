<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workload extends Model
{
    use HasFactory;

    // app/Models/Workload.php
    protected $fillable = ['name', 'email', 'employee_id', 'client_id', 'status'];


    protected $casts = [
        'services' => 'array',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // app/Models/Workload.php
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_workload', 'workload_id', 'service_id');
    }
}
