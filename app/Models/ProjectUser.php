<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{

   protected $table = 'project_user';
  protected $primaryKey = 'id';
  protected $fillable =[
    'project_id',
    'user_id',
    'daily_salary',
    'contract_file'
  ];
  public function project(){
    return $this->belongsTo(Project::class);
  }
  public function user(){
    return $this->belongsTo(User::class);
  }
}
