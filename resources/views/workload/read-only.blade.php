@extends('layouts.main')
@section('mainContent')

<div class="container-fluid mx-auto py-8 h-screen" style="padding: 10% 13%; height:100vh; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
    <div class="container mx-auto mt-6">
        <div class="flex flex-row gap-6">
            <div class="overflow-x-auto w-full h-screen">
                <table class="tables">
                    <thead>
                        <tr>
                            <th style="text-align:left; width:15%">Name</th>
                            <th style="text-align:left; width:15%">Email</th>
                            <th style="text-align:left; width:15%">Employee</th>
                            <th style="text-align:left; width:15%">Services</th>
                            <th style="text-align:left; width:15%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($workloads as $workload)
                        <tr>
                            <td style="text-align:left; width:15%">{{ $workload->name }}</td>
                            <td style="text-align:left; width:15%">{{ $workload->email }}</td>
                            <td style="text-align:left; width:15%">{{ $workload->employee->name ?? 'No Employee' }}</td>
                            <td style="text-align:left; width:15%">
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
                            <td style="text-align:left; width:15%">
                                <span>{{ $workload->status }}</span> <!-- Display status as text -->
                            </td>
                        </tr>

                        <!-- Show checklist and photo if the workload is completed -->
                        @if ($workload->status === 'Completed' && $workload->completedWork)
                        <tr>
                            <td colspan="5" style="text-align:left; background-color: #f9f9f9;">
                                <strong>Checklist:</strong>
                                <ul>
                                    @foreach (json_decode($workload->completedWork->checklist, true) as $item => $status)
                                    <li>{{ ucfirst($item) }}: {{ $status ? '✔️' : '❌' }}</li>
                                    @endforeach
                                </ul>
                                <strong>Photo:</strong>
                                <div style="margin-top: 10px;">
                                    <img src="{{ asset('storage/' . $workload->completedWork->photo) }}"
                                        alt="Completed Work Photo"
                                        style="max-width: 200px; border: 1px solid #ddd; border-radius: 5px;">

                                </div>
                            </td>
                        </tr>
                        @endif
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                No Request found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .tables {
        width: 100%;
        height: auto;
        border-radius: 10px;
        font-size: 1.2rem;
        line-height: 1.5rem;
        font-family: sans-serif;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    }

    .tables thead tr {
        background-color: #0A3247;
        color: white;
    }

    .tables tbody tr {
        background-color: white;
        color: white;
    }

    .tables thead tr th:first-child {
        border-radius: 10px 0 0 0;
    }

    .tables thead tr th:last-child {
        border-radius: 0 10px 0 0;
    }

    .tables thead tr th {
        padding: 1rem 5%;
        font-weight: 100;
        width: 25%;
        text-align: start;
        line-height: 1.7;
    }

    .tables tbody tr td {
        padding: 1rem 5%;
        font-weight: 100;
        font-size: 15px;
        color: #666666;
        text-align: start;
        line-height: 1.2;
        font-weight: unset !important;
        border-bottom: 1px solid #f2f2f2;
        width: 25%;
    }

    .tables thead tr th:last-child {
        width: 15%;
    }

    .tables tbody tr td:last-child {
        width: 15%;
    }

    .tables tbody tr td:first-child {
        border-radius: 0 0 0 10px;
    }

    .tables tbody tr td:last-child {
        border-radius: 0 0 10px 0;
    }

    .tables tbody tr:hover {
        background-color: #66666689;
    }
</style>

@endsection