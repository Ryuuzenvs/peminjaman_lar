<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    //
    protected $fillable = [
    'nama_kategori'   
    ];

// Di dalam class Tool
public function tools() {
    return $this->hasMany(tool::class);

}
}


