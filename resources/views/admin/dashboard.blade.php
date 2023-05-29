@extends('layouts/admin')

@section('content')


  <div class="container py-5">
    
    <h1>Login eseguito con successo</h1>
    
    <hr>
    
    <ul>
      <li><a href="{{route('admin.projects.index')}}">Vai alla pagina dei progetti</a></li>
    </ul>

  </div>
    
@endsection