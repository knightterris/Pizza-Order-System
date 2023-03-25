<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category list  page
    public function list(){
        //dd()
        $categories = Category::when(request('key'),function($query){
                                $query->where('name','like','%'.request('key').'%');
                                })
                                ->orderBy('id','desc')->paginate(4);
        // dd($categories->toArray());
        return view ('admin.category.list',compact('categories'));
    }
    //direct category creeate page
    public function createPage(){
        return view ('admin.category.create');
    }
    //create category
    public function create(Request $request){
        // dd($request->all());
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#list')->with(['createSuccess'=>'Category created successfully!!!!']);
    }
    //delete category
    public function delete($id){
        // dd($id);
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Category deleted successfully!!!!']);
    }
    //edit category
    public function edit($id){
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }
    //update category
    public function update(Request $request){
        // dd($request->all());
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('category#list')->with(['updateSuccess'=>'Category updated successfully!!!!']);
    }
    //private functions
    //categoryValidationCheck
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName' => 'required||min:5|unique:categories,name,'.$request->categoryId
        ])->validate();
    }
    //requestCategoryData
    private function requestCategoryData($request){
        return[
            'name' => $request->categoryName
        ];
    }
}
