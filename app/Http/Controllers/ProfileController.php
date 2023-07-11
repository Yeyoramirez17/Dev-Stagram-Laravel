<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('profile.index');
    }
    public function store(Request $request)
    {

        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20'],
            'email' => ['email', 'unique:users,email,' . auth()->user()->id, 'max:60'],
        ]);

        if ($request->image)
        {
            $image = $request->file('image');

            $nameImage = Str::uuid() . "." . $image->extension();

            $imageServer = Image::make($image);
            $imageServer->fit(1000, 1000);

            $imagePath = public_path('profiles') . '/' . $nameImage;
            $imageServer->save($imagePath);
        }

        $user = User::find(auth()->user()->id);
        $user->username = $request->username;
        $user->email = $request->email ?? auth()->user()->email;
        $user->image = $nameImage ?? auth()->user()->image ?? null;
        $user->save();

        if ($request->old_password || $request->new_password)
        {
            if (Hash::check($request->old_password, auth()->user()->password))
            {
                $this->validate($request, [
                    'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20'],
                    'email' => ['email', 'unique:users,email,' . auth()->user()->id, 'max:60'],
                    'new_password' => ['required', 'min:6'],
                ]);

                $user->password = Hash::make($request->new_password);
                $user->save();

                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login');
            } else {
                return back()->with('error', 'La contraeña no coinciden');
            }
        }

        return redirect()->route('posts.index', $user->username);
    }
}
