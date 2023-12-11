<div class="inline-block">
    @if ($follow_state == 'Pending')
        <span class="{{ $classes }} bg-gray-400" style="cursor: default !important;">{{ __($follow_state) }}</span>
    @else
        <button wire:click="toggleFollow" class="{{ $classes }}">
            <span>{{ __($follow_state) }}</span>
        </button>
    @endif
</div>
