<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Tecnology;
use App\Models\Type;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request) 
    {
        $data = $request->all();

        $results_projects = Project::with('type', 'tecnologies', 'user');
        
        if (isset($data['formRequest']['typesSelected'])) {
            $results_projects = $results_projects->whereIn('type_id', $data['formRequest']['typesSelected']);
        }

        if (isset($data['formRequest']['typesSelectedNull'])) {
            $results_projects = $results_projects->orWhereNull('type_id', '');
        }


        // if (isset($data['formRequest']['tecnologiesSelected'])) {
        //     $results_projects = $results_projects->whereIn('type_id', $data['formRequest']['tecnologiesSelected']);
        // }

        // dd($results_projects->get());

        $results_projects = $results_projects->paginate($data['qtyForPage']);
        $tecologies = Tecnology::all();
        $types = Type::all();

        return response()->json([
            'results' => [
                'projects' => $results_projects,
                'tecnologies' => $tecologies,
                'types' => $types
            ],
            'success' => true,
            'request' => $data,
        ]);
    }

    public function show(Project $project)
    {   

        // $project = Project::with('type', 'tecnologies', 'user')->where('slug',$slug)->first();
        $project->load('type', 'tecnologies', 'user');

        return response()->json([
            'results' => $project,
            'success' => true,
        ]);
    }

}
