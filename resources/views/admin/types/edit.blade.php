@extends('layouts/admin')


@section('content')

<div class="container my-5">


  <form action="{{route('admin.types.update', $type->slug)}}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label for="name">Name</label>
        <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{old('name') ?? $type->name}}">
        
        @error('name')
          <div class="invalid-feedback">
            {{$message}}
          </div> 
        @enderror

      </div>

      <div class="mb-3">
        <label for="description">Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{old('description') ?? $type->description}}</textarea>

          @error('description')
          <div class="invalid-feedback">
              {{$message}}
          </div>
          @enderror

      </div>

      <button class="btn btn-primary" type="submit">Edit</button>
    </form>


</div>

@endsection