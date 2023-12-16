@extends('layouts.app')

@section('content')



<div class="row justify-content-center ml-0 mr-0 h-100">
    <div class="card w-100  bg-dark text-white bg-gradient for-padding-ajustment">
        <div class="card-header row">メモ編集<form method='POST' class="col-1 ms-auto" action="/delete/{{$memo['id']}}" id='delete-form'>
                @csrf
                <button class='p-0 mr-2 bg-black bg-gradient' style='border:none;'><i id='delete-button' class="fas fa-trash"></i></button>
            </form>
        </div>
        <div class="card-body">
            <form method='POST' action="{{route('update', ['id' => $memo['id'] ])}}">
                <!-- ↓入れないとエラーなる -->
                @csrf
                <input type='hidden' name='user_id' value="{{ $user->id }}">
                <div class="form-group">
                    <textarea name='content' class="form-control" rows="10">{{ $memo['content']}}</textarea>
                </div>
                <div class="form-group">
                    <select class='form-control' name='tag_id'>
                        @foreach($tags as $tag)
                        <option value="{{ $tag['id'] }}" {{ $tag['id'] == $memo['tag_id'] ? "selected" : "" }}>{{$tag['name']}}</option>
                        @endforeach
                    </select>
                </div>
                <button type='submit' class="btn btn-warning btn-lg mt-3">更新</button>
            </form>
        </div>
    </div>
</div>
@endsection