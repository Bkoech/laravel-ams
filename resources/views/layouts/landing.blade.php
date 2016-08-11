<!DOCTYPE html>
<!--
Landing page based on Pratt: http://blacktie.co/demo/pratt/
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Adminlte-laravel - {{ trans('ams::message.landingdescription') }} ">
    <meta name="author" content="Sergi Tur Badenas - acacha.org">

    <meta property="og:title" content="Adminlte-laravel" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Adminlte-laravel - {{ trans('ams::message.landingdescription') }}" />
    <meta property="og:url" content="http://demo.adminlte.acacha.org/" />
    <meta property="og:image" content="http://demo.adminlte.acacha.org/img/AcachaAdminLTE.png" />
    <meta property="og:image" content="http://demo.adminlte.acacha.org/img/AcachaAdminLTE600x600.png" />
    <meta property="og:image" content="http://demo.adminlte.acacha.org/img/AcachaAdminLTE600x314.png" />
    <meta property="og:sitename" content="demo.adminlte.acacha.org" />
    <meta property="og:url" content="http://demo.adminlte.acacha.org" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@acachawiki" />
    <meta name="twitter:creator" content="@acacha1" />

    <title>{{ trans('ams::message.landingdescriptionpratt') }}</title>

    <!-- Bootstrap core CSS -->
    <link href="/vendor/ams/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/vendor/ams/css/main.css" rel="stylesheet">

    <link href='//fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

    <script src="/vendor/ams/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="/vendor/ams/js/smoothscroll.js"></script>


</head>

<body data-spy="scroll" data-offset="0" data-target="#navigation">

<!-- Fixed navbar -->
<div id="navigation" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><b>adminlte-laravel</b></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#home" class="smoothScroll">{{ trans('ams::message.home') }}</a></li>
                <li><a href="#desc" class="smoothScroll">{{ trans('ams::message.description') }}</a></li>
                <li><a href="#showcase" class="smoothScroll">{{ trans('ams::message.showcase') }}</a></li>
                <li><a href="#contact" class="smoothScroll">{{ trans('ams::message.contact') }}</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ route('ams.login') }}">{{ trans('ams::message.login') }}</a></li>
                    <li><a href="{{ route('ams.register') }}">{{ trans('ams::message.register') }}</a></li>
                @else
                    <li><a href="/home">{{ Auth::user()->name }}</a></li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>


<section id="home" name="home"></section>
<div id="headerwrap">
    <div class="container">
        <div class="row centered">
            <div class="col-lg-12">
                <h1>Acacha <b><a href="https://github.com/acacha/adminlte-laravel">adminlte-laravel</a></b></h1>
                <h3>A <a href="https://laravel.com/">Laravel</a> {{ trans('ams::message.laravelpackage') }}
                    scaffolding/boilerplate {{ trans('ams::message.to') }} <a href="https://almsaeedstudio.com/preview">AdminLTE</a> {{ trans('ams::message.templatewith') }}
                    <a href="http://getbootstrap.com/">Bootstrap</a> 3.0 {{ trans('ams::message.and') }} <a href="http://blacktie.co/demo/pratt/">Pratt</a> Landing page</h3>
                <h3><a href="{{ url('/register') }}" class="btn btn-lg btn-success">{{ trans('ams::message.gedstarted') }}</a></h3>
            </div>
            <div class="col-lg-2">
                <h5>{{ trans('ams::message.amazing') }}</h5>
                <p>{{ trans('ams::message.basedadminlte') }}</p>
                <img class="hidden-xs hidden-sm hidden-md" src="/vendor/ams/img/arrow1.png">
            </div>
            <div class="col-lg-8">
                <img class="img-responsive" src="/vendor/ams/img/app-bg.png" alt="">
            </div>
            <div class="col-lg-2">
                <br>
                <img class="hidden-xs hidden-sm hidden-md" src="/vendor/ams/img/arrow2.png">
                <h5>{{ trans('ams::message.awesomepackaged') }}</h5>
                <p>... {{ trans('ams::message.by') }} <a href="http://acacha.org/sergitur">Sergi Tur Badenas</a> {{ trans('ams::message.at') }} <a href="http://acacha.org">acacha.org</a> {{ trans('ams::message.readytouse') }}</p>
            </div>
        </div>
    </div> <!--/ .container -->
</div><!--/ #headerwrap -->


<section id="desc" name="desc"></section>
<!-- INTRO WRAP -->
<div id="intro">
    <div class="container">
        <div class="row centered">
            <h1>{{ trans('ams::message.designed') }}</h1>
            <br>
            <br>
            <div class="col-lg-4">
                <img src="/vendor/ams/img/intro01.png" alt="">
                <h3>{{ trans('ams::message.community') }}</h3>
                <p>{{ trans('ams::message.see') }} <a href="https://github.com/acacha/adminlte-laravel">{{ trans('ams::message.githubproject') }}</a>, {{ trans('ams::message.post') }} <a href="https://github.com/acacha/adminlte-laravel/issues">{{ trans('ams::message.issues') }}</a> {{ trans('ams::message.and') }} <a href="https://github.com/acacha/adminlte-laravel/pulls">{{ trans('ams::message.pullrequests') }}</a></p>
            </div>
            <div class="col-lg-4">
                <img src="/vendor/ams/img/intro02.png" alt="">
                <h3>{{ trans('ams::message.schedule') }}</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
            <div class="col-lg-4">
                <img src="/vendor/ams/img/intro03.png" alt="">
                <h3>{{ trans('ams::message.monitoring') }}</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
        </div>
        <br>
        <hr>
    </div> <!--/ .container -->
</div><!--/ #introwrap -->

<!-- FEATURES WRAP -->
<div id="features">
    <div class="container">
        <div class="row">
            <h1 class="centered">{{ trans('ams::message.whatnew') }}</h1>
            <br>
            <br>
            <div class="col-lg-6 centered">
                <img class="centered" src="/vendor/ams/img/mobile.png" alt="">
            </div>

            <div class="col-lg-6">
                <h3>{{ trans('ams::message.features') }}</h3>
                <br>
                <!-- ACCORDION -->
                <div class="accordion ac" id="accordion2">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                                {{ trans('ams::message.design') }}
                            </a>
                        </div><!-- /accordion-heading -->
                        <div id="collapseOne" class="accordion-body collapse in">
                            <div class="accordion-inner">
                                <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            </div><!-- /accordion-inner -->
                        </div><!-- /collapse -->
                    </div><!-- /accordion-group -->
                    <br>

                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                                {{ trans('ams::message.retina') }}
                            </a>
                        </div>
                        <div id="collapseTwo" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            </div><!-- /accordion-inner -->
                        </div><!-- /collapse -->
                    </div><!-- /accordion-group -->
                    <br>

                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                                {{ trans('ams::message.support') }}
                            </a>
                        </div>
                        <div id="collapseThree" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            </div><!-- /accordion-inner -->
                        </div><!-- /collapse -->
                    </div><!-- /accordion-group -->
                    <br>

                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
                                {{ trans('ams::message.responsive') }}
                            </a>
                        </div>
                        <div id="collapseFour" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            </div><!-- /accordion-inner -->
                        </div><!-- /collapse -->
                    </div><!-- /accordion-group -->
                    <br>
                </div><!-- Accordion -->
            </div>
        </div>
    </div><!--/ .container -->
</div><!--/ #features -->


<section id="showcase" name="showcase"></section>
<div id="showcase">
    <div class="container">
        <div class="row">
            <h1 class="centered">{{ trans('ams::message.screenshots') }}</h1>
            <br>
            <div class="col-lg-8 col-lg-offset-2">
                <div id="carousel-example-generic" class="carousel slide">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="/vendor/ams/img/item-01.png" alt="">
                        </div>
                        <div class="item">
                            <img src="/vendor/ams/img/item-02.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
    </div><!-- /container -->
</div>


<section id="contact" name="contact"></section>
<div id="footerwrap">
    <div class="container">
        <div class="col-lg-5">
            <h3>{{ trans('ams::message.address') }}</h3>
            <p>
                Av. Greenville 987,<br/>
                New York,<br/>
                90873<br/>
                United States
            </p>
        </div>

        <div class="col-lg-7">
            <h3>{{ trans('ams::message.dropus') }}</h3>
            <br>
            <form role="form" action="#" method="post" enctype="plain">
                <div class="form-group">
                    <label for="name1">{{ trans('ams::message.yourname') }}</label>
                    <input type="name" name="Name" class="form-control" id="name1" placeholder="{{ trans('ams::message.yourname') }}">
                </div>
                <div class="form-group">
                    <label for="email1">{{ trans('ams::message.emailaddress') }}</label>
                    <input type="email" name="Mail" class="form-control" id="email1" placeholder="{{ trans('ams::message.enteremail') }}">
                </div>
                <div class="form-group">
                    <label>{{ trans('ams::message.yourtext') }}</label>
                    <textarea class="form-control" name="Message" rows="3"></textarea>
                </div>
                <br>
                <button type="submit" class="btn btn-large btn-success">{{ trans('ams::message.submit') }}</button>
            </form>
        </div>
    </div>
</div>
<div id="c">
    <div class="container">
        <p>
            <a href="https://github.com/acacha/adminlte-laravel"></a><b>admin-lte-laravel</b></a>. {{ trans('ams::message.descriptionpackage') }}.<br/>
            <strong>Copyright &copy; 2015 <a href="http://acacha.org">Acacha.org</a>.</strong> {{ trans('ams::message.createdby') }} <a href="http://acacha.org/sergitur">Sergi Tur Badenas</a>. {{ trans('ams::message.seecode') }} <a href="https://github.com/acacha/adminlte-laravel">Github</a>
            <br/>
            AdminLTE {{ trans('ams::message.createdby') }} Abdullah Almsaeed <a href="https://almsaeedstudio.com/">almsaeedstudio.com</a>
            <br/>
             Pratt Landing Page {{ trans('ams::message.createdby') }} <a href="http://www.blacktie.co">BLACKTIE.CO</a>
        </p>

    </div>
</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/vendor/ams/js/bootstrap.min.js" type="text/javascript"></script>
<script>
    $('.carousel').carousel({
        interval: 3500
    })
</script>
</body>
</html>
