<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
   //fillables fields are fields that can be mass assigned 
    protected $fillable=[
    'name','gender','DOB','application_date','nationality','cv','hr_coordintor_status','hr_manager_status','coorditor_id','manager_id'
    ];
}
