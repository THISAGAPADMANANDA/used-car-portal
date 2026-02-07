<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Car::query()->where('status', 'active');


        if ($request->filled('make')) {
            $query->where('make', 'like', '%' . $request->make . '%');
        }

        if ($request->filled('model')) {
            $query->where('model', 'like', '%' . $request->model . '%');
        }

        if ($request->filled('year')) {
            $query->where('registration_year', $request->year);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $cars = $query->latest()->paginate(9)->withQueryString();

        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'make' => 'required|string',
            'model' => 'required|string',
            'registration_year' => 'required|integer|min:1900|max:' . date('Y'),
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|min:10',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Addresses security/performance risks [cite: 90]
        ]);

        // Store image in 'public/cars' folder
        $imagePath = $request->file('image')->store('cars', 'public');

        Car::create([
            'user_id' => Auth::id(),
            'make' => $request->make,
            'model' => $request->model,
            'registration_year' => $request->registration_year,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
            'status' => 'active',
        ]);

        return redirect()->route('dashboard')->with('success', 'Car listed successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        $car->load(['bids.user', 'user']);


        $highestBid = $car->bids->max('bid_amount') ?? $car->price;

        return view('cars.show', compact('car', 'highestBid'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function deactivate($id)
    {
        $car = Car::findOrFail($id);

        if (Auth::id() !== $car->user_id && Auth::user()?->role !== 1) {
            abort(403);
        }

        $car->update(['status' => 'deactivated']);
        return back()->with('success', 'Car listing deactivated.');
    }

    public function reactivate($id)
    {
        $car = Car::findOrFail($id);

        if (Auth::id() !== $car->user_id && Auth::user()?->role !== 1) {
            abort(403);
        }

        $car->update(['status' => 'active']);
        return back()->with('success', 'Car listing reactivated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
