<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function category(){
        return  $this->belongsToMany(Category::class,ItemCategory::class);
    }
    
    public function language(){
        return  $this->belongsTo(Language::class);
    }
}
