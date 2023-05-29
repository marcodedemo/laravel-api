@extends('layouts/admin')


@section('content')

<div class="container my-5">


  <form action="{{route('admin.types.store')}}" method="POST">
      @csrf

      <div class="mb-3">
        <label for="name">Name</label>
        <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{old('name')}}">
        
        @error('name')
          <div class="invalid-feedback">
            {{$message}}
          </div> 
        @enderror

      </div>

      <div class="mb-3">
        <label for="description">Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{old('description')}}</textarea>

          @error('description')
          <div class="invalid-feedback">
              {{$message}}
          </div>
          @enderror

      </div>

      <button class="btn btn-primary" type="submit">Create Type</button>
    </form>


</div>

@endsection