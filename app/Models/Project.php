<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects', $fillable = ['name', 'idClient', 'finished'];
    // get client who manage this project
    public function getClient()
    {
        return $this->hasOne(User::class, 'id', 'idClient');
    }
    // this function in order to get all the creator is joined
    public function getRelate()
    {
        return $this->hasMany(Project_Creator::class, 'idProject', 'id');
    }
    // total time of this project
    public function getTotalTimeProject()
    {
        $Project_Creator = Project_Creator::where('idProject', $this->id)->get();
        $total = 0;
        foreach ($Project_Creator as $item) {
            $times = Save_time::where('idWork', $item->id)->get();
            foreach ($times as $time) {
                $total += $time->hour;
            }
        }
        return $total;
    }
}
