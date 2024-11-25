<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 leading-tight">
            {{ __('Workload') }}
        </h2>
    </x-slot>

    <div class="container-fluid mx-auto py-8 h-screen" style="padding: 0 13%;">
        <div class="container mx-auto mt-6">
            <div class="flex flex-row gap-6">
                <div class="overflow-x-auto w-full h-screen">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 20%;">Name</th>
                                <th style="width: 20%;">Email</th>
                                <th style="width: 20%;">Employee</th>
                                <th style="width: 20%;">Services</th>
                                <th style="width: 20%;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($workloads as $workload)
                            <tr data-workload-id="{{ $workload->id }}">
                                <td style="width: 20%;">{{ $workload->name }}</td>
                                <td style="width: 20%;">{{ $workload->email }}</td>
                                <td style="width: 20%;">{{ $workload->employee->name ?? 'No Employee' }}</td>
                                <td style="width: 20%;">
                                    <ul class="space-y-2">
                                        @foreach($services as $service)
                                        <li class="text-sm text-gray-800">
                                            {{ $service->service_name }}
                                        </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td style="width: 20%;">
                                    <form action="{{ route('workload.updateStatus', $workload->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="handleStatusChange(event, {{ $workload->id }})" class="form-select" style="border-radius: 5px; border:none;">
                                            <option value="Pending" {{ $workload->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="In Progress" {{ $workload->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="Completed" {{ $workload->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="Canceled" {{ $workload->status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No Workload found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Checklist Modal -->
    <div id="checklistModal" class="modal">
        <div class="modal-content">
            <form id="checklistForm" action="{{ route('workload.submitChecklist') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="workload_id" id="workload_id" />

                <h3>Construction Completion Checklist</h3>

                <div>
                    <label>Site Work:</label>
                    <div>
                        <input type="checkbox" id="property" name="checklist[Perform walk through of property]" />
                        <label for="property">Perform walk through of property</label>
                    </div>
                    <div>
                        <input type="checkbox" id="Discuss" name="checklist[Discuss service with the client face to face]" />
                        <label for="Discuss">Discuss service with the client face to face</label>
                    </div>
                    <div>
                        <input type="checkbox" id="operation" name="checklist[Conducting the work order operation]" />
                        <label for="operation">Conducting the work order operation</label>
                    </div>
                    <div>
                        <input type="checkbox" id="End" name="checklist[End of the work order operation]" />
                        <label for="End">End of the work order operation</label>
                    </div>
                </div>

                <div>
                    <label for="photo">Upload Photo of Completed Work:</label>
                    <input type="file" id="photo" name="photo" accept="image/*" required />
                </div>

                <div class="actions">
                    <button type="button" onclick="closeModal()">Cancel</button>
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <div id="successSnackbar" class="snackbar">
        Checklist submitted successfully!
    </div>


    <script>
        let previousStatus = null;

        function handleStatusChange(event, workloadId) {
            const selectedValue = event.target.value;

            if (selectedValue === 'Completed') {
                previousStatus = event.target;
                document.getElementById('workload_id').value = workloadId;
                document.getElementById('checklistModal').style.display = 'flex';
            } else if (selectedValue === 'Canceled') {
                event.target.form.submit(); // Directly submit without confirmation
            } else {
                event.target.form.submit();
            }
        }

        function closeModal() {
            document.getElementById('checklistModal').style.display = 'none';
        }

        function showSuccessSnackbar() {
            const snackbar = document.getElementById('successSnackbar');
            snackbar.classList.add('show');
            setTimeout(() => {
                snackbar.classList.remove('show');
            }, 3000); // Hide after 3 seconds
        }

        document.getElementById('checklistForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch(this.action, {
                    method: this.method,
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (response.ok) {
                        const workloadId = formData.get('workload_id');
                        document.querySelector(`tr[data-workload-id="${workloadId}"]`).style.display = 'none';
                        closeModal(); // Close the modal
                        showSuccessSnackbar(); // Show success snackbar
                    } else {
                        alert('Failed to submit the checklist. Please try again.');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>

    <style>
        .snackbar {
            visibility: hidden;
            /* Hidden by default */
            min-width: 250px;
            margin-left: -125px;
            background-color: #4caf50;
            /* Green background */
            color: #fff;
            /* White text */
            text-align: center;
            border-radius: 5px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .snackbar.show {
            visibility: visible;
            /* Show the snackbar */
            animation: fadeInOut 3s;
            /* Fade in and out animation */
        }

        @keyframes fadeInOut {

            0%,
            100% {
                opacity: 0;
            }

            10%,
            90% {
                opacity: 1;
            }
        }

        /* Modal Styling */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            /* Darkened background */
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }


        /* Modal Content */
        .modal-content {
            background: #ffffff;
            /* Clean white background */
            padding: 30px;
            /* Spacious padding */
            border-radius: 12px;
            /* Smooth rounded corners */
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            /* Subtle shadow for depth */
            width: 500px;
            max-width: 90%;
            /* Responsive for smaller screens */
            font-family: Arial, sans-serif;
        }

        /* Header Styles */
        .modal-content h3 {
            font-size: 20px;
            font-weight: bold;
            color: #333333;
            /* Dark gray for better readability */
            margin-bottom: 20px;
            text-align: center;
            /* Center the title */
        }

        /* Checklist Group */
        .modal-content div {
            margin-bottom: 15px;
        }

        /* Input Styles */
        .modal-content input[type="checkbox"] {
            margin-right: 10px;
            /* Space between checkbox and label */
            accent-color: #007bff;
            /* Blue checkbox color */
        }

        .modal-content label {
            font-size: 14px;
            color: #555555;
            /* Neutral gray for labels */
        }

        .modal-content input[type="file"] {
            display: block;
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #cccccc;
            /* Light gray border */
            border-radius: 5px;
            /* Rounded input field */
            font-size: 14px;
            width: 100%;
            cursor: pointer;
        }

        /* Action Buttons */
        .actions {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            /* Space between buttons */
            margin-top: 20px;
        }

        .actions button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .actions button:first-child {
            background-color: #dddddd;
            /* Light gray for cancel button */
            color: #333333;
        }

        .actions button:first-child:hover {
            background-color: #bbbbbb;
            /* Darker gray on hover */
        }

        .actions button:last-child {
            background-color: #007bff;
            /* Blue for submit button */
            color: #ffffff;
            /* White text */
        }

        .actions button:last-child:hover {
            background-color: #0056b3;
            /* Darker blue on hover */
        }
    </style>

</x-app-layout>