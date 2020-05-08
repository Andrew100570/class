@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <form method="POST" action="{{route('admin_edit_save')}}" id="form">
                {{csrf_field()}}
                <div class="form-row">
                    <label for="description">Редактирование задачи</label>
                </div>
                <div class="form-row mb-3">
                    <textarea type="text" name="description" id="textarea">
                            {{ $entries->description }}
                    </textarea>
                </div>
                <input id="name" name="id" type="hidden" class="form-control" value="{{ $entries->id }}">
                <div class="form-row mb-3">
                    <button type="submit" class="btn btn-primary">Редактировать задачу</button>
                </div>
            </form>
        </div>
    </div>
@endsection
