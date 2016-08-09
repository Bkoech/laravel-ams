@extends('ams::layouts.app')

@section('htmlheader_title')
    Role
@endsection

@section('contentheader_title')
    Role
@endsection

@section('panel-heading')
    {!! Form::open(['route' => ['ams.role.destroy', $item], 'method' => 'DELETE', 'class' => 'pull-right']) !!}
    <a href="{{ route('ams.role.index') }}" class="btn btn-default">{{ trans('ams::message.back') }}</a>
    <a href="{{ route('ams.role.edit', $item) }}" class="btn btn-primary">{{ trans('ams::message.edit') }}</a>
    {!! Form::submit(trans('ams::message.delete'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@endsection

@section('main-content')
    <table class="table table-striped">
        <tbody>
            <tr>
                <td>{{ trans('ams::message.name') }}</td>
                <td>{{ $item->name }}</td>
            </tr>
            <tr>
                <td>{{ trans('ams::message.permissions') }}</td>
                <td>
                    <ul class="resources">
                        @foreach($user_resources as $controller => $actions)
                            <li>
                                {{ trans('ams::label.'.$controller) }}
                                <ul>
                                    @foreach($actions as $action_id => $action)
                                        <li>{{ $action }}</li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        </tbody>
    </table>
@endsection

@push('styles')
<style>
    .resources, .resources ul {
        list-style-type: none;
    }
    .resources label {
        font-weight: normal;
    }
</style>
@endpush
