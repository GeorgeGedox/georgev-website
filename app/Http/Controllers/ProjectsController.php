<?php

namespace App\Http\Controllers;

use App\Classes\DribbbleAPI;
use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        // TODO: Add pagination support
        if (setting('general_dribbble_enable') === true){
            $api = new DribbbleAPI(setting('dribbble_access_token'));
            $projectsData = $api->listShots(30);
        }else{
            $projectsData = Project::all();
        }

        return view('projects.index', [
            'projects' => $projectsData
        ]);
    }
}
