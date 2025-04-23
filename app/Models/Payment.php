<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
   protected $fillable = [ 'user_id', 'total_paid', 'remining_paid', 'created_at', 'updated_at'];
   public function user(){
    return $this->belongsTo(User::class);
   }
   public function details(){
    return $this->hasMany(paymentDetails::class);
   }

   
}//end of class
