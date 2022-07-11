<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingRequest;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Models\Stay;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function rate (RatingRequest $request, Stay $stay) {

        if ($stay->checkIsUserVoted(auth()->id())) {
            return (redirect(route('stays.show', $stay->id))->withErrors(__("errors.just_one_vote") ));
        }
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        $validated['stay_id'] = $stay->id;

        Rating::create($validated);
        return redirect(route('stays.show', $stay->id))->with("success", 'дякуємо за голосування');
    }
}
