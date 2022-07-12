<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use App\Models\Feedback;
use App\Models\Stay;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->id();
        $feedbacks_user = Feedback::where('owner_id', $user)->get();
        $feedbacks_owner = Feedback::where('user_id', $user)->get();
        return view('pages.feedbacks.index', compact('feedbacks_user', 'feedbacks_owner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($request)    {
        $stay = Stay::where('id', $request)->first();
        return view('pages.feedbacks.create', compact('stay'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeedbackRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        Feedback::create($validated);
        return redirect(route('stays.show', $validated['stay_id']))->with('success', 'Відгук успішно додано. Дякуємо за ваш відгук!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        dd(__METHOD__);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        return view('pages.feedbacks.edit', compact('feedback'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(FeedbackRequest $request, Feedback $feedback)
    {
        $validated = $request->validated();
        $feedback->update($validated);
        return redirect(route('stays.show', $validated['stay_id']))->with('success', 'Відгук успішно змінено');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        Feedback::destroy($feedback->id);
        return back()->with('success', 'Відгук успішно видалено');
    }
}
