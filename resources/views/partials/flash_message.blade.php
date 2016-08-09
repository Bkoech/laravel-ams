@if(session('flash_message'))
    <div class="alert alert-success alert-dismissible">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-check"></i> {{ session('flash_message') }}</h4>
    </div>
@endif