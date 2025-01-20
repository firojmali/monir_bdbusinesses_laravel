<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            'code'=>20000,
            'data'=>Unit::all(),            
        ];
    }
    
     /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required',
        'password' => 'required',
        ]);
        $unit = User::where('name', $request->name)->first();
        $vp=password_verify($request->input('password'), $unit->password);
        $unit->remember_token = (string) Str::orderedUuid();
        $unit->save();
        $unit->password = "NA";
        if($vp)
        return [
            'code'=>20000,
            'data'=>$unit,   
        ];
        else
        return [
            'code'=>20003,
            'data'=>'Not Match',   
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $unit = new User();
        $unit->name = $request->input('n');
        $unit->password=Hash::make($request->input('p'));
        $unit->save();
        return $unit;
    }
 public function update(Request $request)
    {
        $unit = User::first();
       $vp=password_verify($request->input('p'), $unit->password);
        $unit->password=password_hash($request->input('p'), PASSWORD_BCRYPT);
        $unit->save();
        return  $vp;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        //
    }
}