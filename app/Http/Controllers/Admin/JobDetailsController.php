<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobDetails;
use Illuminate\Http\Request;

class JobDetailsController extends Controller
{
    public function fetchDataById($id)
    {
        $jobs = JobDetails::where('user_id', $id)->first();
             if(!empty($jobs)){
            return response()->json([
                "status" => "success",
                "data" => $jobs,
            ]);
        }
    }
}
