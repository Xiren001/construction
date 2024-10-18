<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('loggedIn'))
                <!-- Snackbar that shows only when logged in -->
                <div id="snackbar">
                <svg style="width: 24px; height: 24px; color: #10B981; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                    {{ __("You're logged in!") }}
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const snackbar = document.getElementById('snackbar');

            if (snackbar) {
                // Automatically hide the snackbar after 3 seconds
                setTimeout(function () {
                    snackbar.style.opacity = '0';
                    snackbar.style.transition = 'opacity 1s';
                    setTimeout(function () {
                        snackbar.remove();  // Remove from DOM after fading out
                    }, 1000);
                }, 3000);  // Display the snackbar for 3 seconds
            }
        });
    </script>
</x-app-layout>
