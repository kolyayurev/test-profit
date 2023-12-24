@props(['options'=>[],'selected'])

<select
    {!! $attributes->merge(['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) !!}
    >
    {{ $slot }}
    @foreach ($options as $key => $val)
        <option @if (($attributes->get('multiple')) && ((in_array($key, old($attributes->get('name')) ?? [])) ||
                (is_array($selected) && empty(old($attributes->get('name'))) && in_array($key, $selected))) ||
                (old($attributes->get('name')) == $key) || ((empty(old($attributes->get('name')))) && ($key == $selected)))
                    selected @endif value="{{ $key }}">{{ $val }}
        </option>
    @endforeach
</select>
