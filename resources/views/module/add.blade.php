@extends('ams::layouts.app')

@section('htmlheader_title')
    Moduły
@endsection

@section('contentheader_title')
    Moduły
@endsection

@section('panel-heading')
    Dodaj moduł
@endsection

@section('main-content')
    {!! Form::open(['route' => 'ams.module.upload', 'method' => 'post', 'files' => true]) !!}
    <div class="box-body">
        <div class="form-group {{ $errors->has('module_package') ? 'has-error' : '' }}">
            {!! Form::label('module_package', 'Wybierz moduł') !!}
            {!! Form::file('module_package') !!}
            @if($errors->has('module_package'))
                <span class="help-block">{{ $errors->first('module_package') }}</span>
            @endif
        </div>
    </div>
    {!! Form::submit('Dodaj', ['class' => 'btn btn-primary pull-right']) !!}
    {!! Form::close() !!}
@endsection
