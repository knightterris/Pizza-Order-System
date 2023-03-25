<?php

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//APIs for Pizza Order System
// GET METHOD
Route::get('categories/list',[RouteController::class,'categoryList']);
Route::get('contact/list',[RouteController::class,'contactList']);
Route::get('order/list',[RouteController::class,'orderList']);
Route::get('show/orderList',[RouteController::class,'showOrderList']);
Route::get('product/list',[RouteController::class,'productList']);
Route::get('user/list',[RouteController::class,'userList']);
Route::get('get/allData',[RouteController::class,'getAllData']);
//DELETE WITH GET METHOD
Route::get('delete/category/{id}',[RouteController::class,'deleteCategoryGet']);

//API Links
/*
1.  localhost:8000/api/categories/list
2.  localhost:8000/api/contact/list
3.  localhost:8000/api/order/list
4.  localhost:8000/api/show/orderList
5.  localhost:8000/api/product/list
6.  localhost:8000/api/user/list
7.  //get all tables
8.  localhost:8000/api/get/allData
//delete
1.   localhost:8000/api/delete/category/{id}
2.  localhost:8000/api/
3.  localhost:8000/api/
*/

//POST METHOD
//CREATE
Route::post('create/category',[RouteController::class,'createCategory']);
Route::post('create/contact',[RouteController::class,'createContact']);
Route::post('create/product',[RouteController::class,'createProduct']);
//DELETE
Route::post('delete/category',[RouteController::class,'deleteCategoryPost']);
//Update
Route::post('update/category',[RouteController::class,'updateCategory']);


//POST METHOD API LINKS
/*
//create
1.  localhost:8000/api/create/category (POST['name'])
2.  localhost:8000/api/create/contact (POST['name','email','phone','message'])
3.  localhost:8000/api/create/product (POST[category_id,name,image,description,price,waiting_time])
//delete
1.  localhost:8000/api/delete/category
2.  localhost:8000/api/
3.  localhost:8000/api/

*/ 
