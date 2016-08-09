@extends('ams::layouts.app')

@section('htmlheader_title')
    {{ trans('ams::message.serviceunavailable') }}
@endsection

@section('contentheader_title')
    {{ trans('ams::message.503error') }}
@endsection

@section('$contentheader_description')
@endsection

@section('main-content')

    <div class="error-page">
        <h2 class="headline text-red">503</h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-red"></i> Oops! {{ trans('ams::message.somethingwrong') }}</h3>
            <p>
                }}
                {{ trans('ams::message.mainwhile') }} <a href='{{ url('/home') }}'>{{ trans('ams::message.returndashboard') }}</a> {{ trans('ams::message.usingsearch') }}
            </p>
            <form class='search-form'>
                <div class='input-group'>
                    <input type="text" name="search" class='form-control' placeholder="{{ trans('ams::message.search') }}"/>
                    <div class="input-group-btn">
                        <button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fa fa-search"></i></button>
                    </div>
                </div><!-- /.input-group -->
            </form>
        </div>
    </div><!-- /.error-page -->
@endsection