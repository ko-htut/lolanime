<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Item;
use App\Category;
use App\Language;
use App\Episode;

class MovieController extends Controller
{

    public function index()
    {
        $data = Item::where('items.type', 'Movie')
            ->leftJoin('categories as cat', 'cat.id', 'items.category_id')
            ->select(
                'items.id',
                'items.name',
                'items.poster',
                'items.cover',
                'items.download_count',
                'items.watch_count',
                'cat.name as category'
            )
            ->orderBy('id', 'desc')
            ->paginate();
        return view('movie.index', compact('data'));
    }

    public function create()
    {
        $category = Category::orderBy('name', 'asc')->get();
        $language = Language::orderBy('name', 'asc')->get();
        return view('movie.create', compact('category', 'language'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $data = new Item;
        $data->name = $request->name;
        $data->slug = Str::slug($request->name, '-');
        $data->type = 'Movie';
        $data->release_year = $request->release_year;
        $data->content_rating = $request->content_rating;
        $data->imdb_rating = $request->imdb_rating;
        $data->language_id = $request->language_id;
        $data->description = $request->description;
        $data->is_feature = $request->is_feature;
        $data->status = $request->status;
        $data->duration = $request->duration;
        $data->episode_count = $request->episode_count;
        if ($request->poster) {
            $imageName = time() . '_' . 'poster.' . $request->poster->getClientOriginalExtension();
            $request->poster->move('images/poster/', $imageName);
            $data->poster = $imageName;
        }
        if ($request->cover) {
            $imageName = time() . '_' . 'cover.' . $request->cover->getClientOriginalExtension();
            $request->cover->move('images/cover/', $imageName);
            $data->cover = $imageName;
        }
        if ($data->save()) {
            $data->category()->sync($request->category_id);
            return redirect()->route('movie.index');
        } else {
            return redirect()->route('movie.index');
        }
    }

    public function show($id)
    {
        $data = Item::findOrFail($id);
        $episode = Episode::where('item_id',$data->id)->orderBy('id','desc')->get();
        return view('movie.show',compact('data','episode'));
    }

    public function edit($id)
    {
        $data = Item::findOrFail($id);
        $category = Category::orderBy('name', 'asc')->get();
        $language = Language::orderBy('name', 'asc')->get();
        return view('movie.edit', compact('data', 'category', 'language'));
    }

    public function update(Request $request, $id)
    {
        $data = Item::findOrFail($id);
        $data->name = $request->name;
        $data->slug = Str::slug($request->name, '-');
        $data->type = 'Movie';
        $data->release_year = $request->release_year;
        $data->content_rating = $request->content_rating;
        $data->imdb_rating = $request->imdb_rating;
        $data->language_id = $request->language_id;
        $data->description = $request->description;
        $data->link = $request->link;
        $data->quality = $request->quality;
        $data->subtitle = $request->subtitle;
        $data->is_feature = $request->is_feature;
        $data->status = $request->status;
        $data->duration = $request->duration;
        $data->episode_count = $request->episode_count;
        if ($request->poster) {
            $imageName = time() . '_' . 'poster.' . $request->poster->getClientOriginalExtension();
            $request->poster->move('images/poster/', $imageName);
            $data->poster = $imageName;
        }
        if ($request->cover) {
            $imageName = time() . '_' . 'cover.' . $request->cover->getClientOriginalExtension();
            $request->cover->move('images/cover/', $imageName);
            $data->cover = $imageName;
        }
        if ($data->update()) {
            $data->category()->sync($request->category_id);
            return redirect()->route('movie.index');
        } else {
            return redirect()->route('movie.index');
        }
    }

    public function destroy($id)
    {
        $data = Item::findOrFail($id);
        if ($data->delete()) {
            return back();
        } else {
            return back();
        }
    }

    public function episodeList(){

    }

    public function episodeCreate($id){
        $movie = Item::findOrFail($id);
        return view('movie.episode.create',compact('movie'));
    }

    public function episodeStore(Request $request){
        $data = new Episode;
        $data->name = $request->name;
        $data->item_id = $request->item_id;
        $data->link = $request->link;
        $data->quality = $request->quality;
        $data->subtitle = $request->subtitle;
        if ($data->save()) {
            $movie = Item::findOrFail($data->item_id);
            return redirect()->route('movie.show',$movie);
        }
    }

    public function episodeEdit($id){
        $data = Episode::findOrFail($id);
        return view('movie.episode.edit',compact('data'));
    }

    public function episodeUpdate(Request $request, $id){
        $data = Episode::findOrFail($id);
        $data->name = $request->name;
        $data->item_id = $request->item_id;
        $data->season_id = $request->season_id;
        $data->link = $request->link;
        $data->quality = $request->quality;
        $data->subtitle = $request->subtitle;
        if ($data->update()) {
            $movie = Item::findOrFail($data->item_id);
            return redirect()->route('movie.show',$movie);
        }
    }

    public function episodeDelete($id){
        $data = Episode::findOrFail($id);
        if ($data->delete()) {
            return back();
        } else {
            return back();
        }
    }
}
