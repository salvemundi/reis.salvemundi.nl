<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

// This controller  is commonly referred to as blog / news controller. Previous PR #12 caused a naming nightmare. (May or may not have been me.)
class BlogController extends Controller
{
    public function showPosts() {
        $posts = Blog::all();
        return view('blogs',['posts' => $posts]);
    }

    public function showPostsAdmin() {
        $posts = Blog::all();
        return view('admin/blogs',['posts' => $posts]);
    }

    public function showPost(Request $request) {
        $postId = $request->postId;
    }

    public function savePost(Request $request) {
        $post = null;
        if($request->input('blogId')) {
            $post = Blog::find($request->input('blogId'));
        } else {
            $post = new Blog;
        }

        $post->name =  $request->input('name');
        $post->content =  $request->input('content');
        $post->save();
        return redirect('/blogsadmin')->with('success', 'Blog is opgeslagen!');
    }

    public function showPostInputs(Request $request) {
        $post = null;
        if($request->blogId){
            $post = Blog::find($request->blogId);
        }
        return view('admin/blogInput',['post' => $post]);
    }

    public function deletePost(Request $request) {
        if($request->blogId) {
            $blog = Blog::find($request->blogId);
            if($blog != null) {
                $blog->delete();
                return redirect('/blogsadmin')->with('success', 'Blog is verwijderd!');
            }
            return redirect('/blogsadmin')->with('error', 'Blog kon niet gevonden worden!');

        }
        return redirect('/blogsadmin')->with('error', 'Er ging iets niet helemaal goed, probeer het later nog een keer.');
    }
}
