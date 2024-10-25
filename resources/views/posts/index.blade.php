<x-app-layout>
    <div class="flex flex-row max-w-3xl gap-8 mx-auto">
        {{-- Left Side  --}}
        <livewire:posts-list />

        {{-- Right Side  --}}
        <div class="hidden w-[60rem] lg:flex lg:flex-col pt-4">
            <div class="flex flex-row text-sm">
                <div class="mr-5">
                    <a href="/{{ auth()->user()->username }}">
                        <img src="{{ strpos(auth()->user()->image, 'https') !== false ? auth()->user()->image : asset('storage/' . auth()->user()->image) }}"
                            alt="{{ auth()->user()->username }}" class="h-12 w-12 rounded-full border border-gray-300">
                    </a>
                </div>

                <div class="flex flex-col">
                    <a href="/{{ auth()->user()->username }}" class="font-bold">{{ auth()->user()->username }}</a>
                    <div class="text-gray-500 text-sm">{{ auth()->user()->name }}</div>
                </div>

            </div>


            <div class="mr-5 mt-4">
                <h3 class="font-bold text-gray-500">{{ __('Suggestions for you:') }}</h3>

                <ul>
                    @foreach ($suggestedUsers as $suggestedUser)
                        <li class="flex flex-row my-5 text-sm justify-items-center">
                            <div class="mr-5">
                                <a href="/{{ $suggestedUser->username }}" class="font-bold">
                                    <img src="{{ strpos($suggestedUser->image, 'https') !== false ? $suggestedUser->image : asset('storage/' . $suggestedUser->image) }}"
                                        alt="{{ $suggestedUser->username }}"
                                        class="w-9 h-9 rounded-full border-gray-300">
                                </a>
                            </div>

                            <div class="flex flex-col grow">
                                <a href="/{{ $suggestedUser->username }}"
                                    class="font-bold">{{ $suggestedUser->username }}
                                    @if (auth()->user()->is_follower($suggestedUser))
                                        <span class="text-gray-500 text-xs">{{ __('Follower') }}</span>
                                    @endif
                                </a>
                                <div class="text-gray-500 text-sm">{{ $suggestedUser->name }}</div>

                            </div>

                            @if (auth()->user()->is_pending($suggestedUser))
                                <span class="text-gray-500 font-bold">{{ __('Pending') }}</span>
                            @else
                                {{-- <a href="{{ route('users.follow', $suggestedUser->username) }}"
                                    class="text-blue-500 font-bold">{{ __('Follow') }}</a> --}}
                                <livewire:follow-button :userId="$suggestedUser->id"
                                    classes="w-30 text-blue-500 text-sm font-bold px-3 text-center cursor-pointer" />
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
