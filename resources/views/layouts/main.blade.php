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
                    <a href="#"></a>
                    <a href="#"></a>
                    <a href="#"></a>
                    <a href="#"></a>
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