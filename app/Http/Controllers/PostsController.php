<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Posts\AddPostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    public function index()
    {
        // This gets us all the posts inside the posts table
        $posts = Post::paginate(10);
        if($posts)
        {
            return response()->json(["status" => "success","response" => $posts],200);
        }
    }

    public function indexAll()
    {
        // This gets us all the posts inside the posts table
        $posts = Post::all();
        if($posts)
        {
            return response()->json(["status" => "success","response" => $posts],200);
        }
    }


    public function getPostsById($id)
    {
        $posts = Post::with(["user"])->where("user_id",$id)->paginate(8);
        if($posts)
        {
            return response()->json(["status" => "success","response" => $posts],200);
        }
    }

    public function getById($id)
    {
        $post = Post::findOrFail($id);
        if($post)
        {
            return response()->json(["status" => "success","response" => $post],200);
        }
    }
    public function create(AddPostRequest $request, $id)
    {
        // This function will add  a post into the posts table
        $post = new Post();
       $post->title = $request->title;
       $post->posted_date = now();
       $post->description = $request->description;
       $path = "";
       if ($request->file("image")) {
           $path = Storage::disk('public')->put('', $request->file("image"));
       }
       if ($path != "") {
        $post->image = $path;
        } else {
        $post->image = "health-default.jpeg";
        }
       $post->user_id = $id;
       $post->save();
       return response()->json(["status" => "success","response" => "Post was added successfully"],200);
    }

    public function edit(UpdatePostRequest $request,$id)
    {
        // This function will update an available post

        $path = "";
        if ($request->file("image")) {
            $path = Storage::disk('public')->put('', $request->file("image"));
        }
        if ($path != "") {
            $post = DB::update('UPDATE posts SET title = ?,description = ?,image = ? WHERE posts.id = ?', [$request->title,$request->description,$path,$id]);
        } else {
            $post = DB::update('UPDATE posts SET title = ?,description = ? WHERE posts.id = ?', [$request->title,$request->description,$id]);
         }

         return response()->json(["status" => "success","response" => "Post was updated successfully !"]);
    }

    public function destroy($id)
    {
        // This function will search for a post with id = $id and delete it
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json(["status" => "success","response" => "Post was deleted successfully !"]);
    }
}
