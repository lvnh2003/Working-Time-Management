<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_Creator extends Model
{
    use HasFactory;
    protected $table = 'project_creators';
    protected $fillable=['idProject','idCreator'];
    // get creator with foreign key idCreator
    public function getCreator()
    {
        return $this->belongsTo(User::class, 'idCreator');
    }
    // get Project with foreign key idProject
    public function getProject()
    {
        return $this->belongsTo(Project::class,'idProject');
    }
    // get total time of creator with idWork, idWork is id of column have a idCreator and idProject 
    public function getTime()
    {
       $times=  $this->hasMany(Save_time::class,'idWork','id')->get();
       $total=0;
       foreach($times as $time)
       {
        $total+=$time->hour;
       }
       return $total;
    }
}
