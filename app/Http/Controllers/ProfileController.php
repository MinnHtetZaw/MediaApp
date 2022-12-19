<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    // direct admin home page
    public function index(){
        $id =Auth:: user()->id;
        $userinfo= User::select('id','name','email','phone','address','gender')->where('id',$id)->first();
        return view('admin.profile.index')->with(['user'=>$userinfo]);
        // return view('admin.profile.index',compact('userinfo'));
    }

    // update Admin
    public function updateAdmin(Request $request){
        $userData = $this->getUserInfo($request);

        $validator = $this->validationCheck($request);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        User::where('id',Auth::user()->id)->update($userData);
        return back()->with(['updateSuccess'=>'Admin accoutn updated!']);
    }

    // Show Password change page

    public function showPassword(){
        return view('admin.profile.changePassword');
    }

    public function changePassword(Request $request){
       $validator = $this->validationCheckPassword($request);

       if ($validator->fails()) {
        return back()
                    ->withErrors($validator)
                    ->withInput();
    }
        // $userPassword =$this->getUserPassword($request);
        $dbData=User::where('id',Auth::user()->id)->first();
        $dbPassword =$dbData->password;
        $updateDate =[
            'password' => Hash::make($request->newPassword),
            'updated_at' => Carbon::now()
        ];

        if (Hash::check($request->oldPassword, $dbPassword)){
            User::where('id',Auth::user()->id)->update($updateDate);
            return redirect()->route('dashboard');
        }else{
            return back ()->with(['fail'=>'Old Password does not Match!']);
        }
    }

    private function getUserInfo($request){
        return [
            'name' => $request->adminName,
            'email'=> $request->adminEmail,
            'phone'=> $request->adminPhone,
            'address'=>$request->adminAddress,
            'gender'=>$request->adminGender,
            'updated_at'=>Carbon::now()
        ];
    }

    private function validationCheck($request){

      return  Validator::make($request->all(), [

            'adminName' => 'required',
            'adminEmail' => 'required'
        ]);
    }
    private function validationCheckPassword($request){
        $validatoinRule= [

            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmedPassword'=>'required|same:newPassword',
            ];

            $validatoinMessage =[
                'confirmedPassword.same' => 'New Password & Confrimed Password must be same!'
            ];
          return  Validator::make($request->all(),$validatoinRule,$validatoinMessage) ;

    }

}
