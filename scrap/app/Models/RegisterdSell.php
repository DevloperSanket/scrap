<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterdSell extends Model
{
    protected $table = 'registerd_sells';

    protected $fillable = ['date','time','category','status','driver'];

    public function registredimages(){
        return $this->hasMany(RegistredImage::class,'registerd_sells_id');
    }
}
