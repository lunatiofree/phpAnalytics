<a href="#" class="btn d-flex align-items-center btn-sm text-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@include('icons.more-horiz', ['class' => 'fill-current width-4 height-4'])&#8203;</a>

<div class="dropdown-menu {{ (__('lang_dir') == 'rtl' ? 'dropdown-menu' : 'dropdown-menu-right') }} border-0 shadow">
    <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.users.edit', $user->id) }}">@include('icons.edit', ['class' => 'text-muted fill-current width-4 height-4 '.(__('lang_dir') == 'rtl' ? 'ml-3' : 'mr-3')]) {{ __('Edit') }}</a>

    @if(!$user->trashed())
        <a class="dropdown-item d-flex align-items-center" href="#" data-toggle="modal" data-target="#modal" data-action="{{ route('admin.users.login', $user->id) }}" data-button-class="btn btn-primary position-relative" data-title="{{ __('Login') }}" data-text="{{ __('Logging in as user will log you out of your account.') }}" data-sub-text="{{ __('Are you sure you want to login as :name?', ['name' => $user->name]) }}">@include('icons.login', ['class' => 'text-muted fill-current width-4 height-4 '.(__('lang_dir') == 'rtl' ? 'ml-3' : 'mr-3')]) {{ __('Login') }}</a>
    @endif

    <div class="dropdown-divider"></div>

    @if($user->trashed())
        <a class="dropdown-item text-success d-flex align-items-center" href="#" data-toggle="modal" data-target="#modal" data-action="{{ route('admin.users.restore', $user->id) }}" data-button-class="btn btn-success position-relative" data-title="{{ __('Restore') }}" data-text="{{ __('Are you sure you want to restore :name?', ['name' => $user->name]) }}">@include('icons.settings-backup-restore', ['class' => 'fill-current width-4 height-4 '.(__('lang_dir') == 'rtl' ? 'ml-3' : 'mr-3')]) {{ __('Restore') }}</a>
        <div class="dropdown-divider"></div>
    @else
        <a class="dropdown-item text-danger d-flex align-items-center" href="#" data-toggle="modal" data-target="#modal" data-action="{{ route('admin.users.disable', $user->id) }}" data-button-class="btn btn-danger position-relative" data-title="{{ __('Disable') }}" data-text="@if(paymentProcessors()){{ __('Disabling this account will cancel any active subscription.') }}@endif" data-sub-text="{{ __('Are you sure you want to disable :name?', ['name' => $user->name]) }}">@include('icons.block', ['class' => 'fill-current width-4 height-4 '.(__('lang_dir') == 'rtl' ? 'ml-3' : 'mr-3')]) {{ __('Disable') }}</a>
    @endif

    <a class="dropdown-item text-danger d-flex align-items-center" href="#" data-toggle="modal" data-target="#modal" data-action="{{ route('admin.users.destroy', $user->id) }}" data-button-class="btn btn-danger position-relative" data-title="{{ __('Delete') }}" data-text="{{ __('Are you sure you want to delete :name?', ['name' => $user->name]) }}">@include('icons.delete', ['class' => 'fill-current width-4 height-4 '.(__('lang_dir') == 'rtl' ? 'ml-3' : 'mr-3')]) {{ __('Delete') }}</a>
</div>
