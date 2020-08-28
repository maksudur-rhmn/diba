<?php

namespace App\Http\Controllers;

use App\Category;
use App\City;
use App\Doctor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Image;

class DoctorController extends Controller
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
       return view('doctors.index', [
           'cities'     => City::all(),
           'categories' => Category::all(),
           'doctors'    => Doctor::all(),
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
            'doctors_image'        => 'required', 
            'speciality'           => 'required',
            'academic_details'     => 'required',
            'chamber_details'      => 'required',
            'visiting_hours'       => 'required',
            'designation'          => 'required',
            'experience'           => 'required',
            'doctors_email'        => 'required|email',
            'for_appointment'      => 'required',
            'category_id'          => 'required',
            'city_id'              => 'required',
        ]);

        $doc_id = Doctor::create($request->except('_token') + ['created_at' => Carbon::now()]);
        
        $doc_image = $request->file('doctors_image');
        $file_name = $doc_id->id. '.' .$doc_image->extension('doctors_image');
        $location  =  public_path('uploads/doctors/'. $file_name);
        Image::make($doc_image)->resize(170, 170)->save($location);
        
        Doctor::find($doc_id->id)->update([
            'doctors_image' => $file_name,
            ]);
            
            return back()->withSuccess('Doctor Added Successfully');
    }

    public function all()
    {
        return view('doctors.all', [
            'doctors' => Doctor::all(),
        ]);
    }

    public function feature($doc_id)
    {
        $check = Doctor::where('featured_listing', 1)->get(); 

        if($check->count() == 2)
        {
            return back()->withErrors('Maximum number of doctors are featured. Please remove them to feature new doctor in home page');
        }
        Doctor::findOrFail($doc_id)->update([
            'featured_listing' => 1,
        ]);

        return back()->withSuccess('Doctor is featured and now visible in the featured listing section of the Home Page');

    }

    public function revoke($doc_id)
    {
        Doctor::findOrFail($doc_id)->update([
            'featured_listing' => 0,
        ]);

        return back()->withWarning('Doctor removed from the featured listing');
    }

    public function out($doc_id)
    {
        Doctor::findOrFail($doc_id)->update([
            'out_of_office' => 0
        ]);
        return back()->withWarning('Doctor is out of office and not available for appointments');
    }
    public function in($doc_id)
    {
        Doctor::findOrFail($doc_id)->update([
            'out_of_office' => 1
        ]);
        return back()->withSuccess('Doctor is back to office and  available for appointments');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        return view('doctors.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        $categories = Category::all();
        $cities = City::all();
        return view('doctors.edit', compact('doctor', 'categories', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name'                 => 'required',
            'speciality'           => 'required',
            'academic_details'     => 'required',
            'chamber_details'      => 'required',
            'visiting_hours'       => 'required',
            'designation'          => 'required',
            'experience'           => 'required',
            'doctors_email'        => 'required|email',
            'for_appointment'      => 'required',
            'category_id'          => 'required',
            'city_id'              => 'required',
        ]);


        if($request->hasFile('doctors_image'))
        {
            $existing_image = public_path('uploads/doctors/'. $doctor->doctors_image);
            unlink($existing_image);

            $uploaded_image = $request->file('doctors_image');
            $filename = $doctor->id. '.' .$uploaded_image->extension('doctors_image');
            $location = public_path('uploads/doctors/'. $filename);
            Image::make($uploaded_image)->resize(170, 170)->save($location); 

            $doctor->doctors_image = $filename;
        }

          $doctor->name                = $request->name;
          $doctor->speciality          = $request->speciality;
          $doctor->academic_details    = $request->academic_details;
          $doctor->chamber_details     = $request->chamber_details;
          $doctor->visiting_hours      = $request->visiting_hours;
          $doctor->designation         = $request->designation;
          $doctor->experience          = $request->experience;
          $doctor->doctors_email       = $request->doctors_email;
          $doctor->for_appointment     = $request->for_appointment;
          $doctor->category_id         = $request->category_id;
          $doctor->city_id             = $request->city_id;

          $doctor->save();

          return redirect('/all/doctors')->withSuccess('Information updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        $image = public_path('uploads/doctors/'. $doctor->doctors_image);
        unlink($image);

        $doctor->delete();

        return back()->withDanger('Doctors information deleted from the system !!!');
    }
}
