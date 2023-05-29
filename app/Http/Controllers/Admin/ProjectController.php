<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $types = Type::all();
        $technologies = Technology::all();

        return view('admin/projects/create', compact('types', 'technologies'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);

        $formData = $request->all();

        $existingProject = Project::where('title', $formData['title'])->first();

        if ($existingProject) {
            return redirect()->back()->withErrors(['title' => 'A project with the same title already exists.'])->withInput();
        }

        $formData['slug'] = Str::slug($formData['title'], '-');

        $newProject = new Project();

        if($request->hasFile('cover_image')) {
            
            $path = Storage::put('project_images', $request->cover_image);
            
            $formData['cover_image'] = $path;
        }

        $newProject->fill($formData);

        $newProject->save();

        if(array_key_exists('technologies',$formData)) {

            $newProject->technologies()->attach($formData['technologies']);
        }

        return redirect()->route('admin.projects.show', $newProject->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        
        return view('admin/projects/show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {

        $types = Type::all();
        $technologies = Technology::all();

        return view('admin/projects/edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->validation($request, $project->id);

        $formData = $request->all();

        if($request->hasFile('cover_image')) {

            if($project->cover_image) {

                Storage::delete($project->cover_image);
            }

            $path = Storage::put('project_images', $request->cover_image);

            $formData['cover_image'] = $path;

        }

        $project->slug = Str::slug($formData['title'], '-');

        $project->update($formData);

        $project->save();

        if(array_key_exists('technologies',$formData)) {

            $project->technologies()->sync($formData['technologies']);
        } else {

            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', $project->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {

        if($project->cover_image) {
            
            Storage::delete($project->cover_image);
        }

        $project->delete();

        return redirect()->route('admin.projects.index');
    }

    private function validation($request, $projectId = null){
        
        $formData = $request->all();
    
        $validator = Validator::make($formData, [
            
            'title' => 'required|unique:projects,title,'. $projectId,
            'description' => 'required',
            'link' => 'required',
            'execution_date' => 'required',
            'type_id' => 'nullable|exists:types,id',
            'cover_image' => 'nullable|image|max:8192',

        ], [
            'title.required' => 'Insert a title',
            'title.unique' => 'Title already taken, please insert an alternative value',
            'description.required' => 'Insert a description',
            'execution_date.required' => 'Insert an execution date',
            'type_id.exists' => 'Insert an existing category value',
            'cover_image.max' => "The uploaded image weighs too much",
            'cover_image.image' => "The file must be of type image",

        ])->validate();
    
        return $validator;
    }


    public function filter(Request $request) {
        
        $searchTerm = $request['search'];
        
        $projects = Project::where(function ($query) use ($searchTerm) {
            
            $query->where('title', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('link', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('execution_date', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('slug', 'LIKE', '%' . $searchTerm . '%');
            
        })->get();
        
        if($projects->isEmpty()){
            
            $projects = Project::all();
        }

        return  view('admin.projects.index', compact('projects'));
    }
}
