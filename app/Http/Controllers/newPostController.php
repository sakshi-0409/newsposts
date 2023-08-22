<?php

namespace App\Http\Controllers;

use App\Models\Newpost;
use Illuminate\Http\Request;

class newPostController extends Controller
{
    public function index(){
        return view('pages/newpost');
    }
    public function store(Request $request){
        // dd($request);
        $newpost = new Newpost;
        $newpost->post_title = $request->post_title;
        $newpost->post_image = $request->post_image;
        if ($request->hasfile('post_image')) {
            $file = $request->file('post_image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('img/', $filename);
            
            $newpost->post_image = $filename;
        } else {
            return $request;
            $newpost->p_image = '';
        }
        $newpost->post_url = $request->post_url;
        $newpost->post_des = $request->post_des;
        $newpost->status = $request->status;
        $newpost->save();
        return response()->json(['msg'=>'successfull']);

    }
    public function show(){
        $posts = Newpost::all();
        $data = compact('posts');
        return view('pages/allposts')->with($data);
    }
    public function delete(Request $request){
        // dd($request->id);
        $post = Newpost::find($request->id);
        // dd($post);
        $post->delete();
        return response()->json(['msg'=>'successfull']);

    }
}
