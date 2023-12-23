<x-app-layout>
    @php($isEdit = !is_null($comment?->getKey()))
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __( $isEdit ? 'Edit comment' : 'Add new comment' ) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('posts.' .  ($isEdit ? 'update' : 'store'), $comment->id) }}">
                        @csrf
                        @if($isEdit)
                            @method('put')
                        @endif

                        <div class="mb-5">
                            <x-input-label for="body" :value="__('Body')" />
                            <x-textarea id="body" class="block mt-1 w-full" type="text" name="body" rows="5">
                                {{ old('body', $comment->body) }}
                            </x-textarea>
                            <x-input-error :messages="$errors->get('body')" class="mt-2" />
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
