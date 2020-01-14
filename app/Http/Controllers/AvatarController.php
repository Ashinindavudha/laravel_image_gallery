<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AvatarController extends Controller
{
    public function index()
    {
        $avatars = auth()->user()->getMedia('avatar');
        return view('profile', compact('avatars'));
    }
    public function create()
    {
         auth()->user()->clearMediaCollection();
    }
    public function store(Request $request)
    {
        //return $request->all();
        $user = auth()->user();
        $user->addMedia($request->avatar)->toMediaCollection('avatar');
        return redirect()->back();
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $user->avatar_id = $request->selectedAvatar;
        $user->save();
        return redirect()->back();
    }
    public function destroy($id)
    {
       
    }
}
