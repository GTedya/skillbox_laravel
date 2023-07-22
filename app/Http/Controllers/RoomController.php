<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoomController extends Controller
{
    public function create(Hotel $hotel): View
    {
        return \view('rooms.create', ['hotel' => $hotel]);
    }

    public function edit(Hotel $hotel, Room $room): View
    {
        return \view('rooms.edit', ['hotel' => $hotel, 'room' => $room]);
    }

    public function store(Request $request, Hotel $hotel): RedirectResponse
    {
        $hotel->rooms()->create($request->input());
        return redirect('hotels/hotels/' . $hotel->id);
    }

    public function delete(int $hotel, int $room): RedirectResponse
    {
        Room::query()->where('id', $room)->first()->delete();
        return redirect('hotels/hotels/' . $hotel);
    }


    public function update(Request $request, Hotel $hotel, Room $room): RedirectResponse
    {
        $room->update($request->all());
        return response()->redirectToRoute('hotels.show', ['hotel' => $hotel->id]);
    }

}
