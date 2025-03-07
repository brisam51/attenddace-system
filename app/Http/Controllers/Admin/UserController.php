<?php

namespace App\Http\Controllers\admin;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\helpers\DateHeplers;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

use Illuminate\Support\Facades\Log;
class UserController extends Controller
{

    public function dashboard()
    {
        return view(('admin.dashboard'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['users'] = User::all();
        return view('admin.user.index', $data);
    }
    //show  single record
    public function show($id)
    {
        $user = User::find($id);
        return response()->json([
            'status' => 'success',
            'data' => [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'image' => $user->image
            ]
        ]);
    }

    public function newUserView()
    {
        return view('admin.user.new');
    }



    //Insert new record StoreUserRequest
    public function store(StoreUserRequest $request)
    {
        try {
            $personData = $request->validated();
            $imagePath = null;
            //Handel Upload Image....
            if ($request->hasFile('image')) {
                $image =   $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension(); // Unique image name
                $image->move(public_path('assets/images'), $imageName); // Save image to public/assets/images
                $imagePath = 'assets/images/' . $imageName; // Relative path for database
            }
            $user = new User();
            $personData["image"] = $imagePath;
            $birthdate = DateHeplers::persianToEnglishDate($personData['birth_date']);
            $user->first_name = $personData['first_name'];
            $user->last_name = $personData['last_name'];
            $user->national_id = $personData['national_id'];
            $user->card_id = $personData['card_id'];
            $user->birth_date = $birthdate;
            $user->email = $personData['email'];
            $user->image =  $imagePath;
            $user->password = Hash::make($personData['password']);
            $user->role = $personData['role'];
            $user->work_status = $personData['work_status'];
            $user->save();

            return redirect('user/index')->with('success', 'New record recorded successfully');
        } catch (Exception $e) {
            Log::error('User creation failed: ' . $e->getMessage()); // Log the error
            return redirect()->back()
                ->withErrors(['error' => 'Failed to create user. Please try again.'])
                ->withInput();
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $user = User::find($id);

            //defin roles
            $rols = ['supperadmin' => 'Super Admin', 'admin' => 'Admin', 'user' => 'User'];
            $status = ['active' => 'Active', 'inactive' => 'Inactive'];
            $gDate = Carbon::parse($user['birth_date']);

            $jalaliDate = Jalalian::fromCarbon($gDate)->format('Y/m/d');

            return view('admin.user.edit', ['user' => $user, 'birth_date' => $jalaliDate, 'roles' => $rols, 'status' => $status]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'error happend', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {



        $validateData = $request->validated();
        try {
            $user = User::find($id);
            //Handel image file
            if ($request->hasFile('image')) {
                //Delete old file
                if ($user->image && File::exists(public_path('assets/images/' . $user->image))) {
                    File::delete(public_path('assets/images/' . $user->image));
                }
                //Save new file image->getClientOriginalExtension();
                $newImageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(public_path('assets/images'), $newImageName);
                $imagePath = 'assets/images/' . $newImageName;
                $validateData['image'] =  $imagePath;
            } else {
                unset($validateData['image']);
            }
            //Hash password
            if (!empty($validateData['password'])) {
                $validateData['password'] = Hash::make($validateData['password']);
            } else {
                unset($validateData['password']);
            }
            //Handel birth date
            if (!empty($request['birth_date'])) {

                $validateData['birth_date'] = DateHeplers::persianToEnglishDate($request['birth_date']);
            } else {
                unset($validateData['birth_date']);
            }
            $user->update($validateData);

            return redirect('/user/index')->with('success', 'Current record updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Unable to update current reocord' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $imagePath = 'assets/images/' . $user->image;
        if ($user->image && File::exists(public_path($imagePath))) {
            File::delete(public_path($imagePath));
        }
        $user->delete();
        return redirect('user/index')->with('success', 'One record deleted successfully');
    }
}
