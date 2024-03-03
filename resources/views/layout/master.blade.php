<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/userdashboard.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        /* Add this CSS for the active indicator */
        .side-menu a.active {
            background-color: blue;
            color: white; /* Change text color to white */
        }
        
        /* Add this CSS for the hover effect */
        .side-menu a:hover {
            text-decoration: none; /* Remove the underline */
        }

        /* Light mode styles */
        th,
        td {
            color: black; /* Default color for light mode */
        }

        /* Dark mode styles */
        body.dark th,
        body.dark td {
            color: white; /* Color for dark mode */
        }
    </style>
    <title>KARGADA</title>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <img src="{{asset('img/kargada-logo.png')}}" alt="">
            <div class="logo-name"><span>Kar</span>gada</div>
        </a>
        <ul class="side-menu">
       @auth <h4>Hello! {{ Auth::user()->firstname }} </h4> @endauth
        <li>
    <a href="{{ route('userdashboard') }}" class="{{ Request::is('userdashboard') ? 'active' : '' }}" onclick="handleClick(this)">
        <i class='bx bxs-dashboard'></i>User Dashboard
    </a>
</li>
            <li><a href="{{ route('order') }}" class="{{ Request::is('order') ? 'active' : '' }}" onclick="handleClick(this)"><i class='bx bxs-store-alt'></i>Create Order</a></li>
            <li><a href="{{ route('profile') }}" class="{{ Request::is('profile') ? 'active' : '' }}" onclick="handleClick(this)"><i class='bx bxs-group'></i>User Profile</a></li>
            <li>
    <a href="{{ route('userorderonly') }}" class="{{ Request::is('userorderonly') ? 'active' : '' }}" onclick="handleClick(this)">
    <i class='bx bxs-cart-alt'></i>View Order
    </a>
</li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="{{route('logout')}}" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input" id="search">
                    <input type="search"  placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
        </nav>

        <!-- End of Navbar -->

        <!-- Indicator -->
        <div id="nav-indicator" class="indicator"></div>

        <main>
            @yield('content')
        </main>

    </div>

    <script src="{{ asset('js/userdashboard.js') }}"></script>
    <script>
        // Function to handle click on navlinks
        function handleClick(link) {
            var currentActive = document.querySelector('.side-menu a.active');
            if (currentActive) {
                currentActive.classList.remove('active');
            }
            link.classList.add('active');
        }
    </script>
    
</body>

</html>
