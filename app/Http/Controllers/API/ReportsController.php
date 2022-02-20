<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Report::where('appointment', $request->get('id'))->get();
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
        	"id" => ["required", "numeric"],
        	"name" => ["required", "string"],
        	"file" => ["required", 'file', 'mimes:pdf']
        ]);
        
        $path = Storage::putFileAs(
										'public/reports', $request->file('file'), $request->get('name').".pdf"
								);
								
				$location = Storage::url('public/reports/'.$request->get('name').".pdf");
				
				Report::create([
					'appointment' => $request->get('id'),
					'name' => $request->get('name'),
					'location' => $location
				]);
				
				return 200;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $file = Report::where('id', $request->get('id'))->first();
        
        $status = Storage::delete('public/reports/'.$file->name.".pdf");
        
        if($status == 1)
        	$file->delete();
        	
        return 200;
    }
}
