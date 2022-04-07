<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Countries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ["data" => Countries::select('*')->paginate(10)];
    }
    
    public function indexAll()
    {
    	return Countries::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        	"country" => ["required", "string", "min:3", "max:20"],
        	"continent" => ["required"],
        	"rank" => ["required", "numeric", "min:1", 'unique:countries,rank'],
        	"image" => ["required", "mimes:jpg,png", "max:4000"]
        ]);
        
        $name = $request->get('country').".".$request->file('image')->getClientOriginalExtension();
        $path = Storage::putFileAs(
						'public/countries', $request->file('image'), $name
				);
				$location = Storage::url('public/countries/'.$name);				
				
				Countries::create([
					'country' => $request->get('country'),
					'rank' => $request->get('rank'),
					'continent' => $request->get('continent'),
					'flag' => $location
				]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Countries  $countries
     * @return \Illuminate\Http\Response
     */
    public function show(Countries $countries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Countries  $countries
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Countries $countries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Countries  $countries
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $country = Countries::where("id", $request->get('id'))->first();
        
        $status = Storage::delete(str_replace("storage", "public", $country->flag));
        
        if($status == 1)
        	$country->delete();
    }
}
