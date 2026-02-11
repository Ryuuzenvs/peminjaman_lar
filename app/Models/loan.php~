<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class loan extends Model
{
    //
    protected $fillable = [
    'borrower_id',   
    'tool_id',
    'approved_by',   
    'loan_date',
    'penalty',
    'return_date',
    'status',
];

// Relasi to borrower
public function borrower() {
    return $this->belongsTo(User::class, 'borrower_id'); 
}

public function approver() {
    return $this->belongsTo(User::class, 'approved_by'); 
}

public function tool() {
    return $this->belongsTo(tool::class, 'tool_id');
}
}
