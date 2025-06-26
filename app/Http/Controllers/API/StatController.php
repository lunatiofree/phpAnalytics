<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\SelectStatsRequest;
use App\Http\Resources\StatResource;
use App\Models\Stat;
use App\Models\Website;

class StatController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param SelectStatsRequest $request
     * @param $id
     * @return StatResource|\Illuminate\Http\JsonResponse
     */
    public function show(SelectStatsRequest $request, $id)
    {
        $website = Website::where([['id', '=', $id], ['user_id', '=', $request->user()->id]])->first();

        if ($website) {
            $search = $request->input('search');
            $searchBy = in_array($request->input('search_by'), ['value']) ? $request->input('search_by') : 'value';
            $sortBy = in_array($request->input('sort_by'), ['count', 'value']) ? $request->input('sort_by') : 'count';
            $sort = in_array($request->input('sort'), ['asc', 'desc']) ? $request->input('sort') : 'desc';
            $perPage = in_array($request->input('per_page'), [10, 25, 50, 100]) ? $request->input('per_page') : config('settings.paginate');

            $stat = Stat::selectRaw('`value`, SUM(`count`) as `count`')
                ->where([['website_id', '=', $website->id], ['name', '=', $request->input('name')]])
                ->when($search, function ($query) use ($search, $searchBy) {
                    return $query->searchValue($search);
                })
                ->whereBetween('date', [$request->input('from'), $request->input('to')])
                ->groupBy('value')
                ->orderBy($sortBy, $sort)
                ->paginate($perPage)
                ->appends(['name' => $request->input('name'), 'from' => $request->input('from'), 'to' => $request->input('to'), 'search' => $search, 'search_by' => $searchBy, 'sort_by' => $sortBy, 'sort' => $sort, 'per_page' => $perPage]);

            return StatResource::make($stat);
        }

        return response()->json([
            'message' => __('Resource not found.'),
            'status' => 404
        ], 404);
    }
}
