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

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function registerdsell(){
        return $this->hasMany(RegisterdSell::class);
    }

    public function Directsell(){
        return $this->hasMeny(Directsell::class);
    }
}
