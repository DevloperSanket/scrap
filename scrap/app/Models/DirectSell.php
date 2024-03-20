<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectSell extends Model
{
    protected $table = "direct_sells";

    protected $fillable = ['name','email','number','city','pincode','scraptype','date','time', 'image','address'];


    public function directsellimage(){
        return $this->hasMany(DirectSellImage::class, 'direct_sell_id');
    }

    // public function scrapCategory()
    // {
    //     return $this->belongsTo(ScrapCategories::class, 'scraptype');
    // }

}
