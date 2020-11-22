<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Item;
use App\Language;

class LanguageController extends Controller
{

    public function index()
    {
        $data = Language::orderBy('name','asc')->paginate();
        return view('language.index',compact('data'));
    }

    public function create()
    {
        return view('language.create');
    }

    public function store(Request $request)
    {
        $data = new Language;
        $data->name = $request->name;
        $data->slug = Str::slug($request->name, '-');
        if($data->save()){
            return redirect()->route('language.index');
        }
    }

    public function show($id)
    {
        $data = Item::where('language_id',$id)->orderBy('id','desc')->paginate();
        return view('language.show',compact('data'));
    }

    public function edit($id)
    {
        $data = Language::findOrFail($id);
        return view('language.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Language::findOrFail($id);
        $data->name = $request->name;
        $data->slug = Str::slug($request->name, '-');
        if($data->update()){
            return redirect()->route('language.index');
        }
    }

    public function destroy($id)
    {
        $data = Language::findOrFail($id);
        if($data->delete()){
            return back();
        }
    }
}
