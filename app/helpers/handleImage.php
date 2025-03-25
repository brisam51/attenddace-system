<?php

namespace App\helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class HandleImage
{

    public function __construct() {}


    public static function handelUpdateImage($user, $request)
    {

        try {

            $validate = $request->validate(['image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048']);
            $newImage = $request->file('image');
            $imageName = time() . '.' . $newImage->getClientOriginalExtension();

            //storge path
            $path = public_path('assets/images');
            $newImage->move($path, $imageName);
         

            if (!empty($user->image)) {
                $oldPath = public_path('assets/images/' . $user->image);
                if (File::exists($oldPath)) {
                    unlink($oldPath);
                } else {
                    return Log::error('Failed to delete old image: ');
                }
            } else {
                $imageName = $user->image;
            }
            return $imageName;
        } catch (\Exception $e) {
            Log::error('Failed to move uploaded image: ' . $e->getMessage());
            throw new \RuntimeException('Failed to upload image.');
            return $e->getMessage();
        }
    }
}
