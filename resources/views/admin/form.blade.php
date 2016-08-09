@extends('ams::layouts.app')

@section('htmlheader_title')
    {{ trans('ams::message.admin') }}
@endsection

@section('contentheader_title')
    {{ trans('ams::message.admin') }}
@endsection

@section('panel-heading')
    {{ $header }}
@endsection

@section('main-content')
    <div class="col-md-6 col-md-offset-3">
        {!! Form::model($model, ['route' => $route, 'method' => $method]) !!}
        <div class="box-body">
            <fieldset class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name', trans('ams::message.fullname')) !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                @if ($errors->has('name'))
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                @endif
            </fieldset>
            <fieldset class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                {!! Form::label('email', trans('ams::message.email')) !!}
                {!! Form::email('email', null, ['class' => 'form-control']) !!}
                @if ($errors->has('email'))
                    <p class="text-danger">{{ $errors->first('email') }}</p>
                @endif
            </fieldset>
            <fieldset class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                {!! Form::label('password', trans('ams::message.password')) !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
                @if ($errors->has('password'))
                    <p class="text-danger">{{ $errors->first('password') }}</p>
                @endif
            </fieldset>
            <fieldset class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                {!! Form::label('password_confirmation', trans('ams::message.retypepassword')) !!}
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                @if ($errors->has('password_confirmation'))
                    <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                @endif
            </fieldset>
            <fieldset class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                {!! Form::label('role_id', trans('ams::message.role')) !!}
                {!! Form::select('role_id', $roles, null, ['class' => 'form-control']) !!}
                @if ($errors->has('role_id'))
                    <p class="text-danger">{{ $errors->first('role_id') }}</p>
                @endif
            </fieldset>
        </div>
        {!! Form::submit(trans('ams::message.save'), ['class' => 'btn btn-primary pull-right', 'id' => 'btn_save']) !!}
        {!! Form::close() !!}
    </div>
@endsection
