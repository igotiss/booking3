<?php

namespace App\Http\Controllers\Api;

use App\Models\Stay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\StayRequest;

use App\Http\Resources\StayResource;




class StayApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return StayResource::collection(Stay::orderBy('created_at', 'desc')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StayRequest $request)
    {
        $stay = Stay::create($request->validated());

        return new StayResource($stay);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stay  $stay
     * @return \Illuminate\Http\Response
     */
    public function show(Stay $stay)
    {
        return new StayResource($stay);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stay  $stay
     * @return \Illuminate\Http\Response
     */
    public function update(StayRequest $request, Stay $stay)
    {
        $stay->update($request->validated());

        return new StayResource($stay);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stay  $stay
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stay $stay)
    {
        $stay->delete();

        return response()->noContent();
    }
}
