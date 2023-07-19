<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(): View
    {
        $bookings = Booking::query()->where('user_id', Auth::id())->get();
        return view('bookings.index', compact('bookings'));
    }

    public function store(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        dd($request->started_at);
        $user->bookings()->create([
            'room_id' => $request->room_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return $this->index();
    }


}
