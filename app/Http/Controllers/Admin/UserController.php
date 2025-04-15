<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\helpers\DateHeplers;
use App\helpers\handleImage;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{

    public function dashboard()
    {
        return view(('admin.user.dashboard'));
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
            $imagePath = $this->handleImage($request);
          
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

    //create function to handel image
    public function handleImage($request)
    {
        if (!$request->hasFile('image')) {
            return null;
        }
        $image = $request->file('image');
        //Validate the image
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Get the file extension
        $extension = $image->getClientOriginalExtension();
        // Generate a unique name for the image
        $imageName = uniqid() . '.' . $extension;
        // Move the image to the public directory
        $image->move(public_path('assets/images'), $imageName);
        // Return the image name
        return $imageName;
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
            //find user by Id
            $user = User::findOrFail($id);

            //Handel image file and delete old image 
           if($request->hasFile('image')) {
            $validated= $request->validated(['image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048 ']);
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/images'), $imageName);
                if(!empty($user->image)){
                    unlink(public_path('assets/images/'.$user->image));
                }
                $validateData['image'] = $imageName;
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
            Log::error('Faild to update record' . $e->getMessage(), [
                'trace' => $e->getTrace(),
                'file' => $e->getFile(),
            ]);
            return redirect()->back()->with('error', 'Unable to update current reocord' . $e->getMessage());
        }
    }
    //for handel upa

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $imagePath = public_path('assets/images/' . $user->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
        $user->delete();
        return redirect('user/index')->with('success', 'One record deleted successfully');
    }
}
