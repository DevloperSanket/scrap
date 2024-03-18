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

    public function scrapCategories()
    {
        return $this->belongsTo(ScrapCategories::class, 'category_id');
    }
}
