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
    public function getRelate()
    {
        return $this->hasMany(Project_creator::class,'idProject','id');
    }
    public function getTotalTimeProject()
    {
        $project_creator = Project_creator::where('idProject',$this->id)->get();
        $total=0;
        foreach($project_creator as $item)
        {
            $times= Save_time::where('idWork',$item->id)->get();
            foreach($times as $time)
            {
                $total+= $time->hour;
            }

        }
        return $total;
    }
}
