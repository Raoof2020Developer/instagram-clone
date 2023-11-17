<x-app-layout>

    <div class="card p-10">
        {{-- Title  --}}
        <h1 class="text-3xl mb-10">{{ __('Edit a new post') }}</h1>

        {{-- Errors  --}}
        <div class="flex flex-col justify-center items-center w-full">
            @if ($errors->any())
                <div class="w-full bg-red-50 text-red-700 p-5 mb-5 rounded-xl">
                    <ul class="list-disc pl-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        {{-- Form --}}
        <form action="{{ route('posts.update', $post->slug) }}" method="post" enctype="multipart/form-data" class="w-full">
            @csrf
            @method('PATCH')
            <x-create-edit-form :post="$post" />

            <x-primary-button class="mt-4">{{ __('Update Your Post') }}</x-primary-button>

        </form>
    </div>
</x-app-layout>
