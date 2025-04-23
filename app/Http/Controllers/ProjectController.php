<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelpers;
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
         $validatedData['startDate']=DateHelpers::persianToEnglishDate($request->start_date);
         $validatedData['endDate']=DateHelpers::persianToEnglishDate($request->end_date);
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
   //edit function
   public function edit($id){
      $project = Project::find($id); 
      try{
         if(!$project){
            return redirect()->back()->with('error', 'پروژه یافت نشد');
         }else{
            //convert gergorian date to persian
            $project->start_date=DateHelpers::gregorianToPersianDate($project->start_date);
            $project->end_date=DateHelpers::gregorianToPersianDate($project->end_date);
            return view('projects.edit',compact('project'));   
         }  
            return view('projects.edit',compact('project'));   
        
      }catch(Exception $e){
         log::error($e->getMessage());   
         return redirect()->back()->with('error', 'خطا در ویرایش پروژه'. $e->getMessage());  
      }
      return view('projects.edit',compact('project'));
   }
   //update function
   public function update(Request $request,$id){
      $validatedData = $request->validate([
         'title' => 'required|string',
         'start_date' => 'required|string',
         'end_date' => 'required|string',
         'description' => 'required|string',
         'status' => 'required',
         //'type' => 'required',
         //'budget' => 'required',
        // 'manager_id' => 'required',
         //'client_id' => 'required', 
      ]);
      try {
         $project = Project::find($id);
         if(!$project) {
            return redirect()->back()->with('error', 'پروژه یافت نشد');
         }
         $validatedData['startDate'] = DateHelpers::persianToEnglishDate($request->start_date);
         $validatedData['endDate'] = DateHelpers::persianToEnglishDate($request->end_date);
         
         $project->title = $validatedData['title'];
         $project->description = $validatedData['description'];
         $project->start_date = $validatedData['startDate'];
         $project->end_date = $validatedData['endDate'];
         $project->status = $validatedData['status'];
         $project->save();

         return redirect()->route('projects.index')->with('success', 'پروژه با موفقیت بروزرسانی شد');

      } catch (Exception $e) {
         log::error($e->getMessage());
         return redirect()->back()->with('error', 'خطا در بروزرسانی پروژه'. $e->getMessage());
      }
      } 
      //delete project
      public function destroy($id) {
         $project = Project::find($id);
         if(!$project) {
            return redirect()->back()->with('error', 'پروژه یافت نشد');
         }
         $project->delete();
         return redirect()->route('projects.index')->with('success', 'پروژه با موفقیت حذف شد');
      }  
   }
