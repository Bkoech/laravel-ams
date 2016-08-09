<?php

namespace Wilgucki\LaravelAms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Composer;
use Symfony\Component\Process\Process;

/**
 * Class Module
 * @package Wilgucki\LaravelAms\Models
 */
class Module extends Model
{
    protected $casts = [
        'config' => 'array'
    ];

    const REGISTERED = 0;
    const INVALID_COMPOSER = 1;
    const INVALID_ROUTE = 2;
    const INVALID_SERVICE_PROVIDER = 3;
    const INVALID_MODULE_CONFIG = 4;

    protected $parsedData = [
        'composer' => null,
        'route' => [
            'admin' => null,
            'front' => null,
        ],
        'serviceProvider' => null,
        'serviceProviderName' => null,
        'moduleConfig' => null,
    ];

    /**
     * Register uploaded module
     *
     * @param string $path Path to zipped module. Usualy taken from global $_FILES array as modules are uploaded by user
     * @param Composer $composer
     * @return int
     */
    public function registerModule($path, Composer $composer)
    {
        $zip = new \ZipArchive();
        $zip->open($path);

        $this->parseData($zip);

        $validationResult = $this->validateRequiredFiles();
        if ($validationResult != self::REGISTERED) {
            return $validationResult;
        }

        $zip->extractTo(base_path('modules'));
        
        $this->saveModule();
        $this->loadAclResources();
        $this->updateComposerJson();
        $this->composerUpdate();
        $this->publishModuleFiles();
        $this->dumpAutoload($composer);

        return self::REGISTERED;
    }

    /**
     * Removes module from file system
     *
     * @TODO delete published module files as well
     * @param Composer $composer
     */
    public function removeModule(Composer $composer)
    {
        $this->cleanComposerJson();
        $this->dumpAutoload($composer);
        $this->unlinkFiles();
        $this->delete();
    }

    /**
     * Parses uploaded module in order to extract required information and validate directory structure.
     *
     * @param \ZipArchive $zip
     */
    protected function parseData(\ZipArchive $zip)
    {
        for ($i=0; $i<$zip->numFiles; $i++) {
            $name = $zip->getNameIndex($i);
            if (strpos($name, 'composer.json') !== false) {
                $this->parsedData['composer'] = $zip->getFromName($name);
            }
            if (strpos($name, 'routes/admin.php') !== false) {
                $this->parsedData['route']['admin'] = $zip->getFromName($name);
            }
            if (strpos($name, 'routes/front.php') !== false) {
                $this->parsedData['route']['front'] = $zip->getFromName($name);
            }
            if (strpos($name, 'ServiceProvider.php') !== false) {
                $this->parsedData['serviceProvider'] = $zip->getFromName($name);
                $this->parsedData['serviceProviderName'] = $name;
            }
            if (strpos($name, 'module-config.php') !== false) {
                $this->parsedData['moduleConfig'] = $name;
            }
        }
    }

    /**
     * Validates uploaded module.
     *
     * @return int
     */
    protected function validateRequiredFiles()
    {
        if ($this->parsedData['composer'] === null) {
            return self::INVALID_COMPOSER;
        }
        if ($this->parsedData['route']['admin'] === null && $this->parsedData['route']['front'] === null) {
            return self::INVALID_ROUTE;
        }
        if ($this->parsedData['serviceProvider'] === null) {
            return self::INVALID_SERVICE_PROVIDER;
        }
        if ($this->parsedData['moduleConfig'] === null) {
            return self::INVALID_MODULE_CONFIG;
        }
    }

    /**
     * Saves uploaded module into database table.
     */
    protected function saveModule()
    {
        \Storage::disk('local')->put($this->parsedData['serviceProviderName'], $this->parsedData['serviceProvider']);

        $classes = get_declared_classes();
        require_once storage_path('app/'.$this->parsedData['serviceProviderName']);
        $diff = array_diff(get_declared_classes(), $classes);
        $class = reset($diff);

        $reflection = new \ReflectionClass($class);
        $json = json_decode($this->parsedData['composer']);

        $module = static::whereName($json->name)->first();
        if ($module === null) {
            $module = $this;
        }

        $config = require_once base_path('modules/'.$this->parsedData['moduleConfig']);

        $module->namespace = $reflection->getNamespaceName();
        $module->service_provider = $reflection->getShortName();
        $module->name = $json->name;
        $module->description = $json->description;
        $module->config = $config;
        $module->save();

        \Storage::disk('local')->delete($this->parsedData['serviceProviderName']);
    }

    /**
     * Updates global composer.json file and adds module namespace to autoloader.
     */
    protected function updateComposerJson()
    {
        $composerJson = json_decode(\File::get(base_path('composer.json')), true);
        $composerJson['autoload']['psr-4'][$this->namespace.'\\'] = 'modules/'.$this->name.'/src/';
        \File::put(base_path('composer.json'), json_encode($composerJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }

    /**
     * Installs module dependencies.
     */
    public function composerUpdate()
    {
        $process = new Process('', realpath(__DIR__.'/../../bin'));
        $process->setTimeout(null);
        $process->setCommandLine('composer update --working-dir='.base_path('modules/'.$this->name));
        $process->run();
    }

    /**
     * Generates autoloader.
     *
     * @param Composer $composer
     */
    protected function dumpAutoload(Composer $composer)
    {
        $composer->setWorkingPath(realpath(__DIR__.'/../../bin'));
        $composer->dumpAutoloads();
    }

    /**
     * Removes deleted module namespaces from main composer.json.
     */
    protected function cleanComposerJson()
    {
        $composerJson = json_decode(\File::get(base_path('composer.json')), true);
        unset($composerJson['autoload']['psr-4'][$this->namespace.'\\']);
        \File::put(base_path('composer.json'), json_encode($composerJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }

    /**
     * Deletes module directory.
     */
    protected function unlinkFiles()
    {
        \File::deleteDirectory(base_path('modules/'.$this->name));
    }

    /**
     * Parses module acl config and adds it into database table.
     */
    protected function loadAclResources()
    {
        $acl = $this->config['acl'];
        foreach ($acl['resources'] as $controller => $actions) {
            foreach ($actions as $label => $action) {
                $aclResource = AclResource::where('controller', $controller)
                    ->where('action', $label)
                    ->where('methods', implode(',', $action))
                    ->first();

                if ($aclResource === null) {
                    $aclResource = new AclResource();
                }

                $aclResource->controller = $controller;
                $aclResource->action = $label;
                $aclResource->methods = implode(',', $action);
                $aclResource->save();
            }
        }
    }

    /**
     * Publishes module files like views, migrations, configs, etc.
     */
    protected function publishModuleFiles()
    {
        $provider = $this->namespace.'\\'.$this->service_provider;
        \Artisan::call('vendor:publish', ['--provider' => $provider]);
    }
}
