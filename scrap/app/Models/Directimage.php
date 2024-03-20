<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directimage extends Model
{
    protected $table = 'directimages';

    protected $fillable = ['url','direct_sells_id'];

    public function Directsell(){
        return $this->belongsTo(Directsell::class,'direct_sells_id');
    }
}
