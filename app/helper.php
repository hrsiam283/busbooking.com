<?php

use App\Models\Bus;
use App\Models\buslist;
use App\Models\Order;

function UpdateSeatInfo(Order $order, Bus $bus)
{
    if (!$bus) {

        return redirect()->back()->with('error', 'Bus not found.');
    }

    $view = $bus->view;
    $ticketlist = json_decode($order->ticketlist, true);

    if (!count($ticketlist)) {
        return view('buyview');
    }


    $newview = $view;
    $checkboxNames = [];
    for ($i = 'A'; $i <= 'J'; $i++) {
        for ($j = 1; $j <= 4; $j++) {
            $checkboxNames[] = $i . $j;
        }
    }
    if (auth()->check()) {
        for ($i = 0; $i < count($checkboxNames); $i++) {
            if (in_array($checkboxNames[$i], $ticketlist)) {
                if ($view[$i] == '1') {
                    echo "Ticket is Booked by others";
                } else {
                    $newview[$i] = '1';
                }
            }
        }
    }
    $bus->view = $newview;
    $seats_available = 0;

    for ($i = 0; $i < strlen($newview); $i++) {
        if ($newview[$i] == '0') {
            $seats_available++;
        }
    }
    $bus->seats_available = $seats_available;
    $bus->save();
    // return view('showdownloadinfo', compact('bus', 'ticketlist'));
}
// IfNotFoundThenCreate function
function IfNotFoundThenCreate($date)
{
    $bus = bus::where('date', $date)->get();
    if ($bus != '[]') {
        // $buses = bus::where('date', $date)
        //     ->where('starting_point', $starting_point)
        //     ->where('ending_point', $ending_point)->get();
        // if ($buses != '[]') {
        //     return view('showbustable', compact('buses'));
        // }
        // Session::flash('msg', 'No Bus Found In This Route');

        // return view('showbustable', compact('buses'));
    } else {
        $bus = buslist::all();
        foreach ($bus as $key => $value) {
            $newbus = new bus();
            $newbus->date = $date;
            $newbus->bus_name = $value->bus_name;
            $newbus->departing_time = $value->departing_time;
            $newbus->coach_no = $value->coach_no;
            $newbus->starting_point = $value->starting_point;
            $newbus->ending_point = $value->ending_point;
            $newbus->fare = $value->fare;
            $newbus->coach_type = $value->coach_type;
            $newbus->seats_available = $value->seats_available;
            $newbus->view = $value->view;
            $newbus->save();
        }
    }
}
