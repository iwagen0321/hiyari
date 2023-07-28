<head>
    <title>一覧表示</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/reset.css')  }}" >
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if($type == 'index')
                <a href="{{route('post.index')}}">{{ Breadcrumbs::render('index') }}</a>
            @elseif($type == 'user_index')
                {{ Breadcrumbs::render('user_index',$user) }} 
            @endif
        </h2>

        <x-message :message="session('message')"/>

    </x-slot>

    <div @if($type=='user_index')class="none"@endif>
        <div class="py-6 flex justify-center">
            <x-create-button>新規投稿</x-create-button>
        </div>

        <form method="get" action="{{route('post.index')}}">
            <div class="pb-2 flex justify-center">
                <select name="filter" id="filter" onchange="submit(this.form)">
                    <option value="all" @if($filter == 'all') selected @endif>全件</option>
                    <option value="0" @if($filter == '0') selected @endif>対応済</option>
                    <option value="1" @if($filter == '1') selected @endif>対応求ム</option>
                </select>
            </div>
            
            <div class="pb-6 flex justify-center">
                <input class="input-box ml-4" type="text" placeholder="発生場所を入力" name="keyword" id="keyword" value="{{$keyword}}">
                <input class="search-btn" type="submit" value="検索">    
            </div>
        </form>
    </div>

    <div @if($type=='index')class="none"@endif>
        <div class="py-6 flex justify-center">
            <p class="font-semibold text-xl leading-tight">
                {{$user->family_name}} {{$user->first_name}}さんの投稿一覧
            </p>
        </div>
    </div>

    <div class="flex justify-center">

        <table>

            <tr>
                <th class="loca">発生場所</th>
                <th class="no date">投稿日</th>
                <th class="res">対応</th>
            </tr>

            @foreach($posts as $post)
                <tr>

                    <td @if($post->response == 1) class="text-red-600 underline decoration-1 bg-red-100" @endif class="underline decoration-1">
                        @if($type == 'index')
                            <a href="{{route('post.show',$post)}}">
                                {{$post->location}}
                            </a>
                        @elseif($type == 'user_index')
                            <a href="{{route('post.userShow',['user' => $user,'post' => $post])}}">
                                {{$post->location}}
                            </a>
                        @endif
                    </td>

                    <td @if($post->response == 1) class="text-red-600 bg-red-100 no" @endif class="no">
                        {{$post->created_at->format('Y-m-d')}}
                    </td>

                    <div class="response">
                        <td @if($post->response == 1) class="text-red-600 bg-red-100" @endif>
                      
                        @if($post->response == 0)対応済
                            @else 対応求ム
                            @endif
                        </td>
                    </div>

                </tr>
            @endforeach

        </table>        
    </div>
    
    <div class="flex justify-center mt-6 mb-6">
        {{ $posts->links('vendor.pagination.tailwind') }}
    </div>

   
</x-app-layout>