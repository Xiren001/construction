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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Employee</th>
                                <th>Services</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($workloads as $workload)
                            <tr>
                                <td>{{ $workload->name }}</td>
                                <td>{{ $workload->email }}</td>
                                <td>{{ $workload->employee->name ?? 'No Employee' }}</td>
                                <td>
                                    @if ($workload->services && $workload->services->isNotEmpty())
                                    <ul>
                                        @foreach ($workload->services as $service)
                                        <li>{{ $service->service_name }}</li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <span>No Services Assigned</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('workload.updateStatus', $workload->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="handleStatusChange(event, {{ $workload->id }})" class="form-select" style="border-radius: 5px;">
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
                        <input type="checkbox" id="siteCleared" name="checklist[siteCleared]" />
                        <label for="siteCleared">Site cleared of debris</label>
                    </div>
                    <div>
                        <input type="checkbox" id="landscaping" name="checklist[landscaping]" />
                        <label for="landscaping">Landscaping completed</label>
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

    <script>
        let previousStatus = null;

        function handleStatusChange(event, workloadId) {
            const selectedValue = event.target.value;

            if (selectedValue === 'Completed') {
                previousStatus = event.target;
                document.getElementById('workload_id').value = workloadId;
                document.getElementById('checklistModal').style.display = 'flex';
            } else {
                event.target.form.submit();
            }
        }

        function closeModal() {
            if (previousStatus) {
                previousStatus.value = 'In Progress';
            }
            document.getElementById('checklistModal').style.display = 'none';
        }
    </script>

    <style>
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

        .modal-content {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            max-width: 500px;
            width: 90%;
            position: relative;
        }

        .modal-content h3 {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        .actions button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .actions button:first-child {
            background-color: #ccc;
            color: #333;
        }

        .actions button:last-child {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</x-app-layout>