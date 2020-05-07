@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Manager</h1>
                @foreach ($entries as $entry)
                    <p>{{ $entry->description }}</p>
                @endforeach
            </div>
        </div>
    </div>
@endsection
