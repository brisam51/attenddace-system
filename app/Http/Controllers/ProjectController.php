<?php

namespace App\Http\Controllers;

use App\helpers\DateHeplers;
use App\Models\Project;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;
class ProjectController extends Controller
{
   //Invoking the index method
   public function index()
   {
      $projects['allRecords'] = Project::all();


      return view('projects.index', $projects);
   }
   //Invoking the create method  
   public function create()
   {
      return view('projects.create');
   }
   //Insert new project record
   public function store(Request $request)
   {
      $validatedData = $request->validate([
         'title' => 'required|string|max:255',
         'description' => 'required|string|max:255',
         'start_date' => 'required',
         'end_date' => 'required',
         'status' => 'required',
         
      ]);
      try {
         $project = new Project();
         $validatedData['startDate']=DateHeplers::persianToEnglishDate($request->start_date);
         $validatedData['endDate']=DateHeplers::persianToEnglishDate($request->end_date);
         $project->title=$validatedData['title'] ;
         $project->description=$validatedData['description'] ;
         $project->start_date=$validatedData['startDate'] ;
         $project->end_date=$validatedData['endDate'] ;
         $project->status=$validatedData['status'] ;
         $project->save();
         return redirect()->route('projects.index')->with('success', 'پروژه با موفقیت ثبت شد');
      
      } catch (Exception $e) {
         log::error($e->getMessage());   
         return redirect()->back()->with('error', 'خطا در ثبت پروژه'. $e->getMessage());  
      }
   }
}
