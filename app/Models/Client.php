<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'date_of_birth', 'sex', 'marital_status', 
        'nationality', 'address_home', 'address_office', 'heart_disease', 
        'kidney_problems', 'liver_problems', 'lung_problems', 'asthma', 
        'allergies', 'allergy_details', 'prolonged_bleeding', 'blood_disease', 
        'blood_disease_name', 'high_blood_pressure', 'takes_medication', 
        'pregnant', 'diabetic', 'person_responsible_expenses', 'visited_dentist', 
        'referral_source'
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'client_service');
    }
}
