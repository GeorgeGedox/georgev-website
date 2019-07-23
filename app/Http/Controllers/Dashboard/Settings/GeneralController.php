<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Setting;
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

    public function seo(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:60',
            'description' => 'nullable|string|max:160'
        ]);

        Setting::add('general_seo_title', $request->input('title'));
        Setting::add('general_seo_description', $request->input('description'));

        return back()->with('status', 'SEO settings updated!');
    }

    public function social(Request $request)
    {
        $request->validate([
            'social.*.name' => 'required_with:social.*.icon,social.*.url|nullable|string|max:150',
            'social.*.icon' => 'required_with:social.*.name,social.*.url|nullable|string|max:150',
            'social.*.url' => 'required_with:social.*.icon,social*.name|nullable|url|max:250',
        ]);

        $data = collect($request->input('social'))->reject(function ($item){
            return empty($item['name']);
        });

        Setting::add('general_social', $data->all(), 'array');

        return back()->with('status', 'Social settings updated!');
    }
}
