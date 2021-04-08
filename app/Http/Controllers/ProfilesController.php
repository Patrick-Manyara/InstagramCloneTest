<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(User $user){

        $follows=(auth()->user() ? auth()->user()->following->contains($user->id) : false);

        $postsCount = $user->posts->count();
        $followersCount = $user->profile->followers->count();
        $followingCount = $user->following->count();

        return view('profiles.index', compact('user', 'follows', 'postsCount', 'followersCount', 'followingCount'));
    }

    public function edit(User $user){
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user){
        $this->authorize('update', $user->profile);
        $data = request()->validate([
            'title'=>'',
            'description'=>'',
            'url'=>'',
            'image'=>'',
        ]);



        if (request('image')){
            $imagepath=request('image')->store('profile','public');

            $image = Image::make(public_path("storage/{$imagepath}"))->fit(1000,1000);
            $image->save();
        }

        auth()->user()->profile->update(array_merge(
            $data,
            ['image'=>$imagepath]
        ));

        return redirect("/profile/{$user->id}");
    }
}
