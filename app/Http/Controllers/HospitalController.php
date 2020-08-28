<?php

namespace App\Http\Controllers;

use App\Hospital;
use Illuminate\Http\Request;
use App\Category;
use App\City;
use Image;
use Carbon\Carbon;

class HospitalController extends Controller
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
      return view('hospitals.index', [
        'categories' => Category::all(),
        'cities'     => City::all(),
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
            'name'                 => 'required',  
            'hospitals_image'      => 'required', 
            'address'              => 'required',
            'phone'                => 'required|digits:11',
            'category_id'          => 'required',
            'city_id'              => 'required',
        ]);

        $doc_id = Hospital::create($request->except('_token') + ['created_at' => Carbon::now()]);
        
        $doc_image = $request->file('hospitals_image');
        $file_name = $doc_id->id. '.' .$doc_image->extension('hospitals_image');
        $location  =  public_path('uploads/hospitals/'. $file_name);
        Image::make($doc_image)->resize(170, 170)->save($location);
        
        Hospital::find($doc_id->id)->update([
            'hospitals_image' => $file_name,
            ]);
            
            return back()->withSuccess('Hospital Added Successfully');
    }

    public function all()
    {
        return view('hospitals.all', [
            'hospitals' => Hospital::all(),
        ]);
    }

    public function feature($hos_id)
    {
        $check = Hospital::where('featured_listing', 1)->get(); 

        if($check->count() == 2)
        {
            return back()->withErrors('Maximum number of hospitals are featured. Please remove them to feature new doctor in home page');
        }
        Hospital::findOrFail($hos_id)->update([
            'featured_listing' => 1,
        ]);

        return back()->withSuccess('Hospital is featured and now visible in the featured listing section of the Home Page');

    }

    public function revoke($hos_id)
    {
        Hospital::findOrFail($hos_id)->update([
            'featured_listing' => 0,
        ]);

        return back()->withWarning('Hospital removed from the featured listing');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function show(Hospital $hospital)
    {
        return view('hospitals.show', compact('hospital'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function edit(Hospital $hospital)
    {
        $categories = Category::all();
        $cities = City::all();
        return view('hospitals.edit', compact('hospital', 'categories', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hospital $hospital)
    {

        $request->validate([
            'name'                 => 'required',  
            'address'              => 'required',
            'phone'                => 'required|digits:11',
            'category_id'          => 'required',
            'city_id'              => 'required',
        ]);

        if($request->hasFile('hospitals_image'))
        {
            $existing_image = public_path('uploads/hospitals/'. $hospital->hospitals_image);
            unlink($existing_image);

            $uploaded_image = $request->file('hospitals_image');
            $filename = $hospital->id. '.' .$uploaded_image->extension('hospitals_image');
            $location = public_path('uploads/hospitals/'. $filename);
            Image::make($uploaded_image)->resize(170, 170)->save($location); 

            $hospital->hospitals_image = $filename;
        }

          $hospital->name                = $request->name;
          $hospital->address             = $request->address;
          $hospital->phone               = $request->phone;
          $hospital->category_id         = $request->category_id;
          $hospital->city_id             = $request->city_id;

          $hospital->save();

          return redirect('/all/hospitals')->withSuccess('Information updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hospital $hospital)
    {
        $image = public_path('uploads/hospitals/'. $hospital->hospitals_image);
        unlink($image);

        $hospital->delete();

        return back()->withDanger('Hospitals information deleted from the system !!!');
    }
}
