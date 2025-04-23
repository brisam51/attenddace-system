<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Attendance extends Model
{
    //fillable fields
    protected $fillable = [
        'user_id',
        'project_id',
        'work_date',
        'task_id',
        'start_time',
        'end_time',
        'total_time',
        'created_by',
        'updated_by'
    ];
    //table name
    protected $table = 'attendances';

    //user relationship
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    //project relationship
    public function projects()
    {
        return $this->belongsTo('App\Models\Project');
    }

    //get attendance details by user and project
    public  static function getAttendanceDetails($user_id, $project_id, $task_id)
    {
        $attendanceDetails = Attendance::select(
            'attendances.*',
            'users.first_name as firstName',
            'users.last_name as lastName',
            'users.id as userId',
            'projects.title as projectTitle',
            'projects.id as projectId',
            'tasks.title as taskTitle',
            'tasks.id as taskId'
        )

            ->join('projects', 'projects.id', '=', 'attendances.project_id')
            ->join('tasks', 'tasks.id', '=', 'attendances.task_id')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->where('attendances.project_id', '=', $project_id)
            ->where('attendances.task_id', '=', $task_id)
            ->where('attendances.user_id', '=', $user_id)
            ->get();
        return $attendanceDetails;
    }

    public function tasks()
    {
        return $this->belongsTo(Task::class)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('project_task_user')
                    ->whereColumn('project_task_user.task_id', '=', 'tasks.id')
                    ->whereColumn('project_task_user.user_id', '=', 'attendances.user_id')
                    ->whereColumn('project_task_user.project_id', '=', 'attendances.project_id');
            });
    }
}//end class
