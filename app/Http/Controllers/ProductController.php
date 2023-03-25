<?php

namespace App\Http\Controllers;
use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    //direct product list page
    public function list(){
        $pizzas = Product::select('products.*','categories.name as category_name')
                            ->when(request('key'),function($query){
                            $query->where('products.name','like','%'.request('key').'%');
        })
                            ->leftJoin('categories','products.category_id','categories.id')
                            ->orderBy('products.created_at','desc')->paginate(4);
        return view('admin.product.pizzaList',compact('pizzas'));
    }
    //direct pizza create page
    public function createPage(){
        $categories = Category::select('id','name')->get();
        // dd($categories->toArray());
        return view('admin.product.create',compact('categories'));
    }
    //pizza create
    public function create(Request $request){
        // dd($request->all());
        $this->productValidationCheck($request,"create");
        $data = $this->requestProductInfo($request);
       
            $fileNmae = uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$fileNmae);
            $data['image'] = $fileNmae;
        
        Product::create($data);
        return redirect()->route('product#list');
    }
    //delete pizza 
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['deletePizzaSuccess'=>'You have deleted a pizza successfully.']);
        // return back()->with(['deletePizzaSuccess'=>'You have deleted a pizza successfully.']);
    }
    //edit && view pizza
    public function edit($id){
        $pizza = Product::select('products.*','categories.name as category_name')
                            ->leftJoin('categories','products.category_id','categories.id')
                            ->where('products.id',$id)->first();
        return view('admin.product.edit',compact('pizza'));
    }
    // go to update pizzaPage
    public function updatePage($id){
        $pizza = Product::where('id',$id)->first();
        $category = Category::get();
        return view('admin.product.update',compact('pizza','category'));
    }
    //update pizza
    public function update(Request $request){
        $this->productValidationCheck($request,"update");
        // dd('success');
        $data = $this->requestProductInfo($request);
        // dd($data);
        if($request->hasFile('pizzaImage')){
            $oldImageName = Product::where('id',$request->pizzaId)->first();
            $oldImageName = $oldImageName->image;
            // dd($oldImageName);
            if($oldImageName != null){
                Storage::delete('public/'.$oldImageName);
            }
            $fileNmae = uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$fileNmae);
            $data['image'] = $fileNmae;

        }

        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('product#list')->with(['updatePizzaSuccess'=>'You have successfully updated a pizza.']);
    }


    //private functions
    //product Validation Check
    private function productValidationCheck($request,$action){

        

        $validationRules = [
            'pizzaName' => 'required|min:5|unique:products,name,'. $request->pizzaId,
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required|min:10',
            'pizzaPrice' => 'required',
            'pizzaWaitingTime' =>'required'
        ];

        $validationRules['pizzaImage'] = $action == "create" ? 'required|mimes:png,jpg,jpeg,webp|file' : 'mimes:png,jpg,jpeg,webp|file';
        // dd($validationRules);
        Validator::make($request->all(),$validationRules)->validate();
    }
    //Request Product Info
    private function requestProductInfo($request){
        return[
            'category_id' => $request->pizzaCategory,
            'name' => $request->pizzaName,
            'description' => $request->pizzaDescription,
            'price' => $request->pizzaPrice,
            'waiting_time' =>$request->pizzaWaitingTime
        ];
    }
}
