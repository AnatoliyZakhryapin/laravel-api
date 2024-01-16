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

        $results = Project::with('type', 'tecnologies', 'user')->paginate($data['qtyForPage']);
        $tecologies = Tecnology::all();

        return response()->json([
            'results' => $results,
            'success' => true,
            'request' => $data,
            'tecnologies' => $tecologies
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
