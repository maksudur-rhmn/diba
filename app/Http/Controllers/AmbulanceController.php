<?php

namespace App\Http\Controllers;

use App\Ambulance;
use Illuminate\Http\Request;
use App\Category;
use App\City;
use Image;
use Carbon\Carbon;

class AmbulanceController extends Controller
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
        return view('ambulance.index', [
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
            'ambulance_image'     => 'required', 
            'address'              => 'required',
            'phone'                => 'required|digits:11',
            'category_id'          => 'required',
            'city_id'              => 'required',
        ]);

        $doc_id = Ambulance::create($request->except('_token') + ['created_at' => Carbon::now()]);
        
        $doc_image = $request->file('ambulance_image');
        $file_name = $doc_id->id. '.' .$doc_image->extension('ambulance_image');
        $location  =  public_path('uploads/ambulance/'. $file_name);
        Image::make($doc_image)->resize(170, 170)->save($location);
        
        Ambulance::find($doc_id->id)->update([
            'ambulance_image' => $file_name,
            ]);
            
            return back()->withSuccess('Ambulance Added Successfully');
    }

    public function all()
    {
        return view('ambulance.all', [
            'ambulances' => Ambulance::all(),
        ]);
    }

    public function feature($ambu_id)
    {
        $check = Ambulance::where('featured_listing', 1)->get(); 

        if($check->count() == 2)
        {
            return back()->withErrors('Maximum number of ambulance are featured. Please remove them to feature new doctor in home page');
        }
        Ambulance::findOrFail($ambu_id)->update([
            'featured_listing' => 1,
        ]);

        return back()->withSuccess('Ambulance is featured and now visible in the featured listing section of the Home Page');

    }

    public function revoke($ambu_id)
    {
        Ambulance::findOrFail($ambu_id)->update([
            'featured_listing' => 0,
        ]);

        return back()->withWarning('Ambulance removed from the featured listing');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Ambulance  $ambulance
     * @return \Illuminate\Http\Response
     */
    public function show(Ambulance $ambulance)
    {
        return view('ambulance.show', compact('ambulance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ambulance  $ambulance
     * @return \Illuminate\Http\Response
     */
    public function edit(Ambulance $ambulance)
    {
        $categories = Category::all();
        $cities = City::all();
        return view('ambulance.edit', compact('ambulance', 'categories', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ambulance  $ambulance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ambulance $ambulance)
    {

        $request->validate([
            'name'                 => 'required',
            'address'              => 'required',
            'phone'                => 'required|digits:11',
            'category_id'          => 'required',
            'city_id'              => 'required',
        ]);

        if($request->hasFile('ambulance_image'))
        {
            $existing_image = public_path('uploads/ambulance/'. $ambulance->ambulance_image);
            unlink($existing_image);

            $uploaded_image = $request->file('ambulance_image');
            $filename = $ambulance->id. '.' .$uploaded_image->extension('ambulance_image');
            $location = public_path('uploads/ambulance/'. $filename);
            Image::make($uploaded_image)->resize(170, 170)->save($location); 

            $ambulance->ambulance_image = $filename;
        }

          $ambulance->name                = $request->name;
          $ambulance->address             = $request->address;
          $ambulance->phone               = $request->phone;
          $ambulance->category_id         = $request->category_id;
          $ambulance->city_id             = $request->city_id;

          $ambulance->save();

          return redirect('/all/ambulance')->withSuccess('Information updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ambulance  $ambulance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ambulance $ambulance)
    {
        $image = public_path('uploads/ambulance/'. $ambulance->ambulance_image);
        unlink($image);

        $ambulance->delete();

        return back()->withDanger('Ambulance information deleted from the system !!!');
    }
}
