@extends('ams::layouts.app')

@section('htmlheader_title')
    {{  trans('ams::message.role') }}
@endsection

@section('contentheader_title')
    {{  trans('ams::message.role') }}
@endsection

@section('panel-heading')
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('ams.role.create') }}" class="btn btn-success pull-right">
                {{  trans('ams::message.create') }}
            </a>
        </div>
    </div>
@endsection

@section('main-content')
    <table class="table">
        <thead>
        <tr>
            <th>{{  trans('ams::message.name') }}</th>
            <th class="actions"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
        <tr>
            <td>{{$role->name}}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-xs btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        {{  trans('ams::message.action') }}
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                        <li><a href="{{ route('ams.role.show', $role) }}">{{  trans('ams::message.details') }}</a></li>
                        <li><a href="{{ route('ams.role.edit', $role) }}">{{  trans('ams::message.edit') }}</a></li>
                        <li class="divider"></li>
                        <li><a href="#" class="delete" data-action="{{ route('ams.role.destroy', [$role]) }}" data-toggle="modal" data-target="#modal-delete">{{  trans('ams::message.delete') }}</a></li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {!! $roles->links() !!}

    @include('ams::partials.modal', [
        'modal_id' => 'modal-delete',
        'modal_class' => 'modal-danger',
        'modal_title' => trans('ams::message.delete'),
        'modal_method' => 'delete',
        'modal_confirm' => trans('ams::message.delete')
    ])
@endsection
