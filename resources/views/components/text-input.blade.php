@props(['disabled' => false])

<input @disabled($disabled)
    {{ $attributes->merge([
        'class' => 'w-full rounded-2xl border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 dark:placeholder-gray-500'
    ]) }}>