<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicles\Vehicle;

class PageController extends Controller
{
    /**
     * Display the home page.
     */
    public function home()
    {
        // Get up to 5 vehicles for the hero carousel
        $featuredVehicles = Vehicle::with(['brand', 'type', 'galleries'])
            ->latest()
            ->take(5)
            ->get();

        return view('home', compact('featuredVehicles'));
    }

    /**
     * Display the about page.
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Display the contact page.
     */
    public function contact()
    {
        return view('contact');
    }
}
