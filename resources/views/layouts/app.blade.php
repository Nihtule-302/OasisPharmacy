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

    <!-- remove this to get rid of music -->
    <audio id="audioPlayer" controls autoplay preload="auto" loop style= " display: none; ">
        <source src="{{ asset('originalStyle/music/Omar Faruk Tekbilek - Magic Of The Evening (OFFICIAL VIDEO).mp3') }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    
    <!-- -->


    <div class="header">
        <button id="toggleButton" class="button-with-image">
            <img id="audioImage" src="originalStyle/img/music off icon.png" alt="Pause Music">
        </button>
        

        <button id="restartButton" class="button-with-image">
            <img src="originalStyle\img\restart icon off.png" alt="Image">
        </button>

        <style>
            .button-with-image {
                background-color: transparent; /* Make the button transparent */
                border: none; /* Remove any border */
                padding: 0; /* Remove any padding */
                position: relative; /* Ensure relative positioning for the button */
                width: 40px; /* Set the width */
                height: 40px; /* Set the height */
            }

            .button-with-image:focus {
                outline: none;
            }

            .button-with-image img {
                position: absolute; /* Position the image absolutely */
                top: 0;
                left: 0;
                width: 100%; /* Make the image fill the button */
                height: 100%;
            }

        </style>
        <!-- header section strats -->
        <header class="header_section">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container pt-3">

                    <a class="navbar-brand" href="{{ url('/') }}">
                        <span>
                            Oasis Pharmacy
                        </span>
                    </a>

                    

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

                                            <!--modify products -->
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

    <script>
        // Define audioPlayer globally
        var audioPlayer = document.getElementById('audioPlayer');
        var audioImage = document.getElementById('audioImage');

        // Function to toggle the audio playback
        function toggleAudio() {
            if (audioPlayer.paused) {
                audioImage.src = "originalStyle/img/music on icon.png";
                audioImage.alt = "Play Music";
                audioPlayer.play();
            } else {
                audioImage.src = "originalStyle/img/music off icon.png";
                audioImage.alt = "Pause Music";
                audioPlayer.pause();
            }
        }

        function restartAudio() {
            audioPlayer.currentTime = 0;
        }

        // Event listener for the toggle button click
        $('#toggleButton').click(function () {
            toggleAudio();
        });

        $('#restartButton').click(function () {
            restartAudio();
        });

        // Event listener to change button image when audio is playing or paused
        audioPlayer.addEventListener('play', function () {
            audioImage.src = "originalStyle/img/music on icon.png";
            audioImage.alt = "Playing Music";
        });

        audioPlayer.addEventListener('pause', function () {
            audioImage.src = "originalStyle/img/music off icon.png";
            audioImage.alt = "Paused Music";
        });

        // Event listener for AJAX navigation
        $(document).on('click', 'a', function (event) {
            event.preventDefault(); // Prevent default link behavior
            var url = $(this).attr('href'); // Get the URL from the link
            $('#app').load(url + ' #app', function () {
                history.pushState(null, '', url); // Update the URL in the address bar
            });
        });

        // Function to handle visibility change
        function handleVisibilityChange() {
            if (document.hidden) {
                // Page is hidden, pause the music
                audioPlayer.pause();
            } else {
                // Page is visible, play the music if it was playing before
                if (audioPlayer.paused) {
                    audioPlayer.play();
                }
            }
        }

        // Event listener for visibility change
        document.addEventListener('visibilitychange', handleVisibilityChange, false);

        // Event listener for page load
        window.addEventListener('load', function () {
            // Play the audio on page load
            audioPlayer.play();

            // Store the current audio player state in local storage before the page is unloaded
            window.addEventListener('beforeunload', function () {
                localStorage.setItem('audioPlayerState', JSON.stringify({
                    currentTime: audioPlayer.currentTime,
                    paused: audioPlayer.paused
                }));
            });

            // Restore the audio player state after the page is loaded
            var audioPlayerState = localStorage.getItem('audioPlayerState');
            if (audioPlayerState) {
                audioPlayerState = JSON.parse(audioPlayerState);
                audioPlayer.currentTime = audioPlayerState.currentTime;
                if (!audioPlayerState.paused) {
                    audioImage.src = "originalStyle/img/music on icon.png";
                    audioImage.alt = "Play Music";
                    audioPlayer.play();
                }
            }
        });

    </script>


    <script>

        function displayMessage(message, id) {
            var span = document.getElementById(id);
            span.innerHTML = message + "<br>";
            // Set timeout to clear the text after the specified duration
            setTimeout(function() {
                span.innerText = "";
            }, 2000);
        }
        
        $(document).on('submit', 'form.editForm', function(event) {
            event.preventDefault(); // Prevent default form submission behavior
            var formData = $(this).serialize(); // Serialize form data

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                success: function(response) {
                    var url = response; // Get the URL from the link
                    $('#app').load(url + ' #app', function() {
                        history.pushState(null, '', url); // Update the URL in the address bar
                    });

                    setTimeout(function() {
                    displayMessage("Item edited successfully", "edit-message")
                    }, 100);
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(error);
                }
            });
        });

        $(document).on('submit', 'form.addToCartForm', function(event) {
            event.preventDefault(); // Prevent default form submission behavior
            var formData = $(this).serialize(); // Serialize form data

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                success: function(response) {
                    var url = response; // Get the URL from the link
                    $('#app').load(url + ' #app', function() {
                        history.pushState(null, '', url); // Update the URL in the address bar
                    });

                    setTimeout(function() {
                    displayMessage("Item added successfully", "add-to-cart-message")
                    }, 300); // Delay AJAX call by 2 seconds
                },
                error: function(xhr, status, error) {
                    
                    // Handle errors
                    console.error(error);
                }
            });

           
        });

        

        $(document).on('submit', 'form.buyForm', function(event) {
            event.preventDefault(); // Prevent default form submission behavior
            var formData = $(this).serialize(); // Serialize form data

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                success: function(response) {                    
                    var url = response; // Get the URL from the link
                    $('#app').load(url + ' #app', function() {
                        history.pushState(null, '', url); // Update the URL in the address bar
                    });

                    setTimeout(function() {
                    displayMessage("Order Finalized successfully", "buy-message")
                    }, 100);
                    
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(error);
                }
            });
        });

        $(document).on('submit', 'form.addProductForm', function(event) {
            event.preventDefault(); // Prevent default form submission behavior
            var formData = $(this).serialize(); // Serialize form data

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                success: function(response) {
                    displayMessage("Item added successfully", "product-added-message")
                    var url = response; // Get the URL from the link
                    $('#app').load(url + ' #app', function() {
                        history.pushState(null, '', url); // Update the URL in the address bar
                    });
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(error);
                }
            });
        });

        $(document).on('submit', 'form.orderDetialsForm', function(event) {
            event.preventDefault(); // Prevent default form submission behavior
            var formData = $(this).serialize(); // Serialize form data

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                success: function(response) {
                    var url = response; // Get the URL from the link
                    $('#app').load(url + ' #app', function() {
                        history.pushState(null, '', url); // Update the URL in the address bar
                    });
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(error);
                }
            });
        });
        /*
        $(document).on('submit', 'form.loginForm', function(event) {
            event.preventDefault(); // Prevent default form submission behavior
            var formData = $(this).serialize(); // Serialize form data

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                success: function(response) {
                    var url = "{{route('home')}}"; // Get the URL from the link
                    $('#app').load(url + ' #app', function() {
                        history.pushState(null, '', url); // Update the URL in the address bar
                    });
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(error);
                }
            });
        });
        */
        
    </script>



</body>
</html>
