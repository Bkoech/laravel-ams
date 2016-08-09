<?php

namespace Wilgucki\LaravelAms\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Wilgucki\LaravelAms\Models\Module;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $modules = Module::where('is_active', true)->get();
        return view('ams::dashboard', ['modules' => $modules]);
    }
}
