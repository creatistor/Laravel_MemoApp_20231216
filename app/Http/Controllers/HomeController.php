<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// ↓を追加しないと33行目のAuthにエラーが出た
use Illuminate\Support\Facades\Auth;
use App\Models\Memo;
use App\Models\Tag;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        // 論理削除モデル採用
        $memos = Memo::where('user_id', $user['id'])->where('status', 1)->orderBy('updated_at', 'DESC')->get();
        $tags = Tag::where('user_id', $user['id'])->get();
        // dd($memos);
        return view('create', compact('user', 'memos', 'tags'));
    }

    public function create()
    {
        $user = Auth::user();
        $memos = Memo::where('user_id', $user['id'])->where('status', 1)->orderBy('updated_at', 'DESC')->get();
        $tags = Tag::where('user_id', $user['id'])->get();
        // ↓ここでmemosを追加しなかったことでずっとエラーになってた
        return view('create', compact('user', 'memos', 'tags'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);
        // POSTされたデータをDB（memosテーブル）に挿入
        // MEMOモデルにDBへ保存する命令を出す
        // 同じタグがあるか確認
        // タグのIDが判明する
        // タグIDをmemosテーブルに入れてあげる
        $tag_id = Tag::insertGetId(['name' => $data['tag'], 'user_id' => $data['user_id']]);

        $memo_id = Memo::insertGetId([
            'content' => $data['content'],
            'user_id' => $data['user_id'],
            'tag_id' => $tag_id,
            'status' => 1
        ]);

        // リダイレクト処理
        return redirect()->route('home');
    }

    public function edit($id)
    {
        // 該当するIDのメモをデータベースから取得
        $user = Auth::user();
        $memo = Memo::where('status', 1)->where('id', $id)->where('user_id', $user['id'])
            ->first();
        $memos = Memo::where('user_id', $user['id'])->where('status', 1)->orderBy('updated_at', 'DESC')->get();
        $tags = Tag::where('user_id', $user['id'])->get();

        //   dd($memo);
        //取得したメモをViewに渡す
        return view('edit', compact('memo', 'user', 'memos', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        // dd($inputs);
        Memo::where('id', $id)->update(['content' => $inputs['content'], 'tag_id' => $inputs['tag_id']]);
        return redirect()->route('home');
    }

    public function delete(Request $request, $id)
    {
        $inputs = $request->all();
        // dd($inputs);
        Memo::where('id', $id)->update(['content' => 2]);
        // 論理削除実装
        return redirect()->route('home')->with('success', 'Successfully Deleted!!');
    }
}
