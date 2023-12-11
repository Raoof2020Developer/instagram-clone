<div class="card">
    <!-- Do what you can, with what you have, where you are. - Theodore Roosevelt -->
    <div class="card-header">
        <img src="{{ $post->owner->image }}" alt="" class="w-9 h-9 mr-3 rounded-full">
    </div>

    <div class="card-body">
        <div class="max-h-[35rem] overflow-hidden">
            {{-- {{ dd() }} --}}
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->description }}"
                class="h-auto w-full object-cover">
        </div>

        <div class="flex flex-row p-3">
            <livewire:like :post="$post" />
            <a href="{{ route('posts.show', $post->slug) }}" class="grow">
                <i class="bx bx-comment text-3xl hover:text-gray-400 cursor-pointer mr-3"></i>
            </a>
        </div>

        <div class="p-3">
            <a href="{{ $post->owner->username }}" class="font-bold mr-1">{{ $post->owner->username }}</a>
            {{ $post->description }}
        </div>

        @if ($post->comments()->count() > 0)
            <a href="{{ route('posts.show', $post->slug) }}" class="p-3 font-bold text-sm text-gray-500">
                {{ __('View All ' . $post->comments()->count() . ' comments') }}
            </a>
        @endif
        <div class="p-3 uppercase text-gray-400 text-xs">
            {{ $post->created_at->diffForHumans() }}
        </div>
    </div>

    <div class="card-footer">
        <form action="{{ route('comments.store', $post->slug) }}" method="post">
            @csrf
            <div class="flex flex-row">
                <textarea name="body" id="comment_body" autocomplete="off"
                    class="grow border-none resize-none focus:ring-0 outline-0 bg-none max-h-60 h-5 p-0 overflow-y-hidden placeholder-gray-400"
                    placeholder="{{ __('Add a comment...') }}"></textarea>

                <button type="submit" class="bg-white border-none text-blue-500 ml-5">{{ __('POST') }}</button>
            </div>
        </form>
    </div>
</div>
