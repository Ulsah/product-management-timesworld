<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Appointment::select('*')->orderBy('id', 'asc')->paginate(10);
        
        foreach($data as $key=>$d){
        	$data[$key]->doctor_name = User::where('id', $d->doctor)->first()->name;
        }
        
        return ["data" => $data];
    }
    
    public function indexDoc()
    {
        $data = Appointment::select('*')->where('doctor', Auth::user()->id)->orderBy('id', 'asc')->paginate(10);
        
        foreach($data as $key=>$d){
        	$data[$key]->doctor_name = User::where('id', $d->doctor)->first()->name;
        }
        
        return ["data" => $data];
    }
    
    public function indexPatient()
    {
        $data = Appointment::select('*')->where('booked_by', Auth::user()->id)->orderBy('id', 'asc')->paginate(10);
        
        foreach($data as $key=>$d){
        	$data[$key]->doctor_name = User::where('id', $d->doctor)->first()->name;
        }
        
        return ["data" => $data];
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
        	'name' => ['required', 'string'],
        	'email' => ['required', 'string'],
        	'date' => ['required', 'date'],
        	'time' => ['required'],
        	'reason' => ['nullable', 'string'],
        	'doctor' => ['required', 'numeric']
        ]);
        
        if(Appointment::where('booked_by', Auth::id())->where('doctor', $request->get('doctor'))->whereDate('date', $request->get('date'))->where(function ($q) {
    			return $q->where('status', 'Confirmed')->orWhere('status', 'Completed');
    		})->first() != null)
        	return 500;
        
        $app = Appointment::create([
        	'doctor' => $request->get('doctor'),
        	'booked_by' => $request->get('booked_by'),
        	'name' => $request->get('name'),
        	'email' => $request->get('email'),
        	'date' => $request->get('date'),
        	'time' => $request->get('time'),
        	'reason' => $request->get('reason'),
        	'usertype' => ($request->get('booked_by') == '' || $request->get('booked_by') == null) ? 'Guest' : 'Registered'
        ]);
        
        if($app->usertype == 'Registered')
        	return 200;
        else if($app->usertype == 'Guest')
        	return view('success')->with('code', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
        	'date' => ['required', 'date'],
        	'time' => ['required']
        ]);
        
        Appointment::where('id', $request->get('id'))->update([
        	'doctor' => $request->get('doctor'),
        	'date' => $request->get('date'),
        	'time' => $request->get('time'),
        	'token' => '',
        	'status' => 'Requested'
        ]);
        
        return 200;
    }
    
    public function updateDoc(Request $request)
    {
        $this->validate($request, [
        	'date' => ['required', 'date'],
        	'time' => ['required']
        ]);
        
        Appointment::where('id', $request->get('id'))->update([
        	'date' => $request->get('date'),
        	'time' => $request->get('time'),
        	'reason' => $request->get('reason'),
        	'token' => '',
        	'status' => 'Requested'
        ]);
        
        return 200;
    }
    
    
    public function change(Request $request)
    {
    	if($request->get('status') == 'Confirmed'){
    		$ap = Appointment::where('id', $request->get('id'))->first();
    		
    		$ap->status = 'Confirmed';
    		$ap->token = Appointment::where('doctor', $ap->doctor)->whereDate('date', $ap->date)->where(function ($q) {
    			return $q->where('status', 'Confirmed')->orWhere('status', 'Completed');
    		})->count() + 1;
    		$ap->save();
    		
    		return 200;
    	}
    	
    	else if($request->get('status') == 'Declined'){
    		$ap = Appointment::where('id', $request->get('id'))->first();
    		
    		$ap->status = 'Declined';
    		$ap->token = '';
    		$ap->save();
    		
    		return 200;
    	}
    	
    	else if($request->get('status') == 'Completed'){
    		$ap = Appointment::where('id', $request->get('id'))->first();
    		
    		$ap->status = 'Completed';
    		$ap->save();
    		
    		return 200;
    	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
