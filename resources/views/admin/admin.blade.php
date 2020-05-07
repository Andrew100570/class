@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                   <h1>Admin</h1>
                @foreach ($managers as $manager)
                   <a href="{{route('manager_by_id', ['id'=>$manager->id])}}">{{ $manager->name }}</a>
                    <br/>
                @endforeach
            </div>
        </div>
    </div>
@endsection
