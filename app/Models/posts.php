<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class posts extends Model
{
    use HasFactory;
    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }
    public function responder() {
        return $this->belongsTo(User::class,'responder');
    }

    protected $fillable = [
        'user_id',
        'location',
        'response',
        'body',
        'before_image',
        'responder',
        'counterplan',
        'after_image'
    ];

    public function insertPost(Request $request) {

        $this->fill($request->all());

        if(empty($this->user_id)){
            $this->user_id = auth()->user()->id;
        }

        if(request('before_image')) {
            $before_original = request()->file('before_image')->getClientOriginalName();
            $before_name = date('Ymd_His').'_'.$before_original;
            request()->file('before_image')->move('strage/before_images',$before_name);
            $this->before_image = $before_name;
        }

        if(request('after_image')) {
            $after_original = request()->file('after_image')->getClientOriginalName();
            $after_name = date('Ymd_His').'_'.$after_original;
            request()->file('after_image')->move('strage/after_images',$after_name);
            $this->after_image = $after_name;
        }

        if($request->response == 0) {
            $this->responder = auth()->user()->id;
        } else {
            $this->responder = null;
        }

        if($request->response == 1) {
            $this->counterplan = null;
        }

        $this->save();
        return $this;

    }


    public function indexSearch($filter, $keyword) {
        if($filter == '0') {
            $posts = posts::where('response','=',"0")
            ->orderBy('created_at','desc');
        } elseif ($filter == '1') {
            $posts = posts::where('response','=',"1")
            ->orderBy('created_at','desc');
        } else {
            $posts = posts::orderBy('created_at','desc');
        }

        if(!empty($keyword)) {
            $posts = $posts->where('location', 'LIKE', "%{$keyword}%")->paginate(5);
        } else {
            $posts = $posts->paginate(5);
            $keyword = "";
        }

        return array($posts,$keyword);
    }

}
