<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-end">
                        @can('create',\App\Models\Post::class)
                            <x-secondary-button tag="a" :href="route('posts.create')">
                                {{ __('New') }}
                            </x-secondary-button>
                        @endcan
                    </div>
                    <table class="table-auto w-full">
                        <thead>
                        <tr class="border-b text-left">
                            <th class="p-1">{{ __('Id') }}</th>
                            <th class="p-1">{{ __('Title') }}</th>
                            <th class="p-1">{{ __('User') }}</th>
                            <th class="p-1">{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($posts->count())
                            @foreach($posts as $post)
                                <tr class="border-b border-slate-100 dark:border-slate-700 text-left">
                                    <td class="p-2">{{ $post->id }}</td>
                                    <td class="p-2">{{ $post->title }}</td>
                                    <td class="p-2">{{ $post?->user->name }}</td>
                                    <td class="p-2 flex">
                                        @can('update',$post)
                                        <x-secondary-button tag="a" :href="route('posts.edit',$post->id)">
                                            {{ __('Edit') }}
                                        </x-secondary-button>
                                        @endcan
                                        @can('delete',$post)
                                        <form action="{{ route('posts.destroy',$post->id) }}" method="POST" class="ml-1">
                                            @csrf
                                            @method('delete')
                                            <x-danger-button type="submit" :href="route('posts.destroy',$post->id)">
                                                {{ __('Edit') }}
                                            </x-danger-button>
                                        </form>
                                        @endcan

                                    </td>
                                </tr>
                            @endforeach
                        @else
                        <tr class="text-center">
                            <td colspan="4" class="p-5 text-xl">{{ __('No posts') }}</td>
                        </tr>
                        </tbody>
                        @endif
                    </table>
                    <div class="mt-5">
                        {!! $posts->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
