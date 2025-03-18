<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobDetails extends Model
{
    protected $table = 'job_details';
   protected $fillable =[
    'hourly_wages','job_code','job_title','job_description'
   ];
   
}