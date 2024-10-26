<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ground Work</title>
    <link rel="icon" href="{{ asset('assets/image/logo.png') }}" type="image/x-icon">
    <!-- FullCalendar Styles -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css' rel='stylesheet' />

    <!-- Fonts and other resources -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- FullCalendar and Google Calendar Plugin Scripts -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.15/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.15/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/google-calendar@6.1.15/index.global.min.js'></script>
    <!-- <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.15/index.global.min.js'></script> -->
    <style>
        #snackbar,
        #errorSnackbar {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 10px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            display: flex;
            flex-direction: row;
        }

        #snackbar.show,
        #errorSnackbar.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }

            to {
                bottom: 30px;
                opacity: 1;
            }
        }

        @keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }

            to {
                bottom: 30px;
                opacity: 1;
            }
        }

        @-webkit-keyframes fadeout {
            from {
                bottom: 30px;
                opacity: 1;
            }

            to {
                bottom: 0;
                opacity: 0;
            }
        }

        @keyframes fadeout {
            from {
                bottom: 30px;
                opacity: 1;
            }

            to {
                bottom: 0;
                opacity: 0;
            }
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .table-striped tbody tr:nth-child(even) {
            background-color: #ffffff;
        }

        .table-striped tbody tr:hover {
            background-color: #f1f1f1;
        }
        
        .create-con{
            width: 50% !important;
        }

        .create-modal{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }


    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen">
        @include('layouts.navigation')

        @isset($header)
        <header class="bg-white dark:bg-white-800  h-screen">
            <div class="max-w-7xl h-full mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>

            {{-- Success message --}}
            @if(session('success'))
            <div id="snackbar"><svg style="width: 24px; height: 24px; color: #10B981; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>{{ session('success') }}</div>
            <script>
                // Function to show the snackbar when the page loads
                window.onload = function() {
                    var x = document.getElementById("snackbar");
                    x.className = "show";
                    setTimeout(function() {
                        x.className = x.className.replace("show", "");
                    }, 3000);
                };
            </script>
             @endif

            @if(session('error'))
            <div id="snackbar"><svg style="width: 24px; height: 24px; color: #DC2626; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6M9 16h6M9 8h6"></path>
                </svg>{{ session('error') }}</div>
            <script>
                // Function to show the snackbar when the page loads
                window.onload = function() {
                    var x = document.getElementById("snackbar");
                    x.className = "show";
                    setTimeout(function() {
                        x.className = x.className.replace("show", "");
                    }, 3000);
                };
            </script>
            @endif

            {{-- Error message --}}
            @if ($errors->any())
            <div id="errorSnackbar" class="bg-red-100 text-red-800 p-4 rounded-lg mb-4">
                <svg style="width: 24px; height: 24px; color: #DC2626; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6M9 16h6M9 8h6"></path>
                </svg>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

            <script>
                // Function to show the error snackbar when the page loads
                window.onload = function() {
                    var x = document.getElementById("errorSnackbar");
                    x.className += " show"; // Add the "show" class to the snackbar
                    setTimeout(function() {
                        x.className = x.className.replace("show", "");
                    }, 3000); // Remove the "show" class after 3 seconds
                };
            </script>
            @endif

        </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
