<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;

class ScheduleController extends Controller
{
    public function index()
    {
        return response()->json(
            Schedule::all()
        );
    }

    public function show($id)
    {
        $schedule = Schedule::findOrFail($id);

        return response()->json($schedule);
    }

    public function store(StoreScheduleRequest $request)
    {
        $schedule = Schedule::create($request->validated());

        return response()->json($schedule, 201);
    }

    public function update(UpdateScheduleRequest $request, $id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->update($request->validated());

        return response()->json($schedule);
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return response()->json(null, 204);
    }
}
