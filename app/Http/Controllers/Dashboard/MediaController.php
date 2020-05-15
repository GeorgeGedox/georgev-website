<?php

namespace App\Http\Controllers\Dashboard;

use App\Classes\Helpers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $files = Storage::disk('public')->files('uploads');
        $uploads = [];

        foreach ($files as $index => $file){
            $uploads[$index]['path'] = $file;
            $uploads[$index]['url'] = Storage::disk('public')->url($file);
            $uploads[$index]['added'] = Storage::disk('public')->lastModified($file);
            $uploads[$index]['size'] = Helpers::formatBytes(Storage::disk('public')->size($file));
        }

        return view('dashboard.media.index', compact('uploads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('dashboard.media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:10000',
        ]);

        $publicPath = $request->file('file')->store('uploads', 'public');

        if (!$publicPath){
            return response()->json([
                'status' => 'fail',
            ], 500);
        }

        return response()->json([
            'status' => 'ok',
            'path' => $publicPath
        ]);
    }

    /**
     * Remove the specified resource from storage by path.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Request $request)
    {
        $request->validate([
            'path' => 'required|string',
        ]);

        Storage::disk('public')->delete($request->input('path'));

        return redirect()->route('dashboard.media.index')->with('status', 'Resource successfully deleted!');
    }
}
