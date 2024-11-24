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
                                <th>Workload ID</th>
                                <th>Checklist</th>
                                <th>Photo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($completedWorks as $completedWork)
                            <tr>
                                <td>{{ $completedWork->workload_id }}</td>
                                <td>
                                    <ul>
                                        @foreach (json_decode($completedWork->checklist, true) as $item => $status)
                                        <li>{{ ucfirst($item) }}: {{ $status ? '✔️' : '❌' }}</li>
                                        <br>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <img 
                                        src="{{ asset('storage/' . $completedWork->photo) }}" 
                                        alt="Photo" 
                                        class="thumbnail" 
                                        onclick="openModal('{{ asset('storage/' . $completedWork->photo) }}')">
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-4 text-center text-sm text-gray-500">No completed works found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="imageModal" class="modal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeModal()">×</button>
            <img id="modalImage" src="" alt="Full Size Image">
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function openModal(imageSrc) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            modalImage.src = imageSrc;
            modal.style.display = "flex";
        }

        function closeModal() {
            const modal = document.getElementById('imageModal');
            modal.style.display = "none";
        }
    </script>

    <style>
        /* Modal Styling */
.modal {
    display: none; /* Hidden by default */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8); /* Darkened background */
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal-content {
    position: relative;
    background: #fff; /* White background for image container */
    padding: 10px;
    border-radius: 8px;
    max-width: 90%;
    max-height: 90%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-content img {
    max-width: 100%;
    max-height: 100%;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
}

.close-btn {
    position: absolute;
    top: -10px;
    right: -10px;
    background: #000;
    color: #fff;
    border: none;
    font-size: 20px;
    cursor: pointer;
    padding: 5px 10px;
    border-radius: 50%;
}

.thumbnail {
    cursor: pointer;
    max-width: 100px;
    border: 1px solid #ccc;
    border-radius: 4px;
    transition: transform 0.2s ease-in-out;
}

.thumbnail:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

    </style>

</x-app-layout>
