<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tool extends Model
{
    //
protected $fillable = [
        'category_id',
        'name_tools',
        'stock',
'condition'
    ];

// Di dalam class Tool
public function category() {
    return $this->belongsTo(Category::class);
}

}


