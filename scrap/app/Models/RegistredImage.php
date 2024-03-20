<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistredImage extends Model
{
    protected $table = 'registred_images';

    protected $fillable = ['url','registerd_sells_id'];

    public function registerdSell(){
        return $this->belongsTo(RegisterdSell::class,'registerd_sells_id');
    }
}
