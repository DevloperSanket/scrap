<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pincode extends Model
{
    protected $table = 'pincodes';

    protected $fillable = ['city', 'area', 'pincode'];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
