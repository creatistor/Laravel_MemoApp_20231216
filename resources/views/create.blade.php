@extends('layouts.app')

@section('content')



<div class="row justify-content-center ml-0 mr-0 h-100">
    <div class="card w-100  bg-dark text-white bg-gradient for-padding-ajustment">
        <div class="card-header">新規メモ作成</div>
        <div class="card-body">
            <form method='POST' action="/store">
                <!-- ↓入れないとエラーなる -->
                @csrf
                <input type='hidden' name='user_id' value="{{ $user->id }}">
                <div class="form-group">
                    <textarea name='content' class="form-control" rows="10"></textarea>
                </div>
                <div class="form-group mt-3">
                    <label for="tag">タグ</label>
                    <input name='tag' type="text" class="form-control" id="tag" placeholder="タグを入力">
                </div>
                <button type='submit' class="btn btn-warning btn-lg mt-3">保存</button>
            </form>
        </div>
    </div>
</div>
@endsection