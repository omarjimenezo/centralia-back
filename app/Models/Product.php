<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['sku','code','description','price','category','exist','visible'];

    public function user() {
        return $this->belongsTo(User::class);
    }    
}
