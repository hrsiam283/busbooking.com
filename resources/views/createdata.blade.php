<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/createdata.css') }}">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <a href="{{ url('showdata') }}" class="link">Show Data</a>

        <h2>Add Bus Information</h2>
        <form action="{{ url('storedata') }}" method="POST">
            @csrf
            <label for="bus_name">Bus Name:</label><br>
            <input type="text" id="bus_name" name="bus_name"><br><br>

            <label for="departing_time">Departing Time:</label><br>
            <input type="time" id="departing_time" name="departing_time"><br><br>

            <label for="coach_no">Coach Number:</label><br>
            <input type="text" id="coach_no" name="coach_no"><br><br>

            <label for="starting_point">Starting Point:</label><br>
            <input type="text" id="starting_point" name="starting_point" list="cityList"><br><br>

            <label for="ending_point">Ending Point:</label><br>
            <input type="text" id="ending_point" name="ending_point" list="cityList"><br><br>

            <label for="fare">Fare:</label><br>
            <input type="number" id="fare" name="fare" step="0.01" min="0" max="9999999.99"
                title="Please enter a valid fare amount" required><br><br>


            <label for="coach_type">Coach Type:</label><br>
            <select id="coach_type" name="coach_type">
                <option value="AC">AC</option>
                <option value="Non-AC">Non-AC</option>
            </select><br><br>


            <label for="seats_available" style="display: none;">Seats Available:</label><br>
            <input type="hidden" id="seats_available" name="seats_available" value="40">


            <<label for="view" style="display: none;">View:</label><br>
                <input type="hidden" id="view" name="view" value="0000000000000000000000000000000000000000">


                <!-- Datalist for starting point -->
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

                <input type="submit" value="Submit">
        </form>

    </div>
    <script>
        (function (window, document) {
            var loader = function () {
                var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
        })(window, document);
    </script>
</body>

</html>