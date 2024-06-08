<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = '4';

    public $timestamps = false;

    // Columns in the table
    protected $fillable = [
        'username', 
        'password',
        'email' 
    ];
}
