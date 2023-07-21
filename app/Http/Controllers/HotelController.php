<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(): View
    {
        $hotels = Hotel::all();
        return view('hotels.index', compact('hotels'));
    }

    public function show(Hotel $hotel):View
    {
        $rooms = $hotel->rooms;
        return view('hotels.show', compact('hotel', 'rooms'));
    }

    /**
     * @param Hotel $hotel
     * @return RedirectResponse
     */
    public function delete(Hotel $hotel): \Illuminate\Http\RedirectResponse
    {
        $hotel->delete();
        return response()->redirectToRoute('hotels.index');
    }

    public function create():View
    {
        return view('hotels.create');
    }
    public function edit(Hotel $hotel){
        return view('hotels.edit', compact('hotel'));
    }

    public function store(Request $request): RedirectResponse
    {
        Hotel::query()->create($request->all());
        return response()->redirectToRoute('hotels.index');
    }
    public function update(Request $request,Hotel $hotel): RedirectResponse
    {
        $hotel->update($request->all());
        return response()->redirectToRoute('hotels.show', ['hotel' => $hotel->id]);
    }
}
