<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projects = Project::all();

        return view('project.index', compact('projects'));
    }

    /**
     * @param \App\Http\Requests\ProjectStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectStoreRequest $request)
    {
        $project = Project::create($request->validated());

        $request->session()->flash('project.id', $project->id);

        return redirect()->route('project.index');
    }

    /**
     * @param \App\Http\Requests\ProjectUpdateRequest $request
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectUpdateRequest $request, Project $project)
    {
        $project->update($request->validated());

        $request->session()->flash('project.id', $project->id);

        return redirect()->route('project.index');
    }
}
