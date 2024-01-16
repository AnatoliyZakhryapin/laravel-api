<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Tecnology;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request) 
    {
        $data = $request->all();


        $results_projects = Project::with('type', 'tecnologies', 'user');
        
        // if (true) {
        //     $results_projects = $results_projects->where('type_id', '2');
        // }

        $results_projects = $results_projects->paginate($data['qtyForPage']);
        $tecologies = Tecnology::all();

        return response()->json([
            'results' => [
                'projects' => $results_projects,
                'tecnologies' => $tecologies,
            ],
            'success' => true,
            'request' => $data,
        ]);
    }

    public function show($slug)
    {
        $project = Project::with('type', 'tecnologies', 'user')->where('slug',$slug)->first();
        // $project->load('category', 'tags');

        return response()->json([
            'results' => $project,
            'success' => true,
        ]);
    }

}
