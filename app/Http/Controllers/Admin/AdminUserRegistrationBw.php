<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegistrationBw;
use App\Models\EventBw;
use App\Models\UserBw;
use Illuminate\Http\Request;

class AdminUserRegistrationBw extends Controller
{
    /**
     * Display list of all registrations
     */
    public function index(Request $request)
    {
        // Récupérer toutes les inscriptions avec eager loading des relations
        $query = RegistrationBw::with(['user', 'event.category'])
            ->orderByDesc('created_at');

        // Filtre par utilisateur (nom ou email)
        if ($request->filled('search')) {
            $search = trim($request->get('search'));
            if (!empty($search)) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            }
        }

        // Filtre par événement
        if ($request->filled('event_id')) {
            $eventId = $request->get('event_id');
            $query->where('event_id', $eventId);
        }

        // Paginer les résultats avec pagination préservant les paramètres
        $registrations = $query->paginate(10)->appends($request->query());

        // Récupérer tous les événements pour le dropdown de filtre
        $events = EventBw::orderBy('title')->get();
        
        // Récupérer les statistiques (totaux non filtrés)
        $totalRegistrations = RegistrationBw::count();
        $totalUsers = UserBw::where('role', 'user')->count();

        return view('admin.users.registrations', compact(
            'registrations',
            'events',
            'totalRegistrations',
            'totalUsers'
        ));
    }
}
