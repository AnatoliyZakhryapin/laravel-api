<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request) 
    {
        $data = $request->all();
        dd($data);
        $results = Project::with('type', 'tecnologies', 'user')->paginate($data['page']);
        return response()->json([
            'results' => $results,
            'success' => true
        ]);
    }
}
