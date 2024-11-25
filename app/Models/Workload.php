<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workload extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'employee_id',
        'status',
        'hidden',
    ];

    protected $casts = [
        'services' => 'array',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    // In Workload model
    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_workload', 'workload_id', 'service_id');
    }

    public function completedWork()
    {
        return $this->hasOne(CompletedWork::class, 'workload_id');
    }

    public function completedWorks()
    {
        return $this->hasMany(CompletedWork::class, 'workload_id', 'id');
    }
}
