<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ground Work</title>
    <link rel="icon" href="{{ asset('assets/image/logo.png') }}" type="image/x-icon">
    <link href=" {{ asset('assets/css/styles.css') }}" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body class="container-fluid">
    <div class="nav-div container-fluid" data-aos="fade-down" data-aos-duration="2000">
        <nav>
            <ul class="sidebar">
                <li onclick=hideSidebar() class="xbtn">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26">
                            <path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z" />
                        </svg>
                    </a>
                </li>
                <li><a href="#">About</a></li>
                <li><a href="#">Service</a></li>
                <li><a href="#">Location</a></li>
                <li><a href="#">Contact</a></li>
                @if (Route::has('login'))
                @auth
                @if (Auth::user()->usertype !== 'user')
                <li class="login-btn"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                @endif
                @if (Auth::user()->usertype === 'user')
                <form method="POST" action="{{ route('logout') }}" style="width: 100%; padding:1rem;">
                    @csrf
                    <x-responsive-nav-link class="login-btn" :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();" style="display:flex; justify-content:center; align-items:center;">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
                @endif
                @else
                <li class=""><a href="{{ route('login') }}">Sign in</a></li>
                @if (Route::has('register'))
                <li class="login-btn"><a href="{{ route('register') }}">Sign up</a></li>
                @endif
                @endauth
                @endif
            </ul>
            <ul>
                <li>
                    <a href="{{ route('landingpage') }}">
                        <img class="logo" src="{{ asset('assets/image/logo-c.png') }}" width="90" alt="Logo">
                    </a>
                </li>
                <li class="hideOnMobile li"><a href="#">About</a></li>
                <li class="hideOnMobile li">
                    <a href="#" class="ser-hover">Service&nbsp;
                        <svg width="15px" height="15px" viewBox="0 0 24 24" fill="#ffffff" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M5.70711 9.71069C5.31658 10.1012 5.31658 10.7344 5.70711 11.1249L10.5993 16.0123C11.3805 16.7927 12.6463 16.7924 13.4271 16.0117L18.3174 11.1213C18.708 10.7308 18.708 10.0976 18.3174 9.70708C17.9269 9.31655 17.2937 9.31655 16.9032 9.70708L12.7176 13.8927C12.3271 14.2833 11.6939 14.2832 11.3034 13.8927L7.12132 9.71069C6.7308 9.32016 6.09763 9.32016 5.70711 9.71069Z" fill="#0F0F0F"></path>
                            </g>
                        </svg>
                    </a>

                </li>
                <li class="hideOnMobile li"><a href="#">Location</a></li>
                <li class="hideOnMobile li"><a href="#">Contact</a></li>
                @if (Route::has('login'))
                @auth
                @if (Auth::user()->usertype !== 'user')
                <li class="hideOnMobile login-btn"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                @endif
                @if (Auth::user()->usertype === 'user')
                <form class="hideOnMobile login-btn" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
                @endif
                @else
                <li class="hideOnMobile li"><a href="{{ route('login') }}">Sign in</a></li>
                @if (Route::has('register'))
                <li class="hideOnMobile login-btn"><a href="{{ route('register') }}">Sign up</a></li>
                @endif
                @endauth
                @endif
                <li class="menu-button" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26">
                            <path d="M120 816v-60h720v60H120Zm0-210v-60h720v60H120Zm0-210v-60h720v60H120Z" />
                        </svg></a></li>
            </ul>
        </nav>
    </div>

    @yield('mainContent')
    @yield('appointment')



    <footer class="footer">
        <div class="roww" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
            <div class="footer-col">
                <img class="logo" src="{{ asset('assets/image/logo-c.png') }}" width="150" alt="Maxino Dental Clinic Logo">
            </div>
            <div class="footer-col">
                <h4>Useful Links</h4>
                <ul>
                    <li><a href="#">about us</a></li>
                    <li><a href="#top">our services</a></li>
                    <li><a href="#">privacy policy</a></li>
                    <li><a href="#">location</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Business Hours</h4>
                <ul style="display: flex; flex-direction:row; gap:2rem;">
                    <div style="display: flex; flex-direction:column;">
                        <li>monday</li>
                        <li>teusday</li>
                        <li>wednesday</li>
                        <li>thursday</li>
                        <li>friday</li>
                        <li>saturday</li>
                        <li>sunday</li>
                    </div>
                    <div style="display: flex; flex-direction:column; align-items:flex-end;">
                        <li>09:00 - 19:00</li>
                        <li>09:00 - 19:00</li>
                        <li>09:00 - 19:00</li>
                        <li>09:00 - 19:00</li>
                        <li>09:00 - 19:00</li>
                        <li>09:00 - 19:00</li>
                        <li>CLOSED</li>
                    </div>
                </ul>
            </div>
            <div class="footer-col">
                <h4>follow us</h4>
                <div class="social-links">
                    <a href="https://www.facebook.com/maxinodentalclinic"><svg width="20px" height="20px" viewBox="-5 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>facebook [#176]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-385.000000, -7399.000000)" fill="#000000"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M335.821282,7259 L335.821282,7250 L338.553693,7250 L339,7246 L335.821282,7246 L335.821282,7244.052 C335.821282,7243.022 335.847593,7242 337.286884,7242 L338.744689,7242 L338.744689,7239.14 C338.744689,7239.097 337.492497,7239 336.225687,7239 C333.580004,7239 331.923407,7240.657 331.923407,7243.7 L331.923407,7246 L329,7246 L329,7250 L331.923407,7250 L331.923407,7259 L335.821282,7259 Z" id="facebook-[#176]"> </path> </g> </g> </g> </g></svg></a>
                    <a href="#"><svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12 18C15.3137 18 18 15.3137 18 12C18 8.68629 15.3137 6 12 6C8.68629 6 6 8.68629 6 12C6 15.3137 8.68629 18 12 18ZM12 16C14.2091 16 16 14.2091 16 12C16 9.79086 14.2091 8 12 8C9.79086 8 8 9.79086 8 12C8 14.2091 9.79086 16 12 16Z" fill="#0F0F0F"></path> <path d="M18 5C17.4477 5 17 5.44772 17 6C17 6.55228 17.4477 7 18 7C18.5523 7 19 6.55228 19 6C19 5.44772 18.5523 5 18 5Z" fill="#0F0F0F"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M1.65396 4.27606C1 5.55953 1 7.23969 1 10.6V13.4C1 16.7603 1 18.4405 1.65396 19.7239C2.2292 20.8529 3.14708 21.7708 4.27606 22.346C5.55953 23 7.23969 23 10.6 23H13.4C16.7603 23 18.4405 23 19.7239 22.346C20.8529 21.7708 21.7708 20.8529 22.346 19.7239C23 18.4405 23 16.7603 23 13.4V10.6C23 7.23969 23 5.55953 22.346 4.27606C21.7708 3.14708 20.8529 2.2292 19.7239 1.65396C18.4405 1 16.7603 1 13.4 1H10.6C7.23969 1 5.55953 1 4.27606 1.65396C3.14708 2.2292 2.2292 3.14708 1.65396 4.27606ZM13.4 3H10.6C8.88684 3 7.72225 3.00156 6.82208 3.0751C5.94524 3.14674 5.49684 3.27659 5.18404 3.43597C4.43139 3.81947 3.81947 4.43139 3.43597 5.18404C3.27659 5.49684 3.14674 5.94524 3.0751 6.82208C3.00156 7.72225 3 8.88684 3 10.6V13.4C3 15.1132 3.00156 16.2777 3.0751 17.1779C3.14674 18.0548 3.27659 18.5032 3.43597 18.816C3.81947 19.5686 4.43139 20.1805 5.18404 20.564C5.49684 20.7234 5.94524 20.8533 6.82208 20.9249C7.72225 20.9984 8.88684 21 10.6 21H13.4C15.1132 21 16.2777 20.9984 17.1779 20.9249C18.0548 20.8533 18.5032 20.7234 18.816 20.564C19.5686 20.1805 20.1805 19.5686 20.564 18.816C20.7234 18.5032 20.8533 18.0548 20.9249 17.1779C20.9984 16.2777 21 15.1132 21 13.4V10.6C21 8.88684 20.9984 7.72225 20.9249 6.82208C20.8533 5.94524 20.7234 5.49684 20.564 5.18404C20.1805 4.43139 19.5686 3.81947 18.816 3.43597C18.5032 3.27659 18.0548 3.14674 17.1779 3.0751C16.2777 3.00156 15.1132 3 13.4 3Z" fill="#0F0F0F"></path> </g></svg></a>
                    <a href="#"><svg fill="#000000" width="20px" height="20px" viewBox="0 0 24 24" id="tiktok" data-name="Flat Color" xmlns="http://www.w3.org/2000/svg" class="icon flat-color"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path id="primary" d="M21,7V9a1,1,0,0,1-1,1,8,8,0,0,1-4-1.08V15.5A6.5,6.5,0,1,1,6.53,9.72a1,1,0,0,1,1.47.9v2.52a.92.92,0,0,1-.28.62,2.49,2.49,0,0,0,2,4.23A2.61,2.61,0,0,0,12,15.35V3a1,1,0,0,1,1-1h2.11a1,1,0,0,1,1,.83A4,4,0,0,0,20,6,1,1,0,0,1,21,7Z" style="fill: #000000;"></path></g></svg></a>
                    <a href="#"><svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 7.00005L10.2 11.65C11.2667 12.45 12.7333 12.45 13.8 11.65L20 7" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <rect x="3" y="5" width="18" height="14" rx="2" stroke="#000000" stroke-width="2" stroke-linecap="round"></rect> </g></svg></a>
                </div>
            </div>
        </div>

    </footer>



    <script>
        function showSidebar() {
            const sidebar = document.querySelector('.sidebar')
            sidebar.style.display = 'flex'
        }

        function hideSidebar() {
            const sidebar = document.querySelector('.sidebar')
            sidebar.style.display = 'none'
        }

        document.addEventListener('DOMContentLoaded', function() {
            const bookAppointmentBtn = document.getElementById('book-appointment');
            const isAuthenticated = @json(auth() -> check());
            bookAppointmentBtn.addEventListener('click', function(event) {
                event.preventDefault();

                if (!isAuthenticated) {
                    window.location.href = '{{ route('login') }}';
                } else {
                    window.location.href = '/book-appointment';
                }
            });
        });

        document.querySelector('.ser-hover').addEventListener('mouseenter', function() {
            document.querySelector('.service-hover').style.display = 'block';
        });

        document.querySelector('.ser-hover').addEventListener('mouseleave', function() {
            document.querySelector('.service-hover').style.display = 'none';
        });

        document.querySelector('.service-hover').addEventListener('mouseenter', function() {
            this.style.display = 'block'; 
        });

        document.querySelector('.service-hover').addEventListener('mouseleave', function() {
            this.style.display = 'none';
        });
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>