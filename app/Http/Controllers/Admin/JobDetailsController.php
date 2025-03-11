<?php

namespace App\Http\Controllers\Admin;

use App\helpers\DateHeplers;
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
        
        if (!empty( $jobs)) {
            $gregorianDate = Carbon::parse($jobs['date_employment']);
        $jobs['date_employment'] = DateHeplers::englishToPersianNumber(Jalalian::fromCarbon($gregorianDate)->format('Y/m/d'));
        $jobs['job_insurance_code'] = DateHeplers::englishToPersianNumber($jobs['job_insurance_code']);
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
        } else {
            return response()->json(["data"=>""]);
        }
    }

    //insert  new  record
    public function store(Request $request)
    {
        // 'user_id','job_title','job_description','job_insurance_code','date_employment'
        $validated = $request->validate([
            'user_id' => 'required',
            'job_title' => 'required',
            'job_description' => 'required',
            'job_insurance_code' => 'required',
            'date_employment' => 'required',

        ]);
        $job = new JobDetails();
        $validated['date_employment'] = DateHeplers::persianToEnglishDate($request->date_employment);
        $job->create( $validated);
        return response()->json([
            "status" => "success",
            "message" => "new record added successfully"

        ]);
    }
    //update current record
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'job_title' => 'required',
            'job_insurance_code' => 'required',
            'job_description' => 'required',
            'date_employment' => 'required',
        ]);
        $validate['date_employment'] = DateHeplers::persianToEnglishDate($request->date_employment);
        $jobs = JobDetails::where('user_id', $id)->first();
        $jobs->update([
            'job_title' => $request->job_title,
            'job_insurance_code' => $request->job_insurance_code,
            'job_description' => $request->job_description,
            'date_employment' => $validate['date_employment'],
        ]);
        return response()->json([
            "status" => "success",
        ]);
    } //end update function
}//end class
