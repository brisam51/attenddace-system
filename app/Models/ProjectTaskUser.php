<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjecttaskUser extends Model
{
    protected $table = 'project_task_user';

 

    protected $fillable = [
        'user_id',
        'project_id',
        'task_id',
       'file_contract'
    ];

   //Deefine relationship with user
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    //Define relationship with project
    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    //Define relationship with task detail
    public function taskDetail()
    {
        return $this->belongsTo('App\Models\task');

}
public static function  projectMemebers($project_id){
    $project_members=ProjecttaskUser::select('project_task_user.*','users.national_id as nationalCode','users.image as image','users.first_name as firstName','users.last_name as lastName',
    'tasks.title as taskTitle','project_task_user.file_contract as fileContract')
    ->join('users','users.id','=','project_task_user.user_id')
    ->join('tasks','tasks.id','=','project_task_user.task_id')
    ->where('project_task_user.project_id','=',$project_id)
   
    ->get();
    return $project_members;
}
public static function  finSingleMemeber($id){
    $singleMember=ProjecttaskUser::select('project_task_user.*','users.national_id as nationalCode','users.image as image','users.first_name as firstName','users.last_name as lastName',
    'tasks.title as taskTitle')
    ->join('users','users.id','=','project_task_user.user_id')
    ->join('tasks','tasks.id','=','project_task_user.task_id')
    ->where('project_task_user.id','=',$id)
    ->first();
    return $singleMember;
}
}
