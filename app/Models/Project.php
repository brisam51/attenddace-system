<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $fillable = ["title", "description", "start_date", "end_date", "status"];
    //Define relationship to User model via ProjectTaskUser model
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_task_user', 'project_id', 'user_id')
            ->withPivot('task_id', 'file_contract');
    }
    //Define relationship to taskDetail model via ProjectTaskUser model
    public function taskDetail(){
        return $this->belongsToMany(task::class,'project_task_user','project_id','task_id')
        ->withPivot('user_id','file_contract');
    }
    //attendance relationship
    public function attendance(){
        return $this->hasMany(Attendance::class,'project_id');
    }
}
