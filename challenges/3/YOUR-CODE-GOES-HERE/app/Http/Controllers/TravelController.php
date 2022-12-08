<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use App\Models\TravelEvent;
use Illuminate\Http\Request;


class TravelController extends Controller
{

    public function view($id)
    {
        $travel = Travel::find($id);

        return response(['travel' => $travel]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'passenger_id' => 'required|numeric',
            'driver_id' => 'required|numeric',
            'status' => 'required',
        ]);

        $input = $request->all();
        $driver = Travel::create($input);

        return response(['driver' => $driver]);
    }

    public function cancel(Request $request)
    {
        $this->validate($request, [
            'travel_id' => 'required|numeric',
        ]);

        $driver = new TravelEvent();
        $driver->travel_id = $request->input('travel_id');
        $driver->type = 'CANCEL';
        $driver->save();

        return response(['driver' => $driver]);
    }

    public function passengerOnBoard(Request $request)
    {
        $this->validate($request, [
            'travel_id' => 'required|numeric',
        ]);

        $driver = new TravelEvent();
        $driver->travel_id = $request->input('travel_id');
        $driver->type = 'PASSENGER_ONBOARD';
        $driver->save();

        return response(['driver' => $driver]);
    }

    public function done(Request $request)
    {
        $this->validate($request, [
            'travel_id' => 'required|numeric',
        ]);

        $driver = new TravelEvent();
        $driver->travel_id = $request->input('travel_id');
        $driver->type = 'DONE';
        $driver->save();

        return response(['driver' => $driver]);
    }

    public function take(Request $request)
    {
        $this->validate($request, [
            'travel_id' => 'required|numeric',
        ]);

        $driver = new TravelEvent();
        $driver->travel_id = $request->input('travel_id');
        $driver->type = 'ACCEPT_BY_DRIVER';
        $driver->save();

        return response(['driver' => $driver]);
    }

}
