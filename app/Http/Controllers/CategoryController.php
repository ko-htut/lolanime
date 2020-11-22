<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Item;
use App\Category;

class CategoryController extends Controller
{

    // category list for vue //
    public function vue_category(){
        $category = Category::orderBy('name','asc')->get()->toArray();
        return response()->json($category);
    }

    public function index()
    {
        $data = Category::orderBy('name','asc')->paginate();
        return view('category.index',compact('data'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $data = new Category;
        $data->name = $request->name;
        $data->slug = Str::slug($request->name, '-');
        if($data->save()){
            return redirect()->route('category.index');
        }
    }

    public function show($id)
    {
        $data = Item::where('category_id',$id)->orderBy('id','desc')->paginate();
        return view('category.show',compact('data'));
    }

    public function edit($id)
    {
        $data = Category::findOrFail($id);
        return view('category.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Category::findOrFail($id);
        $data->name = $request->name;
        $data->slug = Str::slug($request->name, '-');
        if($data->update()){
            return redirect()->route('category.index');
        }
    }

    public function destroy($id)
    {
        $data = Category::findOrFail($id);
        if($data->delete()){
            return back();
        }
    }
}
