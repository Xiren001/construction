<!-- resources/views/employees/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-black-200 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>


    <div class="container-fluid mx-auto py-8 h-screen" style="padding: 0 13%;">
        <div class="container mx-auto mt-6">
            <div class="flex flex-row gap-6">

                <div class="overflow-x-auto w-full h-screen">

                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 33%; text-align:center;">Name</th>
                                <th style="width: 33%; text-align:center;">Email</th>
                                <th style="width: 33%; text-align:center;">Position</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($employees as $employee)
                            <tr>
                                <td style="width: 33%; text-align:center;">{{ $employee->name }}</td>
                                <td style="width: 33%; text-align:center;">{{ $employee->email }}</td>
                                <td style="width: 33%; text-align:center;">{{ $employee->usertype }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">No employees found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>