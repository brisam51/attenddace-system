<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
   protected $fillable =[
    'hourly_wage','task_code','title','description'
   ];

//Define realtionship to User model via ProjectTaskUser
public function users(){
    return $this->belongsToMany(User::class,'Project_task_user','task_id')

    ->withPivot('project_id','file_contract');
}

//Define relationship to Project model via ProjectTaskUser
public function projects(){
    return $this->belongsToMany(Project::class,'Project_task_user','task_id')
    ->withPivot('user_id','file_contract');
}



   
}//end class
