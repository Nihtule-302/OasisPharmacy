<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Oasis Pharmacy</title>

    <!-- Template -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('styleTemplate/css/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('styleTemplate/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('styleTemplate/css/responsive.css') }}" />
    <link rel="stylesheet" href="{{ asset('originalStyle/css/style.css') }}" />

    <!-- Additional links for debugging or development -->
    <link rel="stylesheet" href="{{ asset('styleTemplate/css/style.css.map') }}" />
    <link rel="stylesheet" href="{{ asset('styleTemplate/css/style.scss') }}" />

</head>

<body class="sub_page">
    <div class="header">
        <!-- header section strats -->
        <header class="header_section">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container pt-3">

                    <a class="navbar-brand" href="{{ url('/') }}">
                        <span>
                            Oasis Pharmacy
                        </span>
                    </a>

                    <audio id="audioPlayer" controls  autoplay>
                        <source src="{{ asset('originalStyle/music/Omar Faruk Tekbilek - Magic Of The Evening (OFFICIAL VIDEO).mp3') }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
                            <ul class="navbar-nav  ">

                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('cart') }}"> Cart </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('view-products') }}"> Products </a>
                                </li>

                                @auth
                                    @if(Auth::user()->role == 'admin')
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('viewOrders') }}"> View Orders </a>
                                        </li>

                                        <li class="nav-item dropdown">
                                            <a
                                                data-mdb-dropdown-init
                                                class="nav-link dropdown-toggle"
                                                id="navbarDropdownMenuLink"
                                                role="button"
                                                aria-expanded="false"
                                            >
                                                Product Managment
                                            </a>

                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('add-products') }}">Add Product</a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item" href="{{ route('modify-products') }}">Modify Products</a>
                                                </li>

                                            </ul>

                                        </li>


                                    @endif
                                @endauth


                                <li class="nav-item">
                                    @guest
                                        @if (Route::has('login'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                            </li>
                                        @endif

                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                            </li>
                                        @endif
                                    @else
                                        <li class="nav-item dropdown">
                                            <a
                                                data-mdb-dropdown-init
                                                class="nav-link dropdown-toggle"
                                                id="navbarDropdownMenuLink"
                                                role="button"
                                                aria-expanded="false"
                                            >
                                                {{ Auth::user()->name }}
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                        {{ __('Logout') }}
                                                    </a>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                                </li>
                                            </ul>
                                        </li>
                                    @endguest
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <!-- end header section -->
    </div>
    <!-- end hero area -->

    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Custom scripts -->
    <script type="text/javascript" src="{{ asset('styleTemplate/js/jquery-3.4.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('styleTemplate/js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('style/js/mdb.umd.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('styleTemplate/js/custom.js') }}"></script>

    <!-- JavaScript for AJAX navigation -->
    <script>
        $(document).on('click', 'a', function(event) {
            event.preventDefault(); // Prevent default link behavior
            var url = $(this).attr('href'); // Get the URL from the link
            $('#app').load(url + ' #app', function() {
                history.pushState(null, '', url); // Update the URL in the address bar
            });
        });

        // JavaScript code to control the audio player
        var audioPlayer = document.getElementById('audioPlayer');
        // Play the audio automatically when the page loads
        window.addEventListener('load', function() {
            audioPlayer.play();
        });

        // Store the current audio player state in local storage before the page is unloaded
        window.addEventListener('beforeunload', function() {
            localStorage.setItem('audioPlayerState', JSON.stringify({
                currentTime: audioPlayer.currentTime,
                paused: audioPlayer.paused
            }));
        });

        // Restore the audio player state after the page is loaded
        window.addEventListener('load', function() {
            var audioPlayerState = localStorage.getItem('audioPlayerState');
            if (audioPlayerState) {
                audioPlayerState = JSON.parse(audioPlayerState);
                audioPlayer.currentTime = audioPlayerState.currentTime;
                if (!audioPlayerState.paused) {
                    audioPlayer.play();
                }
            }
        });

    </script>

</body>
</html>
