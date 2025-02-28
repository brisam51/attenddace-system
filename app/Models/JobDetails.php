<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobDetails extends Model
{
    protected $table = 'job_details';
   protected $fillable =[
    'user_id','job_title','job_description','job_insurance_code','date_employment'
   ];
   public function user(){
    return $this->belongsTo(User::class);
   }
}
