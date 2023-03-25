<?php

namespace App\Http\Controllers\User;
use Storage;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //direct list page
    public function userList(){
        $users = User::when(request('key'),function($query){
                        $query->orWhere('name','like','%'.request('key').'%')
                            ->orWhere('email','like','%'.request('key').'%')
                            ->orWhere('phone','like','%'.request('key').'%')
                            ->orWhere('address','like','%'.request('key').'%')
                            ->orWhere('gender','like','%'.request('key').'%');
                            
        })
                            ->where('role','user')->paginate(3);

        return view('admin.user.list',compact('users'));
    }
    //userChangeRole
    public function userChangeRole(Request $request){
        // logger($request->all());
        $updateSource = [
            'role' =>$request->role
        ];
        User::where('id',$request->userId)->update($updateSource);
        
    }
    //direct contact Page
    public function contactPage(){
        return view('user.contact.comments');
    }

    //contact user ->admin
    public function contact(Request $request){
        // dd($request->all());
        $this->messageValidationCheck($request);
        $messageData = $this->requestMessageData($request);
        // dd($messageData);
        Contact::create($messageData);
        return redirect()->route('user#home')->with(['messageSent'=>'Thanks for your review. We will keep in touch with you and will make our service Better.']);
    }

    //direct read page
    public function readPage($id){
        // dd($id);
        $showMessage = Contact::where('id',$id)->get();
        // dd($showMessage->toArray());
        return view('admin.user.read',compact('showMessage'));
    }
    //delete Message
    public function deleteMessage($id){
        // dd('deleted');
        // dd($id);
        Contact::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'You have deleted a message successfully.']);
    }
    //delete all messages
    public function deleteAll(){
        Contact::truncate();
        return back()->with(['deleteAll'=>'Deleted all messages successfully.']);
    }
  
    //direct user home page
    public function home(){
        $pizza = Product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        // dd($cart->toArray());
        return view('user.main.home',compact('pizza','category','cart','history'));
    }
    //direct changePassword Page
    public function changePasswordPage(){
        return view('user.password.change');
    }
    //changePassword
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $currentUserId = Auth::user()->id;
        $user = User::select('password')->where('id',$currentUserId)->first();
        $dbHashValue = $user->password;
        
        if(Hash::check($request->oldPassword, $dbHashValue)){
            $data = ['password' => Hash::make($request->newPassword)];
            User::where('id',Auth::user()->id)->update($data); 
            Auth::logout();
            return redirect()->route('auth#loginPage')->with(['passwordChangeSuccess' => 'Your Password Has Changed Successfully.']);
        }
        return back()->with(['notMatch'=>'Old Passwords do no match.']);
    }
    //user account change page
    public function accountChangePage(){
        return view('user.profile.account');
    }
    //user account change
    public function accountChange($id,Request $request){
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);
        //for image
        if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;
            // dd($dbImage);
            //delete foto
             if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            // dd($fileName);
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
           
        }
        User::where('id',$id)->update($data);
        return back()->with(['updateSuccess'=>'Your Account Info has been successfully updated.']);
    }
    //filter
    public function filter($categoryId){
        // dd($categoryId);
        $pizza = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));

    }
    //direct pizza details
    public function pizzaDetails($pizzaId){
        $pizza = Product::where('id',$pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.details',compact('pizza','pizzaList'));
    }
    //cart list
    public function cartList(){
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as product_image')
                            ->leftJoin('products','products.id','carts.product_id')
                            ->where('carts.user_id',Auth::user()->id)->get();
        // dd($cartList->toArray());

        $totalPrice = 0;
        foreach($cartList as $c){
            $totalPrice += $c->pizza_price*$c->qty;
        }
        // dd($totalPrice);
        return view('user.main.cart',compact('cartList','totalPrice'));
    }
    //direct user history page
    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(5);
        return view('user.main.history',compact('order'));
    }

    //private functions
    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6|max:10',
            'newPassword' => 'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|max:10|same:newPassword'
        ])->validate();
    }
    private function getUserData($request){
        return[
            'name'=> $request-> name ,
            'email'=> $request-> email,
            'gender'=> $request-> gender,
            'phone' => $request -> phone,
            'address' => $request-> address,
            'updated_at' => Carbon::now()
        ];
    }
    //accountValidationCheck
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'image' => 'mimes:png,jpeg,jpg,webp|file'
        ])->validate();
    }
    //message validation check
    private function messageValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required'
        ])->validate();
    }
    //request message data 
    private function requestMessageData($request){
        return[
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'message'=>$request->message
        ];
    }
    
}
