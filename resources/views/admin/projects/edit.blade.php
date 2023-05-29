@extends('layouts/admin')


@section('content')

<div class="container my-5">


  <form action="{{route('admin.projects.update', $project->slug)}}" enctype="multipart/form-data" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="fw-bold" for="title">Title</label>
        <input class="form-control @error('title') is-invalid @enderror" type="text" id="title" name="title" value="{{old('title') ?? $project->title}}">
        
        @error('title')
          <div class="invalid-feedback">
            {{$message}}
          </div> 
        @enderror

      </div>

      <div class="mb-3">
        <label class="fw-bold" for="type_id">Project Type</label>
        <select name="type_id" id="type_id" class="form-select @error('type_id') is-invalid @enderror">

          <option value="">None</option>

          @foreach ($types as $type)
              <option value="{{$type->id}}" {{$type->id == old('type_id', $project->type_id) ? 'selected' : ''}}>{{$type->name}}</option>
          @endforeach

        </select>
        @error('type_id')
          <div class="invalid-feedback">
            {{$message}}
          </div>
        @enderror
      </div>

      <div class="mb-3">
        <h6 class="fw-bold">Technologies</h6>
  
        <div id="check-container " class="d-flex align-items-baseline gap-3">

          @foreach($technologies as $technology)
          <div>
            
            @if ($errors->any())
            <input type="checkbox" id="tech-{{$technology->id}}" name="technologies[]" value="{{$technology->id}}" @checked(in_array($technology->id, old('technologies', [])))>
            @else
            <input type="checkbox" id="tech-{{$technology->id}}" name="technologies[]" value="{{$technology->id}}" @checked($project->technologies->contains($technology))>
            @endif

            <label for="tech-{{$technology->id}}">{{$technology->name}}</label>
          </div>
          @endforeach
          
        </div>
      </div>

      <div class="mb-3">
        <label for="cover_image">Cover Image</label>
        <input type="file" id="cover_image" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror" >
        @error('cover_image')
          <div class="invalid-feedback">
            {{$message}}
          </div>    
        @enderror
      </div>

      <div class="mb-3">
        <label class="fw-bold" for="description">Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{old('description') ?? $project->description}}</textarea>

          @error('description')
          <div class="invalid-feedback">
              {{$message}}
          </div>
          @enderror

      </div>

      <div class="mb-3">
          <label class="fw-bold" for="link">Github Link</label>
          <input class="form-control @error('link') is-invalid @enderror" type="text" id="link" name="link" value="{{old('link') ?? $project->link}}">
          
          @error('link')
            <div class="invalid-feedback">
              {{$message}}
            </div> 
          @enderror
    
        </div>

      <div class="mb-3">
        <label class="fw-bold" for="execution_date">Execution Date</label>
        <input class="form-control @error('execution_date') is-invalid @enderror" type="text" id="execution_date" name="execution_date" value="{{old('execution_date') ?? $project->execution_date}}">

          @error('execution_date')
          <div class="invalid-feedback">
              {{$message}}
          </div>
          @enderror

      </div>

      <button class="btn btn-primary" type="submit">Edit</button>
    </form>


</div>

@endsection