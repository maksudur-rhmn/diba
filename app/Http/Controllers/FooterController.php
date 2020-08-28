<?php

namespace App\Http\Controllers;

use App\Footer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FooterController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('footer.index',[
            'footer' => Footer::first(),
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
       $request->validate([
        'address'   => 'required',
        'phone_one' => 'required|digits:11|unique:footers',
        'phone_two' => 'required|digits:11|unique:footers',
        'email'     => 'required|email',
       ]);

        Footer::insert($request->except('_token') + ['created_at' => Carbon::now()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Footer  $footer
     * @return \Illuminate\Http\Response
     */
    public function show(Footer $footer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Footer  $footer
     * @return \Illuminate\Http\Response
     */
    public function edit(Footer $footer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Footer  $footer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Footer $footer)
    {
        $request->validate([
            'address'   => 'required',
            'phone_one' => 'required|digits:11|unique:footers',
            'phone_two' => 'required|digits:11|unique:footers',
            'email'     => 'required|email',
           ]);

        $footer->address        = $request->address;
        $footer->phone_one      = $request->phone_one; 
        $footer->phone_two      = $request->phone_two; 
        $footer->email          = $request->email; 
        $footer->facebook_link  = $request->facebook_link;
        $footer->twitter_link   = $request->twitter_link;
        $footer->linkedin_link  = $request->linkedin_link;

        $footer->save();
        return back()->withSuccess('Footer information updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Footer  $footer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Footer $footer)
    {
        //
    }
}
