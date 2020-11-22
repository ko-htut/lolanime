<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Item;
use App\Category;
use App\Language;

class SeriesController extends Controller
{

    public function index()
    {
        $data = Item::where('type','Series')
                                ->leftJoin('categories as cat','cat.id','items.category_id')
                                ->select(
                                    'items.id',
                                    'items.name',
                                    'items.poster',
                                    'items.cover',
                                    'items.download_count',
                                    'items.watch_count',
                                    'cat.name as category'
                                    )
                                ->paginate();
        return view('series.index',compact('data'));
    }

    public function create()
    {
        $category = Category::orderBy('name','asc')->get();
        $language = Language::orderBy('name','asc')->get();
        return view('series.create', compact('category','language'));
    }

    public function store(Request $request)
    {
        $data = new Item;
        $data->name = $request->name;
        $data->slug = Str::slug($request->name, '-');
        $data->type = 'Series';
        $data->release_year = $request->release_year;
        $data->content_rating = $request->content_rating;
        $data->imdb_rating = $request->imdb_rating;
        $data->language_id = $request->language_id;
        $data->description = $request->description;
        $data->is_feature = $request->is_feature;
        if($request->poster){
            $imageName = time().'_'.'poster.'.$request->poster->getClientOriginalExtension();
            $request->poster->move('images/poster/', $imageName);
            $data->poster = $imageName;
        }
        if($request->cover){
            $imageName = time().'_'.'cover.'.$request->cover->getClientOriginalExtension();
            $request->cover->move('images/cover/', $imageName);
            $data->cover = $imageName;
        }
        if($data->save()){
            $data->category()->sync($request->category_id);
            return redirect()->route('series.index');
        }else{
            return redirect()->route('series.index');
        }
    }

    public function show($id)
    {
        $data = Item::findOrFail($id);
        return view('series.show',compact('data'));
    }

    public function edit($id)
    {
        $data = Item::findOrFail($id);
        $language = Language::get();
        return view('series.edit',compact('data','language'));
    }

    public function update(Request $request, $id)
    {
        $data = Item::findOrFail($id);
        $data->name = $request->name;
        $data->slug = Str::slug($request->name, '-');
        $data->type = 'Series';
        $data->release_year = $request->release_year;
        $data->content_rating = $request->content_rating;
        $data->imdb_rating = $request->imdb_rating;
        $data->language_id = $request->language_id;
        $data->description = $request->description;
        $data->is_feature = $request->is_feature;
        if($request->poster){
            $imageName = time().'_'.'poster.'.$request->poster->getClientOriginalExtension();
            $request->poster->move('images/poster/', $imageName);
            $data->poster = $imageName;
        }
        if($request->cover){
            $imageName = time().'_'.'cover.'.$request->cover->getClientOriginalExtension();
            $request->cover->move('images/cover/', $imageName);
            $data->cover = $imageName;
        }
        if($data->update()){
            $data->category()->sync($request->category_id);
            return redirect()->route('series.index');
        }else{
            return redirect()->route('series.index');
        }
    }

    public function destroy($id)
    {
        $data = Item::findOrFail($id);
        if($data->delete()){
            return back();
        }else{
            return back();
        }
    }
}
