<x-app-layout>
    <div class="flex flex-row max-w-3xl gap-8 mx-auto">
        {{-- Left Side  --}}
        <div class="w-[30rem] mx-auto lg:w-[95rem]">
            @forelse($posts as $post)
                <x-post :post="$post" />
            @empty
                <div class="max-w-2xl gap-8 mx-auto">
                    {{ __('Start Following Your Friends and Enjoy.') }}
                </div>
            @endforelse
        </div>

        {{-- Right Side  --}}
        <div class="hidden w-[60rem] lg:flex lg:flex-col pt-4">
            <div class="flex flex-row text-sm">
                <div class="mr-5">
                    <a href="/{{ auth()->user()->username }}">
                        <img src="{{ auth()->user()->image }}" alt="{{ auth()->user()->username }}"
                            class="h-12 w-12 rounded-full border border-gray-300">
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
                                    <img src="{{ $suggestedUser->image }}" alt="{{ $suggestedUser->username }}"
                                        class="w-9 h-9 rounded-full border-gray-300">
                                </a>
                            </div>

                            <div class="flex flex-col grow">
                                <a href="/{{ $suggestedUser->username }}"
                                    class="font-bold">{{ $suggestedUser->username }} </a>
                                <div class="text-gray-500 text-sm">{{ $suggestedUser->name }}</div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
