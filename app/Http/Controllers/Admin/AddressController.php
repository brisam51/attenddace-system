<?php

namespace App\Http\Controllers\Admin;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    public function fetchDataById($id)
    {
        $record = Address::where('user_id', $id)->first();

        if (!empty($record)) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'id' => $record->id,
                    // 'user_id' => $record->user_id,
                    'mobile' => $record->mobile,
                    'phone' => $record->phone,
                    'address' => $record->address
                ]
            ]);
        }
        return response()->json(['message' => 'Not found any address data..!']);
    }

    public function edit($id)
    {
        $address = Address::where('user_id', $id)->first();
        //dd($address);
        return view('admin.address.edit', ['address' => $address]);
    }

    public function update(Request $request, $id)
{
    // Validate the request data
    $validator = Validator::make($request->all(), [
        'user_id' => ['required', Rule::unique('addresses')->ignore($request->id)],
        'mobile' => 'required|numeric|digits:11',
        'phone' => 'required|numeric',
        'address' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422);
    }

    // Find the address by ID
    $address = Address::where("user_id",$id)->first();

    if ($address) {
        // Update the address
        $address->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Address updated successfully'
        ], 200);
    } else {
        return response()->json([
            'status' => 'error',
            'message' => 'Address not found'
        ], 404);
    }
}

    //save new record
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|unique:addresses,user_id',
            'mobile' => 'required|numeric|digits:11',
            'phone' => 'required|numeric',
            'address' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validaton failed',
                'errors' => $validator->errors()
            ], 422);
        }

      $address = Address::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'New reocord created successfully'
        ], 201);
    }
}
