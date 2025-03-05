<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobDetails;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Morilog\Jalali\Jalalian;

class JobDetailsController extends Controller
{
    public function fetchDataById($id)
    {
        $jobs = JobDetails::where('user_id', $id)->first();
        $gregorianDate = Carbon::parse($jobs['date_employment']);
        //$jobs['date_employment'] = $gregorianDate->format('Y/m/d');
        $jobs['date_employment'] = Jalalian::fromCarbon($gregorianDate)->format('Y/m/d');
        //$jalaliDate = Jalalian::fromCarbon($gregorianDate)->format('Y/m/d');

        if (!empty($jobs)) {
            return response()->json([
                "status" => "success",
                "data" => [
                    "id" => $jobs['id'],
                    "job_title" => $jobs['job_title'],
                    "job_insurance_code" => $jobs['job_insurance_code'],
                    "job_description" => $jobs['job_description'],
                    "date_employment" => $jobs['date_employment'],

                ],
            ]);
        }
    }
//update current record
    public function update(Request $request,$id){

        $jobs = JobDetails::where('user_id', $id)->first();
        dd($jobs);
        $jobs->update($request->all());
       /* return response()->json([
            "status" => "success",
            "data" => [
                "id" => $jobs['id'],
                "job_title" => $jobs['job_title'],
                "job_insurance_code" => $jobs['job_insurance_code'],
                "job_description" => $jobs['job_description'],
                "date_employment" => $jobs['date_employment'],

            ],
        ]); */

    }
}
