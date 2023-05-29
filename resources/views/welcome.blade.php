@extends('layouts.guest-app')
@section('content')

<div class="jumbotron p-3 mb-4 bg-light rounded-3">
    <div class="container py-5">

        <h1 class="display-5 fw-bold">
            Welcome 
        </h1>
    </div>
</div>

<div class="content">
    <div class="container d-flex flex-wrap gap-3 mt-5">

        @foreach ($projects as $project)
    
        
        
            <div class="card" style="width: 18rem;">
                <div class="card-body d-flex flex-column justify-content-between">
    
                    <div class="card-content">
    
                        <h5 class="card-title">{{$project->title}}</h5>
                        
                        <h6 class="card-subtitle text-secondary fst-italic py-1">{{$project->type->name ?? ''}}</h6>
                        
                        <div class="card-text">
                            <ul class="d-flex flex-column gap-1">
    
                                <li><strong>Technologies: </strong>
    
                                    <div class="logo-container d-flex flex-wrap gap-2 py-1">
                                        @if (str_contains(strtolower($project->technologies), "html"))
                                        <div class="logo"><img src="{{Vite::asset('resources/img/logos/html.png')}}" alt="html5 logo"></div>
                                        @endif
                                        
                                        @if (str_contains(strtolower($project->technologies), "css"))
                                        <div class="logo"><img src="{{Vite::asset('resources/img/logos/css.png')}}" alt="css3 logo"></div>
                                        @endif
                                        
                                        @if (str_contains(strtolower($project->technologies), "js"))
                                        <div class="logo"><img src="{{Vite::asset('resources/img/logos/js.png')}}" alt="js logo"></div>
                                        @endif
                                        
                                        @if (str_contains(strtolower($project->technologies), "php"))
                                        <div class="logo"><img src="{{Vite::asset('resources/img/logos/php.png')}}" alt="php logo"></div>
                                        @endif
    
                                        @if (str_contains(strtolower($project->technologies), "vue"))
                                        <div class="logo"><img src="{{Vite::asset('resources/img/logos/vue.png')}}" alt="Vuejs logo"></div>
                                        @endif
                                        
                                        @if (str_contains(strtolower($project->technologies), "vite"))
                                        <div class="logo"><img src="{{Vite::asset('resources/img/logos/vite.png')}}" alt="Vite logo"></div>
                                        @endif
                                        
                                        @if (str_contains(strtolower($project->technologies), "bootstrap"))
                                        <div class="logo"><img src="{{Vite::asset('resources/img/logos/bootstrap.png')}}" alt="bootstrap logo"></div>
                                        @endif
                                        
                                        @if (str_contains(strtolower($project->technologies), "mysql"))
                                        <div class="logo"><img src="{{Vite::asset('resources/img/logos/mysql.png')}}" alt="MySQL logo"></div>
                                        @endif
                                        
                                        @if (str_contains(strtolower($project->technologies), "laravel"))
                                        <div class="logo"><img src="{{Vite::asset('resources/img/logos/laravel.png')}}" alt="Laravel logo"></div>
                                        @endif
                                    </div>
                                
                                </li>
                            
                                <li><strong>Execution Date: </strong> {{date("d/m/Y", strtotime($project['execution_date']))}}</li>
                                <li><strong>Description: </strong> {{$project['description']}}</li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="link-container">
    
                        <a href="{{$project->link}}" class="card-link align-self-start justify-self-end">Github</a>
    
                    </div>
                </div>
            </div>
    
    
            
        @endforeach
    
    </div>
</div>
@endsection