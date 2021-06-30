@push('css')
    @once
    @include('components.modal.css.index')
    @endonce
@endpush

<div
    id="{{$id}}"
    class="modal fade"
    data-backdrop="{{ $backdrop }}"
    data-keyboard="{{ $keyboard }}"
    data-focus="{{ $focus }}">
    <div class="modal-dialog modal-{{ $size }}">
        <div class="modal-content">
            <div class="modal-header bg-{{ $headerBgColor }}">
                <h4 class="modal-title" id="{{$id}}-modal-title">
                    {{ $title }}
                </h4>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="card-body">
                    {{ $slot }}
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button
                    type="button"
                    class="btn btn-{{ $btnCloseColor }}"
                    data-dismiss="modal"
                    id="close-modal-id">
                    <i class="fas fa-window-close"></i> {{ $btnCloseName ?? 'Cancelar' }}
                </button>
                {{ $submitButton }}
            </div>
        </div>
    </div>
</div>

@push('js')
    @include('components.modal.js.index')
@endpush

