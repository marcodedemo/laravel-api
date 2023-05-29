@extends('layouts/admin')


@section('content')

<div class="container py-5">

    <div id="title" class="d-flex gap-3">

        <div class="title-logo">
            <img src="{{Vite::asset('resources/img/logos/'. $technology->slug . '.png')}}" alt="">
        </div>

        <h1>{{$technology->name}}</h1>
    </div>

    <hr>


    <h3>Projects: {{count($technology->projects)}}</h3>
    <div id="projects-container" class="container d-flex flex-wrap gap-3 mt-4">
        @foreach ($technology->projects as $project)
    
        
            <div class="card" style="width: 18rem;">
                <div class="card-body d-flex flex-column justify-content-between">
    
                    <div class="card-content">
    
                        <h5 class="card-title">{{$project->title}}</h5>
                        
                        <h6 class="card-subtitle text-secondary fst-italic py-1">{{$project->type->name ?? ''}}</h6>
                        
                        <div class="card-text">
                            <ul class="d-flex flex-column gap-1">
    
                                <li><strong>Technologies: </strong>
    
                                    <div class="logo-container d-flex gap-2 py-1">
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

    



    <div id="buttons" class="d-flex flex-column gap-3 py-5">

        
        <div id="technology-edit">
            <a href="{{route('admin.technologies.edit', $technology->slug )}}" ><button class="btn btn-primary">Edit Technology</button></a>
        </div>

        <div id="technology-delete">

            
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete Type</button>
            
            
            <!-- Modal -->
            
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Warning!</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Do you want to permanently delete this Technology?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            
                            <form action="{{route('admin.technologies.destroy', $technology->slug)}}" method="POST">
                                
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete Permanently</button>
                                
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
</div>



@endsection