<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $user = $user = Auth::user();
        return view('frontend.user.profile', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $user = User::findOrFail(Auth::id());
            if ($request->file('file')) {
                $file = $request->file('file');
                $imageName = uniqid() . '.' . $file->extension();
                $file->storeAs('public/' . User::USER_IMAGE_PATH, $imageName);
                $imagePath = User::USER_IMAGE_PATH . '/' . $imageName;
                $request->merge(['image' => $imagePath]);
            }

            $user->update($request->all());
            return redirect()->back()->with('success', 'Post updated successfully');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
