<?php

namespace App\Http\Controllers\Api;

use App\Models\Post as PostModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Post extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $category = null)
    {
        $posts = PostModel::with(['category']);

        $recordsTotal = $posts->count();

        if ($request->filled('category_id')) {
            $posts->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('search.value')) {
            $posts->whereRaw("lower(title) like '%".strtolower($request->input('search.value'))."%'");
        }

        $recordsFiltered = $posts->count();

        if ($request->has('start')) {
            $posts->skip($request->input('start'));
        }

        if ($request->has('length')) {
            $posts->take($request->input('length'));
        }

        if ($request->has('order')) {
            $order = $request->input('order.0');

            $posts->orderBy($request->input('columns.'.$order['column'].'.data'), $order['dir']);

        } else {
            $posts->latest();
        }

		$posts = $posts->get()->toArray();

		return response()->json([
			'recordsTotal' => $recordsTotal,
			'recordsFiltered' => $recordsFiltered,
			'data' => $posts,
			'category' => $category,
		]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($category, $postName)
    {
        $post = PostModel::where('name', $postName)->first();

        return response()->json($post);
    }

}
