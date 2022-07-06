<?php

namespace App\Http\Controllers;

use App\Http\Requests\StayRequest;
use App\Models\Stay;
use Illuminate\Http\Request;

class StayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $stays = Stay::where('user_id', auth()->id())->get()->sortByDesc("created_at");
        return view('pages.stays.index', compact('stays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        return view('pages.stays.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(StayRequest $request)
    {
        $validated = $request->validated();

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/stays/', $filename);
            $validated['image'] = $filename;
        }
        $validated['user_id'] = auth()->id();


        Stay::create($validated);

        return redirect(route('stays.own_index'))->with('success', 'оголошення успішно збережено');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stay  $stay
     * @return \Illuminate\Http\Response
     */
    public function show(Stay $stay)
    {

        return view('pages.stays.show', compact('stay'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stay  $stay
     * @return \Illuminate\Http\Response
     */
    public function edit(Stay $stay)
    {
        return view('pages.stays.edit', compact('stay'));
    }

    /**
     * Update the specified resource in storage.
     *
     *
     */
    public function update(StayRequest $request, Stay $stay)
    {


        $validated = $request->validated();

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/stays/', $filename);
            $validated['image'] = $filename;
        }
        //$validated['user_id'] = auth()->id();


        $stay->update($validated);

        return redirect(route('stays.own_index'))->with('success', 'зміни оголошення успішно збережені');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stay  $stay
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stay $stay)
    {
        Stay::destroy($stay->id);
        return redirect(route('stays.own_index'))->with('success', 'оголошення успішно видалено');
    }
}