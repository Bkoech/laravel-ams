<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('ams.dashboard') }}">
                    <i class='fa fa-link'></i> <span>{{ trans('ams::message.dashboard') }}</span>
                </a>
            </li>

            @foreach(\Cache::get('ams_modules', []) as $module)
                @can('access', $module->config['default_route'])
                    <li>
                        <a href="{{ route($module->config['default_route']) }}">
                            <i class='fa fa-link'></i> <span>{{ trans('ams::label.'.$module->name) }}</span>
                        </a>
                    </li>
                @endcan
            @endforeach

            @if(Auth::user()->is_superadmin)
                <li class="treeview">
                    <a href="#"><i class='fa fa-link'></i> <span>{{ trans('ams::message.system') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('ams.admin.index') }}">{{ trans('ams::message.admin') }}</a></li>
                        <li><a href="{{ route('ams.role.index') }}">{{ trans('ams::message.role') }}</a></li>
                        <li><a href="{{ route('ams.module.index') }}">{{ trans('ams::message.module') }}</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </section>
</aside>
