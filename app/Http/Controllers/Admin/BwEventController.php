<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventBw;
use App\Models\CategoryBw;
use Illuminate\Http\Request;

class BwEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = EventBw::with('category', 'creator')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryBw::all();
        return view('admin.events.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'place' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'is_free' => 'boolean',
            'capacity' => 'required|integer|min:1',
            'category_id' => 'required|exists:category_bws,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // 2MB max
        ]);

        // Préparer les données
        $eventData = [
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'place' => $request->place,
            'price' => $request->price,
            'is_free' => $request->is_free ?? false,
            'capacity' => $request->capacity,
            'category_id' => $request->category_id,
            'created_by' => 1,
            'status' => 'pending',
        ];

        // Gérer l'upload d'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
            $eventData['image'] = $imagePath;
        }

        EventBw::create($eventData);

        return redirect()->route('admin.events.index')->with('success', 'Événement créé avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = EventBw::findOrFail($id);
        $categories = CategoryBw::all();
        return view('admin.events.edit', compact('event', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $event = EventBw::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'place' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'is_free' => 'boolean',
            'capacity' => 'required|integer|min:1',
            'category_id' => 'required|exists:category_bws,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // 2MB max
        ]);

        // Préparer les données
        $eventData = [
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'place' => $request->place,
            'price' => $request->price,
            'is_free' => $request->is_free ?? false,
            'capacity' => $request->capacity,
            'category_id' => $request->category_id,
        ];

        // Gérer l'upload d'image (optionnel lors de la modification)
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($event->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($event->image)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($event->image);
            }
            
            // Stocker la nouvelle image
            $imagePath = $request->file('image')->store('events', 'public');
            $eventData['image'] = $imagePath;
        }

        $event->update($eventData);

        return redirect()->route('admin.events.index')->with('success', 'Événement mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = EventBw::findOrFail($id);
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Événement supprimé avec succès');
    }
}
