<?php

namespace App\Http\Controllers;

use App\Models\Challan;
use App\Models\ChallanItem;
use App\Models\Stock;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChallanController extends Controller
{
    private function me($request)
    {
        $token = $request->header('token');
        $tokenid = $request->header('tokenid');
        $ath = User::where('remember_token',$token)->where('updated_at',$tokenid)->first();
        if(!$ath)return ['user'=>null,];
        else return['user'=>$ath];
    }
    //Get all data related to a challan
    public function challanInfo($uid, Request $request){
        $challan = Challan::with('challan_items', 'challan_items.product')->where('uid', $uid)->first();
        return [
            'code'=>20000,
            'uid'=>$uid,
            'data'=>$challan,
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Challan $rt)
    {
        $page=1; if($request->input('page')){$page=$request->input('page');}
        $limit=20;if($request->input('limit')){$limit=$request->input('limit');}
        $search=null;if($request->input('search')){$search=$request->input('search');}
        //$rt = Challan::with('unit');
        if($search!=null){
            $rt=$rt->where('challan_number','%'.$search.'%');
        }
        if($page!='all'){
            Paginator::currentPageResolver(function () use ($page) {
                return $page;
            });
            $rt=$rt->paginate($limit);
        }
        else {
            $rt=$rt->get();
        }
        return [
            'code'=>20000,
            'type'=>$page=='all'?'all':'page',
            'data'=>$rt,
        ];
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function histry(Request $request)
    {
        $challans = ChallanItem::with('challan')->where('created_at', '>=', $request->from)->where('product_uid',$request->product_uid)->get();
        return [
            'code'=>20000,
            'type'=>'page',
            'data'=>$challans,
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $this->me($request);
        $error=0;$msg='OK';
        $cnn = $request->input('challan_insert');
        if($cnn){$chn = $cnn['challan_number'];}
        else{
            $error=2;
            $msg="Data Problem";
        }
        $existed=null;
        if(!$error)
            $existed = Challan::where('challan_number', $chn)->first();
        if($existed){
            $error=1;
            $msg="Challan Exist";            
        }
        else{
            $cnn['uid']=(string) Str::orderedUuid();
            $cnn['remarks']="Entry By " . $user['user']->name.'\n '.$cnn['remarks'];
            $Challan = Challan::create($cnn);
            $Challanitems = $Challan->challan_items()->createMany($cnn['challan_items']);
            $stocks = $request->input('stock_update');
            foreach($stocks as $stock_data){
             $stock=Stock::where('product_uid', $stock_data['product_uid'])->orderBy('opening_date', 'desc')->first();
             if($stock){
                $stock=$stock->fill($stock_data);
                $stock->challan_uids = $stock->challan_uids . ', '.$Challan->id;
                $stock->quantity_good=$stock->quantity_good + $stock_data['quantity_good_plus']-$stock_data['quantity_good_minus'];
                $stock->quantity_damaged=$stock->quantity_damaged+$stock_data['quantity_damaged_plus']-$stock_data['quantity_damaged_minus'];
                $stock->save();
             }
             else {
                $stock_data['remarks'] = "Entry By " . $user['user']->name.'Through Challan '. $Challan->uid;
                $stock_data['challan_uids'] = $Challan->id;
                $stock_data["quantity_good"]=$stock_data['quantity_good_plus']-$stock_data['quantity_good_minus'];
                $stock_data["quantity_damaged"]=$stock_data['quantity_damaged_plus']-$stock_data['quantity_damaged_minus'];
                $stock_data["opening_quantity_good"]=0;
                $stock_data["opening_quantity_damaged"]=0;
                $stock_data['opening_date']=$Challan->active_date_time;
             }
            }
        }
        return [
            'code'=>20000,
            'data'=>[
                'error'=>$error,
                'msg'=>$msg,
            ],
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Challan $Challan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Challan $Challan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Challan $Challan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Challan $Challan)
    {
        //
    }
}
