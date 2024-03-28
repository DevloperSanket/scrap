<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = 'drivers';

    protected $fillable = ['name','mobile'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function registeredSells() 
    {
        return $this->hasMany(RegisterdSell::class, 'driver');
    }
}
