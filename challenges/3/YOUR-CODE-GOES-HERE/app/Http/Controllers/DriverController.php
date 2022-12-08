<?php

namespace App\Http\Controllers;



use App\Models\Driver;
use App\Models\Travel;
use Illuminate\Http\Request;

class DriverController extends Controller
{
	public function signup(Request $request)
	{
        $this->validate($request, [
            'id' => 'required|numeric',
            'car_model' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();
        $driver = Driver::create($input);

        return response(['driver' => $driver]);
	}

	public function update(Request $request, $id)
	{
        $this->validate($request, [

            'latitude' => 'required',
            'longitude' => 'required',

        ]);

        $driver = Driver::find($id);
        $input = $request->all();
        $driver->update($input);

        return response(['driver' => $driver]);
	}

    public function view()
    {
        $driver = Travel::all();

        return response(['driver' => $driver]);
    }
}
