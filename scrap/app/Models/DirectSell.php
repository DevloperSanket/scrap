<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectSell extends Model
{
    protected $table = "direct_sells";

    protected $fillable = ['name','email','number','city','pincode','scraptype','date','time', 'image','address'];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
