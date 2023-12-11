<div>
    @forelse (auth()->user()->pending_followers as $pending)
        <li class="flex flex-row w-full p-3 items-center text-sm">
            <div>
                <img src="{{ $pending->image }}" alt="{{ $pending->username }}"
                    class="w-8 h-8 mr-2 rounded-full border border-neutral-300">
            </div>

            <div class="flex flex-col grow">
                <div class="font-bold">
                    <a href="/{{ $pending->username }}">{{ $pending->username }}</a>
                </div>

                <div class="text-sm text-neutral-500">
                    {{ $pending->name }}
                </div>
            </div>

            @auth
                <div>
                    <button class="bg-blue-500 border border-blue-500 text-white px-2 py-1 rounded"
                        wire:click="confirm({{ $pending->id }})">{{ __('Confirm') }}</button>
                    <button class="border border-gray-500 px-2 py-1 rounded"
                        wire:click="delete({{ $pending->id }})">{{ __('Delete') }}</button>
                </div>
            @endauth
        </li>
    @empty
        <div class="text-center py-3">
            {{ __('No pending follow request.') }}
        </div>
    @endforelse
</div>
