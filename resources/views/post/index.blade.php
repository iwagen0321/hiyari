<head>
    <title>一覧表示</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/reset.css')  }}" >
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('一覧表示') }}
        </h2>

        <x-message :message="session('message')"/>

    </x-slot>

    <div class="py-6 flex justify-center">
        <x-create-button>新規投稿</x-create-button>
    </div>

    <div class="pb-6 flex justify-center">
        <form method="get" action="{{route('post.index')}}">
            <select name="filter" id="filter" onchange="this.form.submit()">
                <option value="all" @if($filter == 'all') selected @endif>全件表示</option>
                <option value="0" @if($filter == '0') selected @endif>対応済</option>
                <option value="1" @if($filter == '1') selected @endif>対応求ム</option>
            </select>
        </form>

        <form method="get" action="{{route('post.index')}}">
            <input class="input-box ml-12" type="text" placeholder="発生場所を検索" name="keyword" id="keyword" value="{{$keyword}}">
            <input class="search-btn" type="submit" value="検索">
        </form>
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
                        <a href="{{route('post.show',$post)}}">{{$post->location}}</a>
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
</x-app-layout>