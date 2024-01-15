@extends('layouts.app')

@section('content')
    <section class="p-5">
        <div class="container">
            <div class="row row-gap-5 justify-content-center">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Titolo: {{ $project->title }}</h5>
                            <p class="card-text">Slug:{{ $project->slug}}</p>
                        
                            {{-- @if($project->type)
                            <p>
                              <strong>
                              {{ $project->type->name }}
                              </strong>
                            </p>
                            @endif --}}
                            @if ($project->type)
                                <p class="card-text">Type: <strong>{{ $project->type->name }}</strong></p>
                            @else
                                <p class="card-text">Type:</p>
                            @endif
                           
                            <ul class="d-flex gap-2">
                                @foreach($project->tecnologies as $tecnology)
                                    <li class="badge rounded-pill text-bg-primary">{{ $tecnology->name }}</li>
                                @endforeach

                            </ul>

                            <p class="card-text">Descrizione: {{ $project->description}}</p>
                            <p class="card-text">Creato da: {{ $project->user->name}}</p>
                            <p class="card-text">Link: {{ $project->url}}</p>
                            <p class="card-text">Data: {{ $project->created_at->format('d/m/Y')}}</p>
                            <p class="card-text">Aggiornato: {{ $project->updated_at->format('d/m/Y')}}</p>
                        </div>
                        <div class="card-body">
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.projects.index')}}">
                                    <button type="button" class="btn btn-secondary">Close</button>
                                </a>
                                <a href="{{ route('admin.projects.edit', $project)}}" class="btn btn-primary">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection