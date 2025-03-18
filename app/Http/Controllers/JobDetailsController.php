<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        $jobs = JobDetails::all();

        return view('job_details.index', ['jobs' => $jobs]);
    }
    //create function

    public function create()
    {
        return view('job_details.create');
    }
    //insert  new  record
    public function store(Request $request)
    {
        //Validate incomming data from request
        $validated = $request->validate([

            'job_title' => 'required|string|max:255',
            'job_code' => 'required|integer|unique:job_details,job_code',
            'job_description' => 'required|string|max:255',
            'hourly_wages' => 'required|integer',
        ]);
        $job = new JobDetails();
        try {
            $job->create([
                'job_title' => $validated['job_title'],
                'job_description' => $validated['job_description'],
                'job_code' => $validated['job_code'],
                'hourly_wages' => $validated['hourly_wages'],

            ]);
            return redirect('jobs/index')->with('success', 'Job details created successfully');
        } catch (Exception $e) {
            return back()->with('error', 'Error creating job details');
        }
    }
    //edit function
    public function edit($id)
    {
        try {
            $jobs = JobDetails::find($id);
            return view('job_details.edit', ['jobs' => $jobs]);
        } catch (Exception $e) {
            return back()->with('error', 'Error editing job details');
        }
    }
    //update current record
    public function update(Request $request, $id)
    {
    
        $validate = $request->validate([
            'job_title' => 'required|string|max:255',
            'job_code' => [
            'required',
            'integer',
            Rule::unique('job_details', 'job_code')->ignore($id),
        ],
            'job_description' => 'required|max:255|string',
            'hourly_wages' => 'required|integer',
        ]);
       
        try {
            $jobs = JobDetails::find($id);
            $jobs->update($validate);
            return redirect('jobs/index')->with('success', 'Job details updated successfully');
    }catch (Exception $e) {
        return back()->with('error', 'Error updating job details');
    }
    }
    //delete function
    public function destroy($id){
        $jobs=JobDetails::find($id);
        $jobs->delete();
        return redirect('jobs/index')->with('success', 'Job details deleted successfully');
    }
}//end class
