<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black-800 dark:text-black-200 leading-tight">
            {{ __('Billing') }}
        </h2>
    </x-slot>

    <div class="container-fluid mx-auto py-8 h-screen" style="padding: 0 13%;">
        <div class="container mx-auto mt-6">
            {{-- Search Input --}}
            <div class="flex justify-end items-center mb-6 mt-6 gap-2">
                <form action="{{ route('billing.index') }}" method="GET" class="flex" style="gap:5px;">
                    <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                        class="form-input rounded-md border-gray-300" />
                   
                </form>
            </div>

            {{-- Billing List --}}
            <div class="flex flex-row gap-6">
                <div class="overflow-x-auto w-full h-screen">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($billings as $billing)
                            <tr>
                                <td>{{ $billing->name }}</td>
                                <td>{{ $billing->email }}</td>
                                <td>Php {{ number_format($billing->price, 2) }}</td>
                                <td>
                                    <button class="bg-gray-600 text-black py-1 px-1 rounded-md hover:bg-gray-100" type="button" onclick="openPaymentModal({{ $billing->id }})" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M2 8C2 5.79086 3.79086 4 6 4H18C20.2091 4 22 5.79086 22 8V8.5C22 8.77614 21.7761 9 21.5 9L2.5 9C2.22386 9 2 8.77614 2 8.5V8ZM2.5 11C2.22386 11 2 11.2239 2 11.5V16C2 18.2091 3.79086 20 6 20H18C20.2091 20 22 18.2091 22 16V11.5C22 11.2239 21.7761 11 21.5 11L2.5 11ZM13 15C13 14.4477 13.4477 14 14 14H17C17.5523 14 18 14.4477 18 15C18 15.5523 17.5523 16 17 16H14C13.4477 16 13 15.5523 13 15Z" fill="#000000"></path> </g></svg>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @foreach ($billings as $billing)
    {{-- Payment Modal for each Billing --}}
    <div id="paymentModal_{{ $billing->id }}" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="bg-white p-6">
                <!-- Title -->
                <h2 class="text-lg font-bold text-gray-800">Select Payment Method for {{ $billing->name }}</h2>

                <!-- Payment Options -->
                <div class="mt-4 flex gap-4 items-center">
                    <div>
                        <input type="radio" id="gcash_{{ $billing->id }}" name="payment_method_{{ $billing->id }}" value="gcash" onclick="togglePaymentFields({{ $billing->id }})" />
                        <label for="gcash_{{ $billing->id }}" class="ml-2">GCASH</label>
                    </div>
                    <div>
                        <input type="radio" id="cash_{{ $billing->id }}" name="payment_method_{{ $billing->id }}" value="cash" onclick="togglePaymentFields({{ $billing->id }})" />
                        <label for="cash_{{ $billing->id }}" class="ml-2">Cash</label>
                    </div>
                </div>

                <!-- GCASH Payment Section -->
                <div id="gcashPayment_{{ $billing->id }}" class="hidden mt-4">
                    <label for="gcash_reference_{{ $billing->id }}" class="block text-sm font-medium text-gray-700">GCASH Reference Number:</label>
                    <input type="text" id="gcash_reference_{{ $billing->id }}" class="border rounded p-2 mt-1 block w-full focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <!-- Cash Payment Section -->
                <div id="cashPayment_{{ $billing->id }}" class="hidden mt-4">
                    <label for="cash_amount_{{ $billing->id }}" class="block text-sm font-medium text-gray-700">Cash Amount Given:</label>
                    <input type="number" id="cash_amount_{{ $billing->id }}" class="border rounded p-2 mt-1 block w-full focus:ring-blue-500 focus:border-blue-500" oninput="calculateChange({{ $billing->id }}, {{ $billing->price }})" />
                    <p id="changeAmount_{{ $billing->id }}" class="mt-2 text-green-600 text-sm"></p>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex justify-end gap-2">
                    <button style="background-color: #61a7ff;" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="button" onclick="confirmPayment({{ $billing->id }}, {{ $billing->price }})">
                        Confirm Payment
                    </button>
                    <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600" onclick="closePaymentModal({{ $billing->id }})">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
    @endforeach

    <div id="snackbar" style="display: flex; align-items: center;">
        <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height: 24px; color: #10B981; margin-right: 8px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span id="snackbarMessage"></span> <!-- Placeholder for success message -->
    </div>

    <div id="errorSnackbar" style="display: flex; align-items: center;">
        <svg xmlns="http://www.w3.org/2000/svg" style="width: 24px; height: 24px; color: #DC2626; margin-right: 8px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        <span id="errorSnackbarMessage"></span> <!-- Placeholder for error message -->
    </div>

    {{-- JavaScript --}}
    <script>

        function openPaymentModal(billingId) {
            document.getElementById('paymentModal_' + billingId).classList.remove('hidden');
        }

        function closePaymentModal(billingId) {
            document.getElementById('paymentModal_' + billingId).classList.add('hidden');
        }

        function togglePaymentFields(billingId) {
            const paymentMethod = document.querySelector('input[name="payment_method_' + billingId + '"]:checked').value;

            document.getElementById('gcashPayment_' + billingId).classList.add('hidden');
            document.getElementById('cashPayment_' + billingId).classList.add('hidden');

            if (paymentMethod === 'gcash') {
                document.getElementById('gcashPayment_' + billingId).classList.remove('hidden');
            } else if (paymentMethod === 'cash') {
                document.getElementById('cashPayment_' + billingId).classList.remove('hidden');
            }
        }

        function calculateChange(billingId, totalPrice) {
            const amountGiven = parseFloat(document.getElementById('cash_amount_' + billingId).value);

            if (amountGiven >= totalPrice) {
                const change = amountGiven - totalPrice;
                document.getElementById('changeAmount_' + billingId).innerText = `Change: Php ${change.toFixed(2)}`;
            } else {
                document.getElementById('changeAmount_' + billingId).innerText = `Amount is less than total price`;
            }
        }

        function confirmPayment(billingId, totalPrice) {
            const paymentMethod = document.querySelector('input[name="payment_method_' + billingId + '"]:checked').value;

            if (paymentMethod === 'gcash') {
                const gcashReference = document.getElementById('gcash_reference_' + billingId).value;
                if (!gcashReference) {
                    showErrorSnackbar('Please enter GCASH reference number');
                    return;
                }
            } else if (paymentMethod === 'cash') {
                const cashAmount = parseFloat(document.getElementById('cash_amount_' + billingId).value);
                if (cashAmount < totalPrice) {
                    showErrorSnackbar('Cash amount is less than the total price.');
                    return;
                }
            }

            // Send the request to server to confirm payment and move the row
            fetch(`/billing/${billingId}/confirm`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        billingId,
                        paymentMethod
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showSuccessSnackbar('Payment confirmed, entry moved to logs.');
                        document.getElementById('paymentModal_' + billingId).classList.add('hidden');
                        setTimeout(() => {
                            location.reload(); // Reload the page to reflect changes
                        }, 3000);
                    } else {
                        showErrorSnackbar('Error confirming payment.');
                    }
                });
        }

        function showSuccessSnackbar(message) {
            var x = document.getElementById("snackbar");
            document.getElementById("snackbarMessage").innerText = message; // Set the message
            x.className = "show";
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 3000);
        }

        function showErrorSnackbar(message) {
            var x = document.getElementById("errorSnackbar");
            document.getElementById("errorSnackbarMessage").innerText = message; // Set the message
            x.className = "show";
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 3000);
        }
    </script>
</x-app-layout>