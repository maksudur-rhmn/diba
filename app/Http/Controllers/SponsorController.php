<?php

namespace App\Http\Controllers;

use App\Sponsor;
use Carbon\Carbon;
use Image;
use Illuminate\Http\Request;

class SponsorController extends Controller
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
       return view('sponsor.index', [
          'sponsors' => Sponsor::all(),
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
            'sponsor' => 'required|mimes:jpeg,jpg,png,gif,webp',
        ]);

        $spon = Sponsor::create($request->except('_token') + ['created_at' => Carbon::now()]);

        $uploaded_image = $request->file('sponsor');
        $filename       = $spon->id. '.' .$uploaded_image->extension('sponsor');
        $location       = public_path('uploads/sponsors/' . $filename);
        Image::make($uploaded_image)->resize(170,30)->save($location); 

        $spon->sponsor = $filename; 
        $spon->save();

        return back()->withSuccess('Sponsor image added successfully and now visible in the home page');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsor $sponsor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsor $sponsor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsor $sponsor)
    {
        $existing_image = public_path('uploads/sponsors/' . $sponsor->sponsor);
        unlink($existing_image);

        $sponsor->delete();
        return back()->withErrors('Sponsor removed from the system');
    }
}
