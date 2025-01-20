<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return[
            'code'=>20000,
            'data'=>Division::with('districts', 'districts.upazilas')->get(),
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, Division $division)
    {
        foreach($request->input() as $v)
        {
            $division = new Division();
            $division->fill($v);
            $division->save();
        }
        return[
            'code'=>20000,
            'data'=>$request,
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
    public function show(Division $division)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Division $division)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Division $division)
    {
        foreach($request->input() as $v)
        {
            $division = Division::find($v['id']);
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
    public function destroy(Division $division)
    {
        //
    }
}
