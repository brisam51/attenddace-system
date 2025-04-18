<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable=['user-id','image','description'];


    
    public function user(){
    return $this->belongsTo(User::class);
    }

}
