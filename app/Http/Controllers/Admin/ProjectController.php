<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Tecnology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->all();

        $query = Project::limit(20);
       
        if (isset($data['title'])) {
            $query = $query->where('title', 'like', "%{$data['title']}%")->limit(20);
        }

        // $projects=Project::all();
        $projects=$query->get();
       return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::orderBy('name', 'ASC')->get();
        $tecnologies = Tecnology::orderBy('name', 'ASC')->get();

       return view('admin.projects.create', compact('types', 'tecnologies'));
    }

    /**
     * Store a newly created resource in storage.
     * 
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->all();
        // Creamo lo slug
        $data['slug'] = Str::slug($data['title'], '-');
        // Assegnamo il valore id del utente collegato tramite Auth::id()
        $data['user_id'] = Auth::id();
       
        $project = Project::create($data);

        if ($request->has('tecnologies')) {
            $project->tecnologies()->attach($data['tecnologies']);
            // $project->tecnologies()->attach($request->tecnologies);
        }

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {   
        $types = Type::orderBy('name', 'ASC')->get();
        $tecnologies = Tecnology::orderBy('name', 'ASC')->get();

        return view('admin.projects.edit', compact('project', 'types', 'tecnologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['title'], '-');

        $project->update($data);

        if ($request->has('tecnologies')) {
            $project->tecnologies()->sync($data['tecnologies']);
            // $project->tecnologies()->attach($request->tecnologies);
        } else {
            // $project->tecnologies()->sync([]);
            $project->tecnologies()->detach();
        }
        

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     * 
     */
    public function destroy(Project $project)
    {
        $project->tecnologies()->sync([]);
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
