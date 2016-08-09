@extends('ams::layouts.app')

@section('htmlheader_title')
    {{  trans('ams::message.dashboard') }}
@endsection

@section('contentheader_title')
    {{  trans('ams::message.dashboard') }}
@endsection

@section('main-content-wrapper')
    @foreach($modules as $module)
        @if(isset($module->config['dashboard']))
            @include($module->config['dashboard'])
        @endif
    @endforeach
@endsection
