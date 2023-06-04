<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_creator extends Model
{
    use HasFactory;
    protected $fillable=['idProject','idCreator'];
    public function getCreator()
    {
        return $this->belongsTo(User::class, 'idCreator');
    }
    public function getProject()
    {
        return $this->belongsTo(Project::class,'idProject');
    }
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
