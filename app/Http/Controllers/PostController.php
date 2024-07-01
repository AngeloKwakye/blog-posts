<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function showEditScreen(Post $postId){
        if(auth()->user()->id !== $postId['user_id']){
            return redirect('/');
        };
        return view('edit-post', ['post' => $postId]);
    }


    public function createPost(Request $request){
        $incomingData = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingData['title'] = strip_tags($incomingData['title']);
        $incomingData['body'] = strip_tags($incomingData['body']);
        $incomingData['user_id'] = auth()->id();
        Post::create($incomingData);
        return redirect('/');
    }

    public function updatePost(Post $post, Request $request){
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        };

        $incomingData = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        $incomingData['title'] = strip_tags($incomingData['title']);
        $incomingData['body'] = strip_tags($incomingData['body']);
        
        $post->update($incomingData);
        return redirect('/');
    }
    public function deletePost(Post $post){
        if(auth()->user()->id === $post['user_id']){
            $post->delete();
        };
        return redirect('/');
    }
}
