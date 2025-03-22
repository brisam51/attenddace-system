<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $fillable = ["title", "description", "start_date", "end_date", "status"];
    //Define relationship to User model via ProjectJobUser model
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_job_user', 'project_id', 'user_id')
            ->withPivot('job_detail_id', 'file_contract');
    }
    //Define relationship to JobDetail model via ProjectJobUser model
    public function jobDetail(){
        return $this->belongsToMany(JobDetails::class,'project_job_user','project_id','job_detail_id')
        ->withPivot('user_id','file_contract');
    }
}
