<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request){


        $requestData = $request->all();
        
        $types = Type::all();

        if($request->has('type_id') && $requestData['type_id']) {

            $projects = Project::where('type_id', $requestData['type_id'])
                ->with('technologies', 'type')
                ->orderBy('projects.created_at', 'desc')
                ->get();

                if(count($projects) == 0){

                    return response()->json([

                        'success' => false,
                        'error' => 'Non ci sono progetti appartenenti a questo type',
                    ]);
                }
        }else{

            $projects = Project::with('technologies', 'type')
            ->orderBy('projects.created_at', 'desc')
            ->paginate(8);
    
        }
    
        return response()->json([
            'success' => true,
            'results' => $projects,
            'types' => $types,
        ]);

    }



    public function show($slug) {

        $project = Project::where('slug', $slug)->with('technologies', 'type')->first();

        if($project) {

            return response()->json([
                'success' => true,
                'response' => $project,
            ]);

        } else {

            return response()->json([
                'success' => false,
                'error' => 'Progetto inesistente',
            ]);

        }
    }
}
