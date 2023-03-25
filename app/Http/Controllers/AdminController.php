<?php

namespace App\Http\Controllers;
use Storage;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //changeAdminRole with AAJAX
    public function changeAdminRole(Request $request){
        // logger($request->all());
        $updateAdminToUser = [
            'role'=>$request->role
        ];
        User::where('id',$request->adminId)->update($updateAdminToUser);
    }
    //direct comments page
    public function comments(){
        $clientMessage = Contact::paginate(4);
        // dd($clientMessage->toArray());
        return view('admin.user.comments',compact('clientMessage'));
    }
    //change password page
    public function changePasswordPage(){
        return view('admin.account.change');
    }
    //changePassword
    public function changePassword(Request $request){
        // dd($request->all());
        //requirements
        // 1 . all fields must be filled. 2 . user pw must be same with the one in DB 3 . new pw length == && same with confirm pw length
        
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
        return back()->with(['notMatch'=>'Passwords do no match.']);
        // dd($dbPassword);
        // dd($user->toArray());
        // dd("password has changed!!!!");

    }
    //direct details page
    public function details(){
        return view('admin.account.details');
    }
    //direct admin update profile page
    public function edit(){
        return view('admin.account.edit');
    }
    //admin account update
    public function update($id,Request $request){
        // dd($id,$request->all());

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
        return redirect()->route('admin#details')->with(['updateSuccess'=>'Your Account Info has been successfully updated.']);
    }
    //direct admin list page
    public function list(){
        $admin = User::when(request('key'),function($query){
                        $query->orWhere('name','like','%'.request('key').'%')
                                ->orWhere('email','like','%'.request('key').'%')
                                ->orWhere('address','like','%'.request('key').'%')
                                ->orWhere('phone','like','%'.request('key').'%')
                                ->orWhere('gender','like','%'.request('key').'%');
                })
                    ->where('role','admin')->paginate(4);
        // dd($admin->toArray());
        return view('admin.account.list',compact('admin'));
    }
    //delete account
    public function delete($id){
        // dd('deleted');
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'You have deleted an account successfully!!!!']);
    }
    // direct change role
    public function changeRole($id){
        $account = User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
    }
    //change admin
    public function change($id,Request $request){
        $data = $this->requestUserData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
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
    //getUserData 
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
    //requestUserData
    private function requestUserData($request){
        return[
            'role' =>$request->role
        ];
    }
}
