<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Info</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    @auth
        <div class="container mt-4">
            <div class="card bg-info text-white border-info mb-3">
                <div class="card-header"> User Information
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">Name: {{ auth()->user()->name }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Email: {{ auth()->user()->email }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Ticket List:</div>
                        <div class="col-md-9">
                            <ul class="list-unstyled">
                                @php
                                    $totalFare = 0;
                                    $fare = floatval($bus->fare);
                                @endphp
                                @foreach ($ticketlist as $ticket)
                                    @php
                                        $totalFare += $fare;
                                    @endphp
                                    <li>{{ $ticket }} - {{ $bus->fare }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Total Fare: {{ $totalFare }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-4">
            <div class="card bg-info text-white border-info mb-3">
                <div class="col-md-8">
                    <div class="card bg-warning text-dark border-warning mb-3">
                        <div class="card-header"> Bus Information
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">Date: {{ $bus->date }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Coach No: {{ $bus->coach_no }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Bus Name: {{ $bus->bus_name }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Departing Time: {{ $bus->departing_time }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    @endauth
    @guest
        <div class="container mt-4">
            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">Please Login and then Buy a ticket</h4>
                <p>You need to be logged in to view your ticket information.</p>
            </div>
        </div>
    @endguest

    <script src="https://code.jquery.3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
