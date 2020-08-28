<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use App\User;
use App\Mail\SecurityAlert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ChangePasswordRequests;

class ProfileController extends Controller
{ 
   public function __construct()
   {
     $this->middleware('auth');
   }

   public function changePassword($user_id)
   {
      if(Auth::id() == $user_id)
      {
        return view('users.changePassword',[

          'user' => User::findOrFail($user_id),

      ]);
      }
      else 
      {
        return abort('404');
      }
   }

   public function passwordUpdated(ChangePasswordRequests $request)
   {
     // Old Password
     $existingPassword = Auth::user()->password; 

     // Check if old and new password is same  

     if($request->old_password != $request->password)
     {
       if(Hash::check($request->old_password, $existingPassword))
       {
          User::findOrFail(Auth::id())->update([
            'password' => Hash::make($request->password),
          ]);

          Mail::to(Auth::user()->email)->send(new SecurityAlert);

          return back()->withSuccess('Your Password has been changed');
       }
       else 
       {
         return back()->withErrors('Incorrect password, Please reset your password if you do not remember your old password');
       }
     }
     else 
     {
       return back()->withErrors('Old Password and New Password cannot be same. Please try again');
     }

   }

  
  // END 
}
