<?php

namespace App\Http\Controllers;

use App\Models\Union;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return[
            'code'=>20000,
            'data'=> Union::with('upazila')->where('upazila_code_id', $request->input('upazila_code_id'))->get(),
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        foreach($request->input() as $v)
        {
            $districts = new Union();
            $districts->fill($v);
            $districts->save();
        }
        return[
            'code'=>20000,
            'data'=> $request->input(),
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
    public function show(Union $union)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Union $union)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Union $union)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Union $union)
    {
        //
    }
}
