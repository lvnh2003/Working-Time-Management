<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    
    protected $table='projects',$fillable = ['name','idClient'];
    public function getClient()
    {
        return $this->hasOne(User::class,'id','idClient');
    }
}
