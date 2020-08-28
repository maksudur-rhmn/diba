<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
   public function __construct()
   {
       $this->middleware('auth')->except('store');
       $this->middleware('admin')->except('store');
   }

   public function index()
   {
       return view('subscribers.index',[
           'subscribers' => Subscriber::all(),
       ]);
   }

   public function store(Request $request)
   {
      $request->validate([
          'name'  => 'required', 
          'email' => 'required|email',
      ]);

      Subscriber::insert([
        'name'  => strtolower($request->name),
        'email' => strtolower($request->email),
      ]);

      return back()->withSuccess('Thank you for subscribing to our newsletter');
   }
}
