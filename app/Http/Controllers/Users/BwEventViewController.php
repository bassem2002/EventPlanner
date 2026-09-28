<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\EventBw;
use App\Models\RegistrationBw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BwEventViewController extends Controller
{
    /**
     * Display a listing of all published events.
     */
    public function index()
    {
        $events = EventBw::with('category', 'creator')
            ->where('status', 'approved')
            ->orderBy('start_date', 'asc')
            ->paginate(12);

        return view('user.events.index', compact('events'));
    }

    /**
     * Display the specified event detail.
     */
    public function show(string $id)
    {
        $event = EventBw::with('category', 'creator', 'registrations')
            ->findOrFail($id);

        // Check if current user is registered
        $isRegistered = Auth::user() 
            ? RegistrationBw::where('user_id', Auth::id())
                ->where('event_id', $event->id)
                ->exists()
            : false;

        return view('user.events.show', compact('event', 'isRegistered'));
    }

    /**
     * Register the authenticated user for an event.
     * 
     * POST /user/events/{id}/register
     * 
     * Validates user is not already registered, checks event capacity,
     * creates the registration, and redirects to /user/my-events.
     */
    public function register(string $id, Request $request)
    {
        // Fetch event with relations
        $event = EventBw::with('registrations')->findOrFail($id);
        $user = Auth::user();

        // 1️⃣ Check if already registered
        $alreadyRegistered = RegistrationBw::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->exists();

        if ($alreadyRegistered) {
            return redirect()->route('user.my-events')
                ->with('warning', 'Vous êtes déjà inscrit à cet événement.');
        }

        // 2️⃣ Check if event is full (only if capacity is set)
        if ($event->capacity && $event->registrations->count() >= $event->capacity) {
            return redirect()->route('user.events.show', $event->id)
                ->with('error', 'Cet événement est complet. Vous ne pouvez pas vous inscrire.');
        }

        // 3️⃣ Create registration using Eloquent
        try {
            RegistrationBw::create([
                'user_id' => $user->id,
                'event_id' => $event->id,
            ]);

            return redirect()->route('user.my-events')
                ->with('success', 'Inscription confirmée ! Vous êtes maintenant inscrit à : ' . $event->title);
        } catch (\Exception $e) {
            return redirect()->route('user.events.show', $event->id)
                ->with('error', 'Une erreur est survenue lors de votre inscription. Veuillez réessayer.');
        }
    }
}
