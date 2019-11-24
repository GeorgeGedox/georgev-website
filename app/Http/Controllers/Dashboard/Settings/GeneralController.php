<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Classes\DribbbleAPI;
use App\Setting;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
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
            'message' => 'string|min:6|nullable'
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

        $data = collect($request->input('social'))->reject(function ($item) {
            return empty($item['name']);
        });

        Setting::add('general_social', $data->all(), 'array');

        return back()->with('status', 'Social settings updated!');
    }

    public function dribbble(Request $request)
    {
        $request->validate([
            'client_id' => Rule::requiredIf(function () {
                return empty(\setting('general_dribbble_client_id'));
            }),
            'dribbble_enable' => 'nullable'
        ]);

        if ($request->has('client_id')) {
            Setting::add('general_dribbble_client_id', $request->input('client_id'));
        }

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
            'remove_integration' => 'accepted'
        ]);

        Setting::remove('general_dribbble_client_id');
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
        $data = $api->authenticate(\setting('general_dribbble_client_id'), $request->query('code'), route('dashboard.settings.general.dribbble-auth'));

        Setting::add('dribbble_access_token', $data['access_token']);

        return redirect()->route('dashboard.settings.general.index')->with('status', 'Dribbble access token successfully set!');
    }
}
