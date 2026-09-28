<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\UserBw;
use App\Models\EventBw;
use App\Models\RegistrationBw;
use Illuminate\Support\Facades\Auth;


class BwRegistrationController extends Controller
{
    // Inscription à un événement
    public function store($eventId)
    {
        $event = EventBw::findOrFail($eventId);

        // Vérifier places disponibles
        if ($event->capacity <= 0) {
            return back()->with('error', 'Plus de places disponibles');
        }

        // Vérifier double inscription
        $exists = RegistrationBw::where('user_id', Auth::id())
                    ->where('event_id', $eventId)
                    ->exists();

        if ($exists) {
            return back()->with('error', 'Vous êtes déjà inscrit');
        }

        // Créer inscription
        RegistrationBw::create([
            'user_id' => Auth::id(),
            'event_id' => $eventId
        ]);

        // Décrémenter capacité
        $event->decrement('capacity');

        return back()->with('success', 'Inscription réussie');
    }

    // Mes inscriptions
    public function myRegistrations()
    {
        $registrations = RegistrationBw::with('event')
            ->where('user_id', Auth::id())
            ->get();

        return view('user.registrations.index', compact('registrations'));
    }

    // Désinscription d'un événement
    public function destroy($id)
    {
        try {
            // Récupérer l'inscription
            $registration = RegistrationBw::findOrFail($id);

            // Vérifier que c'est l'utilisateur connecté qui se désinscrit
            if ($registration->user_id !== Auth::id()) {
                return redirect()->route('user.my-events')
                    ->with('error', 'Vous ne pouvez pas effectuer cette action.');
            }

            // Récupérer l'événement avant suppression
            $event = $registration->event;

            // Supprimer l'inscription
            $registration->delete();

            // Restaurer la capacité de l'événement
            if ($event) {
                $event->increment('capacity');
            }

            return redirect()->route('user.my-events')
                ->with('success', 'Vous avez été désinscrit de cet événement.');
        } catch (\Exception $e) {
            return redirect()->route('user.my-events')
                ->with('error', 'Une erreur est survenue lors de la désinscription.');
        }
    }
}
