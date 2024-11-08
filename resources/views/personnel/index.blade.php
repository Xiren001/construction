<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-black-200 leading-tight">
            {{ __('Personnels') }}
        </h2>
    </x-slot>

    <div class="container-fluid mx-auto py-8 h-screen" style="padding: 0 13%;">
        <div class="h-screen bg-white rounded-lg p-2">
            
            {{-- Search Input --}}
            <div class="flex justify-between items-center mb-6 mt-6 gap-2">
                {{-- Button to open the modal --}}
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow" id="openModalBtn" style="background-color: #EBBA5A;">
                    <svg fill="#ffffff" width="40px" height="25px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path wid d="M2,21h8a1,1,0,0,0,0-2H3.071A7.011,7.011,0,0,1,10,13a5.044,5.044,0,1,0-3.377-1.337A9.01,9.01,0,0,0,1,20,1,1,0,0,0,2,21ZM10,5A3,3,0,1,1,7,8,3,3,0,0,1,10,5ZM23,16a1,1,0,0,1-1,1H19v3a1,1,0,0,1-2,0V17H14a1,1,0,0,1,0-2h3V12a1,1,0,0,1,2,0v3h3A1,1,0,0,1,23,16Z" />
                    </svg>
                </button>

                <form action="{{ route('personnel.index') }}" method="GET" class="flex" style="gap:5px;">
                    <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                        class="form-input rounded-md border-gray-300" />
                </form>
            </div>

            <div class="flex flex-row gap-6">
                {{-- List of employees --}}
                <div class="overflow-x-auto w-full h-screen">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <a href="{{ route('personnel.index', ['sort_by' => 'name', 'sort_direction' => request('sort_direction') === 'asc' && request('sort_by') === 'name' ? 'desc' : 'asc']) }}">
                                        Name
                                        @if(request('sort_by') === 'name')
                                        ({{ request('sort_direction') === 'asc' ? '↑' : '↓' }})
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ route('personnel.index', ['sort_by' => 'email', 'sort_direction' => request('sort_direction') === 'asc' && request('sort_by') === 'email' ? 'desc' : 'asc']) }}">
                                        Email
                                        @if(request('sort_by') === 'email')
                                        ({{ request('sort_direction') === 'asc' ? '↑' : '↓' }})
                                        @endif
                                    </a>
                                </th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->position }}</td>
                                <td>

                                    {{-- Read Button --}}
                                    <button onclick="openReadModal({{ $employee->id }}, '{{ $employee->name }}', '{{ $employee->email }}')">
                                        <svg fill="#000000" width="25px" height="25px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.6"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="read"> <g> <path d="M12,18.883a10.8,10.8,0,0,1-9.675-5.728,2.6,2.6,0,0,1,0-2.31A10.8,10.8,0,0,1,12,5.117a10.8,10.8,0,0,1,9.675,5.728h0a2.6,2.6,0,0,1,0,2.31A10.8,10.8,0,0,1,12,18.883ZM12,6.117a9.787,9.787,0,0,0-8.78,5.176,1.586,1.586,0,0,0,0,1.415A9.788,9.788,0,0,0,12,17.883a9.787,9.787,0,0,0,8.78-5.176,1.584,1.584,0,0,0,0-1.414h0A9.787,9.787,0,0,0,12,6.117Z"></path> <path d="M12,16.049A4.049,4.049,0,1,1,16.049,12,4.054,4.054,0,0,1,12,16.049Zm0-7.1A3.049,3.049,0,1,0,15.049,12,3.052,3.052,0,0,0,12,8.951Z"></path> <circle cx="12" cy="12" r="2.028"></circle> </g> </g> </g></svg>
                                    </button>

                                    {{-- Edit Button --}}
                                    <button onclick="openEditModal({{ $employee->id }}, '{{ $employee->name }}', '{{ $employee->email }}')">
                                        <svg width="20px" height="20px" viewBox="0 -0.5 21 21" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.5880000000000001"></g><g id="SVGRepo_iconCarrier"> <title>edit_text_bar [#1373]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke-width="0.00021000000000000004" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-339.000000, -800.000000)" fill="#000000"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M286.15,654 C285.5704,654 285.1,653.552 285.1,653 L285.1,647 C285.1,646.448 285.5704,646 286.15,646 C286.7296,646 287.2,645.552 287.2,645 C287.2,644.448 286.7296,644 286.15,644 L285.1,644 C283.93975,644 283,644.895 283,646 L283,654 C283,655.105 283.93975,656 285.1,656 L286.15,656 C286.7296,656 287.2,655.552 287.2,655 C287.2,654.448 286.7296,654 286.15,654 M301.9,644 L294.55,644 C293.9704,644 293.5,644.448 293.5,645 C293.5,645.552 293.9704,646 294.55,646 L300.85,646 C301.4296,646 301.9,646.448 301.9,647 L301.9,653 C301.9,653.552 301.4296,654 300.85,654 L294.55,654 C293.9704,654 293.5,654.448 293.5,655 C293.5,655.552 293.9704,656 294.55,656 L301.9,656 C303.06025,656 304,655.105 304,654 L304,646 C304,644.895 303.06025,644 301.9,644 M293.5,659 C293.5,659.552 293.0296,660 292.45,660 L288.25,660 C287.6704,660 287.2,659.552 287.2,659 C287.2,658.448 287.6704,658 288.25,658 L289.3,658 L289.3,642 L288.25,642 C287.6704,642 287.2,641.552 287.2,641 C287.2,640.448 287.6704,640 288.25,640 L292.45,640 C293.0296,640 293.5,640.448 293.5,641 C293.5,641.552 293.0296,642 292.45,642 L291.4,642 L291.4,658 L292.45,658 C293.0296,658 293.5,658.448 293.5,659" id="edit_text_bar-[#1373]"> </path> </g> </g> </g> </g></svg>
                                    </button>
                                    <!-- <form action="{{ route('personnel.destroy', [$employee->id, 'employee']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white py-1 px-3 rounded-md hover:bg-red-700">Delete</button>
                                    </form> -->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- List of Staff --}}
                <div class="overflow-x-auto w-full h-screen">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <a href="{{ route('personnel.index', ['sort_by' => 'name', 'sort_direction' => request('sort_direction') === 'asc' && request('sort_by') === 'name' ? 'desc' : 'asc']) }}">
                                        Name
                                        @if(request('sort_by') === 'name')
                                        ({{ request('sort_direction') === 'asc' ? '↑' : '↓' }})
                                        @endif
                                    </a>
                                </th>
                                <th >
                                    <a href="{{ route('personnel.index', ['sort_by' => 'email', 'sort_direction' => request('sort_direction') === 'asc' && request('sort_by') === 'email' ? 'desc' : 'asc']) }}">
                                        Email
                                        @if(request('sort_by') === 'email')
                                        ({{ request('sort_direction') === 'asc' ? '↑' : '↓' }})
                                        @endif
                                    </a>
                                </th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($staff as $person)
                            <tr>
                                <td>{{ $person->name }}</td>
                                <td>{{ $person->email }}</td>
                                <td>{{ $person->position }}</td>
                                <td>

                                    {{-- Read Button --}}
                                    <button class="bg-gray-600 text-black py-1 px-1 rounded-md hover:bg-gray-100" onclick="openReadModal({{ $person->id }}, '{{ $person->name }}', '{{ $person->email }}')">
                                        <svg fill="#000000" width="25px" height="25px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.6"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="read"> <g> <path d="M12,18.883a10.8,10.8,0,0,1-9.675-5.728,2.6,2.6,0,0,1,0-2.31A10.8,10.8,0,0,1,12,5.117a10.8,10.8,0,0,1,9.675,5.728h0a2.6,2.6,0,0,1,0,2.31A10.8,10.8,0,0,1,12,18.883ZM12,6.117a9.787,9.787,0,0,0-8.78,5.176,1.586,1.586,0,0,0,0,1.415A9.788,9.788,0,0,0,12,17.883a9.787,9.787,0,0,0,8.78-5.176,1.584,1.584,0,0,0,0-1.414h0A9.787,9.787,0,0,0,12,6.117Z"></path> <path d="M12,16.049A4.049,4.049,0,1,1,16.049,12,4.054,4.054,0,0,1,12,16.049Zm0-7.1A3.049,3.049,0,1,0,15.049,12,3.052,3.052,0,0,0,12,8.951Z"></path> <circle cx="12" cy="12" r="2.028"></circle> </g> </g> </g></svg>
                                    </button>

                                    {{-- Edit Button --}}
                                    <button class="bg-gray-600 text-black py-1 px-1 rounded-md hover:bg-gray-100" onclick="openEditModal({{ $person->id }}, '{{ $person->name }}', '{{ $person->email }}')">
                                        <svg width="20px" height="20px" viewBox="0 -0.5 21 21" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.5880000000000001"></g><g id="SVGRepo_iconCarrier"> <title>edit_text_bar [#1373]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke-width="0.00021000000000000004" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-339.000000, -800.000000)" fill="#000000"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M286.15,654 C285.5704,654 285.1,653.552 285.1,653 L285.1,647 C285.1,646.448 285.5704,646 286.15,646 C286.7296,646 287.2,645.552 287.2,645 C287.2,644.448 286.7296,644 286.15,644 L285.1,644 C283.93975,644 283,644.895 283,646 L283,654 C283,655.105 283.93975,656 285.1,656 L286.15,656 C286.7296,656 287.2,655.552 287.2,655 C287.2,654.448 286.7296,654 286.15,654 M301.9,644 L294.55,644 C293.9704,644 293.5,644.448 293.5,645 C293.5,645.552 293.9704,646 294.55,646 L300.85,646 C301.4296,646 301.9,646.448 301.9,647 L301.9,653 C301.9,653.552 301.4296,654 300.85,654 L294.55,654 C293.9704,654 293.5,654.448 293.5,655 C293.5,655.552 293.9704,656 294.55,656 L301.9,656 C303.06025,656 304,655.105 304,654 L304,646 C304,644.895 303.06025,644 301.9,644 M293.5,659 C293.5,659.552 293.0296,660 292.45,660 L288.25,660 C287.6704,660 287.2,659.552 287.2,659 C287.2,658.448 287.6704,658 288.25,658 L289.3,658 L289.3,642 L288.25,642 C287.6704,642 287.2,641.552 287.2,641 C287.2,640.448 287.6704,640 288.25,640 L292.45,640 C293.0296,640 293.5,640.448 293.5,641 C293.5,641.552 293.0296,642 292.45,642 L291.4,642 L291.4,658 L292.45,658 C293.0296,658 293.5,658.448 293.5,659" id="edit_text_bar-[#1373]"> </path> </g> </g> </g> </g></svg>
                                    </button>

                                    <!-- <form action="{{ route('personnel.destroy', [$person->id, 'staff']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white py-1 px-3 rounded-md hover:bg-red-700">Delete</button>
                                    </form> -->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    {{-- Modal for adding personnel --}}
    <div class="fixed z-10 inset-0 overflow-y-auto {{ $errors->any() ? '' : 'hidden' }}" id="personnelModal">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="bg-white p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Add New Personnel</h3>

                    {{-- Display validation errors --}}
                    @if ($errors->any())
                    <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('personnel.store') }}" method="POST">
                        @csrf
                        <div class="mt-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" class="form-input mt-1 block w-full rounded-md border-gray-300" value="{{ old('name') }}" required>
                            @error('name')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="form-input mt-1 block w-full rounded-md border-gray-300" value="{{ old('email') }}" required>
                            @error('email')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                            <select id="position" name="position" class="form-select mt-1 block w-full rounded-md border-gray-300" required>
                                <option value="employee" {{ old('position') == 'employee' ? 'selected' : '' }}>Personnel</option>
                                <option value="staff" {{ old('position') == 'staff' ? 'selected' : '' }}>Staff</option>
                            </select>
                            @error('position')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-6 flex justify-end gap-2">
                            <button type="button" class="mr-4 bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600" id="closeModalBtn">Cancel</button>
                            <button type="submit" style="background-color: #3B82F6;" class="text-white py-2 px-4 rounded-md hover:bg-blue-700">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Read Modal --}}
    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="readModal">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="bg-white p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Personnel Details</h3>
                    <div class="mt-4">
                        <p><strong>Name:</strong> <span id="readName"></span></p>
                        <p><strong>Email:</strong> <span id="readEmail"></span></p>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600" id="closeReadModalBtn">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="editModal">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="bg-white p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Personnel</h3>
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mt-4">
                            <label for="editName" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="editName" class="form-input mt-1 block w-full rounded-md border-gray-300" required>
                        </div>
                        <div class="mt-4">
                            <label for="editEmail" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="editEmail" class="form-input mt-1 block w-full rounded-md border-gray-300" required>
                        </div>
                        <div class="mt-6 flex justify-end gap-2">
                            <button type="button" class="mr-4 bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600" id="closeEditModalBtn">Cancel</button>
                            <button type="submit" style="background-color: #3B82F6;" class="text-white py-2 px-4 rounded-md hover:bg-blue-700">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('personnelModal');
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const readModal = document.getElementById('readModal');
        const editModal = document.getElementById('editModal');
        const closeReadModalBtn = document.getElementById('closeReadModalBtn');
        const closeEditModalBtn = document.getElementById('closeEditModalBtn');

        // Open modal
        openModalBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });

        // Close modal
        closeModalBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        // Close modal if click outside the modal content
        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });

        // Open Read Modal
        function openReadModal(id, name, email) {
            // Use the passed name and email instead of hardcoded values
            document.getElementById('readName').textContent = name;
            document.getElementById('readEmail').textContent = email;
            readModal.classList.remove('hidden');
        }

        // Open Edit Modal
        function openEditModal(id, name, email) {
            document.getElementById('editName').value = name;
            document.getElementById('editEmail').value = email;
            document.getElementById('editForm').action = `/personnel/${id}/update`; // Update the form action to submit the correct route
            editModal.classList.remove('hidden');
        }

        // Close Modals
        closeReadModalBtn.addEventListener('click', () => readModal.classList.add('hidden'));
        closeEditModalBtn.addEventListener('click', () => editModal.classList.add('hidden'));
    </script>
</x-app-layout>