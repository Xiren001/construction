<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-black-200 leading-tight">
            {{ __('Client Records') }}
        </h2>
    </x-slot>
    <div class="container-fluid mx-auto py-8 h-screen" style="padding: 0 13%;">
        <div class="container mx-auto mt-6">

            {{-- Search Input --}}
            <div class="flex justify-between items-center mb-6 mt-6 gap-2">


                {{-- Button to open the modal --}}
                <button class="bg-blue-500 hover:bg-blue-700 text-white flex row font-semibold py-2 px-4 border border-gray-400 rounded shadow" id="openClientModal" style="background-color: #EBBA5A;">
                    <svg fill="#ffffff" width="35px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path wid d="M2,21h8a1,1,0,0,0,0-2H3.071A7.011,7.011,0,0,1,10,13a5.044,5.044,0,1,0-3.377-1.337A9.01,9.01,0,0,0,1,20,1,1,0,0,0,2,21ZM10,5A3,3,0,1,1,7,8,3,3,0,0,1,10,5ZM23,16a1,1,0,0,1-1,1H19v3a1,1,0,0,1-2,0V17H14a1,1,0,0,1,0-2h3V12a1,1,0,0,1,2,0v3h3A1,1,0,0,1,23,16Z" />
                    </svg>
                    Add
                </button>

                <form action="{{ route('client.index') }}" method="GET" class="flex" style="gap:5px;">
                    <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                        class="form-input rounded-md border-gray-300" />
                </form>

            </div>

            <div class="flex flex-row gap-6">
                {{-- List of client --}}
                <div class="overflow-x-auto w-full h-screen">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <a href="{{ route('client.index', ['sort_by' => 'name', 'sort_direction' => request('sort_direction') === 'asc' && request('sort_by') === 'name' ? 'desc' : 'asc']) }}">
                                        Name
                                        @if(request('sort_by') === 'name')
                                        ({{ request('sort_direction') === 'asc' ? '↑' : '↓' }})
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('client.index', ['sort_by' => 'email', 'sort_direction' => request('sort_direction') === 'asc' && request('sort_by') === 'email' ? 'desc' : 'asc']) }}">
                                        Email
                                        @if(request('sort_by') === 'email')
                                        ({{ request('sort_direction') === 'asc' ? '↑' : '↓' }})
                                        @endif
                                    </a>
                                </th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($clients as $client)
                            <tr>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ $client->phone }}</td>
                                <td style=" width:fit-content; display:flex; flex-direction:row; align-items:center; justify-content:flex-end; padding:1rem 2rem; gap:1rem;">
                                    {{-- Read Button --}}
                                    <button class="bg-gray-600 text-black py-1 px-1 rounded-md hover:bg-gray-100" id="openReadClientModal" data-client-id="{{ $client->id }}"
                                        onclick="openReadClientModal( {{ $client->id }}, '{{ $client->name }}', '{{ $client->email }}', '{{ $client->phone }}', '{{ $client->address_home }}', {{ $client->services->toJson() }} )">
                                        <svg fill="#000000" width="25px" height="25px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.6">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <g id="read">
                                                    <g>
                                                        <path d="M12,18.883a10.8,10.8,0,0,1-9.675-5.728,2.6,2.6,0,0,1,0-2.31A10.8,10.8,0,0,1,12,5.117a10.8,10.8,0,0,1,9.675,5.728h0a2.6,2.6,0,0,1,0,2.31A10.8,10.8,0,0,1,12,18.883ZM12,6.117a9.787,9.787,0,0,0-8.78,5.176,1.586,1.586,0,0,0,0,1.415A9.788,9.788,0,0,0,12,17.883a9.787,9.787,0,0,0,8.78-5.176,1.584,1.584,0,0,0,0-1.414h0A9.787,9.787,0,0,0,12,6.117Z"></path>
                                                        <path d="M12,16.049A4.049,4.049,0,1,1,16.049,12,4.054,4.054,0,0,1,12,16.049Zm0-7.1A3.049,3.049,0,1,0,15.049,12,3.052,3.052,0,0,0,12,8.951Z"></path>
                                                        <circle cx="12" cy="12" r="2.028"></circle>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </button>

                                    {{-- Edit Button --}}
                                    <button class="bg-gray-600 text-black py-1 px-1 rounded-md hover:bg-gray-100" id="openEditClientModal" onclick="openEditClientModal( {{ $client->id }}, '{{ $client->name }}', '{{ $client->email }}', '{{ $client->phone }}', '{{ $client->address_home }}' )">
                                        <svg width="20px" height="20px" viewBox="0 -0.5 21 21" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.5880000000000001"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <g id="Page-1" stroke-width="0.00021000000000000004" fill="none" fill-rule="evenodd">
                                                    <g id="Dribbble-Light-Preview" transform="translate(-339.000000, -800.000000)" fill="#000000">
                                                        <g id="icons" transform="translate(56.000000, 160.000000)">
                                                            <path d="M286.15,654 C285.5704,654 285.1,653.552 285.1,653 L285.1,647 C285.1,646.448 285.5704,646 286.15,646 C286.7296,646 287.2,645.552 287.2,645 C287.2,644.448 286.7296,644 286.15,644 L285.1,644 C283.93975,644 283,644.895 283,646 L283,654 C283,655.105 283.93975,656 285.1,656 L286.15,656 C286.7296,656 287.2,655.552 287.2,655 C287.2,654.448 286.7296,654 286.15,654 M301.9,644 L294.55,644 C293.9704,644 293.5,644.448 293.5,645 C293.5,645.552 293.9704,646 294.55,646 L300.85,646 C301.4296,646 301.9,646.448 301.9,647 L301.9,653 C301.9,653.552 301.4296,654 300.85,654 L294.55,654 C293.9704,654 293.5,654.448 293.5,655 C293.5,655.552 293.9704,656 294.55,656 L301.9,656 C303.06025,656 304,655.105 304,654 L304,646 C304,644.895 303.06025,644 301.9,644 M293.5,659 C293.5,659.552 293.0296,660 292.45,660 L288.25,660 C287.6704,660 287.2,659.552 287.2,659 C287.2,658.448 287.6704,658 288.25,658 L289.3,658 L289.3,642 L288.25,642 C287.6704,642 287.2,641.552 287.2,641 C287.2,640.448 287.6704,640 288.25,640 L292.45,640 C293.0296,640 293.5,640.448 293.5,641 C293.5,641.552 293.0296,642 292.45,642 L291.4,642 L291.4,658 L292.45,658 C293.0296,658 293.5,658.448 293.5,659" id="edit_text_bar-[#1373]"> </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </button>

                                    <form action="{{ route('billing.store') }}" method="POST" style="width: fit-content; padding:0;">
                                        @csrf
                                        <input type="hidden" name="name" value="{{ $client->name }}">
                                        <input type="hidden" name="email" value="{{ $client->email }}">
                                        <button
                                            class="bg-gray-600 text-black py-1 px-1 rounded-md hover:bg-gray-100"
                                            type="submit">
                                            <svg version="1.1" id="designs" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25px" height="25px" viewBox="0 0 32.00 32.00" xml:space="preserve" fill="#000000" stroke="#000000" stroke-width="0.48">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.192"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <style type="text/css">
                                                        .sketchy_een {
                                                            fill: #111918;
                                                        }
                                                    </style>
                                                    <path class="sketchy_een" d="M28.918,15.952c-0.051-0.378-0.272-0.697-0.592-0.902c-0.212-0.136-0.475-0.137-0.697-0.042 c-0.003-0.816,0-1.632-0.021-2.447c-0.021-0.915,0.029-1.829,0.063-2.742c0.012-0.301-0.181-0.561-0.44-0.689 c-0.023-0.344-0.047-0.688-0.077-1.031c-0.019-0.205-0.036-0.41-0.065-0.613c-0.006-0.04-0.011-0.08-0.017-0.12 c-0.015-0.106-0.063-0.289-0.123-0.37c-0.087-0.114-0.161-0.241-0.296-0.306c-0.099-0.047-0.194-0.093-0.302-0.108 c-0.105-0.016-0.213-0.016-0.319-0.028c-0.023-0.337-0.041-0.674-0.056-1.011c0.038-0.087,0.059-0.181,0.059-0.279 c0-0.395-0.329-0.718-0.72-0.722c-0.805-0.006-1.61,0.006-2.415-0.028c-0.724-0.03-1.447-0.072-2.174-0.087 c-1.527-0.028-3.057-0.017-4.586-0.028c-1.5-0.01-2.998-0.04-4.501-0.044c-0.733-0.001-1.466-0.015-2.198-0.015 c-0.706,0-1.413,0.013-2.118,0.062C6.545,4.457,5.757,4.635,5.041,4.947C4.342,5.249,3.714,5.851,3.497,6.593 c-0.059,0.203-0.089,0.41-0.116,0.621C3.358,7.385,3.338,7.56,3.358,7.732c0.025,0.215,0.06,0.423,0.117,0.629 C3.24,8.48,3.075,8.72,3.072,8.997c-0.01,0.798-0.006,1.595-0.021,2.391c-0.013,0.724-0.03,1.447-0.038,2.169 c-0.013,1.462-0.021,2.922,0,4.385c0.015,1.016,0.038,2.032,0.042,3.048c0.006,1.02,0.019,2.041-0.004,3.063 c-0.003,0.127,0.042,0.241,0.104,0.345c0.151,0.39,0.309,0.782,0.514,1.146c0.084,0.148,0.19,0.285,0.292,0.422 c0.095,0.125,0.192,0.249,0.289,0.372c0.148,0.188,0.37,0.336,0.568,0.463c0.442,0.289,0.957,0.473,1.476,0.564 c0.45,0.078,0.904,0.154,1.36,0.182c0.828,0.049,1.66,0.055,2.491,0.07c0.79,0.013,1.58,0.028,2.368,0.027 c0.805,0,1.608-0.009,2.412-0.004c0.807,0.008,1.612,0.032,2.419,0.015c0.832-0.015,1.662-0.049,2.493-0.061 c0.799-0.013,1.603-0.009,2.402-0.009c0.763,0,1.527,0,2.288-0.01c0.357-0.004,0.714,0,1.073,0.004 c0.376,0.004,0.752,0.008,1.13,0.002c0.257-0.003,0.481-0.131,0.633-0.319c0.193-0.138,0.33-0.351,0.325-0.6 c-0.017-0.86-0.008-1.72-0.017-2.581c-0.013-0.988,0.002-1.974,0.019-2.961c0.237-0.036,0.449-0.105,0.646-0.27 c0.439-0.368,0.543-0.999,0.589-1.538c0.029-0.334,0.029-0.67,0.042-1.006c0.021-0.513,0.046-1.031,0.028-1.546 C28.985,16.49,28.954,16.22,28.918,15.952z M7.703,8.835C7.706,8.762,7.71,8.688,7.694,8.613C7.69,8.594,7.687,8.574,7.683,8.555 c-0.02-0.306-0.01-0.614-0.007-0.922c1.463,0.042,2.927,0.043,4.392,0.05c0.754,0.004,1.508,0.023,2.262,0.042 c0.699,0.019,1.396,0.07,2.095,0.093c0.727,0.025,1.456,0.036,2.186,0.051c0.729,0.015,1.46,0.03,2.189,0.036 c0.742,0.006,1.485,0.013,2.226,0.015c0.653,0.002,1.307,0.03,1.96,0.034c0.242,0.001,0.483,0.01,0.723,0.028 c0.04,0.353,0.066,0.707,0.077,1.063c-0.389,0.008-0.779,0.004-1.166,0c-0.727-0.01-1.455-0.032-2.182-0.036 c-1.46-0.008-2.917-0.057-4.377-0.068c-1.553-0.011-3.105,0.002-4.658-0.053c-0.999-0.034-2-0.032-2.998-0.03 c-0.534,0-1.067,0.002-1.599-0.004C8.438,8.849,8.07,8.844,7.703,8.835z M27.418,19.574L27.418,19.574 c0.001-0.001,0.003-0.003,0.005-0.005C27.422,19.571,27.42,19.573,27.418,19.574z M27.224,16.425 c0.052,0.004,0.103,0.001,0.152-0.007c0.03,0.439,0.025,0.879,0.017,1.32c-0.004,0.279-0.009,0.558-0.015,0.839 c-0.003,0.273,0.001,0.546-0.024,0.817c-0.012,0.063-0.026,0.125-0.043,0.187c-0.277,0.014-0.557,0.005-0.833-0.002 c-0.336-0.008-0.672-0.011-1.008-0.011c-0.745,0-1.493,0.002-2.232-0.082c-0.225-0.04-0.443-0.097-0.657-0.176 c-0.215-0.102-0.412-0.22-0.603-0.358c-0.072-0.063-0.141-0.128-0.207-0.197c-0.04-0.062-0.075-0.125-0.109-0.19 c-0.035-0.094-0.067-0.189-0.093-0.288c-0.016-0.223-0.009-0.441,0.015-0.663c0.04-0.238,0.089-0.474,0.171-0.702 c0.027-0.053,0.056-0.103,0.087-0.152c0.038-0.038,0.076-0.075,0.116-0.109c0.076-0.047,0.154-0.09,0.235-0.13 c0.197-0.071,0.397-0.125,0.605-0.162c0.325-0.033,0.649-0.04,0.976-0.048c0.349-0.01,0.699-0.023,1.048-0.023 C25.624,16.284,26.427,16.364,27.224,16.425z M4.895,7.3c0.023-0.124,0.051-0.245,0.091-0.364C5.014,6.88,5.045,6.827,5.078,6.775 c0.087-0.098,0.18-0.19,0.279-0.276c0.127-0.087,0.259-0.159,0.399-0.226C6.231,6.092,6.73,5.979,7.23,5.903 C7.913,5.83,8.593,5.797,9.279,5.792c0.725-0.004,1.451-0.011,2.176-0.013c0.676,0,1.352,0.004,2.03,0.008 c0.811,0.004,1.624,0.009,2.436,0.004c1.523-0.009,3.046-0.013,4.569,0.017c0.729,0.015,1.456,0.03,2.186,0.078 c0.601,0.042,1.203,0.056,1.805,0.072c0.014,0.177,0.026,0.355,0.046,0.533c-0.067,0-0.134-0.002-0.201-0.001 c-1.424,0.009-2.848,0.03-4.273,0.009c-0.754-0.009-1.508-0.025-2.26-0.049c-0.712-0.021-1.422-0.027-2.133-0.055 c-0.727-0.029-1.453-0.059-2.18-0.068c-0.727-0.011-1.455-0.01-2.182-0.019c-1.356-0.021-2.712-0.07-4.066-0.127 c-0.009,0-0.018-0.001-0.027-0.001c-0.35,0-0.631,0.296-0.678,0.631c-0.211,0.135-0.361,0.359-0.36,0.623 c0.002,0.44,0.01,0.883,0.066,1.321C6.203,8.749,6.171,8.75,6.139,8.746C5.907,8.71,5.677,8.671,5.454,8.597 C5.382,8.56,5.314,8.519,5.246,8.473C5.21,8.441,5.177,8.408,5.145,8.372C5.091,8.285,5.046,8.196,5.004,8.104 C4.954,7.972,4.915,7.84,4.886,7.702C4.877,7.567,4.882,7.435,4.895,7.3z M24.46,25.97c-0.777,0.019-1.555,0.017-2.332,0.034 c-1.662,0.032-3.323,0.089-4.987,0.101c-0.771,0.004-1.544,0.021-2.315,0.015c-0.82-0.004-1.639-0.015-2.457-0.017 c-0.773-0.002-1.546,0.008-2.319,0.011c-0.832,0.002-1.669,0.006-2.497-0.076c-0.066-0.007-0.132-0.013-0.198-0.02 c-0.451-0.064-0.905-0.144-1.331-0.302c-0.17-0.084-0.334-0.177-0.49-0.284c-0.108-0.095-0.203-0.198-0.294-0.308 c-0.08-0.106-0.158-0.215-0.231-0.328c-0.079-0.126-0.141-0.265-0.201-0.402c-0.069-0.17-0.135-0.342-0.2-0.515 c-0.039-0.103-0.087-0.194-0.148-0.275c-0.01-1.288-0.01-2.575-0.027-3.861c-0.011-0.714-0.025-1.43-0.034-2.144 c-0.011-0.733-0.002-1.468-0.004-2.201C4.395,14.349,4.393,13.3,4.42,12.25c0.02-0.816,0.045-1.631,0.067-2.447 c0.048,0.03,0.095,0.063,0.143,0.09c0.399,0.22,0.845,0.275,1.289,0.329c0.372,0.046,0.746,0.066,1.122,0.08 c0.746,0.027,1.495,0.017,2.243,0.017c0.788,0,1.574-0.009,2.362-0.013c0.775-0.006,1.546,0.03,2.32,0.055 c0.746,0.023,1.493,0.023,2.241,0.023c0.775-0.002,1.551-0.008,2.326-0.006c0.76,0.002,1.519,0.047,2.277,0.093 c1.424,0.084,2.854,0.089,4.28,0.106c0.337,0.004,0.679,0,1.02-0.014c-0.021,1.427-0.002,2.855,0.004,4.282 c-0.467-0.022-0.934-0.055-1.402-0.06c-0.359-0.004-0.718-0.015-1.075-0.021c-0.036-0.001-0.071-0.001-0.107-0.001 c-0.398,0-0.791,0.038-1.186,0.09c-0.429,0.059-0.866,0.234-1.234,0.46c-0.275,0.169-0.469,0.395-0.663,0.648 c-0.122,0.159-0.194,0.384-0.262,0.566c-0.074,0.196-0.114,0.406-0.154,0.612c-0.103,0.528-0.152,1.063-0.042,1.595 c0.027,0.133,0.08,0.262,0.129,0.389c0.122,0.317,0.287,0.579,0.515,0.832c0.18,0.201,0.422,0.357,0.642,0.511 c0.142,0.099,0.298,0.18,0.456,0.253c0.224,0.101,0.456,0.207,0.697,0.266c0.427,0.106,0.873,0.141,1.312,0.165 c0.492,0.027,0.987,0.023,1.483,0.019c0.209-0.002,0.42-0.004,0.63-0.004c0.088,0,0.175,0.001,0.263,0.002 c-0.011,1.592,0.04,3.183,0.053,4.774C25.6,25.947,25.03,25.957,24.46,25.97z M24.132,17.865c0,0.431-0.359,0.791-0.791,0.791 c-0.431,0-0.791-0.359-0.791-0.791c0-0.431,0.359-0.791,0.791-0.791C23.772,17.074,24.132,17.434,24.132,17.865z"></path>
                                                </g>
                                            </svg>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Create Client Modal --}}
    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="createClientModal">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-7xl">
                <div class="bg-white w-full max-w-7xl">
                    <form action="{{ route('client.store')}}" method="POST">
                        @csrf
                        {{-- Page 1 --}}
                        <div id="createClientPage1" class="create-modal p-6">
                            <div class="flex justify-center">
                                <div class="create w-full max-w-4xl mx-auto p-4 bg-white rounded-md shadow-md">
                                    <h2 class="text-lg font-semibold text-gray-800">Personal Information</h2>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                        <div class="flex row gap-4">
                                            <div class="w-full">
                                                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                                <input type="text" name="name" id="name" class="form-input mt-1 block w-full rounded-md border-gray-300" required>
                                            </div>
                                            <div class="w-full">
                                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                                <input type="email" name="email" id="email" class="form-input mt-1 block w-full rounded-md border-gray-300" required>
                                            </div>
                                            <div class="w-full">
                                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                                <input type="number" name="phone" id="phone" class="form-input mt-1 block w-full rounded-md border-gray-300" required>
                                            </div>
                                        </div>
                                        <div class="flex row gap-4">
                                            <div class="w-full">
                                                <label for="address_home" class="block text-sm font-medium text-gray-700">Home Address</label>
                                                <input type="text" name="address_home" id="address_home" class="form-input mt-1 block w-full rounded-md border-gray-300" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-6 flex justify-end gap-2">
                                        <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600" id="closeClientModal">Close</button>
                                        <button type="button" style="background-color: #3B82F6;" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700" id="createClientNext">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Page 2 --}}
                        <div id="createClientPage2" class="create-modal p-6 hidden w-full" style="width: 40rem;">
                            <div class="flex justify-center w-full ">
                                <div class="create w-full max-w-7xl mx-auto p-4 bg-white rounded-md shadow-md">
                                    <h2 class="text-lg font-semibold text-gray-800">Service Information</h2>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4 w-full">
                                        <div class="mt-4">
                                            <select id="createCategory" name="category" class="form-select mt-1 block w-full rounded-md border-gray-300">
                                                <option value="">All Services</option>
                                                @foreach($services->groupBy('category') as $category => $servicesInCategory)
                                                <option value="{{ $category }}">{{ $category }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mt-4">
                                            <div class="mt-1 bg-white rounded-lg shadow p-4 flex" id="createServicesContainer" style="flex-direction: column;">
                                                @foreach($services as $service)
                                                <div class="flex row flex-wrap items-center mb-3 service-item p-2 rounded-lg hover:bg-blue-50 transition duration-200 ease-in-out" data-category="{{ $service->category }}">
                                                    <input type="checkbox" name="services[]" id="service_{{ $service->id }}" value="{{ $service->id }}" class="form-checkbox h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                                    <label for="service_{{ $service->id }}" class="ml-3 text-sm text-gray-800">
                                                        {{ $service->service_name }}
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <label for="employee_id">Select Employee</label>
                                            <select name="employee_id" id="employee_id" class="form-select mt-1 block w-full rounded-md border-gray-300">
                                                <option value="">Select an Employee</option>
                                                @foreach($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mt-6 flex justify-end gap-2">
                                            <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600" id="createClientPrev">Previous</button>
                                            <button type="submit" style="background-color: #3B82F6;" class="text-white py-2 px-4 rounded-md hover:bg-blue-700">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach($clients as $client)
    {{-- Edit Client Modal --}}
    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="editClientModal">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-7xl">
                <div class="bg-white w-full max-w-7xl">
                    {{-- Form begins here --}}
                    <form id="editClientForm" action="{{ route('clients.update', $client->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- Page 1 --}}
                        <div id="editClientPage1" class="create-modal p-6">
                            <div class="flex justify-center w-full">
                                <div class="create w-full max-w-4xl mx-auto p-4 bg-white rounded-md shadow-md">
                                    <h2 class="text-lg font-semibold text-gray-800">Personal Information</h2>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                        <div class="flex row gap-4">
                                            <div class="w-full">
                                                <label for="editName" class="block text-sm font-medium text-gray-700">Full name</label>
                                                <input type="text" name="name" id="editName" class="form-input mt-1 block w-full rounded-md border-gray-300" value="{{ $client->name }}" required>
                                            </div>
                                            <div class="w-full">
                                                <label for="editEmail" class="block text-sm font-medium text-gray-700">Email</label>
                                                <input type="email" name="email" id="editEmail" class="form-input mt-1 block w-full rounded-md border-gray-300" value="{{ $client->email }}" required>
                                            </div>
                                            <div class="w-full">
                                                <label for="editPhone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                                <input type="number" name="phone" id="editPhone" class="form-input mt-1 block w-full rounded-md border-gray-300" value="{{ $client->phone }}" required>
                                            </div>
                                        </div>

                                        <div class="flex row gap-4">
                                            <div class="w-full">
                                                <label for="editAddressHome" class="block text-sm font-medium text-gray-700">Home Address</label>
                                                <input type="text" name="address_home" id="editAddressHome" class="form-input mt-1 block w-full rounded-md border-gray-300" value="{{ $client->address_home }}">
                                            </div>
                                        </div>
                                        <div class="mt-6 flex justify-end gap-2">
                                            <button type="button" class="mr-4 bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600" id="closeEditClientModal">Cancel</button>
                                            <button type="button" style="background-color: #3B82F6;" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700" id="editClientNext">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{-- Page 2 --}}
                        <div id="editClientPage2" class="create-modal p-6 hidden" style="width: 40rem;">
                            <div class="flex justify-center w-full ">
                                <div class="create w-full max-w-7xl mx-auto p-4 bg-white rounded-md shadow-md">
                                    <h2 class="text-lg font-semibold text-gray-800">Service Information</h2>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                        <div class="mt-4">

                                            <select id="editCategory" name="editcategory" class="form-select mt-1 block w-full rounded-md border-gray-300">
                                                <option value=""></option>
                                                @foreach($services->groupBy('category') as $category => $servicesInCategory)
                                                <option value="{{ $category }}">{{ $category }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mt-4">
                                            <div class="mt-1 bg-white rounded-lg shadow p-4 flex" id="editServicesContainer" style="flex-direction: column;">
                                                @foreach($services as $service)
                                                <div class="flex row items-center mb-3 service-item p-2 rounded-lg hover:bg-blue-50 transition duration-200 ease-in-out" data-category="{{ $service->category }}">
                                                    <input type="checkbox" name="services[]" id="service_{{ $service->id }}" value="{{ $service->id }}"
                                                        class="form-checkbox h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                                        {{ in_array($service->id, $client->services->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                    <label for="service_{{ $service->id }}" class="ml-3 text-sm text-gray-800">
                                                        {{ $service->service_name }}
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="mt-6 flex justify-end gap-2">
                                            <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600" id="editClientPrev">Previous</button>
                                            <button type="submit" style="background-color: #3B82F6;" class="text-white py-2 px-4 rounded-md hover:bg-blue-700">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- Form ends here --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Read Client Modal --}}
    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="readClientModal">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="bg-white p-6">
                    <div id="readClientPage1">
                        <div class="flex row gap-6">
                            <div class="mt-4 gap-2">
                                <h2 class="text-lg font-semibold text-gray-800">Client Information</h2>
                                <div class="mt-4">
                                    <p><strong>Full name:</strong> <span id="readName">{{ $client->name }}</span></p>
                                    <p><strong>Email:</strong> <span id="readEmail">{{ $client->email }}</span></p>
                                    <p><strong>Phone Number:</strong> <span id="readPhone">{{ $client->phone }}</span></p>
                                    <p><strong>Home Address:</strong> <span id="readAddressHome">{{ $client->address_home }}</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end gap-2">
                            <button type="button" style="background-color: #3B82F6;" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700" id="readClientNext">Next</button>
                        </div>
                    </div>

                    {{-- Page 2 (left blank for now) --}}
                    <div id="readClientPage2" class="hidden">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Client Information</h3>
                        <div class="mt-4">
                            <ul id="servicesList">
                                @foreach($client->services as $service)
                                <li>{{ $service->service_name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="mt-6 flex justify-end gap-2">
                            <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600" id="readClientPrev">Previous</button>
                            <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600" id="closeReadClientModal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    {{-- JavaScript for modal operations --}}
    <script>
        // Function to toggle visibility of modal pages
        function togglePage(currentPageId, nextPageId) {
            document.getElementById(currentPageId).classList.add('hidden');
            document.getElementById(nextPageId).classList.remove('hidden');
        }



        // Function to handle modal visibility
        function toggleModal(modalId, action) {
            const modal = document.getElementById(modalId);
            if (action === 'open') {
                modal.classList.remove('hidden');
                modal.classList.add('block');
            } else if (action === 'close') {
                modal.classList.add('hidden');
                modal.classList.remove('block');
            }
        }



        // Add event listeners for buttons that control modal and page navigation
        function addEventListeners(config) {
            config.forEach(({
                buttonId,
                action,
                modalId,
                currentPage,
                nextPage
            }) => {
                const button = document.getElementById(buttonId);
                if (button) {
                    button.addEventListener('click', function() {
                        if (action) {
                            toggleModal(modalId, action);
                        } else if (currentPage && nextPage) {
                            togglePage(currentPage, nextPage);
                        }
                    });
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Page navigation configuration
            const pageNavConfig = [{
                    buttonId: 'createClientNext',
                    currentPage: 'createClientPage1',
                    nextPage: 'createClientPage2'
                },
                {
                    buttonId: 'createClientPrev',
                    currentPage: 'createClientPage2',
                    nextPage: 'createClientPage1'
                },
                {
                    buttonId: 'readClientNext',
                    currentPage: 'readClientPage1',
                    nextPage: 'readClientPage2'
                },
                {
                    buttonId: 'readClientPrev',
                    currentPage: 'readClientPage2',
                    nextPage: 'readClientPage1'
                },
                {
                    buttonId: 'editClientNext',
                    currentPage: 'editClientPage1',
                    nextPage: 'editClientPage2'
                },
                {
                    buttonId: 'editClientPrev',
                    currentPage: 'editClientPage2',
                    nextPage: 'editClientPage1'
                }
            ];

            // Modal control configuration
            const modalControlConfig = [{
                    buttonId: 'openClientModal',
                    modalId: 'createClientModal',
                    action: 'open'
                },
                {
                    buttonId: 'closeClientModal',
                    modalId: 'createClientModal',
                    action: 'close'
                },
                {
                    buttonId: 'openReadClientModal',
                    modalId: 'readClientModal',
                    action: 'open'
                },
                {
                    buttonId: 'closeReadClientModal',
                    modalId: 'readClientModal',
                    action: 'close'
                },
                {
                    buttonId: 'openEditClientModal',
                    modalId: 'editClientModal',
                    action: 'open'
                },
                {
                    buttonId: 'closeEditClientModal',
                    modalId: 'editClientModal',
                    action: 'close'
                }
            ];

            // Add all event listeners
            addEventListeners([...pageNavConfig, ...modalControlConfig]);

            // Close modal when clicking outside of it
            window.onclick = function(event) {
                ['createClientModal', 'readClientModal', 'editClientModal'].forEach(modalId => {
                    const modal = document.getElementById(modalId);
                    if (event.target === modal) {
                        toggleModal(modalId, 'close');
                    }
                });
            };

            // Setup service filtering for create and edit modals
            setupServiceFilter('createCategory', 'createServicesContainer');
            setupServiceFilter('editCategory', 'editServicesContainer');
        });

        // Function to populate Read Client Modal
        function openReadClientModal(id, name, email, phone, address_home, services) {

            // Set basic client information
            document.getElementById('readName').textContent = name;
            document.getElementById('readEmail').textContent = email;
            document.getElementById('readPhone').textContent = phone;
            document.getElementById('readAddressHome').textContent = address_home;

            // Populate services list
            const servicesList = document.getElementById('servicesList');
            servicesList.innerHTML = ''; // Clear previous services
            services.forEach(service => {
                const li = document.createElement('li');
                li.textContent = `${service.service_name} - Php ${service.price_min}`;
                servicesList.appendChild(li);
            });

            // Open modal
            toggleModal('readClientModal', 'open');
        }

        // Function to populate Edit Client Modal
        function openEditClientModal(id, name, email, phone, address_home) {

            // Set basic client information
            document.getElementById('editName').value = name;
            document.getElementById('editEmail').value = email;
            document.getElementById('editPhone').value = phone;
            document.getElementById('editAddressHome').value = address_home;

            // Set the form action for submission
            document.getElementById('editClientForm').action = `/clients/${id}`;

            // Open the modal
            toggleModal('editClientModal', 'open');
        }


        // Service filtering functionality
        function setupServiceFilter(dropdownId, servicesContainerId) {
            const dropdown = document.getElementById(dropdownId);
            const servicesContainer = document.getElementById(servicesContainerId);

            if (dropdown && servicesContainer) {
                dropdown.addEventListener('change', function() {
                    filterServices(servicesContainer, dropdown.value);
                });

                // Trigger initial filtering
                if (dropdown.value) {
                    filterServices(servicesContainer, dropdown.value);
                }
            }
        }

        function filterServices(container, category) {
            const services = container.querySelectorAll('.service-item');
            services.forEach(service => {
                service.style.display = category === "" || service.getAttribute('data-category') === category ? 'block' : 'none';
            });
        }
    </script>



    <style>
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</x-app-layout>