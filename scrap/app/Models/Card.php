<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = "cards";

    protected $fillable = ['category_id', 'image','price','status'];

    public function user(){
        return $this->belongsTo(User::class);
    }


    // public function ScrapCategories() // Corrected method name
    // {
    //     return $this->belongsTo(ScrapCategories::class);
    // }

    public function scrapCategories() // Corrected method name
    {
        return $this->belongsTo(ScrapCategories::class, 'category_id');
    }
}
