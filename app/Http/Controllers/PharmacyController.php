<?php

namespace App\Http\Controllers;

use App\Pharmacy;
use Illuminate\Http\Request;
use App\Category;
use App\City;
use Carbon\Carbon;
use Image;

class PharmacyController extends Controller
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
        return view('pharmacies.index', [
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
            'pharmacies_image'     => 'required', 
            'address'              => 'required',
            'phone'                => 'required|digits:11',
            'category_id'          => 'required',
            'city_id'              => 'required',
        ]);

        $doc_id = Pharmacy::create($request->except('_token') + ['created_at' => Carbon::now()]);
        
        $doc_image = $request->file('pharmacies_image');
        $file_name = $doc_id->id. '.' .$doc_image->extension('pharmacies_image');
        $location  =  public_path('uploads/pharmacies/'. $file_name);
        Image::make($doc_image)->resize(170, 170)->save($location);
        
        Pharmacy::find($doc_id->id)->update([
            'pharmacies_image' => $file_name,
            ]);
            
            return back()->withSuccess('Pharmacy Added Successfully');
    }

    public function all()
    {
        return view('pharmacies.all', [
            'pharmacies' => Pharmacy::all(),
        ]);
    }

    public function feature($phar_id)
    {
        $check = Pharmacy::where('featured_listing', 1)->get(); 

        if($check->count() == 2)
        {
            return back()->withErrors('Maximum number of pharmacy are featured. Please remove them to feature new doctor in home page');
        }
        Pharmacy::findOrFail($phar_id)->update([
            'featured_listing' => 1,
        ]);

        return back()->withSuccess('Pharmacy is featured and now visible in the featured listing section of the Home Page');

    }

    public function revoke($phar_id)
    {
        Pharmacy::findOrFail($phar_id)->update([
            'featured_listing' => 0,
        ]);

        return back()->withWarning('Pharmacy removed from the featured listing');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function show(Pharmacy $pharmacy)
    {
        return view('pharmacies.show', compact('pharmacy'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function edit(Pharmacy $pharmacy)
    {
        $categories = Category::all();
        $cities = City::all();
        return view('pharmacies.edit', compact('pharmacy', 'categories', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pharmacy $pharmacy)
    {

        $request->validate([
            'name'                 => 'required',  
            'address'              => 'required',
            'phone'                => 'required|digits:11',
            'category_id'          => 'required',
            'city_id'              => 'required',
        ]);

        if($request->hasFile('pharmacies_image'))
        {
            $existing_image = public_path('uploads/pharmacies/'. $pharmacy->pharmacies_image);
            unlink($existing_image);

            $uploaded_image = $request->file('pharmacies_image');
            $filename = $pharmacy->id. '.' .$uploaded_image->extension('pharmacies_image');
            $location = public_path('uploads/pharmacies/'. $filename);
            Image::make($uploaded_image)->resize(170, 170)->save($location); 

            $pharmacy->pharmacies_image = $filename;
        }

          $pharmacy->name                = $request->name;
          $pharmacy->address             = $request->address;
          $pharmacy->phone               = $request->phone;
          $pharmacy->category_id         = $request->category_id;
          $pharmacy->city_id             = $request->city_id;

          $pharmacy->save();

          return redirect('/all/pharmacies')->withSuccess('Information updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pharmacy $pharmacy)
    {
        $image = public_path('uploads/pharmacies/'. $pharmacy->pharmacies_image);
        unlink($image);

        $pharmacy->delete();

        return back()->withDanger('Pharmacy information deleted from the system !!!');
    }
}
