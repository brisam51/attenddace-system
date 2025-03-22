<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobDetails extends Model
{
    protected $table = 'job_details';
   protected $fillable =[
    'hourly_wages','job_code','job_title','job_description'
   ];

//Define realtionship to User model via ProjectJobUser
public function users(){
    return $this->belongsToMany(User::class,'Project_job_user','job_detail_id','user_id')

    ->withPivot('project_id','file_contract');
}

//Define relationship to Project model via ProjectJobUser
public function projects(){
    return $this->belongsToMany(Project::class,'Project_job_user','job_detail_id','project_id')
    ->withPivot('user_id','file_contract');
}
}
