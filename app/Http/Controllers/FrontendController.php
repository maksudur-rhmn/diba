<?php

namespace App\Http\Controllers;

use Hash;
use App\Ad;
use App\Blog;
use App\City;
use App\User;
use App\Doctor;
use App\Sponsor;
use App\Category;
use App\Hospital;
use App\Pharmacy;
use App\Ambulance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index()
    {
    
      // Home Page
      return view('frontend.index', [

        'doctors'     => Doctor::where('featured_listing', 1)->get(),
        'allDocs'     => Doctor::latest()->get(),
        'pharmacies'  => Pharmacy::where('featured_listing', 1)->get(),
        'allPhars'    => Pharmacy::latest()->get(),
        'hospitals'   => Hospital::where('featured_listing', 1)->get(),
        'allHos'      => Hospital::latest()->get(),
        'ambulances'  => Ambulance::where('featured_listing', 1)->get(),
        'allAmbu'     => Ambulance::latest()->get(),
        'ads'         => Ad::first(),
        'sponsors'    => Sponsor::all(),
        'blogs'       => Blog::latest()->get(),
        'categories'  => Category::all(),
        'cities'      => City::orderBy('name', 'asc')->get(),     

      ]);
            
    }

    // About Front Page 

    public function about()
    {
      return view('frontend.about');
    }

    // Doctor Front Page 

    public function docs()
    {
      return view('frontend.docs', [
        'doctors'      => Doctor::latest()->paginate(8),
        'categories'   => Category::all(),
        'cities'       => City::orderBy('name', 'asc')->get(),
      ]);
    }

    // Hospital Front Page 

    public function hos()
    {
      return view('frontend.hos', [
        'hospitals'      => Hospital::latest()->paginate(8),
        'categories'     => Category::all(),
        'cities'         => City::orderBy('name', 'asc')->get(),
      ]);
    }

    // Pharmacy Front Page 

    public function phar()
    {
      return view('frontend.phar', [
        'pharmacies'     => Pharmacy::latest()->paginate(8),
        'categories'     => Category::all(),
        'cities'         => City::orderBy('name', 'asc')->get(),
      ]);
    }
    // Ambulance Front Page 

    public function ambu()
    {
      return view('frontend.ambu', [
        'ambulances'     => Ambulance::latest()->paginate(8),
        'categories'     => Category::all(),
        'cities'         => City::orderBy('name', 'asc')->get(),
      ]);
    }
     // Blog Grid Page

    public function blogGrid()
    {
      return view('frontend.blog-grid', [
        'blogs' => Blog::latest()->paginate(9),
      ]);
    }


     // Blog Details Page 

    public function blogDetails($slug)
    {
      return view('frontend.blog-details',[
        
        'blog'  => Blog::where('blog_slug', $slug)->first(),
        
      ]);
    }


    // Search Methods 

    public function searchAll()
    {

      if(request('category') && request('city') && request('search'))
      {
        $search = request('category');
        $city   = request('city');
        $name   = request('search');

        $doctors =  Doctor::where('category_id',  'LIKE', '%' . $search . '%')
                          ->where('name',  'LIKE', '%' . $name . '%')
                          ->orWhere('speciality', 'LIKE', '%' . $name . '%')
                          ->where('city_id',  'LIKE', '%' . $city . '%')
                          ->get();


        $ambu =    Ambulance::where('category_id', 'LIKE', '%' . $search . '%')
                            ->where('name', 'LIKE', '%'. $name . '%')
                            ->where('city_id',  'LIKE', '%' . $city . '%')
                            ->get();

        $phar =    Pharmacy::where('category_id', 'LIKE', '%' . $search . '%')
                            ->where('name', 'LIKE', '%' . $name . '%' )
                            ->where('city_id',  'LIKE', '%' . $city . '%')
                            ->get();

        $hos  =     Hospital::where('category_id', 'LIKE', '%' . $search . '%')
                            ->where('name', 'LIKE', '%' . $name . '%')
                            ->where('city_id',  'LIKE', '%' . $city . '%')
                            ->get();

        return view('frontend.search', compact('doctors', 'ambu', 'phar', 'hos' ));
      }
      elseif(request('city')  && request('category'))
      {
        $search = request('category');
        $city   = request('city');

        $doctors =  Doctor::where('category_id',  'LIKE', '%' . $search . '%')
                          ->where('city_id',  'LIKE', '%' . $city . '%')
                          ->get();


        $ambu =    Ambulance::where('category_id', 'LIKE', '%' . $search . '%')
                            ->where('city_id',  'LIKE', '%' . $city . '%')
                            ->get();

        $phar =    Pharmacy::where('category_id', 'LIKE', '%' . $search . '%')
                            ->where('city_id',  'LIKE', '%' . $city . '%')
                            ->get();

        $hos  =     Hospital::where('category_id', 'LIKE', '%' . $search . '%')
                            ->where('city_id',  'LIKE', '%' . $city . '%')
                            ->get();

        return view('frontend.search', compact('doctors', 'ambu', 'phar', 'hos' ));
      }

      elseif(request('city'))
      {
        $search = request('city');

        $doctors  = Doctor::where('city_id',  'LIKE', '%' . $search . '%')->get();
        $ambu =     Ambulance::where('city_id', 'LIKE', '%' . $search . '%')->get();
        $phar =     Pharmacy::where('city_id', 'LIKE', '%' . $search . '%')->get();
        $hos  =     Hospital::where('city_id', 'LIKE', '%' . $search . '%')->get();

        return view('frontend.search', compact('doctors', 'ambu', 'phar', 'hos' ));
      }
      elseif(request('category'))
      {
        $search = request('category');
        $name   = request('search');

        $doctors =  Doctor::where('category_id',  'LIKE', '%' . $search . '%')
                          ->where('name',  'LIKE', '%' . $name . '%')
                          ->orWhere('speciality', 'LIKE', '%' . $name . '%')
                          ->get();


        $ambu =    Ambulance::where('category_id', 'LIKE', '%' . $search . '%')
                            ->where('name', 'LIKE', '%'. $name . '%')
                            ->get();

        $phar =    Pharmacy::where('category_id', 'LIKE', '%' . $search . '%')
                            ->where('name', 'LIKE', '%' . $name . '%' )
                            ->get();

        $hos  =     Hospital::where('category_id', 'LIKE', '%' . $search . '%')
                            ->where('name', 'LIKE', '%' . $name . '%')
                            ->get();

        return view('frontend.search', compact('doctors', 'ambu', 'phar', 'hos' ));
      }

      else 
      {
        
        $search = request('search');

        $doctors  = Doctor::where('name',  'LIKE', '%' . $search . '%')
                          ->orWhere('speciality', 'LIKE', '%' . $search . '%')
                          ->get();
        $ambu =     Ambulance::where('name', 'LIKE', '%' . $search . '%')->get();
        $phar =     Pharmacy::where('name', 'LIKE', '%' . $search . '%')->get();
        $hos  =     Hospital::where('name', 'LIKE', '%' . $search . '%')->get();

        return view('frontend.search', compact('doctors', 'ambu', 'phar', 'hos' ));

      }







    }

 // END     
}
