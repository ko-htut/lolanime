<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $data = Post::orderBy('id','desc')->paginate();
        return view('post.index',compact('data'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $data = new Post;
        $data->title = $request->title;
        $data->slug = Str::slug($request->title, '-');
        $data->description = $request->description;
        if($request->file('image')){
            $imageName = time() . '_' . 'post.' . $request->image->getClientOriginalExtension();
            $request->image->move('images/post/', $imageName);
            $data->image = $imageName;
        }
        if($data->save()){
            return redirect()->route('post.index');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Post::findOrFail($id);
        return view('post.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Post::findOrFail($id);
        $data->title = $request->title;
        $data->slug = Str::slug($request->title, '-');
        $data->description = $request->description;
        if($request->file('image')){
            $imageName = time() . '_' . 'post.' . $request->image->getClientOriginalExtension();
            $request->image->move('images/post/', $imageName);
            $data->image = $imageName;
        }
        if($data->update()){
            return redirect()->route('post.index');
        }
    }
    
    public function destroy($id)
    {
        $data = Post::findOrFail($id);
        if($data->delete()){
            return back();
        }
    }
}
