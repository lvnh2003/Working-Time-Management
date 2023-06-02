<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('index', ['user' => $user]);
    }
    public function update(Request $request, $id)
    {

        $user = User::find($id);
        $allData = $request->all();
        if ($request->has('image')) {

            $image = $request->image;
            $extension = $request->file('image')->extension();
            $name = $user->id;
            $newNameImage = $name . '.' . $extension;
            $folderImage = 'storage/users-avatar/';
            $allData['avatar'] = $newNameImage;
            $image->move($folderImage, $newNameImage);
            $user->update([
                'name' => $request->name,
                'image' => $newNameImage
            ]);
        } else {
            $user->update([
                'name' => $request->name,
            ]);
        }

        return response()->json($user);
    }
}
