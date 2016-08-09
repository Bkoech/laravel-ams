<div class="modal {{ $modal_class or '' }}" id="{{ $modal_id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">{{ $modal_title }}</h4>
            </div>
            @if(isset($modal_content))
                <div class="modal-body">
                    {!! $modal_content !!}
                </div>
            @endif
            <div class="modal-footer">
                {!! Form::open(['method' => $modal_method]) !!}
                <button data-dismiss="modal" class="btn btn-default pull-left" type="button">
                    {{ trans('ams::message.cancel') }}
                </button>
                <button class="btn btn-primary" type="submit">{{ $modal_confirm }}</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
