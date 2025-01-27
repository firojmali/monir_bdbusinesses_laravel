<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserArea;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Union;
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
        'username' => 'required',
        'password' => 'required',
        ]);
        $token=(string) Str::orderedUuid();;
        $tokenid="";
        $unit = User::where('username', $request->username)->first();
        //var_dump($unit);
        if($unit==null || !$unit->name){$vp=null;}        
        else{
            
        $vp=password_verify($request->input('password'), $unit->password);
        $unit->remember_token = $token;
        $unit->save();
        $tokenid=$unit->updated_at;
    }
        //$unit->password = "NA";
        if($vp)
        return [
            'code'=>20000,
            'data'=>[
                'token'=>$token,
                'tokenid'=>$tokenid,
            ],   
        ];
        else
        return [
            'code'=>20003,
            'message'=>'Not Match',   
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $unit = new User();
        $unit->name = 'superadmin';
        $unit->password=Hash::make('mfmali');
        $unit->email = 'mfmali.02@gmail.com';
        $unit->introduction = 'superadmin';
        $unit->avatar = 'none';
        $unit->username='superadmin';
        $unit->uid = (string) Str::orderedUuid();
        $unit->save();
        return $unit;
    }
    public function uid()
    {
        return (string) Str::orderedUuid();
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
    public function logout(Request $request)
    {
        $unit = User::find($request->userAuth->id);
        $unit->remember_token = null;
        $unit->save();
        return [
            'code'=>20000,
            'data'=>null,   
        ];
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
    public function myareas(Request $request, User $result)
    {
        $user = User::with('area')->find($request->userAuth->id);
        $divisions=[];$districts=[];$upazilas=[];$unions=[];
        //$result = User::Class;
        if($user->area->region_type < 1){
            //$result = $result->with('divisions, divisions.districts, divisions.districts.upazilas, divisions.districts.upazilas.unions');

        }
        else if($user->area->region_type < 2){
            $result = $result->with('districts', 'districts.upazilas', 'districts.upazilas.unions');
            //$districts=Division::with('districts', 'districts.upazilas', 'districts.upazilas.unions')->where('code', $user->area->division_code)->first();
        }
        else if($user->area->region_type < 3){
            $result = $result->with('upazilas', 'upazilas.unions');
        }
        else if($user->area->region_type < 4){
            $result = $result->with('unions');
        }
        //var_dump($result->toSql());
        $result = $result->find($request->userAuth->id);
        return [
            'code'=>20000,
            'data'=>[
                'user'=> $result,
                'type'=> $user->area->region_type
                ]   
        ];
    }

    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function info(Request $request)
    {
        //var_dump( $request->userAuth->username);
        //$token = $request->header('token');
        //$tokenid = $request->header('tokenid');
        $user = User::with('roles', 'hasAccess')->find($request->userAuth->id);
        $user->id=0;

        return [
            'code'=>20000,
            'data'=>$user,//$request->userAuth, 
        ];
    }
}