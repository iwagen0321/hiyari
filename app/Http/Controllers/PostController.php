<?php

namespace App\Http\Controllers;

use App\Models\posts;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

use function PHPUnit\Framework\isNull;

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
    public function index(Request $request, User $user)
    {   
        $type = 'index';
        $filter = $request->query('filter');
        $keyword = $request->input('keyword');
        $posts = new posts();
        list($posts, $keyword) = $posts->indexSearch($filter, $keyword);

        return view('post.index',compact('posts','filter','keyword','type','user'));
    }

    public function userIndex(User $user)
    {   
        $type = 'user_index';
        $filter = null;
        $keyword = null;
        $posts = $user->posts;

        return view('post.index',compact('posts','filter','keyword','type','user'));
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
        $type = 'show'; 
        $responder = $post->responder()->first();

        return view('post.show',compact('post','responder','type'));
    }

    public function userShow(User $user,posts $post)
    {
        $type = 'userShow';
        $responder = $post->responder()->first();

        return view('post.show',compact('post','responder','type','user'));
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

    public function userEdit(User $user,posts $post)
    {
        $type = 'user_update';
        $button = '　修正　';
        $title = '投稿の修正';

        return view('post.form',compact('type','button','title','post','user'));
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

    public function userUpdate(Request $request, User $user, posts $post)
    {
        $post->insertPost($request);
    
        return redirect()->route('post.userShow',compact('user','post'))->with('message','投稿を修正しました');
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
