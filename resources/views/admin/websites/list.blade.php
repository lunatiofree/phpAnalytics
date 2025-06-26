@section('site_title', formatTitle([__('Websites'), config('settings.title')]))

@include('shared.breadcrumbs', ['breadcrumbs' => [
    ['url' => route('admin.dashboard'), 'title' => __('Admin')],
    ['title' => __('Websites')],
]])

<div class="d-flex">
    <div class="flex-grow-1">
        <h1 class="h2 mb-3 d-inline-block">{{ __('Websites') }}</h1>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header">
        <div class="row">
            <div class="col-12 col-md"><div class="font-weight-medium py-1">{{ __('Websites') }}</div></div>
            <div class="col-12 col-md-auto">
                <div class="form-row">
                    <div class="col">
                        <form method="GET" action="{{ route('admin.websites') }}" class="d-md-flex">
                            @include('shared.filter-tags')
                            <div class="input-group input-group-sm">
                                <input class="form-control" name="search" placeholder="{{ __('Search') }}" value="{{ app('request')->input('search') }}">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-primary d-flex align-items-center dropdown-toggle dropdown-toggle-split reset-after" data-tooltip="true" title="{{ __('Filters') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@include('icons.filter', ['class' => 'fill-current width-4 height-4'])&#8203;</button>
                                    <div class="dropdown-menu {{ (__('lang_dir') == 'rtl' ? 'dropdown-menu' : 'dropdown-menu-right') }} border-0 shadow width-64 p-0" id="search-filters">
                                        <div class="dropdown-header py-3">
                                            <div class="row">
                                                <div class="col"><div class="font-weight-medium m-0 text-body">{{ __('Filters') }}</div></div>
                                                <div class="col-auto"><a href="{{ route('admin.websites') }}" class="text-secondary">{{ __('Reset') }}</a></div>
                                            </div>
                                        </div>

                                        <div class="dropdown-divider my-0"></div>

                                        <input name="user_id" type="hidden" value="{{ request()->input('user_id') }}">

                                        <div class="max-height-96 overflow-auto pt-3">
                                            <div class="form-group px-4">
                                                <label for="i-search-by" class="small">{{ __('Search by') }}</label>
                                                <select name="search_by" id="i-search-by" class="custom-select custom-select-sm">
                                                    @foreach(['domain' => __('Domain')] as $key => $value)
                                                        <option value="{{ $key }}" @if(request()->input('search_by') == $key || !request()->input('search_by') && $key == 'name') selected @endif>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group px-4">
                                                <label for="i-sort-by" class="small">{{ __('Sort by') }}</label>
                                                <select name="sort_by" id="i-sort-by" class="custom-select custom-select-sm">
                                                    @foreach(['id' => __('Date created'), 'domain' => __('Domain')] as $key => $value)
                                                        <option value="{{ $key }}" @if(request()->input('sort_by') == $key) selected @endif>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group px-4">
                                                <label for="i-sort" class="small">{{ __('Sort') }}</label>
                                                <select name="sort" id="i-sort" class="custom-select custom-select-sm">
                                                    @foreach(['desc' => __('Descending'), 'asc' => __('Ascending')] as $key => $value)
                                                        <option value="{{ $key }}" @if(request()->input('sort') == $key) selected @endif>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group px-4">
                                                <label for="i-per-page" class="small">{{ __('Results per page') }}</label>
                                                <select name="per_page" id="i-per-page" class="custom-select custom-select-sm">
                                                    @foreach([10, 25, 50, 100] as $value)
                                                        <option value="{{ $value }}" @if(request()->input('per_page') == $value || request()->input('per_page') == null && $value == config('settings.paginate')) selected @endif>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="dropdown-divider my-0"></div>

                                        <div class="px-4 py-3">
                                            <button type="submit" class="btn btn-primary btn-sm btn-block">{{ __('Search') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-auto d-none" id="bulk-actions-container">
                        <div class="btn-group" role="group" aria-label="{{ __('Bulk actions') }}">
                            <button type="button" class="btn btn-sm btn-outline-primary d-flex align-items-center" data-toggle="dropdown" aria-expanded="false" id="bulk-dropdown">{{ __('Actions') }} @include('icons.expand-more', ['class' => 'fill-current width-3 height-3 ' . (__('lang_dir') == 'rtl' ? 'mr-2' : 'ml-2')])</button>
                            <div class="dropdown-menu {{ (__('lang_dir') == 'rtl' ? 'dropdown-menu' : 'dropdown-menu-right') }} border-0 shadow">
                                <a class="dropdown-item text-danger d-flex align-items-center" href="#" data-toggle="modal" data-target="#modal" data-action="{{ route('admin.websites.destroy', 0) }}" data-action-original="{{ route('admin.websites.destroy', 'id') }}" data-button-class="btn btn-danger position-relative" data-button-name="bulk" data-title="{{ __('Delete') }}" data-text="{{ __('Are you sure you want to delete :count records?', ['count' => 0]) }}" data-text-original="{{ __('Are you sure you want to delete :count records?', ['count' => 0]) }}" id="bulk-delete">@include('icons.delete', ['class' => 'fill-current width-4 height-4 '.(__('lang_dir') == 'rtl' ? 'ml-3' : 'mr-3')]) {{ __('Delete') }}</a>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary d-flex align-items-center" data-tooltip="true" title="{{ __('Close') }}" id="bulk-close">@include('icons.close', ['class' => 'fill-current width-4 height-4'])&#8203;</button>
                        </div>
                    </div>
                    <div class="col-auto" id="bulk-open-container">
                        <button class="btn btn-sm btn-outline-primary d-flex align-items-center" data-tooltip="true" title="{{ __('Bulk actions') }}" id="bulk-open">@include('icons.list', ['class' => 'fill-current width-4 height-4'])&#8203;</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        @include('shared.message')

        @if(count($websites) == 0)
            {{ __('No data') }}.
        @else
            <div class="list-group list-group-flush my-n3">
                <div class="list-group-item px-0 text-muted">
                    <div class="row">
                        <div class="d-none col-auto align-items-center" data-bulk-checkbox-column>
                            <div class="custom-control custom-checkbox" data-bulk-check>
                                <input type="checkbox" class="custom-control-input" id="bulk-check-all" value="true">
                                <label class="custom-control-label cursor-pointer user-select-none" for="bulk-check-all"></label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row d-flex align-items-center">
                                <div class="col">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-lg-6 text-truncate">
                                            {{ __('Domain') }}
                                        </div>

                                        <div class="col-12 col-lg-6 text-truncate">
                                            {{ __('User') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="invisible btn d-flex align-items-center btn-sm text-primary">@include('icons.more-horiz', ['class' => 'fill-current width-4 height-4'])&#8203;</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach($websites as $website)
                    <div class="list-group-item px-0">
                        <div class="row">
                            <div class="d-none col-auto align-items-center" data-bulk-checkbox-column>
                                <div class="custom-control custom-checkbox" data-bulk-check>
                                    <input type="checkbox" class="custom-control-input" id="bulk-check-{{ $website->id }}" name="bulk[]" value="{{ $website->id }}" data-bulk-checkbox>
                                    <label class="custom-control-label cursor-pointer user-select-none" for="bulk-check-{{ $website->id }}"></label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row d-flex align-items-center">
                                    <div class="col text-truncate">
                                        <div class="row text-truncate">
                                            <div class="col-12 col-lg-6 d-flex align-items-center text-truncate">
                                                <img src="{{ favicon($website->domain) }}" rel="noreferrer" class="width-4 height-4 {{ (__('lang_dir') == 'rtl' ? 'ml-3' : 'mr-3') }}"> <div class="text-truncate" dir="ltr"><a href="{{ route('admin.websites.edit', $website->id) }}">{{ $website->domain }}</a></div>
                                            </div>

                                            <div class="col-12 col-lg-5 d-flex align-items-center">
                                                <div class="d-inline-block {{ (__('lang_dir') == 'rtl' ? 'ml-3' : 'mr-3') }}">
                                                    <img src="{{ $website->user->avatarUrl }}" class="rounded-circle width-6 height-6">
                                                </div>
                                                <a href="{{ route('admin.users.edit', $website->user->id) }}">{{ $website->user->name }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-row">
                                            <div class="col">
                                                @include('websites.partials.menu')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="mt-3 align-items-center">
                    <div class="row">
                        <div class="col">
                            <div class="mt-2 mb-3">{{ __('Showing :from-:to of :total', ['from' => $websites->firstItem(), 'to' => $websites->lastItem(), 'total' => $websites->total()]) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            {{ $websites->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
