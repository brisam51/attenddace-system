<?php

namespace App\Http\Controllers\Admin;

use App\Models\BankInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class BankInfoController extends Controller
{
    public function fetchDataById($id)
    {

        // Implement logic to fetch bank information based on user_id
        $bankInfo = BankInfo::where('user_id', $id)->first();

        // Return the fetched bank information in JSON format
        if(!empty($bankInfo)){
            return response()->json([
                'status' => 'success',
                'data' => [
                    "id" => $bankInfo->id,
                    "user_id" => $bankInfo->user_id,
                    "bank_name" => $bankInfo->bank_name,
                    "account_number" => $bankInfo->account_number,
                    "shaba_number" => $bankInfo->shaba_number,
                ],
            ]);
        }else{
            return '';
        }

    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', Rule::unique('bank_infos')->ignore($request->id)],
            'account_number' =>  ['required', Rule::unique('bank_infos')->ignore($request->id)],
            'bank_name' => 'required|string',
            'shaba_number' =>  ['required', Rule::unique('bank_infos')->ignore($request->id)],
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Implement logic to update bank information based on user_id
        $bankInfo = BankInfo::where('user_id', $id)->first();
        if (!$bankInfo) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        //insert dataF
        $bankInfo->update($request->all());

        // Return the updated bank information in JSON format
        return response()->json([
            "status" => "success",
            "message" => "Bank information updated successfully",
            "data" => $bankInfo
        ]);
    }
    //Insert new bank user information
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|unique:bank_infos,user_id',
            'account_number'=>'required|numeric|unique:bank_infos,account_number|digits:5',
            'bank_name' => 'required|string',
            'shaba_number'=>'required|numeric|digits:5|unique:bank_infos,shaba_namber',
        ]);
    if($validator->fails()){
        return response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422);
    }
    $bankInfo=BankInfo::create($request->all());
    return response()->json([
        "status" => "success",
        "message" => "Bank information created successfully",
        "data" => $bankInfo
    ]);
    }
    public function destroy($id){
        $bankInfo=BankInfo::find($id);
        $bankInfo->delete();
        return response()->json([
            "status" => "success",
            "message" => "Bank information deleted successfully",
        ]);

    }
}//end class
