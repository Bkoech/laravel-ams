<?php

namespace Wilgucki\LaravelAms\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Composer;
use Wilgucki\LaravelAms\Models\Module;
use Wilgucki\LaravelAms\Requests\UploadModuleRequest;

class ModuleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $modules = Module::orderBy('name')->get();
        return view('ams::module.index', ['modules' => $modules]);
    }
    
    public function add()
    {
        return view('ams::module.add');
    }
    
    public function upload(UploadModuleRequest $request, Composer $composer)
    {
        $module = new Module();
        $packageStatus = $module->registerModule($request->file('module_package')->getPathname(), $composer);
        
        if ($packageStatus == Module::REGISTERED) {
            return redirect()->route('ams.module.index')->with('flash_message', 'Moduł został dodany');
        } else {
            return back()->withErrors(['module_package' => trans('ams::validation.module'.$packageStatus)]);
        }
    }

    public function update(Module $module, $status)
    {
        $module->is_active = $status;
        $module->save();

        \Cache::forever('ams_modules', $modules = Module::where('is_active', true)->get());

        return redirect()->route('ams.module.index')->with(
            'flash_message',
            'Moduł został '.($status == 1 ? 'włączony' : 'wyłączony')
        );
    }
    
    public function delete(Module $module, Composer $composer)
    {
        $module->removeModule($composer);
        return redirect()->route('ams.module.index')->with('flash_message', 'Moduł został usunięty');
    }

    public function globalUpdate()
    {
        $modules = Module::all();
        foreach ($modules as $module) {
            $module->composerUpdate();
        }
        return redirect()->route('ams.module.index')->with('flash_message', 'Moduły zostały zaktualizowane');
    }
}
