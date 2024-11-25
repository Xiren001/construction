<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompletedWork extends Model
{
    use HasFactory;

    protected $fillable = ['workload_id', 'workload_name', 'employee_name', 'checklist', 'photo'];

    /**
     * Relationship to Workload
     */
    public function workload()
    {
        return $this->belongsTo(Workload::class, 'workload_id', 'id');
    }
}
