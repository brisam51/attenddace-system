<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\JobDetails;
use App\helpers\DateHeplers;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Exception;

class JobDetailsController extends Controller
{
    public function fetchDataById($id)
    {
        $jobs = JobDetails::where('user_id', $id)->first();

        if (!empty($jobs)) {
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
            return response()->json(["data" => ""]);
        }
    }

    //insert  new  record
    public function store(Request $request)
    {
        //Validate incomming data from request
        $validated = $request->validate([
            'user_id' => 'required|unique:job_details,user_id',
            'job_title' => 'required|string|max:255',
            'job_description' => 'required|string|max:255',
            'job_insurance_code' => 'required|unique:job_details,job_insurance_code',
            'date_employment' => 'required',

        ]);

        $job = new JobDetails();
        try {
            $validated['dateEmployment'] = DateHeplers::persianToEnglishDate($request->date_employment);
        } catch (Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "Invalid date format"
            ], 404);
        }
        try {
            $job->create([
                'job_title' => $validated['job_title'],
                'job_description' => $validated['job_description'],
                'job_insurance_code' => $validated['job_insurance_code'],
                'date_employment' => $validated['dateEmployment'],
                'user_id' => $validated['user_id']
            ]);
            return response()->json([
                "status" => "success",
                "message" => "new record added successfully"

            ]);
        } catch (Exception $e) {
        }
    }
    //update current record
    public function update(Request $request, $id)
    {
        //Validate incoming data
        $validate = $request->validate([
            'job_title' => 'required',
            'job_insurance_code' => [
                'required',
                Rule::unique('job_details')->ignore($request->id, $request->user_id),

            ],
            'job_description' => 'required|max:255|string',
            'date_employment' => 'required',
        ]);
        //convert persian date to gregorian date and update the database
        try {
            $validate['date_employment'] = DateHeplers::persianToEnglishDate($request->date_employment);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "Invalid date format"
            ], 404);
        }
        //Find the job recoord
        $jobs = JobDetails::where('user_id', $id)->first();
        if (!$jobs) {
            return response()->json([
                "status" => "error",
                "message" => "Job  details not found for given user",
            ], 404);
        }
        $jobs->update([
            'job_title' => $validate['job_title'],
            'job_insurance_code' => $validate['job_insurance_code'],
            'job_description' => $validate['job_description'],
            'date_employment' => $validate['date_employment'],
        ]);
        return response()->json([
            "status" => "success",
            "data" => $jobs,
        ]);
    } //end update function
}//end class
