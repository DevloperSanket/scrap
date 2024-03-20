<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectSell extends Model
{
    protected $table = "direct_sells";

    protected $fillable = ['name','email','number','city','pincode','category','date','time', 'image','address'];

    public function Directimage(){
        return $this->hasMany(Directimage::class,'direct_sells_id');
    }

    public function scrapcategories(){
        return $this->belongsTo(ScrapCategories::class,'category');
    } 

}
