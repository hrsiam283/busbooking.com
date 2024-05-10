@extends('mainlayout')

@section('content')
    @auth
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Ticket List</th>
                        <th>Total Fare</th>
                        <th>Action</th> <!-- Added Action column for download button -->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ auth()->user()->name }}</td>
                        <td>{{ auth()->user()->email }}</td>
                        <td>
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
                        </td>
                        <td>{{ $totalFare }}</td>
                        <td>
                            <form
                                action="{{ route('downloadTicket', ['busId' => $bus->id, 'ticketlist' => json_encode($ticketlist)]) }}"
                                method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">Download Ticket</button>
                            </form>


                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endauth
    @guest
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">Please Login and then Buy a ticket</h4>
            <p>You need to be logged in to view your ticket information.</p>
        </div>
    @endguest
@endsection
