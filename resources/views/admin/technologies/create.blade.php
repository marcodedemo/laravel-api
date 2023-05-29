@extends('layouts/admin')


@section('content')

<div class="container my-5">


  <form action="{{route('admin.technologies.store')}}" method="POST">
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

      <button class="btn btn-primary" type="submit">Create Technology</button>
    </form>


</div>

@endsection