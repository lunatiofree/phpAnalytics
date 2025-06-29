<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-label"></h6>
                <button type="button" class="close d-flex align-items-center justify-content-center width-12 height-14" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="d-flex align-items-center">@include('icons.close', ['class' => 'fill-current width-4 height-4'])</span>
                </button>
            </div>
            <div class="modal-body py-0">
                <div class="my-3" id="modal-text"></div>
                <div class="my-3" id="modal-sub-text"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                <form action="{{ route('home') }}" method="post" enctype="multipart/form-data">

                    @csrf

                    <button type="submit" id="modal-button" class="position-relative" data-button-loader>
                        <div class="position-absolute top-0 right-0 bottom-0 left-0 d-flex align-items-center justify-content-center">
                            <span class="d-none spinner-border spinner-border-sm width-4 height-4" role="status"></span>
                        </div>
                        <span class="spinner-text"></span>&#8203;
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
