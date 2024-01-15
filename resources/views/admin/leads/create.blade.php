@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('admin.leads.store')}}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="example@email.com" value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Messagio</label>
                <textarea class="form-control" name="message" id="message" rows="3" placeholder="Messagio">{{ old('message') }}</textarea>
            </div>

            <div class="form-group mb-3">
                <div class="d-flex flex-wrap gap-4">
                    <div class="form-check">
                      <input 
                        name='privacy_policy' 
                        class="form-check-input" 
                        type="checkbox" 
                        value="1" 
                        id="privacy_policy" 
                        @checked( old('privacy_policy'))
                      >
                      <label class="form-check-label" for="privacy_policy">
                        Acconsento al trattamento dei dati personali <a href="#">Privacy Policy</a>
                      </label>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <input type="submit" class="btn btn-primary" value="Invio">
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

@endsection