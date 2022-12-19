<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //direct Post page
    public function index(){
        $categoryData= Category::get();
        $post=Post::get();
        return view('admin.post.index',compact('categoryData','post'));
    }

    // Create Post

    public function createPost(Request $request){
        $validator =$this->validationPostCheck($request);
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        // Image Storage
       if(!empty($request->postImage))
       {
        $file = $request->file('postImage');
        $fileName=uniqid().'_'.$file->getClientOriginalName();
        $file->move(public_path().'/postImage',$fileName);

        $postData=$this->getPostData($request,$fileName);
       }
       else{
        $postData=$this->getPostData($request,Null);
       }

        Post::create($postData);
        return back();

    }


    // Delete Post Page

    public function deletePost($id){
       $postData = Post::where('post_id',$id)->first();
       $dbImage = $postData['image'];
        Post::where('post_id',$id)->delete();
        if(File::exists(public_path().'/postImage/'.$dbImage)){
            File::delete(public_path().'/postImage/'.$dbImage);
        }
        return back();
    }

    // Update Post Page

    public function updatePost($id){
            $postDetail= Post::where('post_id',$id)->first();
            $categoryData= Category::get();
            $post=Post::get();
            return view('admin.post.update',compact('postDetail','categoryData','post'));;
    }

    // Edit Post Page

    public function editPost(Request $request, $id){
        $validator =$this->validationPostCheck($request);
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data= $this->getUpdatePostData($request);

        if(isset($request->postImage)){
            $file = $request->file('postImage');
            $fileName=uniqid().'_'.$file->getClientOriginalName();

            $data['image']=$fileName;

            $postData = Post::where('post_id',$id)->first();
            $dbImage = $postData['image'];



             if(File::exists(public_path().'/postImage/'.$dbImage)){
                 File::delete(public_path().'/postImage/'.$dbImage);
               }

             $file->move(public_path().'/postImage',$fileName);

             Post::where('post_id',$id)->update($data);


        }else{
            Post::where('post_id',$id)->update($data);
        }

        return back();
    }

    // Post Create Validation Page

    private function validationPostCheck($request){
        return  Validator::make($request->all(), [

            'postTitle' => 'required',
            'postCategory' => 'required',
            'postDescription'=>'required'
        ]);
    }

    // Database Post Detail

    private function getPostData($request,$fileName){
        return [
            'title'=>$request->postTitle,
            'description'=>$request->postDescription,
            'category_id'=>$request->postCategory,
            'image'=>$fileName,
        ];
    }

    // Update Post Data
    private function getUpdatePostData($request){
            return[
                'title'=>$request->postTitle,
                'description'=>$request->postDescription,
                'category_id'=>$request->postCategory,

            ];
    }
}
