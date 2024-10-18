<button style="background-color: #0A3247;" {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full h-12 text-center items-center px-4 py-2 bg-gray-800 dark:bg-black border border-transparent rounded-md font-semibold text-xs text-white dark:text-white-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-gray-200 focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
