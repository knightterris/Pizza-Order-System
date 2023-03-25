<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //get all tables
    public function getAllData(){
        $categories = Category::get();
        $contact = Contact::get();
        $order = Order::get();
        $orderList = OrderList::get();
        $product = Product::get();
        $user = User::get();

        $allData = [
            'categories'=>$categories,
            'contacts'=>$contact,
            'orders'=>$order,
            'orderLists'=>$orderList,
            'products'=>$product,
            'users'=>$user
        ];
        return response()->json($allData, 200);
    }

    //get categories lists
    public function categoryList(){
        $categories = Category::get();
        return response()->json($categories, 200);
    }
    //get contact lists
    public function contactList(){
        $contact = Contact::get();
        return response()->json($contact, 200);
    }
    //get order lists
    public function orderList(){
        $order = Order::get();
        return response()->json($order, 200);
    }
    //show orderList
    public function showOrderList(){
        $orderList = OrderList::get();
        return response()->json($orderList, 200);
    }
    //get product list
    public function productList(){
        $product = Product::get();
    return response()->json($product, 200);
    }
    //get uset list
    public function userList(){
        $user = User::get();
        return response()->json($user, 200);
    }

    //POST METHOD
    //CRUD
    //CREATE
    //create category
    public function createCategory(Request $request){
        // dd($request->all());
        $categoryData = [
            'name'=>$request->name,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
        // return $categoryData;
        $categoryCreate = Category::create($categoryData);
        return response()->json($categoryCreate, 200);
    }
    //create contact
    public function createContact(Request $request){
        // dd($request->all());
        $contactData = [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'message'=>$request->message,
        ];
        // return $contactData;
        $contactCreate = Contact::create($contactData);
        return response()->json($contactCreate, 200);
    }
    //create order
    public function createProduct(Request $request){
        $productData = [
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'image'=>$request->image,
            'description'=>$request->description,
            'price'=>$request->price,
            'waiting_time'=>$request->waiting_time,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ];
        // return $productData;
        $createProduct = Product::create($productData);
        return response()->json($createProduct, 200);
    }
    //DELETE
    //delete category with POST METHOD
    public function deleteCategoryPost(Request $request){
        // return $request->all();
        $findCategoryData = Category::where('id',$request->category_id)->first();
        // return isset($findCategoryData);
        if(isset($findCategoryData)){
            Category::where('id',$request->category_id)->delete();
            return response()->json(['status'=>true,'message'=>'delete success'],200);
        }
         return response()->json(['status'=>false,'message'=>'There is no such ID.'],200);
    }
    //DELETE CATEGORY WITH GET METHOD
    public function deleteCategoryGet($id){
        // return $id;
        $findCategoryData = Category::where('id',$id)->first();
        if(isset($findCategoryData)){
            Category::where('id',$id)->delete();
            return response()->json(['status'=>true,'message'=>'delete success'],200);
        }
         return response()->json(['status'=>false,'message'=>'There is no such ID.'],200);
    }

    //update
    public function updateCategory(Request $request){
        $categoryId = $request->category_id;
        $dbCategory = Category::where('id',$categoryId)->first();


        if(isset($dbCategory)){
            $getBack = $this->getCategoryData($request);
            $finalReturn = Category::where('id',$categoryId)->update($getBack);
            return response()->json(['status'=>true,'message'=>'update success','category'=>$finalReturn],200);
        }
        return response()->json(['status'=>false,'message'=>'you can update an unexisting category'],500);
    }
    //private functions
    private function getCategoryData($request){
        return[
            'name'=>$request->category_name,
            'updated_at'=>carbon::now()
        ];
    }
}
