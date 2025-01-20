<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Triat\Auth;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    private function me($request)
    {
        $token = $request->header('token');
        $tokenid = $request->header('tokenid');
        $ath = User::where('remember_token',$token)->where('updated_at',$tokenid)->first();
        if(!$ath)return ['user'=>null,];
        else return['user'=>$ath];
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $user = $this->me($request);
        $insertData=[];
        foreach ($request->input('data') as $element) {
            $obj =  $element;
            $obj['remarks'] = "Entry By " . $user['user']->name;
            array_push($insertData, $obj);
        }
        //$res = new Stock();
        //$res = $res->fill($obj);
        $res = Stock::create($obj);
        return[
            'code'=>20000,
            'data'=>$res,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(stock $stock)
    {
        //
    }
}
