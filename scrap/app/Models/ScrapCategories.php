<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScrapCategories extends Model
{

    protected $table = 'scrap_categories';

    protected $fillable = ['name'];
    
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
