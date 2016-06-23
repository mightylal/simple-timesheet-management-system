<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * Table name to be used.
     */
    protected $table = 'appUser';

    /**
     * Fillable attributes for mass assignment.
     */
    protected $fillable = ['username', 'password', 'regularRate', 'overtimeRate'];
}
