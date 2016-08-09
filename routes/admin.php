<?php

Route::get('/', function () {
    return view('ams::welcome');
});

Route::group(['prefix' => 'ams', 'middleware' => ['web']], function () {
    Route::group(['namespace' => 'Wilgucki\LaravelAms\Controllers'], function () {

        Route::get('login', ['as' => 'ams.login', 'uses' => 'Auth\AuthController@showLoginForm']);
        Route::post('login', ['as' => 'ams.login', 'uses' => 'Auth\AuthController@login']);
        Route::get('logout', ['as' => 'ams.logout', 'uses' => 'Auth\AuthController@logout']);

        Route::get('register', ['as' => 'ams.register', 'uses' => 'Auth\AuthController@showRegistrationForm']);
        Route::post('register', ['as' => 'ams.register', 'uses' => 'Auth\AuthController@register']);

        Route::get('password/reset/{token?}', [
            'as' => 'ams.password.reset', 'uses' => 'Auth\PasswordController@showResetForm'
        ]);
        Route::post('password/email', [
            'as' => 'ams.password.email', 'uses' => 'Auth\PasswordController@sendResetLinkEmail'
        ]);
        Route::post('password/reset', ['as' => 'ams.password.reset', 'uses' => 'Auth\PasswordController@reset']);

        Route::get('/dashboard', ['as' => 'ams.dashboard', 'uses' => 'DashboardController@index']);

        Route::group(['middleware' => 'acl'], function () {
            Route::get('/moduly', ['as' => 'ams.module.index', 'uses' => 'ModuleController@index']);
            Route::get('/moduly/dodaj', ['as' => 'ams.module.add', 'uses' => 'ModuleController@add']);
            Route::get('/moduly/aktualizuj', [
                'as' => 'ams.module.global-update', 'uses' => 'ModuleController@globalUpdate'
            ]);
            Route::post('/moduly/upload', ['as' => 'ams.module.upload', 'uses' => 'ModuleController@upload']);
            Route::put('/moduly/edytuj/{module}/{status}', [
                'as' => 'ams.module.update', 'uses' => 'ModuleController@update'
            ]);
            Route::delete('/moduly/usun/{module}', ['as' => 'ams.module.delete', 'uses' => 'ModuleController@delete']);

            Route::resource('role', 'RoleController');
            Route::resource('admin', 'AdminController');
        });
    });

    try {
        $modules = \Cache::get('ams_modules', []);
        foreach ($modules as $module) {
            $path = base_path('modules/'.$module->name.'/routes/admin.php');
            if (file_exists($path)) {
                require_once $path;
            }
        }
    } catch (\Exception $e) {
        // pomin bledy podczas testow
    }
});
