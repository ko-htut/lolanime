<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Season;

class SeasonController extends Controller
{

    public function index($series_id)
    {
        $data = Season::where('series_id', $series_id)->orderBy('name', 'desc')->paginate();
        return view('season.index', compact('data', 'series_id'));
    }

    public function create($series_id)
    {
        return view('season.create', compact('series_id'));
    }

    public function store(Request $request)
    {
        $data = new Season;
        $data->name = $request->name;
        $data->series_id = $request->series_id;
        $data->review = $request->review;
        if ($data->save()) {
            return redirect('series/' . $request->series_id . '/season');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Season::findOrFail($id);
        return view('season.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $data = Season::findOrFail($request->season_id);
        $data->name = $request->name;
        $data->series_id = $request->series_id;
        $data->review = $request->review;
        if ($data->update()) {
            return redirect('series/' . $request->series_id . '/season');
        }
    }

    public function destroy($id)
    {
        $data = Season::findOrFail($id);
        if ($data->delete()) {
            return back();
        }
    }
}
