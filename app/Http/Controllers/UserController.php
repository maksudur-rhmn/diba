<?php

namespace App\Http\Controllers;

use Image;
use App\Country;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['show', 'edit', 'update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('users.index',[
           'users' => User::orderBy('id', 'desc')->get(),
       ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $countries = Country::all();
       return view('users.edit', compact('user','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'personal_info' => 'required',
            'country_id' => 'required',
        ]);

        $user = User::findOrFail($id); 


        // Check if there is a new profile picture 

        if($request->hasFile('profile_picture'))
        {
            // Delete the existing profile picture if not default picture

            if($user->profile_picture != 'default_profile_picture.jpg')
            {
                $existingProfilePicture = public_path('uploads/users/' . $user->profile_picture);
                unlink($existingProfilePicture);
            }

            // Upload the new profile picture 

            $uploaded_image = $request->file('profile_picture');
            $filename = $id. '.' .$uploaded_image->extension('profile_picture');
            $location = public_path('uploads/users/'. $filename);
            Image::make($uploaded_image)->save($location);
            $user->profile_picture = $filename;
            $user->save();  
        }

        // Update all the information in database 

        User::findOrFail($id)->update([

            'name'             => $request->name,
            'email'            => $request->email,
            'personal_info'    => $request->personal_info,
            'phone'            => $request->phone,
            'country_id'       => $request->country_id,
            'fb_id'            => $request->fb_id,
            'twitter_id'       => $request->twitter_id, 
            'linkedin_id'      => $request->linkedin_id,

        ]);

        // Return redirect to user page 
            
        return redirect('/home')->withSuccess('Profile updated successfully');
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($user_id)
    {
        $user = User::findOrFail($user_id); 

        // Return false if an the user is an admin. 

        foreach ($user->getRoleNames() as $role) {
            
            if($role != 'Admin')
            {
                User::findOrFail($user_id)->delete();
                return back()->withDanger('User Deleted Successfully');
            }
            else 
            {
                return back()->withErrors('Admin account cannot be deleted');
            }
        }
    }

   // END 
}
