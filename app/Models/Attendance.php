<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //fillable fields
    protected $fillable = [
        'user_id',
        'project_id',
        'work_date',
        'start_time',
        'end_time',
        'total_time',
        'created_by',
        'updated_by'
    ];
    //table name
    protected $table = 'attendance';

    //user relationship
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    //project relationship
    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    //get attendance details by user and project
    public  static function getAttendanceDetails($user_id, $project_id)
    {
        $attendanceDetails = Attendance::select('Attendance.*', 'users.first_name as fisrtName', 'users.last_name as lastName', 'users.image as userImage','projects.title as projectTitle')
            ->join('users', 'users.id', '=', $user_id)
            ->join('projects', 'projects.id', '=', $project_id)
            ->where('Attendance.user_id', '=', $user_id)
            ->where('Attendance.project_id', '=', $project_id)->get();
        return $attendanceDetails;
    }
}
