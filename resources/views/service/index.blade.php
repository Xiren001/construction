<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-black-200 leading-tight">
            {{ __('Services') }}
        </h2>
    </x-slot>
    <div class="container-fluid mx-auto py-8 h-screen" style="padding: 0 13%;">
        <div class="container mx-auto mt-6">

            {{-- Search Input --}}
            <div class="flex justify-between items-center mb-6 mt-6 gap-2 px-2">
                {{-- Button to open the modal --}}
                <button class="bg-blue-500 hover:bg-blue-700 flex row text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow" id="openServiceModal" style="background-color: #EBBA5A;">
                    <svg fill="#ffffff" width="35px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path wid d="M2,21h8a1,1,0,0,0,0-2H3.071A7.011,7.011,0,0,1,10,13a5.044,5.044,0,1,0-3.377-1.337A9.01,9.01,0,0,0,1,20,1,1,0,0,0,2,21ZM10,5A3,3,0,1,1,7,8,3,3,0,0,1,10,5ZM23,16a1,1,0,0,1-1,1H19v3a1,1,0,0,1-2,0V17H14a1,1,0,0,1,0-2h3V12a1,1,0,0,1,2,0v3h3A1,1,0,0,1,23,16Z" />
                    </svg>
                    Add
                </button>

                <form action="{{ route('service.index') }}" method="GET" class="flex" style="gap:5px;">
                    <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                        class="form-input rounded-md border-gray-300" />
                </form>
            </div>

            {{-- Services Section --}}
            <div class="overflow-x-auto w-full h-screen">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Service Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($services as $service)
                        <tr>
                            <td>{{ $service->category }}</td>
                            <td>{{ $service->service_name }}</td>
                            <td>

                                {{-- Read Button --}}
                                <button class="bg-gray-600 text-black py-1 px-1 rounded-md hover:bg-gray-100"
                                    onclick="openReadServiceModal({{ $service->id }}, '{{ $service->category }}', '{{ $service->service_name }}')">
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
                                <button class="bg-blue-600 text-black py-1 px-1 rounded-md hover:bg-gray-100"
                                    onclick="openEditServiceModal({{ $service->id }}, '{{ $service->category }}', '{{ $service->service_name }}')">
                                    <svg width="20px" height="20px" viewBox="0 -0.5 21 21" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.5880000000000001"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <title>edit_text_bar [#1373]</title>
                                            <desc>Created with Sketch.</desc>
                                            <defs> </defs>
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


                                <!-- <form action="{{ route('service.destroy', $service->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white py-1 rounded"><svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 12V17" stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M14 12V17" stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M4 7H20" stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M6 10V18C6 19.6569 7.34315 21 9 21H15C16.6569 21 18 19.6569 18 18V10" stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></button>
                                </form> -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Create Service Modal --}}
    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="serviceModal">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="bg-white p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Create New Service</h3>

                    <form action="{{ route('service.store') }}" method="POST">
                        @csrf
                        {{-- Service Category --}}
                        <div class="mt-4">
                            <label for="serviceCategory" class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category" id="serviceCategory" class="form-select mt-1 block w-full rounded-md border-gray-300" required>
                                <option value="" disabled selected>Select a category</option>
                                <option value="Residential Construction">Residential Construction</option>
                                <option value="Commercial Construction">Commercial Construction</option>
                                <option value="Industrial Construction">Industrial Construction</option>
                                <option value="Infrastructure and Civil Construction">Infrastructure and Civil Construction</option>
                                <option value="Specialized Construction">Specialized Construction</option>
                                <option value="Environmental Construction">Environmental Construction</option>
                                <option value="Mechanical, Electrical, and Plumbing (MEP) Services">Mechanical, Electrical, and Plumbing (MEP) Services</option>
                                <option value="Interior and Finishing Services">Interior and Finishing Services</option>
                                <option value="Landscaping and Site Preparation">Landscaping and Site Preparation</option>
                                <option value="Demolition and Excavation Services">Demolition and Excavation Services</option>
                            </select>
                        </div>


                        {{-- Service Type --}}
                        <div class="mt-4">
                            <label for="serviceType" class="block text-sm font-medium text-gray-700">Service Type</label>
                            <input type="text" name="service_name" id="serviceType" class="form-input mt-1 block w-full rounded-md border-gray-300" required>
                        </div>

                        {{-- Buttons --}}
                        <div class="mt-6 flex justify-end gap-2">
                            <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600" id="closeServiceModal">Close</button>
                            <button type="submit" style="background-color: #3B82F6;" class="text-white py-2 px-4 rounded-md hover:bg-blue-700">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- Read Service Modal --}}
    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="readServiceModal">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="bg-white p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Service Details</h3>

                    {{-- Service Details --}}
                    <div class="mt-4">
                        <p><strong>Category:</strong> <span id="readServiceCategory"></span></p>
                        <p><strong>Service Type:</strong> <span id="readServiceType"></span></p>
                    </div>

                    {{-- Close Button --}}
                    <div class="mt-6 flex justify-end">
                        <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600" id="closeReadServiceModalBtn">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- Edit Service Modal --}}
    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="editServiceModal">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="bg-white p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Service</h3>

                    {{-- Service Edit Form --}}
                    <form id="editServiceForm" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mt-4">
                            <label for="editServiceCategory" class="block text-sm font-medium text-gray-700">Category</label>
                            <select id="editServiceCategory" name="category" class="form-select mt-1 block w-full rounded-md border-gray-300" required>
                                <option value="Residential Construction">Residential Construction</option>
                                <option value="Commercial Construction">Commercial Construction</option>
                                <option value="Industrial Construction">Industrial Construction</option>
                                <option value="Infrastructure and Civil Construction">Infrastructure and Civil Construction</option>
                                <option value="Specialized Construction">Specialized Construction</option>
                                <option value="Environmental Construction">Environmental Construction</option>
                                <option value="Mechanical, Electrical, and Plumbing (MEP) Services">Mechanical, Electrical, and Plumbing (MEP) Services</option>
                                <option value="Interior and Finishing Services">Interior and Finishing Services</option>
                                <option value="Landscaping and Site Preparation">Landscaping and Site Preparation</option>
                                <option value="Demolition and Excavation Services">Demolition and Excavation Services</option>
                            </select>
                        </div>


                        <div class="mt-4">
                            <label for="editServiceType" class="block text-sm font-medium text-gray-700">Service Type</label>
                            <input type="text" name="service_name" id="editServiceType" class="form-input mt-1 block w-full rounded-md border-gray-300" required>
                        </div>

                        <div class="mt-6 flex justify-end gap-2">
                            <button type="button" class="mr-4 bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600" id="closeEditServiceModalBtn">Cancel</button>
                            <button type="submit" style="background-color: #3B82F6;" class="text-white py-2 px-4 rounded-md hover:bg-blue-700">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    {{-- JavaScript for modal operations --}}
    <script>
        // Close modals when clicking outside
        window.onclick = function(event) {
            const serviceModal = document.getElementById('serviceModal');
            const readServiceModal = document.getElementById('readServiceModal');
            const editServiceModal = document.getElementById('editServiceModal');

            if (event.target == serviceModal) {
                serviceModal.style.display = 'none';
            }
            if (event.target == readServiceModal) {
                readServiceModal.classList.add('hidden');
            }
            if (event.target == editServiceModal) {
                editServiceModal.classList.add('hidden');
            }
        }

        document.getElementById('openServiceModal').addEventListener('click', function() {
            document.getElementById('serviceModal').style.display = 'block';
        });

        document.getElementById('closeServiceModal').addEventListener('click', function() {
            document.getElementById('serviceModal').style.display = 'none';
        });

        // Open Read Service Modal
        function openReadServiceModal(id, category, serviceType) {
            document.getElementById('readServiceCategory').textContent = category;
            document.getElementById('readServiceType').textContent = serviceType;
            document.getElementById('readServiceModal').classList.remove('hidden');
        }

        // Close Read Service Modal
        document.getElementById('closeReadServiceModalBtn').addEventListener('click', function() {
            document.getElementById('readServiceModal').classList.add('hidden');
        });

        // Open Edit Service Modal
        function openEditServiceModal(id, category, serviceType) {
            document.getElementById('editServiceCategory').value = category;
            document.getElementById('editServiceType').value = serviceType;
            document.getElementById('editServiceForm').action = `/services/${id}`;
            document.getElementById('editServiceModal').classList.remove('hidden');
        }

        // Close Edit Service Modal
        document.getElementById('closeEditServiceModalBtn').addEventListener('click', function() {
            document.getElementById('editServiceModal').classList.add('hidden');
        });
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