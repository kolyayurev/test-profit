<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Comments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-end">
                        @can('create',\App\Models\Comment::class)
                            <x-secondary-button tag="a" :href="route('comments.create')">
                                {{ __('New') }}
                            </x-secondary-button>
                        @endcan
                    </div>
                    <table class="table-auto w-full">
                        <thead>
                        <tr class="border-b text-left">
                            <th class="p-1">{{ __('Id') }}</th>
                            <th class="p-1">{{ __('Body') }}</th>
                            <th class="p-1">{{ __('User') }}</th>
                            <th class="p-1">{{ __('Post') }}</th>
                            <th class="p-1">{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($comments->count())
                            @foreach($comments as $comment)
                                <tr class="border-b border-slate-100 dark:border-slate-700 text-left">
                                    <td class="p-2">{{ $comment->id }}</td>
                                    <td class="p-2">{{ $comment->body }}</td>
                                    <td class="p-2">{{ $comment?->user->name }}</td>
                                    <td class="p-2"><a href="{{ route('posts.edit',$comment?->post->id) }}" class="underline">Post {{ $comment?->post->id }}</a></td>
                                    <td class="p-2 flex">
                                        @can('update',$comment)
                                        <x-secondary-button tag="a" :href="route('comments.edit',$comment->id)">
                                            {{ __('Edit') }}
                                        </x-secondary-button>
                                        @endcan
                                        @can('delete',$comment)
                                        <form action="{{ route('comments.destroy',$comment->id) }}" method="POST" class="ml-1">
                                            @csrf
                                            @method('delete')
                                            <x-danger-button type="submit" >
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
                        {!! $comments->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
