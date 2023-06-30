<head>
    <title>{{$title}}</title>
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$title}}
        </h2>

        <x-message :message="session('message')"/>

        @if($type == 'destroy')
            <div class="flex justify-center text-lg text-red-700">
                <p>このアカウントを削除しますか？</p>
            </div>
        @endif

    </x-slot>
    
    <x-guest-layout>
        @if($type == 'update')
            <form method="post" action="{{route('profile.'.$type,$user)}}">
            @method('patch')
        @elseif($type == 'destroy')
            <form method="post" action="{{route('profile.'.$type,$user)}}">
            @method('delete')
        @endif
            @csrf

                <!-- role -->
                <div class="block font-medium text-sm text-gray-700">
                    @if($type == 'update')
                        <input type="radio" name="role" id="role" value="0" @if($user->role==0) checked @endif>一般社員
                        <input type="radio" name="role" id="role" value="1" @if($user->role==1) checked @endif>管理職員
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    @elseif($type == 'destroy')
                        @if($user->role==0) <p>一般社員</p> @endif
                        @if($user->role==1) <p>管理職員</p> @endif
                    @endif
                </div>

                <!-- familyName -->
                <div class="mt-4">
                    <x-input-label for="family_name" :value="__('family_name')" />
                    @if($type == 'update')
                        <x-text-input id="family_name" class="block mt-1 w-full" type="text" name="family_name" value="{{$user->family_name}}" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('family_name')" class="mt-2" />
                    @elseif($type == 'destroy')
                        <p class="block mt-1 w-full rounded-md border-gray-300" type="text">{{$user->family_name}}</p>
                    @endif
                </div>

                <!-- firstName -->
                <div class="mt-4">
                    <x-input-label for="first_name" :value="__('first_name')" />
                    @if($type == 'update')
                        <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" value="{{$user->first_name}}" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                    @elseif($type == 'destroy')
                        <p class="block mt-1 w-full rounded-md border-gray-300" type="text">{{$user->first_name}}</p>
                    @endif
                </div>

                <!-- 社員番号 -->
                <div class="mt-4">
                    <x-input-label for="employee_number" :value="__('employee_number')" />
                    @if($type == 'update')
                        <x-text-input id="employee_number" class="block mt-1 w-full" type="text" name="employee_number" value="{{$user->employee_number}}" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('employee_number')" class="mt-2" />
                    @elseif($type == 'destroy')
                        <p class="block mt-1 w-full rounded-md border-gray-300" type="text">{{$user->employee_number}}</p>
                    @endif

                </div>

                <!-- 部署名 -->
                <div class="mt-4">
                    <x-input-label for="division_name" :value="__('division_name')" />
                    @if($type == 'update')
                        <x-text-input id="division_name" class="block mt-1 w-full" type="text" name="division_name" value="{{$user->division_name}}" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('division_name')" class="mt-2" />
                    @elseif($type == 'destroy')
                        <p class="block mt-1 w-full rounded-md border-gray-300" type="text">{{$user->division_name}}</p>
                    @endif
                </div>

                @if($type == 'update')
                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    <x-cancel2-button class="ml-4">
                        キャンセル
                    </x-cancel2-button>

                    @if($type == 'update')
                        <x-primary-button class="ml-4 bg-teal-700">
                            {{$button}}
                        </x-primary-button>
                    @elseif($type == 'destroy')
                        <x-primary-button class="ml-4 bg-red-700">
                            {{$button}}
                        </x-primary-button>
                    @endif
                </div>
            </form>

    </x-guest-layout>

</x-app-layout>