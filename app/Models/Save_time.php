<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Save_time extends Model
{
    use HasFactory;
    protected $fillable=['hour','title','start_date','end_date','idWork'];
    // get atributes of column has idWork
    public function getRelate()
    {
        return $this->hasOne(Project_Creator::class, 'id','idWork');
    }
}
