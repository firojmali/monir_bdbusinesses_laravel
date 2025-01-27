<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChallanController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/set/{id}', function (string $id) {
    return $id;
});
Route::get('/get', function () {
    return [
        "t"=>"23",
        "f"=>"0",
        "g"=>"5",
        "r"=>"1",
        "b"=>"1",
        "p"=>"28"
    ];
})->name("lh");

//user
//Route::get('/usercratee', [UserController::class, 'create']);
Route::get('/getuid', [UserController::class, 'uid']);
Route::get('/signup', [UserController::class, 'update']);




//product
Route::get('/products', [ProductController::class, 'index'])->middleware('auth');
Route::get('/productswithstock', [ProductController::class, 'allProductsWithStock']);//->middleware('auth');


Route::post('/products', [ProductController::class, 'insertMultiple'])->middleware('auth');
Route::post('/product', [ProductController::class, 'insert'])->middleware('auth');
Route::post('/product/{id}', [ProductController::class, 'update'])->middleware('auth');

//Unit
Route::get('/units', [UnitController::class, 'index']);
//Route::get('/cu', [UnitController::class, 'create']);

//stock
Route::post('/setopening', [StockController::class, 'store'])->middleware('auth');
Route::post('/stock/product/challan/history', [ChallanController::class, 'histry'])->middleware('auth');

//Challan
Route::post('/addChallan', [ChallanController::class, 'store'])->middleware('auth');
Route::get('/getChallans', [ChallanController::class, 'index'])->middleware('auth');
Route::get('/getChallan/{uid}', [ChallanController::class, 'challanInfo']);//->middleware('auth');


//BD
Route::post('/divisions', [App\Http\Controllers\DivisionController::class, 'create'])->middleware('auth');
Route::get('/divisions', [App\Http\Controllers\DivisionController::class, 'index']);
Route::post('/update/divisions', [App\Http\Controllers\DivisionController::class, 'update'])->middleware('auth');
Route::post('/update/district', [App\Http\Controllers\DistrictController::class, 'update'])->middleware('auth');
Route::post('/update/upazila', [App\Http\Controllers\UpazilaController::class, 'update'])->middleware('auth');

Route::get('/districts', [App\Http\Controllers\DistrictController::class, 'index']);
Route::post('/district', [App\Http\Controllers\DistrictController::class, 'create'])->middleware('auth');
Route::post('/upazilas', [App\Http\Controllers\UpazilaController::class, 'create'])->middleware('auth');
Route::get('/upazilas', [App\Http\Controllers\UpazilaController::class, 'index']);
Route::post('/update/unions', [App\Http\Controllers\UnionController::class, 'create']);
Route::get('/unions', [App\Http\Controllers\UnionController::class, 'index']);


//for vue - admin  monir for business

Route::get('/info', [UserController::class, 'info'])->middleware('auth');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
Route::post('user/areas', [UserController::class, 'myareas'])->middleware('auth');
