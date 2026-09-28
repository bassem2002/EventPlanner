<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyEventsBw extends Controller
{
    /**
     * Display list of user's registered events
     * 
     * Uses Eloquent relations to fetch all events the current user is registered for.
     * Eager-loads category and creator to prevent N+1 queries.
     * Results are paginated (10 per page) and ordered by event start date (newest first).
     */
    public function index()
    {
        $user = Auth::user();

        // Get all events the user has registered for
        // Using pure Eloquent relations with proper join for ordering
        $registrations = $user->registrations()
            ->with('event.category', 'event.creator')
            ->join('event_bws', 'registration__bws.event_id', '=', 'event_bws.id')
            ->select('registration__bws.*')
            ->orderByDesc('event_bws.start_date')
            ->paginate(10);

        return view('user.my_events', compact('registrations'));
    }
}
