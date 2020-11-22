<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\MovieResource;
use App\Item;
use App\Season;
use App\Episode;
use App\Category;
use App\Visitor;
use App\Favourite;

class APIController extends Controller
{

	public function visitor(Request $request)
	{
		$data = Visitor::where('android_id', $request->android_id)->get();
		if (count($data) > 0) {
			$visitor = Visitor::where('android_id', $request->android_id)->first();
			return response()->json([
				'status' => true,
				'message' => 'Welcome Back!'
			]);
		} else {
			$visitor = new Visitor;
			$visitor->manufacturer = $request->manufacturer;
			$visitor->model = $request->model;
			$visitor->android_id = $request->android_id;
			$visitor->status = 1;
			if ($visitor->save()) {
				return response()->json([
					'status' => true,
					'message' => 'Welcome Back!'
				]);
			} else {
				return response()->json([
					'status' => false,
					'message' => 'Something was wrong'
				]);
			}
		}
	}

	public function home()
	{
		$feature = Item::where('is_feature', 1)->limit(5)->select('id', 'name', 'poster', 'cover', 'type', 'imdb_rating')->inRandomOrder()->get();
		$popular = Item::orderBy('download_count', 'desc')->orderBy('watch_count')->limit(10)->get();
		$recent_movie = Item::where('type', 'Movie')->limit(10)->orderBy('id', 'desc')->select('id', 'name', 'poster', 'imdb_rating')->get();
		$recent_series = Item::where('type', 'Series')->limit(10)->orderBy('id', 'desc')->select('id', 'name', 'poster', 'imdb_rating')->get();
		$episode = Episode::orderBy('episodes.id', 'desc')
							->leftJoin('items as s','s.id','episodes.item_id')
							->limit(10)
							->select('episodes.id', 'episodes.item_id', 'episodes.season_id', 'episodes.name','s.poster','s.cover', 'episodes.watch_count', 'episodes.download_count')->get();
		return response()->json([
			'feature' => $feature,
			'popular' => $popular,
			'recent_movie' => $recent_movie,
			'recent_series' => $recent_series,
			'episode' => $episode
		]);
	}

	public function search(Request $request)
	{
		$data = Item::where('name', 'like', '%' . $request->term . '%')->select('id', 'name', 'poster', 'type', 'imdb_rating')->get();
		if (count($data) > 0) {
			return response()->json([
				'status' => true,
				'count' => count($data),
				'data' => $data
			]);
		} else {
			return response()->json([
				'status' => true,
				'message' => "There is no data"
			]);
		}
	}

	public function category()
	{
		$result = array();

		$data = Category::orderBy('name', 'asc')->get();
		foreach ($data as $row) {
			$item['id'] = $row->id;
			$item['name'] = $row->name;
			$item['total_movie'] = Item::where('type', 'Movie')->where('category_id', $row->id)->count();
			$item['total_series'] = Item::where('type', 'Series')->where('category_id', $row->id)->count();

			array_push($result, $item);
		}
		if (count($result) > 0) {
			return response()->json([
				'status' => true,
				'count' => count($result),
				'data' => $result
			]);
		} else {
			return response()->json([
				'status' => true,
				'message' => "There is no data"
			]);
		}
	}

	public function itemByCategory(Request $request)
	{
		$data = Item::where('category_id', $request->id)->select('id', 'name', 'poster', 'type', 'imdb_rating')->get();
		if (count($data) > 0) {
			return response()->json([
				'status' => true,
				'count' => count($data),
				'data' => $data
			]);
		} else {
			return response()->json([
				'status' => true,
				'message' => "There is no data"
			]);
		}
	}

	public function movie()
	{
		$data = Item::where('type', 'Movie')->orderBy('id', 'desc')->select('id', 'name', 'poster', 'imdb_rating')->paginate();
		if (count($data) > 0) {
			return MovieResource::collection($data);
			return response()->json($data);
			// return response()->json([
			// 	'status' => true,
			// 	'count' => count($data),
			// 	'data' => $data
			// ]);
		} else {
			return response()->json([
				'status' => true,
				'message' => "There is no data"
			]);
		}
	}

	public function movieDeatil(Request $request)
	{
		$fav = false;
		$query = Favourite::where('item_id', $request->id)->where('device_id', $request->android_id)->get();
		if (count($query) > 0) {
			$GLOBALS['fav'] = true;
		} else {
			$GLOBALS['fav'] = false;
		}
		$data = Item::where('items.id', $request->id)
			->leftJoin('categories as cat', 'cat.id', 'items.category_id')
			->leftJoin('languages as lang', 'lang.id', 'items.language_id')
			->select(
				'items.id',
				'items.name',
				'items.poster',
				'items.cover',
				'items.release_year',
				'items.content_rating',
				'items.imdb_rating',
				'cat.name as category',
				'lang.name as language',
				'items.description',
				'items.link',
				'items.quality',
				'items.watch_count',
				'items.download_count'
			)
			->first();
		$episode = Episode::where('item_id', $request->id)
			->select('id', 'name', 'link', 'quality', 'watch_count', 'download_count')
			->orderBy('episodes.name', 'asc')
			->get();
		return response()->json([
			'status' => true,
			'data' => $data,
			'fav' => $GLOBALS['fav'],
			'episode'=>$episode
		]);
	}
	// public function series()
	// {
	// 	$data = Item::where('type', 'Series')->orderBy('id', 'desc')->select('id', 'name', 'poster', 'imdb_rating')->get();
	// 	if (count($data) > 0) {
	// 		//return MovieResource::collection($data);
	// 		//return response()->json($data);
	// 		return response()->json([
	// 			'status' => true,
	// 			'count' => count($data),
	// 			'data' => $data
	// 		]);
	// 	} else {
	// 		return response()->json([
	// 			'status' => true,
	// 			'message' => "There is no data"
	// 		]);
	// 	}
	// }

	public function series()
	{
		$data = Item::where('type', 'Series')->orderBy('id', 'desc')->select('id', 'name', 'poster', 'imdb_rating')->paginate();
		if (count($data) > 0) {
			return MovieResource::collection($data);
			return response()->json($data);
			// return response()->json([
			// 	'status' => true,
			// 	'count' => count($data),
			// 	'data' => $data
			// ]);
		} else {
			return response()->json([
				'status' => true,
				'message' => "There is no data"
			]);
		}
	}

	public function seriesDetail(Request $request)
	{
		$fav = false;
		$query = Favourite::where('item_id', $request->id)->where('device_id', $request->android_id)->get();
		if (count($query) > 0) {
			$GLOBALS['fav'] = true;
		} else {
			$GLOBALS['fav'] = false;
		}
		$data = Item::where('items.id', $request->id)
			->leftJoin('categories as cat', 'cat.id', 'items.category_id')
			->leftJoin('languages as lang', 'lang.id', 'items.language_id')
			->select(
				'items.id',
				'items.name',
				'items.poster',
				'items.cover',
				'items.release_year',
				'items.content_rating',
				'items.imdb_rating',
				'cat.name as category',
				'lang.name as langauge',
				'items.description',
				'items.watch_count',
				'items.download_count'
			)
			->first();
		$season = Season::where('series_id', $request->id)->orderBy('name', 'asc')->select('id', 'name', 'episode_count')->get();
		return response()->json([
			'status' => true,
			'data' => $data,
			'fav' => $GLOBALS['fav'],
			'season' => $season
		]);
	}

	public function season(Request $request)
	{
		$data = Season::where('id', $request->id)->select('id', 'name', 'episode_count')->first();
		$episode = Episode::where('episodes.season_id', $request->id)
			->leftJoin('seasons as s', 's.id', 'episodes.season_id')
			->select('episodes.id', 's.name as season', 'episodes.name', 'episodes.link', 'episodes.quality', 'episodes.watch_count', 'episodes.download_count')
			->orderBy('episodes.name', 'asc')
			->get();
		return response()->json([
			'status' => true,
			'data' => $data,
			'episode' => $episode
		]);
	}

	public function episode(Request $request)
	{
		$data = Episode::where('id', $request->id)->select('id', 'name', 'link', 'quality')->first();
		return response()->json([
			'status' => true,
			'data' => $data
		]);
	}

	public function downloadMovie(Request $request)
	{
		$data = Item::where('type', 'Movie')->where('id', $request->id)->first();
		$data->increment('download_count');
		return response()->json(['status' => true]);
	}

	public function watchMovie(Request $request)
	{
		$data = Item::where('type', 'Movie')->where('id', $request->id)->first();
		$data->increment('watch_count');
		return response()->json(['status' => true]);
	}

	public function downloadEpisode(Request $request)
	{
		$data = Episode::findOrFail($request->id);
		$data->increment('download_count');
		$series = Item::where('id', $data->item_id)->first();
		$series->increment('download_count');
		return response()->json(['status' => true]);
	}

	public function watchEpisode(Request $request)
	{
		$data = Episode::findOrFail($request->id);
		$data->increment('watch_count');
		$series = Item::where('id', $data->item_id)->first();
		$series->increment('watch_count');
		return response()->json(['status' => true]);
	}

	public function favourite(Request $request)
	{
		$query = Favourite::where('item_id', $request->item_id)->where('device_id', $request->android_id)->get();
		if (count($query) > 0) {
			return response()->json([
				'status' => true,
				'message' => 'Success'
			]);
		} else {
			$data = new Favourite;
			$data->device_id = $request->android_id;
			$data->item_id = $request->item_id;
			if ($data->save()) {
				return response()->json([
					'status' => true,
					'message' => 'Success'
				]);
			}
		}
	}

	public function favList(Request $request)
	{
		$data = Favourite::where('favourites.device_id', $request->android_id)
			->leftJoin('items as i', 'i.id', 'favourites.item_id')
			->select(
				'i.id',
				'i.name',
				'i.poster',
				'i.type',
				'i.imdb_rating'
			)->get();
		if (count($data) > 0) {
			return response()->json([
				'status' => true,
				'count' => count($data),
				'data' => $data
			]);
		} else {
			return response()->json([
				'status' => true,
				'message' => "There is no data"
			]);
		}
	}
}
