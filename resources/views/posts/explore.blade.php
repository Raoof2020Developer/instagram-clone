<x-app-layout>
    <div class="grid grid-cols-3 gap-1 md:gap-3 mt-8">
        @foreach ($posts as $post)
            <div>
                <a href="{{ route('posts.show', $post->slug) }}">
                    <img src="{{ asset('storage/' . $post->image) }}" alt=""
                        class="w-full object-cover aspect-square">
                </a>
            </div>
        @endforeach
    </div>

    <div class="mt-2 p-10">
        {{ $posts->links() }}
    </div>
</x-app-layout>
