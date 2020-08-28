<?php

namespace App\Http\Controllers;

use Image;
use Carbon\Carbon;
use App\WebsiteSetting;
use Illuminate\Http\Request;
use App\Http\Requests\WebsiteSettingRequests;

class WebsiteSettingController extends Controller
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
        return view('settings.index',[
            'setting' => WebsiteSetting::first(),
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WebsiteSetting  $websiteSetting
     * @return \Illuminate\Http\Response
     */
    public function show(WebsiteSetting $websiteSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WebsiteSetting  $websiteSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(WebsiteSetting $websiteSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WebsiteSetting  $websiteSetting
     * @return \Illuminate\Http\Response
     */
    public function update(WebsiteSettingRequests $request, $id)
    {
        // Store the collection in a variable 

        $websiteSetting = WebsiteSetting::findOrFail($id);
        
        // Check if new logo is uploaded 

        if($request->hasFile('logo'))
        {
            $existing_logo = public_path('uploads/settings/' . $websiteSetting->logo);
            unlink($existing_logo);

            $new_logo = $request->file('logo');
            $name = 'logo.' . $new_logo->extension();
            $location = public_path('uploads/settings/' . $name);
            Image::make($new_logo)->save($location);

            $websiteSetting->logo = $name;
        }

        // Check if new Favicon is uploaded 

        if($request->hasFile('favicon'))
        {
            $existing_favicon = public_path('uploads/settings/' . $websiteSetting->favicon);
            unlink($existing_favicon);

            $new_favicon = $request->file('favicon');
            $name = 'favicon.' . $new_favicon->extension();
            $location = public_path('uploads/settings/');
            $new_favicon->move($location, $name);

            $websiteSetting->favicon = $name;
        }

        // Save the Title of the Website 

        $websiteSetting->title = $request->title;
        $websiteSetting->save();

        return redirect('home')->withSuccess('Central Settings Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WebsiteSetting  $websiteSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(WebsiteSetting $websiteSetting)
    {
        //
    }
}
