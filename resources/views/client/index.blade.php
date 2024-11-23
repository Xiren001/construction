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
                                        onclick="openReadClientModal( {{ $client->id }}, '{{ $client->name }}', '{{ $client->email }}', '{{ $client->phone }}', '{{ $client->address_home }}', {{ $client->services->toJson() }},'{{ $client->employee ? $client->employee->name : 'No employee assigned' }}'  )">
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
                                    <button class="bg-gray-600 text-black py-1 px-1 rounded-md hover:bg-gray-100" id="openEditClientModal" onclick="openEditClientModal( {{ $client->id }}, '{{ $client->name }}', '{{ $client->email }}', '{{ $client->phone }}', '{{ $client->address_home }}', '{{ $client->employee ? $client->employee->name : 'No employee assigned' }}' )">
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

                                    <form action="{{ route('workload.store') }}" method="POST" style="width: fit-content; padding:0;">
                                        @csrf
                                        <input type="hidden" name="name" value="{{ $client->name }}">
                                        <input type="hidden" name="email" value="{{ $client->email }}">
                                        @foreach($client->services as $service)
                                        <input type="hidden" name="services[]" value="{{ $service->id }}">
                                        @endforeach
                                        <input type="hidden" name="employee" value="{{ $client->employee_id }}"> <!-- Assuming there's an employee ID -->

                                        <button
                                            class="bg-blue-600 text-white py-1 px-1 rounded-md hover:bg-blue-700"
                                            type="submit">
                                            Copy to Workload
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
                                            <select name="employee_id" id="employee_id" class="form-select mt-1 block w-full rounded-md border-gray-300">
                                                <option value="">Select Employee</option>
                                                @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
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
                                            <select name="employee_id" id="editEmployeeName" class="form-select mt-1 block w-full rounded-md border-gray-300">
                                                <option value="" disabled>Select Employee</option>
                                                @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}" {{ $client->employee_id == $employee->id ? 'selected' : '' }}>
                                                    {{ $employee->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

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
                                    <p><strong>Assigned Employee:</strong> <span id="readEmployeeName">{{ $client->employee?->name ?? 'No employee assigned' }}</span></p>
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


        // Function to populate Read Client Modal with client and employee data
        function openReadClientModal(id, name, email, phone, address_home, services, employeeName) {

            // Set basic client information
            document.getElementById('readName').textContent = name;
            document.getElementById('readEmail').textContent = email;
            document.getElementById('readPhone').textContent = phone;
            document.getElementById('readAddressHome').textContent = address_home;

            // Set employee information
            document.getElementById('readEmployeeName').textContent = employeeName;

            // Populate services list
            const servicesList = document.getElementById('servicesList');
            servicesList.innerHTML = ''; // Clear previous services
            services.forEach(service => {
                const li = document.createElement('li');
                li.textContent = `${service.service_name}`;
                servicesList.appendChild(li);
            });

            // Open modal
            toggleModal('readClientModal', 'open');
        }

        // Function to populate Edit Client Modal with client and employee data
        function openEditClientModal(id, name, email, phone, address_home, employeeName) {

            // Set basic client information
            document.getElementById('editName').value = name;
            document.getElementById('editEmail').value = email;
            document.getElementById('editPhone').value = phone;
            document.getElementById('editAddressHome').value = address_home;

            // Set employee information
            document.getElementById('editEmployeeName').value = employeeName;

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