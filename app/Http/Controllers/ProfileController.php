<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{

    public function showAvatarForm() {
        return view('avatar-form');
    }

    public function storeAvatar(Request $request) {
        $request->validate([
            'avatar'=>'required|image|max:4000'
        ]);

        $user = auth()->user();

        $filename = $user->id . '_' . uniqid() . '.jpg';

        $formatImg = Image::make($request->file('avatar'))->fit(120)->encode('jpg');

        Storage::put('public/avatars/' . $filename, $formatImg);

        $oldAvatar = $user->avatar;

        $user->avatar = $filename;
        $user->save();

        if ($oldAvatar != '/avatars/default_avatar.jpg') {
            Storage::delete(str_replace('/storage/', 'public/', $oldAvatar));
        }

        return redirect('/profile/'. auth()->user()->username)->with('success', 'Your avatar was updated.');
    }

    public function profile(User $user) {
        return view('profile-posts', ['avatar' => $user->avatar, 'username' => $user->username, 'posts' => $user->posts()->latest()->get(), 'postCount' => $user->posts()->count()]);
    }
}
