<x-app-layout>
    <div class="h-screen md:flex md:flex-row">
        {{-- Left Side --}}
        <div class="h-full md:w-7/12 bg-black flex items-center">
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->description }}"
                class="max-h-screen object-cover mx-auto">
        </div>

        {{-- Right Side --}}
        <div class="flex w-full flex-col bg-white md:w-5/12">

            {{-- Top  --}}
            <div class="border-b-2">
                <div class="flex items-center p-5">
                    <img src="{{ strpos($post->owner->image, 'https') !== false ? $post->owner->image : asset('storage/' . $post->owner->image) }}"
                        alt="{{ $post->owner->username }}" class="mr-5 h-10 w-10 rounded-full">
                    <div class="grow">
                        <a href="/{{ $post->owner->username }}" class="font-bold">{{ $post->owner->username }}</a>
                    </div>
                    @can('update', $post)
                        <a href="{{ route('posts.edit', $post->slug) }}">
                            <i class='bx bxs-edit text-xl'></i>
                        </a>
                        <form action="{{ route('posts.destroy', $post->slug) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">
                                <i class='bx bxs-x-square ml-2 text-xl text-red-600'></i>
                            </button>
                        </form>
                    @endcan
                    @cannot('update', $post)
                        @if (auth()->user()->is_following($post->owner))
                            <a href="{{ route('users.unfollow', $post->owner->username) }}"
                                class="w-30 text-blue-500 text-sm font-bold px-3 text-center">{{ __('Unfollow') }}</a>
                        @else
                            <a href="{{ route('users.follow', $post->owner->username) }}"
                                class="w-30 text-blue-500 text-sm font-bold px-3 text-center">{{ __('Follow') }}</a>
                        @endif
                    @endcannot

                </div>
            </div>

            {{-- Middle --}}
            <div class="flex flex-col grow overflow-y-auto">
                <div class="flex items-start p-5">
                    <img src="{{ strpos($post->owner->image, 'https') !== false ? $post->owner->image : asset('storage/' . $post->owner->image) }}"
                        class="ltr:mr-5 rtl:ml-5 h-10 w-10 rounded-full">
                    <div>
                        <a href="{{ $post->owner->username }}" class="font-bold">{{ $post->owner->username }}</a>
                        {{ $post->description }}
                    </div>
                </div>

                {{-- Comments --}}
                <div class="grow">
                    @foreach ($post->comments as $comment)
                        <div class="flex items-start px-5 py-2">
                            <img src="{{ strpos($comment->owner->image, 'https') !== false ? $comment->owner->image : asset('storage/' . $comment->owner->image) }}"
                                alt="" class="h-100 ltr:mr-5 rtl:ml-5 w-10 rounded-full">
                            <div class="flex flex-col">
                                <div>
                                    <a href="/{{ $comment->owner->username }}"
                                        class="font-bold">{{ $comment->owner->username }}</a>
                                    {{ $comment->body }}
                                </div>
                                <div class="mt-1 text-sm font-bold text-gray-400">
                                    {{ $comment->created_at->diffForHumans(null, true, true) }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Likes and Actions --}}

                {{-- <div class="border-t p-3 flex flex-row">
                    <livewire:like :post="$post" />
                    <a class="grow" onclick="document.getElementById('comment_body').focus()"><i
                            class="bx bx-comment text-3xl hover:text-gray-400 cursor-pointer ltr:mr-3 rtl:ml-3"></i></a>


                </div>
                <livewire:likedby :post="$post" /> --}}

            </div>
            <div class="border-t p-5">
                <form action="{{ route('comments.store', $post->slug) }}" method="POST">
                    @csrf
                    <div class="flex flex-row">
                        <textarea name="body" id="comment_body" placeholder="{{ __('Add a comment...') }}"
                            class="h-5 grow resize-none overflow-hidden border-none bg-none p-0 placeholder-gray-400 outline-0 focus:ring-0"></textarea>
                        <button type="submit"
                            class="ltr:ml-5 rtl:mr-5 border-none bg-white text-blue-500">{{ __('Post') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
