@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <h1>Projects index</h1>
        </div>
    </section>
    <section>
        <div class="container">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <td></td>
                        <td>
                            <form action="{{ route('admin.projects.index') }}" method="GET">
                                <input placeholder="filtra per titolo" class="form-control" type="text" name="title" value="{{ request()->get('title') }}">
                            </form>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Type</th>
                    <th scope="col">User</th>
                    <th scope="col">Description</th>
                    <th scope="col">URL</th>
                    <th scope="col">Created</th>
                    <th scope="col">Updated</th>
                    <th></th>
                    <th>
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.projects.create') }}">New</a>
                    </th>
                  </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                    <tr>
                        <th scope="row">{{ $project->id}}</th>
                        <td>
                            <a href="{{ route('admin.projects.show', $project)}}">{{ $project->title}}</a>
                        </td>
                        <td> {{ $project->slug}}</td>
                        <td>
                            {{ isset($project->type) ? $project->type->name : '-'}}
                            {{-- {{ optional($project->type)->name  }} --}}
                        </td>
                        <td> {{ $project->user->name}}</td>
                        <td> {{ $project->description}}</td>
                        <td> {{ $project->url}}</td>
                        <td> {{ $project->created_at}}</td>
                        <td> 
                            {{ isset($project->updated_at) ? $project->updated_at : '-'}}
                        </td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="{{ route('admin.projects.edit', $project) }}">Edit</a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{ $project->id }}">
                                Delete
                            </button>
                             <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop-{{ $project->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">DELETE</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Sei sicuro di voler cancellare {{$project->title}}???
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <form 
                                                action="{{ route('admin.projects.destroy', $project)}}"
                                                method="POST">

                                                    @csrf

                                                    @method('delete')

                                                {{-- <input type="submit" value="Delete"> --}}
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                      </tr>
                    @empty
                        <tr>
                            <td>Nessun Progetto</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforelse
                </tbody>
              </table>
        </div>
    </section>
@endsection