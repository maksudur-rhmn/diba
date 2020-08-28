<?php

namespace App\Http\Controllers;

use Auth;
use App\Appointment;
use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('customer');
    }
    public function index()
    {
        return view('customer.index',[
            'appointments' => Appointment::where('user_id', Auth::id())->latest()->get(),
        ]);
    }
}
