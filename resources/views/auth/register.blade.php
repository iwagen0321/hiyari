<head>
    <title>アカウント登録</title>
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('アカウント登録') }}
        </h2>

        <x-message :message="session('message')"/>
    </x-slot>

    <x-guest-layout>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- role -->
            <div class="block font-medium text-sm text-gray-700">
                <input type="radio" name="role" id="role" value="0" checked>一般社員
                <input type="radio" name="role" id="role" value="1">管理職員
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <!-- familyName -->
            <div class="mt-4">
                <x-input-label for="family_name" :value="__('family_name')" />
                <x-text-input id="family_name" class="block mt-1 w-full" type="text" name="family_name" :value="old('family_name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('family_name')" class="mt-2" />
            </div>

            <!-- firstName -->
            <div class="mt-4">
                <x-input-label for="first_name" :value="__('first_name')" />
                <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>

            <!-- 社員番号 -->
            <div class="mt-4">
                <x-input-label for="employee_number" :value="__('employee_number')" />
                <x-text-input id="employee_number" class="block mt-1 w-full" type="text" name="employee_number" :value="old('employee_number')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('employee_number')" class="mt-2" />
            </div>

            <!-- 部署名 -->
            <div class="mt-4">
                <x-input-label for="division_name" :value="__('division_name')" />
                <x-text-input id="division_name" class="block mt-1 w-full" type="text" name="division_name" :value="old('division_name')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('division_name')" class="mt-2" />
            </div>

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

            <div class="flex items-center justify-end mt-4">
                <!-- <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a> -->
                
                <x-cancel2-button class="ml-4">
                    キャンセル
                </x-cancel2-button>
                <x-primary-button class="ml-4 bg-green-700">
                    　登録　
                </x-primary-button>
                

            </div>
        </form>
    </x-guest-layout>

</x-app-layout>