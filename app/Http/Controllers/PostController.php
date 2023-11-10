<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function deletePost(Post $post){
        if(auth()->user()->id === $post['user_id']){
            $post->delete();
           
        }
        return redirect('/');

    }
    public function actuallyUpdatePost(Post $post, Request $request){
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048',
           


        ]);

        $newImageName = time() . '-' .  $request->name . '.' .
        $request->image->extension();

    
        $request->image->move(public_path('images'), $newImageName);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);       
        $incomingFields['image_path'] = $newImageName;       

        $post->update($incomingFields);
        return redirect('/');

    }
    public function showEditScreen(Post $post){
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');

        }
        return view('edit-post', ['post' => $post]);

    }
    public function createPost(Request $request){
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048',
           
        ]);

        $newImageName = time() . '-' .  $request->name . '.' .
        $request->image->extension();

    
        $request->image->move(public_path('images'), $newImageName);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id']= auth()->id();
        $incomingFields['image_path'] = $newImageName;       
    

        Post::create($incomingFields);
        return redirect('/');


    }
}
