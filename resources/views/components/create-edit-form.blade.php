<input type="file" name="image" id="file_input"
    class="border border-gray-200 bg-gray-50 w-full block focus:outline-none rounded-xl">

<p class="mt-2 text-sm text-gray-500 dark:text-gray-300" id="input_file_help">PNG, JPG or GIF.</p>


<textarea name="description" placeholder="{{ __('Write a description') }}" rows="5"
    class="mt-10 w-full border border-gray-200 rounded-xl">{{ $post->description ?? '' }}</textarea>
