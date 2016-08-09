<?php

try {
    $modules = \Cache::get('ams_modules', []);
    foreach ($modules as $module) {
        $path = base_path('modules/'.$module->name.'/routes/front.php');
        if (file_exists($path)) {
            require_once $path;
        }
    }
} catch (\Exception $e) {
    // pomin bledy podczas testow
}
