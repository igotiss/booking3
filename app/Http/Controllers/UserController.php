<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;



class UserController extends Controller
{

    /**
     * Display the edit User profile view
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showProfile()
    {
        $user = auth()->user();
        return view('pages.users.show', compact('user'));
    }

    /**
     * Display the edit User profile view
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editProfile()
    {
        $user = auth()->user();
        return view ('pages.users.edit', compact('user'));
    }

    public function updateProfile(UserRequest $request)
    {

        $user = auth()->user();
        $validated = $request->validated();

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/users/', $filename);
            $user->profile_image = $filename;
        }

        $user->update($validated);
        return redirect(route('show_profile'))->with('success', 'зміни збережено успішно');
    }

}
