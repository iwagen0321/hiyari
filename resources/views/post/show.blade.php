<head>
    <title>個別表示</title>
    <link rel="stylesheet" href="{{ asset('/css/reset.css')  }}" >
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Breadcrumbs::render('show', $post) }}
        </h2>

        <x-message :message="session('message')"/>
    </x-slot>

    <div class="py-12 flex justify-center">

        <div style="width:60%;">

            <div class="flex justify-center pb-6">
                <a href="{{route('post.index')}}">
                    <x-primary-button>一覧表示へ</x-primary-button>
                </a>
            </div>

            @if(auth()->user()->role == 1 || $post->user_id == auth()->user()->id)
                <div class="py-5 flex justify-center">
                
                    <div>
                        <div class="buttons">
                            <form method="post" action="{{route('post.destroy',$post)}}" style="display:inline-block;">
                            @csrf
                            @method('delete')
                                <x-primary-button class="bg-red-700" onClick="return confirm('この投稿を削除しますか？')">削除</x-primary-button>
                            </form>
                        </div>
                        <div class="buttons">
                            <a href="{{route('post.edit',$post)}}">
                                <x-primary-button class="bg-teal-700">編集</x-primary-button>
                            </a>
                        </div>
                    </div>

                </div>
            @endif

            <div>

                <div class="title-back">
                    <p class="title">発生場所：{{$post->location}}</p>
                    @if(empty($post->user->id))
                        <p class="title float">投稿者：既に削除済みのユーザーです</p>
                    @else
                        <p class="title float">投稿者：{{$post->user->division_name}} {{$post->user->family_name}} {{$post->user->first_name}}</p>
                    @endif
                </div>

                <div class="body">
                    <div>
                        {{$post->body}}
                    </div>

                    @if($post->before_image)
                        <div>
                            <img src="{{asset('strage/before_images/'.$post->before_image)}}" class="image">
                        </div>
                    @endif

                    <div class="float">
                        {{$post->created_at->format('Y年m月d日')}}
                    </div>
                    
                </div>

            </div>


            <div>

                @if($post->response == 0)

                    <div class="responder-back">
                        @if(empty($responder))
                            <p>対応者：既に削除済みのユーザーです</p>
                        @else
                            <p>対応者：{{$responder->division_name}} {{$responder->family_name}} {{$responder->first_name}}</p>
                        @endif
                    </div>
                    
                    <div class="response-body">
                        <div>
                            {{$post->counterplan}}
                        </div>

                        @if($post->after_image)
                            <div>
                                <img src="{{asset('strage/after_images/'.$post->after_image)}}" class="image">
                            </div>
                        @endif

                        <div class="float">
                            {{$post->updated_at->format('Y年m月d日')}}
                         </div>

                    </div>

                @endif

            </div>

        </div>
 
    </div>
</x-app-layout>