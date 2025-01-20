<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return[
            'code'=>20000,
            'data'=> District::with('upazilas')->orderBy('code_id','desc')->get(),
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, District $districts)
    {
        foreach($request->input() as $v)
        {
            $districts = new District();
            $districts->fill($v);
            $districts->save();
        }
        return[
            'code'=>20000,
            'data'=> $districts,
        ];
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
    public function show(Districts $districts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Districts $districts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, District $districts)
    {
        foreach($request->input() as $v)
        {
            $division = District::find($v['id']);
            $division->fill($v);
            $division->save();
        }
        return[
            'code'=>20000,
            'data'=>$request,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Districts $districts)
    {
        //
    }
}
