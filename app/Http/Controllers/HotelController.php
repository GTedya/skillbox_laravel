<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Contracts\View\View;
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
        return view('hotels.show', compact('hotel'));
    }
}
