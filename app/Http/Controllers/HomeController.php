<?php

namespace App\Http\Controllers;

use App\User;
use App\Doctor;
use App\Appointment;
use App\Charts\UserChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // User Chart
        $chart = new UserChart;

        $today_users = User::whereDate('created_at', today())->count();
        $yesterday_users = User::whereDate('created_at', today()->subDays(1))->count();
        $users_2_days_ago = User::whereDate('created_at', today()->subDays(2))->count();
        $users_3_days_ago = User::whereDate('created_at', today()->subDays(3))->count();
        $users_4_days_ago = User::whereDate('created_at', today()->subDays(4))->count();
        $users_5_days_ago = User::whereDate('created_at', today()->subDays(5))->count();
        $users_6_days_ago = User::whereDate('created_at', today()->subDays(6))->count();
        
        $chart = new UserChart;
        $chart->labels(['6 days ago','5 days ago','4 days ago','3 days ago','2 days ago', 'Yesterday', 'Today']);
        $chart->dataset('Users Registered this week', 'bar', [$users_6_days_ago,$users_5_days_ago,$users_4_days_ago,$users_3_days_ago,$users_2_days_ago, $yesterday_users, $today_users])->options([
            
            'backgroundColor' => [
                '#313AC4',
                '#691F59',
                '#64C5B1',
                '#3C7AA6',
                '#2577CA',
                '#A93FAA',
                '#64C5B1',
            ],
        ]);

        $appointment_total = Appointment::count();
        $total_users       = User::count();
        $total_doctors     = Doctor::count();
        return view('home', compact('chart', 'appointment_total', 'total_users', 'total_doctors'));
    }

    public function appointment()
    {
        return view('appointments.index',[
            'appointments' => Appointment::latest()->get(),
        ]);
    }

    public function cancel($app_id)
    {
        Appointment::findOrFail($app_id)->update([
            'status' => 2,
        ]);

        return back()->withErrors('Appoinment Cancelled');
    }
    public function reconfirm($app_id)
    {
        Appointment::findOrFail($app_id)->update([
            'status' => 1,
        ]);

        return back()->withSuccess('Appoinment confirmed');
    }

    public function createAdmin($user_id)
    {
        User::findOrFail($user_id)->update([
            'role' => 2,
        ]);
    }
}
