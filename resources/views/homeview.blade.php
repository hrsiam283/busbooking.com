<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homeview.css') }}">
    <title>Ludiflex | Login & Registration</title>
    <style>
        body {
            background: url("{{ asset('images/1.jpg') }}") no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }

        .link {
            text-decoration: none;
            color: #ffffff;
        }

        .link.active {
            text-decoration: underline;
        }

        /* Dropdown container */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 120px;
            /* Adjust width here */
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            right: 0;
            padding: 5px 0;
            border-radius: 5px;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: black;
            padding: 8px 10px;
            /* Adjust padding here */
            text-decoration: none;
            display: block;
            font-size: 14px;
            /* Adjust font size here */
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        /* Show the dropdown menu on click */
        .dropdown.active .dropdown-content {
            display: block;
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <nav class="nav">
            <div class="nav-logo">
                <p>busbooking.com</p>
            </div>
            <div class="nav-menu" id="navMenu">
                <ul>
                    <li><a href="{{ url('/') }}" class="link active">Home</a></li>
                    @guest
                        <li><a href="{{ url('login') }}" class="link">Sign In/Up</a></li>
                    @endguest
                    <li><a href="{{ url('buy') }}" class="link">Buy</a></li>
                    <li><a href="{{ url('about') }}" class="link">About</a></li>
                    <li><a href="{{ url('view_profile') }}" class="link">Profile</a></li>
                    <!-- Profile Dropdown -->
                    {{-- <li class="dropdown" id="profileDropdown">
                        <a href="#" class="link" onclick="toggleDropdown(event)">Profile</a>
                        <div class="dropdown-content">
                            @auth
                                <a href="{{ url('view_profile') }}">View Profile</a>
                                <a href="{{ url('edit_profile') }}">Edit Profile</a>
                                <a href="{{ 'log_out' }}">Log Out</a>
                            @else
                                <a href="{{ 'login' }}">SignIn/Up</a>
                            @endauth





                        </div>

                    </li> --}}
                    <!-- End Profile Dropdown -->
                </ul>
            </div>
        </nav>
        <form action="search.php" method="GET">
            <label for="origin">Origin:</label>
            <input type="text" id="origin" name="origin" list="cityList" placeholder="Choose a destinaiton"
                required>

            <label for="destination">Destination:</label>
            <input type="text" id="destination" name="destination" list="cityList" placeholder="Choose a destinaiton"
                required>

            <datalist id="cityList">
                <option value="Barishal">
                <option value="Chattogram">
                <option value="Dhaka">
                <option value="Khulna">
                <option value="Rajshahi">
                <option value="Rangpur">
                <option value="Mymensingh">
                <option value="Sylhet">
            </datalist>

            <label for="depart-date">Departure Date:</label>
            <input type="date" id="depart-date" name="depart-date" required>

            <label for="return-date">Return Date:</label>
            <input type="date" id="return-date" name="return-date">

            <input type="submit" value="Search Bus">
        </form>

    </div>
    <script>
        function toggleDropdown(event) {
            event.preventDefault();
            var dropdown = event.target.parentNode;
            dropdown.classList.toggle("active");
        }

        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.link')) {
                var dropdowns = document.getElementsByClassName("dropdown");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('active')) {
                        openDropdown.classList.remove('active');
                    }
                }
            }
        }
    </script>
    <script src="{{ asset('js/homeview.js') }}"></script>
</body>

</html>
