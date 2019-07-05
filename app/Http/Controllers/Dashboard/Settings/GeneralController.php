<?php

namespace App\Http\Controllers\Dashboard\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class GeneralController extends Controller
{
    public function index()
    {
        return view('dashboard.settings.general.index');
    }

    public function maintenance(Request $request)
    {
        $request->validate([
            'message' => 'string|min:6|nullable'
        ]);

        if (app()->isDownForMaintenance()){
            Artisan::call('up');
        }else{
            Artisan::call('down', [
                '--message' => $request->input('message') ?? 'Down for maintenance.'
            ]);
        }

        return back();
    }
}
