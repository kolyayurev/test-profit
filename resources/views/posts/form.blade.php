<x-app-layout>
    @php($isEdit = !is_null($post?->getKey()))
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __( $isEdit ? 'Edit post' : 'Add new post' ) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('posts.' .  ($isEdit ? 'update' : 'store'), $post->id) }}">
                        @csrf
                        @if($isEdit)
                            @method('put')
                        @endif

                        <div class="mb-5">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $post->title)" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="mb-5">
                            <x-input-label for="slug" :value="__('Slug')" />
                            <x-text-input id="slug" class="block mt-1 w-full" type="text" name="slug" :value="old('slug', $post->slug)" />
                            <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                        </div>

                        <div class="mb-5">
                            <x-input-label for="excerpt" :value="__('Excerpt')" />
                            <x-text-input id="excerpt" class="block mt-1 w-full" type="text" name="excerpt" :value="old('excerpt', $post->excerpt)" />
                            <x-input-error :messages="$errors->get('excerpt')" class="mt-2" />
                        </div>

                        <div class="mb-5">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-textarea id="description" class="block mt-1 w-full" type="text" name="description" rows="10">
                                {{ old('description', $post->description) }}
                            </x-textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>


                        <div class="mt-5">
                            <x-primary-button>
                                {{ __($isEdit ? 'Update': 'Create') }}
                            </x-primary-button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
