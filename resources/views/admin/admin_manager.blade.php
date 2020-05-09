@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Manager {{ $user->name }}</h1>
                @foreach ($entries as $entry)
                    <p>{{ $entry->description }}</p>
                    <a href="{{route('admin_edit',['id'=>$entry->id])}}">Изменить</a>
                    <a href="{{route('admin_delete',['id'=>$entry->id])}}">Удалить</a>
                @endforeach
            </div>
            <form method="POST" action="{{route('admin_entry',['user_id'=>$user->id])}}" id="form">
                {{csrf_field()}}
                <div class="row mb-3">
                    <div class="col-lg-12" style="min-height: 1.5rem; color: red">
                        {{$message}}
                    </div>
                </div>
                <div class="form-row">
                    <label for="description">Описание задачи</label>
                </div>
                <div class="form-row mb-3">
                    <textarea type="text" name="description" id="textarea"></textarea>
                </div>
                <div class="form-row mb-3">
                    <button type="submit" class="btn btn-primary">Создать задачу</button>
                </div>
            </form>
        </div>
    </div>
@endsection
