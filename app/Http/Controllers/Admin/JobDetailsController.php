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
        $jalaliDate = Jalalian::fromCarbon($gregorianDate)->format('Y/m/d');

        if (!empty($jobs)) {
            return response()->json([
                "status" => "success",
                "data" => [
                    "id" => $jobs['id'],
                    "job_title" => $jobs['job_title'],
                    "job_insurance_code" => $jobs['job_insurance_code'],
                    "job_description" => $jobs['job_description'],
                    "persianDate" => $jalaliDate,

                ],
            ]);
        }
    }
}
