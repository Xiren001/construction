<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-black-200 leading-tight">
            {{ __('Payment Logs') }}
        </h2>
    </x-slot>

    <div class="container-fluid mx-auto py-8 h-screen" style="padding: 0 13%;">
        <div class="container mx-auto mt-6 ">


            {{-- Search Input --}}
            <div class="flex justify-between justify-start items-center mb-6 mt-6 gap-2">
                <button type="button" onclick="window.location.href='{{ route('logs.report') }}'"
                    class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded" style="background-color: #EBBA5A;">
                    Generate Sales Report
                </button>
                <form action="{{ route('logs.index') }}" method="GET" class="flex" style="gap:5px;">
                    <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                        class="form-input rounded-md border-gray-300" />
                </form>
            </div>


            {{-- Logs List --}}
            <div class="flex flex-row gap-6">
                <div class="overflow-x-auto w-full h-screen">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Price</th>
                                <th>Payment Method</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                            <tr>
                                <td>{{ $log->name }}</td>
                                <td >{{ $log->email }}</td>
                                <td>Php {{ number_format($log->price, 2) }}</td>
                                <td>{{ ucfirst($log->payment_method) }}</td>
                                <td>{{ \Carbon\Carbon::parse($log->created_at)->format('M d, Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- If there are no logs --}}
                    @if($logs->isEmpty())
                    <div class="text-center p-6">
                        <p>No logs found.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript to Print the Table --}}
    <script>
        function generateSalesReport() {
            window.location.href = "{{ route('logs.index') }}";
        }
    </script>

</x-app-layout>