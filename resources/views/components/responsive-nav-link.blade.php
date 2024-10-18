@props(['active'])

@php
$classes = ($active ?? false)
            ? 'w-full ps-3 pe-4 py-2 border-l-4 flex items-center justify-center  border-indigo-400 dark:border-indigo-600 text-center font-medium text-white dark:text-white bg-indigo-50 dark:bg-indigo-900/50 focus:outline-none focus:text-indigo-800 dark:focus:text-indigo-200 focus:bg-indigo-100 dark:focus:bg-indigo-900 focus:border-indigo-700 dark:focus:border-indigo-300 transition duration-150 ease-in-out'
            : 'w-full ps-3 pe-4 py-2 border-l-4 flex items-center justify-center border-transparent text-center font-medium text-white dark:text-white hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600 focus:outline-none focus:text-gray-800 dark:focus:text-gray-200 focus:bg-gray-50 dark:focus:bg-gray-700 focus:border-gray-300 dark:focus:border-gray-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
