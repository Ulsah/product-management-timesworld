<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    		$data = User::select('*')->paginate(10);
        return ["data" => $data];
    }
    
    public function doctors()
    {
    	return User::where('type', 'Doctor')->get();
    }
    
    public function patients()
    {
    	return User::all();
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
        		'email' => ['required', 'email', 'unique:users'],
						'type' => [
								'required',
								Rule::in(['Admin', 'Doctor', 'User']),
						]
				]);
				
				User::create([
					'name' => $request->get('name'),
					'email' => $request->get('email'),
					'type' => $request->get('type'),
					'password' => bcrypt('techtips'.$request->get('type'))
				]);
				
				return 200;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request = Validator::make($request->all(), [
        		'id' => ['required', 'numeric'],
        		'name' => ['required', 'string'],
        		'email' => ['required', 'email'],
						'type' => [
								'required',
								Rule::in(['Admin', 'Doctor', 'User']),
						]
				]);
				
				$request = $request->validated();
				
				User::where('id', $request['id'])->update([
					'name' => $request['name'],
					'email' => $request['email'],
					'type' => $request['type']
				]);
				
				return 200;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
