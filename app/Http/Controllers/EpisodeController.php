<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Season;
use App\Episode;

class EpisodeController extends Controller
{

    public function index($season_id)
    {
        $data = Episode::where('season_id', $season_id)->orderBy('id', 'desc')->get();
        return view('episode.index', compact('data', 'season_id'));
    }

    public function create($season_id)
    {
        $season = Season::findOrFail($season_id);
        return view('episode.create', compact('season'));
    }

    public function store(Request $request)
    {
        $data = new Episode;
        $data->name = $request->name;
        $data->item_id = $request->series_id;
        $data->season_id = $request->season_id;
        $data->link = $request->link;
        $data->quality = $request->quality;
        $data->subtitle = $request->subtitle;
        if ($data->save()) {
            return redirect('season/' . $request->season_id . '/episode');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Episode::findOrFail($id);
        return view('episode.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Episode::findOrFail($id);
        $data->name = $request->name;
        $data->item_id = $request->item_id;
        $data->season_id = $request->season_id;
        $data->link = $request->link;
        $data->quality = $request->quality;
        $data->subtitle = $request->subtitle;
        if ($data->update()) {
            return redirect('season/' . $request->season_id . '/episode');
        }
    }

    public function destroy($id)
    {
        $data = Episode::findOrFail($id);
        if ($data->delete()) {
            return back();
        }
    }
}
