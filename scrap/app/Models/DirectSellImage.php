<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectSellImage extends Model
{
    protected $table = 'direct_sell_images';

    protected $fillable = ['url','direct_sell_id'];

    public function directsells(){
        return $this->belongsTo(DirectSell::class,'direct_sell_id');
    }
}
