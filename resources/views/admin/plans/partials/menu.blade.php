<a href="#" class="btn d-flex align-items-center btn-sm text-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@include('icons.more-horiz', ['class' => 'fill-current width-4 height-4'])&#8203;</a>

<div class="dropdown-menu {{ (__('lang_dir') == 'rtl' ? 'dropdown-menu' : 'dropdown-menu-right') }} border-0 shadow">
    <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.plans.edit', $plan->id) }}">@include('icons.edit', ['class' => 'text-muted fill-current width-4 height-4 '.(__('lang_dir') == 'rtl' ? 'ml-3' : 'mr-3')]) {{ __('Edit') }}</a>

    @if(!$plan->isDefault())
        <a class="dropdown-item d-flex align-items-center" href="{{ route('checkout.index', ['id' => $plan->id]) }}">@include('icons.eye', ['class' => 'text-muted fill-current width-4 height-4 '.(__('lang_dir') == 'rtl' ? 'ml-3' : 'mr-3')]) {{ __('View') }}</a>
    @endif

    @if(!$plan->isDefault())
        @if($plan->trashed())
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-success d-flex align-items-center" href="#" data-toggle="modal" data-target="#modal" data-action="{{ route('admin.plans.restore', $plan->id) }}" data-button-class="btn btn-success position-relative" data-title="{{ __('Restore') }}" data-text="{{ __('Are you sure you want to restore :name?', ['name' => $plan->name]) }}">@include('icons.settings-backup-restore', ['class' => 'fill-current width-4 height-4 '.(__('lang_dir') == 'rtl' ? 'ml-3' : 'mr-3')]) {{ __('Restore') }}</a>
        @else
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger d-flex align-items-center" href="#" data-toggle="modal" data-target="#modal" data-action="{{ route('admin.plans.disable', $plan->id) }}" data-button-class="btn btn-danger position-relative" data-title="{{ __('Disable') }}" data-text="{{ __('Are you sure you want to disable :name?', ['name' => $plan->name]) }}">@include('icons.block', ['class' => 'fill-current width-4 height-4 '.(__('lang_dir') == 'rtl' ? 'ml-3' : 'mr-3')]) {{ __('Disable') }}</a>
        @endif
    @endif
</div>
