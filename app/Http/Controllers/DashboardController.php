<?php

namespace App\Http\Controllers;

use App\Models\Stat;
use App\Traits\DateRangeTrait;
use App\Models\Website;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use DateRangeTrait;

    /**
     * Show the Dashboard page.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        // If the user previously selected a plan
        if (!empty($request->session()->get('plan_redirect'))) {
            return redirect()->route('checkout.index', ['id' => $request->session()->get('plan_redirect')['id'], 'interval' => $request->session()->get('plan_redirect')['interval']]);
        }

        $now = Carbon::now();
        $range = $this->range();

        $visitors = Stat::whereIn('website_id', Website::select('id')->where('user_id', '=', $request->user()->id))
            ->where('name', '=', 'visitors')
            ->whereBetween('date', [$range['from'], $range['to']])
            ->sum('count');

        $visitorsOld = Stat::whereIn('website_id', Website::select('id')->where('user_id', '=', $request->user()->id))
            ->where('name', '=', 'visitors')
            ->whereBetween('date', [$range['from_old'], $range['to_old']])
            ->sum('count');

        $pageviews = Stat::whereIn('website_id', Website::select('id')->where('user_id', '=', $request->user()->id))
            ->where('name', '=', 'pageviews')
            ->whereBetween('date', [$range['from'], $range['to']])
            ->sum('count');

        $pageviewsOld = Stat::whereIn('website_id', Website::select('id')->where('user_id', '=', $request->user()->id))
            ->where('name', '=', 'pageviews')
            ->whereBetween('date', [$range['from_old'], $range['to_old']])
            ->sum('count');

        $search = $request->input('search');
        $searchBy = in_array($request->input('search_by'), ['domain']) ? $request->input('search_by') : 'domain';
        $favorite = $request->input('favorite');
        $sortBy = in_array($request->input('sort_by'), ['id', 'domain']) ? $request->input('sort_by') : 'id';
        $sort = in_array($request->input('sort'), ['asc', 'desc']) ? $request->input('sort') : 'desc';
        $perPage = in_array($request->input('per_page'), [10, 25, 50, 100]) ? $request->input('per_page') : config('settings.paginate');

        $websites = Website::with([
                'visitors' => function ($query) use ($range) {
                    $query->whereBetween('date', [$range['from'], $range['to']]);
                },
                'pageviews' => function ($query) use ($range) {
                    $query->whereBetween('date', [$range['from'], $range['to']]);
                }]
            )
            ->where('user_id', $request->user()->id)
            ->when($search, function ($query) use ($search, $searchBy) {
                return $query->searchDomain($search);
            })
            ->when(isset($favorite) && is_numeric($favorite), function ($query) use ($favorite) {
                return $query->ofFavorite($favorite);
            })
            ->orderBy($sortBy, $sort)
            ->paginate($perPage)
            ->appends(['from' => $range['from'], 'to' => $range['to'], 'search' => $search, 'search_by' => $searchBy, 'favorite' => $favorite, 'sort_by' => $sortBy, 'sort' => $sort, 'per_page' => $perPage]);

        return view('dashboard.index', ['visitors' => $visitors, 'visitorsOld' => $visitorsOld, 'pageviews' => $pageviews, 'pageviewsOld' => $pageviewsOld, 'range' => $range, 'now' => $now, 'websites' => $websites]);
    }
}
