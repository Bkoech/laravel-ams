@extends('ams::layouts.app')

@section('htmlheader_title')
    {{ trans('ams::message.module') }}
@endsection

@section('contentheader_title')
    {{ trans('ams::message.module') }}
@endsection

@section('panel-heading')
    <div class="pull-right">
        <a href="{{ route('ams.module.global-update') }}" class="btn btn-info">
            {{ trans('ams::message.updatemodules') }}
        </a>
        <a href="{{ route('ams.module.add') }}" class="btn btn-success">
            {{ trans('ams::message.create') }}
        </a>
    </div>
@endsection


@section('main-content')
    @if($modules->count() == 0)
        <p>{{ trans('ams::message.modulesempty') }}</p>
    @else
        <table class="table">
            <thead>
            <tr>
                <th>{{ trans('ams::message.name') }}</th>
                <th>{{ trans('ams::message.is_active') }}</th>
                <th class="actions"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($modules as $module)
                <tr>
                    <td>{{ $module->name }}</td>
                    <td>
                        @if($module->is_active)
                            <span class="label label-success">{{ trans('ams::message.yes') }}</span>
                        @else
                            <span class="label label-danger">{{ trans('ams::message.no') }}</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ trans('ams::message.action') }} <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                @if($module->is_active)
                                    <li>
                                        <a href="#" class="turn-off" data-action="{{ route('ams.module.update', [$module, 0]) }}" data-toggle="modal" data-target="#modal-turn-off">
                                            {{ trans('ams::message.turnoff') }}
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a href="#" class="turn-on" data-action="{{ route('ams.module.update', [$module, 1]) }}" data-toggle="modal" data-target="#modal-turn-on">
                                            {{ trans('ams::message.turnon') }}
                                        </a>
                                    </li>
                                @endif
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="#" class="delete" data-action="{{ route('ams.module.delete', [$module]) }}" data-toggle="modal" data-target="#modal-delete">
                                        {{ trans('ams::message.delete') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        @include('ams::partials.modal', [
            'modal_id' => 'modal-delete',
            'modal_class' => 'modal-danger',
            'modal_title' => trans('ams::message.delete'),
            'modal_method' => 'delete',
            'modal_confirm' => trans('ams::message.delete')
        ])

        @include('ams::partials.modal', [
            'modal_id' => 'modal-turn-on',
            'modal_title' => trans('ams::message.turnon'),
            'modal_method' => 'put',
            'modal_confirm' => trans('ams::message.turnon')
        ])

        @include('ams::partials.modal', [
            'modal_id' => 'modal-turn-off',
            'modal_title' => trans('ams::message.turnoff'),
            'modal_method' => 'put',
            'modal_confirm' => trans('ams::message.turnoff')
        ])
    @endif
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $("a.delete").click(function() {
            $("#modal-delete").find("form").attr("action", $(this).data("action"));
        });
        $("a.turn-off").click(function() {
            $("#modal-turn-off").find("form").attr("action", $(this).data("action"));
        });
        $("a.turn-on").click(function() {
            $("#modal-turn-on").find("form").attr("action", $(this).data("action"));
        });
    });
</script>
@endpush
