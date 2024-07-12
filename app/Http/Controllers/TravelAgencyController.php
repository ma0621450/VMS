<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Destination;
use App\Models\User;
use App\Models\Vp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TravelAgencyController extends Controller
{
    public function create()
    {
        $vp = Vp::all();
        // dd($vp);
        $services = Service::all();
        $destinations = Destination::all();

        return view('agency.packages', compact('vp', 'services', 'destinations'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        // $users = User::with('travelAgency')->get();
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
    public function edit($id)
    {
        $package = Vp::findOrFail($id);
        $allServices = Service::all();
        $allDestinations = Destination::all();

        return view('agency.single_package', compact('package', 'allServices', 'allDestinations'));
    }
    public function update(Request $request, $vp_id)
    {

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

        $package = Vp::findOrFail($vp_id);
        $vp_id = $package->vp_id;
        $package->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'persons' => $validated['persons'],
            'price' => $validated['price'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
        ]);



        $package->services()->detach();

        $package->destinations()->detach();

        $package->services()->attach($validated['services']);

        $package->destinations()->attach($validated['destinations']);

        return redirect()->back();
    }
    public function destroy($vp_id)
    {
        $package = Vp::findOrFail($vp_id);

        $package->services()->detach();
        $package->destinations()->detach();

        $package->delete();

        return redirect('agency/packages');
    }

}







