<?php

namespace App\Http\Controllers\Admin;

use App\Models\BankInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BankInfoController extends Controller
{
    public function fetchDataById($user_id){

        // Implement logic to fetch bank information based on user_id
        $bankInfo = BankInfo::where('user_id', $user_id)->first();

        // Return the fetched bank information in JSON format
        return response()->json([
            'status' => 'success',
            'data' => $bankInfo,
        ]);

    }
}
