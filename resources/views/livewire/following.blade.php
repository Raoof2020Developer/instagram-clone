<div>
    <li class="flex flex-col md:flex-row text-center">
        <div class="md:ltr:mr-1 md:rtl:ml-1 font-bold md:font-normal">
            {{ $this->count }}
        </div>
        <button
            onclick="Livewire.dispatch('openModal', { component: 'following-modal', arguments: { userId: {{ $userId }} }})"
            class='text-neutral-500 ml-1 md:text-black'>
            {{ $this->count > 1 ? __(' followings') : __(' following') }}</button>
    </li>
</div>
