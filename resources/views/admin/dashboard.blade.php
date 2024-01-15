@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('User Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h2>I miei progetti </h2>
    
        <div class="row">
            @foreach ($user->projects as $project)
                <div class="col-4">
                    <a href="{{ route('admin.projects.show',$project) }}">
                    <h3>{{ $project->title }}</h3>
                    <p>{{ optional($project->type)->name }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
