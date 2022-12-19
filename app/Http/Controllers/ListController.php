<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    //direct list page
    public function index(){
        $userData=User::get();
        return view('admin.list.index',compact('userData'));
    }

    // delete function
    public function delete($id){
        User:: where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Account is deleted!']);
    }

    //Search Admin List
    public function search(Request $request){
           $userData= User::orWhere('name','LIKE','%'.$request->SearchAdmin.'%')
                ->orWhere('email','LIKE','%'.$request->SearchAdmin.'%')
                ->orWhere('address','LIKE','%'.$request->SearchAdmin.'%')
                ->orWhere('phone','LIKE','%'.$request->SearchAdmin.'%')
                ->orWhere('gender','LIKE','%'.$request->SearchAdmin.'%')
                ->get();
        return view('admin.list.index',compact('userData'));
    }
}
