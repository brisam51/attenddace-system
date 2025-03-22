<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectJobUser extends Model
{
    protected $table = 'project_job_user';

 

    protected $fillable = [
        'user_id',
        'project_id',
        'job_detail_id',
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

    //Define relationship with job detail
    public function jobDetail()
    {
        return $this->belongsTo('App\Models\JobDetails');

}
public static function  projectMemebers($project_id){
    $project_members=ProjectJobUser::select('project_job_user.*','users.national_id as nationalCode','users.image as image','users.first_name as firstName','users.last_name as lastName',
    'job_details.job_title as jobTitle','project_job_user.file_contract as fileContract')
    ->join('users','users.id','=','project_job_user.user_id')
    ->join('job_details','job_details.id','=','project_job_user.job_detail_id')
    ->where('project_job_user.project_id','=',$project_id)
    ->get();
    return $project_members;
}
public static function  finSingleMemeber($id){
    $singleMember=ProjectJobUser::select('project_job_user.*','users.national_id as nationalCode','users.image as image','users.first_name as firstName','users.last_name as lastName',
    'job_details.job_title as jobTitle')
    ->join('users','users.id','=','project_job_user.user_id')
    ->join('job_details','job_details.id','=','project_job_user.job_detail_id')
    ->where('project_job_user.id','=',$id)
    ->first();
    return $singleMember;
}
}
