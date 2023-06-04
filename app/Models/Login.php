<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function getUser()
    {   
        return $this->hasOne(User::class,'id','idUser');
    }
}
