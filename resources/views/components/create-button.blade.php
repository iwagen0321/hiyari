<a href="{{route('post.create')}}" {{ $attributes->merge(['class' => 'inline-flex items-center px-6 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xl text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</a>