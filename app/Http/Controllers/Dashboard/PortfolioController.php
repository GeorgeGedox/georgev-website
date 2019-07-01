<?php

namespace App\Http\Controllers\Dashboard;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.portfolio.index', [
            'projects' => Project::paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.portfolio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'tags' => 'required|string|max:250',
            'description' => 'required',
            'image' => 'required|image'
        ]);

        $project = Project::create($request->all());

        $project->addMediaFromRequest('image')
            ->usingName($request->input('name'))
            ->sanitizingFileName(function($fileName) {
                return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
            })
            ->toMediaCollection();

        return redirect()->route('dashboard.portfolio.index')->with('status', 'Project successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        try {
            $project->delete();
        } catch (\Exception $e) {
            Log::error("Failed to delete module with id: {$project->id}");
            return redirect()->route('dashboard.portfolio.index')->with('error', 'Failed to delete the specified resource. Try again.');
        }

        return redirect()->route('dashboard.portfolio.index')->with('status', 'Resource successfully deleted!');
    }
}
