@extends('ams::layouts.app')

@section('htmlheader_title')
    {{ trans('ams::message.admin') }}
@endsection

@section('contentheader_title')
    {{ trans('ams::message.admin') }}
@endsection

@section('panel-heading')
    {!! Form::open(['route' => ['ams.admin.destroy', $admin], 'method' => 'DELETE', 'class' => 'pull-right']) !!}
    <a href="{{ route('ams.admin.index') }}" class="btn btn-default">{{ trans('ams::message.back') }}</a>
    <a href="{{ route('ams.admin.edit', $admin) }}" class="btn btn-primary">{{ trans('ams::message.edit') }}</a>
    {!! Form::submit(trans('ams::message.delete'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@endsection

@section('main-content')
    <table class="table table-striped">
        <tbody>
        <tr>
            <td>{{ trans('ams::message.fullname') }}</td>
            <td>{{ $admin->name }}</td>
        </tr>
        <tr>
            <td>{{ trans('ams::message.email') }}</td>
            <td>{{ $admin->email }}</td>
        </tr>
        <tr>
            <td>{{ trans('ams::message.role') }}</td>
            <td>{{ $admin->role->name }}</td>
        </tr>
        </tbody>
    </table>
@endsection
