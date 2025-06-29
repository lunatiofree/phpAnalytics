@guest
    <div id="header" class="header bg-base-0 position-sticky top-0 right-0 left-0 w-100 box-sizing-border-box z-1025 shadow">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light px-0 py-3">
                <a href="{{ route('home') }}" aria-label="{{ config('settings.title') }}" class="navbar-brand p-0">
                    <div class="height-10 width-auto">
                        <img src="{{ asset('uploads/brand/' . (config('settings.dark_mode') == 1 ? config('settings.logo_dark') : config('settings.logo'))) }}" alt="{{ config('settings.title') }}" width="auto" height="40" data-theme-dark="{{ asset('uploads/brand/' . config('settings.logo_dark')) }}" data-theme-light="{{ asset('uploads/brand/' . config('settings.logo')) }}" data-theme-target="src" class="h-100 border-0 max-height-10 object-fit-contain max-width-48">
                    </div>
                </a>
                <button class="navbar-toggler border-0 p-0" type="button" data-toggle="collapse" data-target="#header-navbar" aria-controls="header-navbar" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="header-navbar">
                    <ul class="navbar-nav pt-2 p-lg-0 {{ (__('lang_dir') == 'rtl' ? 'mr-auto' : 'ml-auto') }}">
                        @if(paymentProcessors())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('pricing') }}" role="button">{{ __('Pricing') }}</a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}" role="button">{{ __('Login') }}</a>
                        </li>

                        @if(config('settings.registration'))
                            <li class="nav-item d-flex align-items-center">
                                <a class="btn btn-outline-primary" href="{{ route('register') }}" role="button">{{ __('Register') }}</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </div>
@else
    <div id="header" class="header bg-base-0 position-sticky top-0 right-0 left-0 w-100 box-sizing-border-box z-1025 shadow d-lg-none">
        <div class="container-fluid">
            <nav class="navbar navbar-light px-0 py-3">
                <a href="{{ route('dashboard') }}" aria-label="{{ config('settings.title') }}" class="navbar-brand p-0">
                    <div class="height-10 width-auto">
                        <img src="{{ asset('uploads/brand/' . (config('settings.dark_mode') == 1 ? config('settings.logo_dark') : config('settings.logo'))) }}" alt="{{ config('settings.title') }}" width="auto" height="40" data-theme-dark="{{ asset('uploads/brand/' . config('settings.logo_dark')) }}" data-theme-light="{{ asset('uploads/brand/' . config('settings.logo')) }}" data-theme-target="src" class="h-100 border-0 max-height-10 object-fit-contain max-width-48">
                    </div>
                </a>
                <button class="slide-menu-toggle navbar-toggler border-0 p-0" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
        </div>
    </div>

    <nav class="slide-menu slide-menu position-fixed top-0 bottom-0 {{ (__('lang_dir') == 'rtl' ? 'left-auto right-0' : 'left-0') }} shadow bg-base-0 navbar navbar-light p-0 d-flex flex-column z-1030" id="slide-menu">
        <div class="min-height-0 flex-grow-1 d-flex flex-column w-100">
            <div>
                <div class="{{ (__('lang_dir') == 'rtl' ? 'pr-4' : 'pl-4') }} py-3 d-flex align-items-center">
                    <a href="{{ route('dashboard') }}" aria-label="{{ config('settings.title') }}" class="navbar-brand m-0 p-0">
                        <div class="height-10 width-auto">
                            <img src="{{ asset('uploads/brand/' . (config('settings.dark_mode') == 1 ? config('settings.logo_dark') : config('settings.logo'))) }}" alt="{{ config('settings.title') }}" width="auto" height="40" data-theme-dark="{{ asset('uploads/brand/' . config('settings.logo_dark')) }}" data-theme-light="{{ asset('uploads/brand/' . config('settings.logo')) }}" data-theme-target="src" class="h-100 border-0 max-height-10 object-fit-contain max-width-48">
                        </div>
                    </a>
                    <div class="close slide-menu-toggle cursor-pointer d-lg-none d-flex align-items-center {{ (__('lang_dir') == 'rtl' ? 'mr-auto' : 'ml-auto') }} px-4 py-2">
                        @include('icons.close', ['class' => 'fill-current width-4 height-4'])
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <div class="py-3 {{ (__('lang_dir') == 'rtl' ? 'pr-4 pl-0' : 'pl-4 pr-0') }} font-weight-medium text-muted text-uppercase flex-grow-1">{{ __('Menu') }}</div>

                @if(Auth::user()->role == 1)
                    @if (request()->is('admin/*'))
                        <a class="px-4 py-2 text-decoration-none text-secondary" href="{{ route('dashboard') }}" data-tooltip="true" title="{{ __('User') }}" role="button"><span class="d-flex align-items-center">@include('icons.account-circle', ['class' => 'width-4 height-4 fill-current'])</span></a>
                    @else
                        <a class="px-4 py-2 text-decoration-none text-secondary" href="{{ route('admin.dashboard') }}" data-tooltip="true" title="{{ __('Admin') }}" role="button"><span class="d-flex align-items-center">@include('icons.supervised-user-circle', ['class' => 'width-4 height-4 fill-current'])</span></a>
                    @endif
                @endif
            </div>

            <div class="min-height-0 flex-grow-1 overflow-auto sidebar">
                @yield('menu')
            </div>

            @if(Auth::user()->plan->features->pageviews >= 0)
                @if($pageviewsCount >= Auth::user()->plan->features->pageviews)
                    <div class="pt-3 px-4">
                        @if(Auth::user()->can_track)
                            <div class="alert alert-warning mb-0" role="alert">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center small">
                                        {{ __('Your account will be limited.') }} {{ __('Upgrade your account to continue tracking your visitors.') }}
                                    </div>

                                    <div class="mt-3">
                                        <a href="{{ route('pricing') }}" class="btn btn-sm btn-block btn-warning">{{ __('Upgrade') }}</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-danger mb-0" role="alert">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center small">
                                        {{ __('Your account has been limited.') }} {{ __('Upgrade your account to continue tracking your visitors.') }}
                                    </div>

                                    <div class="mt-3">
                                        <a href="{{ route('pricing') }}" class="btn btn-sm btn-block btn-danger">{{ __('Upgrade') }}</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            @endif

            <a href="{{ route('account.plan') }}" class="text-decoration-none py-2 px-2 my-2 mx-3">
                <div class="row no-gutters">
                    <div class="col">
                        <div class="small text-muted">
                            {{ __(':number of :total pageviews used.', ['number' => shortenNumber($pageviewsCount), 'total' => (Auth::user()->plan->features->pageviews < 0 ? '∞' : shortenNumber(Auth::user()->plan->features->pageviews))]) }}
                        </div>
                    </div>
                </div>

                <div class="progress w-100 my-2 height-1.25">
                    <div class="progress-bar bg-danger rounded" role="progressbar" style="width: {{ (Auth::user()->plan->features->pageviews == 0 ? 100 : (($pageviewsCount / Auth::user()->plan->features->pageviews) * 100)) }}%"></div>
                </div>
            </a>

            <div class="sidebar sidebar-footer">
                <div class="py-3 {{ (__('lang_dir') == 'rtl' ? 'pr-4 pl-0' : 'pl-4 pr-0') }} d-flex align-items-center" aria-expanded="true">
                    <a href="{{ route('account') }}" class="d-flex align-items-center overflow-hidden text-secondary text-decoration-none flex-grow-1">
                        <img src="{{ Auth::user()->avatarUrl }}" class="flex-shrink-0 rounded-circle width-10 height-10 {{ (__('lang_dir') == 'rtl' ? 'ml-3' : 'mr-3') }}">

                        <div class="d-flex flex-column text-truncate">
                            <div class="font-weight-medium text-dark text-truncate">
                                {{ Auth::user()->name }}
                            </div>

                            <div class="small font-weight-medium">
                                {{ __('Account') }}
                            </div>
                        </div>
                    </a>

                    <a class="py-2 px-4 d-flex flex-shrink-0 align-items-center text-secondary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" data-tooltip="true" title="{{ __('Logout') }}">@include('icons.logout', ['class' => 'fill-current width-4 height-4'])</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </nav>
@endguest
