<?php

namespace App\Http\Controllers;

use App\Ad;
use Carbon\Carbon;
use Image;
use Illuminate\Http\Request;

class AdController extends Controller
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
      return view('adspace.index', [
          'ads' => Ad::all(),
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
            'ad_left'   => 'required|mimes:jpeg,jpg,png,webp,gif',
            'ad_right' => 'required|mimes:jpeg,jpg,png,webp,gif',
        ]);
            
        $total = Ad::count();

        if(!$total >= 1)
        {
            $ad = Ad::create([
                'ad_left'    => 'left',
                'ad_right'   => 'right',
                'created_at' =>  Carbon::now(),
            ]);
    

                $left_image = $request->file('ad_left');
                $ad_left    = $ad->id. '-left.' .$left_image->extension('ad_left');
                $location   = public_path('uploads/ads/'. $ad_left);
                Image::make($left_image)->resize(350, 550)->save($location); 
                $ad->ad_left = $ad_left;
    

                $right_image = $request->file('ad_right');
                $ad_right    = $ad->id. '-right.' .$right_image->extension('ad_right');
                $location    = public_path('uploads/ads/' . $ad_right);
                Image::make($right_image)->resize(350, 550)->save($location);
                $ad->ad_right = $ad_right; 
    
               // Update Database 
               $ad->save(); 
    
               return back()->withSuccess('Advertisement added into database and homepage');
        }

         // Otherwise return back and ask to delete the existing ads 

         return back()->withErrors('Ad Space Limit Reached. Please delete the existing ad to continue adding new advertisement');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ad $ad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        $existing_left_image = public_path('uploads/ads/'. $ad->ad_left);
        unlink($existing_left_image);
        $existing_right_image = public_path('uploads/ads/'. $ad->ad_right);
        unlink($existing_right_image);

        $ad->delete();

        return back()->withError('Advertisement Deleted. Add new images to continue advertising');
        
    }
}
