<head>
    <title>{{$title}}</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/reset.css')  }}" >
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if($type == 'store')
                {{ Breadcrumbs::render('create', $title) }}
            @else($type == 'update')
                {{ Breadcrumbs::render('edit', $post, $title) }}
            @endif
        </h2>

        <x-message :message="session('message')"/>

    </x-slot>

    <div class="flex justify-center">
        @if($type == "store")
            <form class="form" method="post" action="{{route('post.'.$type)}}" enctype="multipart/form-data">
        @elseif($type == "update")
            <form class="form" method="post" action="{{route('post.'.$type,$post)}}" enctype="multipart/form-data">
            @method('patch')
        @endif
            @csrf

            <div>

                <div class="form-buttons">
                    <div class="buttons">
                        <x-cancel-button>キャンセル</x-cancel-button>
                    </div>
                    <div class="buttons">
                        <x-primary-button class="bg-green-700">{{$button}}</x-primary-button>
                    </div>
                </div>


                <div class="pt-5">
                    <label class="text-lg font-semibold" for="location">発生場所</label><br>
                    <input type="text" placeholder="例：第三工場１階廊下" name="location" id="location" class="location-text" 
                    {{ $type != "store" ? "value=".$post->location.""  : "value=".old('location').""}}>
                </div>
                <div class="text-lg text-red-600 space-y-1">
                    @if($errors->has('location'))
			            @foreach($errors->get('location') as $message)
				            {{ $message }}
			            @endforeach
		            @endif
                </div>

                <div id="res1" class="pt-5">
                <div class="pr-10 radio">
                        <input type="radio" name="response" id="response" value="1" @if($type == "store") checked @endif>対応求ム
                    </div>
                    <div class="radio">
                        <input type="radio" name="response" id="complete" value="0" @if($type == "update") checked @endif>対応済
                    </div>
                </div>
                <div class="text-lg text-red-600 space-y-1">
                    @if($errors->has('response'))
			            @foreach($errors->get('response') as $message)
				            {{ $message }}
			            @endforeach
		            @endif
                </div>

                <div class="pt-5">
                    <label class="text-lg font-semibold" for="body">内容</label><br>
                    <textarea class="plan" name="body" id="body">{{ $type != "store" ? "".$post->body.""  : "".old('body').""}}</textarea>
                </div>
                <div class="text-lg text-red-600 space-y-1">
                    @if($errors->has('body'))
			            @foreach($errors->get('body') as $message)
				            {{ $message }}
			            @endforeach
		            @endif
                </div>


                <div class="pt-5">
                    <label class="text-lg font-semibold" for="before_image">対応前の画像(任意)</label><br>
                    <input type="file" id="before_image" name="before_image">
                </div>
                

                <div id="res2" class="pt-5">
                    <label class="text-lg font-semibold" for="counterplan">対応策</label><br>
                    <textarea class="plan" name="counterplan" id="counterplan">{{ $type != "store" ? "".$post->counterplan.""  : "".old('counterplan').""}}</textarea>
                </div>
                <div class="text-lg text-red-600 space-y-1">
                    @if($errors->has('counterplan'))
			            @foreach($errors->get('counterplan') as $message)
				            {{ $message }}
			            @endforeach
		            @endif
                </div>


                <div id="res2" class="pt-5">
                    <label class="text-lg font-semibold" for="after_image">対応後の画像(任意)</label><br>
                    <input type="file" id="after_image" name="after_image">
                </div>
                
            </div>

        </form>

    </div>

</x-app-layout>