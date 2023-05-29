<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();

        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/types/create');
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

        $existingType = Type::where('name', $formData['name'])->first();

        if ($existingType) {
            return redirect()->back()->withErrors(['name' => 'A type with the same name already exists.'])->withInput();
        }

        $formData['slug'] = Str::slug($formData['name'], '-');

        $newType = new Type();

        $newType->fill($formData);

        $newType->save();

        return redirect()->route('admin.types.show', $newType->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {

        return view('admin/types/show', compact('type'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view('admin/types/edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $this->validation($request, $type->id);

        $formData = $request->all();

        $type->slug = Str::slug($formData['name'], '-');

        $type->update($formData);

        $type->save();

        return redirect()->route('admin.types.show', $type->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('admin.types.index');
    }

    private function validation($request, $typeId = null){
        
        $formData = $request->all();
    
        $validator = Validator::make($formData, [
            
            'name' => 'required|unique:types,name,' . $typeId,
            'description' => 'required',
        ], [
            'name.required' => 'Insert a name',
            'name.unique' => 'Name already taken, please insert an alternative value',
            'description.required' => 'Insert a description',

        ])->validate();
    
        return $validator;
    }
}
