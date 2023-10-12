<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
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

    private function getSharedData($user) {
        $currentlyFollowing = false;

        if (auth()->check()) {
            $currentlyFollowing = Follow::where([['user_id', '=', auth()->user()->id], ['followeduser', '=', $user->id]])->count();
        }

        View::share('sharedData', ['currentlyFollowing' => $currentlyFollowing, 'avatar' => $user->avatar, 'username' => $user->username, 'postCount' => $user->posts()->count(), 'followersCount' => $user->followers()->count(), 'followingCount' => $user->followingTheseUsers()->count()]);
    }

    public function profile(User $user) {

        $this->getSharedData($user);
        return view('profile-posts', ['posts' => $user->posts()->latest()->paginate(6)]);

    }

    public function profileFollowers(User $user) {

        $this->getSharedData($user);
        return view('profile-followers', ['followers' => $user->followers()->latest()->get()]);

    }

    public function profileFollowing(User $user) {

        $this->getSharedData($user);
        return view('profile-following', ['following' => $user->followingTheseUsers()->latest()->get()]);

    }
}
