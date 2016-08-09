<!DOCTYPE html>
<html lang="en">

@section('htmlheader')
    @include('ams::layouts.partials.htmlheader')
@show

<body class="skin-blue sidebar-mini">
<div class="wrapper">

    @include('ams::layouts.partials.mainheader')
    @include('ams::layouts.partials.sidebar')

    <div class="content-wrapper">
        @include('ams::layouts.partials.contentheader')
        <section class="content">
            <div class="container">
                <div class="row">
                    @section('main-content-wrapper')
                        <div class="col-md-10 col-md-offset-1">
                            @include('ams::partials.flash_message')
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @yield('panel-heading')
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    @yield('main-content')
                                </div>
                            </div>
                        </div>
                    @show
                </div>
            </div>
        </section>
    </div>
    @include('ams::layouts.partials.controlsidebar')
    @include('ams::layouts.partials.footer')
</div>

@include('ams::layouts.partials.scripts')
@stack('scripts')

</body>
</html>
