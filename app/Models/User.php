<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    protected $table='users';
    protected $fillable=[
        'email',
        'activeToken',
        'name',
        'image'
    ];
    public function login()
    {
        return $this->hasOne(Login::class,'idUser','id');
    }
    public function getProject()
    {
        return $this->hasMany(Project::class,'idClient','id');
    }
    public function getAvatar()
    {
        return asset('storage/users-avatar').'/'.$this->image;
    }
    public function getProjectOfCreator()
    {
        return $this->hasMany(Project_creator::class,'idCreator','id');
    }
    public function getTotalTime($idProject)
    {
       $relate= Project_creator::where('idProject',$idProject)->where('idCreator',$this->id)->get();
       $total=0;
       foreach($relate as $item)
       {
        $total+=$item->getTime();
       }
       return $total;
    }
}
