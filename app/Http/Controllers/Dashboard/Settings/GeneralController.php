<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Classes\DribbbleAPI;
use App\Setting;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class GeneralController extends Controller
{
    public function index()
    {
        return view('dashboard.settings.general.index');
    }

    public function maintenance(Request $request)
    {
        $request->validate([
            'message' => 'string|min:3|nullable|present'
        ]);

        if (app()->isDownForMaintenance()) {
            Artisan::call('up');
        } else {
            Artisan::call('down', [
                '--message' => $request->input('message') ?? 'Down for maintenance.'
            ]);
        }

        return back();
    }

    public function seo(Request $request)
    {
        $request->validate([
            'title' => 'nullable|present|string|max:60',
            'description' => 'nullable|present|string|max:160',
            'tracking' => 'nullable|present|string',
        ]);

        Setting::add('general_seo_title', $request->input('title'));
        Setting::add('general_seo_description', $request->input('description'));
        Setting::add('general_seo_tracking', $request->input('tracking'));

        return back()->with('status', 'SEO settings updated!');
    }

    public function analytics(Request $request)
    {
        $request->validate([
            'view_id' => 'nullable|present|integer',
        ]);

        if (!Setting::get('general_analytics_key')){
            $request->validate([
                'analytics_key' => 'required|file|max:1000',
            ]);

            $path = $request->file('analytics_key')->storeAs('analytics', 'service-account-credentials.json', 'local');
            if (!$path){
                return back()->with('status', 'Failed to upload the analytics credentials file!');
            }

            Setting::set('general_analytics_key', true, 'bool');
        }

        Setting::add('general_analytics_view', $request->input('view_id'));

        return back()->with('status', 'Analytics settings updated!');
    }

    public function analyticsKeyReset(Request $request)
    {
        $request->validate([
            'reset_key' => 'required|accepted'
        ]);

        Setting::remove('general_analytics_key');
        Storage::disk('local')->delete('analytics/service-account-credentials.json');

        return back()->with('status', 'Analytics service key reset!');
    }

    public function social(Request $request)
    {
        $request->validate([
            'social.*.name' => 'required_with:social.*.icon,social.*.url|nullable|present|string|max:150',
            'social.*.icon' => 'required_with:social.*.name,social.*.url|nullable|present|string|max:150',
            'social.*.url' => 'required_with:social.*.icon,social*.name|nullable|present|url|max:250',
        ]);

        $data = collect($request->input('social'))->reject(function ($item) {
            return empty($item['name']);
        });

        Setting::add('general_social', $data->all(), 'array');

        return back()->with('status', 'Social settings updated!');
    }

    public function dribbble(Request $request)
    {
        $request->validate([
            'dribbble_enable' => 'nullable'
        ]);

        if ($request->has('dribbble_enable')) {
            Setting::set('general_dribbble_enable', true, 'bool');
        } else {
            Setting::set('general_dribbble_enable', false, 'bool');
        }

        return back()->with('status', 'Dribbble settings saved!');
    }

    public function dribbbleReset(Request $request)
    {
        $request->validate([
            'remove_integration' => 'required|accepted'
        ]);

        Setting::remove('dribbble_access_token');
        Setting::remove('general_dribbble_enable');

        return back()->with('status', 'Dribbble integration reset!');
    }

    public function dribbbleAuth(Request $request)
    {
        if (!$request->has('code')) {
            abort(404);
        }

        $api = new DribbbleAPI();
        $data = $api->authenticate($request->query('code'), route('dashboard.settings.general.dribbble-auth'));

        Setting::add('dribbble_access_token', $data['access_token']);

        return redirect()->route('dashboard.settings.general.index')->with('status', 'Dribbble access token successfully set!');
    }
}
