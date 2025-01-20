<?php

namespace App\Http\Controllers;

use App\Models\Upazila;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UpazilaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return[
            'code'=>20000,
            'data'=> Upazila::with('unions')->orderBy('id','desc')->get(),
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, Upazila $districts)
    {
        foreach($request->input() as $v)
        {
            $districts = new Upazila();
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
    public function show(Upazila $upazila)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Upazila $upazila)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Upazila $upazila)
    {
        foreach($request->input() as $v)
        {
            if($v['id'] == null)
                $division = new Upazila();
            else
                $division = Upazila::find($v['id']);
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
    public function destroy(Upazila $upazila)
    {
        //
    }
}
