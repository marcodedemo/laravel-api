@extends('layouts/admin')


@section('content')


<div class="container py-5">
    
    <table class="table text-center">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Slug</th>
            <th scope="col">Icon</th>
            <th scope="col">Detail</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($technologies as $technology)

          <tr>

            <td scope="row">{{$technology->name}}</td>
            <td>{{$technology->slug}}</td>
            <td>

              <div class="logo-container d-flex justify-content-center">
                  <div class="logo">
                      <img src="{{Vite::asset('resources/img/logos/'. $technology->slug . '.png')}}" alt="">
                  </div>
              </div>
              
            </td>


            <td>
              <a href="{{route('admin.technologies.show', $technology->slug)}}" class="text-danger"><i class="fa-solid fa-magnifying-glass"></i></a>
            </td>

          </tr>
              
          @endforeach
        </tbody>

    </table>


    <div class="container d-flex justify-content-center align-items-center my-5">
        <div id="buttons">
            <a href="{{route('admin.technologies.create')}}"><button class="btn btn-primary">Add technology</button></a>
        </div>
    </div>



</div>

@endsection