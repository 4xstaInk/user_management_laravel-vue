<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        return Post::orderBy('created_at', 'DESC')->get();
    }
    public function page()
    {
        return view('posts.post');
    }
    public function store(Request $request)
    {
       // $newPost = new Post;
       // $newPost = $request->post["name, email, post"];
       // $newPost->save();
        // return $newPost;  

        $name = $request->input('name');
        $email = $request->input('email');
        $post = $request->input('post');

    $posted = DB::insert('insert into posts(id,name,email,post) values(?,?,?,?)',[null,$name,$email,$post]);
    echo $posted;

    }  
    public function showPosts()
    {
        $listPosts = Post::select('id', 'name','email', 'post')->orderBy('id','desc')->get();
        return response()->json(['listOfPosts' => $listPosts]);
       //return response()->json(['listOfPosts'=> Post::latest()]);
    }
    
}
