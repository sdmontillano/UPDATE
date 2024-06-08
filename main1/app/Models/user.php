<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'tbluser';

    public $timestamps = false;

    // Columns in the table
    protected $fillable = [
        'username', 
        'password',
        'gender' // Include 'gender' field
    ];
}
