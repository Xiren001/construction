<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-black-200 leading-tight">
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
                                <th style="text-align:left; width:15%">Name</th>
                                <th style="text-align:left;  width:15%">Email</th>
                                <th style="text-align:left;  width:15%">Employee</th>
                                <th style="text-align:left;  width:15%">Services</th>
                                <th style="text-align:left;  width:15%">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($workloads as $workload)
                            <tr>
                                <td style="text-align:left; width:15%">{{ $workload->name }}</td>
                                <td style="text-align:left;  width:15%">{{ $workload->email }}</td>
                                <td style="text-align:left;  width:15%">{{ $workload->employee->name ?? 'No Employee' }}</td>
                                <td style="text-align:left;  width:15%">
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
                                <td style="text-align:left;  width:15%">
                                    <form action="{{ route('workload.updateStatus', $workload->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" class="form-select rounded-md border-gray-300">
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
                                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    No Workload found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
