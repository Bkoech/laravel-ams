@extends('ams::layouts.app')

@section('htmlheader_title')
    {{  trans('ams::message.role') }}
@endsection

@section('contentheader_title')
    {{  trans('ams::message.role') }}
@endsection

@section('panel-heading')
    {{ $header }}
@endsection

@section('main-content')
     {!! Form::model($model, ['route' => $route, 'method' => $method]) !!}
    <div class="box-body">
        <fieldset class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('name', trans('ams::message.name')) !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            @if ($errors->has('name'))
                <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif
        </fieldset>
        <ul class="resources">
            @foreach($acl as $controller => $actions)
                <li>
                    {{ trans('ams::label.'.$controller) }}
                    <ul>
                        @foreach($actions as $action_id => $action)
                            <li>
                                <label>
                                    {!! Form::checkbox('action['.$action_id.']', 1, (in_array($action_id, $user_resources) ? true : null)) !!}
                                    {{ $action }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
    {!! Form::submit(trans('ams::message.save'), ['class' => 'btn btn-primary pull-right']) !!}
    {!! Form::close() !!}
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
