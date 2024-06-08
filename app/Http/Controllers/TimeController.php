<?php

namespace App\Http\Controllers;

use App\Models\Time;
use App\Http\Requests\StoreTimeRequest;
use App\Http\Requests\UpdateTimeRequest;

class TimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $times = Time::active()
            ->orderBy('date', 'desc')
            ->orderBy('week', 'asc')
            ->paginate(10);
        return $times;
        $data = [
            'times' => $times,
            'status' => 200,
        ];
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTimeRequest $request)
    {
        $time = Time::create($request->all());
        if (!$time) {
            $data = [
                'message' => 'Time not found!',
                'status' => 404,
            ];
            return response()->json($data, 404);
        }
        $data = [
            'time' => $time,
            'status' => 201,
        ];
        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Time $time)
    {
        $time = Time::find($time->id);
        if (!$time) {
            $data = [
                'message' => 'Time not found!',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'time' => $time,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTimeRequest $request, Time $time)
    {
        $time = Time::find($time->id);
        if (!$time) {
            $data = [
                'message' => 'Time not found!',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $time->update($request->all());
        $data = [
            'store' => $time,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Time $time)
    {
        $time = Time::find($time->id);
        if (!$time) {
            $data = [
                'message' => 'Time not found!',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $time->delete();
        return response()->json(null, 204);
    }
}
