<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

                    <li><a href="{{ url('/') }}" class="link">Home</a></li>
                    @guest
                    <li><a href="{{ url('login') }}" class="link">Sign In/Up</a></li>
                    @endguest
                    <li><a href="{{ url('buy') }}" class="link active">Buy</a></li>
                    @auth
                    <li><a href="{{ url('log_out') }}" class="link">Log Out</a></li>
                    @endauth
                    <li><a href="{{ url('view_profile') }}" class="link">Profile</a></li>

                </ul>
            </div>
        </nav>

        <form action="{{ url('search_bus') }}" method="GET">
            @if (Session::has('msg'))
            <p class="alert alert-success">{{ Session::get('msg') }}</p>
            @endif
            <label for="origin">Origin:</label>
            <input type="text" id="origin" name="starting_point" list="cityList" placeholder="Choose a destinaiton" required>

            <label for="destination">Destination:</label>
            <input type="text" id="destination" name="ending_point" list="cityList" placeholder="Choose a destinaiton" required>

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
            <input type="date" id="depart-date" name="date" required>

            <label for="return-date">Return Date:</label>
            <input type="date" id="return-date" name="return-date">

            <input type="submit" value="Search Bus">
        </form>

    </div>
    <script>
        function myMenuFunction() {
            var i = document.getElementById("navMenu");

            if (i.className === "nav-menu") {
                i.className += " responsive";
            } else {
                i.className = "nav-menu";
            }
        }

    </script>
    <script src="{{ asset('js/homeview.js') }}"></script>
</body>

</html>
