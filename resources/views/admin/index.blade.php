@extends('ams::layouts.app')

@section('htmlheader_title')
    {{ trans('ams::message.admin') }}
@endsection

@section('contentheader_title')
    {{ trans('ams::message.admin') }}
@endsection

@section('panel-heading')
    <a href="{{ route('ams.admin.create') }}" class="btn btn-success pull-right">
        {{ trans('ams::message.create') }}
    </a>
@endsection

@section('main-content')
    <table class="table">
        <thead>
        <tr>
            <th>{{ trans('ams::message.fullname') }}</th>
            <th>{{ trans('ams::message.email') }}</th>
            <th>{{ trans('ams::message.role') }}</th>
            <th class="actions"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($admins as $admin)
            <tr>
                <td>{{$admin->name}}</td>
                <td>{{$admin->email}}</td>
                <td>{{$admin->role->name}}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-xs btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            {{ trans('ams::message.action') }}
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            <li>
                                <a href="{{ route('ams.admin.show', $admin) }}">
                                    {{ trans('ams::message.details') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('ams.admin.edit', $admin) }}">
                                    {{ trans('ams::message.edit') }}
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" class="delete" data-action="{{ route('ams.admin.destroy', [$admin]) }}" data-toggle="modal" data-target="#modal-delete">
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
    {!! $admins->links() !!}

    @include('ams::partials.modal', [
        'modal_id' => 'modal-delete',
        'modal_class' => 'modal-danger',
        'modal_title' => trans('ams::message.delete'),
        'modal_method' => 'delete',
        'modal_confirm' => trans('ams::message.delete')
    ])
@endsection
