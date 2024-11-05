<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-black-200 leading-tight">
            {{ __('Sales Report - ' . \Carbon\Carbon::createFromDate($year, $month)->format('F Y')) }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8 h-screen" style="padding: 0 13%;">
        <!-- Filter Form -->
        <form method="GET" action="{{ route('logs.report') }}" class="flex gap-2 mb-6">
            <!-- Month Filter -->
            <select name="month" class="form-select">
                @for($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                    </option>
                @endfor
            </select>

            <!-- Year Filter -->
            <select name="year" class="form-select">
                @for($y = \Carbon\Carbon::now()->year; $y >= 2020; $y--)
                    <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endfor
            </select>

            <!-- Submit Button -->
            <button type="submit" class="px-4 py-2 text-white rounded-md border" style="background-color: #4169e1;">Filter</button>

            <button type="button" onclick="printTable()"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" style="background-color: #009d00;">
                    Print Table
                </button>
        </form>

        <div class="container mx-auto mt-6 w-full gap-4" id="printableTable">
            <div class="mt-6 w-full">
                <h3 class="font-semibold text-lg mb-4">Summary</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Total Cash Payments</th>
                            <th>Total GCash Payments</th>
                            <th>Overall Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ number_format($totalCash, 2) }}</td>
                            <td>{{ number_format($totalGcash, 2) }}</td>
                            <td>{{ number_format($totalOverall, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-6 w-full">
                <h3 class="font-semibold text-lg mb-4">Detailed Report</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Payment Method</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                        <tr>
                            <td>{{ $log->name }}</td>
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
                    <p>No logs found for the selected period.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    <script>
          function printTable() {
            var printContents = document.getElementById('printableTable').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</x-app-layout>
