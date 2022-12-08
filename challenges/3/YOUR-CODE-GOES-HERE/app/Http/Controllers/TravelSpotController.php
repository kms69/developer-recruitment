<?php

namespace App\Http\Controllers;

use App\Models\TravelEvent;
use App\Models\TravelSpot;
use Illuminate\Http\Request;

class TravelSpotController extends Controller
{

    public function view($id)
    {
        $travel = TravelSpot::find($id);

        return response(['travel' => $travel]);
    }

    public function arrived(Request $request)
    {
        $this->validate($request, [
            'travel_id' => 'required',

        ]);

        $driver = TravelEvent::find($request->input('travel_id'));
        $driver->type = 'DONE';
        $driver->update();

        return response(['driver' => $driver]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'travel_id' => 'required|numeric',
            'latitude' => 'required',
            'longitude' => 'required',
            'position' => 'required',
        ]);


        $input = $request->all();
        $travel = TravelSpot::create($input);

        return response(['travel' => $travel]);
    }

    public function destroy($id)
    {
        $spots = TravelSpot::find($id);
        $spots->delete();

        return response(['message' => 'Spot Deleted successfully.']);
    }
}
