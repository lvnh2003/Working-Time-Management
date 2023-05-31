<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Login extends User
{
    use HasFactory;
    protected $table= 'logins';
    protected $fillable=[
        'email',
        'password',
        'idUser',
        'role',
        'isActive',
    ];
}
