<?php

use App\Models\Bus;
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
