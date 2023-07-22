<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Carbon\Carbon as CarbonAlias;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(): View
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->is_admin) {
            $bookings = Booking::query()->where('user_id', Auth::id())->get();
        } else {
            $bookings = Booking::all();
        }
        return view('bookings.index', compact('bookings'));
    }

    public function store(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $data = $request->all();


        $data['started_at'] = Carbon::create($data['started_at'])->format('Y-m-d');
        $data['finished_at'] = Carbon::create($data['finished_at'])->format('Y-m-d');
        $data['days'] = Carbon::create($data['started_at'])->diffInDays($data['finished_at']);
        /** @var Room $room */
        $room = Room::query()->where('id', $data['room_id'])->first();
        $data['price'] = $data['days'] * $room->price;

        $user->bookings()->create($data);
        return response()->redirectToRoute('bookings.index');
    }

    public function show(Booking $booking): View
    {
        return \view('bookings.show', ['booking' => $booking]);
    }

    public function delete(Booking $booking): RedirectResponse
    {
        $booking->delete();
        return response()->redirectToRoute('bookings.index');
    }

    public function edit(Booking $booking): View
    {
        return \view('bookings.edit', ['bookings' => $booking]);
    }

    public function update(Booking $booking, Request $request): RedirectResponse
    {
        $data = $request->all();
        $data['started_at'] = CarbonAlias::createFromFormat('Y-m-d', $data['start_date']);
        $data['finished_at'] = CarbonAlias::createFromFormat('Y-m-d', $data['end_date']);
        $data['days'] = date_diff($data['started_at'], $data['finished_at'])->days;

        $data['price'] = $data['days'] * $booking->room->price;
        $booking->update($data);
        return response()->redirectToRoute('bookings.show', ['booking' => $booking]);
    }

}
