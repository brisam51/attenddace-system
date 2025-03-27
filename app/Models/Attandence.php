<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //fillable fields
   protected $fillable =['user_id','project_id','start_date','end_date','start_time',
   'end_time','total_hours','status','created_by','updated_by'];
   //table name
   protected $table = 'attendance';

   //user relationship
   public function user(){
       return $this->belongsTo('App\Models\User');
   }    
   //project relationship
   public function project(){
       return $this->belongsTo('App\Models\Project');
   }

   //attendance on projects active and useris me    ber
   
}
