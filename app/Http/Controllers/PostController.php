<?php

namespace App\Http\Controllers;

use App\Models\posts;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        $keyword = $request->input('keyword');

        if($filter == '0') {
            $posts = posts::where('response','=',"0")
            ->orderBy('created_at','desc')->get();
        } elseif ($filter == '1') {
            $posts = posts::where('response','=',"1")
            ->orderBy('created_at','desc')->get();
        } else {
            $posts = posts::orderBy('created_at','desc')->get();
        }

        if(!empty($keyword)) {
            $posts = posts::where('location', 'LIKE', "%{$keyword}%")
            ->orderBy('created_at','desc')->get();
        } else {
            $keyword = "";
        }

        return view('post.index',compact('posts','filter','keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = 'store';
        $button = '　投稿　';
        $title = '新規投稿';

        return view('post.form',compact('type','button','title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new posts();

        $post->insertPost($request);
        
        return redirect()->route('post.index')->with('message','投稿を完了しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(posts $post)
    {
        $users = User::all();
        return view('post.show',compact('post','users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(posts $post)
    {
        $type = 'update';
        $button = '　修正　';
        $title = '投稿の修正';

        return view('post.form',compact('type','button','title','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, posts $post)
    {
        $post->insertPost($request);
    
        return redirect()->route('post.show',compact('post'))->with('message','投稿を修正しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(posts $post)
    {
        $post->delete();
        return redirect()->route('post.index')->with('message','投稿を削除しました');
    }
}
