<head>
    <title>アカウント一覧</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/reset.css')  }}" >
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('アカウント一覧') }}
        </h2>
        <x-message :message="session('message')"/>
    </x-slot>

    <div class="py-12 flex justify-center">
        <x-account-button>アカウント登録</x-account-button>
    </div>

    <div class="flex justify-center">

        <table>

            <tr>
                <th>社員番号</th>
                <th>社員名</th>
                <th class="no">部署名</th>
                <th>操作</th>
            </tr>

            @foreach($users as $user)
                <tr>

                    <td>{{$user->employee_number}}</td>
                    <td>{{$user->family_name}} {{$user->first_name}}</td>
                    <td class="no">{{$user->division_name}}</td>
                    <td>
                        <a href="{{route('profile.edit',$user)}}">
                            <x-primary-button class="bg-teal-700 buttons">変更</x-primary-button>
                        </a>
                        <a href="{{route('profile.show',$user)}}">
                            <x-primary-button class="bg-red-700 buttons">削除</x-primary-button>
                        </a>
                    </td>

                </tr>
            @endforeach

            

        </table>


    </div>
</x-app-layout>
