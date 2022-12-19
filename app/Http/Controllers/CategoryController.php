<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    //direct Category page
    public function index(){
        $category=Category::get();
        return view('admin.category.index',compact('category'));
    }

    // create category
    public function createCategory(Request $request){


        $validator = $this->validationCheck($request);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $categoryData = $this->categoryData($request);
        Category::create($categoryData);

        return back();
    }

    // delete Category

    public function deleteCategory($id){

        Category::where('category_id',$id)->delete();
        return redirect()->route('admin#category')->with(['deleteSuccess'=>'Category is deleted!']);
    }

    //Search Category

    public function searchCategory(Request $request){
       $category = Category::where('title','LIKE','%'.$request->categorySearch.'%')->get();
        return view('admin.category.index',compact('category'));
    }

    //  Category Edit page

    public function editCategory($id){
        $category = Category::get();
        $updateData= Category::where('category_id',$id)->first();
        return view('admin.category.edit',compact('category','updateData'));
    }

    //  Category Update page

    public function updateCategory(Request $request,$id){
        $validator=$this->validtaionUpdateCategoryCheck($request);
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $updateData = [
            'title' => $request->categoryName,
            'description'=> $request->categoryDescription,
        ];
            Category::where('category_id',$id)->update($updateData);
            return redirect()->route('admin#category');
    }


    // get category Data
    private function categoryData($request){
        return [
            'title' =>$request->categoryName,
            'description'=>$request->categoryDescription,
        ];
    }

    // category Validation Check
    private function validationCheck($request){

        return  Validator::make($request->all(), [

              'categoryName' => 'required',
              'categoryDescription' => 'required'
          ]);
      }

      // category Update Validation Check
        private function validtaionUpdateCategoryCheck($request){
            return  Validator::make($request->all(), [

                'categoryName' => 'required',
                'categoryDescription' => 'required'
            ]);
        }
}
