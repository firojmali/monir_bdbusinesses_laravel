<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;



class UnitController extends Controller
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
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $unit = new Unit();
        $unit->uid = (string) Str::orderedUuid();
        $unit->entry_by = 'MFMALI';
        $unit->unit=$request->input('unit');
        $unit->save();
        return $unit;
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
    public function update(Request $request, Unit $unit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        //
    }
}
