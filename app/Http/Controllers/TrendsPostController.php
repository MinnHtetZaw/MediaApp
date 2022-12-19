<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrendsPostController extends Controller
{
    //direct trendPost page
    public function index(){
        return view('admin.trends_post.index');
    }
}
