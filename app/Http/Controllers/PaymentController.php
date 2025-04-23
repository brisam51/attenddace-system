<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Payment;
use Illuminate\Http\Request;

use App\Models\Project as ModelsProject;
use App\Models\User;

class PaymentController extends Controller
{
    //fetch active member inprojects
    public function FetchActiveMemberInProjects()
    {
        $active_members = User::select('id','first_name','last_name','national_id','image')
            ->whereHas("projects", function ($query) {
                $query->where("status", 0);
            })->get();
           
        return view('payment.member_list', ['active_members' => $active_members]);
    }

    //Calculate payment
    public function calculatePayment($id)
    {
      $active_members=Attendance::where('user_id',$id)
      ->with('projects','tasks')
      ->get();
$totalTime=0;
foreach($active_members as $active_member){
    $totalTime+=$active_member->total_time;
}
dd($totalTime);
return view('payment.payment', ['active_members' => $active_members,'totalTime'=>$totalTime]);
    }
}//end class
