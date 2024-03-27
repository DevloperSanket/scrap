<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterdSell extends Model
{
    protected $table = 'registerd_sells';

    protected $fillable = ['date', 'time', 'category', 'status', 'driver', 'user_id'];

    public function registredImages()
    {
        return $this->hasMany(RegistredImage::class, 'registerd_sells_id');
    }

    public function scrapcategories()
    {
        return $this->belongsTo(ScrapCategories::class, 'category');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver');
    }

    // public function registereduserdata()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
