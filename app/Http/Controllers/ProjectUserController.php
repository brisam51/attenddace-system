<?php

namespace App\Http\Controllers;

use App\Models\ProjectUser;
use Illuminate\Http\Request;

class ProjectUserController extends Controller
{
   public function fetchDataById($id){
    $members=ProjectUser::where('project_id',$id)->get();
    dd($members);
   }
}
