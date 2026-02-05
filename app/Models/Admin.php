<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable { 
    protected $fillable = ['username', 'email', 'password']; 
    
    public function dashboardUrl() {
    return route('admin.dashboard');
    }
    
    public function getRoleAttribute() {
    return 'admin'; 
    }
}

