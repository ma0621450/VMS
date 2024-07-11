<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Destination;
use App\Models\User;
use App\Models\Vp;
use App\Models\VpInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TravelAgencyController extends Controller
{
    public function create()
    {
        $services = Service::all();
        $destinations = Destination::all();

        return view('agency.packages', compact('services', 'destinations'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $users = User::with('travelAgency')->get();
        $travel_agency_id = $user->travelAgency->travel_agency_id;
        // dd($users);


        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'services' => 'required|array',
            'destinations' => 'required|array',
            'persons' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);



        $package = Vp::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'persons' => $validated['persons'],
            'travel_agency_id' => $travel_agency_id,
        ]);

        $package->services()->attach($validated['services']);

        $package->destinations()->attach($validated['destinations']);
        return redirect()->back();
    }

    public function showVp($vp_id)
    {
        $vp = Vp::findOrFail($vp_id);

        $services = $vp->vpServices;

        $destinations = $vp->vpDestinations;

        return view('vp.show', compact('vp', 'services', 'destinations'));
    }


}



