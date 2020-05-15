<?php

namespace App\Http\Controllers\Dashboard;

use App\Project;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('dashboard.projects.index', [
            'projects' => Project::paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('dashboard.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'tags' => 'required|string|max:250',
            'class' => 'string|nullable|max:200',
            'description' => 'required|string',
            'image' => 'required|image'
        ]);

        $project = Project::create($request->all());

        $project->addMediaFromRequest('image')
            ->usingName($request->input('name'))
            ->sanitizingFileName(function($fileName) {
                return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
            })
            ->toMediaCollection();

        return redirect()->route('dashboard.projects.index')->with('status', 'Project successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return void
     */
    public function show(Project $project)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Project $project
     * @return View
     */
    public function edit(Project $project)
    {
        return view('dashboard.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Project $project
     * @return RedirectResponse
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'tags' => 'required|string|max:250',
            'class' => 'string|nullable|max:200',
            'description' => 'required|string',
            'image' => 'image'
        ]);

        $project->update($request->all());

        if ($request->hasFile('image') && $request->file('image')->isValid()){
            $project->clearMediaCollection();
            $project->addMediaFromRequest('image')
                ->usingName($request->input('name'))
                ->sanitizingFileName(function($fileName) {
                    return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                })
                ->toMediaCollection();
        }

        return redirect()->route('dashboard.projects.index')->with('status', 'Project successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return RedirectResponse
     */
    public function destroy(Project $project)
    {
        try {
            $project->delete();
        } catch (Exception $e) {
            Log::error("Failed to delete module with id: {$project->id}");
            return redirect()->route('dashboard.projects.index')->with('error', 'Failed to delete the specified resource. Try again.');
        }

        return redirect()->route('dashboard.projects.index')->with('status', 'Resource successfully deleted!');
    }
}
