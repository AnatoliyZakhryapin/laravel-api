@extends('layouts.app')

@section('content')
    
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.projects.update', $project) }}" method="POST" >
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                              <label for="title" class="form-label">Title</label>
                              <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{ old('title', $project->title) }}">
                            </div>

                            <div class="mb-3">
                              <label for="slug" class="form-label">Slug</label>
                              <input type="text" readonly required class="form-control" name="slug" id="slug" placeholder="Slug" value="{{ old('slug', $project->slug) }}">
                            </div>

                            <div class="mb-3">
                              <label for="type_id" class="form-label">Types</label>
                              <select name="type_id" class="form-control" id="type_id">
                                <option disabled selected value>Seleziona type</option>
                                @foreach($types as $type)
                                  <option @selected( old('type_id',optional($project->type)->id) == $type->id ) value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                              </select>
                            </div>

                            <div class="form-group mb-3">
                              <p>Seleziona la tecnologia:</p>
                              <div class="d-flex flex-wrap gap-4">
                                @foreach($tecnologies as $tecnology)
                                  <div class="form-check">
                                    <input 
                                      name='tecnologies[]' 
                                      class="form-check-input" 
                                      type="checkbox" 
                                      value="{{$tecnology->id}}" 
                                      id="tecnology-{{$tecnology->id}}" 
                                      @checked(in_array($tecnology->id, old('tecnologies', $project->tecnologies->pluck('id')->all())))
                                    >
                                    <label class="form-check-label" for="tecnology-{{$tecnology->id}}">
                                      {{$tecnology->name}}
                                    </label>
                                  </div>
                                @endforeach
                              </div>
                            </div>
                      
                            <div class="mb-3">
                              <label for="description" class="form-label">Descrizione</label>
                              <textarea class="form-control" name="description" id="description" rows="3" placeholder="Description">{{ old('description', $project->description) }}</textarea>
                            </div>
                      
                            <div class="mb-3">
                              <label for="url" class="form-label">Url</label>
                              <input type="text" class="form-control" name="url" id="url" placeholder="Url"  value="{{ old('url', $project->url) }}">
                            </div>
                      
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.projects.index', $project)}}">
                                    <button type="button" class="btn btn-secondary">Close</button>
                                </a>
                              <input type="submit" class="btn btn-primary" value="Edit">
                            </div>
                          </form>
                    
                          @if ($errors->any())
                              <div class="alert alert-danger">
                                  <ul>
                                      @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                      @endforeach
                                  </ul>
                              </div>
                          @endif
                    </div>
                  </div>
            </div>
        </div>
    </div>
  </section>
@endsection