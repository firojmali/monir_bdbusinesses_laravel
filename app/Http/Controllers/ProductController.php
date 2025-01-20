<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    private function senddata($page=1, $limit=20, $search=null){
        $rt = Product::with('unit');
        if($search!=null){
            $rt=$rt->where('name','%'.$search.'%');
        }
        if($page!='all' && $page!='allWS'){
            Paginator::currentPageResolver(function () use ($page) {
                return $page;
            });
            $rt=$rt->paginate($limit);
        }
        else if($page=='allWS'){
            $rt=$rt->with(['stock' => function($query){
                //$query->whereRaw('product_uid', '=', 'product.uid');
                $query->orderBy('opening_date', 'desc'); //you may use any condition here or manual select operation
                $query->get(); //select operation
            }])->get();
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

    
    
     private function checkProductName($productname, $uid='NONE'){
        $product = Product::where('name', $productname);
        if($uid!='NONE') $product = $product->whereNot('uid',$uid); ;
        $product = $product->first();
        //var_dump($productname);
        if($product && $product->name == $productname) return true;
        return false;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page=1; if($request->input('page')){$page=$request->input('page');}
        $limit=20;if($request->input('limit')){$limit=$request->input('limit');}
        $search=null;if($request->input('search')){$search=$request->input('search');}
        return $this->senddata($page, $limit, $search);
    }


public function allProductsWithStock(){
    // $data = DB::table('products')->join('units','units.uid','products.unit_uid')
    //         ->rightJoin('stocks', 'stocks.product_uid', 'products.uid')
    //         ->where(function ($query) {
    //             $query->where('stocks.product_uid', 'products.uid')->orderBy('opening_date', 'desc')->first();
    //         })
    //         ->get();
    $data = Product::with('unit')->with(['stock' => function($query){
        //$query->whereRaw('product_uid', '=', 'product.uid');
        $query->orderBy('opening_date', 'desc'); //you may use any condition here or manual select operation
        $query->get(); //select operation
    }])->orderBy('type', 'asc')->get();
    return [
        "code"=>20000,
        'data'=>$data,
    ];
}

    /**
     * Store a newly created resource in DB.
     */
    public function insert(Request $request)
    {
        if($this->checkProductName($request->input('name'))){
            return ["code"=>30004, 'message'=>"Product Name Exist."];
        }
        $product = new Product();
        $product->fill($request->input());
        $product->uid = (string) Str::orderedUuid();
        if($product->save()){ return ["code"=>20000,]; }
        else{ return ["code"=>30004,'message'=>"Error Saving."]; }
    }
    /**
     * Store multiple resource in DB.
     */
    public function insertMultiple(Request $request)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        if($this->checkProductName($request->input('name'),$request->input('uid'))){
            return ["code"=>30004, 'message'=>"Product Name Exist."];
        }
        $product = Product::where('uid', $id)->first();
        $product_uc = Product::where('uid', $id)->first();
        $product->fill($request->input());
        $product->changes = $product_uc->changes .'\n Updated:' . $request->input('add_change_name');
        if(mb_strlen($product->changes) > 253){
            $product->changes = substr($product->changes, mb_strlen($product->changes) - 253 + 1); 
        }
        $product->entry_by = $product_uc->entry_by;
        if($product->save()){ return ["code"=>20000]; }
        else{ return ["code"=>30004]; }
    }
  

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
