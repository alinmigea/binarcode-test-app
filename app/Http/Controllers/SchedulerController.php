<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSchedulerRequest;
use App\Models\Scheduler;
use Illuminate\Http\JsonResponse;

class SchedulerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(Scheduler::all());
    }

    /**
     * Display the specified resource.
     *
     * @param Scheduler $scheduler
     * @return JsonResponse
     */
    public function show(Scheduler $scheduler)
    {
        return response()->json($scheduler);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSchedulerRequest $request
     * @return JsonResponse
     */
    public function store(StoreSchedulerRequest $request)
    {
        Scheduler::create($request->all());

        return response()->json(['message' => 'Scheduler created successfully'], JsonResponse::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Scheduler $scheduler
     * @return JsonResponse
     */
    public function destroy(Scheduler $scheduler)
    {
        $scheduler->delete();

        return response()->json(['message' => 'Scheduler deleted successfully']);
    }
}
