<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentDetails extends Model
{
    protected $table = "payment_details";
    protected $fillable = ['payment_id','project_id','task_id','hourly_wage','total_hours_worked' ]; 
    



    public function payments(){
        return $this->belongsTo(Payment::class,'payment_id');
    }
    public function projects(){
        return $this->belongsTo(Project::class,'project_id');

    }
    public function tasks(){
   return $this->hasMany(Task::class,'task_id');
    }
}
