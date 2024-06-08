<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'table';

    public $timestamps = false;

    // Columns in the table
    protected $fillable = [
        'username', 
        'password',
        'gender' // Include 'gender' field
    ];
}
