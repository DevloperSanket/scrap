<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorRecord extends Model
{
    protected $table = 'doctor_records'; // Specify the table name
    protected $fillable = [
        'name', 'email', 'contact', 'city', 'pincode', 'address', 'description','status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
