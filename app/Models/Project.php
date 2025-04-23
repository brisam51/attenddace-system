<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Aap\Http\Models\PaymentDetails;
use App\Models\PaymentDetails as ModelsPaymentDetails;

class Project extends Model
{

    protected $fillable = ["title", "description", "start_date", "end_date", "status"];
    //Define relationship to User model via ProjectTaskUser model
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_task_user', 'project_id', 'user_id')
            ->withPivot('task_id', 'file_contract');
    }
    public function tasks(){
        return $this->belongsToMany(Task::class,'project_task_user','project_id','task_id')
        ->withPivot('user_id','file_contract');
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
    public function payment_details(){
        return $this->hasMany(ModelsPaymentDetails::class,'project_id');
    }

    //get active projects based on status and user ID
    public static function getActiveProjects($id){
$fireProjects = Project::select('projects.*','users.id as userId',
'tasks.title as taskTitle','tasks.id as taskId'  )
->join('project_task_user', 'project_task_user.project_id', '=', 'projects.id')
->join('users', 'users.id', '=', 'project_task_user.user_id')
->join('tasks', 'tasks.id', '=', 'project_task_user.task_id')
->where('project_task_user.user_id','=',$id)
->where('projects.status','=',0)
->get();
return $fireProjects;
    }
}
