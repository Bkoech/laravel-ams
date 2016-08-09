<?php

namespace Wilgucki\LaravelAms;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Wilgucki\LaravelAms\Middleware\Acl;
use Wilgucki\LaravelAms\Models\Module;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Wilgucki\LaravelAms\Models\Role;
use Validator;

class AmsServiceProvider extends ServiceProvider
{
    public function boot(GateContract $gate)
    {
        $this->routing();
        $this->lang();
        $this->views();
        $this->assets();
        $this->migrations();
        $this->acl($gate);
        $this->registerValidators();
    }

    public function register()
    {
        $this->registerProvidersAndFacades();
        $this->registerModules();
        $this->registerMiddlewares();
    }

    protected function routing()
    {
        require __DIR__.'/../routes/admin.php';
        require __DIR__.'/../routes/front.php';
    }

    protected function lang()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'ams');
    }

    protected function views()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'ams');
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/ams'),
        ], 'views');
    }

    protected function assets()
    {
        $this->publishes([
            __DIR__.'/../resources/public' => public_path('vendor/ams'),
        ], 'public');
    }

    protected function migrations()
    {
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../database/factories' => database_path('factories'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../database/seeds' => database_path('seeds'),
        ], 'migrations');
    }

    protected function registerModules()
    {
        try {
            $modules = \DB::select("select * from modules where is_active = true");
            foreach ($modules as $module) {
                $this->app->register($module->namespace.'\\'.$module->service_provider);
            }
        } catch (\Exception $e) {
            // pomin globalna konfiguracje, jesli nie ma tabeli w bazie
        }
    }

    protected function registerMiddlewares()
    {
        $router = $this->app['router'];
        $router->middleware('acl', Acl::class);
    }

    protected function acl(GateContract $gate)
    {
        $gate->before(function ($user) {
            if ($user->is_superadmin) {
                return true;
            }
        });

        $gate->define('access', function ($user, ...$params) {
            if (count($params) == 1) {
                $router = \Route::getRoutes();
                $controllerAction = $router->getByName($params[0])->getAction()['uses'];
                list($controller, $action) = explode('@', $controllerAction);
            } else {
                list($controller, $action) = $params;
            }

            $role = Role::with(['acl' => function ($query) use ($controller) {
                $query->where('controller', ltrim($controller, '\\'));
            }])->where('id', \Auth::user()->role_id)->first();

            if ($role->acl->count() > 0) {
                foreach ($role->acl as $acl) {
                    if (in_array($action, explode(',', $acl->methods))) {
                        return true;
                    }
                }
            }

            return false;
        });
    }

    protected function registerValidators()
    {
        Validator::extend('password_strength', 'Wilgucki\LaravelAms\Validators\PasswordStrength@validate');
        Validator::extend('password_history', 'Wilgucki\LaravelAms\Validators\PasswordHistory@validate');
    }

    protected function registerProvidersAndFacades()
    {
        $loader = AliasLoader::getInstance();
        
        $this->app->register('Collective\Html\HtmlServiceProvider');
        $loader->alias('Form', 'Collective\Html\FormFacade');
        $loader->alias('Html', 'Collective\Html\HtmlFacade');

        if ($this->app->environment('local')) {
            $this->app->register('Barryvdh\Debugbar\ServiceProvider');
            $this->app->register('Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider');
        }
    }
}
