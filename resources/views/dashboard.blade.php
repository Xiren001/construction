<x-app-layout>
    <div class="container-fluid mx-auto py-8 h-screen" style="padding: 0 13%;">
        <div class="container mx-auto mt-6">
            @if(session('loggedIn'))
            <!-- Snackbar that shows only when logged in -->
            <div id="snackbar">
                <svg style="width: 24px; height: 24px; color: #10B981; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ __("You're logged in!") }}
            </div>
            @endif
            <div class="divb">
                @if(auth()->user()->usertype !== 'employee')
                <div class="dashboard-box" style="background-color: #0A3247;">
                    <h3><svg fill="#ffffff" width="80px" height="80px" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>employee_group_solid</title> <g id="ad30ea0b-4044-46a8-9d02-5476e64acf86" data-name="Layer 3"> <ellipse cx="18" cy="11.28" rx="4.76" ry="4.7"></ellipse> <path d="M10.78,11.75c.16,0,.32,0,.48,0,0-.15,0-.28,0-.43a6.7,6.7,0,0,1,3.75-6,4.62,4.62,0,1,0-4.21,6.46Z"></path> <path d="M24.76,11.28c0,.15,0,.28,0,.43.16,0,.32,0,.48,0A4.58,4.58,0,1,0,21,5.29,6.7,6.7,0,0,1,24.76,11.28Z"></path> <path d="M22.29,16.45a21.45,21.45,0,0,1,5.71,2,2.71,2.71,0,0,1,.68.53H34V15.56a.72.72,0,0,0-.38-.64,18,18,0,0,0-8.4-2.05l-.66,0A6.66,6.66,0,0,1,22.29,16.45Z"></path> <path d="M6.53,20.92A2.76,2.76,0,0,1,8,18.47a21.45,21.45,0,0,1,5.71-2,6.66,6.66,0,0,1-2.27-3.55l-.66,0a18,18,0,0,0-8.4,2.05.72.72,0,0,0-.38.64V22H6.53Z"></path> <rect x="21.46" y="26.69" width="5.96" height="1.4"></rect> <path d="M32.81,21.26H25.94v-1a1,1,0,0,0-2,0v1H22V18.43A20.17,20.17,0,0,0,18,18a19.27,19.27,0,0,0-9.06,2.22.76.76,0,0,0-.41.68v5.61h7.11v6.09a1,1,0,0,0,1,1H32.81a1,1,0,0,0,1-1V22.26A1,1,0,0,0,32.81,21.26Zm-1,10.36H17.64V23.26h6.3v.91a1,1,0,0,0,2,0v-.91h5.87Z"></path> </g> </g></svg></h3>
                    <p>{{ $employeeCount }}</p>
                </div>
                <div class="dashboard-box" style="background-color: #EBBA5A;">
                    <h3><svg width="75px" height="75px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z" fill="#ffffff"></path> <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z" fill="#ffffff"></path> </g></svg></h3>
                    <p>{{ $clientCount }}</p>
                </div>
                <div class="dashboard-box" style="background-color: #B3456F;">
                    <h3><svg width="75px" height="75px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 15L8 17L12.5 12.5M8 8V5.2C8 4.0799 8 3.51984 8.21799 3.09202C8.40973 2.71569 8.71569 2.40973 9.09202 2.21799C9.51984 2 10.0799 2 11.2 2H18.8C19.9201 2 20.4802 2 20.908 2.21799C21.2843 2.40973 21.5903 2.71569 21.782 3.09202C22 3.51984 22 4.0799 22 5.2V12.8C22 13.9201 22 14.4802 21.782 14.908C21.5903 15.2843 21.2843 15.5903 20.908 15.782C20.4802 16 19.9201 16 18.8 16H16M5.2 22H12.8C13.9201 22 14.4802 22 14.908 21.782C15.2843 21.5903 15.5903 21.2843 15.782 20.908C16 20.4802 16 19.9201 16 18.8V11.2C16 10.0799 16 9.51984 15.782 9.09202C15.5903 8.71569 15.2843 8.40973 14.908 8.21799C14.4802 8 13.9201 8 12.8 8H5.2C4.0799 8 3.51984 8 3.09202 8.21799C2.71569 8.40973 2.40973 8.71569 2.21799 9.09202C2 9.51984 2 10.0799 2 11.2V18.8C2 19.9201 2 20.4802 2.21799 20.908C2.40973 21.2843 2.71569 21.5903 3.09202 21.782C3.51984 22 4.07989 22 5.2 22Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></h3>
                    <p>{{ $completedCount }}</p>
                </div>
                <div class="dashboard-box" style="background-color: #A1C76E;">
                    <h3><svg fill="#ffffff" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="75px" height="75px" viewBox="0 0 16 16" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path id="canceled-circle-a" d="M8,15 C4.13400675,15 1,11.8659932 1,8 C1,4.13400675 4.13400675,1 8,1 C11.8659932,1 15,4.13400675 15,8 C15,11.8659932 11.8659932,15 8,15 Z M8,13 C10.7614237,13 13,10.7614237 13,8 C13,5.23857625 10.7614237,3 8,3 C5.23857625,3 3,5.23857625 3,8 C3,10.7614237 5.23857625,13 8,13 Z M9.59090909,10.8636364 L5.13636364,6.40909091 C4.95454545,6.22727273 4.95454545,5.95454545 5.13636364,5.77272727 L5.77272727,5.13636364 C5.95454545,4.95454545 6.22727273,4.95454545 6.40909091,5.13636364 L10.8636364,9.59090909 C11.0454545,9.77272727 11.0454545,10.0454545 10.8636364,10.2272727 L10.2272727,10.8636364 C10.0454545,11.0454545 9.77272727,11.0454545 9.59090909,10.8636364 Z"></path> </g></svg></h3>
                    <p>{{ $canceledCount }}</p>
                </div>
                @endif

                @if(auth()->user()->usertype !== 'admin')
                <div class="dashboard-box" style="background-color: #0A3247;">
                    <h3><svg fill="#ffffff" width="80px" height="80px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M28.5,68.5v-34H26.9a4.89,4.89,0,0,0-4.8,4.9V74.8a4.89,4.89,0,0,0,4.8,4.9H62.5a4.89,4.89,0,0,0,4.8-4.9V73.4h-34A4.89,4.89,0,0,1,28.5,68.5Z"></path><path d="M46.4,30.2H64.1a1.58,1.58,0,0,0,1.6-1.6V25.3a4.89,4.89,0,0,0-4.8-4.9H49.6a4.82,4.82,0,0,0-4.8,4.9v3.3A1.64,1.64,0,0,0,46.4,30.2Z"></path><path d="M73,24.4H71.4a.74.74,0,0,0-.8.8v3.3a6.57,6.57,0,0,1-6.5,6.6H46.4a6.64,6.64,0,0,1-6.5-6.6V25.2a.74.74,0,0,0-.8-.8H37.5a4.82,4.82,0,0,0-4.8,4.9V64.6a4.89,4.89,0,0,0,4.8,4.9H73a4.82,4.82,0,0,0,4.8-4.9V29.4A4.85,4.85,0,0,0,73,24.4ZM60.9,55.5a1.58,1.58,0,0,1-1.6,1.6H43.1a1.58,1.58,0,0,1-1.6-1.6V53.9a1.58,1.58,0,0,1,1.6-1.6H59.3a1.58,1.58,0,0,1,1.6,1.6ZM69,47.3a1.58,1.58,0,0,1-1.6,1.6H43.1a1.58,1.58,0,0,1-1.6-1.6V45.7a1.58,1.58,0,0,1,1.6-1.6H67.4A1.58,1.58,0,0,1,69,45.7Z"></path></g></svg></h3>
                    <p>{{ $workloadCount }}</p>
                </div>
                @endif
            </div>

        </div>
    </div>

    <style>
        .divb {
            display: flex;
            flex-direction: row;
            gap: 2rem;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .dashboard-box {
            width: 500px;
            height: 200px;
            border-radius: 10px;
            display: flex;
            flex-direction: row;
            gap: 1rem;
            justify-content: center;
            align-items: center;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        .dashboard-box h3 { 
            font-size: 1.5rem;
            color: white;
        }
        .dashboard-box p  { 
            font-size: 4rem;
            color: white;
            font-weight: bolder;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const snackbar = document.getElementById('snackbar');

            if (snackbar) {
                // Automatically hide the snackbar after 3 seconds
                setTimeout(function() {
                    snackbar.style.opacity = '0';
                    snackbar.style.transition = 'opacity 1s';
                    setTimeout(function() {
                        snackbar.remove(); // Remove from DOM after fading out
                    }, 3000);
                }, 3000); // Display the snackbar for 3 seconds
            }
        });
    </script>
</x-app-layout>